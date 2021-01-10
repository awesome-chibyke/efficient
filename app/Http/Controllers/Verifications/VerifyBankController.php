<?php

namespace App\Http\Controllers\Verifications;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\AppSettings;
use App\Traits\Generics;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyBankController extends Controller
{

    use Generics, AppSettings;

    public function __construct(User $user)
    {
        $this->middleware('auth');
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verifyBankInterface($userId = null)
    {
        $userDetails = $this->user->getOneModel($userId);
        $data = $this->createArrayForView(['userDetails'=>$userDetails]);
        return view('verifications.bank_verification', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Function to verify banks
     *
     * @return void
     */
    public function verifyBank(Request $request)
    {
        $bank_code = $request->bank_user;
        $account_number = $request->account_number_user;
        $response = $this->nubanVerify($account_number, $bank_code);
        if ($response) {
            //update users data
            return response()->json($response);
        } else {
            return response("failed");
        }
    }

    /**
     * Function  update bank details
     *
     * @param Request $request
     * @return void
     */
    public function addBank(Request $request, $userId){
        $user = $this->user->getOneModel($userId);
        $request->unique_id = $user->unique_id;
        $request->name = $request->account_name;
        $add_bank = $this->user->updateUserModel($request);

        if($add_bank){
            //return response()->json(['data'=> $add_bank, 'status' => 1]);
            return redirect()->route('profile')->with('success_message', 'Bank Details was successfully updated');
        }
    }

    /**
     * Function to verify paystack transaction
     * */
    public function nubanVerify($account_number = '', $bank_code = '')
    {
        $ch = curl_init();
        $query = http_build_query([
            'bank_code' => $bank_code,
            'acc_no' => $account_number
        ]);
        $url = "https://app.nuban.com.ng/api/NUBAN-IFQGEDVI173";
        $getUrl = $url . "?" . $query;
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $getUrl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 80);

        $response = curl_exec($ch);

        if (curl_error($ch)) {
            echo 'Request Error:' . curl_error($ch);
            return false;
        } else {
            return $response;
        }

        curl_close($ch);
        //function ends here
    }

}
