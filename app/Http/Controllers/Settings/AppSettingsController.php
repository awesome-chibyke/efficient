<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\AppSettings;
use App\Models\BankDetails;
use App\Models\CurrencyRatesModel;
use App\Models\TransactionModel;
use App\Models\TypeOfGame;
use App\Models\PaymentGatewayBox;
use App\Traits\ErrorHelper;
use App\Traits\Generics;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AppSettingsController extends Controller
{

    use Generics, ErrorHelper;

    var $validator;

    function __construct(\App\Models\AppSettings $appSettings, TypeOfGame $typeOfGame, CurrencyRatesModel $currencyRatesModel, TransactionModel $transactionModel, BankDetails $bankDetails)
    {
        $this->middleware('auth');
        $this->appSettings = $appSettings;
        $this->typeOfGame = $typeOfGame;
        $this->currencyRatesModel = $currencyRatesModel;
        $this->transactionModel = $transactionModel;
        $this->bankDetails = $bankDetails;

    }

    protected function Validator($request){

        $this->validator = Validator::make($request->all(), [//site_name 	address1 	address2 	email1 	site_url
            'site_name'              => 'nullable|string',
            'address1'         => 'nullable|string',
            'address2'          => 'nullable|string',
            'email1'        => 'nullable|string',
            'site_url'          => 'nullable|string',
            'email2'            => 'nullable|string',
            'logo_url'            => 'nullable|string'
        ]);

    }

    function createGameType(Request $request){
        $create = $this->typeOfGame->insertGameTypeIntoModel($request);

        if ($create){
            return  redirect('create_game')->with('success_message', 'Game Type Was Successfully Created');
        }else{
            return  redirect('create_game_type')->with('error_message', 'An error occurred, please try again');
        }

    }

    function createAppSettings(Request $request){
        $create = $this->appSettings->insertIntoModel($request);

        if ($create){
            return  redirect('settings_page')->with('success_message', 'App Settings Was Successfully Created');
        }else{
            return  redirect('settings_page')->with('error_message', 'An error occurred, please try again');
        }

    }

    protected function handleValidation($request){

        $validator = Validator::make($request, [//site_name 	address1 	address2 	email1 	site_url
            'site_name'              => 'nullable|string',
            'address1'         => 'nullable|string',
            'address2'          => 'nullable|string',
            'email1'        => 'nullable|string',
            'site_url'          => 'nullable|string',
            'email2'            => 'nullable|string',
            'logo_url'            => 'nullable|string'
        ]);
        return $validator;

    }

    function storeAppSettings(Request $request, $appSettingId = ''){

        //try{

            $validation = $this->handleValidation($request->all());
            if($validation->fails()){
                return redirect()->route('main_settings_page')->withErrors($validation);
            }

            $request->id = $appSettingId;
            $request->least_withdrawable_amount = $this->transactionModel->getAmountForDatabase($request->least_withdrawable_amount)['data']['amount'];
            $appSettings = $this->appSettings->updateModel($request);
            $appSettings->unique_id = $appSettingId;

            $paymentGateWay = PaymentGatewayBox::where('keyword','flutter_wave')->first();//update the payment gateway
            $paymentGateWay->gateway_manager = $request->public_key.','.$request->secret_key.','.$request->encrypt_key;
            $paymentGateWay->save();

            //update the bank details bank_code bank_name bank_account_no account_name bankUniqueId
            //return $data = $request->all();//insertIntoModel updateModel
            if(count($request->bank_code) > 0){
                for($i = 0; $i < count($request->bank_code); $i++){
                    $paymentGateWay = PaymentGatewayBox::where('unique_id','RCE3401a47t02')->first();
                    if($request->bankUniqueId[$i] === null){
                        $bankObj = $this->createBankDetailsObj($paymentGateWay, $request, $i, 'create');
                        $this->bankDetails->insertIntoModel($bankObj);
                    }else{
                        $bankObj = $this->createBankDetailsObj($paymentGateWay, $request, $i, 'update');
                        $this->bankDetails->updateModel($bankObj);
                    }

                }
            }

            $successMessage = 'Update was successful';
            if($appSettings){
                return  redirect('main_settings_page')->with('success_message', $successMessage);
            }

            /*throw new Exception('An error occurred, please try again');

        }catch (Exception $exception){

            $errorsArray = $exception->getMessage();
            return  redirect()->route('main_settings_page')->with('error_message', $errorsArray);

        }*/

    }

    //create object for insert and update of bank
    function createBankDetailsObj($paymentGateWay, $request, $i, $option = 'create'){
        $newArray = [];
        if($option === 'create'){
            $newArray['unique_id'] = $this->createUniqueId('bank_details', 'unique_id');
        }else{
            $newArray['unique_id'] = $request->bankUniqueId[$i];
        }
        $newArray['bank_code'] = $request->bank_code[$i];
        $newArray['bank_name'] = $request->bank_name[$i];
        $newArray['bank_account_no'] = $request->bank_account_no[$i];
        $newArray['account_name'] = $request->account_name[$i];
        return json_decode(json_encode($newArray));

    }

    function showAppSettings($id = 'hfjsdhfjhdsk'){//public_key secret_key encrypt_key
        $flutterWaveKeys = PaymentGatewayBox::where('keyword', 'flutter_wave')->first();
        $explodedFlutterWaveKey  = explode(',',$flutterWaveKeys->gateway_manager);

        //get the banks details
        $allBanks = BankDetails::all();

        $appSettings = $this->appSettings->getSingleModel();
        $appSettings->public_key = $explodedFlutterWaveKey[0];
        $appSettings->secret_key = $explodedFlutterWaveKey[1];
        $appSettings->encrypt_key = $explodedFlutterWaveKey[2];

        return view('dashboard.mainSettingsPage', ['appSettings'=>$appSettings, 'allBanks'=>$allBanks]);

    }

    public function displayAppSettings(){

        $appSettings = $this->appSettings->getSingleModel();
        $allCurrency = $this->currencyRatesModel->getBulkModels('id', 'DESC');
        $UserDetails = Auth::user();
        $fileterdCurrencies = $this->currencyFlutterWaveCurrencyArray($allCurrency);
        $data = $this->createArrayForView(['appSettings'=>$appSettings, 'allCurrency'=>$fileterdCurrencies, 'UserDetails'=>$UserDetails]);
        return view('dashboard.settingsPage', $data);
    }

    function getAccountDetails(){

        $accountDetails = $this->bankDetails->getAllBankdetails();
        return view('dashboard.bank_details', ['accountDetails'=>$accountDetails]);

    }//get the bank details for display

    function deletebankDetails(Request $request){//deleteBankDetails

        $BankUniqueId = $request->dataArray;
        $deleteStatus = 0;
        foreach($BankUniqueId as $eachID){
            $bankDetails = $this->bankDetails->getOneBankdetail($eachID);
            if($bankDetails !== null){
                $bankDetails->delete();
                $deleteStatus = 1;
            }
        }
        if($deleteStatus == 1){
            return response()->json(['error_code'=>0, 'success_statement'=>'selected Bank details have been deleted successfully']);
        }
        return response()->json(['error_code'=>1, 'error_statement'=>'An error occurred, transaction failed']);

    }

}
