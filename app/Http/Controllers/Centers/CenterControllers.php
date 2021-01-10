<?php

namespace App\Http\Controllers\Centers;

use App\Http\Controllers\Controller;
use App\Models\COllectionCenters;
use App\Models\CurrencyRatesModel;
use App\Traits\Generics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CenterControllers extends Controller
{
    use Generics;

    function __construct(COllectionCenters $COllectionCenters, CurrencyRatesModel $currencyRatesModel)
    {
        $this->middleware('auth');
        $this->COllectionCenters = $COllectionCenters;
        $this->currencyRatesModel = $currencyRatesModel;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collectionCenters = $this->COllectionCenters->getAllRows();
        return view('dashboard.all_centers', ['collectionCenters'=>$collectionCenters]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allCurrency = $this->currencyRatesModel->getBulkModels();
        $data = $this->createArrayForView(['allCurrency'=>$allCurrency]);
        return view('dashboard.create_centers', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //address, city_town, state_region_province, country
        $validate = $this->Validator($request);
        if($validate->fails()){

            return Redirect::back()->withErrors($validate->getMessageBag());
        }

        $COllectionCenters = $this->COllectionCenters->createNewCOllectionCenters($request);
        if($COllectionCenters){
            return Redirect::back()->with('success_message', 'Center was successfully created');
        }
        return Redirect::back()->with('error_message', 'An error occurred, please try again');

    }


    protected function Validator($request){

        $validator = Validator::make($request->all(), [//site_name 	address1 	address2 	email1 	site_url
            'address' => 'required|string',
            'city_town' => 'required|string',
            'state_region_province' => 'required|string',
            'country' => 'required|string',
            'team' => 'required|string',
            'phone1' => 'nullable|string',
            'phone2' => 'nullable|string',
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
        $collectionCenters = $this->COllectionCenters->getSingleRow($id);
        return view('dashboard.centers', ['COllectionCenters'=>$collectionCenters]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $allCurrency = $this->currencyRatesModel->getBulkModels();
        $collectionCenters = $this->COllectionCenters->getSingleRow($id);
        $data = $this->createArrayForView(['allCurrency'=>$allCurrency, 'COllectionCenters'=>$collectionCenters]);
        return view('dashboard.edit_centers', $data);
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
        //address, city_town, state_region_province, country
        $validate = $this->Validator($request);
        if($validate->fails()){
            return Redirect::back()->withErrors($validate->getMessageBag());
        }

        $request->unique_id = $id;
        $COllectionCenters = $this->COllectionCenters->updateCOllectionCenters($request);
        if($COllectionCenters){
            return Redirect::back()->with('success_message', 'Center was successfully updated');
        }
        return Redirect::back()->with('error_message', 'An error occurred, please try again');

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
        $centerId = $request->dataArray;
        foreach ($centerId as $eachCenterId){
            $centerObj = $this->COllectionCenters->getSingleRow($eachCenterId);
            if($centerObj->delete()){
                $deleteStatus = 1;
            }
        }
        if($deleteStatus == 1){
            return response()->json(['error_code'=>0, 'success_statement'=>'Selected Centers was deleted successfully']);
        }

        return response()->json(['error_code'=>1, 'error_statement'=>['general_error'=>['An error occurred, Please try again']]]);
    }
}
