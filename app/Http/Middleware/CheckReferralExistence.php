<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CheckReferralExistence
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
        if($request->referral_id !== null){
            $referrerDetails = User::find($request->referral_id);
            if($referrerDetails === null){
                return redirect()->route('show_registration_form')->withErrors(['referral_id'=>'Referral ID provided does not exist in our record, please review and try again']);

            }
        }
        return $next($request);
    }
}
