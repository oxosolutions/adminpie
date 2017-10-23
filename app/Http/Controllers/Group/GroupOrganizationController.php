<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Model\Admin\GlobalGroup as Group;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Artisan;
use App\Model\Admin\GlobalOrganization as ORG;
use Session;
use Hash;
use App\Model\Organization\User;
use App\Model\Group\GroupUsers;
use App\Model\Group\GroupUserMapping;
use App\Model\Organization\UsersType;
use DB;
use Auth;
use App\Model\Admin\GlobalModule;
use App\Model\Admin\GlobalSetting;
use App\Model\Organization\RolePermisson as Permisson;
use App\Model\Organization\UsersRole as Role;
use App\Model\Organization\OrganizationSetting as org_setting;
use App\Model\Organization\UserRoleMapping;
use stdClass;
use App\Http\Controllers\Admin\OrganizationController;

class GroupOrganizationController extends Controller
{	
    protected $valid_fields  = [
                'email'             => 'bail|required|unique:global_organizations|email',
                'slug'              => 'bail|required|unique:global_organizations|regex:/^[a-z0-9-]+$/|min:3|max:300',
                'primary_domain'    => 'unique:global_organizations',//pendinggg
                'name'              => 'required|unique:global_organizations|max:300',
                'password'          => 'required|min:8',
                'confirm_password'  => 'required|same:password'
                ];

	public function listOrg(Request $request)
	{
 		$group_id = Auth::guard('group')->user()->group_id;
        $datalist= [];
        if($request->has('per_page')){
            $perPage = $request->per_page;
            if($perPage == 'all'){
                $perPage = 999999999999999;
            }
        }else{
                $perPage = 10;
        }
        $sortedBy = @$request->sort_by;
        if($request->has('search')){
            if($sortedBy != ''){
                $model = ORG::where('name','like','%'.$request->search.'%')->where('group_id',$group_id)->orderBy($sortedBy,$request->ORGc_asc)->paginate($perPage);
            }else{
                $model = ORG::where('name','like','%'.$request->search.'%')->where('group_id',$group_id)->paginate($perPage);
            }
        }else{
            if($sortedBy != ''){
                $model = ORG::orderBy($sortedBy,$request->desc_asc)->where('group_id',$group_id)->paginate($perPage);
            }else{
                $model = ORG::where('group_id',$group_id)->paginate($perPage);
            }
        }
        $datalist =  [
                      'datalist'=>  $model,
                      'showColumns' => ['name'=>'Name','status' => 'Status','created_at'=>'Created At'],
                      'actions' => [
                                      'edit'    =>  ['title'=>'Edit','route'=>'edit.groupOrganization' , 'class' => 'edit'],
                                      'delete'  =>  ['title'=>'Delete','route'=>'delete.groupOrganization'],
                                      'clone'   =>  ['title'=>'Clone','route'=>'create.groupOrganizationClone'],
                                      'auth'    =>  ['title'=>'Login Organization','route'=>'auth.organization'],
                                      'status_option'  =>  ['title'=>'status option','class'=>'status_option' ,'route' =>'change.org.status']
                                   ],
                      'js'  =>  ['custom'=>['list-designation']],
                      'css'=> ['custom'=>['list-designation']]
                  ];
       
        return view('group.organization.list',$datalist);

	}
	
    public function authAttemptOrganization($organizationID){
        if(Auth::guard('admin')->check()){
            Session::put('organization_id',$organizationID);
            $organization = ORG::find($organizationID);

            ORG::where('id','>=',1)->update(['auth_login_token'=>'']);
            $tokenString = str_random(20);
            $organization->auth_login_token = $tokenString;
            $organization->save();
            Session::put('organization_id','');
            if($organization->primary_domain != null && $organization->primary_domain != ''){
                
                return redirect()->to('http://'.$organization->primary_domain.'/login/'.$tokenString);

            }elseif($organization->secondary_domains != null && $organization->secondary_domains != ''){

                return redirect()->to('http://'.$organization->secondary_domains.'/login/'.$tokenString);

            }else{
                return redirect()->to('http://'.$organization->slug.'.adminpie.com/login/'.$tokenString);
            }
        }
    }


