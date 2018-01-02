<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ControlPanelController extends Controller
{
	/**
	 * @auther ashish 
	 */
	public function testing()
	{
		return view('admin.control-panel.testing');
	}
	public function consistency()
	{
		return view('admin.control-panel.consistency');
	}

    public function runRouteTest(Request $request){
        dd($request->all());
    }
}
