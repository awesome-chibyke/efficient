<?php

namespace App\Models;

use App\Traits\Generics;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupportMedia extends Model
{
    use HasFactory, SoftDeletes, Generics;

    //primary key
    protected $primaryKey = 'unique_id';
    public $incrementing = false;

    function createNewSupportMedia($request){
        $SupportMedia = new SupportMedia();
        $SupportMedia->unique_id = $this->createUniqueId('supports', 'unique_id');
        $SupportMedia->support_id = $request->support_id;
        $SupportMedia->file_name = $request->file_name;
        $SupportMedia->save();
        return $SupportMedia;//unique_id 	support_id 	file_name
    }

    function updateSupportMedia($request){
        $SupportMedia = SupportMedia::find($request->unique_id);
        $SupportMedia->support_id = $request->support_id ?? $SupportMedia->support_id;
        $SupportMedia->file_name = $request->file_name ?? $SupportMedia->file_name;
        $SupportMedia->save();
        return $SupportMedia;
    }

    function getSingleRow($uniqueId){

        return SupportMedia::find($uniqueId);

    }

    function getAllRows($orderColumn = 'created_at', $orderType = 'desc'){

        return SupportMedia::orderBy($orderColumn, $orderType)->get();

    }

    function getAllRowsWithPagination($orderColumn = 'created_at', $orderType = 'desc'){

        return SupportMedia::orderBy($orderColumn, $orderType)->paginate(20);

    }

    function getRowsWhere($conditions, $orderColumn = 'created_at', $orderType = 'desc'){

        return SupportMedia::where($conditions)->orderBy($orderColumn, $orderType)->get();

    }
}
