<?php

namespace App\Http\Controllers\Organization\account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Model\Organization\User;
use Hash;
use Carbon\Carbon;
use App\Model\Organization\EmployeeMeta;
class AccountController extends Controller
{
     public function emailsList(){
        return view('organization.profile.email');
    }

    /**
     * Public function to view all prefilled details of user profile
     * @param  $id having user id
     * @return view
     */
    public function profileDetails($id = null){
    	if($id == null){
    		$id = Auth::guard('org')->user()->id;
    	}
    	$userDetails = User::with(['employee_rel'=>function($query){
            $query->with(['department_rel','designation_rel','employeeMeta']);
        }])->find($id);
        $userDetails->password = '';
        if($userDetails->employee_rel != null){
            $userDetails->employee_id = $userDetails->employee_rel->employee_id;
            $userDetails->department = $userDetails->employee_rel->department_rel->id;
            if($userDetails->employee_rel->designation_rel != null){
                $userDetails->designation = $userDetails->employee_rel->designation_rel->id;
            }
        }
        // dd($userDetails);
        $userDetails->marital_status = $userDetails->employee_rel->marital_status;
        $userDetails->date_of_joining = Carbon::parse($userDetails->employee_rel->joining_date)->format('Y-m-d');
        foreach($userDetails->employee_rel->employeeMeta as $key => $value){
            $userDetails->{$value->key} = $value->value;
        }
    	return view('organization.profile.view',['model'=>$userDetails]);
    }

    /**
     * To update user details
     * @param  Request $request contains post requests data
     * @param  $id  user id which one we have to update
     * @return back function to go back the previous page
     */
    public function update(Request $request, $id){
        $userDetails = User::with(['employee_rel'=>function($query){
            $query->with(['department_rel','designation_rel']);
        }])->find($id);
        if($request->password != null && $request->password != ''){
            $userDetails->password = Hash::make($request->password);
        }
        $userDetails->employee_rel->employee_id = $request->employee_id;
        $userDetails->email = $request->email;
        $userDetails->employee_rel->department = @$request->department;
        $userDetails->employee_rel->joining_date = Carbon::parse(@$request->date_of_joining)->format('Y-m-d');
        $userDetails->employee_rel->designation = @$request->designation;
        $userDetails->name = $request->name;
        $userDetails->email = $request->email;
        $userDetails->save();
        $userDetails->employee_rel->save();
        $remainingMeta = $request->except([
                            '_method','_token','name','email','password','employee_id','designation','department','date_of_joining'
                        ]);
        foreach($remainingMeta as $key => $value){
            $metaModel = EmployeeMeta::firstOrNew(['employee_id'=>$id,'key'=>$key]);
            $metaModel->key = $key;
            $metaModel->value = $value;
            $metaModel->employee_id = $id;
            $metaModel->save();
        }
        return back();
    }
}
