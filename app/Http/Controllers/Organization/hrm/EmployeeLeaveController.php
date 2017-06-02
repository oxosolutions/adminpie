<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
USE App\Model\Organization\EmployeeLeave as EMP_LEV;

class EmployeeLeaveController extends Controller
{

	Public function list(Request $request)
	{ 
		if($request->isMethod('post'))
		{

		}
		return view('organization.employee_leave.list_leave');
	}
    
}
