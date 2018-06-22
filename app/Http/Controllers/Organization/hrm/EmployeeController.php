<?php
namespace App\Http\Controllers\Organization\hrm;
use App\Model\Organization\OrganizationSetting as org_setting;
use App\Repositories\User\UserRepositoryContract;
use App\Model\Organization\OrganizationSetting;
use App\Model\Organization\Designation As DES;
use App\Model\Organization\Department As DEP;
use App\Model\Organization\Category as CAT;
use App\Http\Controllers\Controller;
use App\Model\Organization\UsersMeta;
use App\Model\Organization\User;
use App\Model\Organization\UsersRole;
use App\Model\Organization\UserRoleMapping;
use Illuminate\Http\Request;
use Session;
use Auth;
use Excel;
use Crypt;
use Config;
use Datatables;
use App\Model\Group\GroupUsers;
use Hash;
use DB;
use App\Model\Organization\Shift;
use App\Model\Organization\Payscale;
use DateTime;
use Carbon\Carbon;

/**
* work by paljinder singh
* @Import emplyoyee
*/
class EmployeeController extends Controller
{
    protected $user;

    public function __construct(UserRepositoryContract $user){
        $this->user = $user;
    }

    /**
    *Export employee @author Paljinder singh
    */
    public function export(){
        $group_user = GroupUsers::select(['id','name','password','email'])->with( ['metas','user_role_rel.roles'])->has('organization_employee_user');
        if($group_user->exists()){
            $group_user = $group_user->get();
            $data =$group_user->map(function($item, $key){
                if(!empty($item['user_role_rel'])){
                    $role = array_column(array_column(json_decode($item['user_role_rel'],true), 'roles'),'name');
                    $role_value = implode(', ',$role);
                }
                $meta =  array_column(json_decode($item['metas'],true), 'value','key');
                $meta_value = $this->metas_value($meta);
                $date_of_joining = "";
                if(!empty($meta['date_of_joining'])){
                    $date_of_joining = date('d-F-Y', strtotime($meta['date_of_joining']));
                }
                return ['name' => @$item['name'], 'email'=>@$item['email'] , 'password'=>$item['password'], 'employee_id'=>@$meta['employee_id'], 'designation'=> @$meta_value['designation'], 'department'=> @$meta_value['department'], 'user_shift'=>@$meta_value['user_shift'], 'pay_scale'=>@$meta_value['pay_scale'] ,'date_of_joining'=>@$date_of_joining, 'role'=>$role_value  ];
            });
            Excel::create('Employees-List-'.date('Y-m-d H i s'), function($excel) use($data) {
                $excel->sheet('Employees List', function($sheet) use($data) {
                    $sheet->fromArray($data);
                    $sheet->row(1, array_keys($data[0]));
                    $sheet->row(1, function($row){
                        $row->setFontWeight('bold');
                    });
                });
            })->export('csv');
        }else{
            Session::flash('error','Employee not exists.');
            return back();
        }
    }


    /*
    *metas value use in export method @author Paljinder singh
    */
    protected function metas_value($metas){
        // $model = [ "designation" => 'DES', "department" => "DEP", "user_shift" => "Shift", "pay_scale"=>'Payscale' ];
        $data =["designation" => '', "department" => "", "user_shift" => "", "pay_scale"=>'' ];
        foreach ($metas as $key => $value) {
            if($key=='designation'){
                $des =     DES::where('id', $value);
                if($des->exists()){
                    $data[$key] = $des->first()->name;
                }else{
                    $data[$key] = "";
                }
            }
            if($key=='department'){
                $dep =     DEP::where('id', $value);
                if($dep->exists()){
                    $data[$key] = $dep->first()->name;
                }else{
                    $data[$key] = "";
                }
            }
            if($key=='user_shift'){
                $shift =     Shift::where('id', $value);
                if($shift->exists()){
                    $data[$key] = $shift->first()->name;
                }else{
                    $data[$key] = "";
                }
            }
            if($key=='pay_scale'){
                $payscale =     Payscale::where('id', $value);
                if($payscale->exists()){
                    $data[$key] = $payscale->first()->title;
                }else{
                    $data[$key] = "";
                }
            }
        }
        return $data;
    }


    public function index(Request $request, $id=null){
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
        $employe_id = '';
        $department_name = '';
        $designation_name = '';
        $sortedBy = @$request->orderby;
        $model = $this->getQueryResult($request,$sortedBy,$perPage);
        $datalist =  [
            'datalist'=>  $model,
            'showColumns' => ['employee_id'=>'Employee ID','name'=>'Name','department'=>'Department','designation'=>'Designation','email'=>'Email ID','created_at'=>'Created','status'=>'Status'],
            'actions' => [
                'edit' => ['title'=>'Edit','route'=>['route'=>'account.profile','id'] , 'class' => 'edit'],
                'view' => ['title'=>'Edit','route'=>['route'=>'account.profile','id'] , 'class' => 'edit'],
                'delete'=>['title'=>'Delete','route'=>['route'=>'delete.employee','id'=>'id'] , 'class' => 'delete confirm-delete']
            ],
            'js'  =>  ['custom'=>['list-designation']],
            'css'=> ['custom'=>['list-designation']]
        ];
        if(!empty($id) || $id != null || $id != ''){
            $data['data'] = EMP::where('id',$id)->first();
        }
        return view('organization.hrm.employee.list',$datalist)->with(['data' => $data]);
    }


