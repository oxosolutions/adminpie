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
use Shortcode;
use Auth;
use App\Model\Organization\EmailTemplate;
use App\Model\Organization\EmailLayout;
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
        $groupUserModel->status = 1;
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

    protected function putUser($details, $registerFrom){
        $userModel = new User();
        $userModel->user_id = $details['user_id'];
        $userModel->status = ($registerFrom == 'social')?1:0;
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
        /* Session::put('new_user_register_email',$request->email);
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
        }*/
    }

    protected function sendEmailToRegisteredUser($request, $existing){
        $templateAndLayout = $this->getEmailTemplateAndLayout();
        $ceratePasswordToken = str_random(64);
        if(!$existing){
            $passwordReset = new PasswordReset;
            $passwordReset->email = $request->email;
            $passwordReset->token = $ceratePasswordToken;
            $passwordReset->save();
            $details['email'] = $request->email;
            $details['token'] = $ceratePasswordToken;
            $details['existing'] = false;
            $this->registerShorcodes($request->email, false, $ceratePasswordToken);
            $rawData = view('organization.login.signup-email-template')->with([
                    'emailTemplate' => $templateAndLayout['template'],
                    'emailLayout' => $templateAndLayout['layout']]
            )->compileShortcodes()->render();

            Mail::send([],[], function($message) use ($rawData, $request, $templateAndLayout){
                $message->subject($templateAndLayout['template']['subject']);
                $message->from('oxosolutionsindia@gmail.com','Oxo Solutions');
                $message->setBody($rawData,'text/html');
                $message->to($request->email);
            });
        }else{
            $details['email'] = $request->email;
            $details['token'] = null;
            $details['existing'] = true;
            $this->registerShorcodes($request->email, true, $ceratePasswordToken);
            $rawData = view('organization.login.signup-email-template')->with([
                    'emailTemplate' => $templateAndLayout['template'],
                    'emailLayout' => $templateAndLayout['layout']]
            )->compileShortcodes()->render();
            Mail::send([],[], function($message) use ($rawData, $request, $templateAndLayout){
                $message->subject($templateAndLayout['template']['subject']);
                $message->from('oxosolutionsindia@gmail.com','Oxo Solutions');
                $message->setBody($rawData,'text/html');
                $message->to($request->email);
            });
        }
    }

    protected function registerShorcodes($registeredEmail, $existing, $token){
        Shortcode::add('organization_name', function($atts,$content,$name){
            $organizationMeta = get_organization_meta();
            if($organizationMeta->has('title') && $organizationMeta['title'] != ''){
                return $organizationMeta['title'];
            }else{
                return 'Un-titled';
            }
        });
        Shortcode::add('registered_email', function($atts,$content,$name) use ($registeredEmail){
            return $registeredEmail;
        });
        Shortcode::add('password_status', function($atts,$content,$name) use ($existing, $token){
            if($existing){
                return '<p>Note: You have already register with this organization, you can use the same password here.</p>';
            }else{
                return 'Create Password: <a href="'.route('create.password',$token).'">Click To Create Password</a>';
            }
            return $registeredEmail;
        });

    }

    protected function sendNewUserEmaiToAdmin($request){
        $userModel = User::with(['user_role_map'=>function($query){
            $query->where('role_id',1);
        }])->has('user_role_map')->first();
        $gropUserModel = GroupUsers::find($userModel->user_id);
        $gropUserModel->email;
        Mail::send([],[],function($message) use ($gropUserModel, $request){
            $message->to($gropUserModel->email)->subject('New user Registered!')
            ->from('oxosolutionsindia@gmail.com','Oxo Solutions')
            ->setBody('<h5>New User Registered with Email: '.$request->email.'</h5>','text/html');
        });
    }

    protected function setGroupId(){
        $globalOrganization = GlobalOrganization::find(get_organization_id());
        Session::put('group_id',$globalOrganization->group_id);
    }


    public function userRegister(Request $request, $role = null, $registerFrom = null)
    {   
        $this->setGroupId();
        $this->validateRegisterForm($request);
        $organizationMeta = get_organization_meta();
        $existingUser = false;
        if($request->isMethod('post')){
            $model = GroupUsers::where(['email'=>$request->email])->first();
            if($model == null){
                $groupUserId = $this->createNewGroupUser($request);
                // dd($groupUserId);
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
                $userModel = User::where(['user_id'=>$groupUserId,'user_type'=>null])->first();
                if($userModel != null){
                    if($registerFrom == 'social'){
                        return $groupUserId;
                    }else{
                        Session::flash('error','Email id already exists!');
                        return back();
                    }
                }else{
                    $details['user_id'] = $groupUserId;
                    $details['role'] = $userRole;
                    $putUserInUserstable = $this->putUser($details, $registerFrom);
                    $putUserRoleInRoletable = $this->putRole($details);
                }
            }else{
                $details['user_id'] = $groupUserId;
                $details['role'] = $userRole;
                $putUserInUserstable = $this->putUser($details, $registerFrom);
                $putUserRoleInRoletable = $this->putRole($details);
            }
            $userDataForMeta = $request->except(['name','email']);
            $this->putUserMeta($userDataForMeta,$groupUserId);

            // Send Email to Admin and User
            $this->sendEmailToRegisteredUser($request,$existingUser);

            $this->sendNewUserEmaiToAdmin($request);

            // Email Work
            /*if($organizationMeta->has('user_registration_admin_notification_status') && 
                    $organizationMeta['user_registration_admin_notification_status'] == 1 ||
                    $organizationMeta['user_registration_admin_notification_status'] == '1'){


            }*/
            if($registerFrom == 'social'){
                return $groupUserId;
            }
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

    protected function getEmailTemplateAndLayout(){
        $template_id = json_decode(get_organization_meta('user_registration_admin_notification_template',true));
        $emailTemplate = '';
        $emailLayout = '';
        $get_template = null;
        if($template_id != null && !empty($template_id) && $template_id != ''){
            $get_template = EmailTemplate::with(['templateMeta'])->where('id',$template_id)->first();
            $emailTemplate = $get_template->toArray();
        }
        if($get_template != null){
            if($get_template->templateMeta != null || !empty($get_template->templateMeta)){
                foreach ($get_template->templateMeta as $key => $value) {
                    if($value->key == 'layout'){
                        if($value->value != ''){
                            $emailLayout = EmailLayout::where('id',$value->value)->get()->toArray()[0];
                        }
                    }
                }
            }
        }
        return ['layout'=>$emailLayout,'template'=>$emailTemplate];
    }

    public function createPassword($token){
        $checkTokenExists = PasswordReset::where(['token'=>$token])->first();
        if($checkTokenExists == null){
            return redirect()->route('org.login');
        }
        return view('organization.login.reset-password',['from'=>'create_password']);
    }

    protected function validateCreatePassword($request){
        $rules = [
            'password' => 'required|confirmed|min:8'
        ];

        $this->validate($request,$rules);
    }

    public function saveCreatePassword(Request $request){
        $this->validateCreatePassword($request);
        $resetUser = PasswordReset::where(['token'=>$request->reset_create_token])->first();
        $this->setGroupId();
        $groupUserModel = GroupUsers::where(['email'=>$resetUser->email])->update(['password'=>Hash::make($request->password),'app_password'=>$request->password]);
        PasswordReset::where(['token'=>$request->reset_create_token])->delete();
        Session::flash('success','Password Created Successfully!');
        return redirect()->route('org.login');
    }
}