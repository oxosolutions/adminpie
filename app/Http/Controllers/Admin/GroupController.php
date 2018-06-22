<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\GlobalGroup as Group;
use App\Model\Group\AdminUsers;
use DB;
use Hash;
use App\Model\Admin\GlobalModule;
use App\Model\Group\GroupUsers as GUsers;
use Session;
use App\Model\Admin\GlobalOrganization;
class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('items')){
          $perPage = $request->items;
          if($perPage == 'all'){
            $perPage = 999999999999999;
          }
        }else{
          $perPage = 10;
        }

        $sortedBy = @$request->orderby;
        if($request->has('search')){
            if($sortedBy != ''){
                $model = Group::where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->order)->paginate($perPage);
            }else{
                $model = Group::where('name','like','%'.$request->search.'%')->paginate($perPage);
            }
        }else{
            if($sortedBy != ''){
                $exploded = @explode(':',$sortedBy);
                if(isset($exploded[1])){
                    $sortedBy = $exploded[0];
                }
                $model = Group::orderBy($sortedBy,$request->order)->paginate($perPage);
            }else{
                 $model = Group::orderBy('id','desc')->paginate($perPage);
            }
        }
        $datalist =  [
                        'datalist'=>$model,
                        'showColumns' => ['name'=>'Title','description'=>'Description','created_at'=>'Created'],
                        'actions' => [
                                        'view' => ['title'=>'View','route'=>'view.group'],
                                        'edit' => ['title'=>'Edit','route'=>'edit.group'],
                                        'delete' => ['title'=>'Delete','route'=>'delete.group','class'=>'red'],
                                        'auth' => ['title'=>'Login Group','route'=>'group.auth.login'],
                                        // 'delete'=>['title'=>'Delete','route'=>'delete.holiday']
                                     ]
                    ];

        return view('admin.group.index' , $datalist); 
        // return view('admin.group.index');
    }

    public function create()
    {   
        return view('admin.group.create');
    }

    protected function validateGroupRequest($request){

        $rules = [

            'email' => 'required|unique:group_admins|email',
            'password' => 'required|string|min:8|max:30|regex:/^(?=.*?[A-Z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'
        ];

        $this->validate($request , $rules,['password.regex'=>'Password contain at least one number, one special character and one upper case character!']);
    }
    public function store(Request $request)
    {
        $this->validateGroupRequest($request);
        $model = new Group;
        $model->fill($request->all());
        $model->modules = json_encode($request['modules']);
        $model->save();
        $groupId = $model->id;

        // email apasswor group_id
            $AdminUserData = ['email' => $request['email'] , 'password' => Hash::make($request['password'])];
            $AdminUsers = new AdminUsers;
            $AdminUsers->fill($AdminUserData);
            $AdminUsers->role_id = 1;
            $AdminUsers->group_id = $groupId;
            $AdminUsers->save();


        // // ocrm_{id}_group_users
            DB::statement('CREATE TABLE ocrm_group_'.$groupId.'_users (`id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,`name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,`email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,`password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,`api_token` char(60) COLLATE utf8mb4_unicode_ci NOT NULL,`remember_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,`status` int(11) NULL DEFAULT "0",`created_at` timestamp NULL DEFAULT NULL,`updated_at` timestamp NULL DEFAULT NULL,`deleted_at` int(11) DEFAULT "0",`app_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL)');
            /*DB::statement('CREATE TABLE ocrm_group_'.$groupId.'_user_mapping (id INT(11) AUTO_INCREMENT PRIMARY KEY, user_id INT(11) UNSIGNED NOT NULL, organization_id INT(11) UNSIGNED NOT NULL, role_id INT(11), created_at timestamp, updated_at timestamp)');*/
            DB::statement('CREATE TABLE ocrm_group_'.$groupId.'_user_meta ( `id` INT(50) NOT NULL AUTO_INCREMENT , `user_id` INT(50) UNSIGNED NOT NULL , `key` VARCHAR(255) NOT NULL , `value` VARCHAR(255) NOT NULL , `created_at` TIMESTAMP NOT NULL , `updated_at` TIMESTAMP NOT NULL , PRIMARY KEY (`id`))');
            Session::flash('success','Group created successfully');
            return redirect()->route('list.group');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $group_data = Group::findOrFail($id);
       
        $modules = GlobalModule::pluck('name','id');
        
        return view('admin.group.edit',['group_data'=>$group_data,'modules'=> $modules ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = Group::find($id);
        $model->fill($request->all());
        $model->modules = json_encode($request['modules']);
        $model->save();
        return redirect()->route('list.group');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author Rahul
     */
    public function destroy($id)
    {
        $prefix = DB::getTablePrefix();
        $group_organization = Group::has('group_orgaization')->where('id',$id)->first();
        if(empty($group_organization)){
            Group::find($id)->delete();
            AdminUsers::where('group_id',$id)->delete();
            DB::statement("DROP TABLE ".$prefix."group_".$id."_users");
            DB::statement("DROP TABLE ".$prefix."group_".$id."_user_meta");
            Session::flash('success','Successfully deleted!');
            return back();
        }else{
            Session::flash('warning','This Group associate with organization. It not deleted');
            return back();
        }
        
    }

    /**
     * login group admin directly from admin
     *
     * @param  $group_id group id to login
     * @return redirect to specific route
     * @author Rahul
     **/
    function authGroup($group_id){
        $auth_token = str_random();
        $model = AdminUsers::where('group_id',$group_id)->first();
        if($model != null){
            $model->auth_token = $auth_token;
            $model->save();
            return redirect()->route('group.login',$auth_token);
        }
    }

    /**
     *  view group details function
     * @param integer $id having group id
     * @return view
     * @author Rahul
     **/
    public function viewGroup($id){

        $group_data = Group::find($id);
        $modules = GlobalModule::whereIn('id',json_decode($group_data->modules,true))->get();
        $groupModules = json_decode($group_data->modules,true);
        if(!empty($groupModules)){
            $moduleNames = $modules->whereIn('id',$groupModules)->pluck('name')->toArray();
            $group_data->modules = $moduleNames;
        }
        $oragnizationsList = GlobalOrganization::where('group_id',$id)->pluck('name','id');
        return view('admin.group.view',['group_data'=>$group_data,'oragnizations'=>$oragnizationsList]);
    }
}
