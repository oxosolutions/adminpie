<?php
namespace App\Helpers;
    use App\Model\Admin\GlobalOrganization as ORG;
    use App\Model\Admin\GlobalModule as Module;
	use App\Model\Admin\GlobalModuleRoute as Route;
	use App\Model\Admin\GlobalSubModule;
    use App\Model\Organization\RolePermisson as Permisson;
    use App\Model\Organization\User;
    use Auth;

class draw_sidebar{
    static function drawSidebar()
    {
        $model = Module::with(['subModule'=>function($query){
                $query->with('moduleRoute');
            }])->orderBy('orderBy','asc')->get();

        return $model;
    }
    static function getSubModule($module){
        $data = Module::where('name','LIKE',$module.'%')->first();
        $id = @$data->id;
        $model = Module::where('id',$id)->with(['subModule' => function($query){
            $query->with('moduleRoute');
        }])->first();
        return $model; 
       
    }
    static function replace_route($route)
    {
        $uri =str_replace('/{id}','',$route); 
        return $current_uri = str_replace('/{id?}','',$uri);
    }
    static function widget_permisson()
    {
          return  role_id();  
    }

    static function checkPermisson(){
        
         $current_role_id =1;
    if(Auth::guard('org')->check()){
       
         if(in_array(1, role_id()))
            {
                $data = [];
                $orgModule = ORG::organization_module();
                $mainModule = Module::with(['subModule'=>function($query){
                    $query->with('moduleRoute');
                    }])->whereIn('id',$orgModule)->get();
                foreach ($mainModule as $key => $value) {
                        $data['module'][$value['id']]['permisson'] ='on';
                        if(!empty($value['route'])){
                        $data['url'][] = self::replace_route($value['route']);
                        }
                        foreach ($value['subModule'] as $subKey => $subValue) {
                           $data['submodule'][$subValue['id']]['permisson'] ='on';
                            if(!empty($subValue['sub_module_route'])){
                               $data['url'][] = self::replace_route($subValue['sub_module_route']);
                            }
                            foreach ($subValue['moduleRoute'] as $routeKey => $routeValue) {
                                $data['route'][$routeValue['id']]['permisson'] ='on';
                                if(!empty($routeValue['route'])){
                                    $data['url'][] = self::replace_route($routeValue['route']);
                                }
                            } 
                        }
                }
                
                return $data;
            }elseif(!in_array(1, role_id())){
             $permisson = Permisson::select(["permisson_type",  "permisson_id",  "permisson"])->whereIn('role_id',role_id())->whereNotNull('permisson')->get()->groupBy('permisson_type');

             if(isset($permisson['module'])){
                $data['module']= $permisson['module']->keyBy('permisson_id')->toArray();
                }else{
                    $data['module'] =null;
                }
            if(isset($permisson['submodule'])){
             $data['submodule']= $permisson['submodule']->keyBy('permisson_id')->toArray();
                }
             if(isset($permisson['route'])){
             $data['route'] = $permisson['route']->keyBy('permisson_id')->toArray();
                }
        }else{
            $data =[];
        }
    }else{
         $data =[];
    }
         return $data;
}

    // static function checkPermisson(){
        
    //      $current_role_id =1;
    // if(Auth::guard('org')->check()){
       
    //      if($current_role_id==1)
    //         {
    //             $data = [];
    //             $orgModule = ORG::organization_module();
    //             $mainModule = Module::with(['subModule'=>function($query){
    //                 $query->with('moduleRoute');
    //                 }])->whereIn('id',$orgModule)->get();
    //             foreach ($mainModule as $key => $value) {
    //                     $data['module'][$value['id']]['permisson'] ='on';
    //                     if(!empty($value['route'])){
    //                     $data['url'][] = self::replace_route($value['route']);
    //                     }
    //                     foreach ($value['subModule'] as $subKey => $subValue) {
    //                        $data['submodule'][$subValue['id']]['permisson'] ='on';
    //                         if(!empty($subValue['sub_module_route'])){
    //                            $data['url'][] = self::replace_route($subValue['sub_module_route']);
    //                         }
    //                         foreach ($subValue['moduleRoute'] as $routeKey => $routeValue) {
    //                             $data['route'][$routeValue['id']]['permisson'] ='on';
    //                             if(!empty($routeValue['route'])){
    //                                 $data['url'][] = self::replace_route($routeValue['route']);
    //                             }
    //                         } 
    //                     }
    //             }
                
    //             return $data;
    //         }elseif(!empty($current_role_id)){
    //          $permisson = Permisson::select(["permisson_type",  "permisson_id",  "permisson"])->where('role_id',$current_role_id)->whereNotNull('permisson')->get()->groupBy('permisson_type');

    //          if(isset($permisson['module'])){
    //             $data['module']= $permisson['module']->keyBy('permisson_id')->toArray();
    //             }else{
    //                 $data['module'] =null;
    //             }
    //         if(isset($permisson['submodule'])){
    //          $data['submodule']= $permisson['submodule']->keyBy('permisson_id')->toArray();
    //             }
    //          if(isset($permisson['route'])){
    //          $data['route'] = $permisson['route']->keyBy('permisson_id')->toArray();
    //             }
    //     }else{
    //         $data =[];
    //     }
    // }else{
    //      $data =[];
    // }
    //      return $data;
    //     }
}

?>