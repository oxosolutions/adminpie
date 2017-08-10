<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Leave as LV; 
use App\Model\Organization\Category as CAT; 
use App\Model\Organization\Employee as EMP;
use App\Repositories\User\UserRepositoryContract;
use Carbon\Carbon;
use App\Model\Organization\UsersMeta;
use Auth;
use Session;
//use App\Model\Organization\Employee;
class LeavesController extends Controller
{
    protected $user;
    public function __construct(UserRepositoryContract $user)
    {
        $this->user = $user;
    }
	public function index(Request $request , $id = null){
  //  dd(EMP::employees());
        $search = $this->saveSearch($request);
        if($search != false && is_array($search)){
            $request->request->add(['items'=>@$search['items'],'orderby'=>@$search['orderby'],'order'=>@$search['order']]);
        }
        if($id){
            $data = $this->getById($id);
        }else{
          $data = "";
        }
          if($request->has('items')){
            $perPage = $request->items;
            if($perPage == 'all'){
              $perPage = 999999999999999;
            }
          }else{
            $perPage = 5;
          }
          $orgId = Session::get('organization_id');
          $sortedBy = @$request->orderby;
          if($request->has('search')){
              if($sortedBy != ''){
                  $model = LV::with(['employee_info'=>function($query){
                      $query->with('employ_info');
                  },'categories_rel'])->where('reason_of_leave','like','%'.$request->search.'%')->orderBy($sortedBy,$request->order)->paginate($perPage);
              }else{
                  $model = LV::with(['employee_info'=>function($query){
                      $query->with('employ_info');
                  },'categories_rel'])->where('reason_of_leave','like','%'.$request->search.'%')->paginate($perPage);
              }
          }else{
              if($sortedBy != ''){
                  $model = LV::with(['employee_info'=>function($query){
                      $query->with('employ_info');
                  }])
                  ->select([
                              $orgId.'_categories.name as category_name',
                              $orgId.'_leaves.*'

                           ])
                  ->join($orgId.'_categories',$orgId.'_leaves.leave_category_id','=',$orgId.'_categories.id','left')
                  ->orderBy($sortedBy,$request->order)->paginate($perPage);
              }else{
                   $model = LV::with(['employee_info'=>function($query){
                      $query->with('employ_info');
                  },'categories_rel'])->paginate($perPage);
              }
          }
          $datalist =  [
                          'datalist'=>$model,
                          'showColumns' => ['employee_id' => 'Employee Id'  , 'reason_of_leave'=>'Reason of Leave','category_name'=>'Category','from'=>'From','to'=>'To','created_at'=>'Created At','status'=>'Status'],
                          'actions' => [
                                          'edit' => ['title'=>'Edit','route'=>'leaves','class' => 'edit'],
                                          'delete'=>['title'=>'Delete','route'=>'delete.leave'],
                                          'approve_status'=>['title'=>'Approve','class'=>'aione_approved_status','route'=>'approve.leave']
                                       ]
                      ];
          return view('organization.leave.list_leave',$datalist)->with(['data'=>$data]);
    }
  
    public function save(Request $request)
    {
      $valid_fields = [
                          'reason_of_leave'  => 'required',
                          'from'             => 'required',
                          'to'               => 'required'
                      ];
      $this->validate($request , $valid_fields);

        $sh = new LV();
       	$request['from']= $this->date_format($request['from']);
       	$request['to']= $this->date_format($request['to']);
        $sh->fill($request->all());
        $sh->status = 2;
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
                          'from'             => 'required',
                          'to'               => 'required'
                      ];
      $this->validate($request , $valid_fields);

      $updateArray = $request->except('id','_token','from','to','action');
      $updateArray['from']= $this->date_format($request['from']);
      $updateArray['to']= $this->date_format($request['to']);

      $model = LV::where('id',$request->id)->update($updateArray);
      return redirect()->route('leaves');
    }
    public function approve_leave($id)
    { 
        $model = LV::find($id);

        if($model->status == 1){
          LV::where('id',$id)->update(['status'=> 0]);
        }else{
          LV::where('id',$id)->update(['status'=> 1]);
        }
        return back();
    }

    protected function saveSearch($request){
        $search = $request->except(['page']);
        $model = UsersMeta::where(['key'=>$request->route()->uri,'user_id'=>Auth::guard('org')->user()->id])->first();
        if($model != null){
            if(!empty($request->except(['page']))){
              $model->value = json_encode($request->except(['page']));
              $model->save();
            }
            $savedSearch = json_decode($model->value, true);
            return $savedSearch;
        }else{
            $model = new UsersMeta;
            $model->user_id = Auth::guard('org')->user()->id;
            $model->key = $request->route()->uri;
            $model->value = json_encode(@$request->except(['page']));
            $model->save();
            return false;
        }
    }
}