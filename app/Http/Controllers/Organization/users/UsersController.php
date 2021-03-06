<?php
namespace App\Http\Controllers\Organization\users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Hash;
use Session;
use Mail;
use App\Model\Group\GroupUsers as org_user;
use App\Model\Organization\UserRoleMapping;
use App\Model\Organization\UsersRole;
use App\Model\Group\GroupUserMeta;
use App\Model\Organization\Client;
use App\Model\Organization\User;
use App\Model\Organization\OrganizationSetting;
use App\Model\Organization\forms as Forms;
use App\Model\Organization\FormBuilder;
use App\Mail\userApprove;
class UsersController extends Controller
{
    /**
    * undocumented function
    *
    * @return create user page
    * @author sandip
    **/
    public function createUser(){
        $form_slug = null;
        $additionalForm = OrganizationSetting::where(['key'=>'user_profile_form'])->first();
        if($additionalForm != null){
            $additionalForm = Forms::find($additionalForm->value);
            if($additionalForm != null){
                $form_slug = $additionalForm->form_slug;
            }
        }
        return view('organization.user.add',['form_slug'=>$form_slug]);
    }

    
    /**
    * undocumented function
    *
    * @return store a new user
    * @author sandip
    **/
    public function store(Request $request)
    {

        $emailValidate = [
            'email'      => 'required|email',
            'role' => 'required',
            'password' => 'required|string|min:8|max:30|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'
        ];
        $this->validate($request , $emailValidate,['password.regex'=>'Password contain at least one number, one special character and one upper case character!']);
        $model = org_user::where(['email'=>$request->email])->first();
        if($model != null){
            foreach($request->role as $key => $role){
                $userRoleMapping = UserRoleMapping::where('user_id',$model->id)->where('role_id',$role)->first();
                if($userRoleMapping == null){
                    $userRole = UsersRole::find($role);
                    $userSlug = $userRole->slug;
                    $org_user =  new User();
                    $org_user->user_id =  $model->id;
                    $org_user->user_type = $userSlug;
                    $org_user->status = 1;
                    $org_user->save();
                }else{
                    Session::flash('error','User with same role already exists!');
                    return back();
                }
            }
            $user_id = $model->id;
        }else{
            $rules = ['name' => 'required', 'email' =>  'required|email', 'password' => 'required|min:8', 'confirm_password'=>'required|same:password'];
            $user = org_user::createUser($request->toArray());
            $user_id = $user->id;
            $org_user =  new User();
            $org_user->user_id =  $user_id;
            $org_user->save();
        }
        if(isset($request['role'])){
            if(is_array($request->role)){
                foreach($request->role as $key => $role){
                    $roleMapping = new UserRoleMapping;
                    $roleMapping->user_id = $user_id;
                    $roleMapping->role_id = (int) $role;
                    $roleMapping->status = 1;
                    $roleMapping->save();
                }
            }else{
                $roleMapping = new UserRoleMapping;
                $roleMapping->user_id = $user_id;
                $roleMapping->role_id = (int) $request['role'];
                $roleMapping->status = 1;
                $roleMapping->save();
            }
        }
        $meta_data = $request->except('name','email','password','confirm-password','_token','confirm_password','role');
        if(!empty($meta_data) && !empty($user_id)){
            update_user_metas($meta_data, $user_id, true);
        }
        Session::flash('success' , 'User Created Successfully');
        return redirect()->route('list.user');
    }


