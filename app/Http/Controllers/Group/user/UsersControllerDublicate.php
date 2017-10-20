<?php

namespace App\Http\Controllers\Group\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Group\GroupUsers;
use App\Model\Organization\Designation;
use App\Model\Organization\UsersMeta;
use App\Repositories\User\UserRepositoryContract;
use Auth;
use Hash;
use Session;
use App\Model\Organization\UserRoleMapping;
use App\Model\Organization\OrganizationSetting;
use App\Model\Organization\UsersRole;
use App\Model\Organization\Employee;
use App\Model\Organization\Client;
use App\Model\Admin\GlobalOrganization;

class UsersController extends Controller
{
    protected $userRepo;
    public function __construct(UserRepositoryContract $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    public function index(Request $request){
        $datalist = [];
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
                  $model = GroupUsers::where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->order)->paginate($perPage);
              }else{
                  $model = GroupUsers::where('name','like','%'.$request->search.'%')->paginate($perPage);
              }
          }else{
              if($sortedBy != ''){
                  $model = GroupUsers::orderBy($sortedBy,$request->order)->paginate($perPage);
              }else{
                   $model = GroupUsers::paginate($perPage);
              }
          }
          // dd($model);
          $datalist =  [
                          'datalist'=>$model,
                          'showColumns' => ['name'=>'Name','email'=>'Email','status' => 'Status'],
                          'actions' => [
                                          // 'view'   => ['title'=>'View','route'=>'account.profile','class'=>'view'],
                                          'view'   => ['title'=>'View','route'=>'view.group.user','class'=>'view'],
                                          'edit'   => ['title'=>'Edit','route'=>'info.user','class'=>'edit'],
                                          'delete' => ['title'=>'Delete','route'=>'delete.user'],
                                          'model'  =>  ['title'=>'Change Password','data-target' => 'change_password','class'=>'change_password'],
                                          'status_option'  =>  ['title'=>'status option','class'=>'status_option' ,'route' =>'change.user.status']
                                       ]
                      ];
        
        return view('group.user.list',$datalist);
    }

    protected function validateUseForm($request){

    	$rules = [
    		'name' => 'required',
    		'email' => 'required',
    		'password' => 'required',
    		'confirm_password' => 'required'
    	];

    	$this->validate($request, $rules);
    }

    /**
     * Store New user details
     * @param  Request $request [POST data]
     * @return [return url]           [return to list page]
     */
    public function store(Request $request){
    	$this->validateUseForm($request);
    	$model = new GroupUsers;
    	$model->name = $request->name;
    	$model->email = $request->email;
    	$model->password = Hash::make($request->password);
    	$model->app_password = $request->password;
    	$model->save();
        Session::flash('success','User created succesfully');
    	return redirect()->route('group.users'); 
    }
    
    public function edit(Request $request, $id){
        $model = GroupUsers::find($id);
        return view('group.user.edit',['model'=>$model]);
    }

    public function update(Request $request, $id){
        $model = GroupUsers::find($id);
        $model->name = $request->name;
        $model->email = $request->email;
        if($request->has('password') && $request->password != null){
            $model->password = Hash::make($request->password);
        }
        $model->save();
        Session::flash('success','Updated successfully');
        return back();
    }

    /**
     * View User Details
     * @param  [integer] $id [userid]
     * @return [view]     [rendered view]
     */
   	public function view($id){
   		$model = GroupUsers::find($id);
   		return view('group.user.view',['model'=>$model]);
   	}


    public function changePassword(){
      return view('group.user.change-password');
    }
   	
   	public function validateUserEmail(Request $request){
   		$model = GroupUsers::where('email',$request->email)->first();
   		if($model != null){
   			return 'exist';
   		}else{
   			return 'not-exist';
   		}
   	}
    public function createUser()
    {
      
      return view('group.user.create');
    }
    
}

