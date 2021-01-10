<?php

namespace App\Models;

use App\Traits\Generics;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory, SoftDeletes, Generics;

    //primary key
    protected $primaryKey = 'unique_id';
    public $incrementing = false;

    function createNews($request){
        //	title 	news
        $News = new News();
        $News->unique_id = $this->createUniqueId('news', 'unique_id');
        $News->title = $request->title;
        $News->news = $request->news;
        $News->image_name = $request->image_name;
        $News->save();
        return $News;
    }

    function updateNews($request){
        ////title 	description
        $News = News::find($request->unique_id);
        $News->title = $request->title ?? $News->title;
        $News->news = $request->news ?? $News->news;
        $News->image_name = $request->image_name ?? $News->image_name;
        $News->save();
        return $News;
    }

    function NewsTagDetails(){
        return $this->hasMany('App\Models\NewsTag', 'news_unique_id');
    }

    function NewsTagDetails2($newsId){
        return NewsTag::where('news_unique_id', $newsId)->get();
    }

    function getSingleRow($uniqueId){

        return News::find($uniqueId);

    }

    function getAllRows($orderColumn = 'created_at', $orderType = 'desc'){

        return News::orderBy($orderColumn, $orderType)->get();

    }

    function getAllRowsWithPagination($noOfRow = 20, $orderColumn = 'created_at', $orderType = 'desc'){

        return News::orderBy($orderColumn, $orderType)->paginate($noOfRow);

    }

    function getRowsWhere($conditions, $orderColumn = 'created_at', $orderType = 'desc'){

        return News::where($conditions)->orderBy($orderColumn, $orderType)->get();

    }
}
