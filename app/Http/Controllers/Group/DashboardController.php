<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use App\Model\Admin\GlobalOrganization;
use App\Model\Group\GroupUsers;


class DashboardController extends Controller
{
	
    public function index(){
        Session::put('group_id',Auth::guard('group')->user()['group_id']);
    	$list_org = GlobalOrganization::where('group_id',Auth::guard('group')->user()['id'])->get();
    	$list_user = GroupUsers::all();
    	$model = [
    				'Organizations' => [
    								'count' => GlobalOrganization::where('group_id',Auth::guard('group')->user()['id'])->count(),
				    				'list'	=> GlobalOrganization::all(),
                                    'route' => 'list.groupOrganizations'
    							],
    				'Users' => [
    								'count' =>	GroupUsers::count(),
				    				'list'	=>	GroupUsers::all(),
                                    'route' => 'group.users'
    								]
    			];
    	return view('group.dashboard.index',compact('model'));
    }
}
