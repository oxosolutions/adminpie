<?php


use app\Model\Organization\User;
use App\Model\Organization\OrganizationSetting as org_setting;
use App\Model\Organization\UsersRole as Role;
use App\Model\Admin\GlobalModuleRoute as route;
use App\Model\Organization\RolePermisson as Permisson;
use App\Model\Organization\ActivityLog;
use App\Model\Admin\GlobalActivityTemplate;




	/**
	 * [user_info to get current user information & employee Info]
	 * @return [collection] [user information]
	 */
	function user_info()
	{
		$id = Auth::guard('org')->user()->id;
		$user = User::where(['id'=>$id])->select(['name','email', 'user_type' ,'role_id','id'])->with('employee_rel')->first();
		return $user;
	}

	function getMetaValue($metaArray, $metaKey){
		$metaArray = collect($metaArray);
		$metaData = $metaArray->where('key',$metaKey);
		$metaValue = false;
		foreach($metaData as $key => $value){
			$metaValue = $value->value;
		}
		return $metaValue;
	}

	/**
	 * [role_id current login role ID]
	 * @return [type] [description]
	 */
	function role_id()
	{
		return Auth::guard('org')->user()->role_id;
	}
	/**
	 * [setting_val_by_key description]
	 * @param  [type] $key [description]
	 * @return [type]      [description]
	 */
	function setting_val_by_key($key)
	{
		$setting = org_setting::where('key',$key);
		if($setting->exists()){
		 if(Role::where('id',$setting->first()->value)->exists()){
		 	return $setting->first()->value;
		 }
		}
		 return Null;
	}

	function check_route_permisson($url)
	{
		//dump($url);
		if(role_id()==1){
			return true;
			}else{
				$routeCheck = route::where('route',$url);
			 	if($routeCheck->exists()){
				 	$route_id = $routeCheck->select('id')->first()->id;
				 	$check =  Permisson::where(['role_id'=>role_id(), 'permisson_id'=>$route_id, 'permisson_type'=>'route'])->whereNotNull('permisson');
				 	if($check->exists())
				 	{
				 		return true;
				 	}
			}
		 return false;
		
		}
	}

	function save_activity($slug, $name=null){
		$user = user_info();
		if(!empty($user['id']) && !empty($slug)){
			$activityLog = new ActivityLog();
			$activityLog->user_id = $user['id'];
			$activityLog->slug = $slug;
			if(!empty($name)){
				$activityLog->name = $name;
			}
			$activityLog->save();
		}
	}

	function activity_log($slug, $language){
		$activity = GlobalActivityTemplate::where(['type'=>'self', 'slug'=>$slug ,'language'=>$language]);
		if($activity->exists()){
			return $activity->first()->template;
		}
	}

	// if(role_id()==2){
		// 	return True;	
		// 	}else{
		// 			// $routeData = route::where('route',$url)->first();
		// 			// dd($routeData);


		// 			// $route = Permisson::where(['role_id'=>4, 'permisson_type'=>'route'])->whereNotNull('permisson')->select(['permisson_id'])->get();
		// 			//  dump($route);
	 //    //           if($route->exists()){
	 //    //            $routes[]= $route->first()->route;
	 //              }
		//     }	

?>