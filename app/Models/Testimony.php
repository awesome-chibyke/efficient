<?php

namespace App\Models;

use App\Traits\Generics;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Testimony extends Model
{
    use HasFactory, SoftDeletes, Generics;

    //primary key
    protected $primaryKey = 'unique_id';
    public $incrementing = false;

    function createNewTestimony($request){
        //user_unique_id 	investment_unique_id 	testimony 	video_link 	status
        $Testimony = new Testimony();
        $Testimony->unique_id = $this->createUniqueId('testimonies', 'unique_id');
        $Testimony->user_unique_id = $request->user_unique_id;
        $Testimony->investment_unique_id = $request->investment_unique_id;
        $Testimony->testimony = $request->testimony;
        $Testimony->video_link = $request->video_link;
        $Testimony->status = $request->status;
        $Testimony->full_name = $request->full_name;
        $Testimony->save();
        return $Testimony;
    }

    function updateTestimony($request){
        //user_unique_id 	investment_unique_id 	testimony 	video_link 	status
        $Testimony = Testimony::find($request->unique_id);
        $Testimony->user_unique_id = $request->user_unique_id ?? $Testimony->user_unique_id;
        $Testimony->investment_unique_id = $request->investment_unique_id ?? $Testimony->investment_unique_id;
        $Testimony->testimony = $request->testimony ?? $Testimony->testimony;
        $Testimony->video_link = $request->video_link ?? $Testimony->video_link;
        $Testimony->status = $request->status ?? $Testimony->status;
        $Testimony->full_name = $request->full_name ?? $Testimony->full_name;
        $Testimony->save();
        return $Testimony;
    }

    function getSingleRow($uniqueId){

        return Testimony::find($uniqueId);

    }

    function getAllRows($orderColumn = 'created_at', $orderType = 'desc'){

        return Testimony::orderBy($orderColumn, $orderType)->get();

    }

    function Faqs($conditions, $orderColumn = 'created_at', $orderType = 'desc'){

        return Testimony::where($conditions)->orderBy($orderColumn, $orderType)->get();

    }

    function userDetails(){
        return $this->belongsTo('App\Models\User', 'user_unique_id');
    }

    function returnTestimonyStatus($status){
        if($status === 'not_approved'){
            return 'warning';
        }else{
            return 'info';        }
    }

}
