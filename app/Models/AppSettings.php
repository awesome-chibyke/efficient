<?php

namespace App\Models;

use App\Traits\Generics;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class AppSettings extends Model
{
    use HasFactory, Generics;

    //primary key
    protected $primaryKey = 'unique_id';
    public $incrementing = false;

    //get single model
    function getSingleModel($id = 'pl45wl7ARl'){
        return AppSettings::where('unique_id',$id)->first();
    }

    function getAllModel($columnNameForOrder = 'id', $order = 'desc'){
        return LottoSettings::orderBy($columnNameForOrder, $order)->get();
    }

    function insertIntoModel($request){
        //unique_id site_name 	address1 	address2 	email1 	site_url 	deleted_at 	created_at 	updated_at
        $AppSetting = new AppSettings();
        $AppSetting->unique_id = $this->createUniqueId('app_settingsHide', 'unique_id');
        $AppSetting->site_name = $request->site_name;
        $AppSetting->address1 = $request->address1;
        $AppSetting->address2 = $request->address2;
        $AppSetting->email1 = $request->email1;
        $AppSetting->email12 = $request->email12;
        $AppSetting->site_url = $request->site_url;
        $AppSetting->total_projects = $request->total_projects;
        $AppSetting->save();
        return $AppSetting;
    }

    function updateModel($request){
        //unique_id site_name 	address1 	address2 	email1 	site_url 	deleted_at 	created_at 	updated_at
        $AppSetting = AppSettings::find($request->id);
        $AppSetting->site_name = $request->site_name ?? $AppSetting->site_name ;
        $AppSetting->address1 = $request->address1 ?? $AppSetting->address1;
        $AppSetting->address2 = $request->address2 ?? $AppSetting->address2;
        $AppSetting->email1 = $request->email1 ?? $AppSetting->email1;
        $AppSetting->email2 = $request->email2 ?? $AppSetting->email2;
        $AppSetting->site_url = $request->site_url ?? $AppSetting->site_url;
        $AppSetting->logo_url = $request->logo_url ?? $AppSetting->logo_url;
        $AppSetting->facebook = $request->facebook ?? $AppSetting->facebook;
        $AppSetting->instagram = $request->instagram ?? $AppSetting->instagram;
        $AppSetting->twitter = $request->twitter ?? $AppSetting->twitter;
        $AppSetting->phone1 = $request->phone1 ?? $AppSetting->phone1;
        $AppSetting->phone2 = $request->phone2 ?? $AppSetting->phone2;
        $AppSetting->no_days_cut_for_referral = $request->no_days_cut_for_referral ?? $AppSetting->no_days_cut_for_referral;
        $AppSetting->least_withdrawable_amount = $request->least_withdrawable_amount ?? $AppSetting->least_withdrawable_amount;
        $AppSetting->no_of_days_to_review = $request->no_of_days_to_review ?? $AppSetting->no_of_days_to_review;
        $AppSetting->linkedin = $request->linkedin ?? $AppSetting->linkedin;
        $AppSetting->total_projects = $request->total_projects ?? $AppSetting->total_projects;
        $AppSetting->address_3 = $request->address_3 ?? $AppSetting->address_3;
        $AppSetting->address4 = $request->address4 ?? $AppSetting->address4;
        $AppSetting->slot_setup = $request->slot_setup ?? $AppSetting->slot_setup;
        $AppSetting->save();
        return $AppSetting;
    }

}
