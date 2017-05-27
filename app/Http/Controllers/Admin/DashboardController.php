<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\GlobalOrganization as GLOR;

class DashboardController extends Controller
{
    public function index(){
    	$model = [
    				'organization' => [
    										'count' 	=> GLOR::count(),
    										'list' 		=> GLOR::all(),
    									],
    			];
    	return view('admin.dashboard.index')->with('model',$model);
    }
}
