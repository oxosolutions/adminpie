<?php

namespace App\Http\Controllers\Organization\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Model\Admin\GlobalOrganization;
use Auth;
use Session;
use Route;
use App\Model\Organization\User;
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
                    $model = User::where('user_type','[1]')->first();
                    Auth::guard('org')->loginUsingId($model->id);
                    return redirect()->route('org.login');
                }catch(\Exception $e){

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

    protected function guard()
    {
        return Auth::guard('org');
    }

    public function logout(Request $request){

        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->route('org.login');
    }
    
}
