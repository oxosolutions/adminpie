<?php

namespace App\Http\Controllers\Organization\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Model\Admin\GlobalOrganization;
use Auth;
use Session;
use Route;
use Mail;
use Hash;
use App\Model\Organization\User;
use App\Mail\forgetPassword;
use App\Model\Organization\UserRoleMapping;
use App\Model\Organization\OrganizationSetting;
use App\Model\Group\GroupUsers;
use App\Model\Organization\forms as Forms;
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

    public function showLoginForm(Request $request, $id = null){
        if($id != null){
            $organizationToken = GlobalOrganization::where('auth_login_token',$id)->first();
            if($organizationToken != null){
                Session::put('group_id',$organizationToken->group_id);
                $organizationToken->auth_login_token = '';
                $organizationToken->save();

                try{
                    $model = User::with(['user_role_map'])->whereHas('user_role_map', function($query){
                        $query->where('role_id',1);
                    })->first();
                    Auth::guard('org')->loginUsingId($model->user_id);
                    $putRole = UserRoleMapping::where(['user_id'=>$model->user_id])->first();
                    Session::put('user_role',$putRole->role_id);
                    return redirect()->route('org.dashboard');
                }catch(\Exception $e){
                    throw $e;
                }
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


        /*$domain = explode('.', request()->getHost());
        $subdomain = $domain[0];
        $model = GlobalOrganization::where('slug',$subdomain)->first();
        if($model == null){
            return redirect()->route('demo5');
            //return view('organization.demo.demo5');
        }
        Session::put('organization_id',$model->id);
        return view('organization.login.login');*/
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
        if(count(@$model) > 0){
            if($model->status == 0){
                Session::flash('error','Your account is deactivated from group admin!');
                return back();
            }
            $ifUserAllowForOrganization = User::where('user_id',$model->id)->first();
            if($ifUserAllowForOrganization == null){
                Session::flash('error','You don\'t have rights to access this organization!');
                return back();
            }elseif($ifUserAllowForOrganization->status == 0){
                Session::flash('error','Your account is deactivated by organization admin!');
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
        return view('organization.login.forgot-password',compact('settings'));
    }
     public function forgotPasswordv1()
    {
        return view('organization.login.forgot-password-v1');
    }
    public function forgotMail(Request $request)
    {
        $model = GroupUsers::where('email',$request->email)->first();
        if(count($model) > 0){
            Session::put('user_id',$model->id);
            $to_email = $request->email;


            $check_forgot_status = OrganizationSetting::where('key' , 'enable_forgot_password')->first();
                if($check_forgot_status != null){
                    if($check_forgot_status->value == 1){
                        Mail::to($to_email)->send(new forgetPassword);
                    }
                }


            // Mail::to($to_email)->send(new forgetPassword);
            return view('success-msgs.email-success');
        }else{
            Session::flash('forgot-error','email not correct');
            return back();
        }
    }
    public function changePass()
    {
        if(Session::has('reset_token')){
            return view('organization.login.reset-password');
        }else{
            return redirect()->route('org.login');
        }
    }
    public function changePassv1()
    {
       
        return view('organization.login.reset-password-v1');
       
    }
    public function updatePass(Request $request)
    {
        $model = User::where('remember_token',Session::get('reset_token'))->first();
        $check = Hash::check($request->password , Hash::make($request->confirmpassword));

        $validate = [
                        'password'      => 'required|min:6',
                        'confirmpassword'  => 'required|same:password|min:6'
                    ];
        $this->validate($request , $validate);
       
        $model = User::where('remember_token',Session::get('reset_token'))->update(['password' => Hash::make($request->confirmpassword)]);
        if($model){
            Session::flash('password-changed','Password change Successfully.');
            return redirect()->route('org.login');
        }else{
            echo "Not Changed";
        }
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
}