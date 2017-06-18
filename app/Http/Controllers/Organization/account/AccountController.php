<?php

namespace App\Http\Controllers\Organization\account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class AccountController extends Controller
{
     public function emailsList(){
        return view('organization.profile.email');
    }

    public function profileDetails($id = null){
    	if($id == null){
    		$id = Auth::guard('org')->user()->id;
    	}
    	return view('organization.profile.view');
    }
}
