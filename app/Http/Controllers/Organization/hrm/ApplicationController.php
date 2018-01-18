<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Applicant;
use App\Model\Organization\ApplicantMeta; 
use App\Repositories\User\UserRepositoryContract;
use App\Model\Organization\Application;
use App\Model\Organization\ApplicationMeta;
use App\Model\Group\GroupUsers;
use App\Model\Organization\User;
use App\Mail\ApplicationRegisterUser;
use Session;
use Validator;
use Mail;
use Hash;
class ApplicationController extends Controller
{
	public function index(Request $request){
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
                $model = GroupUsers::with(['applications'])->wherehas('applications')->where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
            }else{
                $model = GroupUsers::with(['applications'])->wherehas('applications')->where('name','like','%'.$request->search.'%')->paginate($perPage);
            }
        }else{
            if($sortedBy != ''){
                $model = GroupUsers::with(['applications'])->whereHas('applications')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
            }else{
                $model = GroupUsers::with(['applications'])->whereHas('applications')->paginate($perPage);
            }
        }

        foreach ($model as $key => $value) {
            $model[$key]->id = $value->applications->id;    
        }
        $datalist = [
                        'datalist'=>  $model,
                        'showColumns' => ['name'=>'Name', 'email'=>'Email', 'created_at'=>'Created'],
                        'actions' => [
                                        'view' => ['title'=>'View Details','route'=>'view.applicantion' , 'class' => 'edit'],
                                        'delete'=>['title'=>'Delete','route'=>'delete.applicantion']
                                    ],
                        'js'  =>  ['custom'=>['list-designation']],
                        'css'=> ['custom'=>['list-designation']]
                    ];
    	
        return view('organization.application.application',$datalist);
    } 

    public function application_view($id){
        $application = GroupUsers::with(['applications'=>function($query){
            $query->with(['application_meta']);
        }])->whereHas('applications')->first();
		return view('organization.application.application_view',compact('application'));
	}
	public function delete($id){
		Application::where('id',$id)->delete();
		ApplicationMeta::where('application_id',$id)->delete();
		return redirect()->route('list.applicantions');
	}

    public function validateApplicationForm($request){

        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'resume' => 'required'
        ];
        $this->validate($request,$rules);
    }


    /**
     * Save submitted applicationd data into database
     * @param  Request $request having all posted data
     * @return [type]           will return back to same route
     * @author Rahul
     */
    public function submitApplication(Request $request){
        $this->validateApplicationForm($request);
        $fileName = '';
        if($request->hasFile('resume')){
            $fileName = $request->file('resume')->getClientOriginalName();
            $path = upload_path('application_attachments');
            $fileExtension = $request->file('resume')->getClientOriginalExtension();
            if(!in_array($fileExtension,['docx','xlsx','xls','pdf'])){
                $validator = Validator::make($request->all(),['resume'=>'required']);
                $validator->errors()->add('resume','Select correct file! (Example: .xls, .xlsx, .doc, .pdf)');
                return back()->withErrors($validator)->withInput();;
            }
            $request->file('resume')->move($path,$fileName);
        }
        $userCreate = $this->createUserOfApplication($request);// To create new user for applicant
        if($userCreate['status'] == 'new_user'){
            $password = $userCreate['password'];
        }else{
            $password = 'same_password';
        }
        Mail::to($request->email)->send(new ApplicationRegisterUser(['email'=>$request->email,'password'=>$password]));
        $applicationModel = new Application;
        $applicationModel->applicant_id = $userCreate['user_id'];
        $applicationModel->opening_id = $request->opening_id;
        $applicationModel->status = 1;
        $applicationModel->save();

        $applicationMeta = new ApplicationMeta;
        $applicationMeta->application_id = $applicationModel->id;
        $applicationMeta->key = 'application_attachment';
        $applicationMeta->value = $fileName;
        $applicationMeta->save();
        $this->insertApplicationMetaCollection($request,$applicationModel->id);
        Session::flash('success','Application submitted successfully!');
        return back();
    }

    /**
     * To insert all remaning fields in meta
     * @param  [type] $request       having all posted data by user
     * @param  [type] $applicationId having submitted application id
     * @return [type] return bollean
     * @author Rahul
     */
    protected function insertApplicationMetaCollection($request, $applicationId){
        $request  = $request->except(['name','email','password','resume']);
        foreach($request as $key => $value){
            $applicationMeta = new ApplicationMeta;
            $applicationMeta->application_id = $applicationId;
            $applicationMeta->key = $key;
            $applicationMeta->value = $value;
            $applicationMeta->save();
        }
        return true;
    }

    /**
     * Create application user in group users
     * @param  [type] $request having all posted data by user
     * @return [type]          will return array of password or user id 
     * @author Rahul
     */
    protected function createUserOfApplication($request){

        $model = GroupUsers::firstOrNew(['email'=>$request->email]);
        if(!$model->exists){
            $model->name = $request->name;
            $model->email = $request->email;
            $password = str_random();
            $model->password = Hash::make($password);
            $model->status = 1;
            $model->app_password = $password;
            $model->save();
            $user_id = $model->id;
            $userModel = new User;
            $userModel->user_id = $user_id;
            $userModel->user_type = 'applicant';
            $userModel->status = 1;
            $userModel->save();
            return ['status'=>'new_user','password'=>$password,'user_id'=>$user_id];
        }else{
            $user_id = $model->id;
            $userModel = User::firstOrNew(['user_type'=>'applicant','user_id'=>$model->id]);
            $userModel->user_id = $user_id;
            $userModel->user_type = 'applicant';
            $userModel->status = 1;
            $userModel->save();
            return ['status'=>'exists','user_id'=>$user_id];
        }
    }

}
