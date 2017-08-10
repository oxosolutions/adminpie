<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\GlobalModule as Module;
use App\Model\Admin\GlobalModuleRoute as Route;
use App\Model\Admin\GlobalSubModule;
class ModuleController extends Controller
{
    
    public function listModule()
    {
    	$model  = Module::orderBy('orderBy','asc')->with('subModule')->get();
        // dd($model);
    	return view('admin.module.index',['listModule'=>$model]);
    }
    public function create()
    {
        
    	return view('admin.module.create');
    }

    protected function save_module_route($request , $module_id)
    {
     foreach ($request['route'] as $key => $value) {
            $add_route = new Route();
            $add_route->module_id = $module_id;
            $add_route->route = $value;
            $add_route->route_for = $request['route_for'][$key];
            if(isset($request['route_name'][$key]))
            {
                        $add_route->route_name = $request['route_name'][$key];
            }
            $add_route->save();
        }   
    }
    public function save(Request $request)
    {
        // dd($request->all());
        $mainModule = new Module();
        $mainModule->name = $request->name;
        $mainModule->route = $request->route;
        $mainModule->save();
        foreach($request->submodule as $key => $submodule){
            $globalSubModule = new GlobalSubModule;
            $globalSubModule->name = $submodule['submodule_name'];
            $globalSubModule->sub_module_route = $submodule['sub_module_route'];
            $globalSubModule->module_id = $mainModule->id;
            $globalSubModule->status = 1;
            $globalSubModule->save();
            foreach($submodule['perm_route_name'] as $routeKey => $rouetValue){
            	if($rouetValue != null){
            		$globalModuleRoute = new Route;
	                $globalModuleRoute->sub_module_id = $globalSubModule->id;
	                $globalModuleRoute->route = $submodule['perm_route'][$routeKey];
	                $globalModuleRoute->route_name = $submodule['perm_route_name'][$routeKey];
	                $globalModuleRoute->status = 1;
	                $globalModuleRoute->save();
            	}
            }
        }
    	return redirect()->route('list.module');
    	
    }
//Module form add route row
    public function add_route_row()
    {

        return view('admin.module.add_route_row');
    }


    /**
     * [edit description]
     * @param  Request $request [form data]
     * @param  [int]  $id      [description]
     * @return [type]           [description]
     */
    public function edit(Request $request, $id=null)
    { 
        if($request->isMethod('post')){  
            $mainModule = Module::with(['subModule'=>function($query){
            $query->with('moduleRoute');
            }])->find($id);
            
	        $mainModule->name = $request->name;
	        $mainModule->route = $request->route;
	        $mainModule->save();
            $subModulesCheck = GlobalSubModule::where('module_id',$id);
            if($subModulesCheck->exists()){
             $subModules = GlobalSubModule::where('module_id',$id)->select('id')->get()->keyBy('id')->toArray();
            }
            if($request->submodule != null){
                foreach($request->submodule as $key => $submodule){
                   if(isset($submodule['submodule_id'])){
                    unset($subModules[$submodule['submodule_id']]);
                        $globalSubModule = GlobalSubModule::find($submodule['submodule_id']);
                    }else{
    	               $globalSubModule = new GlobalSubModule;
                    }
    	            $globalSubModule->name = $submodule['submodule_name']; 
    	            $globalSubModule->sub_module_route = $submodule['sub_module_route'];
    	            $globalSubModule->module_id = $mainModule->id;
    	            $globalSubModule->status = 1;
    	            $globalSubModule->save();
                    $routeCheck =  Route::where('sub_module_id',$globalSubModule->id);
                    $routes = $routeCheck->select('id')->get()->keyBy('id')->toArray();
                   if($routeCheck->exists()){
                    $routes = $routeCheck->select('id')->get()->keyBy('id')->toArray();
                   }

    	            if(isset($submodule['perm_route_name'])){
    	            	foreach($submodule['perm_route_name'] as $routeKey => $rouetValue){
    		            	if($rouetValue != null){
                                if(isset($submodule['route_id'][$routeKey])){
                                    unset($routes[$submodule['route_id'][$routeKey]]);
                                    $globalModuleRoute = Route::find($submodule['route_id'][$routeKey]);
                                }else{
    		            		        $globalModuleRoute = new Route;
                                    }
    			                $globalModuleRoute->sub_module_id = $globalSubModule->id;
    			                $globalModuleRoute->route = $submodule['perm_route'][$routeKey];
    			                $globalModuleRoute->route_name = $submodule['perm_route_name'][$routeKey];
    			                $globalModuleRoute->status = 1;
    			                $globalModuleRoute->save();
    		            	}
                        }
    	            }
                   if(!empty($routes)){
                        $flattenRoute =collect($routes)->flatten()->all();
                        Route::whereIn('id',$routes)->delete();
                    }
    	        }
                $flattenModule = collect($subModules)->flatten()->all();
                GlobalSubModule::with('moduleRoute')->whereIn('id',$flattenModule)->delete();
                Route::whereIn('sub_module_id',$flattenModule)->delete();
            }
            return redirect()->route('list.module');
        }
        $module =[];
        if(!empty($id))
        {
            $module = Module::with(['subModule'=>function($query){
                $query->with('moduleRoute');
            }])->where('id',$id)->first();
        }
        return view('admin.module.edit',['module'=>$module]);
    }
    public function delete_route($id)
    {
       $model = Route::find($id);
       $model->delete();
       return back();
    }
    