    protected function getQueryResult($request, $sortedBy, $items){
        $model = User::with(['belong_group','metas'])->where(['user_type'=>'employee'])->paginate($items);
        return $model;
    }


    public function employeeListDatatable(){
        $model = User::with(['belong_group.metas'])->where(['user_type'=>'employee'])->get();//->toArray();
        foreach($model as $key => $val){
            if(!empty($val['belong_group'])){
                $model[$key]->id    =    $val->belong_group->id;
                $model[$key]->name    =    $val->belong_group->name;
                $model[$key]->email   =    $val->belong_group->email;
                if(!empty($meta_data = $val->belong_group->metas)){
                    $meta_data = $val->belong_group->metas->mapWithKeys(function($items){
                        return [$items['key']=>$items['value']];
                    });
                    $meta_data = $meta_data->toArray();
                    if(isset($meta_data['employee_id'])){
                        $model[$key]->employee_id = $meta_data['employee_id'];
                    } else{
                        $model[$key]->employee_id = "";   
                    }
                    if(isset($meta_data['department'])){
                        $department =  DEP::find($meta_data['department']);
                        if($department != null){
                            $dep_name = $department->name;
                        }else{
                            $dep_name = '';
                        }
                        $model[$key]->department =  $dep_name;
                    } else{
                        $model[$key]->department = "";   
                    }
                    if(isset($meta_data['designation'])){
                        if($meta_data['designation'] != null){
                            $designation = DES::find($meta_data['designation']);
                            if($designation != null){
                                $model[$key]->designation = $designation->name;
                            }else{
                                $model[$key]->designation = '';
                            }
                        }else{
                            $model[$key]->designation = '';
                        }
                    } else{
                        $model[$key]->department = $model[$key]->designation = "";   
                    }
                }else{
                    $model[$key]->department = $model[$key]->employee_id =  $model[$key]->designation = "";  
                } 
            }else{
                $model[$key]->name    =    "";
                $model[$key]->email   =    '';//$val->belong_group->email;
            }
            // unset($model[$key]['belong_group']);
        }
        return Datatables::of($model)
            ->addColumn('user', function($model){
                return get_profile_picture($model->id,null,true);
            })
            ->editColumn('status', function($model){
                return view('organization.hrm.employee.status',['model'=>$model])->render();
            })
            ->editColumn('created_at', function($model){
                return $model->created_at->diffForHumans();
            })
            ->editColumn('name', function($model){
                return view('organization.hrm.employee.actions',['model'=>$model])->render();
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

    /* should delete */
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
    * function for validate save employee post request
    * @return will return back to save view of add employee
    */
    protected function validateAddEmployee($request){
        $valid_fields = [
            'name'          =>  'required',
            'email'         =>  'required|email',
            'password'      =>  'required|min:8',
            'employee_id'   =>  'required|min:4|regex:/^[a-z0-9-]+$/|max:256',
            'user_shift'    =>  'required',
            'designation'   =>  'required',
            'department'    =>  'required'
        ];
        $this->validate($request , $valid_fields);
    }

    /**
    * Save Employee
    * @param  Request $request having all the posted data
    * @return [type] will return back to employee list route
    * @author Rahul 
    */
    public function save(Request $request){
        if(!is_default_role_selected_for_employee('employee_role')){
            Session::flash('error','Need to set Role Id for employee in setting.');
            return back()->withInput($request->all());
        }
        $request['date_of_joining'] = date("Y-m-d");
        $tbl = Session::get('group_id');
        $this->validateAddEmployee($request);
        if($this->is_employee_id_exists($request['employee_id'])) {
            Session::flash('error', 'Employee Id already in use.');
            return back()->withInput($request->all());
        }
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
        $assign_role->user_id = $user_id;
        $assign_role->role_id = setting_val_by_key('employee_role');
        $assign_role->status = 1;
        $assign_role->save();
        foreach($request->all() as $key => $value){
            if(in_array($key,['designation','department','user_shift','employee_id','date_of_joining'])){
                $userMeta = new UsersMeta;
                $userMeta->user_id = $user_id;
                $userMeta->key = $key;
                $userMeta->value = $value;
                $userMeta->save();
            }
        }
        return redirect()->route('list.employee');
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
        try{
            DB::beginTransaction();
            $user =  User::where(['user_id'=>$id,'user_type'=>'employee']);
            if(empty($user)){
                return back();
            }
            $user->delete();
            // $model_meta = User::where('id',$id)->delete();
            $model_meta = UsersMeta::where('user_id',$id)->delete();
            DB::commit();
            Session::flash('success','Employee delete successfullly');
        }catch(Exception $e){
            DB::rollBack();
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
    /**
    * Validate employee id already exists or not
    * @param  [type] $employee_id having employee id
    * @return boolean will return true and false
    */
    protected function is_employee_id_exists($employee_id){
        $emp_id_check  = UsersMeta::where(['key'=>'employee_id', 'value'=> $employee_id]);
        if($emp_id_check->exists()){
            return true;
        }
        return false;
    }
    /**
    * ValidateDatet check valid date
    @parm  date
    return  bool true false
    @author Paljinder Singh
    */
    protected function validateDate($date){
        if(str_contains($date, '/')){
            $date_data = explode('/' , $date);
            $date = date('d-F-Y' , strtotime($date_data[1].'-'.$date_data[0].'-'.$date_data[2]));
        }
        $d = DateTime::createFromFormat('d-F-Y', $date);
        return $d && $d->format('d-F-Y') == $date;
    }

    /**
    * Import Emploayee  csv employee dataa 
    @parm  $request
    return  
    @author Paljinder Singh
    */
    public function importEmployee(Request $request){
        $index = 1;
        $in_valid_date_format = $emptyRow = $newInsertAlreadyEmployeeId = $alreadyInGroupNotOrg = $update_password = $newRecord = $updateRecord = $alreadyInGroup = [];
        if($request->hasFile('import_employee')){
            $organizationId = get_organization_id();
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
                    /*if(!empty($value['date_of_joining'])){
                        if($this->validateDate($value['date_of_joining'])==false){
                            $in_valid_date_format[$value['employee_id']] = $value['email'];
                            continue;
                        }
                    }*/
                    $alreadyExists = GroupUsers::where(['email'=>$value['email']]); 
                    if($alreadyExists->exists()){
                        $users_data = $alreadyExists->first();
                        $user_id = $users_data->id;
                        $org_user_check = User::where('user_id', $user_id);
                        if(!$org_user_check->exists()){
                            if( $import_record_options == 'new_insert' && $this->is_employee_id_exists($value['employee_id'] )) {
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
                                    $alreadyExists->update(["password"=>hash::make($value['password'])]);
                                }
                            }
                            if($org_user_check->exists()){
                                $org_user_check->update(['user_type'=>'employee']);
                                $org_user_id = $org_user_check->first()->id;
                                $this->add_metas($user_id, $value , $import_record_options);
                                $updateRecord[$value['employee_id']] = $value['email'];
                            }
                            array_push($alreadyInGroup, [$value['employee_id']=>$value['email']]);
                        }
                    }
                    else{
                        if($this->is_employee_id_exists($value['employee_id'])){
                            $newInsertAlreadyEmployeeId[$value['employee_id']] = $value['email'];
                            continue;
                        }
                        try{
                            DB::beginTransaction();
                            $groupUsers = new GroupUsers();
                            if(isset($value['password'])){
                                $password = $value['password'] = Hash::make($value['password']);
                            }
                            $groupUsers->fill($value);
                            $groupUsers->password = $password;
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
            if($in_valid_date_format){
                Session::flash('in_valid_date_format', $in_valid_date_format);
            }
        }
        // dd(Session::get('in_valid_date_format'), $in_valid_date_format);
        return redirect()->route('import.employee');
    }
    /*
    Create employee use in Import employee method
    */
    protected function create_org_user($group_user_id , $value , $import_record_options){
        $user = new User();
        $user->user_id = $group_user_id;
        $user->user_type = 'employee';
        $user->save();
        $uid = $group_user_id;
        $this->add_metas($uid , $value, $import_record_options);
        if(!empty($value['role'])){
            $this->add_roles($uid , $value['role'] ,  $import_record_options);
        }
    }

    /*
    create roles if not exist & assign to employee Use in Import employse
    @author Paljinder singh 
    */
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
            if(!UserRoleMapping::where(['user_id'=>$user_id, 'role_id'=>$role_id ])->exists()){
                $userRoleMapping =  new UserRoleMapping();
                $userRoleMapping->user_id = $user_id;
                $userRoleMapping->role_id = $role_id;
                $userRoleMapping->save();
            }
            $u_roles[] = $role_id;
        }
        if($import_record_options != 'new_insert'){
            UserRoleMapping::where('user_id', $user_id)->whereNotIn('role_id', $u_roles)->delete();
        }
    }

    /* add metas  use in import employee to handle meta data
    @author Paljinder singh 
    */
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


    /*
    Add user meta use in add metas 
    @author Paljinder singh
    */
    protected function add_user_meta($user_id , $key , $value, $import_record_options){
        $meta = UsersMeta::where(['key'=>$key ,'user_id'=>$user_id]);
        if($key=="date_of_joining"){
            $value = Carbon::parse($value)->format('Y-m-d');
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

    public function import() {
        return view('organization.hrm.employee.import-employees');
    }
    public function editEmployee(){
        dd('edit-emp');
    }
    public function addEmployee() {
        return view('organization.hrm.employee.add');
    }
}
