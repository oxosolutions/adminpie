<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\GlobalOrganization as GLOR;
use App\Model\Admin\User as User;
use App\Model\Admin\FormBuilder as FBuild;

class DashboardController extends Controller
{
    public function index(){
    	$model = [
    				'organization' => [
    										'count' 	=> GLOR::count(),
    										'list' 		=> GLOR::all(),
    									],
    				'users'		   => [
    										'count'		=> User::count(),
    										'list'		=> User::all(),
    									],
    				'forms'		   => [
    										'count' 	=> FBuild::count(),
    										'list'		=> FBuild::all(),
    									]
    			];
    			
    	return view('admin.dashboard.index')->with('model',$model);
    }
}
