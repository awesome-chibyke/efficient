<?php

namespace App\Models;

use App\Traits\Generics;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankDetails extends Model
{
    use HasFactory, Generics, SoftDeletes;
    //primary key
    protected $primaryKey = 'unique_id';
    public $incrementing = false;

    function insertIntoModel($request){
        //unique_id 	bank_code 	bank_account_no 	bank_name 	account_name
        $BankDetails = new BankDetails();
        $BankDetails->unique_id = $request->unique_id;
        $BankDetails->bank_code = $request->bank_code;
        $BankDetails->bank_account_no = $request->bank_account_no;
        $BankDetails->bank_name = $request->bank_name;
        $BankDetails->account_name = $request->account_name;
        $BankDetails->save();
        return $BankDetails;
    }

    function updateModel($request){
        //unique_id site_name 	address1 	address2 	email1 	site_url 	deleted_at 	created_at 	updated_at
        $BankDetails = BankDetails::find($request->unique_id);
        $BankDetails->bank_code = $request->bank_code ?? $BankDetails->bank_code ;
        $BankDetails->bank_account_no = $request->bank_account_no ?? $BankDetails->bank_account_no;
        $BankDetails->bank_name = $request->bank_name ?? $BankDetails->bank_name;
        $BankDetails->account_name = $request->account_name ?? $BankDetails->account_name;
        $BankDetails->save();
        return $BankDetails;
    }

    function getOneBankdetail($userID){
        return BankDetails::where('unique_id', $userID)->first();
    }

    function getAllBankdetails($orderColumn = 'created_at', $order = 'desc'){
        return BankDetails::orderBy($orderColumn, $order)->get();
    }


    function getBankdetailsWhere($conditions ,$orderColumn = 'created_at', $order = 'desc'){
        return BankDetails::where($conditions)->orderBy($orderColumn, $order)->get();
    }
}
