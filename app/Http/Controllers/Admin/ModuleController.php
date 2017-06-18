<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\GlobalModule as Module;
use App\Model\Admin\GlobalModuleRoute as Route;

class ModuleController extends Controller
{
    public function listModule()
    {
    	$model  = Module::with('route')->get();
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
        $add = new Module();
    	$add->fill($request->all());
    	$add->save();
    	$module_id =  $add->id;
    	$this->save_module_route($request , $module_id);

    	return redirect()->route('list.module');
    	
    }
//Module form add route row
    public function add_route_row()
    {

        return view('admin.module.add_route_row');
    }



    public function edit(Request $request, $id=null)
    { 
        if($request->isMethod('post'))
        {
            $module_id = $request['id'];
            Module::where('id',$request['id'])->update(['name'=>$request['name']]);
            foreach ($request['route_edit'] as $key => $value) {
               $mid=$value['id'];
               unset($value['id']);
               Route::where('id',$mid)->update($value);
            }
            if(!empty($request['route']))
            {
                $this->save_module_route($request , $module_id);
            }
        return back(); 
        }
        $module =[];
        if(!empty($id))
        {
        $module = Module::with('route')->where('id',$id)->first();
        }
        return view('admin.module.edit',['module'=>$module]);
    }
    public function delete_route($id)
    {
       $model = Route::find($id);
       $model->delete();
       return back();
    }
    
    public function update(Request $request)
    {
    	
    }
	public function delete($id)
    {     
         Module::find($id)->delete();
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

}
