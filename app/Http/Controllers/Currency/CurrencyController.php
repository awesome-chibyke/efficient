<?php

namespace App\Http\Controllers\Currency;

use App\Http\Controllers\Controller;
use App\Models\CurrencyRatesModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }

    public function currencyRatesUpdate(){

        //http://data.fixer.io/api/latest?access_key=365f857077fb096dd742d756da77226d&format=1
        $endpoint = 'latest';
        $access_key = 'API_KEY';

        // Initialize CURL:
        $ch = curl_init('http://data.fixer.io/api/latest?access_key=365f857077fb096dd742d756da77226d&format=1');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Store the data:
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        $exchangeRates = json_decode($json, true);

        if($exchangeRates['success'] == true){

            //print_r($exchangeRates['rates']); die();
            foreach($exchangeRates['rates'] as $k => $currency_rates){

                $existing_rate = CurrencyRatesModel::where('second_currency', $k);
                if($existing_rate->count() == 0){

                    $insertRates = new CurrencyRatesModel();

                    $insertRates->unique_id 	= Controller::createUniqueId('currency_rates_models', 'unique_id');
                    $insertRates->base_currency = $exchangeRates['base'];
                    $insertRates->second_currency 	= $k;
                    $insertRates->rate_of_conversion = 	$currency_rates;
                    $insertRates->expression = 	'1 '.$exchangeRates['base'].' = '.$currency_rates.' '.$k;
                    $insertRates->is_deleted = 'no';
                    $insertRates->deleted_on = Carbon::now()->toDateTimeString();
                    $insertRates->save();

                }else{

                    $insertRates = $existing_rate->get();
                    foreach($insertRates as $key => $rates){
                        CurrencyRatesModel::where('id', $rates->id)->update(
                            [
                                'base_currency'=>$exchangeRates['base'],
                                'second_currency'=>$k,
                                'rate_of_conversion'=>$currency_rates,
                                'expression'=>'1 '.$exchangeRates['base'].' = '.$currency_rates.' '.$k,
                                'is_deleted'=>'no',
                                'deleted_on'=>Carbon::now()->toDateTimeString(),
                                'updated_at'=>Carbon::now()->toDateTimeString()
                            ]
                        );
                    }

                }



            }
        }


    }

}
