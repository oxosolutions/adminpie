<?php

namespace App\Http\Controllers\Organization\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Model\Admin\GlobalOrganization;
use Auth;
use Session;
use Route;
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

    public function showLoginForm(){
        $domain = explode('.', request()->getHost());
        $subdomain = $domain[0];
        $model = GlobalOrganization::where('slug',$subdomain)->first();
        if($model == null){
            dd('Not Valid Organization');
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
