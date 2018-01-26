<?php
namespace App\Http\Controllers\Organization\Auth;
// use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Model\Group\GroupUsers;
use App\Model\Organization\User;
use Illuminate\Http\Request;
use Session;
use Hash;
use App\Model\Organization\UserRoleMapping;
use App\Model\Organization\UsersRole;
use App\Model\Admin\GlobalOrganization;
use Mail;
use App\Mail\userRegister;
use App\Model\Organization\OrganizationSetting;
use App\Model\Organization\PasswordReset;
use App\Mail\UserRegisterEmail;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;
    /**
    * Where to redirect users after registration.
    *
    * @var string
    */
    protected $redirectTo = '/home';

    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
    * Get a validator for an incoming registration request.
    *
    * @param  array  $data
    * @return \Illuminate\Contracts\Validation\Validator
    */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }


    /**
    * Create a new user instance after a valid registration.
    *
    * @param  array  $data
    * @return User
    */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function testTemplate(){
        return view('organization.emails.user_register_email');
    }

    protected function createNewGroupUser($request){
        $groupUserModel = new GroupUsers;
        $groupUserModel->name = $request->name;
        $groupUserModel->email = $request->email;
        $groupUserModel->status = 0;
        $groupUserModel->save();
        return $groupUserModel->id;
    }

    protected function validateRegisterForm($request){
        $rules = [
                'name' => 'required',
                'email' => 'required'
        ];

        $this->validate($request,$rules);
    }

    protected function putUser($details){
        $userModel = new User();
        $userModel->user_id = $details['user_id'];
        $userModel->save();
    }

    protected function putRole($details){
        $userRoleModel = new UserRoleMapping;
        $userRoleModel->user_id = $details['user_id'];
        $userRoleModel->role_id = $details['role'];
        $userRoleModel->save();
    }

    protected function putUserMeta($reqeust, $user_id){

        update_user_metas($reqeust, $user_id, true);
    }

    protected function sendEmailsToUsers($users){

    }

    protected function sendEmailToRegisteredUser($request, $existing){
        $ceratePasswordToken = str_random(64);
        if(!$existing){
            $passwordReset = new PasswordReset;
            $passwordReset->email = $request->email;
            $passwordReset->token = $ceratePasswordToken;
            $passwordReset->save();
            $details['email'] = $request->email;
            $details['token'] = $ceratePasswordToken;
            $details['existing'] = false;
            Mail::to($request->email)->send(new userRegister($details))->compileShortcodes();
        }else{
            $details['email'] = $request->email;
            $details['token'] = null;
            $details['existing'] = true;
            Mail::to($request->email)->send(new userRegister($details))->compileShortcodes();
        }
    }

    protected function sendNewUserEmaiToAdmin(){

    }

    protected function setGroupId(){
        $globalOrganization = GlobalOrganization::find(get_organization_id());
        Session::put('group_id',$globalOrganization->group_id);
    }


    public function userRegister(Request $request, $role = null)
    {   
        $this->setGroupId();
        $this->validateRegisterForm($request);
        $organizationMeta = get_organization_meta();
        $existingUser = false;
        if($request->isMethod('post')){
            $model = GroupUsers::where(['email'=>$request->email])->first();
            if($model == null){
                $groupUserId = $this->createNewGroupUser($request);
            }else{
                $existingUser = true;
                $groupUserId = $model->id;
            }
            if($organizationMeta->has('user_role_default')){
                $userRole = $organizationMeta['user_role_default'];
            }else{
                $userRole = 7;
            }
            if($existingUser){
                $userModel = User::where(['user_id'=>$groupUserId])->with(['user_role_map'])->first();
                $roles = $userModel->user_role_map->pluck('role_id')->toArray();
                if(in_array($userRole, $roles)){ // in case if same email id and same user role already exists in user table
                    Session::flash('error','Email id with same role already exists!');
                    return back();
                }else{
                    $details['user_id'] = $groupUserId;
                    $details['role'] = $userRole;
                    $putUserInUserstable = $this->putUser($details);
                    $putUserRoleInRoletable = $this->putRole($details);
                }
            }else{
                $details['user_id'] = $groupUserId;
                $details['role'] = $userRole;
                $putUserInUserstable = $this->putUser($details);
                $putUserRoleInRoletable = $this->putRole($details);
            }
            $userDataForMeta = $request->except(['name','email']);
            $this->putUserMeta($userDataForMeta,$groupUserId);

            // Send Email to Admin and User
            $this->sendEmailToRegisteredUser($request,$existingUser);


            // Email Work
            /*if($organizationMeta->has('user_registration_admin_notification_status') && 
                    $organizationMeta['user_registration_admin_notification_status'] == 1 ||
                    $organizationMeta['user_registration_admin_notification_status'] == '1'){


            }*/






            dd('Last');
            if(count($model) > 0){
                Session::flash('error','Email already exist');
                return back();
            }else{
                $rules = ['name' => 'required', 'email' =>  'required|email', 'password' => 'required|min:8', 'confirm_password'=>'required|same:password'];
                $this->validate($request,$rules);
                $user = new org_user;
                $user->fill($request->only('name','email'));
                // $user->password = Hash::make($request->password);
                // $user->app_password = $request->password;
                $user->status = 0; // by default user will not approve 
                $user->deleted_at = 0;
                $user->save();
                $user_id = $user->id;
                $org_user =  new User();
                $org_user->user_id =  $user_id;
                $org_user->save();
                $meta_data = $request->except('name','email','password','confirm-password','_token','confirm_password','role_id');
                if(!empty($meta_data) && !empty($user_id)){
                    update_user_metas($meta_data, $user_id, true);
                }

                if(!$request->has('role')){
                    $request['role'] = 2;
                }
                // $organizationMeta = get_organization_meta();
                $roleMapping = new UserRoleMapping;
                $roleMapping->user_id = $user_id;
                $roleMapping->role_id = $request->role;
                $roleMapping->status = 1;
                $roleMapping->save();
            }

            Session::put('new_user_register_email',$request->email);
            Session::put('new_user_register_name',$request->name);
            $check_notification_status = OrganizationSetting::where('key' , 'user_registration_admin_notification_status')->first();
            if($check_notification_status != null){
                if($check_notification_status->value == 1){
                    $roles = json_decode(get_organization_meta('user_registration_admin_notification_roles',true));
                    $users = json_decode(get_organization_meta('user_registration_admin_notification_users',true));
                    $usresListId = [];
                    $user_id = [];
                    if($users != null){
                        foreach ($users as $key => $value) {
                            $usresListId[] = (int)$value;
                        }
                    }
                    if($roles != null){
                        $listAdmin = UserRoleMapping::select('user_id')->whereIn('role_id',$roles)->get()->toArray();
                        foreach ($listAdmin as $key => $value) {
                            $user_id[] = $value['user_id'];
                        }
                    }
                    $usersId = array_unique(array_merge($usresListId,$user_id));;
                    foreach($usersId as $k => $v){
                        $emails = org_user::select('email')->where('id',$v)->get()->toArray()[0]['email'];
                        Mail::to($emails)->send(new userRegister);
                    }
                }
            }
            // Mail::to($to_email)->send(new userRegister);
            Session::flash('success','Successfully SignUp !! you will able to login once admin Approve your account');
            return back();
        }
        $userRegStatus = get_organization_meta('enableuserregisteration');
        if($userRegStatus != 'no'){
            return view('organization.login.signup');
        }else{
            return view('errors.404');
        }
    }
}