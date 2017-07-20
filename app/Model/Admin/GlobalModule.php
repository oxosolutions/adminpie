<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Route;

class GlobalModule extends Model
{
    protected $fillable = ['name', 'route', 'status'];   

     public static function getRouteListArray()
    {
        $routes = Route::getRoutes();
        foreach($routes as $route)
        {
            $routeList[NULL]= "Select Route";
           if(substr($route->uri ,0,1)=='_'){
            }
           else{
                $rout =  str_replace('/{id}','',$route->uri);
                $newRoute = str_replace('/{id?}','',$rout);
                $routeList[$newRoute] = $newRoute;
            }
        }
        return $routeList;
    }

    // public function permissons()
    // {
    //     return $this->morphMany('App\Model\Organization\RolePermisson', 'permisson');
    // }

	public function subModule()
	{
		return $this->hasMany('App\Model\Admin\GlobalSubModule','module_id','id');
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
