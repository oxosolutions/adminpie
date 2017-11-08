<?php

namespace App\Model\Organization;

use Illuminate\Database\Eloquent\Model;
use Session;

class RolePermisson extends Model
{

	public static $breadCrumbColumn = 'id';

   	protected $fillable =[ "permisson_for", "permisson_type",  "permisson_id",  "permisson", 'role_id', 'module_id', 'read', 'write', 'delete', 'other', 'status'];

	public function __construct()
	   {	
	   
		   	if(!empty(Session::get('organization_id')))
		   	{
		       $this->table = Session::get('organization_id').'_role_permissons';
		   	}
	   }
	public function permisson_module()
	{
		return $this->belongsTo('App\Model\Admin\GlobalModule','module_id');
	}

	public static function hasPermission($roleId, $widgetId){

		$model = self::where(['role_id'=>$roleId,'permisson_type'=>'widget','permisson_id'=>$widgetId])->first();
		if($model == null || $model->permisson != 'on'){
			return false;
		}else{
			return true;
		}
	}

	public function widgets(){
		return $this->belongsTo('App\Model\Admin\GlobalWidget','permisson_id','id');
	}

	// public function permisson()
 //    {
 //        return $this->morphTo();
 //    }

}
