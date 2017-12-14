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
use App\Model\Organization\UsersRole;
use App\Model\Organization\UserRoleMapping;
use App\Model\Organization\OrganizationSetting as org_setting;
use App\Model\Organization\UsersMeta;
use Session;
use Auth;
use Excel;
use Crypt;
use Config;
use App\Model\Organization\OrganizationSetting;
use Datatables;
use App\Model\Group\GroupUsers;
use Hash;
use DB;
use App\Model\Organization\Shift;
use App\Model\Organization\Payscale;
/**
 * work by paljinder singh
 * @Import emplyoyee
 */
class EmployeeController extends Controller
{
    protected $user;
    public function __construct(UserRepositoryContract $user)
    {

        $this->user = $user;

    }
    public function index(Request $request, $id=null)
    {
        //
        //  $lists = GroupUsers::with('organization_user')->has('organization_user')->get();
        // dd($lists->toArray());

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
              $perPage = get_items_per_page();;
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
       

        // foreach ($model as $key => $record) {
        //     dump($record['belong_group']['email']);
        //     $model[$key]['department'] = '';
        //     $model[$key]['designation'] = '';
        //     $model[$key]['employee_id'] = '';
        //     $model[$key]['email'] = $record['belong_group']['email'];
        //     $model[$key]['name'] =  $record['belong_group']['name'];
            

               // $model[$key] = collect($record['metas'])->mapWithKeys(function($item){

               //  return [$item['key']= $item['value'] ];
               //  });

            // dump($model);



            // foreach($record['metas'] as $metaKey => $metaValue){
            //     if($metaValue['key'] == 'department'){
            //         $department = DEP::find($metaValue['value']);
            //         if(!empty($department)){
            //           $model[$key]['department'] =     $department->name;
            //         }
            //     }
            //     if($metaValue['key'] == 'designation'){
            //         $designation = DES::find($metaValue['value']);
            //         if($designation != null){
            //             $model[$key]['designation'] = $designation->name;
            //         }else{
            //             $model[$key]['designation'] = '';
            //         }
            //     }
            //     if($metaValue['key'] == 'employee_id'){
            //         $model[$key]['employee_id'] = $metaValue['value'];
            //     }
            // }

        // }


           
        $datalist =  [
                      'datalist'=>  $model,
                      'showColumns' => ['employee_id'=>'Employee ID','name'=>'Name','department'=>'Department','designation'=>'Designation','email'=>'Email ID','created_at'=>'Created','status'=>'Status'],
                      'actions' => [
                                      'edit' => ['title'=>'Edit','route'=>['route'=>'account.profile','id'] , 'class' => 'edit'],
                                      'delete'=>['title'=>'Delete','route'=>['route'=>'delete.employee','id'=>'id'] , 'class' => 'delete confirm-delete']
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
       // dd($model);
        return view('organization.employee.list',$datalist)->with(['data' => $data]);
    }

    protected function getQueryResult($request, $sortedBy, $items){

        // if($request->has('search')){
        //     if($sortedBy != ''){
        //         $model = User::with(['metas'])->where(['user_type'=>'employee'])->paginate($items);
        //     }else{
        //         $model = User::with(['metas'])->where(['user_type'=>'employee'])->paginate($items);
        //     }
        // }else{
        //     if($sortedBy != ''){
        //         $model = User::with(['metas'])->where(['user_type'=>'employee'])->paginate($items);
        //     }else{
        //         $model = User::with(['metas'])->where(['user_type'=>'employee'])->paginate($items);
        //     }
        // }
        $model = User::with(['belong_group','metas'])->where(['user_type'=>'employee'])->paginate($items);
        return $model;
    }
 

    
    public function employeeListDatatable(){
        // Get employee list on the behalf of role
        /*$model = User::with(['metas','user_role_rel'])->whereHas('user_role_rel', function($query){
            $query->with(['roles'])->whereHas('roles', function($query){
                $query->where('slug','employee');
            });
        })->get();*/
        $model = User::with(['belong_group','metas'])->where(['user_type'=>'employee'])->get();//->toArray();

        // dd($model->toArray());
        foreach($model as $key => $val){
            if(!empty($val['belong_group'])){
                $model[$key]->name    =    $val->belong_group->name;
                $model[$key]->email   =    $val->belong_group->email;
                
            }else{
                 $model[$key]->name    =    "";
                $model[$key]->email   =    '';//$val->belong_group->email;
            }
            // unset($model[$key]['belong_group']);
        }

        // $new =   json_decode($model, true);
        // $maps = array_map(function('mapp', $new);


//         $csmap_data = array_map(function($arr){
//     return $arr + ['flag' => 1];
// }, $csmap_data);

       // $new = $model->map(function ($item, $key) {
       //      return $item + ['name'=>123];
       //  });
        // $model = collect($model);

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
    /**
     * [save Add new employee]
     * author work by Paljinder singh
     * @param  Request $request [description]
     * @return [redirect to employee list]           [description]
     */
    public function save(Request $request)
    {
        if(empty(setting_val_by_key('employee_role'))){
            Session::flash('error','Need to set Role Id for employee in setting.');
            return back();
        }

        $request['date_of_joining'] = date("Y-m-d");
        $tbl = Session::get('group_id');
        $valid_fields = [
                            'name'          =>  'required',
                            'email'         =>  'required|email|unique:group_'.$tbl.'_users',
                            'password'      =>  'required|min:8',
                            'employee_id'   =>  'required|min:4|regex:/^[a-z0-9-]+$/|max:256',
                            'user_shift'    =>  'required',
                            'designation'   =>  'required',
                            'department'    =>  'required',
                            'employee_id'   =>  'required'
                        ];
        $this->validate($request , $valid_fields);
        $manadatory_field = ['designation','department','user_shift','employee_id']; 
        if(count(array_intersect(array_keys($request->all()) , $manadatory_field))== count($manadatory_field)){
            $user =  new GroupUsers();
            $user->fill($request->except('password'));
            $user->password =  Hash::make($request['password']);
            $user->app_password =  $request['password'];
            $user->status = 1;
            $user->save();
            $user_id = $user->id;

            $userTable = new User();
            $userTable->user_id = $user_id;
            $userTable->user_type = 'employee';
            $userTable->save();
            $u_id = $userTable->id;

            $assign_role = new UserRoleMapping();
            $assign_role->user_id = $u_id;
            $assign_role->role_id = setting_val_by_key('employee_role');
            $assign_role->status = 1;
            $assign_role->save();

            foreach($request->all() as $key => $value){
                if(in_array($key,['designation','department','user_shift','employee_id','date_of_joining'])){
                    $userMeta = new UsersMeta;
                    $userMeta->user_id = $u_id;
                    $userMeta->key = $key;
                    $userMeta->value = $value;
                    $userMeta->save();
                }
            }
        }else{
            Session::flash('error','Need to fill all fields.');
            return back();
        }

       
         return redirect()->route('list.employee');


        // Hash::make($data['password']);
        dd($request->all());

        // $request['role_id'] =  setting_val_by_key('employee_role');
        // $user_id = $this->user->create($request->all(), $employee_id, 'employee');
        // foreach($request->all() as $key => $value){
        //     if(in_array($key,['designation','department','shift','employee_id'])){
        //         $userMeta = new UsersMeta;
        //         $userMeta->user_id = $user_id;
        //         $userMeta->key = $key;
        //         $userMeta->value = $value;
        //         $userMeta->save();
        //     }
        // }
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
       
    }

    // public function save(Request $request)
    // {
    //     $request['joining_date'] = date("Y-m-d");
    //     $model = OrganizationSetting::where('key' , 'employee_role')->first();

    //     if(count($model) > 0){
    //         $employee_id = $model->value;
    //     }else{
    //         $employee_id = 2;
    //     }

    //     $tbl = Session::get('organization_id');
    //     $valid_fields = [
    //                         'name'          => 'required',
    //                         'email'         => 'required|email|unique:'.$tbl.'_users',
    //                         'password'      => 'required|min:8',
    //                         'employee_id'   => 'required|min:4|regex:/^[a-z0-9-]+$/|max:256'
    //                     ];
    //     $this->validate($request , $valid_fields);
    //     $request['role_id'] =  setting_val_by_key('employee_role');
    //     $user_id = $this->user->create($request->all(), $employee_id, 'employee');
    //     foreach($request->all() as $key => $value){
    //         if(in_array($key,['designation','department','shift','employee_id'])){
    //             $userMeta = new UsersMeta;
    //             $userMeta->user_id = $user_id;
    //             $userMeta->key = $key;
    //             $userMeta->value = $value;
    //             $userMeta->save();
    //         }
    //     }
    //     /*$emp = new EMP();
    //     $emp->user_id = $user_id;
    //     $emp->status = 1;
    //     $emp->fill($request->all());
    //     $emp->save();*/

    //     /*$shifts_insert = new UsersMeta;
    //     $shifts_insert['user_id']   =  $emp->id;
    //     $shifts_insert['key']       = 'shift';
    //     $shifts_insert['value']     = $request->shift;
    //     $shifts_insert->save();*/
    //     return redirect()->route('list.employee');
    // }
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
        // dd($id);
        try{
            DB::beginTransaction();
            $user =  User::find($id);
            if(empty($user)){
                 return back();
            }
            $user_id = $user->user_id;
            $model_meta = User::where('id',$id)->delete();
            $model_meta = UsersMeta::where('user_id',$id)->delete();
            
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
            
            // throw $e;
        }
        return back();
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

       $user = User::select(['id','user_id'])->where('user_type','employee')->get();
       // dd($user->toArray());

        /*$model = EMP::with(['designation_rel','department_rel','employ_info'=>function($query){
            $query->with('metas');
        }])->get();*/
        // .roles:id,name', 'belong_group:id,name,email,password',
        $meta_key = ['employee_id', 'designation', 'department', 'user_shift', 'pay_scale', 'date_of_joining' ];
        $model = User::select(['id','user_id'])->with(['belong_group', 'user_role_rel'=>function($query){
            $query->select('id','user_id','role_id')->with('roles:id,name');
            },
             'metas'=>function($q)use($meta_key){
            $q->select(['user_id','key', 'value'])->whereIn('key', $meta_key);
        }])->where(['user_type'=>'employee'])->get();
        $arrays = $model->toArray();
        // dd($arrays[0]);
        foreach ($arrays as $key => $value) {
            $data[$key]['name'] =   $value['belong_group']['name'];
            $data[$key]['email'] =   $value['belong_group']['email'];
            $data[$key]['password'] =   $value['belong_group']['password'];
           $metas =  array_column($value['metas'], 'value','key');
           if(!empty($metas)){
            foreach($meta_key as $meta_keys){
                if(isset($metas[$meta_keys])){
                    if($meta_keys=='designation'){
                        $des =     DES::where('id', $metas[$meta_keys]);
                        if($des->exists()){
                            $data[$key][$meta_keys] = $des->first()->name;
                        }else{
                            $data[$key][$meta_keys] = "";
                        }
                    }elseif($meta_keys=='department')
                    {
                        $dep = DEP::where('id',$metas[$meta_keys]);
                        if($dep->exists()){
                            $data[$key][$meta_keys] = $dep->first()->name;
                        }else{
                            $data[$key][$meta_keys] ="";
                        }
                    }elseif($meta_keys=='user_shift'){
                        $data[$key][$meta_keys] = "";
                        if(!empty($metas[$meta_keys])){
                           $shift_data = Shift::where('id',$metas[$meta_keys]);
                           if($shift_data->exists()){
                            $data[$key][$meta_keys] = $shift_data->first()->name;
                           }
                        }
                    }elseif($meta_keys =='pay_scale'){
                           $data[$key][$meta_keys] = ""; 
                        if(!empty($metas[$meta_keys])){
                           $payscale_data = Payscale::where('id',$metas[$meta_keys]);
                           if($payscale_data->exists()){
                            $data[$key][$meta_keys] = $payscale_data->first()->title;
                           }
                        }
                    }
                    else{
                        $data[$key][$meta_keys] = $metas[$meta_keys];
                    }
                }else{
                    $data[$key][$meta_keys] = "";
                }
            }
            // foreach ($metas as $nextkey => $nextvalue) {

            //     $data[$key][$nextkey] = $nextvalue;
            // }
           }
            if(!empty($value['user_role_rel']) ){
                $data[$key]['role']= implode(',',array_column(array_column($value['user_role_rel'], 'roles'),'name'));
            }else{
               $data[$key]['role'] = ""; 
            }
           
            // array_push($data[$key] , );
        }

         // dd($data);

       //  $map = $model->mapWithKeys(function($item){
       //      $ary = json_decode($item, true);
       //      $meta = $ary['metas'];
       //      unset($ary['metas']);

       //      $final = array_column($meta, 'value','key');
       //      $final['name'] = $item['belong_group']['name'];
       //      $final['email'] = $item['belong_group']['email'];
       //      $final['password'] = $item['belong_group']['password'];
       //      return [ $item['id']=>$final];
       //  });
       //  $data = $map->toArray();
        
       //  // array_push($meta_key, 'name','email','password');
       //  
       // $key = array_keys($data[0]);

       Excel::create('Employees-List-'.date('Y-m-d H i s'), function($excel) use($data) {
            $excel->sheet('Employees List', function($sheet) use($data) {
                $sheet->fromArray($data);
                $sheet->row(1, array_keys($data[0]));
                $sheet->row(1, function($row){
                    $row->setFontWeight('bold');
                });
            });
       })->export('csv');

        // $sheet->row(1, function($row){
        //             $row->setFontWeight('bold');
        //         });
        // dump($map->toArray());

        // $data = $model->toArray();

        // array_map($data, function())  


        // dump($model->toArray());
       // $headers = array(
       //              'User.name',
       //              'User.email',
       //              'User.password',
       //              /*'Employee.id',
       //              'Employee.user_id',
       //              'Employee.employee_id',
       //              'Employee.designation',
       //              'Employee.department',
       //              'Employee.marital_status',
       //              'Employee.experience',
       //              'Employee.blood_group',
       //              'Employee.joining_date',
       //              'Employee.disability_percentage'*/
       //  );
       // $employeeDataArray = [];
       // foreach ($model as $key => $employe) {
       //      $singleEmployeeArray = [];
       //      $singleEmployeeArray[] = @$employe->belong_group->name;
       //      $singleEmployeeArray[] = @$employe->belong_group->email;
       //      $singleEmployeeArray[] = @$employe->belong_group->password;
       //      $singleEmployeeArray[] = @$employe->id;
       //      $singleEmployeeArray[] = @$employe->user_id;
       //      $singleEmployeeArray[] = @$employe->employee_id;
       //      $singleEmployeeArray[] = @$employe->designation_rel->name;
       //      $singleEmployeeArray[] = @$employe->department_rel->name;
       //      $singleEmployeeArray[] = @$employe->marital_status;
       //      $singleEmployeeArray[] = @$employe->experience;
       //      $singleEmployeeArray[] = @$employe->blood_group;
       //      $singleEmployeeArray[] = @$employe->joining_date;
       //      $singleEmployeeArray[] = @$employe->disability_percentage;
       //      foreach($employe->metas as $k => $meta){
       //          if(!in_array('UsersMeta.'.$meta->key, $headers)){
       //              $headers[] = 'UsersMeta.'.$meta->key;
       //          }
       //          $singleEmployeeArray[] = $meta->value;
       //      }
       //      $employeeDataArray[] = $singleEmployeeArray;
       // }
       //      dump($employeeDataArray);

       // $data[] = $headers;
       // foreach ($employeeDataArray as $key => $value) {
       //      $data[] = $value;
       // }
        
    }

    protected function check_employee_id($employee_id){
        $emp_id_check  = UsersMeta::where(['key'=>'employee_id', 'value'=> $employee_id]);
        if($emp_id_check->exists()){
              return true;  
        }
        return false;
    }

    public function importEmployee(Request $request){
        $index = 1;
       $emptyRow = $newInsertAlreadyEmployeeId = $alreadyInGroupNotOrg = $update_password = $newRecord = $updateRecord = $alreadyInGroup = [];
        if($request->hasFile('import_employee')){
            $organizationId = Session::get('organization_id');
            $filename = date('YmdHis').'_employee_list.'.$request->file('import_employee')->getClientOriginalExtension();
            $path = env('USER_FILES_PATH').'_'.$organizationId.'/hrm_employee_import_files';
            $request->file('import_employee')->move($path,$filename);
            $sheetCount = 0;
            $data = Excel::load($path.'/'.$filename, function($reader) use (&$sheetCount){ 
                $sheetCount = $reader->getSheetCount();
            })->get();
            $import_record_options = $request['import_record_options'];
           foreach ($data->toArray() as $key => $value) {
            $index++;
            if(!empty($value['name']) && !empty($value['email']) && !empty($value['password']) && !empty($value['employee_id'])){
                $alreadyExists = GroupUsers::where(['email'=>$value['email']]); 
                if($alreadyExists->exists()){
                    $users_data = $alreadyExists->first();
                    $user_id = $users_data->id;
                    $org_user_check = User::where('user_id', $user_id);
                    if(!$org_user_check->exists()){
                        if( $import_record_options == 'new_insert' && $this->check_employee_id($value['employee_id'] )){
                            $newInsertAlreadyEmployeeId[$value['employee_id']] = $value['email'];
                            continue;
                        }
                        $this->create_org_user($user_id, $value, $import_record_options);
                        $alreadyInGroupNotOrg[$value['employee_id']] =  $value['email'];
                    }
                    if($request['import_record_options'] !='new_insert')
                    {
                        $alreadyExists->update(["name"=>$value['name']]);
                        if($request['import_record_options'] =='update_password_new_insert'){
                            if($users_data->password != $value['password']){
                                $alreadyExists->update( ["password"=>hash::make($value['password'])]);
                            }
                        }
                        if($org_user_check->exists()){
                            $org_user_check->update(['user_type'=>'employee']);
                            $org_user_id = $org_user_check->first()->id;
                            $this->add_metas($org_user_id, $value , $import_record_options);
                            $updateRecord[$value['employee_id']] = $value['email'];
                            // array_push($alreadyInOrg , $value['employee_id']);
                        }
                        array_push($alreadyInGroup, [$value['employee_id']=>$value['email']]);
                    }
                }
            else{
                    if($this->check_employee_id($value['employee_id'])){
                        $newInsertAlreadyEmployeeId[$value['employee_id']] = $value['email'];
                        continue;
                    }
               try{
                    DB::beginTransaction();
                        $groupUsers = new GroupUsers();
                        if(isset($value['password'])){
                            $value['password'] = Hash::make($value['password']);
                        }
                        $groupUsers->fill($value);
                        $groupUsers->save();
                        $this->create_org_user($groupUsers->id, $value,  $import_record_options);
                        DB::commit();
                        $newRecord[$value['employee_id']] = $value['email'];
                    }catch(Exception $e){
                            DB::rollBack();
                        }
                }
            }else{
                $emptyRow[$index] = "Row $index ";
            }
            
        }
        if($newRecord){
            Session::flash('import_new',$newRecord);
        }
        if($updateRecord){
            Session::flash('updateRecord',$updateRecord);
        }

        if($alreadyInGroupNotOrg){
            Session::flash('alreadyInGroupNotOrg',$alreadyInGroupNotOrg);
        }
        if($newInsertAlreadyEmployeeId){
            Session::flash('newInsertAlreadyEmployeeId', $newInsertAlreadyEmployeeId);
        }

        if($emptyRow){
            Session::flash('emptyRow', $emptyRow);
        }
        
    }
         return redirect()->route('import.employee');
    }

    protected function create_org_user($group_user_id , $value , $import_record_options){
      
        $user = new User();
        $user->user_id = $group_user_id;
        $user->user_type = 'employee';
        $user->save();
        $uid = $user->id;
        $this->add_metas($uid , $value, $import_record_options);
        if(!empty($value['role'])){
             $this->add_roles($uid , $value['role'] ,  $import_record_options);
        }
    }

    protected function add_roles($user_id , $roles, $import_record_options){
        $roles = array_map('trim', explode(',', $roles));
        $current = date('Y-m-d');
            foreach ($roles as $roleKey => $roleValue) {
                $checkRole = UsersRole::where('name',$roleValue);
                if($checkRole->exists()){
                    $role_id =  $checkRole->first()->id;
                }else{
                    $userRole = new UsersRole();
                    $userRole->name = $roleValue;
                    $userRole->status = 1;
                    $userRole->slug =  str_slug($roleValue, '-');
                    $userRole->save();
                    $role_id = $userRole->id;
                }
                // UserRoleMapping::where('user_id',$user_id)->delete();
                 if($import_record_options == 'new_insert'){
                   $userRoleMapping =  new UserRoleMapping();
                   $userRoleMapping->user_id = $user_id;
                   $userRoleMapping->role_id = $role_id;
                   $userRoleMapping->save();
                }else{
                    $insert_roles[] = ['user_id'=>$user_id , 'role_id'=>$role_id, 'created_at' => $current , 'updated_at'=>$current];
                }
            }
        if($import_record_options != 'new_insert'){
            $new_data_role = array_column($insert_roles,'role_id');
            UserRoleMapping::where('user_id', $user_id)->whereNotIn('role_id', $new_data_role)->delete();
            $existed_role_id = UserRoleMapping::where('user_id', $user_id)->pluck('role_id')->all();
            $notIn  =  collect($insert_roles)->whereNotIn('role_id' ,$existed_role_id)->toArray();           
            UserRoleMapping::insert($notIn);
        }
    }

    protected function add_metas($user_id , $value , $import_record_options){
        foreach($value as $key => $val){
            if(in_array($key, ['employee_id', 'designation', 'department', 'pay_scale', 'date_of_joining' , 'user_shift'])){
    //designation            
                if($key =='designation' && !empty($val)){
                    $des_check  = DES::select(['id'])->where(['name'=>$val]);
                    if($des_check->exists()){
                        $des_id = $des_check->first()->id;
                    }else{
                        $des = new DES();
                        $des->name = $val;
                        $des->status = 1;
                        $des->save();
                        $des_id = $des->id;
                    }
                    $this->add_user_meta($user_id, 'designation' , $des_id, $import_record_options);
/* department */}elseif($key == 'department' && !empty($val)){
                    $dep_check  = DEP::select(['id'])->where(['name'=>$val]);
                    if($dep_check->exists()){
                        $dep_id = $dep_check->first()->id;
                    }else{
                        $dep = new DEP();
                        $dep->name = $val;
                        $dep->status = 1;
                        $dep->save();
                        $dep_id = $dep->id;
                    }
                    $this->add_user_meta($user_id, 'department' , $dep_id, $import_record_options);
                }elseif($key=='user_shift'){
                    if(!empty($val)){
                        $shiftcheck = Shift::where('name', $val);
                        if($shiftcheck->exists()){
                            $shift_id = $shiftcheck->first()->id;
                        }else{
                            $shifts = new Shift();
                            $shifts->name = $val;
                            $shifts->status = 1;
                            $shifts->save();
                            $shift_id = $shifts->id;
                        }
                    $this->add_user_meta($user_id, $key, $shift_id, $import_record_options);
                    }
                }elseif($key =="pay_scale"){
                    if(!empty($val)){
                       $payscale = Payscale::where('title',$val);
                       if($payscale->exists()){
                            $payscale_id = $payscale->first()->id;
                       }else{
                            $new_payscale =  new Payscale();
                            $new_payscale->title = $val;
                            $new_payscale->save();
                            $payscale_id = $new_payscale->id;
                       }
                        $this->add_user_meta($user_id, $key, $payscale_id, $import_record_options);
                    }
                }else{
                    $this->add_user_meta($user_id, $key, $val, $import_record_options);
                }
            }elseif($key=='role'){
                $this->add_roles($user_id, $val ,  $import_record_options);
            }
        }
    }


        protected function add_user_meta($user_id , $key , $value, $import_record_options){
            $meta = UsersMeta::where(['key'=>$key ,'user_id'=>$user_id]);
            if($key=="date_of_joining"){
                $value = date('Y-m-d',strtotime($value));
            }
                if($meta->exists()){
                    if($import_record_options !='new_insert'){
                        $meta->update(['value'=>$value]);
                    }
                }else{
                        $userMeta           =   new UsersMeta();
                        $userMeta->user_id  =   $user_id;
                        $userMeta->key      =   $key;
                        $userMeta->value    =   $value;
                        $userMeta->save();
                    }
            return true;
        }









            // foreach($data as $key => $record){
            //     foreach($record as $columnHeader => $columnValue){
            //         $explodedHeader = explode('.',$columnHeader);
            //         $recordsArray[$explodedHeader[0]][$explodedHeader[1]] = $columnValue;
            //     }
            //     $userid = '';
            //     foreach($recordsArray as $model => $columns){
            //         switch($model){
            //             case 'user':
            //                 $alreadyExists = User::where(['email'=>$columns['email']])->first();
            //                 if($alreadyExists == null){
            //                     $userModel = new User;
            //                     $userModel->fill($columns);
            //                     $userModel->status = 1;
            //                     $userModel->save();
            //                     $userid = $userModel->id;
            //                 }else{
            //                     $errors[] = ['rowid'=>$rowId,'error'=>'Email id already exists'];
            //                 }
            //             break;

            //             case'employee':
            //                 if($userid != '' && $userid != 0){
            //                     $model = EMP::firstOrNew(['employee_id'=>$columns['employee_id']]);
            //                     $model->user_id = $userid;
            //                     $model->employee_id = $columns['employee_id'];
            //                     if($columns['designation'] != null && $columns['designation'] != ''){
            //                         $designation = DES::where('name','like','%'.$columns['designation'].'%')->first();
            //                         if($designation != null){
            //                             $model->designation = $designation->id;
            //                         }else{
            //                             $model->designation = $columns['designation'];
            //                         }
            //                     }else{
            //                         $model->designation = null;
            //                     }
            //                     if($columns['department'] != null && $columns['department'] != ''){
            //                         $department = DEP::where('name','like','%'.$columns['department'].'%')->first();
            //                         if($department != null){
            //                             $model->department = $department->id;
            //                         }else{
            //                             $model->department = $columns['department'];
            //                         }
            //                     }else{
            //                         $model->department = null;
            //                     }
            //                     unset($columns['id']);
            //                     unset($columns['user_id']);
            //                     unset($columns['employee_id']);
            //                     unset($columns['designation']);
            //                     unset($columns['department']);
            //                     $model->fill($columns);
            //                     $model->save();
            //                 }
            //             break;
            //             case'usersmeta':
            //                 if($userid != '' && $userid != 0){
            //                     foreach($columns as $key => $keyValue){
            //                         $model = new UsersMeta;
            //                         $model->key = $key;
            //                         $model->value = $keyValue;
            //                         $model->type = 'employee';
            //                         $model->user_id = $userid;
            //                         $model->save();
            //                     }
            //                 }
            //             break;
            //         }
            //     }
            //     $rowId++;
            // }
            
    // }
    
    public function import()
    {
        return view('organization.employee.import-employees');
    }
 
}
