<?php

namespace App\Models;

use App\Traits\Generics;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class COllectionCenters extends Model
{
    use HasFactory, SoftDeletes, Generics;

    //primary key
    protected $primaryKey = 'unique_id';
    public $incrementing = false;

    function createNewCOllectionCenters($request){
        //unique_id, address, city_town, state_region_province, country
        $COllectionCenters = new COllectionCenters();
        $COllectionCenters->unique_id = $this->createUniqueId('c_ollection_centers', 'unique_id');
        $COllectionCenters->address = $request->address;
        $COllectionCenters->city_town = $request->city_town;
        $COllectionCenters->state_region_province = $request->state_region_province;
        $COllectionCenters->country = $request->country;
        $COllectionCenters->team = $request->team;
        $COllectionCenters->phone1 = $request->phone1;
        $COllectionCenters->phone2 = $request->phone2;
        $COllectionCenters->bank_code = $request->bank_code;
        $COllectionCenters->bank_account_no = $request->bank_account_no;
        $COllectionCenters->bank_name = $request->bank_name;
        $COllectionCenters->account_name = $request->account_name;
        $COllectionCenters->preferred_currency = $request->preferred_currency;

        $COllectionCenters->save();
        return $COllectionCenters;
    }

    function updateCOllectionCenters($request){
        //unique_id, address, city_town, state_region_province, country
        $COllectionCenters = COllectionCenters::find($request->unique_id);
        $COllectionCenters->address = $request->address ?? $COllectionCenters->address;
        $COllectionCenters->city_town = $request->city_town ?? $COllectionCenters->city_town;
        $COllectionCenters->state_region_province = $request->state_region_province ?? $COllectionCenters->state_region_province;
        $COllectionCenters->country = $request->country ?? $COllectionCenters->country;
        $COllectionCenters->team = $request->team  ?? $COllectionCenters->team;
        $COllectionCenters->phone1 = $request->phone1 ?? $COllectionCenters->phone1;
        $COllectionCenters->phone2 = $request->phone2 ?? $COllectionCenters->phone2;
        $COllectionCenters->bank_code = $request->bank_code ?? $COllectionCenters->bank_code ;
        $COllectionCenters->bank_account_no = $request->bank_account_no ?? $COllectionCenters->bank_account_no;
        $COllectionCenters->bank_name = $request->bank_name ?? $COllectionCenters->bank_name;
        $COllectionCenters->account_name = $request->account_name ?? $COllectionCenters->account_name;
        $COllectionCenters->preferred_currency = $request->preferred_currency ?? $COllectionCenters->preferred_currency;
        $COllectionCenters->save();
        return $COllectionCenters;
    }

    public function currency_details(){
        return $this->belongsTo('App\Models\CurrencyRatesModel', 'preferred_currency');
    }

    function getSingleRow($uniqueId){

        return COllectionCenters::find($uniqueId);

    }

    function getAllRows($orderColumn = 'created_at', $orderType = 'desc'){

        return COllectionCenters::orderBy($orderColumn, $orderType)->get();

    }
}