    /**
    * undocumented function
    *
    * @return list users
    * @author sandip
    **/
    public function index(Request $request)
    {
        $datalist = [];
        if($request->has('items')){
            $perPage = $request->items;
            if($perPage == 'all'){
                $perPage = 999999999999999;
            }
        }else{
            $perPage = get_items_per_page();
        }
        $sortedBy = @$request->orderby;
        $order = $request->order;
        if($request->orderby == null || $request->orderby == ''){
            $sortedBy = 'created_at';
            $order = 'desc';
        }
        if($request->has('search')){
            if($sortedBy != ''){
                $model = org_user::where('deleted_at',0)->where('id','!=',Auth::guard('org')->user()->id)->where('name','like','%'.$request->search.'%')->with(['user_role_rel','userType','groupUser'])->has('organization_user')->orderBy($sortedBy,$order)->paginate($perPage);
            }else{
                $model = org_user::where('deleted_at',0)->where('id','!=',Auth::guard('org')->user()->id)->where('name','like','%'.$request->search.'%')->with(['user_role_rel','userType','groupUser'])->has('organization_user')->paginate($perPage);
            }
        }else{
            if($sortedBy != '' && $sortedBy != 'role'){
                /*$model = org_user::where('deleted_at',0)->where('id' , '!=' , Auth::guard('org')->user()->id)->orderBy($sortedBy,$order)->with(['user_role_rel'=>function($query){
                    $query->with('roles');
                },'userType','organization_user'])->has('organization_user')->paginate($perPage);*/
                $model = org_user::where('deleted_at',0)->where('id' , '!=' , Auth::guard('org')->user()->id)->orderBy($sortedBy,$order)->paginate($perPage);
            }else{
                /*$model = org_user::where('deleted_at',0)->where('id' , '!=' , Auth::guard('org')->user()->id)->with(['user_role_rel'=>function($query){
                    $query->with('roles');
                },'userType','organization_user'])->has('organization_user')->paginate($perPage);*/
                $model = org_user::where('deleted_at',0)->where('id' , '!=' , Auth::guard('org')->user()->id)->paginate($perPage);
            }
        }
        // dd($model);
        /* by sandeep */
        /*foreach($model as $k => &$v){
            $v->status = $v->organization_user->status;
            $roleName = [];
            foreach ($v->user_role_rel->toArray() as $key => $value) {
                $roleName[] = $value['roles']['name'];
            }
            $v->role = json_encode($roleName);
            $processRole = str_replace(['["','"]'], '', $v->role);
            $v->role = str_replace(['","'], ',', $processRole);
        }*/
        /* by sandeep */
        $datalist =  [
            'datalist'=>$model,
            'showColumns' => ['name'=>'Title','email'=>'Email','role' => 'User Role','status' => 'Status'],
            'actions' => [
                'view'   => ['title'=>'View','route'=>'user.view','class'=>'view'],
                'edit'   => ['title'=>'Edit','route'=>'user.details','class'=>'edit'],
                'delete' => ['title'=>'Delete','route'=>'delete.user'],
                'change_pass'  => ['title'=>'Change Password','route' => 'changepass.user'],
                'status_option'  =>  ['title'=>'status option','class'=>'status_option' ,'route' =>'change.user.status']
            ]
        ];
        return view('organization.user.list',$datalist);
    }


    /**
    * undocumented function
    *  
    * @return the userdetails
    * @edited sandip,rahul
    **/
    public function userView($id = null)
    {
        if($id == null){
            $id = Auth::guard('org')->user()->id;
        }else{
            $model = org_user::where('id',$id)->first()->toArray();
            $id = $model['id'];
        }
        $userDetails = org_user::select(['id','name','email'])->with(['metas','applicant_rel','user_role_rel'])->find($id);
        $userMeta = get_user_meta($id,null,true);
        $role_data = $userDetails->metas->where('key','role')->first();
        if($role_data == ''){
            foreach($userDetails->user_role_rel as $k => $v){
                if(array_key_exists('role_id', $v->toArray())){
                    $userDetails['role'] = $v['role_id'];
                }
            }
            // $role_id = $userDetails::where()
        }else{
            $userDetails['role'] = $role_data->value;
        }
        $newData = [];
        $newData = org_user::select('name','email','app_password')->where('id',$id)->first()->toArray();
        $additionalForm = OrganizationSetting::where(['key'=>'user_profile_form'])->first();
        if($additionalForm != null){
            $additionalForm = Forms::with(['section'])->find($additionalForm->value);
            if($additionalForm != null){
                $form_slug = $additionalForm->form_slug;
                $form_id = $additionalForm['id'];
                $section_id = $additionalForm->section[0]['id'];
                $fields = FormBuilder::where(['form_id' => $form_id,'section_id'=> $section_id])->get();
                foreach ($fields as $key => $field) {
                    $field_key = $field->field_slug;
                    $user_meta = get_user_meta($id,$field_key,true);
                    $field_title = $field->field_title;
                    $field_type = $field->field_type;
                    if(!empty($user_meta)){
                        if($field_type == 'radio'){
                            $field_options = field_options($field->field_slug , $id= null);
                            $userDetails[$field_title] = $field_options[$user_meta];
                        } else {
                            $userDetails[$field_title] = $user_meta;
                        }
                    }
                }
            }else{
                $userDetails = $userDetails; 
            }
            foreach ($userDetails->toArray() as $key => $value) {
                if(!is_array($value)){
                    json_decode($value);
                    if (json_last_error() === JSON_ERROR_NONE){
                        if(is_array( json_decode($value) )){
                            $array_field = $fields->where('field_title',$key)->first();
                            if($array_field != null){
                                $array_field_slug = $array_field->field_slug;
                                $array_field_options = field_options($array_field_slug);
                                foreach (json_decode($value) as $ke => $val) {
                                    if(array_key_exists($val, $array_field_options)){
                                        $newData[$key][] = $array_field_options[$val];
                                    }
                                }
                            }
                            // $newData[$key] = json_decode($value);
                        }else{
                            $newData[$key] = $value;
                        }
                    }else{
                        $newData[$key] = $value;
                    }
                }else{
                    $newData[$key] = $value;
                }
            }
        }
        return view('organization.user.view',['model' => $newData]);
        // return view('organization.user.preview',['model' => $userDetails , 'user_log' => $user_log]);
    }


