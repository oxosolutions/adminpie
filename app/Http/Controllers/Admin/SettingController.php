<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\GlobalSetting;
class SettingController extends Controller
{
	public function list_setting(){
		$model = GlobalSetting::where('key','designation')->first();
		if($model != null){
			$model = json_decode($model->value);
		}
		return view('admin.settings.designation',['model'=>$model]);
	}
	public function departmentSetting()
	{
		$model = GlobalSetting::where('key','department')->first();
		if($model != null){
			$model = json_decode($model->value);
		}
		return view('admin.settings.department',['model'=>$model]);
	}

	public function saveSettingMeta(Request $request){
		$keys = $request[$request->key.'_key'];
		$values = $request[$request->key.'_value'];
		$model = GlobalSetting::where('key',$request->key)->first();
		if($model == null){
			$model = new GlobalSetting;
			$model->key = $request->key;
			$model->value = json_encode(array_combine($keys, $values));
			$model->save();
		}else{
			$model->value = json_encode(array_combine($keys, $values));
			$model->save();
		}
		return redirect()->back();
	}

	public function saveOrganization(Request $request){
		$key = $request->key;
		$model = GlobalSetting::where('key',$request->key)->first();
		if($model == null){
			$model = new GlobalSetting;
			$model->key = $request->key;
			$model->value = $request->primary_organization;
			$model->save();
		}else{
			$model->value = $request->primary_organization;
			$model->save();
		}
		return redirect()->back();
	}

	public function shiftsSetting()
	{	
		$model = GlobalSetting::where('key','shift')->first();
		if($model != null){
			$model = json_decode($model->value);
		}
		return view('admin.settings.shifts',['model'=>$model]);
	}
	public function holidaysSetting()
	{
		return view('admin.settings.holidays');
	}
	public function leaveSetting()
	{
		$model = GlobalSetting::where('key','leave')->first();
		if($model != null){
			$model = json_decode($model->value);
		}
		return view('admin.settings.leave_category',['model'=>$model]);
	}
	public function roleSetting()
	{
		$model = GlobalSetting::where('key','role')->first();
		if($model != null){
			$model = json_decode($model->value);
		}
		return view('admin.settings.roles',['model'=>$model]);
	}

	public function organization(){
		$model = GlobalSetting::where('key','primary_organization')->first();
		if($model != null){
			$model = $model->value;
		}
		return view('admin.settings.organization',['model'=>$model]);
	}
	public function removeLogo($id)
	{
		$model = GlobalSetting::all();
	}
}
	