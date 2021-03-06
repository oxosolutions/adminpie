<?php
/************************************************************
*	@Project AdminPie (adminpie.com)
*	@package Aione Framework	(aioneframework.com)
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@copyright	(c)Copyright by OXO Solutions
*	@link	http://oxosolutions.com
************************************************************/


use App\Model\Organization\User;
use App\Model\Group\GroupUsers;// as User;
use App\Model\Organization\OrganizationSetting as org_setting;
use App\Model\Organization\UsersRole as Role;
use App\Model\Admin\GlobalModuleRoute as route;
use App\Model\Organization\RolePermisson as Permisson;
use App\Model\Organization\ActivityLog;
use App\Model\Admin\GlobalActivityTemplate;
use App\Model\Organization\UsersMeta;
use App\Model\Organization\UserRoleMapping;
use App\Model\Organization\FormBuilder;
use App\Model\Organization\forms;
use App\Model\Admin\forms as AdminForms;
use App\Model\Organization\Page as Page;
use App\Model\Admin\Page as GlobalPage;
use App\Model\Organization\PageMeta as PageMeta;
use App\Model\Admin\PageMeta as GlobalPageMeta;
use App\Model\Admin\GlobalOrganization;
use App\Model\Admin\GlobalWidget;
use App\Model\Organization\Cms\Slider\Slider;
use App\Model\Organization\Cms\Slider\SliderMeta;
use App\Model\Admin\GlobalModule;
use App\Model\Admin\GlobalSubModule;
use App\Model\Organization\OrganizationSetting;
use Carbon\Carbon;
/************************************************************
*	@function get_module
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm length		[integer	optional	default	40]
*	@perm timestamp		[true/false	optional	default	true]
*	@return filename [string]
************************************************************/
function get_module($route = null){
	$module = null; 
	if(!empty($route)){
		$module = GlobalSubModule::where('sub_module_route',$route)->first();
	} else{
		$route = Request::route();
        $route = $route->uri;
        $module = GlobalSubModule::where('sub_module_route',$route)->first();
	}
	return $module;
}

/************************************************************
*	@function get_module_css
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@return module_css [string]
************************************************************/
function get_module_css(){
	$module = get_module();
	$module_css = $module->css_code;
	//Return module_css
	return $module_css;
}


/************************************************************
*	@function get_module_js
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@return module_js [string]
************************************************************/
function get_module_js(){	

	$module = get_module();
	$module_js = $module->js_code;
	
	//Return module_js
	return $module_js;
}

function convert_sec_to_hour($sec, $format = '%02d:%02d') {
    if ($sec < 1) {
       return;
    }
    $time = $sec/60;
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}

function difference_secs($time_1 , $time_2){
		$start_shift = new Carbon($time_1);
			$come_at = new Carbon($time_2);
			$diff = $start_shift->diffInSeconds($come_at);
			$secs = convert_sec_to_hour($diff);
		return $secs;
	}
/************************************************************
*   @function get_user_id_from_employee_id
*   @access public
*   @since  1.0.0.0
*   @author SGS Sandhu(sgssandhu.com)
************************************************************/
function get_user_id_from_employee_id($emp_id){
	$user = UsersMeta::select('user_id')->where('value',$emp_id)->first();
	if(empty($user) || empty($user->user_id)){
		return;
	}
	return $user->user_id;
}

function call_model($model,$method,$param = null){
    $modelPath = 'App\\Model\\Organization\\'.$model;
    $modelObject = new $modelPath;
    return $modelObject->{$method}($param);
}

function user_id_to_name($user_id){
    $groupUser_model = GroupUsers::find($user_id);
    if($groupUser_model != null){
        return $groupUser_model->name;
    }else{
        return false;
    }
}


/************************************************************
*   @function can_i_access_this_user
*   @access public
*   @since  1.0.0.0
*   @author SGS Sandhu(sgssandhu.com)
************************************************************/
function can_i_access_this_user(){
    if(is_admin()){
        return true;
    }else{
        if(request()->id == current_organization_user_id()){
            return true;
        }else{
            return \Route::dispatch(\Request::create(request()->route()->getName(), 'GET'));
        }
    }
}


/************************************************************
*   @function get_current_organization_url
*   @access public
*   @since  1.0.0.0
*   @author SGS Sandhu(sgssandhu.com)
************************************************************/
function get_current_organization_url(){
    return request()->root();   
}