    /**
    * To edit user details
    * @param  [type] $id having user id
    * @return [type]     return view
    */
    public function userDetails($id = null){   
        if($id == null){
            $id = get_user_id();
        }
        $form_slug = null;
        $additionalForm = OrganizationSetting::where(['key'=>'user_profile_form'])->first();
        if($additionalForm != null){
            $additionalForm = Forms::find($additionalForm->value);
            if($additionalForm != null){
                $form_slug = $additionalForm->form_slug;
            }
        }
        $model = org_user::with(['user_role_rel','metas','organization_user'])->find($id);
        
        if(!empty($model)){
            foreach($model->metas as $k => $v){
                $model[$v->key] = $v->value;
            }
            //For Meta
            foreach($model->metas as $key => $meta) {
                $model[$meta->key] = $meta->value;
            }
            //For User Relations
            $relationsArray = [];
            foreach ($model->user_role_rel as $rel_key => $rel_value) {
                $userRoleModel = UsersRole::find($rel_value->role_id);
                $relationsArray[] = $userRoleModel->slug;
            }
            $model['role'] = $relationsArray;
        }else{
            $newData =[];
            Session::flash('error',__('messages.data_not_found'));
        }
        $model['user_type'] = $model->organization_user->user_type;
        return view('organization.user.edit',['model' => $model,'form_slug'=>$form_slug]);
    }


    /**
    * undocumented function
    *
    * @return view of the change password
    * @author sandip
    **/
    public function changePass()
    {
        return view('organization.user.change-password');
    }


    /**
    * undocumented function
    *
    * @return update password
    * @author sandip
    **/
    public function changePassword(Request $request)
    { 
        $model = org_user::where('id',$request->user_id)->first();
        $check = Hash::check( Hash::make($request->password) , $model->password);
        $validate = [
            'new_password'      => 'required|string|min:8|max:30|regex:/^(?=.*?[A-Z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'confirm_password'  => 'required|same:new_password|min:8'
        ];
        $this->validate($request , $validate,['password.regex'=>'Password contain at least one number, one special character and one upper case character!']);
        $model = org_user::where('id',$request->user_id)->update(['password' => Hash::make($request->new_password) , 'app_password' => $request->new_password]);
        if($model){
            Session::flash('success','Password Change Successfully');
            return back();
        }
    }

    /**
    * undocumented function
    *
    * @return void
    * @author sandip
    **/
    public function updateUserDetails(Request $request, $id)
    {
        $emailValidate = [
            // 'name'       => 'required',
            'email'      => 'required|email',
        ];
        $this->validate($request , $emailValidate);
        $model = org_user::find($id);
        $model->name = $request->name;
        $model->email = $request->email;
        if($request->has('user_type')){
            $userModel = User::where(['user_id'=>$id])->update(['user_type'=>$request->user_type]);
        }
        // $model->user_type = 'employee';
        $model->save();
        $notToDeleteIds = [];
        $currentStoredRoles = UserRoleMapping::where(['user_id'=>$id])->pluck('role_id')->toArray();
        if($request->has('role')){
            $newSelectedRoles = array_map('intval',$request->role);
            $this->deleteFromRelatedTables($currentStoredRoles, $newSelectedRoles, $id);
            foreach($request->role as $key => $role){
                $model = UsersRole::where('slug',$role)->first();
                if($model->slug == 'employee'){
                    $usersMeta = new GroupUserMeta;
                    $usersMeta->key = 'joining_date';
                    $usersMeta->value = date('Y-m-d');
                    $usersMeta->save();
                }
                if($model->slug == 'client'){
                    $this->createClient($id, $request->name);
                }
                $mappingModel = UserRoleMapping::firstOrNew(['user_id'=>$id,'role_id'=>$role]);
                $mappingModel->user_id = $id;
                $mappingModel->role_id = $role;
                $mappingModel->status = 1;
                $mappingModel->save();
                $notToDeleteIds[] = $mappingModel->id;
            }
            foreach($request->role as $key => $role){
                $model = UsersRole::where('slug',$role)->first();
                if($model->slug == 'employee'){
                    $usersMeta = new GroupUserMeta;
                    $usersMeta->key = 'joining_date';
                    $usersMeta->value = date('Y-m-d');
                    $usersMeta->save();
                }
                if($model->slug == 'client'){
                    $this->createClient($id, $request->name);
                }
                $mappingModel = UserRoleMapping::firstOrNew(['user_id'=>$id,'role_id'=>$role]);
                $mappingModel->user_id = $id;
                $mappingModel->role_id = $model->id;
                $mappingModel->status = 1;
                $mappingModel->save();
                $notToDeleteIds[] = $mappingModel->id;
            }
        }
        $meta_data = $request->except('name','email','password','confirm-password','_token','confirm_password','role_id');
        if(!empty($meta_data) && !empty($id)){
            update_user_metas($meta_data, $id, true);
        }
        UserRoleMapping::whereNotIn('id',$notToDeleteIds)->where('user_id',$id)->delete();
        return back();
    }

