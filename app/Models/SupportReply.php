<?php

namespace App\Models;

use App\Traits\Generics;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupportReply extends Model
{
    use HasFactory, SoftDeletes, Generics;

    //primary key
    protected $primaryKey = 'unique_id';
    public $incrementing = false;

    function createNewSupportReply($request){
        $SupportReply = new SupportReply();
        $SupportReply->unique_id = $this->createUniqueId('supports', 'unique_id');
        $SupportReply->support_id = $request->support_id;
        $SupportReply->message = $request->message;
        $SupportReply->file_name = $request->file_name;
        $SupportReply->read_status = $request->read_status;
        $SupportReply->sender_id = $request->sender_id;
        $SupportReply->receiver_id = $request->receiver_id;
        $SupportReply->sender_type = $request->sender_type;
        $SupportReply->save();
        return $SupportReply;
    }

    function updateSupportReply($request){
        $SupportReply = SupportReply::find($request->unique_id);
        $SupportReply->support_id = $request->support_id ?? $SupportReply->support_id;
        $SupportReply->message = $request->message ?? $SupportReply->message;
        $SupportReply->file_name = $request->file_name ?? $SupportReply->file_name;
        $SupportReply->read_status = $request->read_status ?? $SupportReply->read_status;
        $SupportReply->sender_id = $request->sender_id ?? $SupportReply->sender_id;
        $SupportReply->receiver_id = $request->receiver_id ?? $SupportReply->receiver_id;
        $SupportReply->sender_type = $request->sender_type ?? $SupportReply->sender_type;
        $SupportReply->save();
        return $SupportReply;
    }

    function SupportDetails(){
        return $this->belongsTo(Support::class, 'support_id');
    }

    function Media(){
        return $this->hasMany(SupportMedia::class, 'support_id');
    }

    function getSingleRow($uniqueId){

        return SupportReply::find($uniqueId);

    }

    function getAllRows($orderColumn = 'created_at', $orderType = 'desc'){

        return SupportReply::orderBy($orderColumn, $orderType)->get();

    }

    function getAllRowsWithPagination($orderColumn = 'created_at', $orderType = 'desc'){

        return SupportReply::orderBy($orderColumn, $orderType)->paginate(20);

    }

    function getRowsWhere($conditions, $orderColumn = 'created_at', $orderType = 'desc'){

        return SupportReply::where($conditions)->orderBy($orderColumn, $orderType)->get();

    }

    function SenderDetails(){
        return $this->belongsTo(User::class, 'sender_id');
    }

    function ReceiverDetails(){
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
