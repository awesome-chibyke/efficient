<?php

namespace App\Models;

use App\Traits\Generics;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class InvestmentSettings extends Model
{
    use HasFactory, SoftDeletes, Generics;

    //primary key
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'investment_settings';

    function createNewInvestmentSetting($request){
        //unique_id 	name_of_plan 	amount 	amount_for_referral 	amount_for_no_referral 	duration_for_referral_reward 	number_to_be_referred 	form_fee 	no_of_days_before_reward_collection 	maximum_no_of_referral
        $InvestmentSettings = new InvestmentSettings();
        $InvestmentSettings->unique_id = $this->createUniqueId('investment_settings', 'unique_id');
        $InvestmentSettings->name_of_plan = $request->name_of_plan;
        $InvestmentSettings->amount = $request->amount;
        $InvestmentSettings->amount_for_referral = $request->amount_for_referral;
        $InvestmentSettings->amount_for_no_referral = $request->amount_for_no_referral;
        $InvestmentSettings->duration_for_referral_reward = $request->duration_for_referral_reward;
        $InvestmentSettings->number_to_be_referred = $request->number_to_be_referred;
        $InvestmentSettings->form_fee = $request->form_fee;
        $InvestmentSettings->no_of_days_before_reward_collection = $request->no_of_days_before_reward_collection;
        $InvestmentSettings->maximum_no_of_referral = $request->maximum_no_of_referral;
        $InvestmentSettings->save();
        return $InvestmentSettings;//
    }

    function updateInvestmentSettings($request){
        ////unique_id 	name_of_plan 	amount 	amount_for_referral 	amount_for_no_referral 	duration_for_referral_reward 	number_to_be_referred 	form_fee 	no_of_days_before_reward_collection 	maximum_no_of_referral
        $InvestmentSettings = InvestmentSettings::find($request->unique_id);
        $InvestmentSettings->name_of_plan = $request->name_of_plan ?? $InvestmentSettings->name_of_plan;
        $InvestmentSettings->amount = $request->amount ?? $InvestmentSettings->amount;
        $InvestmentSettings->amount_for_referral = $request->amount_for_referral ?? $InvestmentSettings->amount_for_referral;
        $InvestmentSettings->amount_for_no_referral = $request->amount_for_no_referral ?? $InvestmentSettings->amount_for_no_referral;
        $InvestmentSettings->duration_for_referral_reward = $request->duration_for_referral_reward ?? $InvestmentSettings->duration_for_referral_reward;
        $InvestmentSettings->number_to_be_referred = $request->number_to_be_referred ?? $InvestmentSettings->number_to_be_referred;
        $InvestmentSettings->form_fee = $request->form_fee ?? $InvestmentSettings->form_fee;
        $InvestmentSettings->no_of_days_before_reward_collection = $request->no_of_days_before_reward_collection ?? $InvestmentSettings->no_of_days_before_reward_collection;
        $InvestmentSettings->maximum_no_of_referral = $request->maximum_no_of_referral ?? $InvestmentSettings->maximum_no_of_referral;
        $InvestmentSettings->save();
        return $InvestmentSettings;
    }

    function getSingleRow($uniqueId){

        return InvestmentSettings::find($uniqueId);

    }

    function getAllRows($orderColumn = 'created_at', $orderType = 'desc'){

        return InvestmentSettings::orderBy($orderColumn, $orderType)->get();

    }

    function getAtivePlans($investmentSettingsId){
        if(Auth::check()){
            $userDetails = Auth::user();
            if($userDetails->type_of_user !== 'user'){
                return InvestmentStore::where('investment_settings_id', $investmentSettingsId)->where('status', 'active')->get();
            }
            return InvestmentStore::where('investment_settings_id', $investmentSettingsId)->where('user_unique_id',$userDetails->unique_id)->where('status', 'active')->get();
        }

    }

    function getDuePlans($investmentSettingsId){
        if(Auth::check()){
            $userDetails = Auth::user();
            if($userDetails->type_of_user !== 'user'){
                return InvestmentStore::where('investment_settings_id', $investmentSettingsId)->where('status', 'processing_rewards')->get();
            }
            return InvestmentStore::where('investment_settings_id', $investmentSettingsId)->where('user_unique_id',$userDetails->unique_id)->where('status', 'processing_rewards')->get();
        }

    }

    function getInactivePlans($investmentSettingsId){
        if(Auth::check()){
            $userDetails = Auth::user();
            if($userDetails->type_of_user !== 'user'){
                return InvestmentStore::where('investment_settings_id', $investmentSettingsId)->where('status', '=', 'done')->get();
            }
            return InvestmentStore::where('investment_settings_id', $investmentSettingsId)->where('user_unique_id',$userDetails->unique_id)->where('status', '=', 'done')->get();
        }

    }

    function getRowsWhere($conditions, $orderColumn = 'created_at', $orderType = 'desc'){

        return InvestmentSettings::where($conditions)->orderBy($orderColumn, $orderType)->get();

    }

    function rewardsDetails(){
        return $this->hasMany('App\Models\InvestmentReward', 'investment_settings_id');
    }

    function InvestmentDetails(){
        return $this->hasMany('App\Models\InvestmentStore', 'investment_settings_id');
    }

}
