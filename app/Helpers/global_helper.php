<?php


use app\Model\Organization\User;
use App\Model\Organization\OrganizationSetting as org_setting;



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
		return $setting->first()->value;
	}else{
		return false;
	}
}


?>