<?php

namespace App\Http\Controllers\Group\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Group\GroupUsers;
use Session;
use Hash;

class UsersController extends Controller
{
	protected function validateUseForm($request){

    	$rules = [
    		'name' => 'required',
    		'email' => 'required',
    		'password' => 'required',
    		'confirm_password' => 'required'
    	];

    	$this->validate($request, $rules);
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
                                          'edit'   => ['title'=>'Edit','route'=>'user.group.details','class'=>'edit'],
                                          'delete' => ['title'=>'Delete','route'=>'delete.group.user'],
                                          'changePass'  =>  ['title'=>'Change Password','route' => 'pass.group.user'],
                                          'status_option'  =>  ['title'=>'status option','class'=>'status_option' ,'route' =>'change.user.group.status']
                                       ]
                      ];
        
        return view('group.user.list',$datalist);
    }

    /**
     * undocumented function
     *
     * @return user details with id
     * @author sandip
     **/
    public function view($id){
   		$model = GroupUsers::find($id);
   		return view('group.user.view',['model'=>$model]);
   	}

   	/**
   	 * undocumented function
   	 *
   	 * @return view of create
   	 * @author createUser
   	 **/
   	public function createUser()
    {
      
      return view('group.user.create');
    }

    /**
     * undocumented function
     *
     * @return craete user 
     * @author snadip
     **/
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
     * undocumented function
     *
     * @return back
     * @author sandip
     **/
    public function deleteUser($id)
    {
    	$delete = GroupUsers::where('id',$id)->delete();
    	return back();
    }



      /**
       * undocumented function
       *
       * @return back
       * @author sandip
       **/
        public function changeStatus($id)
        {
            $model = GroupUsers::where('id',$id)->first();
                if($model['status'] == 0){
                    GroupUsers::where('id',$id)->update(['status' => 1]);
                }else{
                    GroupUsers::where('id',$id)->update(['status' => 0]);
                }
            return back();
        }





        /**
         * undocumented function
         *
         * @return view
         * @author sandip
         **/
        public function changePass()
        {
            return view('group.user.change-password');
        }

          public function changePassword(Request $request)
          {

            $validate = [
                            'new_password'      => 'required|min:6',
                            'confirm_password'  => 'required|same:new_password|min:6'
                        ];
            $this->validate($request , $validate);
            $new_pass = Hash::make($request->new_password);

            $model = GroupUsers::where('id',$request->user_id)->update(['password' => $new_pass , 'app_password' => $request->new_password]);
            if($model){
                echo "<script type='text/javascript'>Materialize.toast('password Change Successfully', 4000)</script>";
                return back();
            }
          } 

}
