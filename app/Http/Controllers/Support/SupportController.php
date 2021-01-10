<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use App\Models\Support;
use App\Models\SupportMedia;
use App\Models\SupportReply;
use App\Models\User;
use App\Traits\Generics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SupportController extends Controller
{
    use Generics;

    function __construct(User $user, Support $support, SupportReply $supportReply, SupportMedia $supportMedia)
    {
        $this->middleware('auth');
        $this->user = $user;
        $this->support = $support;
        $this->supportReply = $supportReply;
        $this->supportMedia = $supportMedia;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($userid = null)
    {

        if($userid !== null){
            $support = $this->support::where('sender_id', $userid)->orWhere('receiver_id', $userid)->paginate(20);
        }
        if($userid === null){
            $support = $this->support::orderBy('created_at', 'desc')->simplePaginate(20);
        }
        return view('support.support-inbox', ['support'=>$support]);
    }

    public function indexCompose($userid = null)
    {
        if($userid !== null){
            $support = $this->support::where('sender_id', $userid)->orWhere('receiver_id', $userid)->simplePaginate(20);
        }
        if($userid === null){
            $support = $this->support::simplePaginate(20);
        }
        return view('support.compose', ['support'=>$support]);
    }

    public function indexSingle($supportId)
    {
        $userDetails = Auth::user();
        $single_support = $this->support->getSingleRow($supportId);

        //update the message receiver if that have not be done before and also update the read status
        $this->updateSupportDetails($single_support, $userDetails);

        //return the view
        return view('support.single_message', ['single_support'=>$single_support]);
    }

    function updateSupportDetails($single_support, $userDetails){

        //update the message receiver if that have not be done before and also update the read status
        if($single_support->receiver_id === null || $single_support->sender_id === ''){
            if($userDetails->unique_id !== $single_support->sender_id && $userDetails->type_of_user === 'admin'){
                $single_support->receiver_id = $userDetails->unique_id;

            }
        }
        $single_support->read_status = $userDetails->unique_id;
        $single_support->save();

        //update the replies
        $conditions = [
            ['support_id', '=', $single_support->unique_id],
            ['read_status', '=', null]
        ];
        //add the type of user condition
        if($userDetails->type_of_user === 'user'){$conditions[] = ['sender_type', '!=', 'user'];}
        if($userDetails->type_of_user === 'user'){$conditions[] = ['sender_type', '!=', 'admin'];}
        $SupportReply = $this->supportReply->getRowsWhere($conditions);
        if(count($SupportReply) > 0){
            foreach($SupportReply as $k => $EachSupportReply){
                $EachSupportReply->receiver_id = $userDetails->unique_id;
                $EachSupportReply->read_status = $userDetails->unique_id;
                $EachSupportReply->save();
            }
        }

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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $mainSupportId = null)
    {
        $userDetails = Auth::user();

        //title_ message file_name
        $validate = $this->handleValidation($request->all());
        if($validate->fails()){
            //return $validate->getMessageBag();
            return Redirect::back()->withErrors($validate->getMessageBag());
        }

        $user_photo_name_array = [];
        if(isset($request->file_name)){

            //process the file
            $imageArray = $request->file_name;
            if(count($request->file_name) == 1){
                if($request->file_name[0] === null){
                    $imageArray = [];
                }
            }

            if (count($imageArray) > 0) {

                $imageValidation = $this->validateImage(['jpeg','jpg','png','gif','webp'], $_FILES['file_name']['name']);
                if($imageValidation['status'] === false){
                    return Redirect::back()->withErrors(['file_name'=>$imageValidation['error']]);
                }

                $files = $request->file_name;
                foreach($files as $k => $file){
                    $user_photo = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                    $destinationPath_r = storage_path('app/public/img/support_file/');
                    $file->move($destinationPath_r, $user_photo);
                    $user_photo_name_array[] = $user_photo;
                }

            }
        }

        $request->sender_type = $userDetails->type_of_user;
        if($mainSupportId === null){
            $request->file_name = 'none';
            $support = $this->support->createNewSupport($request);
        }else if($mainSupportId !== null){
            $request->support_id = $mainSupportId;
            $request->file_name = 'none';
            $support = $this->supportReply->createNewSupportReply($request);
        }


        if($support && count($user_photo_name_array) > 0){//insert video urls in the db
            foreach($user_photo_name_array as $p => $each_user_photo_name_array){
                $request->support_id = $support->unique_id;
                $request->file_name = $each_user_photo_name_array;
                $this->supportMedia->createNewSupportMedia($request);
            }
        }

        if ($support) {
            return Redirect::back()->with('success_message', 'Support was successfully created');
        } else {
            return Redirect::back()->with('error_message', 'An Error occurred, Please try Again Later');
        }
    }

    function handleValidation(array $data){

        $validator = Validator::make($data, [
            'title_' => 'required|string',
            'message' => 'required|string',
            'file_name' => 'nullable|array',
            //'file_name.*' => 'required|mimes:jpeg,jpg,png,gif,webp|max:2048',
        ]);

        return $validator;

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

    //support nofication method
    function supportNotifier(){

        $userDetails = Auth::user();//get the user details

        if($userDetails->type_of_user === 'user'){
            $MainSupport = $this->support->getRowsWhere([
                ['receiver_id', '=', $userDetails->unique_id],
                ['read_status', '=', null],
                ['sender_type', '=', 'user'],
            ])->count();

            $replySupport = $this->supportReply->getRowsWhere([
                ['receiver_id', '=', $userDetails->unique_id],
                ['read_status', '=', null]
            ])->count();
        }

        if($userDetails->type_of_user !== 'user'){
            $MainSupport = $this->support->getRowsWhere([
                ['sender_type', '!=', 'admin'],
                ['read_status', '=', null]
            ])->count();

            $replySupport = $this->supportReply->getRowsWhere([
                ['sender_type', '!=', 'admin'],
                ['read_status', '=', null]
            ])->count();
        }


        return response()->json(['count'=>$MainSupport + $replySupport]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $dataToDelete = $request->dataArray; $deleteStatus = 0;
        foreach ($dataToDelete as $k => $eachDataToDelete){

            $supportObj = $this->support->getSingleRow($eachDataToDelete);
            $supportReplyArray = $this->supportReply::where('support_id', $supportObj->unique_id)->get();
            if(count($supportReplyArray) > 0){
                foreach($supportReplyArray as $k => $eachReply){
                    $eachReply->delete();
                }
            }
            if($supportObj->delete()){
                $deleteStatus = 1;
            }
        }

        if($deleteStatus == 1){
            return response()->json(['error_code'=>0, 'success_statement'=>'Selected Messages was deleted successfully']);
        }

        return response()->json(['error_code'=>1, 'error_message'=>'An error occurred, Please try again']);

    }
}
