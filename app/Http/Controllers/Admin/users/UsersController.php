<?php

namespace App\Http\Controllers\Admin\users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\User as admin_user;
use App\Model\Admin\GlobalUsersRole as Role;


use Hash;
use Session;

class UsersController extends Controller
{    
    /**
     * index function
     *
     * @return list of users
     * @author sandip
     **/
    public function index(Request $request){
        if($request->has('items')){
          $perPage = $request->items;
          if($perPage == 'all'){
            $perPage = 999999999999999;
          }
        }else{
          $perPage = 5;
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
                                        'edit' =>           ['title'    =>  'Edit'  ,               'route'=>'admin.user.get'],
                                        'changePassword'=>  ['title'    =>  'Change Password',      'route'=>'admin.changepass.user'],
                                        'delete'=>          ['title'    =>  'Delete',               'route'=>'delete.admin.user']
                                     ]
                    ];
        return view('admin.users.list' , $datalist); 
    }
    /**
     * addUser function
     *
     * @return add new user view
     * @author sandip 
     **/
    public function addUser()
    {
        return view('admin.users.create');
    }
    // public function list_user()
    // {
    //     $userList = admin_user::orderBy('id','desc')->get();
    //     return view('admin.users._user')->with(['userList'=>$userList])->render();
    // }
    /**
     * deleteUser function
     *
     * @return delete user
     * @author sandip
     **/
    public function deleteUser($id)
    {
        $id = $id;
        $del_user = admin_user::where('id',$id)->delete();
        return back();
    }

    /**
     * createUser function
     *
     * @return create a new user
     * @author sandip 
     **/
    public function createUser(Request $request)
    {
        $data = new admin_user;
        $data->fill($request->except('_token')); 
        $data->password = Hash::make($request->password);
        $data->api_token = Hash::make(rand(1000,10000));
        $data->remember_token = Hash::make(rand(1000,10000));
        $data->save();
       
        $userList = admin_user::orderBy('id','desc')->get();
        Session::flash('success', 'User created successfully');
        return redirect()->route('admin.list.users');
    }
    /**
     * getUserById function
     *
     * @return get single user detail
     * @author sandip 
     **/
    public function getUserById($id)
    {
        $roles = Role::where('status',1)->pluck('role_name','id');
        $model = admin_user::where('id',$id)->first();
        $plugins = [
                        'js'    =>  ['custom'=>['admin_users']],
                        'roles' =>  $roles,
                        'model' =>  $model
                    ];
    	return view('admin.users.edit')->with(['plugins'=>$plugins]);
    }
    /**
     * editUser function
     *
     * @return edit user
     * @author sandip 
     **/
    public function editUser(Request $request , $id)
    {
    	$model = admin_user::where('id',$id)->update($request->except(['_token','id']));
    	if($model){
            Session::flash('success','Updated successfully');
            return back();
        }
    }

      /**
       * undocumented function
       *
       * @return view of the change password
       * @author sandip
       **/
      public function changePass()
      {
          return view('admin.users.change-password');
      }


    /**
     * changePassword function
     *
     * @return 
     * @author sandip
     **/
    public function changePassword(Request $request)
    { 
            $model = admin_user::where('id',$request->user_id)->first();
            $check = Hash::check( Hash::make($request->password) , $model->password);

            $validate = [
                            'new_password'      => 'required|min:6',
                            'confirm_password'  => 'required|same:new_password|min:6'
                        ];
          $this->validate($request , $validate);

        $model = admin_user::where('id',$request->user_id)->update(['password' => Hash::make($request->new_password)]);
        if($model){
            Session::flash('success','Password Change Successfully');
            return back();
        }
    }

}