	public function delete($id)
    {     
         Module::with(['subModule'=>function($query){
                $query->with('moduleRoute');
            }])->find($id)->delete();
         return back();
    }

    public function update_module_status(Request $request){
        if($request['status']=='true')
        {
            $status['status'] = 1;
        }
        else{
           $status['status'] =  0;
        }
      Module::where('id',$request['id'])->update($status);
      
    }

    public function createSubmodule($moduleID){
       return view('admin.module.submodule.create');
    }

    public function submoduleList($moduleID){

        $subModule = GlobalSubModule::where('module_id',$moduleID)->get();
        return view('admin.module.submodule.index',['submodule'=>$subModule]);
    }

    public function saveSubModule(Request $request, $moduleID){

        $model = new GlobalSubModule;
        $model->name = $request->name;
        $model->status = 1;
        $model->module_id = $moduleID;
        $model->save();
        return redirect()->route('submodule.list');
    }

    public function saveStyleModule(Request $request)
    {
        $model = Module::where('id',$request->modules_id)->update($request->except('_token','modules_id'));
        return back();  
    }

    /*************** Ajax Functions *****************/

    public function getSingleModule(Request $request, $id = null){
        if($id != null){

        }else{
            $moduleCount = $request->moduleCount;
            return view('admin.module.sub-module.module',['count'=>$moduleCount])->render();
        }
    }

    public function getSingleRoutePermission(Request $request){
        $routeCount = $request->routeCount;
        return view('admin.module.sub-module.route-perm',['count'=>$routeCount]);
    }
    public function sortModule(Request $request)
    {
        //get value of module and arrange it by sort 
       $module_id = $request->module_id;
        $new_array = [];
        $index = 1;
       foreach($module_id as $key => $value){
            $new_array[$value] = $index;
            $index++;
       }
        foreach($new_array as $module_id => $order_id){
            Module::where('id',$module_id)->update(['orderBy'=>$order_id]);
        }

    }
    public function style($id)
    {
        $model = GlobalSubModule::where('id',$id)->first();
        return view('admin.module.style',compact('model'));
    }
    public function getSubmodules($id)
    {
        $model = GlobalSubModule::where('module_id',$id)->get();
        return view('admin.module.getSubModule',compact('model'));
    }
    public function saveStyle(Request $request)
    {   
        $model = GlobalSubModule::where('id',$request->sub_modules_id)->update($request->except('_token','sub_modules_id'));
        return back();
    }

}
// $keyBy = Module::select('id')->get()->keyBy('id')->toArray();
        // $mids = collect($keyBy)->flatten()->toArray();
        // GlobalSubModule::whereNotIn('module_id',$mids)->delete();

        // $subkeyBy = GlobalSubModule::select('id')->get()->keyBy('id')->toArray();
        // $submids = collect($subkeyBy)->flatten()->toArray();
        // Route::whereNotIn('sub_module_id',$submids)->delete();