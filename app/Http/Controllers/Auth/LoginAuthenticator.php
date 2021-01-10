<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AppSettings;
use App\Models\AuthenticateLogin;
use App\Traits\Generics;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class LoginAuthenticator extends Controller
{
    use Generics;

    function __construct(AuthenticateLogin $authenticateLogin)
    {
        $this->middleware('auth');
        $this->authenticateLogin = $authenticateLogin;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->createArrayForView();
        return view('auth.login_authenticator',  $data);
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
    public function destroy($id)
    {
        //
    }

    //function for resending the login auth code
    function resendLoginAuthCode(){

        $user = Auth::user();

        //send the login code to the user
        $loginObject = $this->authenticateLogin->LoginAuthMaker($user);

        if($loginObject){
            //redirect user to the interface
            return redirect()->route('login_authenticator')->with('success_message', 'A mail bearing your login authentication code have been sent your email address. please visit your email address and supply code below to continue');
        }

    }

    function checkLoginAuth(Request $request){

        $validate = $this->handleValidation($request->all());
        if($validate->fails()){
            return Redirect::back()->withErrors($validate->getMessageBag());
        }

        $user = Auth::user();
        $loginAuthCheck = $this->authenticateLogin->getSingleRowWhere([
            ['user_unique_id', '=', $user->unique_id],
            ['code', '=', $request->code],
            ['unique_id', '=', $user->current_login_hash],
            ['status', '=', null],
        ]);

        if($loginAuthCheck === null){
            Auth::logout();
            return \redirect()->route('login')->with('status', 'You have provided an invalid login authentication code');
        }

        //check the expiration time
        $expirationTime = Carbon::parse($loginAuthCheck->created_at)->addMinutes(5)->toDateTimeString();
        $currentTime = Carbon::now()->toDateTimeString();
        if($currentTime > $expirationTime){
            return \redirect()->route('login')->with('status', 'You have provided an invalid login authentication code');
        }

        $loginAuthCheck->status = 'confirmed';
        $loginAuthCheck->save();

        //redirect to home
        return \redirect()->route('home');

    }

    //validation for user investment
    function handleValidation(array $data){

        $validator = Validator::make($data, [
            'code' => 'required|numeric'
        ]);

        return $validator;

    }

    //get the login code for a user
    function getAuthCodeForJs(){

        $user = Auth::user();
        $loginAuthCheck = $this->authenticateLogin->getSingleRowWhere([
            ['user_unique_id', '=', $user->unique_id],
            ['unique_id', '=', $user->current_login_hash],
            ['status', '=', null],
        ]);

        if($loginAuthCheck !== null){
            $appSettings = new AppSettings();
            $settings = $appSettings->getSingleModel();
            $siteName = $settings->site_name;

            $api_key = env('SMS_SECRET', 'mdLcSDILeVMX6PFDUOmB62URpcCbJwJiY0TIFAolMARXvR28dAeM6HVhCTOI');

            $message = 'Hi '.$user->name.' We have detected a login attempt to your '.$settings->site_name.' account. Please enter code below to confirm login request. Code : '.$loginAuthCheck->code;

            $url = "https://www.bulksmsnigeria.com/api/v1/sms/create?api_token=$api_key&from=$siteName&to=$user->phone&body=$message&dnd=2";
            return response()->json(['status'=>true, 'data'=>$url]);
        }

        if($loginAuthCheck === null){
            Auth::logout();
            return response()->json(['status'=>false]);
        }

    }


}
