<?php
namespace App\Traits;



use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait AppSettings{

    var $active8 = 'active';

 function getAppSettingss(){
     $user = null;
     if (Auth::check()) { $user = User::where('unique_id', Auth::user()->unique_id)->first(); }
     //$siteAddress $siteAddress1 $sitePhone $siteEmail
     $appSettings = new \App\Models\AppSettings();
     $Settings = $appSettings->getSingleModel();
     return [
         'active8'=>'active',
         'title' => 'Register | Grandour Empowerment Programme',
         'site_description' => 'Grandour runs a contributive collaboration model of Empowerment. It is a programme of Grandourians by Grandourians and for Grandourians a ground breaking symbiotic paradigm shift in philanthropy.',
         'keywords' => 'Grandour, Empowerment, Programme, Wealth and Capacity building, Techo Craft, Contribution, Investment, Nigeria, Enugu, Anambra, Lagos',
         'siteName' => 'Grandour',
         'siteDomain' => 'grandour.org',
         'sitePhone' => $Settings->phone1,
         'sitePhone1' => $Settings->phone2,
         'siteEmail' => 'info@grandour.org',
         'siteAddress' => $Settings->address1,
         'siteAddress1' => $Settings->address2,
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


}