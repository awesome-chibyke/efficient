<?php

namespace App\Http\Controllers\Wallet;

use App\Http\Controllers\Controller;
use App\Mail\FundAdditionNotifier;
use App\Mail\WithdrawalNotifier;
use App\Mail\WithdrawalPaymentNotifier;
use App\Models\AppSettings;
use App\Models\BankDetails;
use App\Models\CurrencyRatesModel;
use App\Models\TransactionModel;
use App\Models\User;
use App\Models\PaymentGatewayBox;
use Exception;
use App\Traits\Generics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ErrorHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    use ErrorHelper, Generics, \App\Traits\AppSettings;

    function __construct(TransactionModel $transactionModel, CurrencyRatesModel $currencyRatesModel, AppSettings $appSettings, User $user, BankDetails $bankDetails)
    {

        $this->middleware('auth');

        $this->transactionModel = $transactionModel;
        $this->currencyRatesModel = $currencyRatesModel;
        $this->appSettings = $appSettings;
        $this->user = $user;
        $this->bankDetails = $bankDetails;

    }

    function returnFailedPage(){
        $mainSettings = $this->appSettings->getSingleModel();
        $data = $this->createArrayForView(['mainSettings'=>$mainSettings]);
        return view('fail', $data);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function storeNewTransactions($amount, $action_type, $option_for_payment)
    {

        try{

            $amount = base64_decode($amount);

            $errors = [];
            //select the school details, housing the bank ddetails
            $payment_details = PaymentGatewayBox::select('gateway_manager')
                ->where('keyword', 'flutter_wave');

            if($payment_details->count() == 0){
                $errors[] = 'Flutter Wave is not available';
            }

            //get the type of user and user id
            $authUser = Auth::user();
            $user_details = $this->user->getOneModel($authUser->unique_id);

            $user_unique_id = $user_details->unique_id;
            $type_of_user = $user_details->type_of_user;

            if(count($errors) > 0){
                $error = $this->convertErrorToString($errors);
                throw new Exception($error);
            }

            if($option_for_payment === 'flutter_wave_top_up'){
                $top_up_option = 'flutter_wave';
            }else if($option_for_payment === 'bank_top_up'){
                $top_up_option = 'bank_top_up';
            }

            $unique_id = $this->createUniqueId('transaction_models', 'unique_id');
            $request = $user_details;
            $request->unique_id = $unique_id;
            $request->user_unique_id = $user_unique_id;
            $request->amount = $this->currencyRatesModel->getAmountForDatabase($amount)['data']['amount'];
            $request->description = 'Wallet Top Up';
            $request->action_type = 'top_up';
            $request->top_up_option = $top_up_option;
            $request->status = 'pending';
            $newTransactionDetails = $this->transactionModel->insertIntoTransactionModel($request);

            if($newTransactionDetails){

                if($payment_details->count() > 0){

                    $payment_details_array = $payment_details->first();

                    $gate_way_manager_fields = PaymentGatewayBox::recreateGatewayMangerField($payment_details_array);

                    $payment_details_array['gateway_manager'] = $gate_way_manager_fields['public_key'];

                }

                $fullname = $user_details->name;
                $email = $user_details->email;
                $phone = $user_details->phone;
                $user_details->prefered_currency;
                $currency = $user_details->currency_details;
                $site_url = $this->appSettings->getSingleModel();

                $data = [
                    'unique_id'=>$unique_id,
                    'amount'=>$amount,
                    'action_type'=>$action_type,
                    'description'=>$user_details->description,
                    'full_name'=>$fullname,
                    'email_address'=>$email,
                    'phone_number'=>$phone,
                    'user_unique_id'=>$user_unique_id,
                    'currency_details'=>$currency,
                    'payment_gateway_details'=>$payment_details_array,
                    'site_base_url'=>$site_url->site_url
                ];

                if($option_for_payment === 'flutter_wave_top_up'){
                    return view('top_flutter_wave', compact('data'));
                }else if($option_for_payment === 'bank_top_up'){
                    return redirect()->route('show_bank_transaction', ['transId'=>$newTransactionDetails->unique_id]);
                }

            }

        }catch (Exception $exception){

            $errors = $exception->getMessage();
            return  redirect('failed_api')->with('error_status', $errors);

        }

    }

    function showBankTransaction($transId){

        $data = [];
        $newTransactionDetails = $this->transactionModel->selectSingleTransactionModel($transId);
        $data['bank_details'] = $this->bankDetails->getAllBankdetails();
        $data['user'] = Auth::user();
        $data['newTransactionDetails'] = $newTransactionDetails;
        return view('dashboard.top_up_bank', $data);
    }


    //upload proof of payment
    public function uploadPaymentProof(Request $request){
        $user_photo = null;
        $userDetails = Auth::user();

        $validator = Validator::make($request->all(), [
            'image_name' => 'required|mimes:jpg,jpeg,png|max:500000',
            'add_narrations' => 'nullable|max:100',
        ]);

        if($validator->fails()){
            $message = $validator->getMessageBag();

            return Redirect::back()->with('error_message', $message);
        }

        $transactionIdHolder = $this->transactionModel->selectSingleTransactionModel($request->transactionIdHolder);
        //code for remove old file
        if ($transactionIdHolder->image_name !== null) {
            if(file_exists(storage_path('app/public/img/users/transactions/') . $transactionIdHolder->image_name)){
                $file_old = storage_path('app/public/img/users/transactions/') . $transactionIdHolder->image_name;
                unlink($file_old);
            }
        }

        if ($request->hasFile('image_name')) {
            $file = $request->file('image_name');
            $user_photo = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $destinationPath_r = storage_path('app/public/img/users/transactions/');
            $file->move($destinationPath_r, $user_photo);
        }

        $transactionIdHolder->image_name = $user_photo;
        $transactionIdHolder->add_narrations = $request->add_narrations;

        if ($transactionIdHolder->save()) {
            return Redirect::back()->with('success_message', 'Your Proof of payment Was Successfully Uploaded');
        } else {
            return Redirect::back()->with('error_message', 'An Error occurred, Please try Again Later');
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showTransactions($userId = '')
    {

        if($userId !== ''){
            $condition = [
                ['user_unique_id', $userId],
                ['action_type', '=', 'top_up'],
                ['status', '=', 'pending']
            ];
            $userDetails = $this->user->getOneModel($userId);
        }else{
            $userDetails = Auth::user();
            $condition = [
                ['action_type', '=', 'top_up'],
                ['status', '=', 'pending']
            ];
        }
        $transactionDetails = $this->transactionModel->getAllWithConditions($condition);
        $data = $this->createArrayForView(['userDetails'=>$userDetails, 'transactionDetails'=>$transactionDetails, 'dates'=>'ALL']);
        return view('dashboard.wallet', $data);

    }

    public function showConfirmedTransactions($userId = '')
    {

        if($userId !== ''){
            $condition = [
                ['user_unique_id', $userId],
                ['action_type', '=', 'top_up'],
                ['status', '!=', 'pending']
            ];
            $userDetails = $this->user->getOneModel($userId);
        }else{
            $userDetails = Auth::user();
            $condition = [
                ['action_type', '=', 'top_up'],
                ['status', '!=', 'pending']
            ];
        }
        $transactionDetails = $this->transactionModel->getAllWithConditions($condition);
        $data = $this->createArrayForView(['userDetails'=>$userDetails, 'transactionDetails'=>$transactionDetails, 'dates'=>'ALL']);
        return view('dashboard.top_up_history', $data);

    }

    public function showChargeTransactions($userId = null)
    {

        if($userId !== null){//vf1T4aQMogYSnhmOeHL0K9VfSkGjZBh6tUQ53yjcigod92y0SuIZo56eIrhTf892cddb12a0f658
            $condition = [
                ['user_unique_id', '=', trim($userId)],
                ['action_type', '=', 'expense']
            ];
            $userDetails = $this->user->getOneModel($userId);
        }else{
            $userDetails = Auth::user();
            $condition = [
                ['action_type', '=', 'expense']
            ];
        }

        $transactionDetails = $this->transactionModel->getAllWithConditions($condition);
        $data = $this->createArrayForView(['userDetails'=>$userDetails, 'transactionDetails'=>$transactionDetails, 'dates'=>'ALL']);
        return view('dashboard.charge', $data);

    }


    public function show($transactionUniqueId)
    {
        $userDetails = Auth::user();
        $transactionDetails = $this->transactionModel->selectSingleTransactionModel($transactionUniqueId);
        $data = $this->createArrayForView(['transactionDetails'=>$transactionDetails, 'userDetails'=>$userDetails]);
        return view('dashboard.transaction_history', $data);

    }

    //list of all the transactions
    public function showTopUpTransactions()
    {
        $userDetails = Auth::user();
        $transactionDetails = $this->transactionModel->getAll();
        $data = $this->createArrayForView(['userDetails'=>$userDetails, 'transactionDetails'=>$transactionDetails, 'dates'=>'ALL']);
        return view('dashboard.wallet', $data);

    }

    function handleValidation(array $data){

        $validator = Validator::make($data, [
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d',
        ]);

        return $validator;

    }

    public function showChargesByDate(Request $request, $userId = '')
    {
        $validation = $this->handleValidation($request->all());
        if($validation->fails()){
            return Redirect::back()->withErrors($validation);
        }

        //redirect to another route
        $data = [$request->start_date, $request->end_date];
        if($userId !== ''){ $data[] = $userId; }
        return redirect()->route('get_charges_with_conditions', $data);

    }

    function getChargesWithConditions($startDate = '', $endDate ='', $userId = ''){
        $userDetails = Auth::user();
        $conditions = [
            ['created_at', '>=', $startDate],
            ['created_at', '<', $endDate],
            ['action_type', '=', 'expense']
        ];
        if($userId !== ''){
            $conditions[] = ['user_unique_id', '=', $userId];
            $userDetails = $this->user->getOneModel($userId);
        }
        $transactionDetails = $this->transactionModel->getAllWithConditions($conditions);
        $data = $this->createArrayForView(['transactionDetails'=>$transactionDetails, 'dates'=>$startDate.' TO '.$endDate, 'userDetails'=>$userDetails]);
        return view('dashboard.charge', $data);

    }

    //show pending top ups by date
    public function showTopUpTransactionsByDate(Request $request, $userId = null)
    {
        $validation = $this->handleValidation($request->all());
        if($validation->fails()){
            return Redirect::back()->withErrors($validation);
        }

        //redirect to another route
        $data = [$request->start_date, $request->end_date];
        if($userId !== null){ $data[] = $userId; }
        return redirect()->route('get_top_up_with_conditions', $data);

    }

    function getTopUpWithConditions($startDate = '', $endDate ='', $userId = ''){
        $userDetails = Auth::user();
        $conditions = [
            ['created_at', '>=', $startDate],
            ['created_at', '<', $endDate],
            ['action_type', '=', 'top_up'],
            ['status', '=', 'pending']
        ];
        if($userId !== ''){
            $conditions[] = ['user_unique_id', '=', $userId];
            $userDetails = $this->user->getOneModel($userId);
        }
        $transactionDetails = $this->transactionModel->getAllWithConditions($conditions);
        $data = $this->createArrayForView(['transactionDetails'=>$transactionDetails, 'dates'=>$startDate.' TO '.$endDate, 'userDetails'=>$userDetails]);
        return view('dashboard.wallet', $data);

    }

    //filter confirmed and pending top ups with date
    public function showConfirmedTopUpTransactionsByDate(Request $request, $userId = null)
    {
        $validation = $this->handleValidation($request->all());
        if($validation->fails()){
            return Redirect::back()->withErrors($validation);
        }

        //redirect to another route
        $data = [$request->start_date, $request->end_date];
        if($userId !== null){ $data[] = $userId; }
        return redirect()->route('get_confirmed_top_up_with_conditions', $data);

    }

    //select all confirmed top ups within a date and display
    function getConfirmedTopUpWithConditions($startDate = '', $endDate ='', $userId = ''){
        $userDetails = Auth::user();
        $conditions = [
            ['created_at', '>=', $startDate],
            ['created_at', '<', $endDate],
            ['action_type', '=', 'top_up'],
            ['status', '!=', 'pending']
        ];
        if($userId !== ''){
            $conditions[] = ['user_unique_id', '=', $userId];
            $userDetails = $this->user->getOneModel($userId);
        }
        $transactionDetails = $this->transactionModel->getAllWithConditions($conditions);
        $data = $this->createArrayForView(['transactionDetails'=>$transactionDetails, 'dates'=>$startDate.' TO '.$endDate, 'userDetails'=>$userDetails]);
        return view('dashboard.top_up_history', $data);

    }

    //validate flutterwave payment
    public function validateFlutterWavePayment(Request $request){

        try{

            $data = $request->all();

            $status = $data['flutter_wave']['status'];
            $amount = $data['flutter_wave']['amount'];
            $ref = $data['flutter_wave']['txRef'];
            $orderRef = isset($data['flutter_wave']['orderRef']) ? $data['flutter_wave']['orderRef'] : null;
            //$currency = $data['currency'];

            //run a select to check if payment has been confirmed earlier
            $transaction_details = $this->transactionModel->selectSingleTransactionModel($ref);
            if($transaction_details === null){
                throw new Exception('Transaction could not be found');
            }
            if($transaction_details->status === 'confirmed'){
                throw new Exception('We couldn`t retrieve the record for this payment, Payment could not be verified');
            }

            //select the gateway payment
            $flutter_wave_details = PaymentGatewayBox::select('gateway_manager')
                ->where('school_id', 0)
                ->where('keyword', 'flutter_wave')->first();

            $gate_way_manager_fields = PaymentGatewayBox::recreateGatewayMangerField($flutter_wave_details);

            $query = array(
                "SECKEY" => $gate_way_manager_fields['secret_key'],
                "txref" => $ref
            );

            $data_string = json_encode($query);

            $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

            $response = curl_exec($ch);

            $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $header = substr($response, 0, $header_size);
            $body = substr($response, $header_size);

            curl_close($ch);

            $resp = json_decode($response, true);

            $paymentStatus = $resp['data']['status'];
            $chargeResponsecode = $resp['data']['chargecode'];
            $chargeAmount = $resp['data']['amount'];
            $chargeCurrency = $resp['data']['currency'];

            //&& ($chargeCurrency == $pending_payment->currency)
            if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount) ) {

                // transaction was successful...
                // please check other things like whether you already gave value for this ref
                // if the email matches the customer who owns the product etc
                //Give Value and return to Success page

                //insert data to db
                $transaction_details->status = 'confirmed';
                $transaction_details->reference = $orderRef;
                $transaction_details->save();

                //update the amount for the user balance
                $user__details = User::where('unique_id', $transaction_details->user_unique_id)->first();
                $user__details->balance = $user__details->balance + $this->currencyRatesModel->getAmountForDatabase($amount)['data']['amount'];

                if($user__details->save()){
                    $this->sendTopupSuccessMail($transaction_details, $user__details);
                    return response()->json(['error_code'=>0, 'message'=>'Payment was successfully made']);
                }

            } else {
                //Dont Give Value and return to Failure page
                throw new Exception('Payment could not be verified');
            }

        }catch(Exception $exception){

            $error = $exception->getMessage();
            return response()->json(['error_code'=>1, 'message'=>$error]);

        }

    }

    //validate via webhook
    function validateWithWebHook(){

        // Retrieve the request's body
        $body = @file_get_contents("php://input");

        // retrieve the signature sent in the reques header's.
        $signature = (isset($_SERVER['HTTP_VERIF_HASH']) ? $_SERVER['HTTP_VERIF_HASH'] : '');

        /* It is a good idea to log all events received. Add code *
         * here to log the signature and body to db or file       */

        if (!$signature) {
            // only a post with Flutterwave signature header gets our attention
            exit();
        }

        // Store the same signature on your server as an env variable and check against what was sent in the headers
        $local_signature = getenv('SECRET_HASH');

        // confirm the event's signature
        if ($signature !== $local_signature) {
            // silently forget this ever happened
            exit();
        }

        http_response_code(200); // PHP 5.4 or greater
        // parse event (which is json string) as object
        // Give value to your customer but don't give any output
        // Remember that this is a call from rave's servers and
        // Your customer is not seeing the response here at all
        $response = json_decode($body);
        if ($response->status == 'successful') {
            # code...
            // TIP: you may still verify the transaction
            // before giving value.

            //check if is a transafer
            $eachTransferObject = $response->data;
            if(isset($eachTransferObject['reference'])){

                $eachPendingPayment = $this->transactionModel->getSingleRow($response->data->reference);
                if($eachPendingPayment->unique_id === $eachTransferObject['reference']){

                    //check if the transaction have been confirmed earlier
                    if($eachPendingPayment->status === 'confirmed'){
                        exit();
                    }

                    //check if the status of the return transfer object is successful
                    if($eachTransferObject['status'] === 'SUCCESSFUL'){

                        $amount = $eachTransferObject['amount'];//update the status of the transfer to confirmed
                        $eachPendingPayment->status = 'confirmed';
                        $eachPendingPayment->save();


                        //update the user balance
                        $userDetails = $this->user->getOneModel($eachPendingPayment->user_unique_id);
                        $userDetails->balance = $userDetails->balance - $eachPendingPayment->amount;
                        $userDetails->save();

                        $this->sendWithdrawalRequestMail($eachPendingPayment, $userDetails);//send mail
                    }

                }
            }

            if(isset($response['data']['tx_ref'])){

                //check if its a payment
                $paymentStatus = $response['data']['status'];
                $chargeAmount = $response['data']['amount'];
                $chargeCurrency = $response['data']['currency'];
                $tx_ref = $response['data']['tx_ref'];

                if($paymentStatus !== 'successful'){
                    exit();
                }

                //selection the row holding the transaction details
                $transaction_details = $this->transactionModel->getSingleRow($tx_ref);
                if($transaction_details === null){//exit if the selection was not successful
                    exit();
                }
                if($transaction_details->status === 'confirmed'){//exit if the status of transafer is already confirmed
                    exit();
                }

                //update the transaction
                $transaction_details->status = 'confirmed';
                $transaction_details->save();

                //update the amount for the user balance
                $user__details = User::where('unique_id', $transaction_details->user_unique_id)->first();
                $user__details->balance = $user__details->balance + $this->currencyRatesModel->getAmountForDatabase($amount)['data']['amount'];

                if($user__details->save()){//send email to the user that made the payment
                    $this->sendTopupSuccessMail($transaction_details, $user__details);
                }

            }

        }
        exit();

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

    function confirmTopUp(Request $request){
        $updateStatus = 0;
        foreach($request->dataArray as $k => $eachId){
            $eachTransactionObj = $this->transactionModel->selectSingleTransactionModel($eachId);
            if($eachTransactionObj->status === 'confirmed'){
                $updateStatus = 1;
                continue;
            }
            $eachTransactionObj->status = 'confirmed';
            if($eachTransactionObj->save()){
                $userDetails = $eachTransactionObj->user_details;//update the user balance
                $userDetails->balance = $userDetails->balance + $eachTransactionObj->amount;
                $userDetails->save();

                $this->sendTopupSuccessMail($eachTransactionObj, $userDetails);//send mail

                $updateStatus = 1;
            }
        }
        if($updateStatus == 1){
            return response()->json(['error_code'=>0, 'success_statement'=>'selected transactions have been confirmed successfully']);
        }
        return response()->json(['error_code'=>1, 'error_statement'=>'An error occurred, transaction failed']);

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

    function handleTransfers(Request $request){

        try{

            $validation = $this->handleTransferValidation($request->all());
            if($validation->fails()){
                //return Redirect::back()->withErrors($validation->messages());
                return response()->json(['error_code'=>1, 'error_message'=>$validation->messages()]);
            }

            $bulk_data = [];

            $withdrawalId = explode('|', $request->withdrawalId);
            foreach($withdrawalId as $k => $eachWithdrawalId){

                $withdrawalDetails = $this->transactionModel->selectSingleTransactionModel($eachWithdrawalId);
                if($withdrawalDetails === null){
                    throw new Exception('Withdrawal could not be found!');
                    return;
                }

                if($withdrawalDetails->amount > $withdrawalDetails->user_details->balance){
                    throw new Exception('Insufficient Balance, Amount cannot be withdrawn!');
                    return;
                }
                if($withdrawalDetails->status === 'confirmed'){
                    throw new Exception('Withdrawal at line '.($k+1).' have already been processed before');
                    return;
                }

                $bulk_data[] = [
                    "bank_code"=>$withdrawalDetails->user_details->bank_code,
                    "account_number"=>$withdrawalDetails->user_details->account_number,
                    "amount"=>$withdrawalDetails->amount * $withdrawalDetails->user_details->currency_details->rate_of_conversion,
                    "currency"=>$withdrawalDetails->user_details->currency_details->second_currency,
                    "narration"=>$withdrawalDetails->description,
                    "reference"=>$withdrawalDetails->unique_id
                ];

            }

            if(count($bulk_data) > 0){

                $flutter_wave_details = PaymentGatewayBox::getFlutterWaveDetails();
                if($flutter_wave_details['error_code'] == 1){
                    throw new Exception($flutter_wave_details['error']);
                    return;
                }
                $secKey = $flutter_wave_details['data']['gate_way_manager_fields']['secret_key'];

                $payment_data = [
                    "title"=>'Lottery Cash Win',
                    "bulk_data"=>$bulk_data,
                ];

                $response = $this->commencePayment($payment_data, $secKey);
                if($response['error_code'] == 1){
                    throw new Exception($response['error']);
                    return;
                }

                //loop through and update payments to processing
                foreach($withdrawalId as $k => $eachWithdrawalId) {
                    $withdrawalDetails = $this->transactionModel->selectSingleTransactionModel($eachWithdrawalId);
                    $withdrawalDetails->status = 'processing';
                    $withdrawalDetails->save();
                }

                $this->retrieveStatusOfBulkTransfer();

                //return Redirect::back()->with('success_message', $response['payment_response']['message']);
                return response()->json(['error_code'=>0, 'success_message'=>$response['data']['payment_response']['message'], 'data'=>$response['data']['payment_response'] ]);

            }

        }catch (Exception $exception){

            $error = $exception->getMessage();
            return response()->json(['error_code'=>1, 'error_message'=>['general_error'=>[$error]]]);
            //return Redirect::back()->with('error_message', $error);

        }

    }

    public function markWithdrawalsAsPaid(Request $request)
    {
        $updateCondition = 0;
        if(count($request->dataArray) > 0){

            foreach($request->dataArray as $k => $eachWithdrawalId){
                $withdrawalDetails = $this->transactionModel->selectSingleTransactionModel($eachWithdrawalId);
                if($withdrawalDetails->status === 'confirmed'){
                    return response()->json(['error_code'=>1, 'error_message'=>'Transaction at Row ('.($k+1).') have already been confirmed. Please unselect before you can continue']);
                    break;
                }
            }

            foreach($request->dataArray as $k => $eachWithdrawalId){

                //update the withdrawal status to confirmed
                $withdrawalDetails = $this->transactionModel->selectSingleTransactionModel($eachWithdrawalId);
                $withdrawalDetails->status = 'confirmed';
                $withdrawalDetails->save();
                $userID = $withdrawalDetails->user_unique_id;
                $userDetails = $this->user->getOneModel($userID);//remove transfered amount from users wallet
                $userDetails->balance = $userDetails->balance - $withdrawalDetails->amount;
                if($userDetails->save()){
                    $this->sendWithdrawalRequestMail($withdrawalDetails, $userDetails);//send mail
                    $updateCondition = 1;
                }

            }
            if($updateCondition == 1){
                return response()->json(['error_code'=>0, 'success_statement'=>'Selected Withdrawals have been marked as paid']);
            }
            return response()->json(['error_code'=>1, 'error_message'=>'An error occurred, please try again']);
        }

    }

    //send mail  for payment confirmation
    function sendWithdrawalRequestMail($transactionObj, $userDetails){
        //send a mail to the user
        $transactionDetails = $transactionObj;
        $transactionDetails['siteDetails'] = $this->appSettings->getSingleModel();
        $transactionDetails['userDetails'] = $userDetails;
        Mail::to($userDetails)->send(new WithdrawalPaymentNotifier($transactionDetails));
    }

    public function retrieveStatusOfBulkTransfer(){

        try{

            //get the flutterwave details
            $flutter_wave_details = PaymentGatewayBox::getFlutterWaveDetails();
            if($flutter_wave_details['error_code'] == 1){
                throw new Exception($flutter_wave_details['error']);
                return;
            }
            $secKey = $flutter_wave_details['data']['gate_way_manager_fields']['secret_key'];

            //get all the processing withdrawals
            $conditions[] = ['status', '=', 'processing'];
            $pendingWithdrawalPayment = $this->transactionModel->getAllWithConditions($conditions);
            if(count($pendingWithdrawalPayment) > 0){

                $curl = curl_init();
                ///"Content-Type: application/json"
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.flutterwave.com/v3/transfers/",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "Authorization: Bearer $secKey"
                    ),
                ));

                $response = curl_exec($curl);
                curl_close($curl);
                $results = json_decode($response, true);

                if($results['status'] !== 'success'){
                    throw new Exception($results['message']);
                    return;
                }

                $allTransfers = $results['data'];//

                foreach($pendingWithdrawalPayment as $k => $eachPendingPayment){//loops through the pending payments

                    foreach ($allTransfers as $l => $eachTransferObject) {

                        if($eachPendingPayment->unique_id === $eachTransferObject['reference']){

                            if($eachTransferObject['status'] === 'SUCCESSFUL'){

                                $amount = $eachTransferObject['amount'];
                                $eachPendingPayment->status = 'confirmed';
                                $eachPendingPayment->save();


                                //update the school balance
                                $userDetails = $this->user->getOneModel($eachPendingPayment->user_unique_id);
                                $userDetails->balance = $userDetails->balance - $eachPendingPayment->amount;
                                $userDetails->save();

                                $this->sendWithdrawalRequestMail($eachPendingPayment, $userDetails);//send mail
                            }

                        }

                    }

                }

                return [
                    'error_code'=>0,
                    'error'=>['pendingWithdrawalPayment'=>$pendingWithdrawalPayment, 'allTransfers'=>$allTransfers],
                    'data'=>[]
                ];

            }

        }catch(Exception $exception){
            $error = $exception->getMessage();
            return [
                'error_code'=>1,
                'error'=>$error,
                'data'=>[]
            ];
        }

    }

    function handleTransferValidation(array $data){

        $validator = Validator::make($data, [
            'withdrawalId' => 'required|string'
        ]);

        return $validator;

    }


    //send complete reward dispensation mail
    function sendTopupSuccessMail($transactionObj, $userDetails){
        //send a mail to the user
        $transactionDetails = $transactionObj;
        $transactionDetails['siteDetails'] = $this->appSettings->getSingleModel();
        $transactionDetails['userDetails'] = $userDetails;
        Mail::to($userDetails)->send(new FundAdditionNotifier($transactionDetails));
    }

    function deleteTransactionDetails(Request $request){

        $transactionIds = $request->dataArray;

        //loop through the transaction ids
        $deleteStatus = 0;
        foreach($transactionIds as $k => $eachTransactId){

            $transactionObj = $this->transactionModel->getSingleRow($eachTransactId);

            if($transactionObj !== null){
                if($transactionObj->delete()){
                    $deleteStatus = 1;
                }
            }

        }
        if($deleteStatus == 1){
            return response()->json(['error_code'=>0, 'success_statement'=>'Selected Transaction(s) was deleted successfully']);
        }

        return response()->json(['error_code'=>1, 'error_message'=>'An error occurred, Please try again']);

    }

    //admin aadd funds page
    function showAddFunds($userId = null){

        $userDetails = Auth::user();
        if($userDetails->type_of_user !== 'admin' && strtolower($userDetails->email) !== 'techocraftict@gmail.com'){
            Auth::logout();
            return \redirect()->route('login')->with('status', 'You are not authorised to view this page');
        }
        return view('dashboard.add_funds', ['userId'=>$userId]);

    }

    function handleFundingValidation(array $data){

        $validator = Validator::make($data, [
            'option' => 'required|string',
            'amount' => 'required|numeric'
        ]);

        return $validator;

    }

    //store funds
    function storeFunds(Request $request, $userId){//option all add amount

        //run validation
        $validate = $this->handleFundingValidation($request->all());
        if($validate->fails()){
            return Redirect::back()->withErrors($validate->getMessageBag());
        }

        //add funds to db
        $userDetails = $this->user->getOneModel($userId);
        if($userDetails !== null){
            if($request->option == 'all'){
                $userDetails->balance = $this->transactionModel->getAmountForDatabase($request->amount)['data']['amount'];
            }else if($request->option == 'add'){
                $userDetails->balance = $userDetails->balance + $this->transactionModel->getAmountForDatabase($request->amount)['data']['amount'];;
            }
            if($userDetails->save()){
                return Redirect::back()->with('success_message', 'Funds have been successfully updated');
            }
            return Redirect::back()->with('error_message', 'An error occurred, please try again');
        }



    }

}
