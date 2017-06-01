<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Illuminate\Http\Request;
use App\Model\Organization\UsersRole as Role;
use App\Model\Organization\RolePermisson as Permisson;
use App\Model\Admin\GlobalModule as Module;
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


    public function handle($request, Closure $next)
    {
               
        $current_route =  $request->route();
        $current_uri = $current_route->uri;
       $current_role_id = Auth::guard('org')->user()->role_id;
      // dump($current_role_id);
       //dump($current_role_id);

      // $data = Role::with(['permisson'=>function($query){
      //       $query->with('permisson_module.route');
        $data = Role::with('permisson.permisson_module.route')->where('id',$current_role_id)->get();
         $permisson = $data[0]['permisson'];
      //  dump($permisson);
         $keys = "";
        foreach ($permisson as $key => $value) {
           $module_id = $value['module_id'];
           // dump('module id'.$value['module_id']);
            $pdta = collect($value);
            $filter_data =  $pdta ->keyBy('module_id');
            if(!empty($value['read']))
            {
                $permisson_val[$module_id]['read'] = true;
            }else{
                $permisson_val[$module_id]['read'] = false;

            }
            if(!empty($value['write']))
            {
                $permisson_val[$module_id]['write'] = true;
            }else{
                $permisson_val[$module_id]['write'] = false;
            }

            if(!empty($value['delete']))
            {
                $permisson_val[$module_id]['delete'] = true;
            }else{
                $permisson_val[$module_id]['delete'] = false;
            }

           // $collection = collect($value);
           // echo  $filtered = $collection->filter(function ($value, $key) {
           //      if($value=='on')
           //      {
           //          return $key;
           //      }
           //   });

          //  dump($value['permisson_module']['route']);
            foreach ($value['permisson_module']['route'] as $routeKey => $routeValue) {

               // dump($routeValue);
                //dump('moduleee->'.$routeValue['module_id']);
              //  dump($routeValue['route']);
                
                if($current_uri==$routeValue['route'])
                {
                       $route_for_val = $routeValue['route_for'];
                        if($permisson_val[$routeValue['module_id']][$route_for_val]==true)
                        {
                            dump("Yes have permisson Yes have permisson Yes have permisson Yes have permisson");
                            return $next($request);

                        }
                }
                // foreach ($moduleValue['route'] as $routeKey => $routeValue) {
                //     dump($routeValue);
                // }
            }
        }

        return response([
                        'error' => [
                            'code' => 'INSUFFICIENT_ROLE',
                            'description' => 'You are not authorized to access this resource.'
                        ]
                    ], 401);
        die;
       //  //get current route
       //  $current_route =  $request->route();
       // dump($current_route->uri);
        //echo  str_replace('/{id}','',$current_route->uri);

        // dump($current_route);

        // get Role permisson
        // $role_id = $request->user()->role_id;
        // $role = DB::table('roles as r')
        //             ->select('prm.*','r.id as rid','r.name as rname','pr.read','pr.write','pr.delete','p.name as pname','p.id as pid')
        //             ->leftJoin('permisson_roles as pr','pr.role_id','=','r.id')
        //             ->leftJoin('permissons as p','p.id','=','pr.permisson_id')
        //             ->leftJoin('permisson_route_mappings as prm','prm.permisson_id','=','p.id')
        //             ->where('r.id',$role_id)->get();
        //       //dd($role);         
        // foreach ($role as  $value) {
        //     # code...
        //     if($value->route== $current_route)
        //     {
        //         //echo $value->read;
        //          $routePermisson = $value->route_for;
        //         if($value->$routePermisson==true)
        //         {
        //          return $next($request);
        //         }
        //     }
        // }
//return $next($request);
        //         }
         return response([
                        'error' => [
                            'code' => 'INSUFFICIENT_ROLE',
                            'description' => 'You are not authorized to access this resource.'
                        ]
                    ], 401);

    }
    private function getRequiredRoleForRoute($route)
    {
        $actions = $route->getAction();
        return $actions;
    }
}
