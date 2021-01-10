<?php

namespace App\Models;

use App\Traits\Generics;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use HasFactory, SoftDeletes, Generics;

    //primary key
    protected $primaryKey = 'unique_id';
    public $incrementing = false;

    function createNewGallery($request){
        //title 	description
        $Gallery = new Gallery();
        $Gallery->unique_id = $this->createUniqueId('galleries', 'unique_id');
        $Gallery->title = $request->title;
        $Gallery->description = $request->description;
        $Gallery->save();
        return $Gallery;
    }

    function updateGallery($request){
        ////title 	description
        $Gallery = Gallery::find($request->unique_id);
        $Gallery->title = $request->title ?? $Gallery->title;
        $Gallery->description = $request->description ?? $Gallery->description;
        $Gallery->save();
        return $Gallery;
    }

    function galleryMedia(){
        return $this->hasMany('App\Models\GalleryMedia', 'gallery_unique_id');
    }

    function getSingleRow($uniqueId){

        return Gallery::find($uniqueId);

    }

    function getAllRows($orderColumn = 'created_at', $orderType = 'desc'){

        return Gallery::orderBy($orderColumn, $orderType)->get();

    }

    function getAllRowsWithPagination($orderColumn = 'created_at', $orderType = 'desc'){

        return Gallery::orderBy($orderColumn, $orderType)->paginate(20);

    }

    function getRowsWhere($conditions, $orderColumn = 'created_at', $orderType = 'desc'){

        return Gallery::where($conditions)->orderBy($orderColumn, $orderType)->get();

    }

}
