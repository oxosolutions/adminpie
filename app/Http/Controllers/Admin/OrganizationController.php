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
use App\Model\Admin\GlobalModule;
use App\Model\Admin\GlobalSetting;
use App\Model\Organization\RolePermisson as Permisson;
use App\Model\Organization\UsersRole as Role;
use App\Model\Organization\OrganizationSetting as org_setting;
use App\Model\Organization\UserRoleMapping;

class OrganizationController extends Controller
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
        $datalist= [];
        if($request->has('per_page')){
            $perPage = $request->per_page;
            if($perPage == 'all'){
                $perPage = 999999999999999;
            }
        }else{
                $perPage = 5;
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
                      'showColumns' => ['name'=>'Name','status' => 'Status','created_at'=>'Created At'],
                      'actions' => [
                                      'edit'    =>  ['title'=>'Edit','route'=>'edit.organization' , 'class' => 'edit'],
                                      'delete'  =>  ['title'=>'Delete','route'=>'delete.organization'],
                                      'clone'   =>  ['title'=>'Clone','route'=>'create.organizationClone'],
                                      'auth'    =>  ['title'=>'Login Organization','route'=>'auth.organization'],
                                      'status_option'  =>  ['title'=>'status option','class'=>'status_option' ,'route' =>'change.org.status']
                                   ],
                      'js'  =>  ['custom'=>['list-designation']],
                      'css'=> ['custom'=>['list-designation']]
                  ];
       
        return view('admin.organization.list',$datalist);



  //       $org_list = ORG::select(['id','name'])->get();
  //       $plugins = [
  //               'js' => ['custom'=>['list']]
  //       ];
		// return View::make('admin.organization.list', ['org_list'=>$org_list,'plugins'=>$plugins]);
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

        Session::flash('success','Successfully deleted!');
        }catch(\Exception $e){
          // throw $e;
            DB::rollback();
            Session::flash('error','Somthing goes wrong Try again.');
        }
        return redirect()->route('list.organizations');
	}

	public function create(){
        $modules = GlobalModule::pluck('name','id');
		return view('admin.organization.create',['modules'=>$modules]);
	}
    public function edit(Request $request, $id){

        // try{
        //     DB::beginTransaction();
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
                return back();
                //$org_data = ORG::find($id);
            }
            $modules = GlobalModule::pluck('name','id');
            return view('admin.organization.edit',['org_data'=>$org_data,'modules'=> $modules ]);
        // }catch(Exception $e){
        //              Session::flash('error','Somthing goes wrong Try again.');
        //         return back();

        // }
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
	public function save(Request $request)
	{
        $this->validate($request, $this->valid_fields);
        if(!empty($request['modules'])) {
           $request['modules'] = json_encode($request['modules']);
        }
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
            ($return=='table_exist')? $org_usr =  User::find(1):null;
        }
        if(!$checkMaster->exists() || $return=='table_not_exist'){
            $this->create_db_through_migration($org_id);
            $org_usr = new User();
           
        }
        $org_usr->fill($request->all());

        // $org_usr->role_id = 1;
        // $org_usr->user_type = json_encode([1]);
        $org_usr->password = Hash::make($request->password);
        $org_usr->save(); 
        $userRoleMapping = UserRoleMapping::where(['user_id'=>1, 'role_id'=>1]);
        if(!$userRoleMapping->exists()){
            $userRoleMapping = new UserRoleMapping();
            $userRoleMapping->fill(['user_id'=>$org_usr->id , 'role_id'=>1]);
            $userRoleMapping->save();
        }

        Session::flash('success', 'Organization create successfully');
        return redirect()->route('list.organizations');
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
   
    protected function create_db_through_migration($org_id)
    {
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
                                '--schema'=>'name:string, email:string, password:string, api_token:char(60), remember_token:string, status:integer:default(1), user_type:string, deleted_at:timestamp:nullable'
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
                                '--schema'=>'key:string, value:string, category_id:integer, status:integer:default(1)'
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
//Shifts
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_shifts',
                                '--schema'=>'name:string, from:string, to:string: status:integer:default(1), working_days:string'
                            ]);	
	//Pages 
			Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_pages',
                                '--schema'=>'title:string:nullable, sub_title:string:nullable, slug:string:nullable,description:text:nullable, content:text:nullable, tags:text:nullable, categories:string:nullable, post_type:string:nullable, attachments:string:nullable, version:string:nullable, revision:string:nullable, created_by:string:nullable, post_status:string:nullable, status:integer:default(1), type:string'
                            ]);
				Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_page_metas',
                                '--schema'=>'page_id:integer, key:string, value:text'
                            ]);
	//EMPLOYEE
		/*Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_employees',
                                '--schema'=>'user_id:integer, employee_id:string:nullable, designation:text:nullable, department:string:nullable, marital_status:string:nullable, experience:string:nullable, blood_group:string:nullable, joining_date:dateTime:nullable, leaving_date:dateTime:nullable, disability_percentage:string:nullable, status:integer:default(0), deleted_at:timestamp:nullable'
                            ]);*/
	//Department
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_departments',
                                '--schema'=>'name:string, description:text:nullable, status:integer:default(1)'
                            ]);
		/*Artisan::call('make:migration:schema',[ // No need to generate
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_employee_meta',
                                '--schema'=>'employee_id:integer , key:string, value:text'
                            ]);*/
	//STUDENT
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_students',
                                '--schema'=>'user_id:integer, student_id:integer:nullable, dob:string:nullable,  qualification:string:nullable, college_university:string:nullable, joining_date:dateTime:nullable, status:integer:default(0)'
                            ]);

		/*Artisan::call('make:migration:schema',[ // No need to generate
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_student_meta',
                                '--schema'=>'student_id:integer, key:string, value:text'
                            ]);*/

	//TEAM MIGRATION
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_teams',
                                '--schema'=>'title:string, description:text:nullable, member_ids:text:nullable'
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
		/*Artisan::call('make:migration:schema',[ //No need to generate
								'--model'=>false,
                                'name'=>'create_'.$org_id.'_client_metas',
                                '--schema'=>'client_id:integer, key:string , value:text, type:string'
                            ]);*/

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
        // Artisan::call('make:migration:schema',[
								// '--model'=>false,
        //                         'name'=>'create_'.$org_id.'_services',
        //                         '--schema'=>'type:integer, name:string, description:text:nullable, created_by:integer:nullable, status:integer:default(1)'
        //                     ]);
        // Artisan::call('make:migration:schema',[
        //                         '--model'=>false,
        //                         'name'=>'create_'.$org_id.'_service_meta',
        //                         '--schema'=>'service_id:integer, key:string, value:text:nullable'
        //                     ]);
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_invoices',
                                '--schema'=>'invoice_no:integer, customer_id:integer, payment_method_id:integer, total:integer, status:integer:default(0)'
                            ]);
        // Artisan::call('make:migration:schema',[
        //                         '--model'=>false,
        //                         'name'=>'create_'.$org_id.'_orders',
        //                         '--schema'=>'invoice_id:integer, name:string, description:text:nullable, cost:decimal(10,2), quantity:string, status:default(1)'
        //                     ]);
        // Artisan::call('make:migration:schema',[
        //                         '--model'=>false,
        //                         'name'=>'create_'.$org_id.'_order_metas',
        //                         '--schema'=>'order_id:integer, key:string, value:text:nullable'
        //                     ]);
      
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
                                '--schema'=>'employee_id:string, payscale_id:integer, year:string, month:string, week:string:nullable, amount:decimal(10,2), no_of_leave:string, payscale:string, lock:integer, monthly_weekly:string, status:integer:default(1)'
                            ]);
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
                                '--schema'=>'key:string , value:text:nullable'
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
                                '--schema'=>'dataset_name:string, description:text, dataset_table:string, dataset_file:string, dataset_file_name:string, user_id:string, uploaded_by:string'
                            ]);
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_maps',
                                '--schema'=>'table_code:string, code:string, code_albha_2:string, code_albha_3:string, code_numeric:string, parent:integer, title:string, description:text, map_data:longText, status:boolean'
                            ]);

        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_visualizations',
                                '--schema'=>'dataset_id:integer, name:string, description:text, created_by:string'
                            ]);

        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_visualization_charts',
                                '--schema'=>'visualization_id:integer, chart_title:text, primary_column:string, secondary_column:text, chart_type:string, status:string'
                            ]);

        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_visualization_chart_meta',
                                '--schema'=>'visualization_id:integer, chart_id:integer, key:text, value:text'
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
                                '--schema'=>'form_id:integer, section_id:integer, field_id:integer, key:string, value:string:nullable' 
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
                                '--schema'=>'name:string, content:text, order:integer, slug:string'
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
                                'name'=>'create_'.$org_id.'_bookmarks',
                                '--schema'=>'title:string, link:text, target:string, user_id:string, categories:string, tags:string, order:integer, status:integer'
                            ]);
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_campaigns',
                                '--schema'=>'campaign_name:string, campaign_desc:text:nullable, send_to:text, selected_users:text, layout:integer, template:integer, send_to_users:text, scheduled:boolean:default(0), exec_time:dateTime:nullable'
                            ]);
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_surveys',
                                '--schema'=>'survey_table:string, name:string:nullable, created_by:string:nullable, description:text, status:integer:default(1)']);
//Menu 
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_menus',
                                '--schema'=>'title:string, description:text:nullable, order:integer, status:integer:default(1)']);         
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_menu_settings',
                                '--schema'=>'menu_id:integer, key:string, value:text:nullable,order:integer']);            
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org_id.'_menu_items',
                                '--schema'=>'menu_id:integer, label:string:nullable, description:text:nullable, title:string:nullable, class:string:nullable, title_attribute:string:nullable, link:string:nullable, target:string:nullable, type:string:nullable, parent:integer:nullable, order:integer:nullable, icon:string:nullable, status:integer:default(1)']);            
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

