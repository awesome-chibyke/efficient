<?php

namespace App\Http\Controllers\UsersArea;

use App\Http\Controllers\Controller;
use App\Traits\AppSettings;
use App\Traits\Generics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CreateUsersController extends Controller
{

    use AppSettings, Generics;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    function handleValidation($data){

        $validator = Validator::make($data, [
            'email'=>'required|email|unique:users',
            'username'=>'required|unique:users',
            'phone'=>'required|numeric',
            'password'=>'required|confirm|min:6|max:10',
        ]);

        return $validator;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeUsers(Request $request)
    {

        $validation = $this->handleValidation($request->all());
        if($validation->fails()){
            return Redirect::back()->withErrors($validation);
        }

        //add the values to the db


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
    public function destroy($id)
    {
        //
    }

    public function showForm()
    {
        $data = $this->createArrayForView();
        if(isset($_GET['ref'])){
            $ref = trim($_GET['ref']);
            $data['ref'] = $ref;
        }
        return view('auth.register', $data);
    }
}
