<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Leave as LV; 
use App\Model\Organization\Category as CAT; 
use App\Model\Organization\Employee as EMP;
use App\Repositories\User\UserRepositoryContract;
use Carbon\Carbon;

class LeavesController extends Controller
{
    protected $user;
    public function __construct(UserRepositoryContract $user)
    {
        $this->user = $user;
    }
	public function index(Request $request , $id = null){

        if($id){
            $data = $this->getById($id);
        }else{
          $data = "";
        }
           // $emp_data =  $this->user->get_user_by_type('[2]');
           // foreach ($emp_data as $key => $value) {
           //     dump($value->employee_rel);
           // }
           // dump($emp_data);
        /*$employee = $this->user->user_pluck_type('[2]');
        $data = LV::all();
        //EMP::where
        $leave_cat = CAT::where('type','leave')->pluck('name','id');
        return view('organization.leave.list_leave',['data'=>$data , 'leave_cat'=>$leave_cat,'employee'=>$employee]);*/
          if($request->has('per_page')){
            $perPage = $request->per_page;
            if($perPage == 'all'){
              $perPage = 999999999999999;
            }
          }else{
            $perPage = 5;
          }
          $sortedBy = @$request->sort_by;
          if($request->has('search')){
              if($sortedBy != ''){
                  $model = LV::where('reason_of_leave','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                  $model = LV::where('reason_of_leave','like','%'.$request->search.'%')->paginate($perPage);
              }
          }else{
              if($sortedBy != ''){
                  $model = LV::orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                   $model = LV::paginate($perPage);
              }
          }
          $datalist =  [
                          'datalist'=>$model,
                          'showColumns' => ['reason_of_leave'=>'Reason of Leave','from'=>'From','to'=>'To','created_at'=>'Created At','id'=>'ID','updated_at'=>'Updated At'],
                          'actions' => [
                                          'edit' => ['title'=>'Edit','route'=>'leaves','class' => 'edit'],
                                          'delete'=>['title'=>'Delete','route'=>'delete.leave']
                                       ]
                      ];
          return view('organization.leave.list_leave',$datalist)->with(['data'=>$data]);
    }
  
    public function save(Request $request)
    {
      $valid_fields = [
                          'reason_of_leave'  => 'required',
                          'from'             => 'required',
                          'to'               => 'required'
                      ];
      $this->validate($request , $valid_fields);

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
      $model = LV::find($id)->delete();
      if($model){
        return back();
      }
    } 
    public function getById($id)
    {
      $model = LV::where('id',$id)->get();
     $parsedate = Carbon::parse($model[0]->from);
     $model[0]->form = $parsedate->format('d M,Y');
      return $model;
    }
    public function editLeave(Request $request)
    {
      $valid_fields = [
                          'reason_of_leave'  => 'required',
                          'from'             => 'required',
                          'to'               => 'required'
                      ];
      $this->validate($request , $valid_fields);

      $updateArray = $request->except('id','_token','from','to');
      $updateArray['from']= $this->date_format($request['from']);
      $updateArray['to']= $this->date_format($request['to']);

      $model = LV::where('id',$request->id)->update($updateArray);
      return redirect()->route('leaves');
    }
}