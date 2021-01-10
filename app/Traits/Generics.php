<?php

namespace App\Traits;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


trait Generics{

    function getAppSettings(){
        $user = null;
        if (Auth::check()) { $user = User::where('unique_id', Auth::user()->unique_id)->first(); }
        //$siteAddress $siteAddress1 $sitePhone $siteEmail
        $appSettings = new \App\Models\AppSettings();
        $Settings = $appSettings->getSingleModel();
        return [
            'fixed_top'=>'',
            'siteWhatsApp'=>'',
            'active8'=>'active',
            'title' => 'Register | Grandour Empowerment Programme',
            'description' => 'Grandour runs a contributive collaboration model of Empowerment. It is a programme of Grandourians by Grandourians and for Grandourians a ground breaking symbiotic paradigm shift in philanthropy.',
            'keyword' => 'Grandour, Empowerment, Programme, Wealth and Capacity building, Techo Craft, Contribution, Investment, Nigeria, Enugu, Anambra, Lagos',
            'siteName' => 'Grandour',
            'siteDomain' => 'grandour.org',
            'sitePhone' => $Settings->phone1,
            'sitePhone1' => $Settings->phone2,
            'siteEmail' => 'info@grandour.org',
            'siteAddress' => $Settings->address1,
            'siteAddress1' => $Settings->address2,
            'siteAddress3' => $Settings->address_3,
            'siteAddress4' => $Settings->address4,
            'siteFacebook' => $Settings->facebook,
            'siteTwitter' => $Settings->twitter,
            'siteInstagram' => $Settings->instagram,
            'siteLinkedin' => $Settings->linkedin,
            'baseurl' => 'http://localhost/GRANDOUR.COM/',
            'currencyArray'=>['BIF', 'CAD', 'CDF', 'CVE', 'EUR', 'GBP', 'GHS', 'GMD', 'GNF', 'KES', 'LRD', 'MWK', 'MZN',
                'NGN', 'RWF', 'SLL', 'STD', 'TZS', 'UGX', 'USD', 'XAF', 'XOF', 'ZMK', 'ZMW', 'ZWD', 'ZAR'],
            'countryCodeArray'=>['BI', 'CA', 'DR', 'CV', 'EU', 'GB', 'GH', 'GM', 'GN', 'KE', 'LRD', 'MWK', 'MZN',
                'NG', 'RW', 'SL', 'ST', 'TZ', 'UG', 'US', 'XA', 'XO', 'ZM', 'ZM', 'ZW', 'ZA'],
            'user'=>$user
        ];

    }

    function currencyFlutterWaveCurrencyArray($mainCurrencyArray){

        $currencyInitials = ['BIF', 'CAD', 'CDF', 'CVE', 'EUR', 'GBP', 'GHS', 'GMD', 'GNF', 'KES', 'LRD', 'MWK', 'MZN',
            'NGN', 'RWF', 'SLL', 'STD', 'TZS', 'UGX', 'USD', 'XAF', 'XOF', 'ZMK', 'ZMW', 'ZWD', 'ZAR'];//array of the needed currencies

        $countryCodeArray = ['BI', 'CA', 'DR', 'CV', 'EU', 'GB', 'GH', 'GM', 'GN', 'KE', 'LRD', 'MWK', 'MZN',
            'NG', 'RW', 'SL', 'ST', 'TZ', 'UG', 'US', 'XA', 'XO', 'ZM', 'ZM', 'ZW', 'ZA'];

        $newCurrencyArray = [];//initialize an array
        if(count($mainCurrencyArray) > 0){

            foreach($mainCurrencyArray as $k => $eachCurrencyArray){

                if(in_array($eachCurrencyArray->second_currency, $currencyInitials) && in_array($eachCurrencyArray->country_abbr, $countryCodeArray)){

                    $newCurrencyArray[] = $eachCurrencyArray;

                }

            }

        }

        return $newCurrencyArray;

    }

    function createObject($array){
        return json_decode(json_encode($array));
    }

    public function random_string ( $type = 'alnum', $len = 60 )
    {
        switch ( $type )
        {
            case 'alnum'	:
            case 'numeric'	:
            case 'nozero'	:

                switch ($type)
                {
                    case 'alnum'	:	$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'numeric'	:	$pool = '0123456789';
                        break;
                    case 'nozero'	:	$pool = '123456789';
                        break;
                }

                $str = '';
                $mdstr = md5 ( uniqid ( mt_rand () ) );
                $mdstrstrlen = strlen($mdstr);
                for ( $i=0; $i < $len; $i++ )
                {
                    $str .= substr ( $pool, mt_rand ( 0, strlen ( $pool ) -1 ), 1 );
                }
                return $str.substr($mdstr, 0, $mdstrstrlen/2);
                break;
            case 'unique' : return md5 ( uniqid ( mt_rand () ) );
                break;
        }
    }

//create a unique id
    public function createUniqueId($table_name, $column){

        /*$unique_id = Controller::picker();*/
        $unique_id = $this->random_string();
        $unique_id = substr($unique_id, 0, strlen($unique_id)/2);

        //check for the database count from the database"unique_id"
        $rowcount = DB::table($table_name)->where($column, $unique_id)->count();

        if($rowcount == 0){

            if(empty($unique_id)){
                $this->createUniqueId($table_name, $column);
            }else{
                return $unique_id;
            }

        }else{
            $this->createUniqueId($table_name, $column);
        }

    }

