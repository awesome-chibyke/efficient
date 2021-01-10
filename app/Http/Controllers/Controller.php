<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function updateFirstTime(){

        $allUsers = User::where('email_verified_at', null)->get();
        if(count($allUsers) > 0){

            foreach($allUsers as $k => $eachUser){
                $eachUser->first_time_login = 'yes';
                $eachUser->save();
            }

        }

    }

}
