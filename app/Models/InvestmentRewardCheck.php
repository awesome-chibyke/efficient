<?php

namespace App\Models;

use App\Traits\Generics;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvestmentRewardCheck extends Model
{
    use HasFactory, SoftDeletes, Generics;
    //primary key
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'reward_disbursements';

    function createNewInvestmentRewardCheck($request){
        //unique_id 	investment_settings_id 	reward 	reward_type
        $InvestmentRewardCheck = new InvestmentRewardCheck();
        $InvestmentRewardCheck->unique_id = $this->createUniqueId('reward_disbursements', 'unique_id');
        $InvestmentRewardCheck->investment_unique_id = $request->investment_unique_id;
        $InvestmentRewardCheck->reward_id = $request->reward_id;
        $InvestmentRewardCheck->reward_type = $request->reward_type;
        $InvestmentRewardCheck->status = $request->status;
        $InvestmentRewardCheck->amount = $request->amount;
        $InvestmentRewardCheck->save();
        return $InvestmentRewardCheck;
    }

    function updateInvestRewardCheck($request){
        //unique_id 	investment_settings_id 	reward 	reward_type
        $InvestmentRewardCheck = InvestmentRewardCheck::find($request->unique_id);
        $InvestmentRewardCheck->investment_unique_id = $request->investment_unique_id ?? $InvestmentRewardCheck->investment_unique_id;
        $InvestmentRewardCheck->reward = $request->reward_id ?? $InvestmentRewardCheck->reward_id;
        $InvestmentRewardCheck->reward_type = $request->reward_type ?? $InvestmentRewardCheck->reward_type;
        $InvestmentRewardCheck->amount = $request->amount ?? $InvestmentRewardCheck->amount;
        $InvestmentRewardCheck->status = $request->status ?? $InvestmentRewardCheck->status;
        $InvestmentRewardCheck->save();
        return $InvestmentRewardCheck;
    }

    function EachInvestmentReward(){
        return $this->belongsTo('App\Models\InvestmentReward', 'reward_id');
    }

    //create and return the rewards object
    function createRewardsForInvestment($investmentDetails, $reward, $rewardType, $status = 'pending', $amount = 0){

        $newArray = [
            'investment_unique_id'=>$investmentDetails->unique_id,
            'reward_id'=>$reward,
            'reward_type'=>$rewardType,
            'status'=>$status,
            'amount'=>$amount,
        ];
        return $this->createObject($newArray);
    }

    //get rows where a set of conditions exists
    function getRowsWhere($conditions, $orderColumn = 'created_at', $orderType = 'desc'){

        return InvestmentRewardCheck::where($conditions)->orderBy($orderColumn, $orderType)->get();

    }

}
