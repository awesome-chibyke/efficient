<?php

namespace App\Http\Controllers\Investments;

use App\Http\Controllers\Controller;
use App\Mail\ReferralNotifier;
use App\Mail\RewardDispensationNotifier;
use App\Mail\SuccessFullInvestment;
use App\Models\AppSettings;
use App\Models\CurrencyRatesModel;
use App\Models\InvestmentReferral;
use App\Models\InvestmentReward;
use App\Models\InvestmentRewardCheck;
use App\Models\InvestmentSettings;
use App\Models\InvestmentStore;
use App\Models\PaymentGatewayBox;
use App\Models\TransactionModel;
use App\Models\User;
use App\Traits\Generics;
use App\Traits\Slot;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class InvestmentController extends Controller
{
    use Generics, Slot;

    function __construct(InvestmentSettings $investmentSettings, InvestmentReward $investmentReward, CurrencyRatesModel $currencyRatesModel, User $user, InvestmentStore $investmentStore, InvestmentReferral $investmentReferral, AppSettings $appSettings, InvestmentRewardCheck $investmentRewardCheck, TransactionModel $transactionModel)
    {

        $this->middleware('auth');
        $this->investmentSettings = $investmentSettings;
        $this->investmentReward = $investmentReward;
        $this->currencyRatesModel = $currencyRatesModel;
        $this->user = $user;
        $this->investmentStore = $investmentStore;
        $this->investmentReferral = $investmentReferral;
        $this->appSettings = $appSettings;
        $this->investmentRewardCheck = $investmentRewardCheck;
        $this->transactionModel = $transactionModel;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createInvestmentInterface($refId = null)
    {
        $user = Auth::user();
        $investments = $this->investmentSettings->getAllRows();
        if($refId !== null){
            return view('dashboard.create_investment', ['investments'=>$investments, 'refId'=>$refId]);
        }else if($user->referer_unique_id !== null) {
            $refeId = $user->referer_unique_id;
            return view('dashboard.create_investment', ['investments'=>$investments, 'refId'=>$refeId]);
        }
        return view('dashboard.create_investment', ['investments'=>$investments]);

    }

    protected function ValidateValueForInvestmentCreation($request){//amount reward_type reward

        $validator = Validator::make($request->all(), [
            'investment_settings_id' => 'required|string'
        ]);

        return $validator;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createAnInvestment(Request $request)
    {
        $userDetails = Auth::user();
        $investmentPlan = $this->investmentSettings->getSingleRow($request->investment_settings_id);

        $validate = $this->ValidateValueForInvestmentCreation($request);
        if($validate->fails()){
            return Redirect::back()->withErrors($validate->getMessageBag());
        }

        try{

            //get the total amount for form and charge for the package
            $totalAmount = $investmentPlan->amount;
            // + $investmentPlan->amount_for_form

            //check if the user balance is okay for transaction
            if($totalAmount > $userDetails->balance){
                throw new \Exception('Insufficient balance, please add more funds to your Efficient wallet before you can be able to list for a plan');
            }

            //check the slot the user can invest in
            /*$checkSlotValidity = $this->validateInvestmentAmount($investmentPlan->amount, $userDetails->unique_id);
            if($checkSlotValidity['status'] === false){
                throw new \Exception($checkSlotValidity['error']);
            }*/

            //check if the user have invested upto ten time on this particular plan
            $pastInvestmentCount = $this->investmentStore->getRowsWhere([
                ['investment_settings_id', '=', $request->investment_settings_id]
            ])->count();
            //get teh appa settings
            $settings = $this->appSettings->getSingleModel();
            if($pastInvestmentCount > ($settings->slot_setup-1)){
                throw new \Exception('You have reached the maximum Slot of '.$settings->slot_setup.' for this package');
            }

            //details of the referrer
            $referrerId = $request->referral_id;
            $referrerDetails = $this->investmentStore->getSingleRowsWhere([
                ['referral_id', '=', $referrerId],
                ['status', '=', 'active'],
            ]);

            //check for the existence of the referrer
            if($referrerId !== '' && $referrerId !== null){
                $referalInvestmentCheck = $this->checkForReferrerInvestment($request, $referrerDetails);
                if($referalInvestmentCheck['status'] === false){
                    throw new \Exception($referalInvestmentCheck['error']);
                }
            }

            //save the investment to the db
            $request->user_unique_id = $userDetails->unique_id;
            $request->investment_settings_id = $investmentPlan->unique_id;
            $request->time_remaining_in_days = $investmentPlan->duration_for_referral_reward;
            $request->no_of_days = $investmentPlan->duration_for_referral_reward;
            $request->time_regulator = Carbon::now()->toDateTimeString();
            $request->form_amount_dispensation_status = 'pending';
            $refIdString = $this->random_string ('alnum', 5 );
            $request->referral_id = $userDetails->username.'-'.$refIdString;
            $request->status = 'active';
            $investmentStorePlan = $this->investmentStore->createNewInvestment($request);
            if($investmentStorePlan){

                //update the referral record
                if($referrerDetails !== null) {

                    //get the past referrer for this investment the user want to key into
                    $noOfReferrals = $this->investmentStore->ReferralDetails($referrerId)->count();

                    $this->updateReferralRecords($request, $userDetails, $referrerDetails, $investmentStorePlan, $referrerId);//update the referral record

                    $referrerInvestmentDetails = InvestmentStore::where('referral_id', $referrerId)->first();
                    $ReferrerDetails = $referrerInvestmentDetails->UserDetails;
                    if($noOfReferrals <= 2){
                        //send the referral message
                        $this->sendReferralReportMail($referrerInvestmentDetails, $investmentStorePlan, $ReferrerDetails);
                    }

                }

                //create the rewards
                $allRewards = $investmentPlan->rewardsDetails;
                if(count($allRewards) > 0){
                    foreach($allRewards as $k => $eachReward){
                        $rewardObject = $this->investmentRewardCheck->createRewardsForInvestment($investmentStorePlan, $eachReward->unique_id, 'kind');
                        $this->investmentRewardCheck->createNewInvestmentRewardCheck($rewardObject);
                    }
                }

                //create the transaction for this investment
                //return $investmentStorePlan;
                $this->createNewTransaction($investmentStorePlan, $totalAmount);

            }

            //deduct the amount charged from the users balance
            $userDetails->balance = $userDetails->balance - $totalAmount;
            $userDetails->referer_unique_id = null;
            $userDetails->save();

            //send a mail to the user
            $this->sendMail($investmentStorePlan, $investmentPlan, $userDetails);
            return Redirect::back()->with('success_message', 'You have successfully enrolled for a Package');

        }catch(\Exception $exception){
          return Redirect::back()->with('error_message', $exception->getMessage());
        }


    }

    //add amount deducted to transaction history
    function createNewTransaction($eachInvestment, $amount){

        $unique_id = $this->createUniqueId('transaction_models', 'unique_id');
        $request = [];
        $request['unique_id'] = $unique_id;
        $request['user_unique_id'] = $eachInvestment->user_unique_id;
        $request['amount'] = $amount;
        $request['description'] = 'Charge for '.$eachInvestment->InvestmentPlan->name_of_plan.' enrollment';
        $request['action_type'] = 'expense';
        $request['top_up_option'] = '';
        $request['reference'] = $eachInvestment->unique_id;
        $request['status'] = 'confirmed';
        $object = json_decode(json_encode($request), FALSE);
        return $this->transactionModel->insertIntoTransactionModel($object);

    }

    function sendMail($investmentDetails, $investmentPlan, $userDetails){
        //send a mail to the user
        $investmentDetails['siteDetails'] = $this->appSettings->getSingleModel();
        $investmentDetails['investmentPlan'] = $investmentPlan;
        $investmentDetails['userDetails'] = $userDetails;
        Mail::to($userDetails)->send(new SuccessFullInvestment($investmentDetails));
    }

    function checkForReferrerInvestment($request, $referalCheck){//cehck for referral existence

        if($referalCheck === null){
            return [
                'status'=>false,
                'error'=>'Invalid Referral Unique ID. No record was found for it'
            ];
        }
        if($referalCheck->user_unique_id === Auth::user()->unique_id){
            return [
                'status'=>false,
                'error'=>'Please note that you cannot refer your self'
            ];
        }

        if($referalCheck->investment_settings_id !== $request->investment_settings_id){
            $investmentSetting = $this->investmentSettings->getSingleRow($referalCheck->investment_settings_id);
            return [//
                'status'=>false,
                'error'=>'Referral Code can only work if your referer enlisted for the same package ('.$investmentSetting->name_of_plan.') as you want to enlist.'
            ];
        }

        return [
            'status'=>true,
            'data'=>$referalCheck
        ];
    }

    function updateReferralRecords($request, $userDetails, $referrerDetails, $createdInvestment, $referrerId){
        //log the referral to the referral table
        //unique_id 	investment_settings_id 	referral_id 	referred_user_id 	referrer_user_id
        $request->investment_unique_id = $createdInvestment->unique_id;
        $request->referred_user_id = $userDetails->unique_id;
        $request->referrer_user_id = $referrerDetails->unique_id;
        $request->referral_id = $referrerId;
        $this->investmentReferral->createNewInvestmentReferral($request);

    }

    function sendReferralReportMail($referrerInvestmentDetails, $referredInvestmentDetails, $ReferrerUserDetails){
        //send referral report mail
        $referrerInvestmentDetails['referredInvestmentDetails'] = $referredInvestmentDetails;
        $referrerInvestmentDetails['siteDetails'] = $this->appSettings->getSingleModel();
        $referrerInvestmentDetails['ReferrerUserDetails'] = $ReferrerUserDetails;
        Mail::to($ReferrerUserDetails)->send(new ReferralNotifier($referrerInvestmentDetails));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function viewInvestments($investmentPlanId, $userUniqueId = '')
    {

        $investmentSettings = $this->investmentSettings->getSingleRow($investmentPlanId);

        if($investmentSettings !== null){
            if($userUniqueId === ''){
                //$InvestmentDetails = $investmentSettings->InvestmentDetails;
                $InvestmentDetails = $this->investmentStore->getRowsWhere([
                    ['investment_settings_id', '=', $investmentSettings->unique_id],
                    ['status', '=', 'active']
                ]);
            }else{
                $InvestmentDetails = $this->investmentStore->getRowsWhere([
                    ['user_unique_id', '=', $userUniqueId],
                    ['investment_settings_id', '=', $investmentSettings->unique_id],
                    ['status', '=', 'active']
                ]);
            }

            $investmentSettings['Investment_details'] = $InvestmentDetails;

            if(count($InvestmentDetails) > 0){
                foreach($InvestmentDetails as $kk => $eachInvestmentDetails){
                    $eachInvestmentDetails->InvestmentRewardCheck;
                }
            }
            $investmentSettings->rewardsDetails;
        }

        return view('dashboard.all_investment', ['investmentSettings'=>$investmentSettings]);

    }

    public function viewInvestmentHistory($investmentPlanId, $userUniqueId = '')
    {//get the investment histiry

        $investmentSettings = $this->investmentSettings->getSingleRow($investmentPlanId);

        if($investmentSettings !== null){
            if($userUniqueId === ''){
                //$InvestmentDetails = InvestmentStore::where('status', 'processing_rewards')->get();
                $InvestmentDetails = $this->investmentStore->getRowsWhere([
                    ['investment_settings_id', '=', $investmentSettings->unique_id],
                    ['status', '=', 'done']
                ]);
            }else{
                $InvestmentDetails = $this->investmentStore->getRowsWhere([
                    ['user_unique_id', '=', $userUniqueId],
                    ['investment_settings_id', '=', $investmentSettings->unique_id],
                    ['status', '=', 'done']
                ]);
            }

            $investmentSettings['Investment_details'] = $InvestmentDetails;

            if(count($InvestmentDetails) > 0){
                foreach($InvestmentDetails as $kk => $eachInvestmentDetails){
                    $eachInvestmentDetails->InvestmentRewardCheck;
                }
            }
            $investmentSettings->rewardsDetails;
        }

        return view('dashboard.investment_history', ['investmentSettings'=>$investmentSettings]);

    }

    public function viewDueInvestments($investmentPlanId, $userUniqueId = null)
    {//get the investment histiry

        $investmentSettings = $this->investmentSettings->getSingleRow($investmentPlanId);

        if($investmentSettings !== null){
            if($userUniqueId === null){
                //$InvestmentDetails = InvestmentStore::where('status', 'processing_rewards')->get();
                $InvestmentDetails = $this->investmentStore->getRowsWhere([
                    ['investment_settings_id', '=', $investmentSettings->unique_id],
                    ['status', '=', 'processing_rewards']
                ]);
            }else{
                $InvestmentDetails = $this->investmentStore->getRowsWhere([
                    ['user_unique_id', '=', $userUniqueId],
                    ['investment_settings_id', '=', $investmentSettings->unique_id],
                    ['status', '=', 'processing_rewards']
                ]);
            }

            $investmentSettings['Investment_details'] = $InvestmentDetails;

            if(count($InvestmentDetails) > 0){
                foreach($InvestmentDetails as $kk => $eachInvestmentDetails){
                    $eachInvestmentDetails->InvestmentRewardCheck;
                }
            }
            $investmentSettings->rewardsDetails;
        }

        return view('dashboard.due_investments', ['investmentSettings'=>$investmentSettings]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getInvestmentSettings($investmentSettingsId)
    {
        $investmentSettingObj = $this->investmentSettings->getSingleRow($investmentSettingsId);
        if($investmentSettingObj !== null){
            $investmentSettingObj->rewardsDetails;
            $investmentSettingObj->loggedUser = Auth::user();
            $investmentSettingObj->loggedUserCurrency = $investmentSettingObj->loggedUser->currency_details;
            return response()->json(['error_code'=>0, 'success_statement'=>'success', 'data'=>$investmentSettingObj]);
        }
        return response()->json(['error_code'=>1, 'error_statement'=>'An error occurred, Please try again']);
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
    public function confirmDispensation(Request $request)
    {

        $investmentIds = $request->dataArray; $updateCheck = 0;
        foreach($investmentIds as $k => $eachInvestmentId){

            $eachInvestmentDetails = $this->investmentStore->getSingleRow($eachInvestmentId);
            $userDetails = $eachInvestmentDetails->UserDetails;
            //send a mail to the owner of the investment
            $this->sendDispensationMail($eachInvestmentId, $eachInvestmentDetails->investment_settings_id, $userDetails);
            $rewardChecks = $eachInvestmentDetails->InvestmentRewardCheck;
            if(count($rewardChecks) > 0){
                foreach($rewardChecks as $ll => $eachRewardChecks){
                    $eachRewardChecks->status = 'done';
                    $eachRewardChecks->save();
                }
            }
            $eachInvestmentDetails->status = 'done';
            if($eachInvestmentDetails->save()){
                $updateCheck = 1;
            }

        }
        if($updateCheck == 1){
            return response()->json(['error_code'=>0, 'success_statement'=>'Rewards for Selected Investments have been marked as fully dispensed']);
        }
        return response()->json(['error_code'=>1, 'error_statement'=>'An error occurred, Please try again']);

    }


    //send complete reward dispensation mail
    function sendDispensationMail($investmentStoreID, $investmentPlanId, $userDetails){
        //send a mail to the user
        $investmentDetails = InvestmentStore::find($investmentStoreID);
        $investmentDetails['siteDetails'] = $this->appSettings->getSingleModel();
        //$investmentPlan->rewardsDetails;
        $investmentDetails['investmentPlan'] = InvestmentSettings::find($investmentPlanId);
        $investmentDetails['userDetails'] = $userDetails;
        Mail::to($userDetails)->send(new RewardDispensationNotifier($investmentDetails));
    }

    ///view investment by date
    public function getInvestmentsByDate($investmentPlanId, $startDate, $endDate, $option, $userUniqueId = null)
    {

        $investmentSettings = $this->investmentSettings->getSingleRow($investmentPlanId);

        if($investmentSettings !== null){

            $conditions = [
                ['created_at', '>=', $startDate],
                ['created_at', '<', $endDate],
                ['investment_settings_id', '=', $investmentSettings->unique_id]
            ];

            if($userUniqueId !== null){//if its a user, add his user id
                $conditions[] = ['user_unique_id', '=', $userUniqueId];
            }

            //select the active option for the investment
            if($option === 'history'){$conditions[] = ['status', '=', 'done'];}
            if($option === 'due'){$conditions[] = ['status', '=', 'processing_rewards'];}
            if($option === 'active'){$conditions[] = ['status', '=', 'active'];}

            $InvestmentDetails = $this->investmentStore->getRowsWhere($conditions);//get all the investments based on passed conditions

            $investmentSettings['Investment_details'] = $InvestmentDetails;

            if(count($InvestmentDetails) > 0){
                foreach($InvestmentDetails as $kk => $eachInvestmentDetails){
                    $eachInvestmentDetails->InvestmentRewardCheck;
                }
            }
            $investmentSettings->rewardsDetails;
        }

        if($option === 'active'){
            return view('dashboard.all_investment', ['investmentSettings'=>$investmentSettings]);
        }else if($option === 'history'){
            return view('dashboard.investment_history', ['investmentSettings'=>$investmentSettings]);
        }else if($option === 'due'){
            return view('dashboard.due_investments', ['investmentSettings'=>$investmentSettings]);
        }

    }

    ///show investment by date with post method
    function showInvestmentsByDate(Request $request, $investmentPlanID, $option, $userId = ''){
        $validation = $this->handleValidation($request->all());
        if($validation->fails()){
            return Redirect::back()->withErrors($validation);
        }

        //redirect to another route
        $data = [$investmentPlanID, $request->start_date, $request->end_date];
        if($userId !== ''){ $data[] = $userId; }
        $data[] = $option;
        return redirect()->route('get_investments_by_date', $data);
    }

    function handleValidation(array $data){

        $validator = Validator::make($data, [
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d',
        ]);

        return $validator;

    }


    //get the referals for an investment
    function investmentReferral($investmentId){

        $investment = $this->investmentStore->getSingleRow($investmentId);
        return view('dashboard.all_referrals', ['investments'=>$investment]);

    }

    function payCenterAmounts(){

        $investmentsWithPendingCenterFeeSettlement = $this->investmentStore->getRowsWhere([
            ['form_amount_dispensation_status', '=', 'pending']
        ]);

        $bulk_data = [];//initialize an empty array for the bulk payment payload
        $totalAmount = 0;
        //loop through the selected investments
        foreach($investmentsWithPendingCenterFeeSettlement as $k => $eachInvestment){

            //check if the centers connected each has an account number
            $centerDetails = $eachInvestment->UserDetails->centers;
            if($centerDetails === null){ continue; }
            if($centerDetails->bank_code === null || $centerDetails->bank_code === ''){ continue; }

            $bulk_data[] = [
                "bank_code"=>$centerDetails->bank_code,
                "account_number"=>$centerDetails->account_number,
                "amount"=>round($eachInvestment->form_amount * $centerDetails->currency_details->rate_of_conversion),
                "currency"=>$centerDetails->currency_details->second_currency,
                "narration"=>'Payment of ('.$centerDetails->currency_details->second_currency.') '.round($eachInvestment->form_amount * $centerDetails->currency_details->rate_of_conversion).' for accrued from from sales to '.$centerDetails->team,
                "reference"=>$eachInvestment->unique_id
            ];

            $totalAmount += $eachInvestment->form_amount;

        }

        if(count($bulk_data) > 0){

            $flutter_wave_details = PaymentGatewayBox::getFlutterWaveDetails();
            if($flutter_wave_details['error_code'] == 1){
                return;
            }
            $secKey = $flutter_wave_details['data']['gate_way_manager_fields']['secret_key'];

            $payment_data = [
                "title"=>'Form Fee Dispensation to Collection Centers',
                "bulk_data"=>$bulk_data,
            ];

            $response = $this->commencePayment($payment_data, $secKey);
            if($response['error_code'] == 1){
                return;
            }

            //loop through and update payments to processing
            foreach($investmentsWithPendingCenterFeeSettlement as $k => $eachInvestment){
                $eachInvestment->form_amount_dispensation_status = 'processing';
                $eachInvestment->form_amount_dispensation_status->save();
            }

            $this->retrieveStatusOfBulkTransfer();

            //return Redirect::back()->with('success_message', $response['payment_response']['message']);
            return response()->json(['error_code'=>0, 'success_message'=>$response['data']['payment_response']['message'], 'data'=>$response['data']['payment_response'] ]);

        }

    }

    function retrieveStatusOfBulkTransfer(){

        try{

            //get the flutterwave details
            $flutter_wave_details = PaymentGatewayBox::getFlutterWaveDetails();
            if($flutter_wave_details['error_code'] == 1){
                throw new Exception($flutter_wave_details['error']);
                return;
            }
            $secKey = $flutter_wave_details['data']['gate_way_manager_fields']['secret_key'];

            //get all the processing withdrawals
            $pendingSettlementPayment = $this->investmentStore->getRowsWhere([
                ['form_amount_dispensation_status', '=', 'processing']
            ]);
            if(count($pendingSettlementPayment) > 0){

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

                foreach($pendingSettlementPayment as $k => $eachPendingPayment){//loops through the pending payments

                    foreach ($allTransfers as $l => $eachTransferObject) {

                        if($eachPendingPayment->unique_id === $eachTransferObject['reference']){

                            if($eachTransferObject['status'] === 'SUCCESSFUL'){

                                $amount = $eachTransferObject['amount'];
                                $eachPendingPayment->status = 'confirmed';
                                $eachPendingPayment->save();
                            }

                        }

                    }

                }

                return [
                    'error_code'=>0,
                    'error'=>['pendingWithdrawalPayment'=>$pendingSettlementPayment, 'allTransfers'=>$allTransfers],
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

    function editUserInvestment($userInvestmentId = null){

        $investment = $this->investmentStore->getSingleRow($userInvestmentId);

        return view('dashboard.update_user_investment', ['investment'=>$investment]);

    }

    function updateUserInvestment(Request $request, $userInvestmentId){
    //update an existing investment for a user
        $validation = $this->handleUserInvestmentValidation($request->all());
        if($validation->fails()){//validation
            return Redirect::back()->withErrors($validation);
        }

        $investment = $this->investmentStore->getSingleRow($userInvestmentId);
        $investment->time_remaining_in_days = $request->time_remaining_in_days;
        $investment->created_at = $request->created_at;//update the investment
        if($investment->save()){
            return Redirect::back()->with('success_message', 'Update was successful');
        }
        return Redirect::back()->with('error_message', 'An error occurred, please try again later');
    }

    //validation for user investment
    function handleUserInvestmentValidation(array $data){

        $validator = Validator::make($data, [
            'time_remaining_in_days' => 'required|numeric',
            'created_at' => 'required|date_format:Y-m-d H:i:s',
        ]);

        return $validator;

    }


    //confirm disbursement of incentives success_statement, error_message, dataArray,
    function confirmDisbursement(Request $request){

        $incentivesIdArray = $request->dataArray;
        $saveStatus = 0;
        if(count($incentivesIdArray) > 0){
            foreach ($incentivesIdArray as $k => $eachIncentiveId){

                $eachIncentiveDetail = $this->investmentRewardCheck::where('unique_id', $eachIncentiveId)->first();

                $eachIncentiveDetail->status = 'done';
                if($eachIncentiveDetail->save()){
                    $saveStatus = 1;
                }

                //check to  the reward check table to make sure no incentive disbursement is pending
                $rewardCheckStatus = $this->investmentRewardCheck->getRowsWhere([
                    ['status', '=', 'pending'],
                    ['investment_unique_id', '=', $eachIncentiveDetail->investment_unique_id]
                ]);
                if(count($rewardCheckStatus) == 0){
                    $rewardCheckStatusForCash = $this->investmentRewardCheck->getRowsWhere([
                        ['status', '=', 'done'],
                        ['reward_type', '=', 'cash'],
                        ['investment_unique_id', '=', $eachIncentiveDetail->investment_unique_id]
                    ]);
                    if(count($rewardCheckStatusForCash) == 1){//check if the ash reward count is 1
                        $investmentDetails = $this->investmentStore->getSingleRow($eachIncentiveDetail->investment_unique_id);
                        $investmentDetails->status = 'done';
                        $investmentDetails->save();
                    }
                }

            }
        }


        if($saveStatus == 1){
            return response()->json(['status'=>true, 'success_statement'=>'Selected Incentives has been marked as done']);
        }
        return response()->json(['status'=>false, 'error_message'=>'An error occurred please try again']);

    }


}
