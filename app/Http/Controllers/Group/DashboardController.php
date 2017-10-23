<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use App\Model\Admin\GlobalOrganization;
use App\Model\Group\GroupUsers;

class DashboardController extends Controller{
    public function index(){
        $group_id = Auth::guard('group')->user()['group_id'];
    	$model = [
    				'Organizations' => [
    								'count' => GlobalOrganization::where('group_id',$group_id)->count(),
				    				'list'	=> null,
                                    'route' => 'list.groupOrganizations'
    							],
    				'Users' => [
    								'count' =>	GroupUsers::count(),
				    				'list'	=>	null,
                                    'route' => 'group.users'
    								]
    			];
    	return view('group.dashboard.index',compact('model'));
    }
}
