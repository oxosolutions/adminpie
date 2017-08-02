<?php

namespace App\Http\Controllers\Organization\users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\User as org_user;
use App\Model\Organization\Designation;
use App\Model\Organization\UsersMeta;
use App\Repositories\User\UserRepositoryContract;
use Auth;
use Hash;
use Session;
use App\Model\Organization\UserRoleMapping;
use App\Model\Organization\OrganizationSetting;

class UsersController extends Controller
{
    protected $userRepo;
    public function __construct(UserRepositoryContract $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    public function index(Request $request){
        $datalist = [];
        /*$data = DEP::all();
        return view('organization.department.list_department',['data'=>$data]);*/
        if($request->has('items')){
            $perPage = $request->items;
            if($perPage == 'all'){
              $perPage = 999999999999999;
            }
          }else{
            $perPage = 10;
          }
        $sortedBy = @$request->orderby;
          if($request->has('search')){
              if($sortedBy != ''){
                  $model = org_user::where('id','!=',Auth::guard('org')->user()->id)->where('name','like','%'.$request->search.'%')->with(['user_role_rel','userType'])->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                  $model = org_user::where('id','!=',Auth::guard('org')->user()->id)->where('name','like','%'.$request->search.'%')->with(['user_role_rel','userType'])->paginate($perPage);
              }
          }else{
              if($sortedBy != ''){
                  $model = org_user::where('id','!=',Auth::guard('org')->user()->id)->orderBy($sortedBy,$request->desc_asc)->with(['user_role_rel'=>function($query){
                      $query->with('roles');
                  },'userType'])->paginate($perPage);
              }else{
                   $model = org_user::where('id','!=',Auth::guard('org')->user()->id)->with(['user_role_rel'=>function($query){
                      $query->with('roles');
                  },'userType'])->paginate($perPage);
              }
          }
          $datalist =  [
                          'datalist'=>$model,
                          'showColumns' => ['name'=>'Name','email'=>'Email','user_role_rel.roles.name' => 'Role','status' => 'Status'],
                          'actions' => [
                                          'view'   => ['title'=>'View','route'=>'account.profile','class'=>'view'],
                                          'edit'   => ['title'=>'Edit','route'=>'info.user','class'=>'edit'],
                                          'delete' => ['title'=>'Delete','route'=>'delete.user'],
                                          'model'  =>  ['title'=>'change Password','data-target' => 'change_password','class'=>'change_password'],
                                          'status_option'  =>  ['title'=>'status option','class'=>'status_option' ,'route' =>'change.user.status']
                                       ]
                      ];
        $plugins = [
                        'js' => ['select2','custom'=>['users']]
                    ];
    	// $userList = org_user::orderBy('id','desc')->get();
        return view('organization.user.list',$datalist)->with(['plugins'=>$plugins]);
    	// return view('organization.user.list')->with(['userList'=>$userList,'plugins'=>$plugins]);
    }
    public function create(Request $request)
    {
        return view('organization.user.create');
    }

    public function store(Request $request){
      $model = org_user::where(['email'=>$request->email])->first();
      if(count($model) > 0){
        Session::flash('exist_email','Email already exist');
        return back();
      }else{
        $this->validateForm($request);
        $model = new org_user;
        $model->fill($request->except('_token','password','user_role'));
        $model->password = Hash::make($request->password);
        $model->status = 1;
        $model->save();
        if($request->has('user_role')){
            foreach($request->user_role as $key => $role){
                $roleMapping = new UserRoleMapping;
                $roleMapping->user_id = $model->id;
                $roleMapping->role_id = $role;
                $roleMapping->status = 1;
                $roleMapping->save();
            }
        }
        Session::flash('success','Created Successfully!!');
        return redirect()->route('info.user',['id'=>$model->id]);

      }
    }
    public function FunctionName(Request $request )
    {
        dd($request->all());
    }
    protected function validateForm($request){
    	$rules = [

    			'name' => 'required',
    			'email'	=>	'required',
    			'password' => 'required',
    			'user_role' => 'required'
    	];

    	$this->validate($request,$rules);
    }
     public function edit(Request $request)
    {   

        return view('organization.user.edit_employee');
    }

    public function user_info($id){   

        $model = org_user::with(['user_role_rel'])->find($id);
        return view('organization.user.info',['model'=>$model]);
    }
    public function user_meta(Request $request, $id)
    {
        $model = org_user::find($id);
        $model->name = $request->name;
        $model->email = $request->email;
        $model->save();
        $notToDeleteIds = [];
        foreach($request->role_id as $key => $role){
            $mappingModel = UserRoleMapping::firstOrNew(['user_id'=>$id,'role_id'=>$role]);
            $mappingModel->user_id = $id;
            $mappingModel->role_id = $role;
            $mappingModel->status = 1;
            $mappingModel->save();
            $notToDeleteIds[] = $mappingModel->id;
        }
        UserRoleMapping::whereNotIn('id',$notToDeleteIds)->where('user_id',$id)->delete();
        return redirect()->route('list.user');
    }

    public function update(Request $request){

        try{
            $model = org_user::find($request->user_id);
            $model->name = $request->name;
            $model->email = $request->email;
            $model->save();
            $requestData = $request->all();
            unset($requestData['name']);
            unset($requestData['email']);
            $this->userRepo->user_meta($requestData);
        }catch(\Exception $e){
            throw $e;
        }
    }
    /**
     * [deleteUser now just change the status of user to 0] 
     * @return [type] [description]
     */
    public function deleteUser($id){
      $model = org_user::where('id',$id)->update(['status'=>'0']);
      return back();
    }
    public function changePassword(Request $request)
    {
      $model = org_user::where('id',$request->user_id)->first();
      $check = Hash::check( Hash::make($request->password) , $model->password);
      // dd($check);

      $validate = [
                      'new_password'      => 'required|min:6',
                      'confirm_password'  => 'required|same:new_password|min:6'
                  ];
      $this->validate($request , $validate);

      $model = org_user::where('id',$request->user_id)->update(['password' => Hash::make($request->new_password)]);
      if($model){
          echo "<script type='text/javascript'>Materialize.toast('password Change Successfully', 4000)</script>";
          return back();
      }
    }
    public function changeStatus($id)
    {
      $model = org_user::where('id',$id)->first();
      if($model['status'] == 0){
        org_user::where('id',$id)->update(['status' => 1]);
      }else{
        org_user::where('id',$id)->update(['status' => 0]);
      }
      return back();
    }

    public function saveSideBarActiveStats($status){
        $model = UsersMeta::firstOrNew(['user_id'=>Auth::guard('org')->user()->id,'key'=>'layout_sidebar_small']);
        $model->key = 'layout_sidebar_small';
        $model->user_id = Auth::guard('org')->user()->id;
        $model->value = $status;
        $model->save();
    }
}

