<?php

namespace App\Http\Controllers\Organization\settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\UsersMeta;
use Auth;
use Session;
class SettingsController extends Controller
{
    /**
     * user setting funciton in organization
     *
     * @return view
     * @author Rahul
     **/
    public function user_settings(){

    	$model = UsersMeta::get();
    	$modelArray = [];
    	foreach($model as $key => $value){
    		$modelArray[$value->key] = $value->value;
    	}
    	return view('organization.settings.user',['model'=>$modelArray]);
    }

    /**
     * save user settings in user_meta
     *
     * @return bollean
     * @author Rahul
     **/
    public function save_user_settings(Request $request){

		foreach($request->except(['_token']) as $key  => $value){
			$model = UsersMeta::firstOrNew(['key'=>$key]);
			$model->key = $key;
			$model->value = $value;
			$model->user_id = Auth::guard('org')->user()->id;
			$model->save();
		}
		Session::flash('success', 'Successfully Updated!');
		return redirect()->route('setting.user');
    }
}
