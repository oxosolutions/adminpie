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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest.org', ['except' => 'logout']);
    }

    public function showLoginForm($id = null){
        if($id != null){
            $organizationToken = GlobalOrganization::where('auth_login_token',$id)->first();
            if($organizationToken != null){
                $organizationToken->auth_login_token = '';
                $organizationToken->save();
                try{

                    $model = User::with(['user_role_rel'])->whereHas('user_role_rel', function($query){
                        $query->where('role_id',1);
                    })->first();
                    Auth::guard('org')->loginUsingId($model->id);
                    $putRole = UserRoleMapping::where(['user_id'=>Auth::guard('org')->user()->id])->first();
                    Session::put('user_role',$putRole->role_id);
                    return redirect()->route('org.login');
                }catch(\Exception $e){
                    //throw $e;
                }
            }
        }
        $domain = explode('.', request()->getHost());
        $subdomain = $domain[0];
        $model = GlobalOrganization::where('slug',$subdomain)->first();
        if($model == null){
            return redirect()->route('demo5');
            //return view('organization.demo.demo5');
            //dd('Not Valid Organization');
        }
        Session::put('organization_id',$model->id);
        return view('organization.login.login');
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
        $model = User::where('email',$request->email)->first();
        if(count(@$model) > 0){
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
                    Session::flash('login_fails' , 'wrong user credientals.');
                    return back();
                }
            }else{
                Session::flash('login_fails' , 'Your account is temporary Blocked , please contact the Organization Admin');
                return back();
            }
        }else{
            Session::flash('login_fails' , 'wrong user credientals. ');
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
        return view('organization.login.forgot-password');
    }
     public function forgotPasswordv1()
    {
        return view('organization.login.forgot-password-v1');
    }
    public function forgotMail(Request $request)
    {
        $model = User::where('email',$request->email)->first();
        if(count($model) > 0){
            User::where('id',$model->id)->update(['remember_token'=>Hash::make(rand(15,1500))]);
            Session::put('reset_token',User::where('id',$model->id)->first()->remember_token);
            $to_email = $request->email;
            Mail::to($to_email)->send(new forgetPassword);
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
        $check = Hash::check($request->password , Hash::make($request->confirmPassword));

        $validate = [
                        'password'      => 'required|min:6',
                        'confirmPassword'  => 'required|same:password|min:6'
                    ];
        $this->validate($request , $validate);
       
    $model = User::where('remember_token',Session::get('reset_token'))->update(['password' => Hash::make($request->confirmPassword)]);
        if($model){
            Session::flash('password-changed','Password change Successfully.');
            return redirect()->route('org.login');
        }else{
            echo "Not Changed";
        }
    }
    public function register()
    {
        return view('organization.login.register');
    }
}