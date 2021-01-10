<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CheckAccountNumber
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
        //account_name, account_number, bank, bank_code
        if($request->user()->account_name === null && $request->user()->type_of_user === 'user'){
            return redirect()->route('account_validation', [$request->user()->unique_id])->with('error_message', 'Please verify your account number');
        }
        return $next($request);
    }
}
