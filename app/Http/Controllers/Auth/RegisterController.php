<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\COllectionCenters;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Traits\AppSettings;
use App\Traits\Generics;
use function GuzzleHttp\Psr7\str;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers, Generics;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(COllectionCenters $COllectionCenters)
    {
        $this->middleware(['guest']);
        $this->COllectionCenters = $COllectionCenters;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    /*protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }*/

    function handleValidation(array $data){

        $validator = Validator::make($data, [
            'email'=>'required|email|unique:users',
            'username'=>'required|unique:users',
            'phone'=>'required|numeric',
            'password'=>'required|confirmed|min:6|max:10',
            'gender'=>'required|string',
            //'preferred_center'=>'required|string',
        ]);

        return $validator;

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $uniqueId = $this->createUniqueId('users', 'unique_id');
        return User::create([
            'unique_id' => $uniqueId,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'referer_unique_id' => $data['referer_unique_id'],
            'username' => $data['username'],
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'type_of_user' => 'user',
            //'alt_password' => $this->hashPassword($input['password']),
            'preferred_currency' => 'RTA76f166edd',
            'first_time_login' => 'yes',
        ]);
    }

    public function showRegistrationForm()
    {
        $collectionCenters = $this->COllectionCenters->getAllRows('state_region_province', 'ASC');

        $data = $this->createArrayForView(['collectionCenters'=>$this->returnStateAlphabetically($collectionCenters)]);
        return view('auth.register', $data);
    }

    public function register(Request $request)
    {

        try{

            $validation = $this->handleValidation($request->all());
            if($validation->fails()){
                return Redirect::back()->withErrors($validation);
            }

            event(new Registered($user = $this->create($request->all())));

            $this->guard()->login($user);

            if ($response = $this->registered($request, $user)) {
                return $response;
            }

            /*return $request->wantsJson()
                ? new JsonResponse([], 201)
                : redirect($this->redirectPath());*/

            if($request->has('formApi') ){
                $data = $this->createArrayForView(['userDetails'=>$user], 'error');
                return response()->json($data);
            }else{

                return redirect()->route('account_validation', [$user->unique_id])->with('success_message', 'Registration was successful');
            }

        }catch(\Exception $exception){
            $errors =  $exception->getMessage();
            if($request->has('formApi') ){
                $data = $this->createArrayForView(['error'=>$errors], 'error');
                return response()->json($data);
            }else{
                return Redirect::back()->with('error_message', $errors);
            }

        }
    }

}
