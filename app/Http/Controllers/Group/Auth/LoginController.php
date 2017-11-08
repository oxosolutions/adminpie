<?php

namespace App\Http\Controllers\Group\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Session;
use App\Model\Group\AdminUsers;
use App\Model\Group\GroupUsers;
use App\Model\Admin\GlobalGroup;

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

    public function showLoginForm($auth_token = null, Request $request){
        if($auth_token != null){
            $adminUser = AdminUsers::where('auth_token',$auth_token)->first();
            if($adminUser != null){
                Auth::guard('group')->logout();
                $request->session()->flush();
                $request->session()->regenerate();
                Auth::guard('group')->loginUsingId($adminUser->id);
                $adminUser->auth_token = null;
                $adminUser->save();
                return redirect()->route('group.dashboard');
            }
        }
        $settings = collect([]);
        // $settings = OrganizationSetting::all();
        return view('group.login.login',compact('settings'));
    }

    public function login(Request $request){
        $model = AdminUsers::where('email',$request->email)->first();
        if($model != null){
            $group_id = $model->group_id;
            $status = GlobalGroup::where('id',$group_id)->first()->status;
                
                if($status != 0){
                    $credentials = [
                        'email' => $request->input('email'),
                        'password' => $request->input('password'),
                    ];

                    if(Auth::guard('group')->attempt($credentials)) {
                        return redirect('/'); 
                    }else{
                        Session::flash('error' , 'wrong user credientals.');
                        return back();
                    }

                }else{
                    Session::flash('error','This Organization is not active right now. please contact admin to approve');
                    return back();
                }

        }


        // if(count(@$model) > 0){
        //     $ifUserAllowForOrganization = User::where('user_id',$model->id)->first();
        //     if($ifUserAllowForOrganization != null){
        //         if(@$model->status == 1){
        //             $credentials = [
        //                 'email' => $request->input('email'),
        //                 'password' => $request->input('password'),
        //                 'status' => 1
        //             ];
        //             if(Auth::guard('org')->attempt($credentials)) {
        //                 $putRole = UserRoleMapping::where(['user_id'=>Auth::guard('org')->user()->id])->first();
        //                 @Session::put('user_role',@$putRole->role_id);
        //                 return redirect('/'); 
        //             }else{
        //                 Session::flash('error' , 'wrong user credientals.');
        //                 return back();
        //             }
        //         }else{
        //             Session::flash('error' , 'Your account is temporary Blocked , please contact the Organization Admin');
        //             return back();
        //         }
        //     }else{
        //         Session::flash('error' , 'wrong user credientals. ');
        //         return back();
        //     }
        // }else{
        //     Session::flash('error' , 'wrong user credientals. ');
        //     return back();
        // }
        
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
