<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Illuminate\Http\Request;
use App\Model\Organization\UsersRole as Role;
use App\Model\Organization\RolePermisson as Permisson;
use App\Model\Admin\GlobalModule as module;
use App\Model\Admin\GlobalSubModule as submodule;
use App\Model\Admin\GlobalModuleRoute as route;
use App\Helpers\draw_sidebar;
use App\Model\Organization\User;
use Auth;
use Session;
class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role = null)
    {  
     
      $current_route =  $request->route();
      $uri =str_replace('/{id}','',$current_route->uri);
      $current_uri = str_replace('/{id?}','',$uri);
      if(!in_array(1, role_id())){
        $permisson = Permisson::whereIn('role_id',role_id())->whereNotNull('permisson')->get();

        foreach ($permisson as $key => $value) {
          if($value['permisson_type']=='module'){
                  $route = module::where('id',$value['permisson_id'])->whereNotNull('route');
                  if($route->exists()){
                   $routes[]= $route->first()->route;
                  }
          }elseif($value['permisson_type']=='submodule'){
            $submodule = submodule::where('id',$value['permisson_id'])->whereNotNull('sub_module_route');
                  if($submodule->exists()){
                    $routes[]= $submodule->first()->sub_module_route;
                    $value['permisson_id'];
                  }
          }elseif($value['permisson_type']=='route'){
             $route = route::where('id',$value['permisson_id'])->whereNotNull('route');
                  if($route->exists()){
                   $routes[]= $route->first()->route;
                  }
          }
        }
      }
      elseif(in_array(1, role_id())){
        $route = draw_sidebar::checkPermisson();
        if(!empty($route)){
            $routes = $route['url'];
        }else{
          $routes = '';
        }
      }
      
        if(!empty($routes) &&in_array($current_uri, $routes)){
          return $next($request);
        }else{
          return redirect()->route('access.denied');
        }
    }
}
// return response([
         //                'error' => [
         //                    'code' => 'INSUFFICIENT_ROLE',
         //                    'description' => 'You are not authorized to access this resource.'
         //                ]
         //            ], 401);