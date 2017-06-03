<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
USE App\Model\Organization\EmployeeLeave as EMP_LEV;

class EmployeeLeaveController extends Controller
{

	Public function list(Request $request, $id=null)
	{ 
		dump($request->method());
		// if($request->isMethod('post'))
		// {
		// 	$leave = new EMP_LEV();	
		// 	$leave->fill($request->all());
		// 	$leave->save();
		//  }
		// else if($request->isMethod('update'))
		// {	
		// 	dump('update');
		// 	dump($request->all());
		// }
		// elseif($request->isMethod('delete')){

		// 	$data = EMP_LEV::find($request['delete_id']);
		// 	$data->delete();
			
		// 	dump('delete');

		// }
		$data = EMP_LEV::all();
		return view('organization.employee_leave.list_leave',['data'=>$data]);
	}
    
}
