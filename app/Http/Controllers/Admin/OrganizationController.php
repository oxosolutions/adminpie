<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Artisan;
use App\Model\Admin\GlobalOrganization as ORG;
use Session;
use Hash;
use App\Model\Organization\User;
use App\Model\Organization\UsersType;
use DB;
use Auth;
use App\Model\Group\GroupUsers;
use App\Model\Admin\GlobalModule;
use App\Model\Admin\GlobalSetting;
use App\Model\Organization\RolePermisson as Permisson;
use App\Model\Organization\UsersRole as Role;
use App\Model\Organization\OrganizationSetting as org_setting;
use App\Model\Organization\UserRoleMapping;
use stdClass;

class OrganizationController extends Controller
{
 
 public $generate_organization;


    protected $valid_fields  = [
                'email'             => 'bail|required|unique:global_organizations|email',
                'slug'              => 'bail|required|unique:global_organizations|regex:/^[a-z0-9-]+$/|min:3|max:300',
                'primary_domain'    => 'unique:global_organizations',//pendinggg
                'name'              => 'required|unique:global_organizations|max:300',
                'password'          => 'required|min:8',
                'confirm_password'  => 'required|same:password',
                'group_id'			=> 'required'
                ];

	public function listOrg(Request $request)
	{
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
                $model = ORG::where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->ORGc_asc)->paginate($perPage);
            }else{
                $model = ORG::where('name','like','%'.$request->search.'%')->paginate($perPage);
            }
        }else{
            if($sortedBy != ''){
                $model = ORG::orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
            }else{
                $model = ORG::paginate($perPage);
            }
        }
        $datalist =  [
                      'datalist'=>  $model,
                      'showColumns' => ['name'=>'Name','status' => 'Status','created_at'=>'Created'],
                      'actions' => [
                                    'edit'    =>  ['title'=>'Edit','route'=>'edit.organization' , 'class' => 'edit'],
                                    'delete'  =>  ['title'=>'Delete','route'=>'delete.organization','class'=>'red'],
                                    'clone'   =>  ['title'=>'Clone','route'=>'create.organizationClone'],
                                    'auth'    =>  ['title'=>'Login Organization','route'=>'auth.organization'],
                                    'status_option'  =>  ['title'=>'status option','class'=>'status_option' ,'route' =>'change.org.status']
                                   ],
                      'js'  =>  ['custom'=>['list-designation']],
                      'css'=> ['custom'=>['list-designation']]
                  ];
                  
        return view('admin.organization.list',$datalist);
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
                return redirect()->to('http://'.$organization->slug.'.'.env('MAIN_DOMAIN').'/login/'.$tokenString);
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

        Session::flash('success','Successfully deleted!');
        }catch(\Exception $e){
          // throw $e;
            DB::rollback();
            Session::flash('error','Somthing goes wrong Try again.');
        }
        return redirect()->route('list.organizations');
	}

	public function create(){
       // $modules = GlobalModule::pluck('name','id');
		return view('admin.organization.create');
	}


    public function edit(Request $request, $id){
            
            $rules = [];    
            $org_data = ORG::findOrFail($id);
             if($request->isMethod('post')){
                if($request->primary_domain == null){
                    $rules['slug'] = 'required';
                }               

                // if($request->primary_domain == null && $request->secondary_column == null){
                //     $rules['slug'] = 'required';
                // }
                
                $rules['name'] = 'required';
                $rules['email'] = 'required|email';
                $rules['group_id'] = 'required';
                $rules['slug'] = 'required';
                $messages = [
                    // 'slug.required' => 'slug or primary_domain or secondary_column must be filled'
                    // 'primary_domain.required' => 'Primary domain is required if slug is empty!',
                    // 'secondary_domains.required' => 'Secondary domain is required if slug and primary domain is empty!'
                ];
                $this->validate($request,$rules,$messages);
                foreach($request->except('_token') as $k => $v){
                    if(is_array($v)){
                        $processData[$k] = json_encode($v);
                    }else{
                        $processData[$k] = $v;
                    }
                }   
                
                ORG::where('id',$id)->update($processData);
                Session::flash('success','Updated successfully');
                return back();
            }
            $modules = GlobalModule::pluck('name','id');
            
            return view('admin.organization.edit',['org_data'=>$org_data,'modules'=> $modules ]);
    }

    protected function create_organization_database($existed_id , $new_id)
    {
        $organizations = DB::select(" SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='oxo_scolm' and TABLE_NAME like 'ocrm_".$existed_id."%' ");
        if(!empty($organizations)){
            foreach (json_decode(json_encode($organizations),true)  as $orgKey => $orgValue) {
                $existed = $orgValue['TABLE_NAME'];
                //if($existed != "ocrm_".$existed_id."_users"){
                  $new = str_replace($existed_id, $new_id, $existed);
                  DB::select("CREATE TABLE ".$new." LIKE ".$existed);
                  DB::select("INSERT ".$new." SELECT * FROM ".$existed);
                //}
            } 
            return 'table_exist';
        }else{
            return 'table_not_exist';
            }
    }
	public function save(Request $request){
		$rule = [
			'group_id' => 'required'
		];
		$this->validate($request,$rule);
	    Session::put('group_id',$request->group_id); 
	    $this->global_create_organization($request);
	    return redirect()->route('list.organizations');
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
      DB::transaction(function ()use($request, $checkUserExist) {
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
                 if(!empty($primary_orgnaization->value)){
                    $return =  $this->create_organization_database($primary_orgnaization->value, $org_id); 
                    }else{
                       $return = 'table_not_exist';
                    }
                //($return=='table_exist')? $org_usr =  User::find(1):null;
            }
            if(!$checkMaster->exists() || $return=='table_not_exist'){
                $this->create_db_through_migration($org_id);
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
            $userMapping->status = 1;
            $userMapping->save();
            $userRoleMapping = UserRoleMapping::where(['user_id'=>$userMapping->id, 'role_id'=>1]);
            if(!$userRoleMapping->exists()){
                $userRoleMapping = new UserRoleMapping();
                $userRoleMapping->fill(['user_id'=>$userMapping->id , 'role_id'=>1]);
                $userRoleMapping->save();
            }
        Session::flash('success', 'Organization create successfully');
         });
        // return $org_id.' has beenn created';
    }catch (Exception $e) {
        Session::flash('error', 'Something goes wrong try again');
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
        Session::flash('success', 'Organization create successfully');
        return back();
    }
   
    public function create_db_through_migration($org_id){
     	//Widget Permisson
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_widget_permissons',
                                '--schema'=>'role_id:integer, widget_id:integer:nullable, permisson:string:nullable'
                            ]);
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_activity_logs',
                                '--schema'=>'user_id:integer, name:string:nullable, slug:string:nullable'
                            ]);
    
		// USERS
		Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_users',
                                '--schema'=>'user_id:integer, user_type:string:nullable, status:integer:default(1), deleted_at:integer:default(0)'
                            ]);
        Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_user_role_mappings',
                                '--schema'=>'user_id:integer, role_id:integer, status:integer:default(1)'
                            ]);
          Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_log_systems',
                                '--schema'=>'user_id:integer:nullable, type:string:nullable, route_name:string:nullable, text:text:nullable, ip_address:string:nullable'
                            ]);
       
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_users_types',
                                '--schema'=>'type:string, status:integer:default(0)'
                            ]); 
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_users_roles',
                                '--schema'=>'name:string, description:text:nullable, order:integer:nullable, slug:string:nullable, status:integer:default(1)'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_role_permissons',
                                '--schema'=>'role_id:integer, permisson_type:string, permisson_id:integer, permisson:string:nullable, status:integer:default(1)'
                            ]);

    	Artisan::call('make:migration:schema',[
                '--model'=>false,
                                'name'=>'create_'.$org_id.'_users_metas',
                                '--schema'=>'user_id:integer , key:string, value:text:nullable, type:string:nullable'
                            ]);
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_sliders',
                                '--schema'=>'name:string , description:text:nullable, slug:string:nullable, slider:text, options:text:nullable, setting:text, status:integer:default(1)'
                            ]);
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_medias',
                                '--schema'=>'title:string , slug:string, original_name:string:nullable, type:string:nullable, extension:string:nullable, mime_type:string:nullable, dimension:string:nullable, size:string:nullable, status:integer:default(1)'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_media_meta',
                                '--schema'=>'media_id:integer , key:string, value:text:nullable, type:string:nullable, status:integer:default(1)'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_users_notes',
                                '--schema'=>'user_id:integer, title:string, description:text, priority:string:default("low")'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_users_todos',
                                '--schema'=>'user_id:integer, title:string, description:text, start:dateTime:nullable, end:dateTime:nullable, priority:string:default("low"), status:integer:default(0)'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_categories',
                                '--schema'=>'name:text, description:text:nullable, type:string, parent_id:integer:nullable, status:integer:default(1)'
                            ]);
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_category_meta',
                                '--schema'=>'key:string, value:text, category_id:integer, status:integer:default(1)'
                            ]);
    	
    

		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_leaves',
                                '--schema'=>'name:text, employee_id:integer, reason_of_leave:string:nullable, leave_category_id:integer, from:date, to:date, description:text:nullable, total_days:integer:nullable, apply_by:string, approved_by:string:nullable, status:integer'
                            ]);

		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_designations',
                                '--schema'=>'name:string, status:integer:default(1)'
                            ]);
        
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_collaborators',
                                '--schema'=>'type:string, relation_id:integer, email:string, userid:string, access:string, status:string'
                            ]);
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_attendance_files',
                                '--schema'=>'name:string, title:string:nullable, status:integer:default(1)'
                            ]); 
        //Shifts
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_shifts',
                                '--schema'=>'name:string, from:string, to:string, working_days:string:default("[]"), status:integer:default(1)'
                            ]); 
		//Pages 
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_pages',
                                '--schema'=>'title:string:nullable, sub_title:string:nullable, slug:string:nullable,description:text:nullable, content:longText:nullable, tags:text:nullable, categories:string:nullable, post_type:string:nullable, attachments:string:nullable, version:string:nullable, revision:string:nullable, created_by:string:nullable, post_status:string:nullable, status:integer:default(1), type:string'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_page_metas',
                                '--schema'=>'page_id:integer, key:string, value:text'
                            ]);
	
		//Department
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_departments',
                                '--schema'=>'name:string, description:text:nullable, status:integer:default(1)'
                            ]);
		
		//STUDENT
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_students',
                                '--schema'=>'user_id:integer, student_id:integer:nullable, dob:string:nullable,  qualification:string:nullable, college_university:string:nullable, joining_date:dateTime:nullable, status:integer:default(0)'
                            ]);


		//TEAM MIGRATION
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_teams',
                                '--schema'=>'title:string, description:text:nullable, member_ids:text:nullable'
                            ]);
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_document',
                                '--schema'=>'title:string, description:text:nullable, layout:integer, template:integer, status:integer, order:integer'
                            ]);
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_document_layout',
                                '--schema'=>'name:string, header:text:nullable, footer:text:nullable, order:integer, slug:string'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_document_template',
                                '--schema'=>'name:string, content:text:nullable, subject:string:nullable, slug:string, status:integer, order:integer'
                            ]);

		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_support_tickets',
                                '--schema'=>'user_id:integer , title:string, description:text, type:string:nullable, assign_to:string:nullable, end:dateTime:nullable, priority:string:default("low"), status:integer:default(0)'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_support_ticket_metas',
                                '--schema'=>'user_id:integer ,key:string, value:text'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_contacts',
                                '--schema'=>'name:string , email:string'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_contact_metas',
                                '--schema'=>'contact_id:integer, key:string , value:text'
         
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_clients',
                                '--schema'=>'name:string, company_name:string:nullable, address:string:nullable, country:string:nullable, state:string:nullable, city:string:nullable, user_id:integer:nullable, phone:string:nullable, additional_info:text:nullable'
                            ]);
	

		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_attendances',
                                '--schema'=>'employee_id:string, user_id:integer:nullable, shift_id:integer:nullable, date:string, month:string, year:string, day:string:nullable, punch_in_out:string:nullable, month_week_no:integer:nullable, total_hour:string:nullable, actual_hour:string:nullable, over_time:string:nullable, due_time:string:nullable, import_data:string:nullable, attendance_status:string:nullable, submited_by:string:nullable, check_for_checkin_checkout:string:null, in_out_data:string:nullable, lock_status:integer:default(1), deleted_at:timestamp:nullable'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_holidays',
                                '--schema'=>'title:string:nullable, description:text:nullable , date_of_holiday:date, status:integer:default(1)'
                            ]);
		
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_employee_short_leave',
                                '--schema'=>'employee_id:string, reason_of_leave:string:nullable, description:text:nullable, from:string, to:string,  approved_status:integer:default(0), approved_by:string:nullable'
                            ]);
		Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_projects',
                                '--schema'=>'name:text, description:text:nullable, tags:text:nullable, category:string:nullable'
                            ]);
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_products',
                                '--schema'=>'type:integer, name:string, description:text:nullable'
                            ]);
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_product_meta',
                                '--schema'=>'product_id:integer, key:string, value:text:nullable'
                            ]);
      
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_invoices',
                                '--schema'=>'invoice_no:integer, customer_id:integer, payment_method_id:integer, total:integer, status:integer:default(0)'
                            ]);
      
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_order_details',
                                '--schema'=>'invoice_id:integer, item_id:integer, units:integer, unit_price:decimal(10,2), total:decimal(10,2)'
                            ]);
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_pay_scale',
                                '--schema'=>'title:string:nullable, description:string:nullable, currency:string:nullable, pay_cycle:string:nullable, pay_scale:decimal(10,2):nullable, basic_pay:decimal(10,2):nullable, grade_pay:decimal(10,2):nullable, ta:decimal(10,2):nullable, da:decimal(10,2):nullable, sa:decimal(10,2):nullable, hra:decimal(10,2):nullable, epf_addiction:decimal(10,2):nullable, epf_deducation:decimal(10,2):nullable, sa_details:string:nullable, total_salary:decimal(10,2):nullable, gross_salary:decimal(10,2):nullable'
                            ]);

        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_salaries',
                                '--schema'=>'employee_id:string, user_id:integer, payscale_id:integer, designation:string:nullable, department:string:nullable, payscale:string:nullable, shift:string:nullable, year:string, month:string, week:string:nullable, salary:decimal(10,2):nullable, no_of_leave:string:nullable, monthly_weekly:string:nullable, number_of_attendance:integer:nullable, hours:string:nullable, over_time:string:nullable, short_hours:string:nullable, per_day_amount:decimal(10,2):nullable, total_days:integer:nullable, lock:integer, status:integer:default(1)']);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_project_categories',
                                '--schema'=>'name:text, description:text:nullable, status:integer:default(1)'
                            ]);
		//_project_metas
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_project_metas',
                                '--schema'=>'project_id:integer, key:string , value:text, type:string'
                            ]);
		//_project_tasks
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_project_tasks',
                                '--schema'=>'project_id:integer, title:string, description:text:nullable, assign_to:string:nullable, priority:string:default("low"), attachment:text:nullable, end_date:dateTime:nullable, status:integer:default(0)'
                            ]);
		//ORGANIZATION TODOS
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_project_todos',
                                '--schema'=>'project_id:integer, user_id:integer, title:string, description:text:nullable, start:dateTime:nullable, end:dateTime:nullable, priority:string:default("low"), status:integer:default(1)'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_project_notes',
                                '--schema'=>'project_id:integer, title:string, description:text:nullable, status:integer:default(1)'
                            ]);
		//ORGANIZATION METAS
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_organization_settings',
                                '--schema'=>'key:string , value:text:nullable, type:string'
                            ]);
		//ORGANIZATION METAS
		
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_services',
                                '--schema'=>'name:string, description:text:nullable,  cost:string:nullable, status:integer:default(0)'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_service_metas',
                                '--schema'=>'service_id:integer , key:string, value:text'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_orders',
                                '--schema'=>'name:string , description:text:nullable, cost:string:nullable, quantity:string:nullable, status:integer:default(0)'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_order_metas',
                                '--schema'=>'order_id:integer , key:string, value:text'
                            ]);
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_datasets',
                                '--schema'=>'dataset_name:string, description:text:nullable, dataset_table:string, dataset_file:string, dataset_file_name:string, user_id:string, defined_columns:longtext, uploaded_by:string'
                            ]);

        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_dataset_meta',
                                '--schema'=>'dataset_id:integer, key:string, value:text:nullable'
                            ]);

        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_maps',
                                '--schema'=>'table_code:string, code:string, code_albha_2:string, code_albha_3:string, code_numeric:string, parent:integer, title:string, description:text, map_data:longText, status:boolean'
                            ]);

        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_visualizations',
                                '--schema'=>'dataset_id:integer, name:string, description:text, embed_token:string, created_by:string'
                            ]);

        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_visualization_charts',
                                '--schema'=>'visualization_id:integer, chart_title:text, primary_column:string, secondary_column:text, chart_type:string, status:string'
                            ]);

        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_visualization_chart_meta',
                                '--schema'=>'visualization_id:integer, chart_id:integer, key:text, value:text:nullable'
                            ]);

        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_visualization_meta',
                                '--schema'=>'visualization_id:integer, key:text, value:text'
                            ]);
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_applicants',
                                '--schema'=>'user_id:integer, status:integer:default(1)'
                            ]);
         /*Artisan::call('make:migration:schema',[ // No need to generate
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_applicant_metas',
                                '--schema'=>'applicant_id:integer, key:string, value:text' 
                            ]);*/
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_openings',
                                '--schema'=>'title:string:nullable, minimum_qualification:string:nullable, eligiblity:string:nullable,department:string:nullable, designation:string:nullable, skills:string:nullable, job_type:string:nullable, location:string:nullable, number_of_post:string:nullable'
                            ]);
          Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_opening_meta',
                                '--schema'=>'opening_id:integer, key:string, value:text'
                            ]);
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_applications',
                                '--schema'=>'applicant_id:integer, opening_id:integer, status:integer:default(1)'
                            ]);
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_application_meta',
                                '--schema'=>'application_id:integer, key:string, value:text'
                            ]);
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_forms',
                                '--schema'=>'form_title:string, form_slug:string, form_description:text, type:string, embed_token:text, form_order:integer, form_status:string, created_by:integer'
                            ]);
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_form_fields',
                                '--schema'=>'field_slug:string:nullable, form_id:integer, section_id:integer, field_title:string, field_type:string:nullable, field_description:text, order:integer:nullable, status:string'
                            ]);
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_form_field_meta',
                                '--schema'=>'form_id:integer, section_id:integer, field_id:integer, key:string, value:text:nullable' 
                            ]);
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_form_meta',
                                '--schema'=>'form_id:integer, key:string, value:text:nullable, type:string'
                            ]);
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_form_sections',
                                '--schema'=>'form_id:integer, section_name:string, section_slug:text:nullable, section_description:text:nullable, order:integer, status:string'
                            ]);
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_form_section_meta',
                                '--schema'=>'section_id:integer, key:string, value:text'
                            ]);
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_email_layout',
                                '--schema'=>'name:string, header:text,footer:text, order:integer, slug:string'
                            ]);
      /*  Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_email',
                                '--schema'=>'name:string, content:text, order:integer, slug:string'
                            ]);*/
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_email_template',
                                '--schema'=>'name:string, content:text, subject:string, status:integer, order:integer, slug:string'
                            ]);
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_email_template_meta',
                                '--schema'=>'key:string, value:text, template_id:integer,type:string, status:integer:default(1)'
                            ]);
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_bookmarks',
                                '--schema'=>'title:string, link:text, target:string, user_id:string, categories:string, tags:string, order:integer, status:integer'
                            ]);
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_campaigns',
                                '--schema'=>'campaign_name:string, campaign_desc:text:nullable, send_to:text, selected_users:text, layout:integer, template:integer, send_to_users:text, scheduled:boolean:default(0), exec_time:dateTime:nullable'
                            ]);
		//Menu 
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_menus',
                                '--schema'=>'name:string, order:integer, status:integer:default(1)']);         
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_menu_settings',
                                '--schema'=>'menu_id:integer, key:string, value:text:nullable,order:integer']);            
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_menu_items',
                                '--schema'=>'label:string, link:string, parent:integer:default(0), sort:integer:default(0), class:string:nullable, target:string:nullable, menu:integer,depth:integer:default(0)']);            
		Artisan::call('migrate');
        // $userTypes = [
        //     ['type'=>'Admin','status'=>1],
        //     ['type'=>'Employee','status'=>1],
        //     ['type'=>'Customer','status'=>1],
        //     ['type'=>'Student','status'=>1],
        // ];
        // UsersType::insert($userTypes);
            $roleData[] =   ['name'=>'Administrator', 'description'=>'Administrator', 'order'=>1, 'slug'=>'administrator', 'status'=>1];
            $roleData[] =   ['name'=>'Employee', 'description'=>'Employee', 'order'=>2, 'slug'=>'employee', 'status'=>1];
            $roleData[] =   ['name'=>'Client', 'description'=>'client', 'order'=>3, 'slug'=>'client', 'status'=>1];
            $roleData[] =   ['name'=>'Student', 'description'=>'Student', 'order'=>4, 'slug'=>'student', 'status'=>1];
            $roleData[] =   ['name'=>'Intern', 'description'=>'Intern', 'order'=>5, 'slug'=>'intern', 'status'=>1];
            $roleData[] =   ['name'=>'Applicant', 'description'=>'applicant - it only  for apply job .', 'order'=>6, 'slug'=>'applicant', 'status'=>1];
            foreach ($roleData as $key => $value) {
               $roles = new Role();
               $roles->fill($value);
               $roles->save();
            }
        $org_setting =[['key'=>'employee_role', 'value'=>2],['key'=>'client_role', 'value'=>3], ['key'=>'applicant_role', 'value'=>4]];
        org_setting::insert($org_setting);
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

}