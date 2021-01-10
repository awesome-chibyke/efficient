<?php

namespace App\Models;

use App\Traits\Generics;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvestmentReward extends Model
{
    use HasFactory, SoftDeletes, Generics;

    //primary key
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'reward_table';

    function createNewInvestmentReward($request){
        //investment_settings_id 	reward
        $InvestmentReward = new InvestmentReward();
        $InvestmentReward->unique_id = $this->createUniqueId('reward_table', 'unique_id');
        $InvestmentReward->investment_settings_id = $request->investment_settings_id;
        $InvestmentReward->reward = $request->reward;
        $InvestmentReward->save();
        return $InvestmentReward;
    }

    function updateInvestReward($request){
        ////unique_id 	investment_settings_id 	reward
        $InvestReward = InvestmentReward::find($request->unique_id);
        $InvestReward->investment_settings_id = $request->investment_settings_id ?? $InvestReward->investment_settings_id;
        $InvestReward->reward = $request->reward ?? $InvestReward->reward;
        $InvestReward->save();
        return $InvestReward;
    }

    function getSingleRow($uniqueId){

        return InvestmentReward::find($uniqueId);

    }

    function getSingleRowWhere($conditionArray){

        return InvestmentReward::find($conditionArray);

    }

    function getAllRows($orderColumn = 'created_at', $orderType = 'desc'){

        return InvestmentReward::orderBy($orderColumn, $orderType)->get();

    }

    function getRowsWhere($conditions, $orderColumn = 'created_at', $orderType = 'desc'){

        return InvestmentReward::where($conditions)->orderBy($orderColumn, $orderType)->get();

    }


}
