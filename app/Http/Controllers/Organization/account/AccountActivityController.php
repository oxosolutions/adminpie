<?php

namespace App\Http\Controllers\Organization\account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Model\Organization\LogSystem as LS;
use App\Model\Organization\ActivityLog;


class AccountActivityController extends Controller
{
    
	public function listActivities($id = null)
	{
        if($id == null){
            $id = current_organization_user_id();
            return redirect()->route('account.activities',$id);
        }
        can_i_access_this_user($id);
		$user_log = LS::where('user_id',$id)->paginate(10);
		
		return view('organization.profile.activities')->with(['user_log' => $user_log]);
	}
}