<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Model\Organization\UserRoleMapping;
use App\Model\Organization\RolePermisson;
use App\Model\Organization\UsersMeta as UM;

use Auth;

class GlobalWidget extends Model
{
    protected $fillable = ['title', 'description', 'status', 'slug','model', 'module_id','order','type'];

    public function widget_permisson()
    {
    	return $this->hasMany('App\Model\Organization\WidegetPermisson','widget_id','id');
    }
    // public static function getWidgetsByUser_id()
    // {
    // 	if(Auth::guard('admin')->check()){
    // 		$id = Auth::guard('admin')->user()->id;
    // 	}else{
    // 		$id = Auth::guard('org')->user()->id;
    // 	} 
    // 	$model = UserRoleMapping::where('user_id',$id)->first();
    // 		$widgets = RolePermisson::where(['role_id'=>$model['role_id'] , 'permisson_type' => 'widget'])->get();
    // 	return $widgets;
    // }
    public static function getWidgetsByUser_id()
    {
        $roles = get_user_roles();
        $dashboard_tabs = [];
        if(!in_array('administrator',$roles)){
            $model = UM::where(['user_id'=> Auth::guard('org')->user()->id , 'key' => 'dashboards'])->first();
            $dashboard_tabs = json_decode($model->value);
            $widgets = $widgets->where('permisson','on')->get();
            
        }else{
            $model = UM::where(['user_id'=> Auth::guard('org')->user()->id , 'key' => 'dashboards'])->first();
            if($model == null){
                $dashboard_tabs = [];
            }else{
                $dashboard_tabs = json_decode($model->value);
            }
            $widgets = GlobalWidget::get();
        }
    }
}
