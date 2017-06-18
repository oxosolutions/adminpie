<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Route;

class GlobalModule extends Model
{
    protected $fillable = ['name', 'route_data', 'status'];   

     public static function getRouteListArray()
    {
        $routes = Route::getRoutes();
        foreach($routes as $route)
        {
           if(substr($route->uri ,0,1)=='_'){
            }
           else{
                $rout =  str_replace('/{id}','',$route->uri);
                $routeList[$rout] = $rout;
            }
        }
        return $routeList;
    }

	public function route()
	{
		return $this->hasMany('App\Model\Admin\GlobalModuleRoute','module_id','id');
	}

    public function module_role_permisson()
    {
        return $this->hasMany('App\Model\Organization\RolePermisson','module_id','id');
    }


	// public function permisson()
	// {
	// $this->hasMany('App\PermissonRole','permisson_id','id');
	// }

}
