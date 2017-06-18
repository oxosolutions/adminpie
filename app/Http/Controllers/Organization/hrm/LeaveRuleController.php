<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
* 
*/
class LeaveRuleController extends Controller
{
	
	public function rule(Request $request)
	{
		dump($request->all());
	}
}