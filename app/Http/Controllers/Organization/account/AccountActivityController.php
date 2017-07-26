<?php

namespace App\Http\Controllers\Organization\account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Model\Organization\LogSystem as LS;
use App\Model\Organization\ActivityLog;


class AccountActivityController extends Controller
{
    
	public function listActivities()
	{
		$user_id = Auth::guard('org')->user()->id;
		$user_log = ActivityLog::where('user_id',$user_id)->paginate(10);
		
		
		return view('organization.profile.activities')->with(['user_log' => $user_log]);
	}
}