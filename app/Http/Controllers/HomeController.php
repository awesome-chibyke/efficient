<?php

namespace App\Http\Controllers;

use App\Models\COllectionCenters;
use App\Models\InvestmentStore;
use App\Models\News;
use App\Models\TransactionModel;
use App\Models\User;
use App\Traits\AppSettings;
use App\Traits\ErrorHelper;
use App\Traits\Generics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    use AppSettings, Generics, ErrorHelper;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user, InvestmentStore $investmentStore, COllectionCenters $COllectionCenters, News $news, TransactionModel $transactionModel)
    {

        $this->middleware(['auth', 'verified', 'Authenticate_Login', 'verify_account']);//->middleware('verified');
        $this->user = $user;
        $this->investmentStore = $investmentStore;
        $this->COllectionCenters = $COllectionCenters;
        $this->news = $news;
        $this->transactionModel = $transactionModel;
    }

    protected function Validator($request){

        $this->validator = Validator::make($request->all(), [//site_name 	address1 	address2 	email1 	site_url
            'oldPassword' => 'required',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|min:8',
        ]);

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /*$walletBalance = $this->getWalletBalance();
        $DueInvestments = $this->getDueInvestments();
        $getActiveInvestments = $this->getActiveInvestments();
        $getAmountSpentOnInvestment = $this->getAmountSpentOnInvestment();
        $getAmountGotFromInvestment = $this->getAmountGotFromInvestment();*/
        $news = $this->getNews();
        /*$allPendingWithdrawals = $this->getAllPendingWithdrawalsRequest();
        $allPendingToUp = $this->getAllPendingTopUps();
        ['walletBalance'=>$walletBalance, 'getActiveInvestments'=>$getActiveInvestments, 'getAmountSpentOnInvestment'=>$getAmountSpentOnInvestment, 'getAmountGotFromInvestment'=>$getAmountGotFromInvestment, 'DueInvestments'=>$DueInvestments, 'news'=>$news, 'allPendingWithdrawals'=>$allPendingWithdrawals, 'allPendingToUp'=>$allPendingToUp]*/
        $data = $this->createArrayForView(['news'=>$news]);
        return view('dashboard.index', $data);

    }

    function getNews(){

        return $this->news->getAllRows();

    }

    function getDueInvestments(){

        $userDetails = Auth::user();
        if($userDetails->type_of_user === 'user'){
            $DueInvestments = $this->investmentStore::where('user_unique_id', $userDetails->unique_id)
                ->where('status', 'processing_rewards')
                ->get();

        }else{
            $DueInvestments = $this->investmentStore::where('status', 'processing_rewards')
                ->get();
        }
        return $DueInvestments;

    }

    function getAllPendingWithdrawalsRequest(){

        return $this->transactionModel->getAllWithConditions([
            ['type_of_user', '=', 'user'],
            ['action_type', '=', 'withdrawal'],
            ['status', '=', 'pending']
        ]);

    }

    function getAllPendingTopUps(){

        return $this->transactionModel->getAllWithConditions([
            ['type_of_user', '=', 'user'],
            ['action_type', '=', 'top_up'],
            ['status', '=', 'pending']
        ]);

    }

    function getAmountSpentOnInvestment(){//amount spent so far on investment

        $userDetails = Auth::user();
        if($userDetails->type_of_user === 'user'){
            $amountSpentOnInvestments = $this->investmentStore::where('user_unique_id', $userDetails->unique_id)
                ->where(function ($query) {
                    $query->where('status', 'done')
                        ->orWhere('status', 'active')
                        ->orWhere('status', 'processing_rewards');
                })
                ->get();

        }else{
            $amountSpentOnInvestments = $this->investmentStore::where(function ($query) {
                    $query->where('status', 'done')
                        ->orWhere('status', 'active')
                        ->orWhere('status', 'processing_rewards');
                })
                ->get();
        }
        return $amountSpentOnInvestments;
    }

    function getAmountGotFromInvestment(){//amount gotten so far from investments

        $userDetails = Auth::user();
        if($userDetails->type_of_user === 'user'){
            $amountGottenFromInvestments = $this->investmentStore::where('user_unique_id', $userDetails->unique_id)
            ->where(function ($query) {
                $query->where('status', 'done')
                    ->orWhere('status', 'processing_rewards');
            })
                ->get();
        }else{
            $amountGottenFromInvestments = $this->investmentStore::where(function ($query) {
                    $query->where('status', 'done')
                        ->orWhere('status', 'processing_rewards');
                })
                ->get();
        }
        return $amountGottenFromInvestments;
    }


    public function getActiveInvestments(){

        $userDetails = Auth::user();
        if($userDetails->type_of_user === 'user'){
            $activeInvestment = $this->investmentStore->getRowsWhere([
                ['user_unique_id', '=', $userDetails->unique_id],
                ['status', '=', 'active'],
            ]);
        }else{
            $activeInvestment = $this->investmentStore->getRowsWhere([
                ['status', '=', 'active']
            ]);
        }
        return $activeInvestment;

    }

    public function getWalletBalance(){
        $userDetails = Auth::user();
        if($userDetails->type_of_user === 'user'){
            $walletBalance = $this->user->getOneModel($userDetails->unique_id);
        }else{
            $walletBalance = $this->user->getUsersWithCondition([
                ['type_of_user', '=', 'user']
            ]);
        }
        return $walletBalance;
    }

    public function profile($userID = ''){
        $user = empty($userID) ? Auth::user() : $this->user->getOneModel($userID);
        $data = $this->createArrayForView(['user'=>$user]);//compact( 'user')
        return view('dashboard.profile', $data);
    }

    public function editProfile($userID = ''){
        $user = empty($userID) ? Auth::user() : $this->user->getOneModel($userID);

        //get all centers
        $allCenters = $this->COllectionCenters->getAllRows('state_region_province', 'ASC');
        $centers = $this->returnStateAlphabetically($allCenters);

        $data = $this->createArrayForView(['userDetails'=>$user, 'centers'=>$centers]);//compact( 'userDetails')
        return view('dashboard.editProfile', $data);
    }

    public function updateProfile(Request $request){
        $userDetails = Auth::user();

        $request->unique_id = $userDetails->unique_id;
        $updated_user_details = $this->user->updateUserModel($request);

        if ($updated_user_details) {
            return redirect('/profile')->with('success_message', 'Your Profile Details Was Successfully Updated');
        } else {
            return redirect('/profile')->with('error_message', 'An Error occurred, Please try Again Later');
        }

    }

    public function updateCurrency(Request $request){
        $userDetails = Auth::user();

        $request->unique_id = $userDetails->unique_id;

        $updated_user_details = $this->user->updateUserModel($request);

        if ($updated_user_details) {
            return redirect('/settings_page')->with('success_message', 'Your Profile Details Was Successfully Updated');
        } else {
            return redirect('/settings_page')->with('error_message', 'An Error occurred, Please try Again Later');
        }

    }

    public function uploadUserImage(Request $request){
        $user_photo = null;
        $userDetails = Auth::user();

        $validator = Validator::make($request->all(), [
            'profile_image' => 'required|mimes:jpg,jpeg,png|max:500000',
        ]);

        if($validator->fails()){
            $message = $validator->getMessageBag();

            //return redirect('/settings_page')->with('error_message', $message);
            return response()->json(['status'=>false, 'message'=>$message]);
        }

        //code for remove old file
        if ($userDetails->profile_image !== null) {
            if(file_exists(storage_path('app/public/img/users/') . $userDetails->profile_image)){
                $file_old = storage_path('app/public/img/users/') . $userDetails->profile_image;
                unlink($file_old);
            }
        }

        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $user_photo = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $destinationPath_r = storage_path('app/public/img/users/');
            $file->move($destinationPath_r, $user_photo);
        }

        $userDetails = Auth::user();
        $userDetails->profile_image = $user_photo;

        if ($userDetails->save()) {
            //return redirect('/profile')->with('success_message', 'Your Profile Image Was Successfully Uploaded');
            return response()->json(['status'=>true, 'message'=>'Your Profile Image Was Successfully Uploaded']);
        } else {
            return response()->json(['status'=>true, 'message'=>'An Error occurred, Please try Again Later']);
            //return redirect('/profile')->with('error_message', 'An Error occurred, Please try Again Later');
        }
    }

    public function updatePassword(Request $request){
        $userDetails = Auth::user();

        $this->Validator($request);//validate fields


        if ($request->password !== $request->password_confirmation){
            return redirect('/settings_page')->with('error_message', 'Passwords Does Not Match');
        }

        if (Auth::attempt(['email' => $userDetails->email, 'password' => $request->oldPassword])) {

            $hashPassword2 = Hash::make($request->password);
            $hashPasswordAlt = $this->hashPassword($request->password);

            $userDetails->password = $hashPassword2;//Hash::make($request->password_confirmation)
            $userDetails->alt_password = $hashPasswordAlt;//Hash::make($request->password_confirmation)

            if ($userDetails->save()){
                return redirect('/settings_page')->with('success_message', 'Password Was Successfully Updated');
            }else{
                return redirect('/settings_page')->with('error_message', 'An Error occurred, Please try Again Later');
            }

        }

        return redirect('/settings_page')->with('error_message', 'Current password id not correct');


    }

}
