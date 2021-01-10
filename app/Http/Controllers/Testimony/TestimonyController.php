<?php

namespace App\Http\Controllers\Testimony;

use App\Http\Controllers\Controller;
use App\Models\Testimony;
use App\Traits\Generics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class TestimonyController extends Controller
{

    use Generics;

    function __construct(Testimony $testimony)
    {

        $this->middleware('auth');
        $this->testimony = $testimony;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonies = $this->testimony->getAllRows();
        return view('dashboard.all_testmonies', ['testimonies'=>$testimonies]);
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $userDetails = Auth::user();
        $validate = $this->handleValidation($request->all());
        if($validate->fails()){
            return response()->json(['error_code'=>1, 'error_statement'=>$validate->getMessageBag() ]);
        }

        if($userDetails->type_of_user === 'admin'){
            if($request->full_name === ''){
                return response()->json(['error_code'=>1, 'error_statement'=>['general_error'=>['Full Name is required'] ]]);
            }
        }

        $request->user_unique_id = $userDetails->type_of_user === 'user' ? $userDetails->unique_id : '' ;
        $request->status = 'not_approved' ;
        $testimony = $this->testimony->createNewTestimony($request);

        if($testimony){
            return response()->json(['error_code'=>0, 'success_statement'=>'Testimony was successfully submitted']);
        }
        return response()->json(['error_code'=>1, 'error_statement'=>['general_error'=>['An error occurred, Please try again'] ]]);

    }

    function handleValidation(array $data){

        $validator = Validator::make($data, [
            'testimony' => 'nullable|string',
            'video_link' => 'nullable|string'
        ]);

        $validator->sometimes('testimony', 'required|string', function ($input) {
            return $input->video_link == "";
        });

        $validator->sometimes('video_link', 'required|url', function ($input) {
            return $input->testimony == "";
        });

        return $validator;

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
    public function destroy(Request $request)
    {
        $deleteStatus = 0;
        $testimonyId = $request->dataArray;
        foreach($testimonyId as $k => $eacTestimonyId){
            $testimonyObj = $this->testimony->getSingleRow($eacTestimonyId);
            if($testimonyObj->delete()){
                $deleteStatus = 1;
            }
        }

        if($deleteStatus == 1){
            return response()->json(['error_code'=>0, 'success_statement'=>'Selected Testimonies were successfully deleted']);
        }
        return response()->json(['error_code'=>1, 'error_statement'=>['general_error'=>['An error occurred, please try again']]]);

    }


    public function approveTestimonies(Request $request)
    {
        $appoveStatus = 0;
        $testimonyId = $request->dataArray;
        foreach($testimonyId as $k => $eacTestimonyId){
            $testimonyObj = $this->testimony->getSingleRow($eacTestimonyId);
            $testimonyObj->status = 'approved';
            if($testimonyObj->save()){
                $appoveStatus = 1;
            }
        }

        if($appoveStatus == 1){
            return response()->json(['error_code'=>0, 'success_statement'=>'Selected Testimonies were successfully deleted']);
        }
        return response()->json(['error_code'=>1, 'error_statement'=>['general_error'=>['An error occurred, please try again']]]);

    }
}
