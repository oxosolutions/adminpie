<?php

namespace App\Http\Controllers\Organization\account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Model\Group\GroupUsers as User;
use Hash;
use Carbon\Carbon;
use App\Model\Organization\Employee;
use App\Model\Group\GroupUsers as US;
use App\Model\Organization\UsersMeta as UM;
use App\Model\Organization\LogSystem as LS;
use App\Model\Organization\Project;
use App\Model\Organization\ProjectMeta;
use Session;
use Image;
use App\Model\Group\GroupUserMeta;
use App\Model\Organization\Campaign;
use App\Model\Organization\EmailLayout;
use App\Model\Organization\EmailTemplate;
use App\Model\Organization\UserRoleMapping;
use App\Model\Organization\Document;
use App\Model\Organization\AssignDocument;
use App\Http\Controllers\Organization\settings\SettingsController;
use App\Model\Organization\User as EMP;
use App\Model\Organization\Category;

class AccountController extends Controller
{
     public function emailsList(Request $request, $id = null){

        $search = $this->saveSearch($request);
        can_i_access_this_user($id);
        if($search != false && is_array($search)){
            $request->request->add(['items'=>@$search['items'],'orderby'=>@$search['orderby'],'order'=>@$search['order']]);
        }
        $datalist= [];
        $data= [];
          if($request->has('items')){
                $perPage = $request->items;
                if($perPage == 'all'){
                  $perPage = 999999999999999;
                }
              }else{
                $perPage = get_items_per_page();;
              }
          $sortedBy = @$request->orderby;
          if($id == null){
            $userid = get_user_id();
            return redirect()->route('account.emails',$userid);
          }else{
            $userid = $id;
          }
          if($request->has('search')){
              if($sortedBy != ''){
                  $model = Campaign::where('campaign_name','like','%'.$request->search.'%')->where('send_to_users','like','%'.$userid.'%')->orderBy($sortedBy,$request->order)->paginate($perPage);
              }else{
                  $model = Campaign::where('campaign_name','like','%'.$request->search.'%')->where('send_to_users','like','%'.$userid.'%')->paginate($perPage);
              }
          }else{
              if($sortedBy != ''){
                  $model = Campaign::orderBy($sortedBy,$request->order)->where('send_to_users','like','%'.$userid.'%')->paginate($perPage);
              }else{
                   $model = Campaign::where('send_to_users','like','%'.$userid.'%')->paginate($perPage);
              }
          }
          $datalist =  [
                          'datalist'=>  $model,
                          'showColumns' => ['campaign_name'=>'Name','created_at'=>'Created'],
                          'actions' => [
                                          'edit' => ['title'=>'View Details','route'=>'account.emails.view' , 'class' => 'edit'],
                                          'delete'=>['title'=>'Delete','route'=>'delete.email']
                                       ],
                          'js'  =>  ['custom'=>['list-designation']],
                          'css'=> ['custom'=>['list-designation']]
                      ];
        return view('organization.profile.email',$datalist);
    }

