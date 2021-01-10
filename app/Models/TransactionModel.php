<?php

namespace App\Models;

use App\Models\CurrencyRatesModel;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Traits\Generics;

class TransactionModel extends Model
{
    use HasFactory, Generics;

    //primary key
    protected $primaryKey = 'unique_id';
    public $incrementing = false;

    public function user_details(){
        return $this->belongsTo('App\Models\User', 'user_unique_id');
    }

    public function investment(){
        return $this->belongsTo('App\Models\InvestmentStore', 'reference');
    }

    function getAmountForView($amount_sent_in = 0){

        $userObject = Auth::user();
        $amountDetails = CurrencyRatesModel::calculateExchangeRate($userObject, $amount_sent_in, $type_of_action = 'sending_to_view');
        return $amountDetails;

    }

    function getAmountForViewForEmail($amount_sent_in = 0, $userId){

        $userObject = User::find($userId);
        $amountDetails = CurrencyRatesModel::calculateExchangeRate($userObject, $amount_sent_in, $type_of_action = 'sending_to_view');
        return $amountDetails;

    }

    function getAmountForDatabase($amount_sent_in = 0){

        $userObject = Auth::user();
        $amountDetails = CurrencyRatesModel::calculateExchangeRate($userObject, $amount_sent_in, $type_of_action = 'sending_to_db');
        return $amountDetails;

    }

    function insertIntoTransactionModel($requestObject){

        $transaction = new TransactionModel();
        $transaction->unique_id = $requestObject->unique_id;//$this->createUniqueId('transaction_models', 'unique_id');
        $transaction->user_unique_id = $requestObject->user_unique_id;
        $transaction->type_of_user = $requestObject->type_of_user ?? '';
        $transaction->amount = $requestObject->amount;
        $transaction->description = $requestObject->description;
        $transaction->action_type = $requestObject->action_type;
        $transaction->status = $requestObject->status;
        $transaction->reference = $requestObject->reference ?? '';
        $transaction->country = $requestObject->country ?? '';
        $transaction->customer = $requestObject->customer ?? '';
        $transaction->biller_name = $requestObject->biller_name ?? '';
        $transaction->is_airtime = $requestObject->is_airtime ?? 'no';
        $transaction->is_bill_or_airtime = $requestObject->is_bill_or_airtime ?? 'no';
        $transaction->recurrence = $requestObject->recurrence ?? '';
        $transaction->top_up_option = $requestObject->top_up_option ?? '';
        $transaction->is_deleted = 'no';
        if($transaction->save()){
            return $transaction;
        }

    }

    function updateTransactionModel($requestObject){

        $transaction = TransactionModel::find($requestObject->id);
        $transaction->school_id = $requestObject->school_id ?? $transaction->school_id;
        $transaction->amount = $requestObject->amount ?? $transaction->amount;
        $transaction->commission = $requestObject->commission ?? $transaction->commission;
        $transaction->description = $requestObject->description ?? $transaction->description;
        $transaction->action_type = $requestObject->action_type ?? $transaction->action_type;
        $transaction->status = $requestObject->status ?? $transaction->status;
        $transaction->reference = $requestObject->reference ?? $transaction->reference;
        $transaction->country = $requestObject->country ?? $transaction->country;
        $transaction->customer = $requestObject->customer ?? $transaction->customer;
        $transaction->recurrence = $requestObject->recurrence ?? $transaction->recurrence;
        $transaction->is_deleted = $requestObject->is_deleted ?? $transaction->is_deleted;
        $transaction->deleted_at = $requestObject->deleted_at ?? $transaction->deleted_at;
        if($transaction->save()){
            return $transaction;
        }

    }

    function selectSingleTransactionModel($id){
        return TransactionModel::find($id);
    }

    //get all for a user
    function getAllWhere($userId, $orderColumn = 'created_at', $orderType = 'desc'){
        $userDetails = TransactionModel::where('user_unique_id', $userId)->orderBy($orderColumn, $orderType)->get();
        return $userDetails;
    }

    //get all for a user
    function getAllWithConditions($conditions, $orderColumn = 'created_at', $orderType = 'desc', $paginate = 'no', $rowNo = 20){
        if($paginate === 'no'){
            $userDetails = TransactionModel::where($conditions)->orderBy($orderColumn, $orderType)->get();
        }else{
            $userDetails = TransactionModel::where($conditions)->orderBy($orderColumn, $orderType)->simplePaginate($rowNo);
        }
        return $userDetails;
    }

    //get all for a user
    function getAll($orderColumn = 'created_at', $orderType = 'desc'){
        $transactionDetails = TransactionModel::orderBy($orderColumn, $orderType)->get();
        return $transactionDetails;
    }

    function getSingleRow($uniqueId){
        return TransactionModel::where('unique_id', $uniqueId)->first();
    }

    //get all confirmed transactions
    function getConfirmedTransactions($ref){

        $transactionDetails = TransactionModel::where('unique_id', $ref)->where('status', 'confirmed')->first();
        return $transactionDetails;

    }


    //get withdrwawls
    function getWithdrawals($userId = '', $orderColumn = 'created_at', $order = 'desc'){
        if($userId === ''){
            $withdrawals = TransactionModel::where('action_type', 'withdrawal')->orderBy($orderColumn, $order)->get();
        }else{
            $withdrawals = TransactionModel::where('action_type', 'withdrawal')->where('user_unique_id', $userId)->get();
        }

        return $withdrawals;

    }

}
