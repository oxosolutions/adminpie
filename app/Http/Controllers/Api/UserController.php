<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\GlobalOrganization;
use Session;
use DB;
use Hash;
class UserController extends Controller
{

    /**
     * { function_description }
     *
     * @param      \Illuminate\Http\Request  $request  The request
     *
     * @return     <type>                    ( description_of_the_return_value )
     */
    public function updatePassword(Request $request){
        $result = $this->validateUpdatePassword($request);
        if($result){
            $activationStatus = $this->validateActivationCode($request);
            if($activationStatus == false){
                return response()->json(['status'=>'error','message'=>'Activation code seems to wrong!'],500);
            }
            $groupID = $activationStatus->group_id;
            $model = DB::table('group_'.$groupID.'_users')->where('id',$request->user_id)->first();
            if($model == null){
                return response()->json(['status'=>'error','message'=>'User does not exists!']);
            }
            if(!Hash::check($request->old_password,$model->password)){
                return response()->json(['status'=>'error','message'=>'Old password not macthed!']);
            }
            $dataToUpdate = [
                'password'  =>  Hash::make($request->new_password),
                'app_password' => $request->new_password
            ];
            DB::table('group_'.$groupID.'_users')->where('id',$request->user_id)->update($dataToUpdate);
            return response()->json(['status'=>'success','message'=>'Password changed successfully!']);
        }else{
            return response()->json(['status'=>'error','message'=>'Required fields are missing!']);
        }
    }


    /**
     * { function_description }
     *
     * @param      <type>   $request  The request
     *
     * @return     boolean  ( description_of_the_return_value )
     */
    protected function validateUpdatePassword($request){
        $required = ['old_password','new_password','confirm_password','user_id','activation_code'];
        foreach($required as $key => $field){
            if(in_array($field,$request->all())){
                return false;
            }
        }
        return true;
    }


    /**
     * { Will update user profile information }
     * @param      \Illuminate\Http\Request  $request  The request
     * @return     <type>  ( description_of_the_return_value )
     */
    public function updateProfile(Request $request){
        $result = $this->validateUpdateProfile($request);
        if($result){
            $activationStatus = $this->validateActivationCode($request);
            if($activationStatus == false){
                return response()->json(['status'=>'error','message'=>'Activation code seems to wrong!'],500);
            }
            Session::put('organization_id',$activationStatus->id);
            $groupID = $activationStatus->group_id;
            $updateData = [
                'email' => $request->email,
                'name' => $request->name
            ];
            $validateEmail = DB::table('group_'.$groupID.'_users')->where('email',$request->email)->first();
            if($validateEmail != null){
                return response()->json(['status'=>'error','message'=>'Email id already in use!'],500);
            }
            $model = DB::table('group_'.$groupID.'_users')->where('id',$request->user_id)->update($updateData);
            return response()->json(['status'=>'success','message'=>'Profile updated successfully!']);
        }else{
            return response()->json(['status'=>'error','message'=>'Required fields are missing!'],500);
        }
    }


    /**
     * { function_description }
     *
     * @param      <type>   $request  The request
     *
     * @return     boolean  ( description_of_the_return_value )
     */
    protected function validateUpdateProfile($request){
        $required = ['activation_code','email','name','user_id'];
        foreach($required as $key => $field){
            if(!$request->has($field)){
                return false;
            }
        }
        return true;
    }


    /**
     * { function_description }
     *
     * @param      <type>   $request  The request
     *
     * @return     boolean  ( description_of_the_return_value )
     */
    protected function validateActivationCode($request){
        $activationStatus = GlobalOrganization::where('active_code',$request->activation_code)->first();
        if($activationStatus == null){
            return false;
        }else{
            return $activationStatus;
        }
    }
}
