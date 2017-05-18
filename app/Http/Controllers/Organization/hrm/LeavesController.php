<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Leave as LV; 
use App\Model\Organization\Category as CAT; 
use App\Model\Organization\Employee as EMP;
use App\Repositories\User\UserRepositoryContract;

class LeavesController extends Controller
{
    protected $user;
    public function __construct(UserRepositoryContract $user)
    {
        $this->user = $user;
    }
	public function index(){


           // $emp_data =  $this->user->get_user_by_type('[2]');
           // foreach ($emp_data as $key => $value) {
           //     dump($value->employee_rel);
           // }
           // dump($emp_data);
        $employee = $this->user->user_pluck_type('[2]');
        $data = LV::all();
        //EMP::where
        $leave_cat = CAT::where('type','leave')->pluck('name','id');
        return view('organization.leave.list_leave',['data'=>$data , 'leave_cat'=>$leave_cat,'employee'=>$employee]);
    }
  
    public function save(Request $request)
    {
        $sh = new LV();
       	$request['from']= $this->date_format($request['from']);
       	$request['to']= $this->date_format($request['to']);
        $sh->fill($request->all());
        $sh->status = 1;
        $sh->save();
        return redirect()->route('leaves');
    }
 	protected function date_format($parm)
    {
    	 return date('Y-m-d',strtotime($parm));
    }
    public function update(Request $request)
    {
        $sh =  LV::find($request->id);
        if($request['status'] == 'true')
        {
            $request['status'] =1;
        }
        else if($request['status'] == 'false')
        {
            $request['status'] =0;
        }
        	$request['from']	= $this->date_format($request['from']);
       		$request['to']		= $this->date_format($request['to']);
            $sh->fill($request->all());
            $sh->save();
    }
    public function delete($id)
    {

    } 
}