<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('main_key')) {
            if($request->user()->first_time_login === 'no' && $request->user()->email_verified_at !== null){
                $AuthenticateLogin = new \App\Models\AuthenticateLogin();
                $uniqueId = $request->user()->unique_id;
                //check if the user has a live code on the authenticator
                $checkLoginAuth = \App\Models\AuthenticateLogin::where('user_unique_id', $uniqueId)->where('status', null)->first();

                if($checkLoginAuth !== null){
                    //send login auth mail
                    $loginAuthObject = $AuthenticateLogin->LoginAuthMaker($request->user());
                    if($loginAuthObject){
                        return redirect()->route('login_authenticator')->with('success_message', 'A mail bearing your login authentication code have been sent your email address. please visit your email address and supply code below to continue');
                    }

                }
            }
        }


        return $next($request);
    }
}
