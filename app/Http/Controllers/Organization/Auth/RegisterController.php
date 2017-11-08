<?php

namespace App\Http\Controllers\Organization\Auth;

// use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Model\Group\GroupUsers as org_user;
use App\Model\Organization\User;
use Illuminate\Http\Request;
use Session;
use Hash;
use App\Model\Organization\UserRoleMapping;
use App\Model\Organization\UsersRole;
use App\Model\Admin\GlobalOrganization;
use Mail;
use App\Mail\userRegister;

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
    
    public function userRegister(Request $request, $status = null )
    {   
        

            
        if($request->isMethod('post')){

            $model = org_user::where(['email'=>$request->email])->first();
            if(count($model) > 0){
                Session::flash('error','Email already exist');
                return back();
            }else{
                if($status != null){
                    $status = $status;
                }else{
                    $status = 0;
                }

                    $rules = ['name' => 'required', 'email' =>  'required|email', 'password' => 'required|min:8', 'confirm_password'=>'required|same:password'];
                    $this->validate($request,$rules);
                    $user = new org_user;
                    $user->fill($request->only('name','email'));
                    $user->password = Hash::make($request->password);
                    $user->app_password = $request->password;
                    $user->status = $status;
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

                // $org_email = GlobalOrganization::where('id',get_organization_id())->first();
                // $to_email = $org_email->email;
                
                    $administrator = UsersRole::select('id')->where('slug' , 'administrator')->first()->id;
                    $listAdmin = UserRoleMapping::where('role_id',$administrator)->get()->toArray();
                    foreach($listAdmin as $k => $v){
                        $emails = org_user::select('email')->where('id',$v['user_id'])->get()->toArray()[0]['email'];
                        Mail::to($emails)->send(new userRegister);
                    }
                    // Mail::to($to_email)->send(new userRegister);
                Session::flash('success','Successfully SignUp !! you will able to login once admin Approve your account');
                return back();
          }
      return view('organization.login.signup');

    }





}