    protected function deleteFromRelatedTables($currentStoredRoles, $newSelectedRoles, $userId){
        $roleToRemove = array_diff($currentStoredRoles, $newSelectedRoles);
        if(!empty($roleToRemove)){
            foreach($roleToRemove as $key => $role){
                $role = UsersRole::find($role);
                if($role->slug == 'employee'){
                    Employee::where(['user_id'=>$userId])->delete();
                }
                if($role->slug == 'client'){
                    Client::where(['user_id'=>$userId])->delete();
                }
            }
        }
    }

    /**
    * undocumented function
    *
    * @return void
    * @author 
    **/
    protected function createClient($userid, $name){
        $client = Client::where(['user_id'=>$userid])->first();
        if($client == null){
            $client = new Client;
            $client->name = $name;
            $client->user_id = $userid;
            $client->save();
        }
    }

    /**
    * undocumented function
    *
    * @return void
    * @author 
    **/
    public function changeStatus($id)
    {
        $model = User::where('user_id',$id)->first();
        if($model['status'] == 0){
            User::where('user_id',$id)->update(['status' => 1]);
            $user_notification_status = get_organization_meta('user_notification_status');
            if(@$user_notification_status == 1){
                $emails = org_user::select('email')->where('id',$id)->get()->toArray()[0]['email'];
                Session::push('approveUser' , $emails);
                Mail::to($emails)->send(new userApprove);
            }
        }else{
            User::where('user_id',$id)->update(['status' => 0]);
        }
        return back();
    }

    /**
    * undocumented function
    *
    * @return void
    * @author 
    **/
    public function deleteUser ($id)
    {
        $model = org_user::where('id',$id)->delete();
        UserRoleMapping::where('user_id',$id)->delete();
        User::where('user_id',$id)->delete();
        return back();
    }

    public function UserMetaUpdate(Request $request){
        if(Auth::guard('org')->check()){
            $model = GroupUserMeta::firstOrNew(['user_id'=>Auth::guard('org')->user()->id,'key'=>'layout_sidebar_small']);
            $model->user_id = Auth::guard('org')->user()->id;
        }
        if(Auth::guard('group')->check()){
            $model = GroupUserMeta::firstOrNew(['user_id'=>Auth::guard('group')->user()->id,'key'=>'layout_sidebar_small']);
            $model->user_id = Auth::guard('group')->user()->id;
        }
        // if(Auth::guard('admin')->check()){
        //   dd(Auth::guard('admin')->user()->id);
        //   $model = GroupUserMeta::firstOrNew(['user_id'=>Auth::guard('admin')->user()->id,'key'=>'layout_sidebar_small']);
        //   $model->user_id = Auth::guard('admin')->user()->id;
        // }
        $model->key = 'layout_sidebar_small';
        $model->value = $request->layout_sidebar_small;
        $model->save();
    }


    protected function validateProfileUpdateRequest($request){
        
        if($request->has('name') && $request->has('email') && $request->has('userid') && $request->has('activation_code')){
            return true;
        }else{
            return false;
        }
    }

    public function updateAppProfile(Request $request){
        $validate = $this->validateProfileUpdateRequest($request);
        if($validate){
            
        }else{
            return response()->json(['status'=>'error','message'=>'Required fields are missing!']);
        }
    }
}