	public function delete($id)
	{
		try{
            DB::beginTransaction();
      		$model = ORG::findOrFail($id);
			$model->delete();

            $data =   DB::select("select CONCAT('DROP TABLE `',t.table_schema,'`.`',t.table_name,'`;') AS dropTable
                      FROM information_schema.tables t
                      WHERE t.table_schema = '".env('DB_DATABASE', 'forge')."'
                      AND t.table_name LIKE 'ocrm_".$id."%' 
                      ORDER BY t.table_name");
            foreach ($data as $key => $value) {
                 DB::select($value->dropTable);
              }
                      DB::commit();

        Session::flash('success', __('manage.organization_deleted') );
        }catch(\Exception $e){
          // throw $e;
            DB::rollback();
            Session::flash('error', __('manage.something_went_wrong'));
        }
        return redirect()->route('list.groupOrganizations');
	}

	public function create(){
		
        // dump($modules);
		return view('group.organization.create');
	}
    public function edit(Request $request, $id){

        
        $org_data = ORG::findOrFail($id);
         if($request->isMethod('post')){
            $ex[] = 'form_id';
            $ex[] = 'form_slug';
            $ex[] = 'form_title';
            unset($this->valid_fields['password'], $this->valid_fields['confirm_password']);
            $ex[] = '_token';
            $ex[] = 'password';
            if($org_data['email']== $request['email'])
            {
            $ex[] ='email';
            unset($this->valid_fields['email']);
            }

            if($org_data['slug']== $request['slug'])
            {
            $ex[] ='slug';
            unset($this->valid_fields['slug']);
            }

            if($org_data['name']== $request['name'])
            {
            $ex[] ='name';
            unset($this->valid_fields['name']);
            }

            if($org_data['primary_domain']== $request['primary_domain'])
            {
            $ex[] ='primary_domain';
            unset($this->valid_fields['primary_domain']);
            }
            $this->validate($request, $this->valid_fields);
            if(!empty($request['modules'])) {
                $request['modules'] = json_encode($request['modules']);
                }else{
                    unset($request['modules']);
                }
            ORG::where('id',$id)->update($request->except($ex));
            Session::flash('success','Updated successfully');
            return back();
        }
        $org_data->modules = json_decode($org_data->modules);
        $modules = GlobalModule::pluck('name','id');
        return view('group.organization.edit',['org_data'=>$org_data,'modules'=> $modules ]);
    }

    protected function create_organization_database($existed_id , $new_id)
    {
        $organizations = DB::select(" SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='oxo_adminpi' and TABLE_NAME like 'ocrm_".$existed_id."%' ");
        if(!empty($organizations)){
            foreach (json_decode(json_encode($organizations),true)  as $orgKey => $orgValue) {
                $existed = $orgValue['TABLE_NAME'];
                $new = str_replace($existed_id, $new_id, $existed);
                DB::select("CREATE TABLE ".$new." LIKE ".$existed);
                DB::select("INSERT ".$new." SELECT * FROM ".$existed);
            } 
            return 'table_exist';
        }else{
            return 'table_not_exist';
            }
    }


	public function save(Request $request){

        $this->global_create_organization($request);
        return redirect()->route('list.groupOrganizations');
    }


    public function global_create_organization($request){

        if($request->primary_domain == '' || $request->primary_domain == null){
            $validateFields = $this->valid_fields;
            unset($validateFields['primary_domain']);
            $validateFields = $validateFields;
        }else{
            $validateFields = $this->valid_fields;
        }

    	$checkUserExist = GroupUsers::where('email',$request->email)->first();
    	if($checkUserExist != null){
    		unset($validateFields['email']);
    		unset($validateFields['password']);
    		unset($validateFields['confirm_password']);
    	}
        $this->validate($request, $validateFields);
        if(!empty($request['modules'])) {
           $request['modules'] = json_encode($request['modules']);
        }
     	try{
	            DB::beginTransaction();
		        $org = new ORG();
		        $org->fill($request->all());
		        $org->save();
		        $org_id = $org->id;
		        $active_code =  $org_id * 576;
		        ORG::where('id',$org_id)->update(['active_code'=>$active_code]);
		        Session::put('organization_id',$org->id);
		        $checkMaster = GlobalSetting::where('key','primary_organization');
		        if($checkMaster->exists()){
		            $primary_orgnaization = $checkMaster->first();
		            $return =  $this->create_organization_database($primary_orgnaization->value, $org_id); 
		        }
		        
		        if(!$checkMaster->exists() || $return=='table_not_exist'){
					$createOrganization = new OrganizationController;
		            $createOrganization->create_db_through_migration($org_id);
		        }
		        if($checkUserExist == null){
		        	$org_usr = new GroupUsers();
			        $org_usr->fill($request->all());
			        $org_usr->status = 1;
			        $org_usr->password = Hash::make($request->password);
			        $org_usr->app_password = $request->password;
			        $org_usr->save(); 
		        }else{
		        	$org_usr = new stdClass;
		        	$org_usr->id = $checkUserExist->id;
		        }
		        $userMapping = new User;
		        $userMapping->user_id = $org_usr->id;
		        $userMapping->deleted_at = 0;
		        $userMapping->save();
		        $userRoleMapping = UserRoleMapping::where(['user_id'=>1, 'role_id'=>1]);
		        if(!$userRoleMapping->exists()){
		            $userRoleMapping = new UserRoleMapping();
		            $userRoleMapping->fill(['user_id'=>$org_usr->id , 'role_id'=>1]);
		            $userRoleMapping->save();
		        }
		        DB::commit();
		        Session::flash('success', __('manage.organization_created'));
		        return $org_id.' has beenn created';
		    }catch(\Exception $e){
		    	DB::rollback();
		    	throw $e;
		    }
    }

    public function cloneOrganization($id)
    {
        $organization = ORG::where('id',$id)->first()->toArray();
        $organization['slug']= $organization['slug'].'-clone';
        $organization['name']= $organization['name'].' Clone';
        if(ORG::where('slug',$organization['slug'])->exists()){
            $random = str_random(9);
            $organization['slug'] = $organization['slug'].'-'.$random;
            $organization['name']= $organization['name'].' '.$random;
        }
        $org = new ORG();
        $org->fill($organization);
        $org->save();
        $this->create_organization_database($id , $org->id);
        Session::flash('success', __('manage.organization_created') );
        return back();
    }
   
   

    public function changeStatus($id)
    {
        $model = ORG::find($id);
        if($model->status == 1){
            $model = ORG::where('id',$id)->update(['status' => 0]);
        }else{
            $model = ORG::where('id',$id)->update(['status' => 1]);
        }
        return back();
    }


    /**
      * users function
      *
      * @return view
      * @author Rahul
      **/
    public function users(Request $request, $id){
        Session::put('organization_id',$id);
        $datalist= [];
        if($request->has('per_page')){
            $perPage = $request->per_page;
            if($perPage == 'all'){
                $perPage = 999999999999999;
            }
        }else{
                $perPage = 10;
        }
        $sortedBy = @$request->sort_by;
        if($request->has('search')){
            if($sortedBy != ''){
                $model = GroupUsers::has('organization_user')->where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->ORGc_asc)->paginate($perPage);
            }else{
                $model = GroupUsers::has('organization_user')->where('name','like','%'.$request->search.'%')->paginate($perPage);
            }
        }else{
            if($sortedBy != ''){
                $model = GroupUsers::has('organization_user')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
            }else{
                $model = GroupUsers::has('organization_user')->paginate($perPage);
            }
        }
        $datalist =  [
                      'datalist'=>  $model,
                      'showColumns' => ['name'=>'Name','email'=>'Email','status' => 'Status','created_at'=>'Created At'],
                      'actions' => [
                                      'delete'  =>  ['title'=>'Delete','route'=>'revoke.user'],
                                   ]
                  ];
        return view('group.organization.users',$datalist);
    }

    public function addNewUserToOrganization(Request $request, $organization_id){
        $user = new User;
        $user->user_id = $request->select_user;
        $user->deleted_at = 0;
        $user->save();
        $role = new UserRoleMapping;
        $role->user_id = $user->id;
        $role->role_id = $request->select_role;
        $role->status = 1;
        $role->save();
        Session::flash('success','Successfully added!!');
        return back();
    }

    public function revokeUser($user_id){
        $user = User::where('user_id',$user_id);
        $userId = $user->first()->id;
        $user->delete();
        $role = UserRoleMapping::where('user_id',$userId)->delete();
        Session::flash('success','Successfully deleted!');
        return back();
    }
    
}
