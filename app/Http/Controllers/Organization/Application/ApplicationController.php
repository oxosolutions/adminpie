<?php

namespace App\Http\Controllers\Organization\Application;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\OrganizationSetting;
class ApplicationController extends Controller
{
    public function download()
    {
    	return view('organization.mobile-application.android.download');
    }
    public function settings()
    {
        $model = OrganizationSetting::where('type','app')->get();
        $model = $model->pluck('value','key');
    	return view('organization.mobile-application.android.settings',['model'=>$model]);
    }

    public function updateSettings(Request $request){
        $path = 'media';
        foreach($request->except(['_token']) as $key => $value){
            if($key == 'android_application_logo'){
                if($request->hasFile('android_application_logo')){
                    $filename = date('Y-m-d-H-i-s').'_'.$request->file('android_application_logo')->getClientOriginalName();
                    $request->file('android_application_logo')->move($path, $filename);
                    $value = asset('/').$path.'/'.$filename;
                }
            }
            $model = OrganizationSetting::firstOrNew(['key'=>$key,'type'=>'app']);
            $model->key = $key;
            $model->value = $value;
            $model->type = 'app';
            $model->save();
        }
        return back();
    }

    public function FAQ()
    {
    	return view('organization.mobile-application.android.FAQs');
    }
    public function changeLog()
    {
    	return view('organization.mobile-application.android.change-log');
    }
    public function documentation(){
        
    	return view('organization.mobile-application.android.documentation');
    }
}
