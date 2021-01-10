<?php

namespace App\Models;

use App\Traits\Generics;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsTag extends Model
{
    use HasFactory, SoftDeletes, Generics;

    //primary key
    protected $primaryKey = 'unique_id';
    public $incrementing = false;

    function createNewsTags($request){
        //	news_unique_id 	tag
        $NewsTag = new NewsTag();
        $NewsTag->unique_id = $this->createUniqueId('news_tags', 'unique_id');
        $NewsTag->news_unique_id = $request->news_unique_id;
        $NewsTag->tag = $request->tag;
        $NewsTag->save();
        return $NewsTag;
    }

    function updateNewsTags($request){
        ////news_unique_id 	tag
        $NewsTag = NewsTag::find($request->unique_id);
        $NewsTag->news_unique_id = $request->news_unique_id ?? $NewsTag->news_unique_id;
        $NewsTag->tag = $request->tag ?? $NewsTag->tag;
        $NewsTag->save();
        return $NewsTag;
    }

    function NewsDetail(){
        return $this->belongsTo('App\Models\News', 'news_unique_id');
    }

    function getSingleRow($uniqueId){

        return NewsTag::find($uniqueId);

    }

    function getAllRows($orderColumn = 'created_at', $orderType = 'desc'){

        return NewsTag::orderBy($orderColumn, $orderType)->get();

    }

    function getAllRowsWithPagination($orderColumn = 'created_at', $orderType = 'desc'){

        return NewsTag::orderBy($orderColumn, $orderType)->paginate(20);

    }

    function getRowsWhere($conditions, $orderColumn = 'created_at', $orderType = 'desc'){

        return NewsTag::where($conditions)->orderBy($orderColumn, $orderType)->get();

    }

}
