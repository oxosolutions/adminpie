<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\GlobalActivityTemplate;

class ActivityTemplateController extends Controller
{

	public function create_notification(Request $request){
 		if($request->isMethod('post')){
 				$this->save_activity_template($request);
 				if(!empty($error)){
	    		 }
    		 	return redirect()->route('activities');
    	}

     return view('admin/activity-template/create_notification');
	}

	public function notificationList(Request $request){
		$model = $this->dataView($request,'notification');
		$datalist =  [
                      'datalist'=>  $model,
                      'showColumns' => ['slug'=>'slug', 'type'=>'type', 'gender'=>'gender', 'language'=>'language', 'created_at'=>'Created'],
                      'actions' => [
                                      'edit'    =>  ['title'=>'Edit','route'=>'activity.edit' , 'class' => 'edit'],
                                      'delete'  =>  ['title'=>'Delete','route'=>'activity.delete']
                                   ],
                      'js'  =>  ['custom'=>['list-designation']],
                      'css'=> ['custom'=>['list-designation']]
                  ];
		return view('admin.activity-template.notificationlist',$datalist);
	}

	protected function dataView($request,$use_for){
		$datalist= [];
        if($request->has('per_page')){
            $perPage = $request->per_page;
            if($perPage == 'all'){
                $perPage = 999999999999999;
            }
        }else{
                $perPage = 10;
        }
        $sortedBy = @$request->sort_by;
        if($request->has('search')){
            if($sortedBy != ''){
                $model = GlobalActivityTemplate::where(['slug'=>'like','%'.$request->search.'%','use_for'=>$use_for])->orderBy($sortedBy,$request->ORGc_asc)->paginate($perPage);
            }else{
                $model = GlobalActivityTemplate::where(['slug'=>'like','%'.$request->search.'%','use_for'=>$use_for])->paginate($perPage);
            }
        }else{
            if($sortedBy != ''){
                $model = GlobalActivityTemplate::where(['use_for'=>$use_for])->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
            }else{
                $model = GlobalActivityTemplate::where(['use_for'=>$use_for])->paginate($perPage);
            }
        }

        return $model;
        
        

	}
	public function index(Request $request){
		
		$model = $this->dataView($request, 'activity');
		$datalist =  [
                      'datalist'=>  $model,
                      'showColumns' => ['slug'=>'slug', 'type'=>'type', 'gender'=>'gender', 'language'=>'language', 'created_at'=>'Created'],
                      'actions' => [
                                      'edit'    =>  ['title'=>'Edit','route'=>'activity.edit' , 'class' => 'edit'],
                                      'delete'  =>  ['title'=>'Delete','route'=>'activity.delete']
                                   ],
                      'js'  =>  ['custom'=>['list-designation']],
                      'css'=> ['custom'=>['list-designation']]
                  ];
        return view('admin.activity-template.list',$datalist);

        
	}
	protected function validation_check($data, $key){

		if($key=='self'){
			$selfCount = $data->where('type','self')->count();
			if($selfCount>=1){
				$error[] ="self already created";
				return 0;
			}
		}else{
			$otherCount = $data->where('type','other')->count();
			if($otherCount>=2){
				$error[] ="other already created";
				return 0;
			}
		}
		return 1;
	}
	protected function save_activity_template($request){
				$data = null;
    			$check = GlobalActivityTemplate::where(['slug'=>$request['slug'], 'language'=>$request['language'] , 'use_for'=>$request['use_for']]);
    			if($check->exists()){
    				$data = $check->get();
    				if($data->count() >= 3){
    					$error[] = "Already Created ";
						return back();//view('admin/activity-template/create');
    				}
    			}
		foreach ($request->template as $key => $value) {
    			$insert = 1;
    			if(!empty($data)){
    				$insert = $this->validation_check($data,$key);
				}
				if($insert==1){	
	 				$activityTemplate = new GlobalActivityTemplate();
	    			if(isset($value['gender'])){
	    				$activityTemplate->gender = $value['gender'];
	    			}
	    			$activityTemplate->type = $value['type'];
	    			$activityTemplate->template = $value['template'];
	    			$activityTemplate->slug = $request['slug'];
	    			$activityTemplate->language = $request['language'];
	    			$activityTemplate->use_for = $request['use_for'];
					$activityTemplate->save();
				}
    		}
	}
    public function create(Request $request){
    	if($request->isMethod('post')){
 				$this->save_activity_template($request);
 				if(!empty($error)){
	    		 }
    		 	return redirect()->route('activities');
    	}
    	
     return view('admin/activity-template/create');
    }
    public function edit(Request $request , $id=null){
    	$data = GlobalActivityTemplate::where('id',$id);
    	if($data->exists()){
    		$condition = $data->first();
    	$datas = GlobalActivityTemplate::where(['slug'=>$condition['slug'], 'language'=>$condition['language'] , 'use_for'=>$condition['use_for']])->get();
    	}

    	if($request->isMethod('post'))
    	{
    		foreach ($request->template as $key => $value) {
    			dump($value);
    			GlobalActivityTemplate::where('id',$key)->update(['template'=>$value['template']]);
    		}
    		
    	}
    	return view('admin.activity-template.edit',compact('datas'));
    	// dump($data);
    }
    public function delete($id){
    		GlobalActivityTemplate::where('id',$id)->delete();
    }
}
