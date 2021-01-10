<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\CanResetPassword;
use App\Traits\Generics;
use Carbon\Carbon;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, CanResetPassword, Generics;

    //primary key
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'email',
        'password',
        'unique_id',
        'username',
        'phone',
        'gender',
        'type_of_user',
        'alt_password',
        'referer_unique_id',
        'preferred_center',
        'preferred_currency',
        'first_time_login'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //find one user
    function getOneModel($userId){
        return User::find($userId);
    }

    //get all users
    function getAllModel($columnNameForOrder = 'id', $order = 'desc'){
        return User::orderBy($columnNameForOrder, $order)->get();
    }

    //get all admin
    function getAllAdminWhere($type_of_user, $columnNameForOrder = 'id', $order = 'desc'){
        return User::where('type_of_user', $type_of_user)->orderBy($columnNameForOrder, $order)->get();
    }

    //get all admin
    function getUsersWithCondition($conditions, $columnNameForOrder = 'id', $order = 'desc'){
        return User::where($conditions)->orderBy($columnNameForOrder, $order)->get();
    }

    function updateUserModel($request){
        //name, email, phone, email_verified_at, username, password, gender,date_of_birth,address,city,state,country,profile_image,account_name,account_number,bank,bank_code,referer_unique_id,status,type_of_user,preferred_currency,balance,unique_id,remember_token
        $userModel = User::find($request->unique_id);
        $userModel->name = $request->name ?? $userModel->name;
        $userModel->email = $request->email ?? $userModel->email;
        $userModel->phone = $request->phone ?? $userModel->phone;
        $userModel->email_verified_at = $request->email_verified_at ?? $userModel->email_verified_at;
        $userModel->password = $request->password ?? $userModel->password;
        $userModel->gender = $request->gender ?? $userModel->gender;
        $userModel->date_of_birth = $request->date_of_birth ?? $userModel->date_of_birth;
        $userModel->remember_token = $request->remember_token ?? $userModel->remember_token;
        $userModel->profile_image = $request->profile_image ?? $userModel->profile_image;
        $userModel->type_of_user = $request->type_of_user ?? $userModel->type_of_user;
        $userModel->preferred_currency = $request->preferred_currency ?? $userModel->preferred_currency;
        $userModel->balance = $request->balance ?? $userModel->balance;

        $userModel->account_name = $request->account_name ?? $userModel->account_name;
        $userModel->account_number = $request->account_number ?? $userModel->account_number;
        $userModel->bank = $request->bank ?? $userModel->bank;
        $userModel->bank_code = $request->bank_code ?? $userModel->bank_code;
        $userModel->status = $request->status ?? $userModel->status;

        $userModel->gender = $request->gender ?? $userModel->gender;
        $userModel->date_of_birth = $request->date_of_birth ?? $userModel->date_of_birth;
        $userModel->address = $request->address ?? $userModel->address;
        $userModel->city = $request->city ?? $userModel->city;
        $userModel->state = $request->state ?? $userModel->state;
        $userModel->country = $request->country ?? $userModel->country;
        $userModel->preferred_center = $request->preferred_center ?? $userModel->preferred_center;

        $userModel->save();

        return $userModel;
    }

    function getUserBalanceForView($userId){
        //get the logged in user
        $loggedInUser = Auth::user();

        //get the user that has the balance
        $userObject = User::where('unique_id', $userId)->first();//get the user details
        //get the withdrawn amount for this user
        $withDrawnBalance = TransactionModel::where('user_unique_id', $userObject->unique_id)->where('action_type', 'withdrawal')->where('status', 'pending')->sum('amount');
        //calculate users main balance

        //calculate exchange rate
        $mainAmountDetails = CurrencyRatesModel::calculateExchangeRate($loggedInUser, $userObject->balance, 'sending_to_view');
        $withDrawnAmountDetails = CurrencyRatesModel::calculateExchangeRate($loggedInUser, $withDrawnBalance, 'sending_to_view');
        return [
            'currency'=>$mainAmountDetails['data']['currency'],
            'main'=>$mainAmountDetails['data']['amount'],
            'withdrawn'=>$withDrawnAmountDetails['data']['amount']
        ];

    }

    function getBalanceForView($userId){
        //get the logged in user
        $loggedInUser = Auth::user();

        //get the user that has the balance
        $userObject = User::where('unique_id', $userId)->first();//get the user details
        //get the withdrawn amount for this user
        $withDrawnBalance = TransactionModel::where('user_unique_id', $userObject->unique_id)->where('action_type', 'withdrawal')->where('status', 'pending')->sum('amount');
        //calculate users main balance
        $mainBalance = $withDrawnBalance + $userObject->balance;

        //calculate exchange rate
        $amountDetails = CurrencyRatesModel::calculateExchangeRate($loggedInUser, $mainBalance, 'sending_to_view');
        return $amountDetails;

    }

    public function currency_details(){
        return $this->belongsTo('App\Models\CurrencyRatesModel', 'preferred_currency');
    }

    public function centers(){
        return $this->belongsTo('App\Models\COllectionCenters', 'preferred_center');
    }

    public function getTotalAmountSpentOnGames($userId){
        return $amountSum = GamesPlayed::select('amount_stacked')->where('user_unique_id', $userId)->get()->sum('amount_stacked');
        /*$amountSum = $this->getAmountForView($amountSum);
        return $amountSum;*/
    }

    function getAmountForView($amount){
        if(Auth::check()){
            $userObject = Auth::user();
        }else{
            $appSettings = new AppSettings();
            $appSettings = $appSettings->getSingleModel();
            $appSettings->preferred_currency = $this->returnMainCurrencyUniqueId();
            $userObject = $appSettings;
        }
        $amountDetails = CurrencyRatesModel::calculateExchangeRate($userObject, $amount, 'sending_to_view');
        return $amountDetails;

    }

    function returnLink(){

        if(env('APP_ENV', 'production')){
            return 'storage/public/img/';
        }else{
            return 'storage/img/';
        }

    }

    //get the referral count for the selected admin
    function referralDetails($userId){

        $allCount = 0; $allActiveCount = 0;
        $userReferrals = User::where('referer_unique_id', $userId);
        if($userReferrals->count() > 0){
            $allCount = $userReferrals->count();
            $userReferralsArray = $userReferrals->get();
            foreach($userReferralsArray as $k => $eachUserRefferals){
                //select the detaills of users that have made an investment for the past 30 days
                $date2 = Carbon::now()->toDateString();
                $date1 = Carbon::now()->subDays(30)->toDateString();
                $activeReferralCount = GamesPlayed::where('user_unique_id', '>=', $eachUserRefferals->unique_id)->where('created_at', '>=', $date1)->where('created_at', $date2)->count();
                if($activeReferralCount > 0){
                    $allActiveCount = $activeReferralCount;
                }
            }
        }
        return ['all_count'=>$allCount, 'all_active_count'=>$allActiveCount];

    }

    //for checking the if a user has to add review
    function checkUserTestimonyStatus(){

        if(Auth::check()){
            $AppSettings = new AppSettings();
            $noOfDaysToNextTestimony = $AppSettings->getSingleModel()->no_of_days_to_review;
            $userObject = Auth::user();
            $testimony = Testimony::where('user_unique_id', $userObject->unique_id)->orderBy('created_at', 'desc')->limit(1)->first();
            $dateNow = Carbon::now()->toDateTimeString();

            if($testimony !== null){
                $nextThirtyDays = Carbon::parse($testimony->created_at)->addDays($noOfDaysToNextTestimony)->toDateTimeString();

                if($dateNow > $nextThirtyDays){
                    return 'review';
                }

            }

            if($testimony === null){
                $nextThirtyDaysAfterReg = Carbon::parse($userObject->created_at)->addDays($noOfDaysToNextTestimony)->toDateTimeString();

                if($dateNow > $nextThirtyDaysAfterReg){
                    return 'review';
                }

            }

            return 'dont-review';

        }

    }

    function getAllWhere($conditions,$columnNameForOrder = 'created_at', $order = 'desc'){
        return User::where($conditions)->orderBy($columnNameForOrder, $order)->get();
    }

    function privilegeChecker($role){

        $userDetails = Auth::user();
        $userType = $userDetails->type_of_user;
        $typOfUserDetails = UserTypesModel::where('type_of_user', $userType)->first();
        $roleDetails = RolesModel::where('role', $role)->first();
        //get the previledges
        $priviledgesDetails = Previledges::where('role_id', $roleDetails->unique_id)->where('type_of_user_id', $typOfUserDetails->unique_id)->first();
        if($priviledgesDetails !== null){
            return true;
        }
        return false;
    }

    /*function handleErrors($key){

        if(isset()){

        }

    }*/


}
