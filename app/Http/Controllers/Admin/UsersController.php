<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\User as admin_user;
use App\Model\Admin\GlobalUsersRole as Role;


use Hash;
use Session;

class UsersController extends Controller
{
    // protected $userRepo;
    // public function __construct(UserRepositoryContract $userRepo)
    // {
    //     $this->userRepo = $userRepo;
    // }
    public function index(){
        $roles = Role::where('status',1)->pluck('role_name','id');
      
        $plugins = [
                        'js' => ['select2','custom'=>['admin_users']],
                        'roles'=>$roles
                    ];
        return view('admin.users.list')->with(['plugins'=>$plugins]);
    }
    public function list_user()
    {
        $userList = admin_user::orderBy('id','desc')->get();
        return view('admin.users._user')->with(['userList'=>$userList])->render();
    }
    public function deleteUser(Request $request)
    {
        $id = $request->id;
        $del_user = admin_user::where('id',$id)->delete();
        return "true";
    }
    public function createUser(Request $request){
        
        $data = new admin_user;
        $data->fill($request->except('_token')); 
        $data->password = Hash::make($request->password);
        $data->api_token = Hash::make(rand(1000,10000));
        $data->remember_token = Hash::make(rand(1000,10000));
        $data->save();
       
        $userList = admin_user::orderBy('id','desc')->get();
        return view('admin.users._user')->with(['userList'=>$userList])->render();
    }
    public function getUserById($id)
    {
        $roles = Role::where('status',1)->pluck('role_name','id');
        $model = admin_user::where('id',$id)->get();
        $plugins = [
                        'js'    =>  ['select2','custom'=>['admin_users']],
                        'roles' =>  $roles,
                        'model' =>  $model
                    ];
    	return view('admin.users.editUser')->with(['plugins'=>$plugins]);
    }
    public function editUser(Request $request , $id)
    {
    	$id = $request->id;
    	$model = admin_user::where('id',$id)->update($request->except(['_token','id']));
    	if($model){

            return back();
        }
    }
}