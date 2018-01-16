<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\GlobalSetting;
use Session;
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

	/**
	 * To set primary organization
	 */
	public function organization(){
		
		$organizationID = get_meta('Admin\GlobalSetting',null,'primary_organization');
        $model = null;
		if($organizationID != false){
            $model = new \stdClass;
			$model->primary_organization = $organizationID;
		}
		return view('admin.settings.organization',['model'=>$model]);
	}
	public function removeLogo($id)
	{
		$model = GlobalSetting::all();
	}
	public function modelSetting()
	{
        $model = GlobalSetting::where(['key'=>'model_associate'])->first();
        $associateModel = [];
        if($model != null){
            $associateModel['model'] = json_decode($model->value,true);
        }
        // dd($associateModel);
		return view('admin.settings.model-associate',['model'=>$associateModel]);
	}

    /**
     * Save Model Associate Request
     * @param  Request $request [have posted data]
     * @return [type]           [return back to view]
     */
    public function saveModelAssociate(Request $request){
        $model = GlobalSetting::firstOrNew(['key'=>'model_associate']);
        $model->key = 'model_associate';
        $model->value = json_encode($request->model);
        $model->save();
        Session::flash('success','Models saved successfully!!');
        return back();
    }
}
	