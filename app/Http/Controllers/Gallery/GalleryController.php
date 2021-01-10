<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryMedia;
use App\Traits\Generics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class GalleryController extends Controller
{
    use Generics;

    function __construct(Gallery $gallery, GalleryMedia $galleryMedia)
    {
        $this->middleware('auth');
        $this->gallery = $gallery;
        $this->galleryMedia = $galleryMedia;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.create_gallery');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    //update gallery record
    public function updateGallery(Request $request)
    {

        //image_file video_url description title
        $validate = $this->handleValidationForUpdate($request->all());
        if($validate->fails()){
            return Redirect::back()->withErrors($validate->getMessageBag());
        }

        $user_photo_name_array = [];
        if ($request->hasFile('image_file')) {
            $files = $request->image_file;
            if(count($files) > 0){
                foreach($files as $k => $file){
                    $user_photo = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                    $destinationPath_r = storage_path('app/public/img/gallery/');
                    $file->move($destinationPath_r, $user_photo);
                    $user_photo_name_array[] = $user_photo;
                }
            }

        }

        $gallery = $this->gallery->updateGallery($request);
        if($gallery && count($user_photo_name_array) > 0){//insert image names into the db
            foreach($user_photo_name_array as $p => $fileNames){
                $request->gallery_unique_id = $gallery->unique_id;
                $request->media = $fileNames;
                $request->media_type = 'image';
                $this->galleryMedia->createNewGalleryMedia($request);
            }
        }

        if($gallery && isset($request->video_url)){//insert video urls in the db
            $videos = $request->video_url;
            if(count($request->video_url) == 1 && $request->video_url[0] === null ){ $videos = []; }

            if(count($videos) > 0){
                foreach($videos as $p => $videos){
                    $request->gallery_unique_id = $gallery->unique_id;
                    $request->media = $videos;
                    $request->media_type = 'video';
                    $this->galleryMedia->createNewGalleryMedia($request);
                }

            }
        }

        if ($gallery) {
            return Redirect::back()->with('success_message', 'Events have been successfully added to Gallery');
        } else {
            return Redirect::back()->with('error_message', 'An Error occurred, Please try Again Later');
        }

    }

    function handleValidationForUpdate(array $data){

        $validator = Validator::make($data, [
            'title' => 'required|string',
            'description' => 'required|string',
            'video_url' => 'nullable|array|min:1',
            'video_url.*' => 'nullable|min:5|url',
            'image_file' => 'array',
            'image_file.*' => 'required|mimes:jpeg,png,gif,webp|max:3000000',
        ]);

        return $validator;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeNewEvent(Request $request)
    {

        //image_file video_url description title
        $validate = $this->handleValidation($request->all());
        if($validate->fails()){
            //return $validate->getMessageBag();
            return Redirect::back()->withErrors($validate->getMessageBag());
        }

        $videoUrlArray = $request->video_url;
        if(count($request->video_url) == 1){
            if($request->video_url[0] === null){
                $videoUrlArray = [];
            }
        }
        $errors = [];
        if(count($videoUrlArray) > 0){
            foreach($videoUrlArray as $k => $eachUrl){
                if(strpos($eachUrl, '=') === false){
                    $errors[] = 'Video url at position '.($k+1).' is not a correct youtube video link, please upload your video to youtube copy the link and paste into the box for video Url';
                }
            }
        }
        if(count($errors) > 0){
            return Redirect::back()->withErrors(['video_url'=>$errors]);
        }

        $user_photo_name_array = [];
       if ($request->hasFile('image_file')) {

            $files = $request->image_file;
            foreach($files as $k => $file){
                $user_photo = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $destinationPath_r = storage_path('app/public/img/gallery/');
                $file->move($destinationPath_r, $user_photo);
                $user_photo_name_array[] = $user_photo;
            }


        }
        $gallery = $this->gallery->createNewGallery($request);
        if($gallery && count($user_photo_name_array) > 0){//insert image names into the db
            foreach($user_photo_name_array as $p => $fileNames){
                $request->gallery_unique_id = $gallery->unique_id;
                $request->media = $fileNames;
                $request->media_type = 'image';
                $this->galleryMedia->createNewGalleryMedia($request);
            }
        }



        if($gallery && count($videoUrlArray) > 0){//insert video urls in the db
            $videos = $request->video_url;
            foreach($videos as $p => $videos){
                $request->gallery_unique_id = $gallery->unique_id;
                $request->media = $videos;
                $request->media_type = 'video';
                $this->galleryMedia->createNewGalleryMedia($request);
            }
        }

        if ($gallery) {
            return Redirect::back()->with('success_message', 'Events have been successfully added to Gallery');
        } else {
            return Redirect::back()->with('error_message', 'An Error occurred, Please try Again Later');
        }

    }

    function handleValidation(array $data){

        $validator = Validator::make($data, [
            'title' => 'required|string',
            'description' => 'required|string',
            'video_url' => 'nullable|array|min:1',
            'video_url.*' => 'nullable|min:5|url',
            'image_file' => 'required|array',
            'image_file.*' => 'required|file|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
        ]);

        return $validator;

    }

    /**
     * Display all resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewGalleryEvents()
    {

        //$gallery = $this->gallery->getAllRowsWithPagination();
        $gallery = $this->gallery->getAllRows();
        return view('dashboard.all_gallery', ['gallery'=>$gallery]);

    }

    function viewSingleGallery($galleryId){
        $gallery = $this->gallery->getSingleRow($galleryId);
        return view('dashboard.single_gallery', ['gallery'=>$gallery]);
    }

    public function viewGalleryAEvent($galleryId)
    {

        $gallery = $this->gallery->getSingleRow($galleryId);
        return view('dashboard.single_gallery', ['gallery'=>$gallery]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editGalleryPage($galleryId)
    {
        $gallery = $this->gallery->getSingleRow($galleryId);
        return view('dashboard.edit_gallery', ['gallery'=>$gallery]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteGalleryImage(Request $request)
    {
        $deleteStatus = 0;
        /*$validate = $this->handleDeleteValidation($request->all());
        if($validate->fails()){
            return Redirect::back()->withErrors($validate->getMessageBag());
        }*/

        $imageUniqueIdArray = $request->dataArray;
        foreach($imageUniqueIdArray as $k => $eachImageId){
            $mediaObject = $this->galleryMedia->getSingleRow($eachImageId);

            //code for remove old file
            if ($mediaObject->media !== null) {
                if(file_exists(storage_path('app/public/img/gallery/') . $mediaObject->media)){
                    $file_old = storage_path('app/public/img/gallery/') . $mediaObject->media;
                    unlink($file_old);
                }
            }

            if($mediaObject->delete()){
                $deleteStatus = 1;
            }
        }

        if($deleteStatus == 1){
            return response()->json(['error_code'=>0, 'success_statement'=>'Selected Image(s) was deleted successfully']);
        }

        return response()->json(['error_code'=>1, 'error_statement'=>'An error occurred, Please try again']);
    }


    function handleDeleteValidation(array $data){

        $validator = Validator::make($data, [
            'dataArray' => 'required|string'
        ]);

        return $validator;

    }

    public function deleteGallery(Request $request)
    {
        $deleteStatus = 0;

        $imageUniqueIdArray = $request->dataArray;
        foreach($imageUniqueIdArray as $k => $eachImageId){
            $gallery = $this->gallery->getSingleRow($eachImageId);

            $galleryMediaArray= $gallery->galleryMedia;
            if(count($galleryMediaArray) > 0){
                foreach($galleryMediaArray as $k => $eachGalleryMediaObj){

                    //code for remove old file
                    if ($eachGalleryMediaObj->media !== null) {
                        if(file_exists(storage_path('app/public/img/gallery/') . $eachGalleryMediaObj->media)){
                            $file_old = storage_path('app/public/img/gallery/') . $eachGalleryMediaObj->media;
                            unlink($file_old);
                        }
                    }

                    $eachGalleryMediaObj->delete();
                }
            }

            if($gallery->delete()){
                $deleteStatus = 1;
            }
        }

        if($deleteStatus == 1){
            return response()->json(['error_code'=>0, 'success_statement'=>'Selected Galleries was deleted successfully']);
        }

        return response()->json(['error_code'=>1, 'error_statement'=>'An error occurred, Please try again']);

    }


    function handleDeleteGalleryValidation(array $data){

        $validator = Validator::make($data, [
            'dataArray' => 'required|string'
        ]);

        return $validator;

    }

}
