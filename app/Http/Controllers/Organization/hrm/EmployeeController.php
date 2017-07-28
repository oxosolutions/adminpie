<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Employee as EMP;
use App\Model\Organization\Designation As DES;
use App\Model\Organization\Department As DEP;
use App\Model\Organization\Category as CAT;
use App\Repositories\User\UserRepositoryContract;
use App\Model\Organization\User;
use App\Model\Organization\OrganizationSetting as org_setting;
use App\Model\Organization\UsersMeta;
use Session;
use Auth;
class EmployeeController extends Controller
{
    protected $user;
    public function __construct(UserRepositoryContract $user)
    {
        $this->user = $user;

    }
    public function index(Request $request, $id=null)
    {

        dump(test());
        $search = $this->saveSearch($request);
        if($search != false && is_array($search)){
            $request->request->add(['items'=>$search['items'],'orderby'=>@$search['orderby'],'order'=>@$search['order']]);
        }
        $datalist= [];
        $data= [];
        if($request->has('items')){
              $perPage = $request->items;
              if($perPage == 'all'){
                $perPage = 999999999999999;
              }
            }else{
              $perPage = 5;
            }
        $sortedBy = @$request->orderby;
        $orgId = Session::get('organization_id');
        if($request->has('search')){
            if($sortedBy != ''){
                $model = EMP::with(['employ_info'=>function($query) use ($request){
                      $query->with(['metas']);
                },'designations','department_rel'])->join($orgId.'_users as users','users.id','=',$orgId.'_employees.user_id')->where('users.name','like','%'.$request->search.'%')->orWhere($orgId.'_employees.employee_id','like','%'.$request->search.'%')->orderBy($sortedBy,$request->order)->paginate($perPage);
            }else{
                $model = EMP::with(['employ_info'=>function($query) use ($request){
                      $query->with(['metas']);
                },'designations','department_rel'])->whereHas('employ_info', function($query) use ($request){
                    $query->where('name','like','%'.$request->search.'%');
                })->orWhere('employee_id','like','%'.$request->search.'%')->paginate($perPage);
            }
        }else{
            if($sortedBy != ''){
                $model = EMP::with(['employ_info'=>function($query){
                      $query->with(['metas']);
                },'designations','department_rel'])->join($orgId.'_users as users','users.id','=',$orgId.'_employees.user_id')->orderBy($sortedBy,$request->order)->paginate($perPage);
            }else{
                 $model = EMP::with(['employ_info'=>function($query){
                      $query->with(['metas']);
                },'designations','department_rel'])->paginate($perPage);
            }
        }
        // dd($model);
        $datalist =  [
                      'datalist'=>  $model,
                      'showColumns' => ['employee_id'=>'Employee ID','employ_info.name'=>'Name','department_rel.name'=>'Department','designations.name'=>'Designation','employ_info.metas.contact_no'=>'Contact No','employ_info.email'=>'Email ID','created_at'=>'Created At'],
                      'actions' => [
                                      'edit' => ['title'=>'Edit','route'=>['route'=>'account.profile','id'=>'employ_info.id'] , 'class' => 'edit'],
                                      // 'delete'=>['title'=>'Delete','route'=>'delete.employee']
                                   ],
                      'js'  =>  ['custom'=>['list-designation']],
                      'css'=> ['custom'=>['list-designation']]
                    ];
            if(check_route_permisson('hrm/employee/update')==false){
              unset($datalist['actions']['edit']);
            }
            if(check_route_permisson('hrm/employee/delete')==false){
              unset($datalist['actions']['delete']);
            }
      if(!empty($id) || $id != null || $id != ''){
        $data['data'] = EMP::where('id',$id)->first();
      }

    	return view('organization.employee.list',$datalist)->with(['data' => $data]);;
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
        $data = $employee;
        $designation  = DES::where('status',1)->pluck('name','id');
        return view('organization.employee._list_ajax',['data'=>$data,'designation'=>$designation])->render();
    }

    public function save(Request $request)
    {
        $tbl = Session::get('organization_id');
        $valid_fields = [
                            'name'          => 'required',
                            'email'         => 'required|email|unique:'.$tbl.'_users',
                            'password'      => 'required|min:8',
                            'employee_id'   => 'required|min:4|max:256|unique:'.$tbl.'_employees'
                        ];
        $this->validate($request , $valid_fields);
        $request['role_id'] =  setting_val_by_key('employee_role');
        $user_id = $this->user->create($request->all(), 2);
        $emp = new EMP();
        $emp->user_id = $user_id;
        $emp->status = 1;
        $emp->fill($request->all());
        $emp->save();
        return redirect()->route('list.employee');
    }
    function editEmployee()
    {
        
    }
    public function update(Request $request)
    {
        $emp =  EMP::find($request->id);
        if($request['status'] == 'true')
        {
            $request['status'] = 1;
        }
        else if($request['status'] == 'false')
        {
            $request['status'] = 0;
        }
        $changeStatus = EMP::where('id',$request->id)->update(['status'=>$request['status']]);
        
    }
    public function delete($id)
    {
        $model = EMP::where('user_id',$id)->delete();
        if($model){
            return back();
        }
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
