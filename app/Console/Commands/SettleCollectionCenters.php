<?php

namespace App\Console\Commands;

use App\Models\AppSettings;
use App\Models\CurrencyRatesModel;
use App\Models\InvestmentReferral;
use App\Models\InvestmentReward;
use App\Models\InvestmentRewardCheck;
use App\Models\InvestmentSettings;
use App\Models\InvestmentStore;
use App\Models\PaymentGatewayBox;
use App\Models\TransactionModel;
use App\Models\User;
use App\Traits\Generics;
use Exception;
use Illuminate\Console\Command;

class SettleCollectionCenters extends Command
{
    use Generics;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'settle:centers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Settle Collection centers with fees accrued from form';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    function __construct(InvestmentSettings $investmentSettings, InvestmentReward $investmentReward, CurrencyRatesModel $currencyRatesModel, User $user, InvestmentStore $investmentStore, InvestmentReferral $investmentReferral, AppSettings $appSettings, InvestmentRewardCheck $investmentRewardCheck, TransactionModel $transactionModel)
    {

        parent::__construct();
        $this->investmentSettings = $investmentSettings;
        $this->investmentReward = $investmentReward;
        $this->currencyRatesModel = $currencyRatesModel;
        $this->user = $user;
        $this->investmentStore = $investmentStore;
        $this->investmentReferral = $investmentReferral;
        $this->appSettings = $appSettings;
        $this->investmentRewardCheck = $investmentRewardCheck;
        $this->transactionModel = $transactionModel;

    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->payCenterAmounts();
        echo 'success';
    }

    function payCenterAmounts(){

        $investmentsWithPendingCenterFeeSettlement = $this->investmentStore->getRowsWhere([
            ['form_amount_dispensation_status', '=', 'pending']
        ]);

        $bulk_data = [];//initialize an empty array for the bulk payment payload
        $totalAmount = 0;
        //loop through the selected investments
        foreach($investmentsWithPendingCenterFeeSettlement as $k => $eachInvestment){

            //check if the centers connected each has an account number
            $centerDetails = $eachInvestment->UserDetails->centers;
            if($centerDetails === null){ continue; }
            if($centerDetails->bank_code === null || $centerDetails->bank_code === ''){ continue; }

            $bulk_data[] = [
                "bank_code"=>$centerDetails->bank_code,
                "account_number"=>$centerDetails->account_number,
                "amount"=>round($eachInvestment->form_amount * $centerDetails->currency_details->rate_of_conversion),
                "currency"=>$centerDetails->currency_details->second_currency,
                "narration"=>'Payment of ('.$centerDetails->currency_details->second_currency.') '.round($eachInvestment->form_amount * $centerDetails->currency_details->rate_of_conversion).' for accrued from from sales to '.$centerDetails->team,
                "reference"=>$eachInvestment->unique_id
            ];

            $totalAmount += $eachInvestment->form_amount;

        }

        if(count($bulk_data) > 0){

            $flutter_wave_details = PaymentGatewayBox::getFlutterWaveDetails();
            if($flutter_wave_details['error_code'] == 1){
                return;
            }
            $secKey = $flutter_wave_details['data']['gate_way_manager_fields']['secret_key'];

            $payment_data = [
                "title"=>'Form Fee Dispensation to Collection Centers',
                "bulk_data"=>$bulk_data,
            ];

            $response = $this->commencePayment($payment_data, $secKey);
            if($response['error_code'] == 1){
                return;
            }

            //loop through and update payments to processing
            foreach($investmentsWithPendingCenterFeeSettlement as $k => $eachInvestment){
                $eachInvestment->form_amount_dispensation_status = 'processing';
                $eachInvestment->form_amount_dispensation_status->save();
            }

            $this->retrieveStatusOfBulkTransfer();

            //return Redirect::back()->with('success_message', $response['payment_response']['message']);
            return response()->json(['error_code'=>0, 'success_message'=>$response['data']['payment_response']['message'], 'data'=>$response['data']['payment_response'] ]);

        }

    }

    function retrieveStatusOfBulkTransfer(){

        try{

            //get the flutterwave details
            $flutter_wave_details = PaymentGatewayBox::getFlutterWaveDetails();
            if($flutter_wave_details['error_code'] == 1){
                throw new Exception($flutter_wave_details['error']);
                return;
            }
            $secKey = $flutter_wave_details['data']['gate_way_manager_fields']['secret_key'];

            //get all the processing withdrawals
            $pendingSettlementPayment = $this->investmentStore->getRowsWhere([
                ['form_amount_dispensation_status', '=', 'processing']
            ]);
            if(count($pendingSettlementPayment) > 0){

                $curl = curl_init();
                ///"Content-Type: application/json"
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.flutterwave.com/v3/transfers/",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "Authorization: Bearer $secKey"
                    ),
                ));

                $response = curl_exec($curl);
                curl_close($curl);
                $results = json_decode($response, true);

                if($results['status'] !== 'success'){
                    throw new Exception($results['message']);
                    return;
                }

                $allTransfers = $results['data'];//

                foreach($pendingSettlementPayment as $k => $eachPendingPayment){//loops through the pending payments

                    foreach ($allTransfers as $l => $eachTransferObject) {

                        if($eachPendingPayment->unique_id === $eachTransferObject['reference']){

                            if($eachTransferObject['status'] === 'SUCCESSFUL'){

                                $amount = $eachTransferObject['amount'];
                                $eachPendingPayment->status = 'confirmed';
                                $eachPendingPayment->save();
                            }

                        }

                    }

                }

                return [
                    'error_code'=>0,
                    'error'=>['pendingWithdrawalPayment'=>$pendingSettlementPayment, 'allTransfers'=>$allTransfers],
                    'data'=>[]
                ];

            }

        }catch(Exception $exception){
            $error = $exception->getMessage();
            return [
                'error_code'=>1,
                'error'=>$error,
                'data'=>[]
            ];
        }

    }

}
