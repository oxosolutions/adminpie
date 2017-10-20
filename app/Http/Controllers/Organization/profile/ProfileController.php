<?php

namespace App\Http\Controllers\Organization\profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Model\Group\GroupUsers;
use App\Model\Organization\UsersMeta;
use App\Model\Organization\forms as Forms;
use App\Model\Organization\FormBuilder as FormBuilder;
use Session;
use Hash;
class ProfileController extends Controller
{
	/**
	 * [view view user profile]
	 * @return [type] [view]
	 * @author Rahul
	 */
    public function view(){

        $model = Auth::guard('org')->user();
        $additionalForm = UsersMeta::where(['key'=>'user_profile_form','user_id'=>Auth::guard('org')->user()->id])->first();
        if($additionalForm != null){
            $additionalForm = Forms::find($additionalForm->value);
            if($additionalForm != null){
                $form_slug = $additionalForm->form_slug;
            }
        }
        $form_id = [];
        $section_id = [];
        $getFormFields = Forms::where('form_slug',$form_slug)->with(['section'])->first();
        foreach($getFormFields->section as $k => $v){
            $form_id[] = $v->form_id;
            $section_id[] = $v->id;
        }
        $fields = FormBuilder::where(['form_id' => $form_id,'section_id'=> $section_id])->get();
        $AdditionalData = [];
        $AdditionalData['name'] = $model['name'];
        $AdditionalData['email'] = $model['email'];

        foreach ($fields as $key => $value) {
            $processMeta = UsersMeta::where(['user_id'=>Auth::guard('org')->user()->id , 'key'=>$value->field_slug])->first();
            if($processMeta != ''){
                $AdditionalData[$value->field_title] = $processMeta->value;
            }
        }
    	return view('organization.my-profile.preview',['model'=>$model,'AdditionalData'=>$AdditionalData]);
    }

    /**
     * [edit edit user profile page]
     * @return view 
     * @author Rahul
     */
    public function edit(){
    	$form_slug = null;
    	$model = Auth::guard('org')->user();
    	$processMeta = UsersMeta::where(['user_id'=>Auth::guard('org')->user()->id])->get();
    	foreach($processMeta as $key => $value){
    		$model[$value->key] = $value->value;
    	}
    	$additionalForm = UsersMeta::where(['key'=>'user_profile_form','user_id'=>Auth::guard('org')->user()->id])->first();
    	if($additionalForm != null){
    		$additionalForm = Forms::find($additionalForm->value);
    		if($additionalForm != null){
    			$form_slug = $additionalForm->form_slug;
    		}
    	}
    	return view('organization.my-profile.edit',['model'=>$model,'additional_form'=>$form_slug]);
    }

    /**
     * changePassword of user
     * @return view
     * @author Rahul 
     */
    public function changePassword(){

    	return view('organization.my-profile.changepassword');
    }


    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function getCurrentProfilePicture()
    {
        $user_id = get_user_id();
        $profilePic = UsersMeta::where(['user_id' => $user_id, 'key' => 'profilePic'])->first();
        return view('organization.my-profile.profilePic',['profilePic' => $profilePic]);
    }


    /**
     * update user password
     *
     * @return redirect
     * @author Rahul
     **/
    public function updatePassword(Request $request){
    	$this->validateUpdatePassword($request);
    	$model = Auth::guard('org')->user();
    	$old_password = $model->password;
    	if(Hash::check($request->old_password,$old_password)){
    		$model->password = Hash::make($request->new_password);
    		$model->save();
    		Session::flash('success', 'Password updated successfully!');
    		return back();
    	}else{
    		Session::flash('error','Old password do not match!');
    		return back();
    	}
    }

    /**
     * update current user password
     *
     * @return validateException object
     * @author Rahul
     **/
    protected function validateUpdatePassword($request){

    	$rules = [
    			'old_password' => 'required',
    			'new_password' => 'required',
    			'confirm_password' => 'required|same:new_password'
    	];

    	$this->validate($request, $rules);
    }

    /**
     * [updateProfile save user details]
     * @param  Request $request [posted data]
     * @return [type]           [boolean]
     * @author Rahul 
     */
    public function updateProfile(Request $request, $id){
    	$this->validateUpdateProfileFor($request);
    	$model = GroupUsers::find(Auth::guard('org')->user()->id);
    	$model->name = $request->name;
    	$model->email = $request->email;
    	$model->save();
    	foreach($request->except(['_token','email','name']) as $key => $value){
    		$userMetaModel = UsersMeta::firstOrNew(['key'=>$key]);
    		$userMetaModel->key = $key;
    		$userMetaModel->value = $value;
    		$userMetaModel->user_id = Auth::guard('org')->user()->id;
    		$userMetaModel->save();
    	}
    	Session::flash('success', 'Successfully updated!!');
    	return redirect()->route('profile.edit');
    }

    /**
     * validate update profile fields
     *
     * @return array
     * @author Rahul
     **/
    protected function validateUpdateProfileFor($request){

    	$rules = [
    		'name' => 'required',
    		'email' => 'required'
    	];

    	$this->validate($request,$rules);
    }
}
