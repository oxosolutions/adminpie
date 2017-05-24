<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Employee as EMP;
use App\Model\Organization\Designation As DES;
use App\Repositories\User\UserRepositoryContract;
use App\Model\Organization\User;

class EmployeeController extends Controller
{
    protected $user;
    public function __construct(UserRepositoryContract $user)
    {
        $this->user = $user;

    }
    public function index()
    {
        $plugins = [
                'js'    =>  ['custom'=>['employees']],
                'css'   =>  ['custom'=>['employee']]
        ];
    	$data = EMP::where('status',1)->get();
        $designation  = DES::where('status',1)->pluck('name','id');
    	return view('organization.employee.list',['plugins'=>$plugins])->with('data',$data)->with( 'designation',$designation);
    }

    public function getEmployeeList(Request $request){
        if($request->has('order')){
            $order = $request->order;
        }else{
            $order = 'desc';
        }

        $employee = EMP::with(['employ_info','designations'])->whereHas('employ_info', function($model) use ($request, $order){
            if($request->has('q') && $request->q != 'undefined'){
                $model->Where('name','like','%'.$request->q.'%');
            }
            $model->orderBy('name',$order);
        })->orWhere(function($subQuery) use ($request, $order){
            $subQuery->whereHas('designations', function($query) use ($request, $order) {
                if($request->has('q') && $request->q != 'undefined'){
                    $query->Where('name','like','%'.$request->q.'%');
                }
                $query->orderBy('name',$order);
            });
        })->get();
        // dd($employee);
        $data = $employee;
        $designation  = DES::where('status',1)->pluck('name','id');
        return view('organization.employee._list_ajax',['data'=>$data,'designation'=>$designation])->render();
    }

    public function save(Request $request)
    {
        $user_id = $this->user->create($request->all(), 2);
        $emp = new EMP();
        $emp->user_id = $user_id;
        $emp->status = 1;
        $emp->fill($request->all());
        $emp->save();
        return redirect()->route('list.employee');
    }
    
    public function update(Request $request)
    {
        $emp =  EMP::find($request->id);
        if($request['status'] == 'true')
        {
            $request['status'] =1;
        }
        else if($request['status'] == 'false')
        {
            $request['status'] =0;
        }
        $emp->status = $request['status']; 
        $emp->save();
    }
    public function delete($id)
    {

    } 

    public function updateEmployeeName(Request $request){
        try{
            $userModel = User::find($request->id);
            $userModel->name = $request->value;
            $userModel->save();
            return $request->value;
        }catch(\Exception $e){
            throw $e;
        }
    }

    public function getDesignationList(){

        try{
            $model = DES::orderBy('id')->pluck('name','id')->toArray();
            return json_encode($model);
        }catch(\Exception $e){
            throw $e;
        }
    }

    public function updateUserDesignation(Request $request){

        try{
            $model = EMP::where('user_id',$request->id)->first();
            $model->designation = $request->value;
            $model->save();
            $modelDes = DES::find($request->value);
            return $modelDes->name;
        }catch(\Exception $e){  
            throw $e;
        }
    }
}
