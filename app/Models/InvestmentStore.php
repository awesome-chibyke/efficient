<?php

namespace App\Models;

use App\Traits\Generics;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvestmentStore extends Model
{
    use HasFactory, SoftDeletes, Generics;

    //primary key
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'investments';

    function ReferralDetails($refId){
        //return $this->hasMany('App\Models\InvestmentReferral', 'referral_id');
        return InvestmentReferral::where('referral_id', $refId)->get();
    }

    function getAllReferralForAnInvestment($referral_id){
        //return $this->hasMany('App\Models\InvestmentReferral', 'referral_id');
        return InvestmentReferral::where('referral_id', $referral_id)->get();
    }

    function SingleReferralDetails($refId, $referred_user_unique_id){
        return InvestmentReferral::where('referral_id', $refId)->where('referred_user_unique_id', $referred_user_unique_id)->first();
    }

    function InvestmentPlan(){
        return $this->belongsTo('App\Models\InvestmentSettings', 'investment_settings_id');
    }
    function InvestmentRewardCheck(){
        return $this->hasMany('App\Models\InvestmentRewardCheck', 'investment_unique_id');
    }

    function UserDetails(){
        return $this->belongsTo('App\Models\User', 'user_unique_id');
    }

    function UserDetails2($unique){
        return User::where('unique_id', $unique)->first();
    }

    function getSingleRow($uniqueId){

        return InvestmentStore::find($uniqueId);

    }

    function getAllRows($orderColumn = 'created_at', $orderType = 'desc'){

        return InvestmentStore::orderBy($orderColumn, $orderType)->get();

    }

    function getRowsWhere($conditions, $orderColumn = 'created_at', $orderType = 'desc'){

        return InvestmentStore::where($conditions)->orderBy($orderColumn, $orderType)->get();

    }

    function getSingleRowsWhere($conditions){

        return InvestmentStore::where($conditions)->first();

    }

    function createNewInvestment($request){
        //unique_id 	user_unique_id, investment_settings_id 	no_of_days 	time_regulator 	form_amount_dispensation_status 	referral_id
        $InvestmentStore = new InvestmentStore();
        $InvestmentStore->unique_id = $this->createUniqueId('investments', 'unique_id');
        $InvestmentStore->investment_settings_id = $request->investment_settings_id;
        $InvestmentStore->no_of_days = $request->no_of_days;
        $InvestmentStore->time_regulator = $request->time_regulator;
        $InvestmentStore->form_amount_dispensation_status = $request->form_amount_dispensation_status;
        $InvestmentStore->referral_id = $request->referral_id;
        $InvestmentStore->status = $request->status;
        $InvestmentStore->user_unique_id = $request->user_unique_id;
        $InvestmentStore->time_remaining_in_days = $request->time_remaining_in_days;
        $InvestmentStore->save();
        return $InvestmentStore;
    }

    function updateInvestment($request){
        //unique_id, user_unique_id, investment_settings_id, no_of_days, time_regulator, form_amount_dispensation_status, referral_id
        $InvestmentStore = InvestmentStore::find($request->unique_id);
        $InvestmentStore->user_unique_id = $request->user_unique_id ?? $InvestmentStore->user_unique_id;
        $InvestmentStore->investment_settings_id = $request->investment_settings_id ?? $InvestmentStore->investment_settings_id;
        $InvestmentStore->no_of_days = $request->no_of_days ?? $InvestmentStore->no_of_days;
        $InvestmentStore->time_regulator = $request->time_regulator ?? $InvestmentStore->time_regulator;
        $InvestmentStore->form_amount_dispensation_status = $request->form_amount_dispensation_status ?? $InvestmentStore->form_amount_dispensation_status;
        $InvestmentStore->referral_id = $request->referral_id ?? $InvestmentStore->referral_id;
        $InvestmentStore->time_remaining_in_days = $request->time_remaining_in_days ?? $InvestmentStore->time_remaining_in_days;
        $InvestmentStore->status = $request->status ?? $InvestmentStore->status;
        return $InvestmentStore;
    }

    function returnStatusDetails($status){
        $statusArray = ['active', 'done', 'processing_rewards'];
        $statusClassArray = ['warning', 'primary', 'info'];
        $key = array_search($status, $statusArray);
        return $statusClassArray[$key];
    }

}
