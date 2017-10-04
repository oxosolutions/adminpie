<?php

namespace App\Http\Controllers\Group\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
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
        $this->middleware('guest.group', ['except' => 'logout']);
    }

    public function showLoginForm(){
        $settings = collect([]);
        // $settings = OrganizationSetting::all();
        return view('group.login.login',compact('settings'));
    }

    protected function guard()
    {
        return Auth::guard('group');
    }

    public function logout(Request $request){

        $this->guard()->logout();
        // $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->route('group.login');
    }
    
}
