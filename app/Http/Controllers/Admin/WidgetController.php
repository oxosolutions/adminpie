<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\GlobalWidget as GW;

class WidgetController extends Controller
{
	public function index()
	{
		$data = GW::all();	
		return view('admin.widget.index',['data'=>$data]);
	}
    public function create(Request $request)
    {
    	if($request->isMethod('post'))
    	{
    		$widget = new GW();
    		$widget->fill($request->all());
    		$widget->save();
    		dump($request->all());
    		return redirect()->route('index.widget');
    	}
      	return view('admin.widget.widget');
    }
    public function delete($id)
    {
    	$widget = GW::find($id);	
    	$widget->delete();
        return redirect()->route('index.widget');
    }
}
