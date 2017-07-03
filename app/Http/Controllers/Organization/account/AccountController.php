<?php

namespace App\Http\Controllers\Organization\account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Model\Organization\User;
use Hash;
use Carbon\Carbon;
use App\Model\Organization\EmployeeMeta;
use App\Model\Organization\UsersMeta as UM;
use App\Model\Organization\LogSystem as LS;

class AccountController extends Controller
{
     public function emailsList(){
        return view('organization.profile.email');
    }

    protected function listActivities()
    {
        $user_id = Auth::guard('org')->user()->id;
        $user_log = LS::where('user_id',$user_id)->orderBy('id','DESC')->limit(10)->get();
        return $user_log;        
    }

    /**
     * Public function to view all prefilled details of user profile
     * @param  $id having user id
     * @return view
     */
    public function profileDetails($id = null){
        $user_log = $this->listActivities();
    	if($id == null){
    		$id = Auth::guard('org')->user()->id;
    	}
    	$userDetails = User::with(['employee_rel'=>function($query){
            $query->with(['department_rel','designation_rel','employeeMeta']);
        },'metas'])->find($id);
        // dd($userDetails);
        $userDetails->password = '';
        if($userDetails->employee_rel != null){
            @$userDetails->employee_id = $userDetails->employee_rel->employee_id;
            @$userDetails->department = $userDetails->employee_rel->department_rel->id;
            if($userDetails->employee_rel->designation_rel != null){
                $userDetails->designation = $userDetails->employee_rel->designation_rel->id;
            }
        }
        // dd($userDetails);
        @$userDetails->marital_status = $userDetails->employee_rel->marital_status;
        @$userDetails->date_of_joining = Carbon::parse($userDetails->employee_rel->joining_date)->format('Y-m-d');
        if($userDetails->employee_rel != null){
            foreach(@$userDetails->employee_rel->employeeMeta as $key => $value){
                $userDetails->{$value->key} = $value->value;
            }
        }
        if(!$userDetails->metas->isEmpty()){
            foreach($userDetails->metas as $key => $value){
                $userDetails->{$value->key} = $value->value;
            }
        }
        // dd($userDetails);
    	return view('organization.profile.view',['model' => $userDetails , 'user_log' => $user_log]);
    }

    /**
     * To update user details
     * @param  Request $request contains post requests data
     * @param  $id  user id which one we have to update
     * @return back function to go back the previous page
     */
    public function update(Request $request, $id){
        // dd($request->all());
        $userDetails = User::find($id);
        if($request->password != null && $request->password != ''){
            $userDetails->password = Hash::make($request->password);
        }
        $userDetails->name = $request->name;
        $userDetails->email = $request->email;
        $userDetails->save();
        $remainingMeta = $request->except([
                            '_method','_token','name','email','password','action'
                        ]);
        foreach($remainingMeta as $key => $value){
            $metaModel = UM::firstOrNew(['user_id'=>$id,'key'=>$key]);
            $metaModel->key = $key;
            $metaModel->value = $value;
            $metaModel->user_id = $id;
            $metaModel->save();
        }
        return back();
    }

    public function storeMeta(Request $request, $id){
        $request = $request->except([
                            '_method','_token'
                        ]);
        if($request['meta_table'] == 'usermeta'){
            foreach($request as $key => $value){
                if($value != null && $value != ''){
                    $metaModel = UM::firstOrNew(['user_id'=>$id,'key'=>$key]);
                    $metaModel->key = $key;
                    $metaModel->value = $value;
                    $metaModel->user_id = $id;
                    $metaModel->save();
                }
            }
        }
        if($request['meta_table'] == 'employeemeta'){
            foreach($request as $key => $value){
                if($value != null && $value != ''){
                    $metaModel = EmployeeMeta::firstOrNew(['employee_id'=>$id,'key'=>$key]);
                    $metaModel->key = $key;
                    $metaModel->value = $value;
                    $metaModel->employee_id = $id;
                    $metaModel->save();
                }
            }
        }
        return back();
    }
    public function uploadProfile( Request $request )
    {
        $destinationPath = 'ProfilePicture'; 
        $extension = $request->file('aione-dp')->getClientOriginalExtension(); 
        $fileName = $request->file('aione-dp')->getClientOriginalName(); 
        $request->file('aione-dp')->move($destinationPath, $fileName); 

        //get user id
        if(Auth::guard('admin')->check()){
            $id = Auth::guard('admin')->user()->id;
        }else{
            $id = Auth::guard('org')->user()->id;
        }
        //upload profie picture
        $model          = new UM;
        $model->user_id  = $id; 
        $model->key      = "profilePic"; 
        $model->value   = $fileName;
        $model->type    = "";
        $model->save();
        
        return back();
    }
}