    function createArrayForView($dataToBePassedToView = [], $status = 'success'){
        $data = $this->getAppSettings();
        if(count($dataToBePassedToView)  > 0){
            foreach($dataToBePassedToView as $k => $values){
                $data[$k] = $values;
            }
        }
        $data['status'] = $status === 'error' ? false : true;
        return $data;
    }

    function hashPassword($password){
        return hash('sha256', md5($password));
    }

//    function mailSender($to_name, $to_email, $senderrName){
//
//        $data = ['name'=>$senderrName, "body" => ];
//        Mail::send(‘emails.mail’, $data, function($message) use ($to_name, $to_email) {$message->to($to_email, $to_name)->subject(Laravel Test Mail’);$message->from(‘SENDER_EMAIL_ADDRESS’,’Test Mail’);});
//
//    }

    public function commencePayment($post_data, $secKey){

        $data_string = json_encode($post_data);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.flutterwave.com/v3/bulk-transfers/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>$data_string,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer $secKey"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $resp = json_decode($response, true);

        if($resp['status'] === 'success'){
            return [
                'error_code'=>0,
                'error'=>'',
                'data'=>[
                    'payment_response'=>$resp
                ]
            ];
        }

        return [
            'error_code'=>1,
            'error'=>'Payment processing failed',
            'data'=>[]
        ];

    }

    function validateImage($acceptedFileType = ['jpeg','jpg','png','gif','webp'], $fileName = []){
        $errorMessage = [];
        if(count($fileName) > 0){
            foreach($fileName as $k => $eachFileName){
                $explodedFile = explode('.', $eachFileName);
                $fileLen = count($explodedFile);
                $fileExtention = $explodedFile[$fileLen - 1];
                if(!in_array($fileExtention, $acceptedFileType)){
                    $errorMessage[] = 'Image at position '.($k + 1).' must be of image type: '.implode(',', $acceptedFileType.'='.$fileExtention);
                }
            }
        }

        if(count($errorMessage) > 0){
            return [
                'status'=>false,
                'error'=>$errorMessage,
                'data'=>[]
            ];
        }
        return [
            'status'=>true,
            'error'=>'',
            'data'=>[]
        ];

    }

    function getState() {
        return ['Abia','Adamawa','Akwa ibom','Anambra','Bauchi','Bayelsa','Benue','Borno','CrossRiver','Delta','Ebonyi','Edo','Ekiti','Enugu','Gombe','Imo','Jigawa','Kaduna','Kano','Kastina','Kebbi','Kogi','Kwara','Lagos','Nasarawa','Niger','Ogun','Ondo','Osun','Oyo','Plateau','Rivers','Sokoto','Taraba','Yobe','Zamfara','Abuja','Other'];

    }

    function returnStateAlphabetically($collectionCenters){

        $existingState = $this->getState(); $collectionArray = [];
        foreach($collectionCenters as $k => $eachCollection){

            foreach($existingState as $l => $eachState){

                if(strpos(strtolower($eachCollection->state_region_province), strtolower($eachState)) !== false){
                    $collectionArray[strtolower($eachState)][] = $eachCollection;
                }

            }

        }
        return $collectionArray;

    }

    //this is the id for the main system currency
    function returnMainCurrencyUniqueId(){
        return 'RTA76f166edd'
;    }

    function randomStringCreator ( $type = 'alnum', $len = 8 )
    {
        switch ( $type )
        {
            case 'alnum'	:
            case 'numeric'	:
            case 'nozero'	:

                switch ($type)
                {
                    case 'alnum'	:	$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'numeric'	:	$pool = '0123456789';
                        break;
                    case 'nozero'	:	$pool = '123456789';
                        break;
                }

                $str = '';
                for ( $i=0; $i < $len; $i++ )
                {
                    $str .= substr ( $pool, mt_rand ( 0, strlen ( $pool ) -1 ), 1 );
                }
                return $str;
                break;
            case 'unique' : return md5 ( uniqid ( mt_rand () ) );
                break;
        }
    }

    //function that changes an associative array to an object
    function returnObject(array $array){
        return json_decode(json_encode($array));
    }

}
