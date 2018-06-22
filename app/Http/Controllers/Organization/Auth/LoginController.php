<?php

namespace App\Http\Controllers\Organization\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Model\Organization\OrganizationSetting;
use App\Model\Organization\UserRoleMapping;
use App\Model\Organization\forms as Forms;
use App\Model\Organization\EmailTemplate;
use App\Model\Organization\PasswordReset;
use App\Model\Admin\GlobalOrganization;
use App\Model\Organization\EmailLayout;
use App\Http\Controllers\Controller;
use App\Model\Group\GroupUserMeta;
use App\Model\Organization\User;
use App\Model\Group\GroupUsers;
use App\Mail\forgetPassword;
use Illuminate\Http\Request;
use Shortcode;
use Socialite;
use Session;
use Route;
use Auth;
use Mail;
use Hash;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest.org', ['except' => 'logout']);
    }

    public function showLoginForm(Request $request, $id = null, $social_token = null){
        if($id != null && $id != 'null'){
            $organizationToken = GlobalOrganization::where('auth_login_token',$id)->first();
            if($organizationToken != null){
                Session::put('group_id',$organizationToken->group_id);
                $organizationToken->auth_login_token = '';
                $organizationToken->save();

                try{
                    $model = User::with(['user_role_map'])->whereHas('user_role_map', function($query){
                        $query->where('role_id',1);
                    })->first();
                    // dd($model);
                    Auth::guard('org')->loginUsingId($model->user_id);
                    $putRole = UserRoleMapping::where(['user_id'=>$model->user_id])->first();
                    Session::put('user_role',$putRole->role_id);
                    return redirect()->route('org.dashboard');
                }catch(\Exception $e){
                    throw $e;
                }
            }
        }
        if($social_token != null && $social_token != 'null'){
            $groupUserMeta = GroupUserMeta::where(['value'=>$social_token])->first();
            if($groupUserMeta != null){
                $userId = $groupUserMeta->user_id;
                GroupUserMeta::where(['value'=>$social_token])->delete();
                Auth::guard('org')->loginUsingId($userId);
                $putRole = UserRoleMapping::where(['user_id'=>$userId])->first();
                Session::put('user_role',$putRole->role_id);
                return redirect()->route('org.dashboard');
            }
        }
        $arraySetting = [];
        $completeDomain = $request->getHost();
        $primary_domain = $this->is_primary_domain_exists($completeDomain);
        $secondary_domain = $this->is_secondary_domain_exists($completeDomain);
        $settings = OrganizationSetting::all();
        if($primary_domain == false){
            if($secondary_domain == false){
                $domain = explode('.', $request->getHost());
                $subdomain = $domain[0];
                $model = GlobalOrganization::where('slug',$subdomain)->first();

                if($model == null){
                    return redirect()->route('demo5');
                }

                Session::put('organization_id',$model->id);
                Session::put('group_id',$model->group_id);
                return view('organization.login.login',compact('settings'));
            }else{
                Session::put('organization_id',$secondary_domain->id);
                Session::put('group_id',$secondary_domain->group_id);
                return view('organization.login.login',compact('settings'));
            }

        }else{
            Session::put('organization_id',$primary_domain->id);
            Session::put('group_id',$primary_domain->group_id);
            return view('organization.login.login',compact('settings'));
        }

    }
    public function showLoginFormv1()
    {
        return view('organization.login.login-v1');
    }
    public function showLoginFormv2()
    {
        return view('organization.login.login-v2');
    }
    protected function guard()
    {
        return Auth::guard('org');
    }

    public function login(Request $request){
        $model = GroupUsers::where('email',$request->email)->first();
        if($model != null){
            if($model->status == 0){
                Session::flash('error','Your account is deactivated from group admin!');
                return back();
            }
            $ifUserAllowForOrganization = User::where('user_id',$model->id)->first();
            if($ifUserAllowForOrganization == null){
                Session::flash('error','You don\'t have rights to access this organization!');
                return back();
            }elseif($ifUserAllowForOrganization->status == 0){
                Session::flash('error','Your account is deactivated or not approved by organization admin!');
                return back();
            }
            
            if($ifUserAllowForOrganization != null){
                if(@$model->status == 1){
                    $credentials = [
                        'email' => $request->input('email'),
                        'password' => $request->input('password'),
                        'status' => 1
                    ];
                    if(Auth::guard('org')->attempt($credentials)) {
                        $putRole = UserRoleMapping::where(['user_id'=>Auth::guard('org')->user()->id])->first();
                        @Session::put('user_role',@$putRole->role_id);
                        if($request->has('back_to')){
                            return redirect($request->back_to);
                        }
                        return redirect('/'); 
                    }else{
                        Session::flash('error' , 'wrong user credientals.');
                        return back();
                    }
                }else{
                    Session::flash('error' , 'Your account is temporary Blocked , please contact the Organization Admin');
                    return back();
                }
            }else{
                Session::flash('error' , 'wrong user credientals. ');
                return back();
            }
        }else{
            Session::flash('error' , 'wrong user credientals. ');
            return back();
        }
        
    }

    public function logout(Request $request){

        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->route('org.login');
    }
    public function forgotPassword()
    {
        $settings = OrganizationSetting::all();
        return view('organization.login.forgot-password',compact('settings'))->compileShortcodes();
    }
     public function forgotPasswordv1()
    {
        return view('organization.login.forgot-password-v1');
    }

    protected function getEmailTemplateAndLayout(){
        $check_notification_status = get_organization_meta('key' , 'enable_forgot_password');
        $template_id = get_organization_meta('forgot_password_template');
        if($template_id == null || $template_id == false){
            return false;
        }
        $emailTemplate = '';
        $emailLayout = '';

        if($template_id != null || !empty($template_id)){
            $get_template = EmailTemplate::with(['templateMeta'])->where('id',$template_id)->first();
            $emailTemplate = $get_template->toArray();
        }
        if($get_template->templateMeta != null || !empty($get_template->templateMeta)){
            foreach ($get_template->templateMeta as $key => $value) {
                if($value->key == 'layout'){
                    if($value->value != ''){
                        $emailLayout = EmailLayout::where('id',$value->value)->get()->toArray()[0];
                    }
                }
            }
        }
        return ['layout'=>$emailLayout,'template'=>$emailTemplate];
    }

    protected function registerShortcodes($token){
        Shortcode::add('organization_name', function($atts,$content,$name){
            $organizationMeta = get_organization_meta();
            if($organizationMeta->has('title') && $organizationMeta['title'] != ''){
                return $organizationMeta['title'];
            }else{
                return 'Un-titled';
            }
        });
       
        Shortcode::add('forget_link', function($atts,$content,$name) use ($token){
            return 'Reset Password: <a href="'.route('edit.password',$token).'">Click To Reset Password</a>';
            
        });
    }

    public function forgotMail(Request $request){

        $model = GroupUsers::where('email',$request->email)->first();
        if($model != null){
            Session::put('user_id',$model->id);
            $to_email = $request->email;
            $check_forgot_status = OrganizationSetting::where('key' , 'enable_forgot_password')->first();
            if($check_forgot_status != null && $check_forgot_status->value != '' && $check_forgot_status->value != 0){
                if($check_forgot_status->value == 1){
                    $templateAndLayout = $this->getEmailTemplateAndLayout();
                    if($templateAndLayout != false){
                        $token = str_random(64);
                        $passwordReset = new PasswordReset;
                        $passwordReset->email = $request->email;
                        $passwordReset->token = $token;
                        $passwordReset->save();
                        $this->registerShortcodes($token);
                        $rawData = view('organization.login.signup-email-template',['emailTemplate' => $templateAndLayout['template'] , 'emailLayout' => $templateAndLayout['layout']])->compileShortcodes()->render();
                        Mail::send([],[], function($message) use ($rawData, $to_email){
                            $message->from(env('MAIL_EMAIL'),env('MAIL_FROM'));
                            $message->setBody($rawData,'text/html');
                            $message->subject('Reset Password');
                            $message->to($to_email);
                        });
                    }else{
                        Session::flash('error','Forget password template not found!');
                        return back();
                    }
                }
            }else{
                Session::flash('error','Forget password not enable by Organization Admin!');
                return back();
            }
            Session::flash('success','Reset Password mail sent on your email.');
            return back();
        }else{
            Session::flash('forgot-error','Email not correct');
            return back();
        }
    }

    public function changePass($token)
    {
        $checkTokenExists = PasswordReset::where(['token'=>$token])->first();
        if($checkTokenExists == null){
            return redirect()->route('org.login');
        }
        return view('organization.login.reset-password',['from'=>'reset_password']);
    }

    public function changePassv1()
    {
        return view('organization.login.reset-password-v1');
       
    }

    protected function validateResetPassword($request){
        $rules = [
            'password' => 'required|string|min:8|max:30|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'password_confirmation' => 'required'
        ];

        $this->validate($request , $rules,['password.regex'=>'Password contain at least one number, one special character and one upper case character!']);
    }

    protected function setGroupId(){
        $globalOrganization = GlobalOrganization::find(get_organization_id());
        Session::put('group_id',$globalOrganization->group_id);
    }

    public function updatePass(Request $request)
    {
        $this->validateResetPassword($request);
        $resetUser = PasswordReset::where(['token'=>$request->reset_create_token])->first();
        $this->setGroupId();
        $groupUserModel = GroupUsers::where(['email'=>$resetUser->email])->update(['password'=>Hash::make($request->password),'app_password'=>$request->password]);
        PasswordReset::where(['token'=>$request->reset_create_token])->delete();
        Session::flash('success','Password Changed Successfully!');
        return redirect()->route('org.login');
    }


    public function register(Request $request)
    {
        $arraySetting = [];
        $completeDomain = $request->getHost();
        $form_slug = null;
        

        $settings = OrganizationSetting::all();


        $additionalForm = $settings->where('key','user_profile_form')->first();
        
        $primary_domain = $this->is_primary_domain_exists($completeDomain);
        $secondary_domain = $this->is_secondary_domain_exists($completeDomain);
        if($primary_domain == false){
            if($secondary_domain == false){
                $domain = explode('.', $request->getHost());
                $subdomain = $domain[0];
                $model = GlobalOrganization::where('slug',$subdomain)->first();
                if($model == null){
                    return redirect()->route('demo5');
                }
                Session::put('organization_id',$model->id);
                $auth = Auth::guard('org');
                if($additionalForm != null){
                    $additionalForm = Forms::find($additionalForm->value);
                    if($additionalForm != null){
                        $form_slug = $additionalForm->form_slug;
                    }
                }
                return view('organization.login.signup',compact('settings'))->with(['form_slug'=>$form_slug]);
                    
            }else{
                Session::put('organization_id',$secondary_domain->id);
                if($additionalForm != null){
                    $additionalForm = Forms::find($additionalForm->value);
                    if($additionalForm != null){
                        $form_slug = $additionalForm->form_slug;
                    }
                }
                return view('organization.login.signup',compact('settings'))->with(['form_slug'=>$form_slug]);
            }
        }else{
            Session::put('organization_id',$primary_domain->id);
            $auth = Auth::guard('org');
            if($additionalForm != null){
                $additionalForm = Forms::find($additionalForm->value);
                if($additionalForm != null){
                    $form_slug = $additionalForm->form_slug;
                }
            }
            return view('organization.login.signup',compact('settings'))->with(['form_slug'=>$form_slug]);
        }
    }

    protected function is_primary_domain_exists($domain){
        $primary_domain_existance_status = GlobalOrganization::where('primary_domain',$domain)->first();
        if($primary_domain_existance_status != null){
            return $primary_domain_existance_status;
        }else{
            return false;
        }
    }

    protected function is_secondary_domain_exists($domain){
        $secondary_domain_existance_status = GlobalOrganization::where('secondary_domains',$domain)->first();
        if($secondary_domain_existance_status != null){
            return $secondary_domain_existance_status;
        }else{
            return false;
        }
    }

    public function socialLogin($loginFrom){
        switch ($loginFrom) {
            case 'github':
                $redirectUrl = 'http://admin.scolm.com/handlecallback/github?organization='.get_organization_id();
                return Socialite::driver($loginFrom)->redirectUrl($redirectUrl)->redirect();
                break;
            case'facebook':
                $redirectUrl = 'http://admin.scolm.com/handlecallback/facebook';
                return Socialite::driver($loginFrom)->with(['state'=>json_encode(['organization'=>get_organization_id()])])->redirectUrl($redirectUrl)->redirect();
                break;
            case'twitter':
                $redirectUrl = 'http://admin.scolm.com/handlecallback/twitter?organization='.get_organization_id();
                return Socialite::driver($loginFrom)->redirect();
                break;
        }
    }
    
}