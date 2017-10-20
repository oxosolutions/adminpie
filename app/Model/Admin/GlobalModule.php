<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Route;
use App\Model\Admin\GlobalGroup as Group;
use Auth;
class GlobalModule extends Model
{
    protected $fillable = ['name', 'route','tables', 'status'];   

     public static function getRouteListArray($from = null)
    {
        $routes = Route::getRoutes();
        foreach($routes as $route)
        {
            $routeList[NULL]= "Select Route";
            if($from == null){
                if(substr($route->uri ,0,1)=='_'){

                }else{
                    $rout =  str_replace('/{id}','',$route->uri);
                    $newRoute = str_replace('/{id?}','',$rout);
                    $routeList[$newRoute] = $newRoute;
                }
            }elseif(substr($route->uri ,0,1) != '_'){
                $routeList[$route->uri] = $route->uri;
            }
        }
        return $routeList;
    }

    public function listModules()
    {
        if(Auth::guard('group')->check()){
            $group_id = Auth::guard('group')->user()->group_id;
            $group_module = Group::select('modules')->where('id',$group_id)->first();
            $modules_ids =  array_map('intval', json_decode($group_module->modules));
            return Self::whereIn('id', $modules_ids)->pluck('name','id');
        }else{
            return Self::pluck('name','id');
        }
    }
    // public function permissons()
    // {
    //     return $this->morphMany('App\Model\Organization\RolePermisson', 'permisson');
    // }

	public function subModule()
	{
		return $this->hasMany('App\Model\Admin\GlobalSubModule','module_id','id')->orderBy('orderBy','ASC');
	}

public function widgets()
{
    return $this->hasMany('App\Model\Admin\GlobalWidget','module_id','id');
}
    // public function module_role_permisson()
    // {
    //     return $this->hasMany('App\Model\Organization\RolePermisson','module_id','id');
    // }


	// public function permisson()
	// {
	// $this->hasMany('App\PermissonRole','permisson_id','id');
	// }

}
