<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\AppSettings;
use App\Traits\Generics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    use Generics, AppSettings;

    function __construct(User $user, \App\Models\AppSettings $appSettings)
    {

        $this->middleware('auth');
        $this->user = $user;
        $this->appSettings = $appSettings;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAllUsers()
    {
        $allUsers = $this->user->getAllAdminWhere('user');
        $data = $this->createArrayForView(['allUsers'=>$allUsers, 'mainTitle'=>'List of Users', 'display'=>'user']);
        return view('dashboard.all_user', $data);
    }

    public function showAllAdmin()
    {
        $allUsers = $this->user->getUsersWithCondition([
            ['type_of_user', '=', 'admin'],
            //['admin_level', '=', 'sub_admin']
        ]);
        $data = $this->createArrayForView(['allUsers'=>$allUsers, 'mainTitle'=>'List of Admin', 'display'=>'admin']);
        return view('dashboard.all_user', $data);
    }

    public function userProfile($userID)
    {
        $user = $this->user->getOneModel($userID);
        $data = $this->createArrayForView(['user'=>$user]);//compact( 'user')
        return view('dashboard.profile', $data);
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

    protected function Validator($request){

        $this->validator = Validator::make($request->all(), [//site_name 	address1 	address2 	email1 	site_url
            'actionArray' => 'required',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|min:8',
        ]);

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


    function manageAccount(Request $request){

        $actionArray = ['block_account', 'unblock_account', 'make_user', 'make_admin', 'make_super_admin', 'make_master'];
        $columnName = ['status', 'status', 'type_of_user', 'type_of_user', 'type_of_user', 'type_of_user'];
        $valueArray = ['inactive', 'active', 'user', 'admin', 'super_admin', 'master'];

        if(in_array($request->action,$actionArray)){
            $key = array_search($request->action,$actionArray);
            $column = $columnName[$key];
            $value = $valueArray[$key];

            //update the user table
            $userDetails = Auth::user();
            $updateUser = User::where('unique_id',$request->userId)->update([$column=>$value]);

            if($updateUser){
                $message = ['error_code'=>0, 'success_message'=>'Update was successful', 'data'=>['userDetails'=>User::where('unique_id', $request->userId)->first()]];
                return response()->json($message);
            }
            $message = ['error_code'=>1, 'error_message'=>'An Error Occurred, please try again'];
            return response()->json($message);
        }


    }

    public function showAllSuperAdmin()
    {
        $conditions = [
            //['admin_level', '=', 'main'],
            ['type_of_user', '=', 'super_admin']
        ];
        $allUsers = $this->user->getAllWhere($conditions);
        $data = ['allUsers'=>$allUsers, 'mainTitle'=>'List of Super Admin', 'display'=>'All Super Admin'];
        return view('dashboard.all_user', $data);
    }

}
