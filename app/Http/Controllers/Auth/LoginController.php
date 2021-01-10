<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SuccessFullInvestment;
use App\Models\AuthenticateLogin;
use App\Models\InvestmentSettings;
use App\Models\InvestmentStore;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Traits\AppSettings;
use App\Traits\Generics;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, Generics;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthenticateLogin $authenticateLogin)
    {
        $this->middleware('guest')->except('logout');
        $this->authenticateLogin = $authenticateLogin;
    }

    /**
     * //show login page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        $data = $this->createArrayForView();
        if(isset($_GET['ref'])){
            $refId = trim($_GET['ref']);
            $data['refId'] = $refId;
        }

        return view('auth.login', $data);
    }


    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        /*return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectPath());*/
        //save user details to DB
        $user = Auth::user();
        if($request->refId !== ''){
            $user->referer_unique_id = $request->refId;
            $user->save();
        }

        if($request->has('formApi') ){//if the user is coming from API
            $data = $this->createArrayForView(['userDetails'=>$user], 'error');
            return response()->json($data);
        }else{//if the user is coming from normal request
            //redirect the user to the page he is supposed to see
            if($user->first_time_login === 'no'){

                //check if the user is blocked
                if($user->status === 'inactive'){
                    Auth::logout();
                    return redirect()->route('login')->with('status', 'Your account is blocked, please contact support via live chat for further details');
                }

                //send the login code to the user
                /*$loginObject = $this->authenticateLogin->LoginAuthMaker($user);
                return redirect()->route('login_authenticator')->with('success_message', 'A mail bearing your login authentication code have been sent your email address. please visit your email address and supply code below to continue');*/
                return redirect()->route('home');

            }else{

                if($user->account_name === null) {
                    return redirect()->route('account_validation', [$user->unique_id])->with('success_message', 'Please add your account details');
                }

                return redirect()->route('home');
            }

        }

    }


}
