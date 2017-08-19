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
use Excel;
use Crypt;
use Config;
use App\Model\Organization\OrganizationSetting;
use Datatables;
class EmployeeController extends Controller
{
    protected $user;
    public function __construct(UserRepositoryContract $user)
    {
        $this->user = $user;

    }
    public function index(Request $request, $id=null)
    {
        $search = $this->saveSearch($request);
        if($search != false && is_array($search)){
            $request->request->add(['items'=>@$search['items'],'orderby'=>@$search['orderby'],'order'=>@$search['order']]);
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
        /*$sortedBy = @$request->orderby;
        $orgId = Session::get('organization_id');
        $datalist['datalist'] = [];
        $model = [];
        if($request->has('search')){
            if($sortedBy != ''){
                try{
                    $model = EMP::with(['employ_info'=>function($query) use ($request){
                          $query->with(['metas']);
                    },'designations'=>function($query){
                        $query->select(['name as designation_name','id']);
                    },'department_rel'=>function($query){
                        $query->select(['name as department_name','id']);
                    }])
                    ->select(
                                [
                                    'users.created_at as crt',
                                    'users.name',
                                    $orgId.'_employees.*',
                                    $orgId.'_designations.name as designation_name',
                                    $orgId.'_designations.id',
                                    $orgId.'_departments.name as department_name',
                                ]
                            )
                    ->join($orgId.'_designations',$orgId.'_designations.id','=',$orgId.'_employees.designation','left')
                    ->join($orgId.'_departments',$orgId.'_departments.id','=',$orgId.'_employees.department','left')
                    ->join($orgId.'_users as users','users.id','=',$orgId.'_employees.user_id')
                    ->where('users.name','like','%'.$request->search.'%')
                    ->orWhere($orgId.'_employees.employee_id','like','%'.$request->search.'%')
                    ->orderBy($sortedBy,$request->order)
                    ->paginate($perPage);
                }catch(\Exception $e){
                    //throw $e;
                }
                
            }else{
                $model = EMP::with(['employ_info'=>function($query) use ($request){
                      $query->with(['metas']);
                },'designations','department_rel'])->whereHas('employ_info', function($query) use ($request){
                    $query->where('name','like','%'.$request->search.'%');
                })->orWhere('employee_id','like','%'.$request->search.'%')->paginate($perPage);
            }
        }else{
            if($sortedBy != ''){
                try{
                    $model = EMP::with(['employ_info'=>function($query){
                          $query->with(['metas']);
                    },'designations'=>function($query){
                        $query->select(['name as designation_name','id']);
                    },'department_rel'=>function($query){
                        $query->select(['name as department_name','id']);
                    }])
                    ->select(
                                [
                                    'users.created_at as crt',
                                    'users.name',
                                    $orgId.'_employees.*',
                                    $orgId.'_designations.name as designation_name',
                                    $orgId.'_designations.id',
                                    $orgId.'_departments.name as department_name',
                                ]
                            )
                    ->join($orgId.'_designations',$orgId.'_designations.id','=',$orgId.'_employees.designation','left')
                    ->join($orgId.'_departments',$orgId.'_departments.id','=',$orgId.'_employees.department','left')
                    ->join($orgId.'_users as users','users.id','=',$orgId.'_employees.user_id')
                    ->orderBy($sortedBy,$request->order)
                    ->paginate($perPage);
                }catch(\Exception $e){
                    //throw $e;
                }
                
            }else{
                 $model = EMP::with(['employ_info'=>function($query){
                          $query->with(['metas']);
                    },'designations'=>function($query){
                        $query->select(['name as designation_name','id']);
                    },'department_rel'=>function($query){
                        $query->select(['name as department_name','id']);
                    }])
                    ->select(
                                [
                                    'users.created_at as crt',
                                    'users.name',
                                    $orgId.'_employees.*',
                                    $orgId.'_designations.name as designation_name',
                                    $orgId.'_designations.id',
                                    $orgId.'_departments.name as department_name',
                                ]
                            )
                    ->join($orgId.'_designations',$orgId.'_designations.id','=',$orgId.'_employees.designation','left')
                    ->join($orgId.'_departments',$orgId.'_departments.id','=',$orgId.'_employees.department','left')
                    ->join($orgId.'_users as users','users.id','=',$orgId.'_employees.user_id')
                    ->paginate($perPage);
            }
        }*/
        $employe_id = '';
        $department_name = '';
        $designation_name = '';
        $sortedBy = @$request->orderby;

        $model = $this->getQueryResult($request,$sortedBy,$perPage);

        foreach ($model as $key => $record) {
            $model[$key]['department'] = '';
            $model[$key]['designation'] = '';
            $model[$key]['employee_id'] = '';
            foreach($record['metas'] as $metaKey => $metaValue){
                if($metaValue['key'] == 'department'){
                    $department = DEP::find($metaValue['value'])->name;
                    $model[$key]['department'] = $department;
                }
                if($metaValue['key'] == 'designation'){
                    $designation = DES::find($metaValue['value']);
                    if($designation != null){
                        $model[$key]['designation'] = $designation->name;
                    }else{
                        $model[$key]['designation'] = '';
                    }
                }
                if($metaValue['key'] == 'employee_id'){
                    $model[$key]['employee_id'] = $metaValue['value'];
                }
            }
        }
        $datalist =  [
                      'datalist'=>  $model,
                      'showColumns' => ['employee_id'=>'Employee ID','name'=>'Name','department'=>'Department','designation'=>'Designation','email'=>'Email ID','created_at'=>'Created At','status'=>'Status'],
                      'actions' => [
                                      'edit' => ['title'=>'Edit','route'=>['route'=>'account.profile','id'] , 'class' => 'edit'],
                                      'delete'=>['title'=>'Delete','route'=>['route'=>'delete.employee','id'=>'id'] , 'class' => 'delete']
                                   ],
                      'js'  =>  ['custom'=>['list-designation']],
                      'css'=> ['custom'=>['list-designation']]
                    ];
            // if(check_route_permisson('hrm/employee/update')==false){
            //   unset($datalist['actions']['edit']);
            // }
            // if(check_route_permisson('hrm/employee/delete')==false){
            //   unset($datalist['actions']['delete']);
            // }
      if(!empty($id) || $id != null || $id != ''){
        $data['data'] = EMP::where('id',$id)->first();
      }
        return view('organization.employee.list',$datalist)->with(['data' => $data]);
    }

    protected function getQueryResult($request, $sortedBy, $items){
        if($request->has('search')){
            if($sortedBy != ''){
                $model = User::with(['metas'])->where(['user_type'=>'employee'])->paginate($items);
            }else{
                $model = User::with(['metas'])->where(['user_type'=>'employee'])->paginate($items);
            }
        }else{
            if($sortedBy != ''){
                $model = User::with(['metas'])->where(['user_type'=>'employee'])->paginate($items);
            }else{
                $model = User::with(['metas'])->where(['user_type'=>'employee'])->paginate($items);
            }
        }
        return $model;
    }

    public function employeeListDatatable(){
        // Get employee list on the behalf of role
        /*$model = User::with(['metas','user_role_rel'])->whereHas('user_role_rel', function($query){
            $query->with(['roles'])->whereHas('roles', function($query){
                $query->where('slug','employee');
            });
        })->get();*/
        $model = User::with(['metas'])->where(['user_type'=>'employee'])->get();

        return Datatables::of($model)
        ->addColumn('user', function($model){
            return get_profile_picture($model->id,null,true);
        })
        ->addColumn('department', function($model){
            $department = $model->metas->where('key','department')->first();
            if($department != null){
                $department = DEP::find($department->value);
                if($department != null){
                    return $department->name;
                }else{
                    return '';
                }
            }else{
                return '';
            }
        })
        ->addColumn('designation', function($model){
            $designation = $model->metas->where('key','designation')->first();
            if($designation != null){
                $designation = DES::find($designation->value);
                if($designation != null){
                    return $designation->name;
                }else{
                    return '';
                }
            }else{
                return '';
            }
        })
        ->addColumn('employee_id', function($model){
            $employeeId = $model->metas->where('key','employee_id')->first();
            if($employeeId != null){
                return $employeeId->value;
            }else{
                return '';
            }
        })
        ->editColumn('status', function($model){
            return view('organization.employee.status',['model'=>$model])->render();
        })
        ->editColumn('created_at', function($model){
            return $model->created_at->diffForHumans();
        })
        ->editColumn('name', function($model){
            return view('organization.employee.actions',['model'=>$model])->render();
        })
        ->rawColumns(['status','name','user'])
        ->make(true);
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
        $request['joining_date'] = date("Y-m-d");
        $model = OrganizationSetting::where('key' , 'employee_role')->first();

        if(count($model) > 0){
            $employee_id = $model->value;
        }else{
            $employee_id = 2;
        }

        $tbl = Session::get('organization_id');
        $valid_fields = [
                            'name'          => 'required',
                            'email'         => 'required|email|unique:'.$tbl.'_users',
                            'password'      => 'required|min:8',
                            'employee_id'   => 'required|min:4|max:256'
                        ];
        $this->validate($request , $valid_fields);
        $request['role_id'] =  setting_val_by_key('employee_role');
        $user_id = $this->user->create($request->all(), $employee_id, 'employee');
        foreach($request->all() as $key => $value){
            if(in_array($key,['designation','department','shift','employee_id'])){
                $userMeta = new UsersMeta;
                $userMeta->user_id = $user_id;
                $userMeta->key = $key;
                $userMeta->value = $value;
                $userMeta->save();
            }
        }
        /*$emp = new EMP();
        $emp->user_id = $user_id;
        $emp->status = 1;
        $emp->fill($request->all());
        $emp->save();*/

        /*$shifts_insert = new UsersMeta;
        $shifts_insert['user_id']   =  $emp->id;
        $shifts_insert['key']       = 'shift';
        $shifts_insert['value']     = $request->shift;
        $shifts_insert->save();*/
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
            $model = User::where('id',$id)->delete();
            $model_meta = UsersMeta::where('user_id',$id)->delete();
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

    public function export(){

        /*$model = EMP::with(['designation_rel','department_rel','employ_info'=>function($query){
            $query->with('metas');
        }])->get();*/
        $model = User::with(['metas'])->where(['user_type'=>'employee'])->get();
       $headers = array(
                    'User.name',
                    'User.email',
                    'User.password',
                    /*'Employee.id',
                    'Employee.user_id',
                    'Employee.employee_id',
                    'Employee.designation',
                    'Employee.department',
                    'Employee.marital_status',
                    'Employee.experience',
                    'Employee.blood_group',
                    'Employee.joining_date',
                    'Employee.disability_percentage'*/
        );
       $employeeDataArray = [];
       foreach ($model as $key => $employe) {
            $singleEmployeeArray = [];
            $singleEmployeeArray[] = @$employe->name;
            $singleEmployeeArray[] = @$employe->email;
            $singleEmployeeArray[] = @$employe->password;
            /*$singleEmployeeArray[] = @$employe->id;
            $singleEmployeeArray[] = @$employe->user_id;
            $singleEmployeeArray[] = @$employe->employee_id;
            $singleEmployeeArray[] = @$employe->designation_rel->name;
            $singleEmployeeArray[] = @$employe->department_rel->name;
            $singleEmployeeArray[] = @$employe->marital_status;
            $singleEmployeeArray[] = @$employe->experience;
            $singleEmployeeArray[] = @$employe->blood_group;
            $singleEmployeeArray[] = @$employe->joining_date;
            $singleEmployeeArray[] = @$employe->disability_percentage;*/
            foreach($employe->metas as $k => $meta){
                if(!in_array('UsersMeta.'.$meta->key, $headers)){
                    $headers[] = 'UsersMeta.'.$meta->key;
                }
                $singleEmployeeArray[] = $meta->value;
            }
            $employeeDataArray[] = $singleEmployeeArray;
       }

       $data[] = $headers;
       foreach ($employeeDataArray as $key => $value) {
            $data[] = $value;
       }
       Excel::create('Employees-List-'.date('Y-m-d H i s'), function($excel) use($data) {
            $excel->sheet('Employees List', function($sheet) use($data) {
                $sheet->fromArray($data,null,'A1',false,false);
                $sheet->row(1, function($row){
                    $row->setFontWeight('bold');
                });
            });
       })->export('xls');
        
    }

    public function importEmployee(Request $request){
        if($request->hasFile('import_employee')){
            $organizationId = Session::get('organization_id');
            $filename = date('YmdHis').'_employee_list.'.$request->file('import_employee')->getClientOriginalExtension();
            $path = env('USER_FILES_PATH').'_'.$organizationId.'/hrm_employee_import_files';
            $request->file('import_employee')->move($path,$filename);
            $sheetCount = 0;
            $data = Excel::load($path.'/'.$filename, function($reader) use (&$sheetCount){ 
                $sheetCount = $reader->getSheetCount();
            })->get();
            $recordsArray = null;
            $rowId = 2;
            $errors = [];
            foreach($data as $key => $record){
                foreach($record as $columnHeader => $columnValue){
                    $explodedHeader = explode('.',$columnHeader);
                    $recordsArray[$explodedHeader[0]][$explodedHeader[1]] = $columnValue;
                }
                $userid = '';
                foreach($recordsArray as $model => $columns){
                    switch($model){
                        case 'user':
                            $alreadyExists = User::where(['email'=>$columns['email']])->first();
                            if($alreadyExists == null){
                                $userModel = new User;
                                $userModel->fill($columns);
                                $userModel->status = 1;
                                $userModel->save();
                                $userid = $userModel->id;
                            }else{
                                $errors[] = ['rowid'=>$rowId,'error'=>'Email id already exists'];
                            }
                        break;

                        case'employee':
                            if($userid != '' && $userid != 0){
                                $model = EMP::firstOrNew(['employee_id'=>$columns['employee_id']]);
                                $model->user_id = $userid;
                                $model->employee_id = $columns['employee_id'];
                                if($columns['designation'] != null && $columns['designation'] != ''){
                                    $designation = DES::where('name','like','%'.$columns['designation'].'%')->first();
                                    if($designation != null){
                                        $model->designation = $designation->id;
                                    }else{
                                        $model->designation = $columns['designation'];
                                    }
                                }else{
                                    $model->designation = null;
                                }
                                if($columns['department'] != null && $columns['department'] != ''){
                                    $department = DEP::where('name','like','%'.$columns['department'].'%')->first();
                                    if($department != null){
                                        $model->department = $department->id;
                                    }else{
                                        $model->department = $columns['department'];
                                    }
                                }else{
                                    $model->department = null;
                                }
                                unset($columns['id']);
                                unset($columns['user_id']);
                                unset($columns['employee_id']);
                                unset($columns['designation']);
                                unset($columns['department']);
                                $model->fill($columns);
                                $model->save();
                            }
                        break;
                        case'usersmeta':
                            if($userid != '' && $userid != 0){
                                foreach($columns as $key => $keyValue){
                                    $model = new UsersMeta;
                                    $model->key = $key;
                                    $model->value = $keyValue;
                                    $model->type = 'employee';
                                    $model->user_id = $userid;
                                    $model->save();
                                }
                            }
                        break;
                    }
                }
                $rowId++;
            }
            Session::flash('errors',$errors);
        }
        return redirect()->route('import.employee');
    }
    
    public function import()
    {
        // dd(get_meta('Organization\\UsersMeta',2,'contact_no','user_id',true));
        // dd(get_user_meta(2,'contact_no',true));
        // dd(get_user(true,true));
        dd(get_current_user_meta('contact_no',true));
        return view('organization.employee.import-employees');
    }
 
}
