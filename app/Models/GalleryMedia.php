<?php

namespace App\Models;

use App\Traits\Generics;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GalleryMedia extends Model
{
    use HasFactory, SoftDeletes, Generics;

    //primary key
    protected $primaryKey = 'unique_id';
    public $incrementing = false;

    function createNewGalleryMedia($request){
        //gallery_unique_id 	media 	media_type
        $GalleryMedia = new GalleryMedia();
        $GalleryMedia->unique_id = $this->createUniqueId('gallery_media', 'unique_id');
        $GalleryMedia->gallery_unique_id = $request->gallery_unique_id;
        $GalleryMedia->media = $request->media;
        $GalleryMedia->media_type = $request->media_type;
        $GalleryMedia->save();
        return $GalleryMedia;
    }

    function updateGalleryMedia($request){
        //gallery_unique_id 	media 	media_type
        $GalleryMedia = GalleryMedia::find($request->unique_id);
        $GalleryMedia->gallery_unique_id = $request->gallery_unique_id ?? $GalleryMedia->gallery_unique_id;
        $GalleryMedia->media = $request->media ?? $GalleryMedia->media;
        $GalleryMedia->media_type = $request->media_type ?? $GalleryMedia->media_type;
        $GalleryMedia->save();
        return $GalleryMedia;
    }

    function InvestmentDetails(){
        return $this->belongsTo('App\Models\Gallery', 'gallery_unique_id');
    }

    function getSingleRow($uniqueId){

        return GalleryMedia::find($uniqueId);

    }

    function getAllRows($orderColumn = 'created_at', $orderType = 'desc'){

        return GalleryMedia::orderBy($orderColumn, $orderType)->get();

    }

    function getAllRowsWithPagination($orderColumn = 'created_at', $orderType = 'desc'){

        return GalleryMedia::orderBy($orderColumn, $orderType)->paginate(20);

    }

    function getRowsWhere($conditions, $orderColumn = 'created_at', $orderType = 'desc'){

        return GalleryMedia::where($conditions)->orderBy($orderColumn, $orderType)->get();

    }

    function buildEmbededLink($selected_url){

        $exploded_url = explode('=', $selected_url);

        $url = 'https://www.youtube.com/embed/'.$exploded_url[1];

        return $url;
    }

}
