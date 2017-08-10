<?php

namespace App\Http\Controllers\Organization\account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Model\Organization\User;
use Hash;
use Carbon\Carbon;
use App\Model\Organization\Employee;
use App\Model\Organization\User as US;
use App\Model\Organization\UsersMeta as UM;
use App\Model\Organization\LogSystem as LS;
use App\Model\Organization\ProjectMeta;
use Session;
use Image;

class AccountController extends Controller
{
     public function emailsList(){
        return view('organization.profile.email');
    }

    protected function listActivities()
    {
        $user_id = Auth::guard('org')->user()->id;
        $user_log = LS::where('user_id',$user_id)->orderBy('id','DESC')->limit(10)->get();
        return $user_log;        
    }

    /**
     * Public function to view all prefilled details of user profile
     * @param  $id having user id
     * @return view
     * profileDetails method alter BY Paljinder singh & comment code which not in use.
     */
    public function profileDetails($id = null){
        $user_log = $this->listActivities();
    	if($id == null){
    		 $id = Auth::guard('org')->user()->id;
    	}
        $userDetails = User::with(['employee_rel'=>function($query){
                $query->with(['department_rel','designation_rel']);
            },'metas','applicant_rel','client_rel','user_role_rel'])->find($id);

        $userDetails->password = '';
        if($userDetails->employee_rel != null){
            @$userDetails->employee_id = $userDetails->employee_rel->employee_id;
            @$userDetails->department = $userDetails->employee_rel->department_rel->id;
            if($userDetails->employee_rel->designation_rel != null){
                $userDetails->designation = $userDetails->employee_rel->designation_rel->id;
            }
        }
        // dd($userDetails);
        @$userDetails->marital_status = $userDetails->employee_rel->marital_status;
        @$userDetails->date_of_joining = Carbon::parse($userDetails->employee_rel->joining_date)->format('Y-m-d');
        if(!$userDetails->metas->isEmpty()){
            foreach($userDetails->metas as $key => $value){
                $userDetails->{$value->key} = $value->value;
            }
        }
           
        return view('organization.profile.view',['model' => $userDetails , 'user_log' => $user_log]);
    }

    /**
     * To update user details
     * @param  Request $request contains post requests data
     * @param  $id  user id which one we have to update
     * @return back function to go back the previous page
     */
    public function update(Request $request, $id){
        $tbl = Session::get('organization_id');
        $data = User::where('id',$id)->first();
        if($data->id == $id){
            if($data->email == $request->email){
                    $valid_fields = [
                                  'email' => 'required'
                                ];
                    $this->validate($request , $valid_fields) ;
            }else{
                $valid_fields = [
                                  'email' => 'required|unique:'.$tbl.'_users'
                                ];
                $this->validate($request , $valid_fields) ;
            }
        }
        $userDetails = User::find($id);
        if($request->password != null && $request->password != ''){
            $userDetails->password = Hash::make($request->password);
        }
        $userDetails->name = $request->name;
        $userDetails->email = $request->email;
        $userDetails->save();
        $remainingMeta = $request->except([
                            '_method','_token','name','email','password','action'
                        ]);
        foreach($remainingMeta as $key => $value){
            $metaModel = UM::firstOrNew(['user_id'=>$id,'key'=>$key]);
            $metaModel->key = $key;
            $metaModel->value = $value;
            $metaModel->user_id = $id;
            $metaModel->save();
        }
        return back();
    }

