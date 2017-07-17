<?php

namespace App\Http\Controllers\Organization\users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\User as org_user;
use App\Model\Organization\Designation;
use App\Model\Organization\UsersMeta;
use App\Repositories\User\UserRepositoryContract;

use Hash;
use Session;

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
        if($request->has('per_page')){
            $perPage = $request->per_page;
            if($perPage == 'all'){
              $perPage = 999999999999999;
            }
          }else{
            $perPage = 5;
          }
        $sortedBy = @$request->sort_by;
          if($request->has('search')){
              if($sortedBy != ''){
                  $model = org_user::where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                  $model = org_user::where('name','like','%'.$request->search.'%')->paginate($perPage);
              }
          }else{
              if($sortedBy != ''){
                  $model = org_user::orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                   $model = org_user::paginate($perPage);
              }
          }
          $datalist =  [
                          'datalist'=>$model,
                          'showColumns' => ['name'=>'Name','created_at'=>'Created At'],
                          'actions' => [
                                          'edit'    => ['title'=>'Edit','route'=>'info.user','class'=>'edit'],
                                          // 'delete'  => ['title'=>'Delete','route'=>'delete.department']
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

    	$this->validateForm($request);
    	$model = new org_user;
    	$model->fill($request->except('_token','password','user_type'));
    	$model->password = Hash::make($request->password);
    	$model->user_type = json_encode($request->user_type);
    	$model->save();
    	Session::flash('success','Created Successfully!!');
    	return redirect()->route('info.user',['id'=>$model->id]);
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
    			'user_type' => 'required'
    	];

    	$this->validate($request,$rules);
    }
     public function edit(Request $request)
    {   

        return view('organization.user.edit_employee');
    }

    public function user_info($id){   

        $model = org_user::find($id);
        return view('organization.user.info',['model'=>$model]);
    }
    public function user_meta(Request $request, $id)
    {
        $model = org_user::find($id);
        $model->name = $request->name;
        $model->email = $request->email;
        $model->role_id = $request->role_id;
        $model->user_type = json_encode($request->user_type);
        $model->save();
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

}
