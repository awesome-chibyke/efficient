<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Traits\AppSettings;
use App\Traits\Generics;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails, Generics, AppSettings;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    function showNotice(){
        $data = $this->createArrayForView();
        return view('auth.verify-email', $data);
    }

    function sendVerificationEmailNotification(Request $request){

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');

    }

    function verifyEmailHandler(EmailVerificationRequest $request){

        $request->fulfill();

        //get the user and update user first time login to no
        $user = Auth::user();
        $user->first_time_login = 'no';
        $user->save();

        return redirect('/home');

    }

}
