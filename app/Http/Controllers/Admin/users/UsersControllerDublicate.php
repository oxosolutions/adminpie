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
    public function index(Request $request){
        // $roles = Role::where('status',1)->pluck('role_name','id');
      
        // $plugins = [
        //                 'js' => ['custom'=>['admin_users']],
        //                 'roles'=>$roles
        //             ];
        // return view('admin.users.list')->with(['plugins'=>$plugins]);



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
                $model = admin_user::where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->order)->paginate($perPage);
            }else{
                $model = admin_user::where('name','like','%'.$request->search.'%')->paginate($perPage);
            }
        }else{
            if($sortedBy != ''){
                $exploded = @explode(':',$sortedBy);
                if(isset($exploded[1])){
                    $sortedBy = $exploded[0];
                }
                $model = admin_user::orderBy($sortedBy,$request->order)->paginate($perPage);
            }else{
                 $model = admin_user::paginate($perPage);
            }
        }
        $datalist =  [
                        'datalist'=>$model,
                        'showColumns' => ['name'=>'Title','email'=>'Email','created_at'=>'Created'],
                        'actions' => [
                                        'edit' =>   ['title'    =>  'Edit'  ,   'route'=>'user.get'],
                                        'delete'=>  ['title'    =>  'Delete',   'route'=>'delete.admin.user']
                                     ]
                    ];
        return view('admin.users.list' , $datalist); 
    }
    public function list_user()
    {
        $userList = admin_user::orderBy('id','desc')->get();
        return view('admin.users._user')->with(['userList'=>$userList])->render();
    }
    public function deleteUser($id)
    {
        $id = $id;
        $del_user = admin_user::where('id',$id)->delete();
        return back();
    }
    public function createUser(Request $request){
        $data = new admin_user;
        $data->fill($request->except('_token')); 
        $data->password = Hash::make($request->password);
        $data->api_token = Hash::make(rand(1000,10000));
        $data->remember_token = Hash::make(rand(1000,10000));
        $data->save();
       
        $userList = admin_user::orderBy('id','desc')->get();
        // return view('admin.users._user')->with(['userList'=>$userList])->render();
        Session::flash('success', 'User created successfully');
        return redirect()->route('admin_users');
    }
    public function getUserById($id)
    {
        $roles = Role::where('status',1)->pluck('role_name','id');
        $model = admin_user::where('id',$id)->first();
        $plugins = [
                        'js'    =>  ['custom'=>['admin_users']],
                        'roles' =>  $roles,
                        'model' =>  $model
                    ];
    	return view('admin.users.editUser')->with(['plugins'=>$plugins]);
    }
    public function editUser(Request $request , $id)
    {
    	$model = admin_user::where('id',$id)->update($request->except(['_token','id']));
    	if($model){
            Session::flash('success','Updated successfully');
            return back();
        }
    }
    public function addUser()
    {
        return view('admin.users.add-user');
    }
}