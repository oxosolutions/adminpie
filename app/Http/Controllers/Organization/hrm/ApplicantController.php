<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Model\Organization\Applicant;
use App\Repositories\User\UserRepositoryContract;
use App\Model\Organization\Application;
// use App\Model\Organization\ApplicationMeta;
use App\Model\Organization\User;
use App\Model\Group\GroupUsers;
use App\Model\Organization\UsersMeta;
use Session;
use Validator;
use Redirect;
use Hash;
use App\Model\Organization\UserRoleMapping;

class ApplicantController extends Controller
{

     protected $user;
    public function __construct(UserRepositoryContract $user)
    {
        $this->user = $user;

    }
    /**
     * [apply description]
     * @param  [int] $id [job opening id]
     * @return [type]     [description]
     */
    public function apply(Request $request, $id=null)
    {
      if($request->isMethod('post')){
        $tbl = Session::get('organization_id');
        $valid_fields = [   'name'          => 'required',
                            'email'         => 'required|email|unique:'.$tbl.'_users',
                            'password'      => 'required|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$/|min:8'
                        ];
        $this->validate($request , $valid_fields);
        $request['role_id'] = setting_val_by_key('applicant_role');
        $user_id = $this->user->create($request->all(), 6,'applicant');

        $application = new Application();
        $application->opening_id = $request['opening_id'];
        $application->applicant_id = $user_id;
        $application->save();
        // unset($request['_token'], $request["opening_id"],$request["name"], $request["email"], $request["password"], $request['role_id']);
        $data = $request->except('_token','opening_id','name','email','password','role_id','qualification','percentage','board/university','date_of_passing');
        foreach ($data as $key => $value) {
          $applicationMeta = new ApplicationMeta();
          $applicationMeta->application_id = $application->id;
          $applicationMeta->key = $key;
          if(is_array($value)){
            $value = json_encode($value);
          }
          $applicationMeta->value = $value;
          $applicationMeta->save();
        }
            Session::flash('sucess','successfully applied Job');
        return redirect()->route('openingss');
      }
         return view('organization.applicant.apply',compact('id'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $datalist= [];
        $data= [];
        if($request->has('per_page')){
            $perPage = $request->per_page;
            if($perPage == 'all'){
                $perPage = 999999999999999;
            }
        }else{
            $perPage = get_items_per_page();;
        }
        $sortedBy = @$request->sort_by;
        if($request->has('search')){
            if($sortedBy != ''){
                $model = GroupUsers::with(['organization_user'])->whereHas('organization_user', function($query){
                    $query->where(['user_type'=>'applicant']);
                })->where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
            }else{
                $model = GroupUsers::with(['organization_user'])->whereHas('organization_user', function($query){
                    $query->where(['user_type'=>'applicant']);
                })->where('name','like','%'.$request->search.'%')->paginate($perPage);
            }
        }else{
            if($sortedBy != ''){
                $model = GroupUsers::with(['organization_user'])->whereHas('organization_user', function($query){
                    $query->where(['user_type'=>'applicant']);
                })->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
            }else{
                $model = GroupUsers::with(['organization_user'])->whereHas('organization_user', function($query){
                    $query->where(['user_type'=>'applicant']);
                })->paginate($perPage);
            }
        }
        $datalist = [
                        'datalist'=>  $model,
                        'showColumns' => ['name'=>'Name','created_at'=>'Created'],
                        'actions'=> [
                                        'edit' => ['title'=>'Edit','route'=>'edit.applicant' , 'class' => 'edit'],
                                        'delete'=>['title'=>'Delete','route'=>'delete.applicant']
                                    ],
                        'js'    =>  ['custom'=>['list-designation']],
                        'css'   =>  ['custom'=>['list-designation']]
                    ];
        return view('organization.applicant.list',$datalist);
    }


    protected function validateApplicantUser($request){

        $rules = [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);
        if($validator->passes()) {
            $groupModel = GroupUsers::where(['email'=>$request->email])->first();
            if($groupModel != null){
                $userModel = User::where(['user_id'=>$groupModel->id,'user_type'=>'applicant'])->first();
                if($userModel != null){
                    $validator->getMessageBag()->add('email', 'Applicant already exists!');
                    return Redirect::back()->withErrors($validator)->withInput();
                }
            }
        }

    }


    /**
     * Save posted data by applicant
     * @param  Request $request having all posted data
     * @return [type]           redirect to applicants list
     */
    public function save(Request $request)
    {
        $this->validateApplicantUser($request);

        $request['name'] = $request['name'];
        $request['email'] = $request['email'];
        $groupModel = GroupUsers::firstOrNew(['email'=>$request->email]);
        if($groupModel->exists){
            $user_id = $groupModel->id;
        }else{
            $groupModel->name = $request->name;
            $groupModel->email = $request->email;
            $groupModel->password = Hash::make($request->password);
            $groupModel->app_password = $request->password;
            $groupModel->status = 1;
            $groupModel->save();
            $user_id = $groupModel->id;
        }

        $userModel = new User;
        $userModel->user_id = $user_id;
        $userModel->user_type = 'applicant';
        $userModel->status = 1;
        $userModel->save();
        $userRoleMapping = new UserRoleMapping;
        $userRoleMapping->user_id = $user_id;
        $userRoleMapping->role_id = 6;
        $userRoleMapping->status = 1;
        $userRoleMapping->save();
        foreach ($request->except(['_token','email','password','name']) as $key => $value) {
            $userMeta = UsersMeta::firstOrNew(['user_id'=>$user_id,'key'=>$key]);
            $userMeta->user_id = $user_id;
            $userMeta->key = $key;
            $userMeta->value = $value;
            $userMeta->save();
        }
        return redirect()->route('list.applicant');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,['name','email']);

        $request['name'] = $request['name'];
        $request['email'] = $request['email'];
        $groupModel = GroupUsers::where(['email'=>$request->email])->first();
        $groupModel->name = $request->name;
        $groupModel->email = $request->email;
        $groupModel->save();

        foreach ($request->except(['_token','email','password','name']) as $key => $value) {
            $userMeta = UsersMeta::firstOrNew(['user_id'=>$user_id,'key'=>$key]);
            $userMeta->user_id = $user_id;
            $userMeta->key = $key;
            $userMeta->value = $value;
            $userMeta->save();
        }
        Session::flash('success','Applicant updated successfully!');
        return redirect()->route('list.applicant');
    }

   /**
    * [destroy description]
    * @param  [type] $id [description]
    * @return [type]     [description]
    */
    public function destroy($id)
    {
        User::where('user_id',$id)->delete();
        UsersMeta::where('user_id', $id)->delete();
        Session::flash('success','Applicant deleted successfully!');
        return back();
    }

    public function createApplicant(){
        return view('organization.applicant.create');
    }

    public function edit($id){
        $model = GroupUsers::with(['organization_user'])->whereHas('organization_user')->where('id',$id)->first();
        return view('organization.applicant.edit',['model'=>$model]);
    }
}