    public function emailDetails($id){

        $model = Campaign::find($id);
        $data['layout'] = EmailLayout::find($model->layout);
        $data['template'] = EmailTemplate::find($model->template);
        return view('organization.profile.view_email',$data);
    }
    public function profileView($id = null)
    {
        $user_log = $this->listActivities();
        if($id == null){
            $id = Auth::guard('org')->user()->id;
        }
        $userDetails = User::with(['metas','applicant_rel','client_rel','user_role_rel'])->find($id);
        $userMeta = get_user_meta($id,null,true);

        $userDetails->password = '';
        if($userMeta != false){
            @$userDetails->employee_id = (array_key_exists('employee_id',$userMeta))?$userMeta['employee_id']:'';
            @$userDetails->department = (array_key_exists('department',$userMeta))?$userMeta['department']:'';
            $userDetails->designation = (array_key_exists('designation',$userMeta))?$userMeta['designation']:'';
            
            @$userDetails->marital_status = (array_key_exists('marital_status',$userMeta))?$userMeta['marital_status']:'';
            @$userDetails->date_of_joining = (array_key_exists('joining_date',$userMeta))?Carbon::parse($userMeta['joining_date'])->format('Y-m-d'):'';
        }
        if(!$userDetails->metas->isEmpty()){
            foreach($userDetails->metas as $key => $value){
                $userDetails->{$value->key} = $value->value;
            }
        }
        return view('organization.profile.preview',['model' => $userDetails , 'user_log' => $user_log]);
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
        if($id == null){
             $id = current_organization_user_id();
             return redirect()->route('account.profile',$id);
        }
        can_i_access_this_user($id);
        $user_log = $this->listActivities();
    	if($id == null){
    		$id = Auth::guard('org')->user()->id;
    	}
        $userDetails = User::with(['applicant_rel','user_role_rel'])->find($id);
        if($userDetails != null){
            $userMeta = get_user_meta($id,null,true);
            if(!empty($userMeta['leave_category'])){
            $cat = Category::WhereIn('id',json_decode($userMeta['leave_category'], true))->pluck('name','id');
            $leave_category_with_name =   $cat->implode(', ', $cat);
            $leave_category   = json_decode($userMeta['leave_category'],true); 
            }
            if($userDetails != null){
                $userDetails->password = '';
                if($userMeta != false){
                    @$userDetails->employee_id = (array_key_exists('employee_id',$userMeta))?$userMeta['employee_id']:'';
                    @$userDetails->department = (array_key_exists('department',$userMeta))?$userMeta['department']:'';
                    @$userDetails->designation = (array_key_exists('designation',$userMeta))?$userMeta['designation']:'';
                    @$userDetails->user_shift = (array_key_exists('user_shift',$userMeta))?$userMeta['user_shift']:'';
                    @$userDetails->pay_scale = (array_key_exists('pay_scale',$userMeta))?$userMeta['pay_scale']:'';
                    @$userDetails->marital_status = (array_key_exists('marital_status',$userMeta))?$userMeta['marital_status']:'';
                    @$userDetails->date_of_joining = (array_key_exists('date_of_joining',$userMeta))?Carbon::parse($userMeta['date_of_joining'])->format('Y-m-d'):'';
                    @$userDetails->leave_category = (array_key_exists('leave_category',$userMeta))?@$leave_category:''; 
                    @$userDetails->leave_category_name = (array_key_exists('leave_category',$userMeta))?@$leave_category_with_name:'';
                }
                if(!$userDetails->metas->isEmpty()){
                    foreach($userDetails->metas as $key => $value){
                        if(!in_array($value->key , ['email','leave_category'])){
                            $userDetails->{$value->key} = $value->value;
                        }
                    }
                }
            }
            return view('organization.profile.view',['model' => $userDetails , 'user_log' => $user_log]);
        }else{
            Session::flash('error','Something went wrong!');
            return redirect()->route('org.dashboard');
        }
    }

