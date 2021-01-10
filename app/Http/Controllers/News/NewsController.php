<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsTag;
use App\Traits\Generics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    use Generics;

    function __construct(News $news, NewsTag $newsTag)
    {

        $this->middleware('auth');
        $this->news = $news;
        $this->newsTag = $newsTag;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = $this->news->getAllRowsWithPagination(20);
        return view('dashboard.all_news', ['news'=>$news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createNewsView()
    {
        return view('dashboard.create_news');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeNews(Request $request)
    {
        //title_ tags news
        $validate = $this->handleValidation($request->all());
        if($validate->fails()){
            return Redirect::back()->withErrors($validate->getMessageBag());
        }

        if ($request->hasFile('image_name')) {
            $file = $request->image_name;
            $user_photo = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $destinationPath_r = storage_path('app/public/img/news_image/');
            $file->move($destinationPath_r, $user_photo);
        }

        $request->title = $request->title_;
        $request->image_name = $user_photo;
        $news = $this->news->createNews($request);
        if($news){
            return Redirect::back()->with('success_message', 'News was successfully submitted');
            /*$newsTagArray = explode(',', $request->tags);
            if(count($newsTagArray) > 0){//tag news_unique_id
                foreach ($newsTagArray as $k => $eachTag){
                    $request->news_unique_id = $news->unique_id;
                    $request->tag = $eachTag;
                    $this->newsTag->createNewsTags($request);
                }
            }*/
        }



    }


    function handleValidation(array $data){

        $validator = Validator::make($data, [
            'title_' => 'required|string',
            //'tags' => 'required|string',
            'news' => 'required|string',
            'image_name' => 'required|mimes:jpeg,png,gif,webp|max:3000000',
        ]);

        return $validator;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showSingleNews($NewsId)
    {
        $singleNews = $this->news->getSingleRow($NewsId);
        return view('dashboard.single_news', ['singleNews'=>$singleNews]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editNewsPage($newsId)
    {
        $singleNews = $this->news->getSingleRow($newsId);
        return view('dashboard.edit_news', ['singleNews'=>$singleNews]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateNews(Request $request, $newsId)
    {
        //title_ tags news
        $validate = $this->handleValidationForUpdate($request->all());
        if($validate->fails()){
            return Redirect::back()->withErrors($validate->getMessageBag());
        }

        if ($request->hasFile('image_name')) {
            $file = $request->image_name;
            if(!empty($file)){

                $newsObject = $this->news->getSingleRow($newsId);
                if ($newsObject->image_name !== null) {
                    if(file_exists(storage_path('app/public/img/news_image/') . $newsObject->image_name)){
                        $file_old = storage_path('app/public/img/news_image/') . $newsObject->image_name;
                        unlink($file_old);
                    }
                }

                $user_photo = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $destinationPath_r = storage_path('app/public/img/news_image/');
                $file->move($destinationPath_r, $user_photo);
                $request->image_name = $user_photo;
            }
        }

        $request->title = $request->title_;
        $request->unique_id = $newsId;
        $news = $this->news->updateNews($request);
        if($news){

            /*if($request->tags !== null){
                $newsTagArray = explode(',', $request->tags);
                if(count($newsTagArray) > 0){//tag news_unique_id
                    foreach ($newsTagArray as $k => $eachTag){
                        $request->news_unique_id = $news->unique_id;
                        $request->tag = $eachTag;
                        $this->newsTag->createNewsTags($request);
                    }
                }
            }*/
            /*if(isset($request->delete_tags)){//delete the tags the user wants to delete
                $tagIdArray = $request->delete_tags;
                if(count($tagIdArray) == 1){
                    if($tagIdArray[0] == null){
                        $tagIdArray = [];
                    }
                }
                if(count($tagIdArray) > 0){
                    foreach($tagIdArray as $k => $eachTagId){
                        $eachTagDetail = $this->newsTag->getSingleRow($eachTagId);
                        $eachTagDetail->delete();
                    }
                }
            }*/
            return Redirect::back()->with('success_message', 'News was successfully submitted');
        }
        return Redirect::back()->with('error_message', 'An error occurred, please try again');


    }

    function handleValidationForUpdate(array $data){

        $validator = Validator::make($data, [
            'title_' => 'required|string',
            //'tags' => 'required|string',
            'news' => 'required|string',
        ]);

        return $validator;

    }

    function singleNewsPage($newdsId){

        $news = $this->news->getSingleRow($newdsId);
        return view('dashboard.single_news_page', ['news'=>$news]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmNewsDelete(Request $request)
    {
        $newsArray = $request->dataArray; $deleteStatus = 0;
        foreach($newsArray as $k => $eachNewsUniqueId){

            $newsDetailsObj = $this->news->getSingleRow($eachNewsUniqueId);
            $newsTags = $newsDetailsObj->NewsTagDetails;
            if(count($newsTags) > 0){
                foreach($newsTags as $k => $eachTag){
                    $eachTag->delete();
                }
            }

            if($newsDetailsObj->delete()){
                $deleteStatus = 1;
            }

        }

        if($deleteStatus == 1){
            return response()->json(['error_code'=>0, 'success_statement'=>'Selected News were successfully deleted']);
        }

        return response()->json(['error_code'=>1, 'error_statement'=>'An error occurred, Please try again']);

    }
}
