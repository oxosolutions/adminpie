<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Socialite;
use App\Http\Controllers\Organization\Auth\RegisterController;
use Session;
use App\Model\Admin\GlobalOrganization;
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
        $this->middleware('guest.admin', ['except' => 'logout']);
    }

    public function showLoginForm(){
        $settings = collect([]);
        // $settings = OrganizationSetting::all();
        return view('admin.login.login',compact('settings'));
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function logout(Request $request){

        $this->guard()->logout();
        // $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->route('admin.login');
    }

    public function handlecallback(Request $request, $driver){
        $user = Socialite::driver($driver)->stateless()->user();
        switch ($driver) {
            case 'github':
                $groupUserId = $this->loginUserViaSocial($request->organization, $user);
                $organizationData = GlobalOrganization::find($request->organization);
                $login_token = str_random(60);
                update_meta('App\Model\Group\GroupUserMeta',['login_token'=>$login_token],['user_id'=>$groupUserId]);
                if($organizationData->primary_domain != null && $organizationData->primary_domain != ''){
                    return redirect()->to('http://'.$organizationData->primary_domain.'/login/null/'.$login_token);
                }elseif($organizationData->secondary_domains != null && $organizationData->secondary_domains != ''){
                    return redirect()->to('http://'.$organizationData->secondary_domains.'/login/null/'.$login_token);
                }else{
                    return redirect()->to('http://'.$organizationData->slug.'.'.env('MAIN_DOMAIN').'/login/null/'.$login_token);
                }
            break;
            case'facebook':
                break;
            case'twitter':
                break;
            default:
                # code...
                break;
        }
    }

    protected function loginUserViaSocial($organizationID, $user){
        Session::put('organization_id',$organizationID);
        $registerUser = new RegisterController;
        $request = Request::create('','post',['name' => $user->name,'email'=>$user->email]);
        $groupUserId = $registerUser->userRegister($request, null, 'social');
        return $groupUserId;
    }
    
}
