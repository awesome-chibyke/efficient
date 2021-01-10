<?php

namespace App\Models;

use App\Traits\Generics;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CurrencyRatesModel extends Model
{
    use HasFactory, Generics;

    //primary key
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    //select all the models
    function getBulkModels($orderColumn = 'id', $orderPattern = 'DESC'){

        $currencyDetails = CurrencyRatesModel::orderBy($orderColumn, $orderPattern)->get();

        return $currencyDetails;
    }

    //select one model
    function getOneModels($id){

        $currencyDetails = CurrencyRatesModel::find($id);

        return $currencyDetails;
    }

    function getAmountForView($amount_sent_in = 0){

        $userObject = Auth::user();
        $amountDetails = CurrencyRatesModel::calculateExchangeRate($userObject, $amount_sent_in, $type_of_action = 'sending_to_view');
        return $amountDetails;

    }

    function getAmountForDbWithNoAuth($amount){
        $appSettings = new AppSettings();
        $appSettings = $appSettings->getSingleModel();
        $appSettings->prefered_currency = $this->returnMainCurrencyUniqueId();
        $userObject = $appSettings;
        $amountDetails = CurrencyRatesModel::calculateExchangeRate($userObject, $amount, 'sending_to_db');
        return $amountDetails;

    }

    function getAmountForDatabase($amount_sent_in = 0){

        $userObject = Auth::user();
        $amountDetails = CurrencyRatesModel::calculateExchangeRate($userObject, $amount_sent_in, $type_of_action = 'sending_to_db');
        return $amountDetails;

    }

    //get the currency exchange rate
    public STATIC function calculateExchangeRate($userObject, $amount_sent_in = 0, $type_of_action = 'sending_to_view'){

        //base currency is EUR
        //$type_of_action = ('sending_to_view', 'sending_to_db')

        $choosen_currency_id = $userObject->preferred_currency;

        //select the currency
        $currency_details = CurrencyRatesModel::find($choosen_currency_id);
        $rate = $currency_details->rate_of_conversion;

        //$type_of_action = ('sending_to_view', 'sending_to_db')
        if($type_of_action === 'sending_to_view'){
            //1EUR = $rate for choosen currency
            //$amount_sent_in EUR = ?
            $amount = $amount_sent_in * $rate;
            //$amount = round($amount);
        }

        if($type_of_action === 'sending_to_db'){
            //1EUR = $rate for choosen currency
            //? EUR   =  $amount_sent_in;
            $amount = $amount_sent_in / $rate;
            //$amount = round($amount);
        }

        return [
            'error_code'=>0,
            'error'=>'',
            'data'=>[
                'amount'=>$amount,
                'currency'=>$currency_details->second_currency,
                'currency_id'=>$currency_details->id
            ]
        ];

    }

}
