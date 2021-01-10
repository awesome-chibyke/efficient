<?php

namespace App\Http\Controllers\Faqs;

use App\Http\Controllers\Controller;
use App\Models\Faqs;
use App\Traits\Generics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class FaqsController extends Controller
{
    use Generics;

    function __construct(Faqs $faqs)
    {
        $this->middleware('auth');
        $this->faqs = $faqs;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = $this->faqs->getAllRows();
        return view('dashboard.all_faqs', ['faqs'=>$faqs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.create_faqs');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeFaqs(Request $request)
    {
        //validate the values from the form
        $validate = $this->handleValidation($request->all());
        if($validate->fails()){
            return Redirect::back()->withErrors($validate->getMessageBag());
        }
        //question answers
        //insert the values to the db
        $question = $request->all()['question'];
        $answers = $request->all()['answers'];
        foreach($question as $k => $eachQuestion){
            $newArray = [];
            $newArray['question'] = $eachQuestion;
            $newArray['answers'] = $answers[$k];
            $object = json_decode(json_encode($newArray));
            $this->faqs->createNewFaqs($object);
        }

        return Redirect::back()->with('success_message', 'Faqs was successfully created');

    }

    function handleValidation(array $data){

        $validator = Validator::make($data, [
            'question' => 'required|array|min:1',
            'question.*' => 'required|min:3',
            'answers' => 'required|array',
            'answers.*' => 'required|min:3',
        ]);

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
    public function edit($faqsId)
    {
        $faqs = $this->faqs->getSingleRow($faqsId);
        return view('dashboard.edit_faqs', ['faqs'=>$faqs]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        //validate the values from the form
        $validate = $this->handleValidationForUpdate($request->all());
        if($validate->fails()){
            return Redirect::back()->withErrors($validate->getMessageBag());
        }
        //question answers
        //insert the values to the db
        $request->unique_id = $id;
        $faqs = $this->faqs->updateFaqs($request);
        if($faqs){
            return Redirect::back()->with('success_message', 'Faqs was successfully Updated');
        }
        return Redirect::back()->with('error_message', 'An error occurred, please try again');
    }


    function handleValidationForUpdate(array $data){

        $validator = Validator::make($data, [
            'question' => 'required|string|min:3',
            'answers' => 'required|string|min:3',
        ]);

        return $validator;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $faqsId = $request->dataArray;
        $deleteStatus = 0;
        foreach($faqsId as $k => $eachFaqsId){
            $faqsDetails = $this->faqs->getSingleRow($eachFaqsId);
            if($faqsDetails->delete()){
                $deleteStatus = 1;
            }
        }

        if($deleteStatus == 1){
            return response()->json(['error_code'=>0, 'success_statement'=>'Selected Faqs was successfully deleted']);
        }
        return response()->json(['error_code'=>1, 'error_statement'=>'An error occurred, Please try again']);
    }


}
