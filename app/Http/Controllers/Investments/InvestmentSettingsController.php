<?php

namespace App\Http\Controllers\Investments;

use App\Http\Controllers\Controller;
use App\Models\CurrencyRatesModel;
use App\Models\InvestmentReward;
use App\Models\InvestmentSettings;
use App\Traits\Generics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use mysql_xdevapi\Exception;

class InvestmentSettingsController extends Controller
{

    use Generics;

    function __construct(InvestmentSettings $investmentSettings, InvestmentReward $investmentReward, CurrencyRatesModel $currencyRatesModel)
    {

        $this->middleware('auth');
        $this->investmentSettings = $investmentSettings;
        $this->investmentReward = $investmentReward;
        $this->currencyRatesModel = $currencyRatesModel;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.investment_settings');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }//delete_reward

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createInvestmentPlan(Request $request)
    {

        $validate = $this->Validator($request);
        if($validate->fails()){
            return Redirect::back()->withErrors($validate->getMessageBag());
        }
//unique_id 	name_of_plan 	amount 	amount_for_referral 	amount_for_no_referral 	duration_for_referral_reward 	number_to_be_referred 	form_fee 	no_of_days_before_reward_collection 	maximum_no_of_referral
        try{
            $data = $request->all();

            //insert data investment table
            $request->amount = $this->currencyRatesModel->getAmountForDatabase($request->amount)['data']['amount'];
            $request->amount_for_referral = $this->currencyRatesModel->getAmountForDatabase($request->amount_for_referral)['data']['amount'];
            $request->amount_for_no_referral = $this->currencyRatesModel->getAmountForDatabase($request->amount_for_no_referral)['data']['amount'];
            $investmentSettings = $this->investmentSettings->createNewInvestmentSetting($request);
            if($investmentSettings){
                //loop through the  reward and send to the db
                foreach($data['reward'] as $k => $each_reward_type){
                    $investmentSettings->investment_settings_id  = $investmentSettings->unique_id;
                    $investmentSettings->reward = $data['reward'][$k];
                    $InvestmentReward = $this->investmentReward->createNewInvestmentReward($investmentSettings);
                    if($InvestmentReward){
                        $insertCheck = 1;
                    }
                }

            }
            if($insertCheck == 1){
                return Redirect::back()->with('success_message', 'Plan Settings was successfully stored');
            }

        }catch(\Exception $exception){
            $error = $exception->getMessage();
            return Redirect::back()->with('error_message', $error);
        }

    }

    //function that validates the inputs
    protected function Validator($request){

        $validator = Validator::make($request->all(), [
            'name_of_plan' => 'required',
            'amount' => 'required|numeric|min:1',
            'amount_for_referral' => 'required|numeric|min:1',
            'amount_for_no_referral' => 'required|numeric|min:1',
            'duration_for_referral_reward' => 'required|numeric|min:1',
            //'number_to_be_referred' => 'required|numeric|min:1',
            'form_fee' => 'required|numeric|min:1',
            'no_of_days_before_reward_collection' => 'required|numeric|min:1',
            'maximum_no_of_referral' => 'required|numeric|min:1',
            'reward' => 'required|array|min:1',
            'reward.*' => 'required|min:3',
        ]);

        return $validator;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewInvestmentPlans($investmentId = '')
    {
        $investments = $this->investmentSettings->getAllRows('created_at', 'ASC');
        return view('dashboard.view_investment_settings', ['investmentSettings'=>$investments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($investmentSettingsId)
    {
        $investmentPlan = $this->investmentSettings->getSingleRow($investmentSettingsId);
        return view('dashboard.edit_investment_plan', ['investmentPlan'=>$investmentPlan]);
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

    protected function ValidateValueForPlanDelete($request){//amount reward_type reward

        $validator = Validator::make($request->all(), [
            'dataArray' => 'required|array',
            'dataArray.*' => 'required|min:1',
        ]);

        return $validator;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletePlans(Request $request)
    {

        $validate = $this->ValidateValueForPlanDelete($request);
        if($validate->fails()){
            return Redirect::back()->withErrors($validate->getMessageBag());
        }

        //do the delete
        $datasToDelete = $request->dataArray; $deleteUpdate = 0;
        foreach($datasToDelete as $k => $eachDataToDelete){

            $singleInvestmentPlan = $this->investmentSettings->getSingleRow($eachDataToDelete);
            $allRewards = $singleInvestmentPlan->rewardsDetails;
            $allInvestmentDetails = $singleInvestmentPlan->InvestmentDetails;

            if(count($allRewards) > 0){//dlete rewards
                foreach($allRewards as $kk => $eachReward){
                    $eachReward->delete();
                }
            }
            if(count($allInvestmentDetails) > 0){//delete investments ReferralDetails
                foreach($allInvestmentDetails as $kkk => $eachInvestmentDetails){
                    $allReferralDetails = $eachInvestmentDetails->ReferralDetails;
                    if(count($allReferralDetails) > 0){//delete rewards
                        foreach($allReferralDetails as $kk => $eachReferralDetail){//delete the referrla details connected to each investment
                            $eachReferralDetail->delete();////delete the referrla details connected to each investment
                        }
                    }
                    $eachInvestmentDetails->delete();//delete each investment
                }
            }
            if($singleInvestmentPlan->delete()){
                $deleteUpdate = 1;
            }
        }
        if($deleteUpdate == 1){
            return response()->json(['error_code'=>0, 'success_statement'=>'selected Settings details have been deleted successfully']);
        }
        return response()->json(['error_code'=>1, 'error_statement'=>'An error occurred, transaction failed']);

    }

    public function updateInvestmentPlan(Request $request, $investmentPlanId)
    {

        $validate = $this->ValidatorForInvestmentUpdate($request);
        if($validate->fails()){
            return $validate->getMessageBag();
            return Redirect::back()->withErrors($validate->getMessageBag());
        }

        try{
            $data = $request->all();

            //update the investment sttings table
            $insertCheck = 0;
            $request->amount = $this->currencyRatesModel->getAmountForDatabase($request->amount)['data']['amount'];
            $request->amount_for_referral = $this->currencyRatesModel->getAmountForDatabase($request->amount_for_referral)['data']['amount'];
            $request->amount_for_no_referral = $this->currencyRatesModel->getAmountForDatabase($request->amount_for_no_referral)['data']['amount'];
            $request->unique_id = $investmentPlanId;
            $investmentSettings = $this->investmentSettings->updateInvestmentSettings($request);

            if($investmentSettings){
                //loop through the  reward and send to the db
                foreach($data['reward'] as $k => $each_reward_type){
                    $newArray['investment_settings_id']  = $investmentSettings->unique_id;
                    $newArray['reward'] = $data['reward'][$k];

                    if($data['reward_unique_id'][$k] === null){
                        $object = json_decode(json_encode($newArray));
                        $InvestmentReward = $this->investmentReward->createNewInvestmentReward($object);
                    }else{
                        $newArray['unique_id'] = $data['reward_unique_id'][$k];
                        $object = json_decode(json_encode($newArray));
                        $InvestmentReward = $this->investmentReward->updateInvestReward($object);
                    }
                    if($InvestmentReward){
                        $insertCheck = 1;
                    }
                }
//delete_reward[], reward_unique_id[]
                $this->deleteRewards($request);

            }
            if($insertCheck == 1){
                return Redirect::back()->with('success_message', 'Plan Settings was successfully updated');
            }

        }catch(\Exception $exception){
            $error = $exception->getMessage();
            return Redirect::back()->with('error_message', $error);
        }

    }

    function deleteRewards($request){

        if(isset($request->delete_reward)){//delete the rewards the user wants to delete
            $rewardIdArray = $request->delete_reward;
            if(count($rewardIdArray) == 1){
                if($rewardIdArray[0] == null){
                    $rewardIdArray = [];
                }
            }
            if(count($rewardIdArray) > 0){
                foreach($rewardIdArray as $k => $eachRewardId){
                    $eachRewardDetail = $this->investmentReward->getSingleRow($eachRewardId);
                    $eachRewardDetail->delete();
                }
            }
        }

    }

    protected function ValidatorForInvestmentUpdate($request){//amount reward_type reward

        $validator = Validator::make($request->all(), [
            'name_of_plan' => 'required',
            'amount' => 'required|numeric|min:1',
            'amount_for_referral' => 'required|numeric|min:1',
            'amount_for_no_referral' => 'required|numeric|min:1',
            'duration_for_referral_reward' => 'required|numeric|min:1',
            //'number_to_be_referred' => 'required|numeric|min:1',
            'form_fee' => 'required|numeric|min:1',
            'no_of_days_before_reward_collection' => 'required|numeric|min:1',
            'maximum_no_of_referral' => 'required|numeric|min:1',
            'reward' => 'required|array|min:1',
            'reward.*' => 'required|min:3',
        ]);

        return $validator;

    }


}
