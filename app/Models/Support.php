<?php

namespace App\Models;

use App\Traits\Generics;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Support extends Model
{
    use HasFactory, SoftDeletes, Generics;

    //primary key
    protected $primaryKey = 'unique_id';
    public $incrementing = false;

    function createNewSupport($request){
        $Support = new Support();
        $Support->unique_id = $this->createUniqueId('supports', 'unique_id');
        $Support->sender_id = $request->sender_id;
        $Support->receiver_id = $request->receiver_id;
        $Support->title_ = $request->title_;
        $Support->message = $request->message;
        $Support->file_name = $request->file_name;
        $Support->read_status = $request->read_status;
        $Support->sender_type = $request->sender_type;
        $Support->save();
        return $Support;
    }

    function updateSupport($request){
        $Support = Support::find($request->unique_id);
        $Support->sender_id = $request->sender_id ?? $Support->sender_id;
        $Support->receiver_id = $request->receiver_id ?? $Support->receiver_id;
        $Support->title_ = $request->title_ ?? $Support->title_;
        $Support->message = $request->message ?? $Support->message;
        $Support->file_name = $request->file_name ?? $Support->file_name;
        $Support->read_status = $request->read_status ?? $Support->read_status;
        $Support->sender_type = $request->sender_type ?? $Support->sender_type;
        $Support->save();
        return $Support;
    }

    function SenderDetails(){
        return $this->belongsTo(User::class, 'sender_id');
    }

    function Media(){
        return $this->hasMany(SupportMedia::class, 'support_id');
    }

    function ReceiverDetails(){
        return $this->belongsTo(User::class, 'receiver_id');
    }

    function SupportReply(){
        return $this->hasMany(SupportReply::class, 'support_id');
    }

    function getSingleRow($uniqueId){

        return Support::find($uniqueId);

    }

    function getAllRows($orderColumn = 'created_at', $orderType = 'desc'){

        return Support::orderBy($orderColumn, $orderType)->get();

    }

    function getAllRowsWithPagination($orderColumn = 'created_at', $orderType = 'desc'){

        return Support::orderBy($orderColumn, $orderType)->paginate(20);

    }

    function getRowsWhere($conditions, $orderColumn = 'created_at', $orderType = 'desc'){

        return Support::where($conditions)->orderBy($orderColumn, $orderType)->get();

    }

    function getUnreadCount($uniqueId){
        $userDetails = Auth::user();
        $mainMessage = Support::where('unique_id', $uniqueId)->where('read_status', '=', null)->where('sender_id', '!=', $userDetails->unique_id)->count();

        $Reply = SupportReply::where('support_id', $uniqueId)->where('read_status', '=', null)->where('sender_id', '!=', $userDetails->unique_id)->count();

        return $mainMessage + $Reply;

    }

}
