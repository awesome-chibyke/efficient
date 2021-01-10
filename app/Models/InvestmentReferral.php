<?php

namespace App\Models;

use App\Traits\Generics;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvestmentReferral extends Model
{
    use HasFactory, SoftDeletes, Generics;

    //primary key
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'referrals';

    function createNewInvestmentReferral($request){
        //unique_id 	investment_settings_id 	referral_id 	referred_user_id 	referrer_user_id
        $InvestmentReferral = new InvestmentReferral();
        $InvestmentReferral->unique_id = $this->createUniqueId('referrals', 'unique_id');
        $InvestmentReferral->investment_unique_id = $request->investment_unique_id;
        $InvestmentReferral->referral_id = $request->referral_id;
        $InvestmentReferral->referred_user_id = $request->referred_user_id;
        $InvestmentReferral->referrer_user_id = $request->referrer_user_id;
        $InvestmentReferral->save();
        return $InvestmentReferral;
    }

    function updateInvestmentReferral($request){
        //investment_settings_id 	referral_id 	referred_user_id 	referrer_user_id
        $InvestmentReferral = InvestmentReferral::find($request->unique_id);
        $InvestmentReferral->investment_unique_id = $request->investment_unique_id ?? $InvestmentReferral->investment_unique_id;
        $InvestmentReferral->referral_id = $request->referral_id ?? $InvestmentReferral->referral_id;
        $InvestmentReferral->referred_user_id = $request->referred_user_id ?? $InvestmentReferral->referred_user_id;
        $InvestmentReferral->referrer_user_id = $request->referrer_user_id ?? $InvestmentReferral->referrer_user_id;
        $InvestmentReferral->save();
        return $InvestmentReferral;
    }

    function InvestmentDetails(){
        return $this->belongsTo('App\Models\InvestmentStore', 'referral_id');
    }

    function MainInvestmentDetails(){
        return $this->belongsTo('App\Models\InvestmentStore', 'investment_unique_id');
    }

    function InvestmentDetails2($referral_id){
        return InvestmentStore::where('referral_id', $referral_id)->first();
    }

}