    /**
     * To update user details
     * @param  Request $request contains post requests data
     * @param  $id  user id which one we have to update
     * @return back function to go back the previous page
     */
    public function update(Request $request, $id){
        $tbl = get_organization_id();
        $data = User::where('id',$id)->first();
        if($data->id == $id){
            if($data->email == $request->email){
                    $valid_fields = [
                                  'email' => 'required|email'
                                ];
                    $this->validate($request , $valid_fields) ;
            }else{
                $valid_fields = [
                                  'email' => 'required|email|unique:'.$tbl.'_users'
                                ];
                $this->validate($request , $valid_fields) ;
            }
        }
        $userDetails = User::find($id);
        if($request->password != null && $request->password != ''){
            $userDetails->password = Hash::make($request->password);
        }
        $userDetails->name = $request->name;
        $userDetails->app_password = $request->password;
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
                            '_method','_token','action','empId'
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
            unset($request_data['meta_table']);
            $tbl = get_organization_id();

            /*$data = Employee::where(['user_id' => $id])->first();
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
            }*/
            
            foreach($request_data as $key => $value){
                if($value != null && $value != ''){
                    if(is_array($value)){
                        $value = json_encode($value);
                    }
                    if($key == 'leave_category'){
                        // dump($value);
                        // $employeeModel = Employee::where('user_id',$id)->update(['designation' => $value]);
                    }
                    /*if($key == 'designation'){
                        $employeeModel = Employee::where('user_id',$id)->update(['designation' => $value]);
                    }
                    if($key == 'department'){
                        $employeeModel = Employee::where('user_id',$id)->update(['department' => $value]);
                    }
                    
                    if($key == 'date_of_joining'){
                        $employeeModel = Employee::where('user_id',$id)->update(['joining_date' => $value]);
                    }
                    if($key == 'date_of_leaving'){
                        $employeeModel = Employee::where('user_id',$id)->update(['leaving_date' => $value]);
                    }*/
                    if($key == 'employee_id'){
                        $metaModel = UM::where(['key'=>$key,'value' => $value])->where('user_id','!=',$id)->first();
                        if($metaModel != null){
                            Session::flash('error',"Employee Id Already exists");
                            return back();
                        }else{
                            $metaModel = UM::firstOrNew(['key'=>$key,'user_id'=>$id]);
                            $metaModel->key = $key;
                            $metaModel->value = $value;
                            $metaModel->user_id = $id;
                            $metaModel->save();
                        }
                    }else{
                       
                        $metaModel = UM::firstOrNew(['key'=>$key,'user_id'=>$id]);
                        $metaModel->key = $key;
                        $metaModel->value = $value;
                        $metaModel->user_id = $id;
                        $metaModel->save();
                    }
                }
            }
        }
        // dd($request->all());
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
        // $model = GroupUserMeta::firstOrNew(['key' => 'user_profile_picture','user_id' => $id]);
        $model->user_id  = $id; 
        $model->key      = "user_profile_picture"; 
        $model->value   = $complete_file_name;
        // $model->type    = "";
        $model->save();

       
        return back();  
    }

    /************************************************************
    *   @function delete_user_profile_picture
    *   @description Delete User Profile Picture
    *   @access public
    *   @since  1.0.0.0
    *   @author SGS Sandhu(sgssandhu.com)
    *   @perm id        [integer    optional    default null]
    *   @perm html      [true/false optional    default false]
    *   @return back 
    ************************************************************/
    public function delete_user_profile_picture($id){
        delete_user_meta('user_profile_picture', $id);
        return back();
    }

    
    public function checkExistingPassword(request $request)
    {
         $validate = [
                        'old_password'      => 'required',
                        'new_password'      => 'required|min:6',
                        'confirm_password'  => 'required|same:new_password|min:6'
                    ];
        $this->validate($request , $validate);
                    
        $model = US::where('id',get_user_id())->first();
        $password = $model->password;

        if(Hash::check($request->old_password , $password) ){
       

        $model = US::where('id',get_user_id())->update(['password' => Hash::make($request->new_password) , 'app_password' => $request->new_password]);
            if($model){
                Session::flash('success-password' , 'Password change successfully');
            }else{
                Session::flash('error-password' , 'Your Old Password is not correct');
            }
        }
        return back();
    }
    public function changePassword(Request $request)
    {
        $validate = [
                        'new_password'      => 'required|min:6',
                        'confirm_password'  => 'required|same:new_password|min:6'
                    ];

        $this->validate($request , $validate);
        $model = US::where('id',$request->id)->update(['password' => Hash::make($request->new_password) , 'app_password' => $request->new_password]);

        if($model){
            Session::flash('success-password' , 'Password change successfully');
        }
                    return back();

    }
    public function listProjects($id = null)
    {
        can_i_access_this_user($id);        
        if($id == null){
            $model = Project::with('projectMeta')->get();
        }else{
            $model = Project::with(['projectMeta'])->whereHas('projectMeta',function($query) use ($id){
                $query->where('key' , 'users')->where('value' , 'like' , '%'.$id.'%');
            })->get();
        }
        return view('organization.profile.projects',compact('model'));
    }

    protected function saveSearch($request){
        $search = $request->except(['page']);
        $model = UM::where(['key'=>$request->route()->uri,'user_id'=>Auth::guard('org')->user()->id])->first();
        if($model != null){
            if(!empty($request->except(['page']))){
              $model->value = json_encode($request->except(['page']));
              $model->save();
            }
            $savedSearch = json_decode($model->value, true);
            return $savedSearch;
        }else{
            $model = new UM;
            $model->user_id = Auth::guard('org')->user()->id;
            $model->key = $request->route()->uri;
            $model->value = json_encode(@$request->except(['page']));
            $model->save();
            return false;
        }
    }
    public function UserDocument($id = null)
    {   
        can_i_access_this_user($id);
        if($id == null){
            $id = get_user_id();
        }
        $assignedDocuments = AssignDocument::where(['user_id'=>$id])->pluck('document_id')->toArray();
        $documents = Document::whereIn('id',$assignedDocuments)->get();
        
        return view('organization.profile.document',compact('documents'));
    }
    public function DelDocument($id)
    {
        $delDocument = UM::where(['id' => $id , 'key' => 'document'])->delete();
        return back();
    }
    public function saveDiscussion(Request $request)
    {
    }
}