    public function storeMeta(Request $request, $id){

        $request_data = $request->except([
                            '_method','_token','action'
                        ]);

        if($request_data['meta_table'] == 'usermeta'){
            foreach($request_data as $key => $value){
                if($value != null && $value != ''){
                    $metaModel = UM::firstOrNew(['user_id'=>$id,'key'=>$key]);
                    $metaModel->key = $key;
                    $metaModel->value = $value;
                    $metaModel->user_id = $id;
                    $metaModel->save();
                }
            }
        }
        if($request_data['meta_table'] == 'employeemeta'){
            $tbl = Session::get('organization_id');
            $data = Employee::where(['user_id' => $id])->first();
            if(!array_key_exists('empId', $request->all())){
              if(@$data->user_id == $id){
                if(@$data->employee_id == @$request_data['employee_id']){
                        $valid_fields = [
                                      'employee_id' => 'required'
                                    ];
                        $this->validate($request , $valid_fields) ;

                }else{
                    $valid_fields = [
                                      'employee_id' => 'required|unique:'.$tbl.'_employees'
                                    ];
                    $this->validate($request , $valid_fields) ;

                }
            }  
            }
            
            foreach($request_data as $key => $value){
                if($value != null && $value != ''){
                    if($key == 'designation'){
                        $employeeModel = Employee::where('user_id',$id)->update(['designation' => $value]);
                    }
                    if($key == 'department'){
                        $employeeModel = Employee::where('user_id',$id)->update(['department' => $value]);
                    }
                    if($key == 'employee_id'){
                        $employeeModel = Employee::where('user_id',$id)->update(['employee_id' => $value]);
                    }
                    if($key == 'date_of_joining'){
                        $employeeModel = Employee::where('user_id',$id)->update(['joining_date' => $value]);
                    }
                    if($key == 'date_of_leaving'){
                        $employeeModel = Employee::where('user_id',$id)->update(['leaving_date' => $value]);
                    }
                    $metaModel = UM::firstOrNew(['key'=>$key]);
                    $metaModel->key = $key;
                    $metaModel->value = $value;
                    $metaModel->user_id = $id;
                    $metaModel->save();
                }
            }
        }
        return back();
    }
    public function uploadProfile(Request $request ){

        $destination_path = upload_path('user_profile_picture');

        $new_filename = generate_filename();
        $file_extension = '.'.$request->file('aione-dp')->getClientOriginalExtension();
        $complete_file_name = $new_filename.$file_extension;
        $uploadFile = $request->file('aione-dp')->move($destination_path, $complete_file_name);

        $image_resized = resize_image('50x50', $complete_file_name, $destination_path);
        $image_resized = resize_image('300x300', $complete_file_name, $destination_path);



        $parameters = request()->route()->parameters();
        if($request->user_id){
            $id = $request->user_id;
        }elseif(Auth::guard('admin')->check()){
            $id = Auth::guard('admin')->user()->id;
        }elseif(Auth::guard('org')->check()){
            $id = Auth::guard('org')->user()->id;
        }
		
		

        $model = UM::firstOrNew(['key' => 'user_profile_picture','user_id' => $id]);
        $model->user_id  = $id; 
        $model->key      = "user_profile_picture"; 
        $model->value   = $complete_file_name;
        $model->type    = "";
        $model->save();

       
        return back();  
    }


    public function deleteProfilePicture($id)
    {
        $model = UM::where(['key' => 'user_profile_picture' , 'id' => $id])->delete();
        return back();
    }
    public function uploadimage($id , $file_name)
    {
        
        return back();
    }
    public function changePassword(Request $request)
    {
        $validate = [
                        'new_password'      => 'required|min:6',
                        'confirm_password'  => 'required|same:new_password|min:6'
                    ];
        $this->validate($request , $validate);
        $model = US::where('id',$request->id)->update(['password' => Hash::make($request->new_password)]);

        if($model){
            Session::flash('success-password' , 'Password change successfully');
            return back();
        }
    }
    public function listProjects($id = null)
    {
        dd($id);
        if($id == null){
            if(Auth::guard('admin')->user() != null){
                $id = Auth::guard('admin')->user()->id;
            }else{
                $id = Auth::guard('org')->user()->id;
            }
            $model = ProjectMeta::where(['key'=>'teams'])->get();
            dd($model);
        }else{
            // $model = ProjectMeta::where(['key' => ])
        }
        return view('organization.profile.projects');
    }
    public function dashboards(Request $request)
    {
        if(Auth::guard('admin')->user() != null){
            $id = Auth::guard('admin')->user()->id;
        }else{
            $id = Auth::guard('org')->user()->id;
        }
        $model = UM::where(['user_id'=>$id,'key'=>'dashboards'])->first();
        
        if(array_key_exists($request->slug , json_decode($model->value))){
            Session::flash('error' , 'Slug Already Exists');
        }else{
            if($model != null){
                $storedDashboards = json_decode($model->value);
                $slug = $request->slug;
                $storedDashboards->$slug = ['title'=>$request->title,'description'=>$request->description ,'slug' => $request->slug];
                $model->user_id = $id;
                $model->key = 'dashboards';
                $model->value = json_encode($storedDashboards);
                $model->save();
            }else{
                $storedDashboards[$request->slug] = ['title'=>$request->title,'description'=>$request->description ,'slug' => $request->slug];
                $model = new UM;
                $model->user_id = $id;
                $model->key = 'dashboards';
                $model->value = json_encode($storedDashboards);
                $model->save();
            }
        }
        
        return back();
    }
}