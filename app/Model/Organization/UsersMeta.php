<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;
use Auth;
class UsersMeta extends Model
{
	public static $breadCrumbColumn = 'id';
   public function __construct()
   {	
	   	if(!empty(Session::get('organization_id')))
	   	{
	       $this->table = Session::get('organization_id').'_users_metas';
	   	}
   }
   
   protected $fillable = ['user_id', 'key', 'value', 'type'];

   public static function saveDataListSetting($url,$params){
	   if(Auth::guard('org')->check()){
	   		$user = Auth::guard('org')->user()->id;
	   		$model = self::where(['key'=>$url,'user_id'=>$user])->first();
	   		if($model == null){
	   			$model = new self;
	   			$model->key = $url;
	   			$model->value = (@$params[1])?$params[1]:'';
	   			$model->user_id = $user;
	   			$model->save();
	   		}else{
	   			$model->key = $url;
	   			$model->value = (@$params[1])?$params[1]:'';
	   			$model->user_id = $user;
	   			$model->save();
	   		}
		   	return $params;	
	   }
   }

   public static function getDataListSettings($url){
   	if(Auth::guard('admin')->check()){
   		$user = Auth::guard('admin')->user()->id;
   	}else{
   		$user = Auth::guard('org')->user()->id;
   	}
   		$model = self::where(['key'=>$url,'user_id'=>$user])->first();
   		if($model != null){
   			return $model->value;
   		}else{
   			return null;
   		}
   }

   public static function getUserMeta($metaKey){
		$model = self::where(['user_id'=>Auth::guard('org')->user()->id,'key'=>$metaKey])->first();
		return @$model->value;
   }

}
