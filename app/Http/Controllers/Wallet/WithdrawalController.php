<?php

namespace App\Http\Controllers\Wallet;

use App\Http\Controllers\Controller;
use App\Mail\RewardDispensationNotifier;
use App\Mail\SendWithdrawalNotificationsToAdmin;
use App\Mail\withdrawalNotifications;
use App\Mail\WithdrawalNotifier;
use App\Models\InvestmentSettings;
use App\Models\InvestmentStore;
use App\Models\TransactionModel;
use App\Models\User;
use App\Traits\AppSettings;
use App\Traits\ErrorHelper;
use App\Traits\Generics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class WithdrawalController extends Controller
{

    use ErrorHelper, AppSettings, Generics;

    function __construct(User $user, TransactionModel $transactionModel, \App\Models\AppSettings $appSettings)
    {
        $this->middleware(['auth', 'verified', 'verify_account']);
        $this->transactionModel = $transactionModel;
        $this->user = $user;
        $this->appSettings = $appSettings;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showAllWithdrawals($userId = '')
    {
        if($userId !== ''){
            $condition = [
                ['user_unique_id', $userId],
                ['action_type', '=', 'withdrawal'],
                ['status', '=', 'pending']
            ];
        }else{
            $condition = [
                ['action_type', '=', 'withdrawal'],
                ['status', '=', 'pending']
            ];

        };
        $withdrawals = $this->transactionModel->getAllWithConditions($condition);
        $data = $this->createArrayForView(['withdrawals'=>$withdrawals, 'dates'=>'ALL']);
        return view('dashboard.withdrawal_request', $data);
    }

    //show all the withdrawal history in the system
    public function showAllConfirmedWithdrawals($userId = '')
    {
        if($userId !== ''){
            $condition = [
                ['user_unique_id', $userId],
                ['action_type', '=', 'withdrawal'],
                ['status', '!=', 'pending']
            ];
        }else{
            $condition = [
                ['action_type', '=', 'withdrawal'],
                ['status', '!=', 'pending']
            ];

        };
        $withdrawals = $this->transactionModel->getAllWithConditions($condition);
        $data = $this->createArrayForView(['withdrawals'=>$withdrawals, 'dates'=>'ALL']);
        return view('dashboard.withdrawal_history', $data);
    }

    //handles confirm or pending withdrawal selection by date
    public function showAllConfirmedWithdrawalsByDate(Request $request, $userId = '')
    {
        $validation = $this->handleShowWithdrawalValidation($request->all());
        if($validation->fails()){
            return Redirect::back()->withErrors($validation);
        }

        //redirect to another route
        $data = [$request->start_date, $request->end_date];
        if($userId !== ''){ $data[] = $userId; }
        return redirect()->route('show_confirmed_withdrawals_with_conditions', $data);

    }

    //handles withdrawal selection by date
    public function showAllWithdrawalsByDate(Request $request, $userId = '')
    {
        $validation = $this->handleShowWithdrawalValidation($request->all());
        if($validation->fails()){
            return Redirect::back()->withErrors($validation);
        }

        //redirect to another route
        $data = [$request->start_date, $request->end_date, $request->type];
        if($userId !== ''){ $data[] = $userId; }
        return redirect()->route('show_withdrawals_with_conditions', $data);

    }


    //show confirmed and pending withdrawals
    function showConfirmedWithdrawalsWithConditions($startDate = '', $endDate = '', $userId = ''){
        $conditions = [
            ['created_at', '>=', $startDate],
            ['created_at', '<', $endDate],
            ['action_type', '=', 'withdrawal'],
            ['status', '!=', 'pending']
        ];
        if($userId !== ''){
            $conditions[] = ['user_unique_id', '=', $userId];
            $userDetails = $this->user->getOneModel($userId);
        }else{
            $userDetails = Auth::user();
        }
        $transactionDetails = $this->transactionModel->getAllWithConditions($conditions);
        $data = $this->createArrayForView(['withdrawals'=>$transactionDetails, 'dates'=>$startDate.' TO '.$endDate, 'userDetails'=>$userDetails]);
        return view('dashboard.withdrawal_history', $data);
    }

    //show pending withdrawals
    function showWithdrawalsWithConditions($startDate = '', $endDate = '', $type, $userId = ''){
        $status = $type === 'history' ? 'confirmed':'pending';
        $conditions = [
            ['created_at', '>=', $startDate],
            ['created_at', '<', $endDate],
            ['action_type', '=', 'withdrawal'],
            ['status', '=', $status]
        ];
        if($userId !== ''){
            $conditions[] = ['user_unique_id', '=', $userId];
            $userDetails = $this->user->getOneModel($userId);
        }else{
            $userDetails = Auth::user();
        }
        $transactionDetails = $this->transactionModel->getAllWithConditions($conditions);
        $data = $this->createArrayForView(['withdrawals'=>$transactionDetails, 'dates'=>$startDate.' TO '.$endDate, 'userDetails'=>$userDetails]);
        if($type === 'history'){
            return view('dashboard.withdrawal_history', $data);
        }else{
            return view('dashboard.withdrawal_request', $data);
        }

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function handleValidation(array $data){

        $validator = Validator::make($data, [
            'amount'=>'required|numeric'
        ]);

        return $validator;
    }

    public function handleShowWithdrawalValidation(array $data){

        $validator = Validator::make($data, [
            'start_date'=>'required',
            'end_date'=>'required'
        ]);

        return $validator;
    }

    //create new withdrwawl
    public function storeWithdrawal(Request $request)
    {

        try{

            $user = Auth::user();
            $settings = $this->appSettings->getSingleModel();

            $validation = $this->handleValidation($request->all());
            if($validation->fails()){
                return Redirect::back()->withErrors($validation);
            }

            //check if the user amount is
            $amountForDb = $this->transactionModel->getAmountForDatabase($request->amount)['data']['amount'];
            $userWalletBalance= $user->balance;
            if($amountForDb > $userWalletBalance){
                return Redirect::back()->with('error_message', 'Insufficient Wallet Balance');
            }

            //add the withdrawal to the database
            $userAmount = $request->amount;
            $requestForDb = $this->withdrawalRequestValues($request, $user, $settings);
            $withdrawalTransaction = $this->transactionModel->insertIntoTransactionModel($requestForDb);

            if($withdrawalTransaction){

                //subtract amount from users wallet
                $user->balance = $user->balance - $amountForDb;
                $user->save();

                ///send email notification
                $this->sendWithdrawalRequestMail($withdrawalTransaction, $user);

                //send mail to admin
                $this->notifyAdmin($withdrawalTransaction, $user);

                if($request->has('formApi') ){
                    $data = $this->createArrayForView([], 'error');
                    return response()->json($data);
                }else{

                    $userCurrency = $user->currency_details->second_currency;
                    return Redirect::back()->with('success_message', "Your withdrawal Request for ($userCurrency) $userAmount was submitted successfully");
                }
            }

        }catch(\Exception $exception){

            $errors =  $exception->getMessage();
            if($request->has('formApi') ){
                $data = $this->createArrayForView(['error'=>$errors], 'error');
                return response()->json($data);
            }else{
                Redirect::back()->with('error_message', $errors);
            }

        }

    }

    function notifyAdmin($transactionObj, $userDetails){
        //send a mail to the user
        $transactionDetails = $transactionObj;//current request
        $transactionDetails['siteDetails'] = $this->appSettings->getSingleModel();
        $transactionDetails['userDetails'] = $userDetails;
        $recieverDetails = $this->createObject(['email'=>'techocraftict@gmail.com']);
        Mail::to($recieverDetails)->send(new withdrawalNotifications($transactionDetails));
    }

    //send complete reward dispensation mail
    function sendWithdrawalRequestMail($transactionObj, $userDetails){
        //send a mail to the user
        $transactionDetails = $transactionObj;
        $transactionDetails['siteDetails'] = $this->appSettings->getSingleModel();
        $transactionDetails['userDetails'] = $userDetails;
        Mail::to($userDetails)->send(new WithdrawalNotifier($transactionDetails));
    }

    //create the values for withdrawal requet
    function withdrawalRequestValues($request, $user, $settings){

        $request->amount = $this->transactionModel->getAmountForDatabase($request->amount)['data']['amount'];
        $request->unique_id = $this->createUniqueId('transaction_models', 'unique_id');
        $request->user_unique_id = $user->unique_id;
        $request->type_of_user = $user->type_of_user;
        $request->description = "Withdrawal from $settings->site_name`s Wallet";
        $request->action_type = 'withdrawal';
        $request->status = 'pending';
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
