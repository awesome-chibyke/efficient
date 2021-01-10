<?php

namespace App\Models;

use App\Mail\AuthCodeSender;
use App\Mail\LoginAuthentication;
use App\Mail\SuccessFullInvestment;
use App\Traits\Generics;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;

class AuthenticateLogin extends Model
{
    use HasFactory, Generics;

    //primary key
    protected $primaryKey = 'unique_id';
    //public $incrementing = false;

    function sendLoginAuthMail($code, $userDetails){
        $appSettings = new AppSettings();
        //send a mail to the user
        $userDetails['settings'] = $appSettings->getSingleModel();
        $userDetails['code'] = $code;
        Mail::to($userDetails)->send(new LoginAuthentication($userDetails));
    }

    //update and send the login auth code
    function LoginAuthMaker($user){

        //update former unused auths to cancelled
        $formerLoginAuth = AuthenticateLogin::where('user_unique_id', $user->unique_id)->where('status', null)->get();
        if(count($formerLoginAuth) > 0){
            foreach($formerLoginAuth as $k => $eachAuth){
                $eachAuth->status = 'cancelled';
                $eachAuth->save();
            }
        }

        //create a unique id
        $loginUnique_id = $this->createUniqueId('users', 'current_login_hash');

        //save new code to user db
        $user->current_login_hash = $loginUnique_id;
        $user->save();

        //send message to the user bearing the created code
        $code = $this->randomStringCreator('nozero', 4);

        //array of the created login auth
        $authArray = ['unique_id'=>$loginUnique_id, 'user_unique_id'=>$user->unique_id, 'code'=>$code, 	'status'=>null];
        //create an object from an array of the datas to inserted into the login auth table
        $authObj = $this->returnObject($authArray);

        //add data from the returned object to the db
        $loginObject = $this->createNewAuthCode($authObj);

        //send an email to the users email address with the code for authentication
        if($loginObject){
            $this->sendLoginAuthMail($code, $user);
            return $loginObject;
        }

    }

    function createNewAuthCode($request){
        //unique_id 	user_unique_id 	code 	status
        $AuthenticateLogin = new AuthenticateLogin();
        $AuthenticateLogin->unique_id = $request->unique_id;
        $AuthenticateLogin->user_unique_id = $request->user_unique_id;
        $AuthenticateLogin->code = $request->code;
        $AuthenticateLogin->status = $request->status;
        $AuthenticateLogin->save();
        return $AuthenticateLogin;
    }

    function updateAuthCode($request){
        //unique_id 	user_unique_id 	code 	status
        $AuthenticateLogin = AuthenticateLogin::find($request->unique_id);
        $AuthenticateLogin->user_unique_id = $request->user_unique_id ?? $AuthenticateLogin->user_unique_id;
        $AuthenticateLogin->code = $request->code ?? $AuthenticateLogin->code;
        $AuthenticateLogin->status = $request->status ?? $AuthenticateLogin->status;
        $AuthenticateLogin->save();
        return $AuthenticateLogin;
    }

    function getSingleRow($uniqueId){

        return AuthenticateLogin::find($uniqueId);

    }

    function getSingleRowWhere($conditions){

        return AuthenticateLogin::where($conditions)->first();

    }

    function getAllRows($orderColumn = 'created_at', $orderType = 'desc'){

        return AuthenticateLogin::orderBy($orderColumn, $orderType)->get();

    }

    function getRowsWhere($conditions, $orderColumn = 'created_at', $orderType = 'desc'){

        return AuthenticateLogin::where($conditions)->orderBy($orderColumn, $orderType)->get();

    }

}
