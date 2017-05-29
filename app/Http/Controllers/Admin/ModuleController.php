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
    	//dump($model);
    	return view('admin.module.index',['list'=>$model]);

    }
    public function create()
    {
    	return view('admin.module.create');
    }
    public function save(Request $request)
    {
    	//dump($request->all());

    	$add = new Module();
    	$add->fill($request->all());
    	$add->save();
    	$module_id =  $add->id;
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

    	return redirect()->route('list.module');
    	
    }
//Module form add route row
    public function add_route_row()
    {
        return view('admin.module.add_route_row');
    }

    public function edit($id)
    {
    	return view('admin.module.create_new');
    }
    public function update(Request $request)
    {
    	
    }
	public function delete($id)
    {
     $mo = Module::find('id',$id);//->delete();

    	$mo->route()->detach($id);
    }
}
