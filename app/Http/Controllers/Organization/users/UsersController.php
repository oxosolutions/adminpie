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
    public function index(){
        $plugins = [
                        'js' => ['select2','custom'=>['users']]
                    ];
    	$userList = org_user::orderBy('id','desc')->get();
    	return view('organization.user.list')->with(['userList'=>$userList,'plugins'=>$plugins]);
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

    public function user_info($id)
    {   
        $data = [];
        $k = [];
        $v = [];

        $userMeta = UsersMeta::where('user_id',$id)->get();
        $index = 0;
        foreach ($userMeta as $key => $value) {
            $k[]= $value->key;
            $v[] = $value->value;
            $index++;
        }
        $UM= array_combine($k ,$v );
        $designation = null;
        $types = org_user::where('id',$id)->first()->user_type;
        $type_array =  json_decode($types,true);
        $send_data =  ['user_id'=>$id , 'type'=>$type_array];
        if(in_array(2,$type_array))
        {
         $designation = Designation::pluck('name','id');
         $send_data =  array_add($send_data, 'designation',$designation);
         $des_id =   $this->userRepo->employee_designation($id);
         $send_data = array_add($send_data,'designation_id',$des_id);
         $user_info =   org_user::where('id',$id)->first();
         $send_data = array_add($send_data,'user_info',$user_info);
         $user_meta = $UM;
         $send_data = array_add($send_data,'user_meta',$user_meta);
        }
        return view('organization.user.info',['plugins'=>['js'=>['custom'=>['users']]]])->with('send_data',[$send_data]);
    }
    public function user_meta(Request $request)
    {
        $this->userRepo->user_meta($request->all());
        return redirect()->route('list.users');
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