/************************************************************
*   @function check_widget_permission
*   @access public
*   @since  1.0.0.0
*   @author SGS Sandhu(sgssandhu.com)
************************************************************/
function check_widget_permission($widget_slug){ 
    $GlobalWidget = GlobalWidget::where(['slug'=>$widget_slug])->first();
    if($GlobalWidget != null){
       $rolePermission = Permisson::where(['permisson_type'=>'widget','permisson_id'=>$GlobalWidget->id,'permisson'=>'on'])->get();
        if($rolePermission->isEmpty()){
            if(in_array(1,role_id())){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }else{
        return false;
    }
    
    /*if(in_array(1,role_id()) && $rolePermission->isEmpty()){
        return true;
    }else{
        $getByCurrentRole = $rolePermission->whereIn('role_id',role_id());
        if(!$getByCurrentRole->isEmpty()){
            return true;
        }else{
            return false;
        }
    }*/
}




/************************************************************
*	@function get_current_user
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm key		[string	optional	default	null]
*	@perm array		[true/false	optional	default	false]
*	@return filename [mixed][object/integer/string] 
	26-12-17 paljinder singh make change according  to group user id.
************************************************************/

function get_user_detail($meta = true ,$array = false, $org_user_id = null){
	if($meta){
		$id = ($id != null)?$org_user_id:current_organization_user_id();
		$user = User::with('belong_group')->where('id', $org_user_id);
		$user->meta = get_user_meta($org_user_id);
	}else{
		$org_user_id = ($org_user_id != null)?$org_user_id:current_organization_user_id();
		$user = GroupUsers::where('id', $org_user_id);
			if($user->exists()){
				$user = $user->first();
				// if(!empty($user->belong_group)){
				// 	$user = $user->belong_group;
				// }else{
				// 	$user = null;
				// }
			}else{
				$user = null;
			}
	}
	if($array){
		if($meta){
			$user->meta = $user->meta->toArray();
		}
		if($user){
			$user = $user->toArray();
		}
	}
	//Return User Object 
	return $user;
}
/************************************************************
*****************************************/

/**
 @function current organization user id
*	@description  organization user id 
*	@access	public
*	@since	1.0.0.0
*	@author	Paljinder Singh
 */
function current_organization_user_id(){
	/*$user_id = Auth::guard('org')->user()->id;
	$user = User::select('id')->where('user_id',$user_id);
	if($user->exists()){
		return	$user->first()->id;
	}*/
	return get_user_id();
}


/**
 @function role_list
*	@description  all role list 
*	@access	public
*	@since	1.0.0.0
*	@author	Paljinder Singh(sgssandhu.com)
 */
function role_list(){
	return Role::where('status',1)->pluck('name','id');
}

/************************************************************
*	@function get_role
*	@description use in  survey structure in setting 
*	@access	public
*	@since	1.0.0.0
*	@author	Paljinder Singh(sgssandhu.com)
*	@return Role value [code]
************************************************************/
function get_role($id=null){
	$role = Role::find($id);
	if(!empty($role)){
		return $role['name'];
	}
	return null;
}

/************************************************************
*	@function field_options
*	@description use in static survey to field options value
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@return key value [code]
************************************************************/
function field_options($slug ,$id=null){
	if(!empty($id)){	
		$form = FormBuilder::with(['fieldMeta'=>function($query){
			$query->where('key','field_options');
		}])->where(['field_slug'=>$slug, 'id'=>$id])->first()->toArray();
	}else{
		$form = FormBuilder::with(['fieldMeta'=>function($query){
			$query->where('key','field_options');
		}])->where('field_slug',$slug)->first()->toArray();
	}

	if(!empty($form['field_meta'])){
		if(!empty($form['field_meta'][0]['value'])){
			return $options = collect(json_decode($form['field_meta'][0]['value'],true))->pluck('value','key')->all();
		}	
	}
	return null;
}

/************************************************************
*	@function g
*	@description Global Debug Function
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@return organization_id [code]
************************************************************/
function g($g){	

	$output ='';
	$output .='<pre>';
	$output .=print_r($g);
	$output .='</pre>';	
	
	//Return Output
	return $output;
}
/************************************************************
*	@function users_drop_down
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@return id [integer] , name [varchar]
************************************************************/
function users_drop_down($type=null){
	return User::userDropDowns($type);
}
/************************************************************
*	@function categories_drop_down
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@return id [integer] , name [varchar]
************************************************************/
function categories_drop_down($type=null){
	return App\Model\Organization\Category::Categories($type);
}
/************************************************************
*	@function categories_drop_down
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@return id [integer] , name [varchar]
************************************************************/
function departments_drop_down(){
	return App\Model\Organization\Department::departmentLists();
}

/************************************************************
*	@function get_organization_id
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@return organization_id [integer]
************************************************************/
function get_organization_id(){	

	//Get Organization ID from SESSION
	//Session variable initialized at app/Http/Middleware/CheckIfOrganizationAuthenticated.php
	
	$organization_id = Session::get('organization_id');
	
	//Return Organization ID
	return $organization_id;
}

function get_meta_array($meta){
	$metaArray = [];
	foreach($meta as $key => $value){
		$metaArray[$value->key] = $value->value;
	}
	return $metaArray;
}


/************************************************************
*	@function get_user_id
*	@description Returns user id of logged in user
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@return uid [integer]
************************************************************/
function get_user_id(){
	if(Auth::guard('admin')->check()){
        $uid = Auth::guard('admin')->user()->id;
    }else{
        $uid = Auth::guard('org')->user()->id;
    }
	
	
	//Return User ID
	return $uid;
}


/************************************************************
*	@function get_user_id
*	@description Returns user id of logged in user
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@return uid [integer]
************************************************************/
function get_image($path, $filename, $size = null, $html = false){
	
	$ds = directory_separator();
	$base_file_path = $path.$ds.$filename;
	
	if(!File::exists($base_file_path)){
		return false;
	}
	
	$filename_elements = explode(".",$filename);
	//First element of Array
	$output_filename = current($filename_elements);
	//Last element of Array
	$output_file_extension = end($filename_elements);
	
	$image_size = get_file_size($size);
	
	
	$file_path = $path.$ds.$output_filename.'_'.$image_size.'.'.$output_file_extension;
	
	if(!File::exists($file_path)){
		resize_image($image_size , $filename, $path); 
	}
	
	return $file_path;
	

}

/************************************************************
*	@function get_profile_picture
*	@description Returns user id of logged in user
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm uid		[integer	optional	default	null]
*	@perm size		[string	optional	default	null]
*	@perm html		[true/false	optional	default	false]
*	@return filename [mixed][string/html]
************************************************************/

function get_profile_picture($uid = null, $size = null, $html = false){
	if($uid == null){
		$uid = get_user_id();
	}
	if($size == null){
		$size = 'avatar';
	}
	
	$meta_key = 'user_profile_picture';
	$user_profile_picture = get_user_meta($uid,$meta_key, true);
	$user_profile_picture_url = 'assets/images/user_'.get_file_size($size).'.png';
	if(!empty($user_profile_picture)){
		$profile_picture_path = upload_path('user_profile_picture');
		
		if(!File::exists($profile_picture_path.directory_separator().$user_profile_picture)){
			delete_user_meta('user_profile_picture', $uid);
		} else {
			$user_profile_picture_url = get_image($profile_picture_path, $user_profile_picture, $size, false);
		}
	} 

	if($html){
		return '<img src="'.asset($user_profile_picture_url).'" data-user-id="'.$uid.'" class="user-profile-picture user-profile-picture-'.$size.'" />';
	}else{
		return $user_profile_picture_url;
	}

}



/************************************************************
*	@function upload_path
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm path		[string	optional	default	null]
*	@return upload_path [string]
************************************************************/

function upload_path($path = null){	

	$directory_separator = '/';
	
	//inialize upload_path variable as empty string
	$upload_path = '';
	
	//Get Organization ID
	$organization_id = get_organization_id();
	
	//Get path variable from environment file
	$upload_path .= env('USER_FILES_PATH');
	
	//Append Organization ID
	$upload_path .= '_'.$organization_id;
	
	//Append directory separator 
	$upload_path .= $directory_separator;
	
	if($path != null){
		//Append provided path
		$upload_path .= $path;
	}
	if(!file_exists($upload_path)){
		mkdir($upload_path,0777,true);
	}
	//Return path of user files directory
	return $upload_path;
}

/************************************************************
*	@function upload_base_path
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@return upload_base_path [string]
************************************************************/

function upload_base_path(){	

	$upload_base_path = upload_path();
	
	//Return base path of user files directory
	return $upload_base_path;
}



/************************************************************
*	@function get_file_size
*	@description Returns dimensions if file
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm name		[string	required	default	null]
*	@return size [string]
************************************************************/

function get_file_size($name = null){
	
	$size = '';
	if($name == 'avatar'){
		$size = '50x50';
	}
	if($name == 'thumbnail'){
		$size = '100x100';
	}
	if($name == 'small'){
		$size = '150x150';
	}
	if($name == 'medium'){
		$size = '300x300';
	}
	if($name == 'large'){
		$size = '500x500';
	}
	
	//Return Size
	return $size;
}


/************************************************************
*   @function remove_prefix
*   @description Returns string
*   @access public
*   @since  1.0.0.0
*   @author SGS Sandhu(sgssandhu.com)
*   @perm name      [string required    default null]
*   @return size [string]
************************************************************/
function remove_prefix($string){
    return str_replace('ocrm_','',$string);
}



/************************************************************
*   @function get_organization_users
*   @description current organization users list
*   @access public
*   @since  1.0.0.0
*   @author SGS Sandhu(sgssandhu.com)
*   @return useres [array]
************************************************************/
function get_organization_users($collection = false){

    $result = GroupUsers::with(['organization_user'=>function($query){
        $query->with(['user_role_map'=>function($query){
            $query->with(['roles'=>function($query){
                $query->select(['id','name']);
            }])->select(['id','role_id','user_id']);
        }]);
    }])->whereHas('organization_user')->get()->toArray();

    $prepareUserArray = [];
    $mainIndex = 0;
    foreach($result as $key => $value){
        foreach ($value as $field_key => $field) {
            if($field_key == 'organization_user'){
                $prepareUserArray[$mainIndex]['user_type'] = $value['user_type'];
                $index = 0;
                foreach($field['user_role_map'] as $k => $role){
                    $prepareUserArray[$mainIndex]['role_id'][$index]['id'] = $role['role_id'];
                    $prepareUserArray[$mainIndex]['role_id'][$index]['name'] = $role['roles']['name'];
                    $index++;
                }
            }else{
                $prepareUserArray[$mainIndex][$field_key] = $field;
            }
        }
        $mainIndex++;
    }
    if($collection){
        return collect($prepareUserArray);
    }else{
        return $prepareUserArray;
    }
}




/************************************************************
*   @function update_meta
*   @description Returns boolean
*   @access public
*   @since  1.0.0.0
*   @author SGS Sandhu(sgssandhu.com)
*   @perm name      [string required    default null]
*   @return size [boolean]
************************************************************/
function update_meta($model, Array $metaArray = [], $isWhere = [], $allowUpdate = true){ 
    if(class_exists($model)){
        if(!empty($metaArray)){
            foreach($metaArray as $key => $value){
                $whereKeys = ['key'=>$key];
                if(!empty($isWhere)){
                    foreach($isWhere as $wKey => $wValue){
                        $whereKeys[$wKey] = $wValue;
                    }
                }
                $model = $model::firstOrNew($whereKeys);
                if($model->exists){
                    if($allowUpdate){
                        $model->key = $key;
                        $model->value = $value;
                        if(!empty($isWhere)){
                            foreach($isWhere as $wKey => $wValue){
                                $model->{$wKey} = $wValue;
                            }
                        }
                        $model->save();
                    }
                }else{
                    $model->key = $key;
                    $model->value = $value;
                    if(!empty($isWhere)){
                        foreach($isWhere as $wKey => $wValue){
                            $model->{$wKey} = $wValue;
                        }
                    }
                    $model->save();
                }
            }
            return true;
        }else{
            return ['error'=>'Meta array should not empty!'];
        }
    }else{
        http_response_code(500);
        return ['error'=>'Model not exists'];
    }
}


/************************************************************
*   @function form
*   @description Returns form with form action
*   @access public
*   @since  1.0.0.0
*   @author SGS Sandhu(sgssandhu.com)
*   @perm name      [string required    default null]
*   @return size [string]
************************************************************/
function form($form_slug, $form_from = 'admin', $default_model_data = null){

    if($form_from == 'admin'){
        $model = AdminForms::where('form_slug',$form_slug)->first();        
    }else{
        $model = forms::where('form_slug',$form_slug)->first();
        if($model == null){
            $model = AdminForms::where('form_slug',$form_slug)->first();
            if($model == null){
                return 'No Form Found!';
            }else{
                $form_from = 'admin';
            }
        }
    }
    return view('common.form_data',['slug'=>$form_slug,'model'=>$model,'default_model'=>$default_model_data,'form_from'=>$form_from])->render();
}


/************************************************************
*   @function survey
*   @description Returns form with form action
*   @access public
*   @since  1.0.0.0
*   @author SGS Sandhu(sgssandhu.com)
*   @perm name      [string required    default null]
*   @return size [string]
************************************************************/
function survey($token){
    $apiServices = new App\Http\Controllers\Api\SurveyController;
    $controllerObject = new App\Http\Controllers\Organization\survey\SurveyController($apiServices);
    return $controllerObject->embededSurvey($token,true);
}


/************************************************************
*	@function generate_filename
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm length		[integer	optional	default	40]
*	@perm timestamp		[true/false	optional	default	true]
*	@return filename [string]
************************************************************/
function generate_filename($length = 30, $timestamp = true){	

	//Check if non integer value is provided for first argument
	if(!is_int($length)){
		$length = intval($length);
	}
	
	//inialize filename variable as empty string
	$filename = '';
	
	//prepend timestamp in filename
	if($timestamp){
		$datetime = date('Ymdhis');
		$microtime = substr(explode(".", explode(" ", microtime())[0])[1], 0, 6);
		$filename .= $datetime.$microtime;
	}
	
	//Check if filename length is achieved or exceeded
	if( strlen($filename) > $length){
		$filename = substr($filename, 0, $length);
	} else {
		$random_string_length = $length - strlen($filename);
		for($i = 0; $i < $random_string_length; $i++){
			$filename .= mt_rand(1,9);
		}
	}
	
	//Return generated filename
	return $filename;
} //end function generate_filename()



/************************************************************
*	@function get_timestamp
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@return current_timestamp [string]
************************************************************/
function get_timestamp(){
	
	$current_timestamp = generate_filename(20,true);
	//Return generated filename
	return $current_timestamp;
}

/************************************************************
*	@function resize_image
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm size		[string	optional	default	'thumbnail']
*	@perm source_path		[string	optional	default	null]
*	@perm destination_path		[string	optional	default	null]
*	@perm rename		[true/false	optional	default	false]
*	@return filename [string]
************************************************************/

function resize_image($size = 'thumbnail', $filename, $source_path = null, $destination_path = null, $rename = false){	
	
	$directory_separator = '/';
	
	if(empty($filename)){
		return false;
	} else {
		$filename_elements = explode(".",$filename);
		//First element of Array
		$output_filename = current($filename_elements);
		//Last element of Array
		$output_file_extension = end($filename_elements);
	}
	
	//generate_filename
	if($rename){
		$output_filename = generate_filename();
	}
	
	if($source_path == null){
		$source_path = upload_base_path();
	}
	if($destination_path == null){
		$destination_path = $source_path;
	}
	
	$source_path = trim($source_path, "/");
	$destination_path = trim($destination_path, "/");
	
	
	$image_width = 50;
	$image_height = 50;
	
	if($size == 'thumbnail'){
		$image_width = 150;
		$image_height = 150;
	} elseif($size == 'small'){
		$image_width = 300;
		$image_height = 300;
	} else{
		$size_elements = explode("x",$size);
		$image_width = $size_elements[0];
		$image_height = $size_elements[1];
	}
	
	
	$output_complete_url = $destination_path.$directory_separator.$output_filename.'_'.$image_width.'x'.$image_height.'.'.$output_file_extension;
	
	
	if(!File::exists($source_path.$directory_separator.$filename)){
		return false;
	}
	
	// open file a image resource
	$img = Image::make($source_path.$directory_separator.$filename);

	// crop the best fitting 
	$img->fit($image_width, $image_height);
	
	// save image
	$img->save($output_complete_url);

	//Return True 
	return true;
}




/************************************************************
*	@function get_meta
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm model		[string	required	default	void]
*	@perm uid		[integer	required	default	void]
*	@perm key		[string	required	default	void]
*	@perm array		[true/false	optional	default	false]
*	@return  		[object/array]
************************************************************/

function get_meta($model, $uid = null, $key = null, $column = null, $array = false){	

	$whereArray = [];
	if($uid != null && $column != null){
		$whereArray[$column] = $uid;
	}
	if($key != null){
		$whereArray['key'] = $key;
	}
	$meta = array();
	$model = 'App\\Model\\'.$model;
	if(!empty($whereArray)){
		$meta = $model::where($whereArray)->get();
	}else{
		if($column != null){
			$meta = $model::where([$column => $uid])->get();
		}else{
			$meta = $model::get();
		}
	}
	$correctedMeta = [];
	if(!$meta->isEmpty()){
		foreach($meta as $mkey => $metaValues){
			$correctedMeta[$metaValues->key] = $metaValues->value;
		}
	}
	$meta = collect($correctedMeta);
	if($meta->count() == 1 && $key != null){
		return $meta->toArray()[$key];
	}
	if($array){
		$meta =  $meta->toArray();
		if(empty($meta)){
			return false;
		}
	}else{
		if($meta->isEmpty()){
			return false;
		}
	}
	//Return Meta Object 
	return $meta;
}


/************************************************************
*	@function get_user_meta
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm uid		[integer	required	default	void]
*	@perm key		[string	required	default	void]
*	@perm array		[true/false	optional	default	false]
*	@return $meta (use Meta)
************************************************************/

function get_user_meta($uid, $key = null, $array = false){	
	
	$meta = array();
	
	$model = "Organization\\UsersMeta";
	
	$meta = get_meta($model, $uid, $key, 'user_id', $array);
	//Return Meta Object 
	return $meta;
}


/************************************************************
*	@function get_current_user_meta
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm key		[string	optional	default	null]
*	@perm array		[true/false	optional	default	false]
*	@return 
************************************************************/

function get_current_user_meta($key, $array = false){	

	$meta = get_user_meta(current_organization_user_id(), $key, $array);
	//Return Meta Object 
	return $meta;
}

/************************************************************
*	@function get_current_user
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm key		[string	optional	default	null]
*	@perm array		[true/false	optional	default	false]
*	@return filename [mixed][object/integer/string]
************************************************************/

function get_user($meta = true ,$array = false, $id = null){
	if($meta){
		$id = ($id != null)?$id:current_organization_user_id();
		$user = User::find($id);
		$user->meta = get_user_meta($id);
	}else{
		$id = ($id != null)?$id:current_organization_user_id();
		$user = User::find($id);
	}
	if($array){
		if($meta){
			$user->meta = $user->meta->toArray();
		}
		if($user){
			$user = $user->toArray();
		}
	}
	//Return User Object 
	return $user;
}
/************************************************************
*****************************************/

function update_user_meta($metaKey, $metaValue, $uid = null, $return = false){
	if($uid == null){
		$uid = get_user_id();
	}
	$meta = [$metaKey=>$metaValue];
	$updatedMeta = update_user_metas($meta, $uid, $return);
	if($return){
		return $updatedMeta;
	}
	return true;
}
/************************************************************
*	@function update_user_metas
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm key		[array	optional	default	null]
*	@perm array		[true/false	optional	default	false]
*	@return filename [mixed][object/integer/string]
************************************************************/

function update_user_metas(Array $meta, $uid = null, $return = false){
	if($uid == null){
		$uid = current_organization_user_id();
	}
	$updatedMeta = [];
	foreach($meta as $metaKey => $metaValue){
		$model = UsersMeta::firstOrNew(['key'=>$metaKey,'user_id'=>$uid]);
		$model->key = $metaKey;
		if(is_array($metaValue)){
			$model->value = json_encode($metaValue);
		}else{
			$model->value = $metaValue;
		}
		$model->user_id = $uid;
		$model->save();
		$updatedMeta[$metaKey] = $metaValue;
	}
	if($return){
		return $updatedMeta;
	}
	return true;
}
/************************************************************
*	@function delete_user_metas
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm key		[array	string/int]-
*	@perm array		[true-required		true-optional]
*	@return filename [mixed][object/integer/string]
************************************************************/

function delete_user_metas(Array $meta, $uid = null){
	if($uid == null){
		$uid = current_organization_user_id();
	}
	foreach ($meta as $metaKey => $metaValue) {
		$model = UsersMeta::where(['key'=>$metaValue,'user_id'=>$uid])->delete();
	}
	return true;
}
/************************************************************
*	@function delete_user_meta
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm key		[string	string/int]-
*	@perm array		[required	optional]
*	@return true
************************************************************/


function delete_user_meta($metaKey, $uid = null){
	$meta = [$metaKey];
	delete_user_metas($meta, $uid);
	return true;
}


if(!function_exists('is_employee')){
	function is_employee($userId = null){
		$roles = get_user_roles($userId);
		if(in_array('employee',$roles)){
			return true;
		}else{
			return false;
		}
	}
}

if(!function_exists('is_admin')){
	function is_admin($userId = null){
		$roles = get_user_roles($userId);
		if(in_array('administrator',$roles)){
			return true;
		}else{
			return false;
		}
	}
}

if(!function_exists('get_user_role')){
	function get_user_roles($userid = null){
		$role_slugs = [];
		if($userid == null){
			$uid = current_organization_user_id();
		}else{
			$uid = $userid;
		}

		$model = UserRoleMapping::with(['roles'])->where(['user_id'=>$uid])->get();
		if(!$model->isEmpty()){
			foreach ($model as $modelKey => $value) {
				if($value->roles != null){
					$role_slugs[] = $value->roles->slug;
				}
			}
		}
		return $role_slugs;
	}
}

function get_organization_meta($key = null, $array = false){
	$organization_id = get_organization_id();
	if($organization_id == null){
		return null;
	}
	
	$model = 'Organization\OrganizationSetting';
	$meta = get_meta($model,null,$key,null,$array);
	return $meta;
}
function get_design_settings(){
	$meta = get_organization_meta('design_settings', true);
	$design_settings = json_decode($meta);
	return $design_settings;
}


function update_organization_meta($metaKey, $metaValue){
	update_organization_metas([$metaKey=>$metaValue]);
	return true;
}

function update_organization_metas(Array $meta){
	
	$updatedMeta = [];
	foreach($meta as $metaKey => $metaValue){
		$model = org_setting::firstOrNew(['key'=>$metaKey]);
		$model->key = $metaKey;
		$model->value = $metaValue;
		$model->save();
	}
	return true;	
}

function delete_file($filePath){
	// File::delete('images/' . $image_url);
}

function get_media(){

}



/************************************************************
*	@function lang
*	@description Returns HTML Table from an Array, an Object or JSON
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm data		[string	optional	default	null]
*	@perm vars		[Array optional	default	null]
*	@perm type		[single/multiple optional	default	single]
*	@return output [string]
************************************************************/

function lang($key = null,$vars = null , $type = 'single'){
	$output ="";

	if($type != 'single'){
		$output .= trans_choice($key, $vars);
	} else{
		$output .= __($key);
	}
	
	return $output;
} 



/************************************************************
*	@function aione_format_date
*	@description Returns formated date from string
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm data		[string	optional	default	null]
*	@return date [string]
************************************************************/

function aione_format_date($date = null, $format = 'Y-m-d'){
	$date = str_replace(",", " ", $date);
	$date = str_replace("  ", " ", $date);
	$date = strtotime($date);
	$date = date($format,$date);
	return $date;
}




/************************************************************
*	@function to_html_table
*	@description Returns HTML Table from an Array, an Object or JSON
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm data		[array/object/json	optional	default	null]
*	@perm datatype		[string optional	default	array]
*	@return output [string]
************************************************************/

function to_html_table($data = null, $datatype = 'array'){
	$output ="";
	if(gettype($data) != $datatype){
		return 'Not match datatype!';
	}
	switch ($datatype) {
		case 'array':
			$data_array = (array)$data;
			break;
		case 'object':
			$data_array = (array)$data;
			break;
		case 'json':
			$data_array = json_decode($data, true);
		default:
			# code...
			break;
	}
	if(!empty($data_array)){
		$output ="<div class='aione-table'><table>";
		foreach ($data_array as $key => $value) {
			if($key==0){
				$output .="<tr>";
					foreach (array_keys($value) as $key => $th_value) {
					 	$output .="<th> $th_value </th>";
					 } 
				$output .="</tr>";
			}
			$output .="<tr>";
				foreach ($value as $key => $td_value) {
					$output .="<td> $td_value </td>";
				}
			$output .="</tr>";
		}
		$output .="<table></div>";
		echo $output;
	}

	// return $output;
}
/************************************************************
*	@function json_to_html_table
*	@description Returns HTML Table from JSON String
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm data		[JSON	optional	default	null]
*	@return output [string]
************************************************************/
function json_to_html_table($data = null){
	$output = to_html_table($data , $datatype = 'json');
	return $output;
}
/************************************************************
*	@function array_to_html_table
*	@description Returns HTML Table from Array
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm data		[Array	optional	default	null]
*	@return output [string]
************************************************************/
function array_to_html_table($data = null){
	$output = to_html_table($data , $datatype = 'array');
	return $output;
}
/************************************************************
*	@function object_to_html_table
*	@description Returns HTML Table from Array
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm data		[Object	optional	default	null]
*	@return output [string]
************************************************************/
function object_to_html_table($data = null){
	$output = to_html_table($data , $datatype = 'object');
	return $output;
}


/************************************************************
*	@function directory_separator
*	@description Returns user id of logged in user
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@return directory_separator [string]
************************************************************/
function directory_separator(){
	
	$directory_separator = '/';
	
	//Return User ID
	return $directory_separator;
}
/************************************************************
*	@function meta_table
*	@description Draw html table of meta data of an entity
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm meta		[array	optional	default	null]
*	@perm layout		[string	optional	default	table]
*	@return html [html]
************************************************************/
function meta_table($headers = null, $meta = null, $layout="table", $style = "default"){
	$html = '';
	if( $layout == 'table' ){
		$html .= aione_table($headers, $meta, $style);
	} elseif( $layout == 'table' ){
		$html .= aione_list($headers, $meta, $style);
	}
	return $html;
}

/************************************************************
*	@function aione_table
*	@description Draw html table of given Array
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm headers		[array	optional	default	null]
*	@perm records		[array	optional	default	null]
*	@return html [html]
************************************************************/
function aione_table($headers = null, $records = null, $style = "default"){
	
	$html = '';
	$html .= '<div id="aione_table" class="aione-table">';
	if(!empty($headers)){
		
	}
	$html .= '</div>';
	
	return $html;
}

/************************************************************
*	@function aione_list
*	@description Draw html list of given Array
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm headers		[array	optional	default	null]
*	@perm records		[array	optional	default	null]
*	@return html [html]
************************************************************/
function aione_list($headers = null, $records = null, $style = "default"){
	$html = '';
	$html .= '<div id="aione_list" class="aione-list">';
	if(!empty($headers)){
		
	}
	$html .= '</div>';
	
	$html .= '</div>';
	
	return $html;
}

/************************************************************
*	@function aione_message
*	@description Display Aione Messages
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm type			[string	optional	default	null]
*	@perm messages		[array	optional	default	null]
*	@return html [html]
************************************************************/
function aione_message($messages = null, $type = '', $align = 'center'){
	
	$html = '';
	$html .= '<div class="aione-message '.$type.'">';
	if(!empty($messages)){
		if(is_array($messages)){
			$html .= '<ul class="aione-messages">';
				foreach ($messages as $key => $message) {
					$html .= '<li class="aione-align-'.$align.'">'.$message.'</li>';
				}
			    
			$html .= '</ul>';
		} else {
			$html .= $messages;
		}
	}
	$html .= '</div>';
	
	return $html;
}

/************************************************************
*   @function exact_float
*   @access public
*   @since  1.0.0.0
*   @author SGS Sandhu(sgssandhu.com)
*   @perm array         [array  optional    default null]
*   @perm global        [true/false optional    default false]
*   @return posts [object]
************************************************************/
function exact_float($value = null){    
    if($value == null){
        return null;
    }else{
        if(is_float($value)){
            $explodedLeavs = explode('.',$value);
            if(@$explodedLeavs[1] != null && $explodedLeavs[1] > 5){
                $explodedLeavs[1] = 5;
            }elseif(@$explodedLeavs[1] != null && $explodedLeavs[1] < 5){
                $explodedLeavs[1] = 0;
            }
            return implode('.',$explodedLeavs);
        }else{
            return @$value;
        }
    }
}

/************************************************************
*	@function get_posts
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm array			[array	optional	default	null]
*	@perm global		[true/false	optional	default	false]
*	@return posts [object]
************************************************************/
function get_posts($options = array(), $global = false){	

	$posts = array();
	
	//Return posts
	return $posts;
}
/************************************************************
*	@function get_global_posts
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm array			[array	optional	default	null]
*	@perm global		[true/false	optional	default	false]
*	@return posts [object]
************************************************************/
function get_global_posts($options = array()){	

	$posts = get_posts($options, true);
	
	//Return posts
	return $posts;
}
/************************************************************
*	@function get_post
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm id			[integer/string	optional	default	null]
*	@perm global		[true/false	optional	default	false]
*	@return post [array/object]
************************************************************/
function get_post($id = null , $global = false, $array =false){	


	
	if(is_int($id)){
		if($global){
			$post = GlobalPage::where(['id'=>$id])->first();
		} else {
			$post = Page::where(['id'=>$id])->first();
		}
	} else {
		if($global){
			$post = GlobalPage::where(['slug'=>$id])->first();
		} else {
			$post = Page::where(['slug'=>$id])->first();
		}
	}


	//Return $post
	return $post;
}
/************************************************************
*	@function get_global_post
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm id			[integer/string	optional	default	null]
*	@return post [array/object]
************************************************************/
function get_global_post($id = null, $array = false){	
	
	$post = get_post($id , true, $array);

	//Return $post
	return $post;
}

/************************************************************
*	@function get_post_meta
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm id			[integer/string	optional	default	null]
*	@perm global		[true/false	optional	default	false]
*	@return postmeta [array/object]
************************************************************/
function get_post_meta($id = null , $global = false, $array =false){	


	
	if(is_int($id)){
		if($global){
			$postmeta = GlobalPageMeta::where(['page_id'=>$id])->get();
		} else {
			$postmeta = PageMeta::where(['page_id'=>$id])->get();
		}
	} else {
		if($global){
			$post = get_post($id , true, $array);
			$post_id = $post->id;

			$postmeta = GlobalPageMeta::where(['page_id'=>$post_id])->get();
		} else {
			$post = get_post($id , false, $array);
			$post_id = $post->id;
			$postmeta = PageMeta::where(['page_id'=>$post_id])->get();
		}
	}
	if($array){
		$postmeta =  get_meta_array($postmeta);
	}
	//Return $postmeta
	return $postmeta;
}
/************************************************************
*	@function get_global_post_meta
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm id			[integer/string	optional	default	null]
*	@return postmeta [array/object]
************************************************************/
function get_global_post_meta($id = null, $array = false){	
	
	$postmeta = get_post_meta($id , true, $array);

	//Return $postmeta
	return $postmeta;
}
/************************************************************
*	@function get_slider
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm slug			[string	optional	default	null]
*	@return post [array/object]
************************************************************/
function get_slider($slug = null){
	$slidersData = [];	
	
	if($slug != null){
		if(is_int($slug)){
			$slides = Slider::where(['id' => $slug,'status' => 1])->get();
		}else{
			$slides = Slider::where(['slug' => $slug,'status' => 1])->get();
		}
	}else{
		$slides = Slider::where(['status' => 1])->get();
	}
		foreach ($slides->toArray() as $key => $value) {
			foreach ($value as $k => $v) {
				if($k == 'slider' || $k == 'options' || $k == 'setting'){
					if($k == 'slider'){
						$slidersData['slides'] = json_decode($v,true);
					}elseif($k == 'setting'){
						$slidersData['settings'] = json_decode($v,true);
					}else{
						$slidersData[$k] = json_decode($v,true);
					}
				}else{
					$slidersData[$k] = $v;
				}
			}
		}
	return $slidersData;
}

/**
 * will return custom error view inside layout
 *
 * @return custom error view
 * @author Rahul
 **/
function error($error_content = []){
	return view('organization.errors.custom-error',$error_content);
}

/************************************************************
*	@Module Tools
*	@Section Widgets
************************************************************/
/************************************************************
*	@function get_website_alexa_rank
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm url		[string	optional	default	null]
*	@return filename [array]
************************************************************/
function get_website_alexa_rank( $url = null ){

	$get_website_alexa_rank_data = array();
	$get_website_alexa_rank = array();
	
	$xml = simplexml_load_file("http://data.alexa.com/data?cli=10&url=".$url);
    if(!empty($xml->SD)){
		
		$get_website_alexa_rank['status'] = 'success';
		$get_website_alexa_rank_data['url'] = $xml->SD->POPULARITY->attributes()->URL; 
		$get_website_alexa_rank_data['rank'] = $xml->SD->POPULARITY->attributes()->TEXT;
		$get_website_alexa_rank_data['source'] = $xml->SD->POPULARITY->attributes()->SOURCE;
		$get_website_alexa_rank_data['past'] = $xml->SD->REACH->attributes()->RANK;
		$get_website_alexa_rank_data['change'] = $xml->SD->RANK->attributes()->DELTA;
		
	} else{
		$get_website_alexa_rank['status'] = 'error';
	}

	$json = json_encode($get_website_alexa_rank_data);
	$get_website_alexa_rank_array = json_decode($json,TRUE);
	
	foreach($get_website_alexa_rank_array as $key => $value){
		$get_website_alexa_rank[$key] = $value[0];
	}
	
	//Return Alexa rank Data
	return json_encode($get_website_alexa_rank);
}

	
	function get_settings($model, $key = null, $whereColumns = [], $array = true){
		get_meta($model, $uid = null, $key = null, $column = null, $array = false);
		$modelData = $model::get();
		if($key != null){
			$modelData = $modelData->where('key',$key);
		}
		if(!empty($whereColumns)){
			$modelData = $modelData->where($whereColumns);
		}
		if($array){
			$modelData = $modelData->toArray();
		}
		return $modelData;
	}



	/**
	 * [user_info to get current user information & employee Info]
	 * @return [collection] [user information]
	 */
	function user_info(){
		$id 	= Auth::guard('org')->user();
		// $user 	= User::select('id')->where(['user_id'=>$id->id])->first();
		// $user_merge = collect($id)->merge($user);
		return $id;
	}
/************************************************************
*	@function getMetaValue
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm key		[array	string]-
*	@perm array		[required	optional]
*	@return true
************************************************************/

	function getMetaValue($metaArray, $metaKey){
		$metaArray = collect($metaArray);
		$metaData = $metaArray->where('key',$metaKey);
		$metaValue = false;
		foreach($metaData as $key => $value){
			$metaValue = $value->value; 
		}
		return $metaValue;
	}

/************************************************************
*	@function get_attendance
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@return attendance [array]
************************************************************/
function get_attendance(){	

	$attendance = array();


	
	
	//Return attendance
	return $attendance;
}


/************************************************************
*	@function get_form_meta
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm fid		[integer	required	default	void]
*	@perm key		[string	required	default	void]
*	@perm array		[true/false	optional	default	false]
*	@return $meta (Form Meta)
************************************************************/

function get_form_meta($fid, $key = null, $array = true, $global = true){	
	
	$meta = array();
	if($global){
		$model = "Admin\\FormsMeta";
	} else {
		$model = "Organization\\FormsMeta";
	}
	
	$meta = get_meta($model, $fid, $key, 'form_id', $array);

	//Return Meta Object 
	return $meta;
}
/************************************************************
*	@function get_survey_meta
*	@access	public
*	@since	1.0.0.0
*	@author	SGS Sandhu(sgssandhu.com)
*	@perm sid		[integer/string	required	default	void]
*	@return $meta (Survey Meta)
************************************************************/
function get_survey_meta($sid){
	if(!is_int($sid)){
		$survey = forms::select(['form_slug', 'id'])->where('embed_token',$sid)->first();
	}
	$meta = get_form_meta($survey->id,null,true,false);
	return $meta;
}

	/************************************************************
	*	@function role_id
	*	@access	public
	*	@since	1.0.0.0
	*	@author	SGS Sandhu(sgssandhu.com)
	*	@perm key		[none]
	*	@perm array		[	]
	*	@return array
	************************************************************/



	function role_id(){

		$userData = user_info();
		 $userInfo = User::with('user_role_map')->where('user_id',$userData['id'])->first();//change
       	 $collection =  $userInfo['user_role_map'];
         $keyed = $collection->mapWithKeys(function ($item) {
             return [$item['role_id'] => $item['role_id']];
          });
		return array_values($keyed->all());		
	}
	/************************************************************
	*	@function setting_val_by_key
	*	@access	public
	*	@since	1.0.0.0
	*	@author	SGS Sandhu(sgssandhu.com)
	*	@perm key		[$key]
	*	@perm array		[	]
	*	@return value or null
	************************************************************/

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
	/************************************************************
	*	@function get_items_per_page
	*	@access	public
	*	@since	1.0.0.0
	*	@author	SGS Sandhu(sgssandhu.com)
	*	@perm key		[$key]
	*	@perm array		[	]
	*	@return value or null
	************************************************************/

	function get_items_per_page(){
		try{
			$perPageSetting = org_setting::where(['key' => 'perpagelist'])->first();
			if($perPageSetting != '' || $perPageSetting != null){
				$perPage = $perPageSetting->value;
			}else{
				$perPage = 10;
			}
			return $perPage;
		}catch(\Exception $e){
			return null;
		}
		
	}



	/************************************************************
	*	@function check_route_permisson
	*	@access	public
	*	@since	1.0.0.0
	*	@author	SGS Sandhu(sgssandhu.com)
	*	@perm key		[$url required]
	*	@perm array		[	]
	*	@return true or false
	************************************************************/
	function check_route_permisson($url)
	{
		if(in_array(1, role_id())){
			return true;
			}else{
				$routeCheck = route::where('route',$url);
			 	if($routeCheck->exists()){
				 	$route_id = $routeCheck->select('id')->first()->id;
				 	$check =  Permisson::whereIn('role_id',role_id())->where(['permisson_id'=>$route_id, 'permisson_type'=>'route'])->whereNotNull('permisson');
				 	if($check->exists())
				 	{
				 		return true;
				 	}
			}
		 return false;
		
		}
	}

    /**
     * Check if default role selected for employee
     * @return boolean will return true or false
     */
    function is_default_role_selected_for_employee($role_name){
        $role_value = setting_val_by_key($role_name);        
        if(empty($role_value) || $role_value == null){
            return false;
        }else{
            return true;
        }
    }


    /**
     * [createDefaultRoles will create new default roles if there is no any slug for specific role]
     * @param  [type] $details [having all the role related data]
     * @return [type]          [array]
     * @author Rahul
     */
    function createDefaultRoles(Array $roleDetails){
        $roleModel = 'App\Model\Organization\UsersRole';
        $roleModel = new $roleModel;
        $roleModel->name = $roleDetails['name'];
        $roleModel->description = $roleDetails['description'];
        $roleModel->slug = $roleDetails['slug'];
        $roleModel->status = 1;
        $roleModel->save();

        return $roleModel->id;
    }


	/************************************************************
	*	@function save_activity
	*	@access	public
	*	@since	1.0.0.0
	*	@author	SGS Sandhu(sgssandhu.com)
	*	@perm key		[$slug required , $name optional]
	*	@perm array		[	]
	*	@return true or false
	************************************************************/

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

	/**
	 * [is_primary_domain_exists description]
	 * @param  [type]  $domain [description]
	 * @return boolean         [description]
	 */
	function is_primary_domain_exists($domain){
        $primary_domain_existance_status = GlobalOrganization::where('primary_domain',$domain)->first();
        if($primary_domain_existance_status != null){
            return $primary_domain_existance_status;
        }else{
            return false;
        }
    }

    /**
     * [is_secondary_domain_exists description]
     * @param  [type]  $domain [description]
     * @return boolean         [description]
     */
    function is_secondary_domain_exists($domain){
        $secondary_domain_existance_status = GlobalOrganization::where('secondary_domains',$domain)->first();
        if($secondary_domain_existance_status != null){
            return $secondary_domain_existance_status;
        }else{
            return false;
        }
    }

    /**
     * get menus function
     *
     * @return menu array
     * @author Rahul
     **/
    function get_menu($menu_id){
    	return Menu::wlist($menu_id);
    }

    /**
     * get_title function to get
     *
     * @return string
     * @author Rahul
     **/
    function get_title($model, $id, $column){

    	$model = $model::where(['id'=>$id])->first();
    	if($model != null){
    		return $model->{$column};
    	}else{
    		return null;
    	}
    }

    /**
     * get dataset name function
     *
     * @return string
     * @author Rahul
     **/
    function get_dataset_title($id){

    	$model = 'App\\Model\\Organization\\Dataset';
    	$column = 'dataset_name';
    	$dataset_name = get_title($model,$id,$column);
    	return $dataset_name;
    }

    /**
     * get dataset name function
     *
     * @return string
     * @author sandip
     **/
    function get_map_title($id){

    	$model = 'App\\Model\\Admin\\CustomMaps';
    	$column = 'title';
    	$dataset_name = get_title($model,$id,$column);
    	return $dataset_name;
    }

    /**
     * get_survey_title function
     *
     * @return string
     * @author Rahul
     **/
    function get_survey_title($id){
    	$model = 'App\\Model\\Organization\\forms';
    	$column = 'form_title';
    	$survey_name  = get_title($model,$id,$column);
    	return $survey_name;
    }

    /**
     * get_visusualzaition_title function
     *
     * @return string
     * @author Rahul
     **/
    function get_visualization_title($id){
    	$model = 'App\\Model\\Organization\\Visualization';
    	$column = 'name';
    	$visualization_name = get_title($model,$id,$column);
    	return $visualization_name;
    }


    /**
     * Gets the page from page identifier.
     *
     * @param      string  $page_id  The page identifier
     *
     * @return     string  The page from page identifier.
     */
    function get_page_from_page_id($page_id){
        if($page_id == null || $page_id == ''){
            return $page_id;
        }
        return Page::get_page_slug($page_id);
    }

    /**
     * Gets the organization settings.
     */
    function get_organization_settings(){
        $settings = OrganizationSetting::get();
        return $settings;
    }


     /**
     * get_form_title function
     *
     * @return string
     * @author Rahul
     **/
    function get_form_title($id){
    	return get_survey_title($id);
    }

	/************************************************************
	*	@function activity_log
	*	@access	public
	*	@since	1.0.0.0
	*	@author	SGS Sandhu(sgssandhu.com)
	*	@perm key		[$slug required , $slug required]
	*	@perm array		[	]
	*	@return template
	************************************************************/

	function activity_log($slug, $language){
		$activity = GlobalActivityTemplate::where(['type'=>'self', 'slug'=>$slug ,'language'=>$language]);
		if($activity->exists()){
			return $activity->first()->template;
		}
	}

	//get current forms list by org or admin
	function listForms(){
		if(Auth::guard('admin')->check()){
            $model = 'App\\Model\\Admin\\forms';
        }else{
            $model = 'App\\Model\\Organization\\forms';
        }
        return $model::pluck('form_title','id');
    }
	function listSections(){
		if(Auth::guard('admin')->check()){
            $model = 'App\\Model\\Admin\\section';
        }else{
            $model = 'App\\Model\\Organization\\section';
        }
        return $model::pluck('section_name','id');
    }
    function listOperators()
    {
    	$list = ['add' => '+','sub' => '-','mul' => '*' ,'divi' => '/' ,'less' => '<','greater' => '>', 'lessEqual' => '<=' , 'greaterEqual' => '>=' , 'equal' => '=='];
    	return $list;
    }
    /**
     * parse_slug function
     *
     * @return camelCase to camel_case
     * @author 
     **/
    // function parse_slug($input) {
    //     preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
    //     $ret = $matches[0];
    //     foreach ($ret as &$match) {
    //         $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
    //     }
    //     return implode('_', $ret);
    // }


    function parse_slug($title, $raw_title = '', $context = 'display' )
    {
		$title = strip_tags($title);
		// Preserve escaped octets.
		$title = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $title);
		// Remove percent signs that are not part of an octet.
		$title = str_replace('%', '', $title);
		// Restore octets.
		$title = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $title);

		if (seems_utf8($title)) {
			if (function_exists('mb_strtolower')) {
				$title = mb_strtolower($title, 'UTF-8');
			}
			$title = utf8_uri_encode($title, 200);
		}

		$title = strtolower($title);

		if ( 'save' == $context ) {
			// Convert nbsp, ndash and mdash to hyphens
			$title = str_replace( array( '%c2%a0', '%e2%80%93', '%e2%80%94' ), '-', $title );
			// Convert nbsp, ndash and mdash HTML entities to hyphens
			$title = str_replace( array( '&nbsp;', '&#160;', '&ndash;', '&#8211;', '&mdash;', '&#8212;' ), '-', $title );

			// Strip these characters entirely
			$title = str_replace( array(
				// iexcl and iquest
				'%c2%a1', '%c2%bf',
				// angle quotes
				'%c2%ab', '%c2%bb', '%e2%80%b9', '%e2%80%ba',
				// curly quotes
				'%e2%80%98', '%e2%80%99', '%e2%80%9c', '%e2%80%9d',
				'%e2%80%9a', '%e2%80%9b', '%e2%80%9e', '%e2%80%9f',
				// copy, reg, deg, hellip and trade
				'%c2%a9', '%c2%ae', '%c2%b0', '%e2%80%a6', '%e2%84%a2',
				// acute accents
				'%c2%b4', '%cb%8a', '%cc%81', '%cd%81',
				// grave accent, macron, caron
				'%cc%80', '%cc%84', '%cc%8c',
			), '', $title );

			// Convert times to x
			$title = str_replace( '%c3%97', 'x', $title );
		}

		$title = preg_replace('/&.+?;/', '', $title); // kill entities
		$title = str_replace('.', '-', $title);

		$title = preg_replace('/[^%a-z0-9 _-]/', '', $title);
		$title = preg_replace('/\s+/', '-', $title);
		$title = preg_replace('|-+|', '-', $title);
		$title = trim($title, '-');

		// $title = str_replace('_', '-', $title);
		// $title = preg_replace('|-+|', '-', $title);
		// $title = trim($title, '-');
		
		return $title;
	}

	function seems_utf8( $str ) {
		// mbstring_binary_safe_encoding();
		$length = strlen($str);
		// reset_mbstring_encoding();
		for ($i=0; $i < $length; $i++) {
			$c = ord($str[$i]);
			if ($c < 0x80) $n = 0; // 0bbbbbbb
			elseif (($c & 0xE0) == 0xC0) $n=1; // 110bbbbb
			elseif (($c & 0xF0) == 0xE0) $n=2; // 1110bbbb
			elseif (($c & 0xF8) == 0xF0) $n=3; // 11110bbb
			elseif (($c & 0xFC) == 0xF8) $n=4; // 111110bb
			elseif (($c & 0xFE) == 0xFC) $n=5; // 1111110b
			else return false; // Does not match any model
			for ($j=0; $j<$n; $j++) { // n bytes matching 10bbbbbb follow ?
				if ((++$i == $length) || ((ord($str[$i]) & 0xC0) != 0x80))
					return false;
			}
		}
		return true;
	}

	function utf8_uri_encode( $utf8_string, $length = 0 ) {
		$unicode = '';
		$values = array();
		$num_octets = 1;
		$unicode_length = 0;

		// mbstring_binary_safe_encoding();
		$string_length = strlen( $utf8_string );
		// reset_mbstring_encoding();

		for ($i = 0; $i < $string_length; $i++ ) {

			$value = ord( $utf8_string[ $i ] );

			if ( $value < 128 ) {
				if ( $length && ( $unicode_length >= $length ) )
					break;
				$unicode .= chr($value);
				$unicode_length++;
			} else {
				if ( count( $values ) == 0 ) {
					if ( $value < 224 ) {
						$num_octets = 2;
					} elseif ( $value < 240 ) {
						$num_octets = 3;
					} else {
						$num_octets = 4;
					}
				}

				$values[] = $value;

				if ( $length && ( $unicode_length + ($num_octets * 3) ) > $length )
					break;
				if ( count( $values ) == $num_octets ) {
					for ( $j = 0; $j < $num_octets; $j++ ) {
						$unicode .= '%' . dechex( $values[ $j ] );
					}

					$unicode_length += $num_octets * 3;

					$values = array();
					$num_octets = 1;
				}
			}
		}

		return $unicode;
	}

    function get_all_defined_functions(){
        /*$functionlist = '';
        $content = file_get_contents(base_path().'/app/Helpers/global_helper.php');
        preg_match_all("/(function )(\S*)/", $content, $matches);
        dd($matches);
        foreach($matches[2] as $match) {
            $function[] = trim($match);
        }
        natcasesort($function);
        
        return $function;*/
        $source = file_get_contents(base_path().'/app/Helpers/global_helper.php');
        $tokens = token_get_all($source);
        $functions = array();
        $nextStringIsFunc = false;
        $inClass = false;
        $bracesCount = 0;

        foreach($tokens as $token) {

            switch($token[0]) {
                case T_CLASS:
                    $inClass = true;
                    break;
                case T_FUNCTION:
                    if(!$inClass) $nextStringIsFunc = true;
                    break;

                case T_STRING:
                    if($nextStringIsFunc) {
                        $nextStringIsFunc = false;
                        $functions[$token[1]] = $token[1];
                    }
                    break;

                // Anonymous functions
                case '(':
                case ';':
                    $nextStringIsFunc = false;
                    break;

                // Exclude Classes
                case '{':
                    if($inClass) $bracesCount++;
                    break;

                case '}':
                    if($inClass) {
                        $bracesCount--;
                        if($bracesCount === 0) $inClass = false;
                    }
                    break;
            }
        }

        return $functions;

        
    }





function isJson($string) {
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
}
	
?>
