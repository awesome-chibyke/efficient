<?php

namespace App\Http\Controllers\PrimaryPages;

use App\Http\Controllers\Controller;
use App\Models\COllectionCenters;
use App\Models\Faqs;
use App\Models\Gallery;
use App\Models\InvestmentSettings;
use App\Models\News;
use App\Models\Testimony;
use App\Models\User;
use App\Traits\AppSettings;
use App\Traits\Generics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrimaryPagesController extends Controller
{
    use Generics;

    function __construct(Faqs $faqs, News $news, \App\Models\AppSettings $appSettings, COllectionCenters $COllectionCenters, User $user, InvestmentSettings $investmentSettings)
    {
        //$this->middleware('auth');
        $this->faqs = $faqs;
        $this->news = $news;
        $this->appSettings = $appSettings;
        $this->COllectionCenters = $COllectionCenters;
        $this->user = $user;
        $this->investmentSettings = $investmentSettings;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videoTestimonies = $this->getVideoTestimonies();
        $textTestimonies = $this->getTextTestimonies();
        $AllMembers = $this->getAllMembers();
        $CollectionCenters = $this->getCollectionCenters();
        $Settings = $this->getSettings();
        $Plans = $this->getPlans();
        $News = News::orderBy('created_at', 'desc')->simplePaginate(6);
        $data = $this->createArrayForView(['videoTestimonies'=>$videoTestimonies, 'textTestimonies'=>$textTestimonies, 'Plans'=>$Plans, 'News'=>$News, 'settings'=>$Settings, 'collectionCenters'=>$CollectionCenters, 'allMembers'=>$AllMembers]);
        return view('home.index', $data);
    }

    function getSettings(){
        return $this->appSettings->getSingleModel();
    }

    function getCollectionCenters(){
        return $this->COllectionCenters->getAllRows();
    }

    function getAllMembers(){
        return $this->user->getUsersWithCondition([
            ['type_of_user', '=', 'user']
        ]);
    }

    function getVideoTestimonies($option = 'limit', $no_of_rows = 20){
        if($option === 'limit') {
            return Testimony::where('video_link', '!=', null)->where('status', '=', 'approved')->inRandomOrder()->limit(5)->get();
        }else{
            return Testimony::where('video_link', '!=', null)->where('status', '=', 'approved')->simplePaginate($no_of_rows);
        }
    }

    function getTextTestimonies($option = 'limit', $no_of_rows = 20){
        if($option === 'limit') {
            return Testimony::where('testimony', '!=', null)->where('status', '=', 'approved')->inRandomOrder()->limit(5)->get();
        }else{
            return Testimony::where('testimony', '!=', null)->where('status', '=', 'approved')->orderBy('created_at', 'desc')->limit($no_of_rows)->get();
        }
    }

    function getPlans($option = 'limit'){
        if($option === 'limit'){
            return InvestmentSettings::orderBy('created_at', 'asc')->limit(3)->get();
        }else{
            return InvestmentSettings::orderBy('created_at', 'asc')->get();
        }
    }

    //
    function getGallery($no_of_row = 20){

            return Gallery::orderBy('created_at', 'desc')->simplePaginate($no_of_row);

    }


    //pages
    function viewPackages(){
        $Plans = $this->getPlans('no_limit');
        return view('home.packages', $this->createArrayForView(['Plans'=>$Plans]));

    }

    function about(){
        return view('home.about', $this->createArrayForView());

    }

    function collectionCenters(){
        $center = COllectionCenters::orderBy('state_region_province', 'ASC')->simplePaginate(20);
        $collectionsCenters = $this->returnStateAlphabetically($center);
        $paginateProps = $center;
        return view('home.collection-centers', $this->createArrayForView(['collectionsCenters'=>$collectionsCenters, 'paginateProps'=>$paginateProps]));

    }

    function contact(){
        return view('home.contact', $this->createArrayForView());

    }

    function anthem(){
        return view('home.anthem', $this->createArrayForView());

    }

    function faqsPage(){
        $faqs = $this->faqs->getAllRows();
        return view('home.faq', $this->createArrayForView(['faqs'=>$faqs]));

    }

    function newsDetails($newsId){
        $news = $this->news->getSingleRow($newsId);
        $latestPost = News::orderBy('created_at', 'desc')->limit(5)->get();
        return view('home.news-details', $this->createArrayForView(['news'=>$news, 'latestPost'=>$latestPost]));

    }

    function newsEvents(){
        $News = News::orderBy('created_at', 'desc')->simplePaginate(20);
        return view('home.news-events', $this->createArrayForView(['News'=>$News]));

    }

    function howItWorks(){
        return view('home.how-it-works', $this->createArrayForView());

    }

    function gallery(){

        return view('home.gallery', $this->createArrayForView(['gallery'=>$this->getGallery()]));

    }

    function privacyPolicy(){

        return view('home.privacy-policy', $this->createArrayForView(['gallery'=>$this->getGallery()]));

    }

    function termsOfService(){

        return view('home.terms-of-service', $this->createArrayForView(['gallery'=>$this->getGallery()]));

    }

    function single_gallery($single_gallery_id){
        $gallery = Gallery::where('unique_id', $single_gallery_id)->first();
        return view('home.single_gallery', $this->createArrayForView(['gallery'=>$gallery]));

    }

    function testimony(){
        $videoTestimonies = $this->getVideoTestimonies('no_limits', 1);
        $textTestimonies = $this->getTextTestimonies('no_limits', 20);
        return view('home.testimony', $this->createArrayForView(['videoTestimonies'=>$videoTestimonies, 'textTestimonies'=>$textTestimonies]));

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function manageRef($refId)
    {
        if(Auth::check()){
            return redirect()->route('create_investment_interface', [$refId]);
        }else{
            return redirect('register?ref='.$refId);
        }
    }
}
