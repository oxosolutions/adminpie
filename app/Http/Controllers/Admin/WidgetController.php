<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\GlobalWidget as GW;
use App\Model\Admin\GlobalModule as Module;


class WidgetController extends Controller
{
   protected $module_data;
    public function __construct()
    {
        $this->module_data = Module::pluck('name','id');

    }
	public function index()
	{
       
         $data = GW::all();	
		return view('admin.widget.index',['data'=>$data ]);
	}
    public function create(Request $request)
    {
               
    	if($request->isMethod('post'))
    	{
    		$widget = new GW();
    		$widget->fill($request->all());
    		$widget->save();
    		return redirect()->route('index.widget');
    	}
      	return view('admin.widget.widget',['module_data'=>$this->module_data]);
    }
    public function edit(Request $request, $id=null)
    {
        if($request->isMethod('post'))
        {
            GW::where('id',$request['id'])->update($request->except(['_token','id']));
            return redirect()->route('index.widget');
        }   
        $data = GW::where('id',$id)->first();
        return view('admin.widget.widget',['id'=>$id,'data'=>$data, 'module_data'=>$this->module_data]);

    }
    public function delete($id)
    {
    	$widget = GW::find($id);	
    	$widget->delete();
        return back();//redirect()->route('index.widget');
    }
    public function update_widget_status(Request $request)
    {
      if($request['status']=='true')
        {
            $status['status'] = 1;
        }
        else{
           $status['status'] =  0;
        }
      GW::where('id',$request['id'])->update($status);
      
    }
}
