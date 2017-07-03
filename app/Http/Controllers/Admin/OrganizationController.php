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
use App\Model\Admin\GlobalModule;
// use App\Repositories\Organization\OrganizationRepositoryContract;


class OrganizationController extends Controller
{
     protected $valid_fields  = [
                'email' => 'bail|required|unique:global_organizations|email',
                'slug'  =>   'bail|required|unique:global_organizations|regex:/^[a-z0-9]+$/|min:3|max:300',
                'primary_domain'=> 'unique:global_organizations',//pendinggg
                'name' => 'required|unique:global_organizations|max:300',
                'password'=>'required|min:8',
                'confirm_password'=>'required|same:password'
                ];

	public function listOrg()
	{
       $org_list = ORG::select(['id','name'])->get();
        $plugins = [
                'js' => ['custom'=>['list']]
        ];
		return View::make('admin.organization.list', ['org_list'=>$org_list,'plugins'=>$plugins]);
	}
	public function index()
	{

      
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
          return redirect()->route('list.organizations');
        }catch(\Exception $e){
          // throw $e;
            DB::rollback();
        	return ['status'=>'error', 'message'=>'Somthing goes wrong Try again.'];
        }

	}

	public function create(){
       
     // Artisan::call('make:migration:schema',[
     //                            '--model'=>false,
     //                            'name'=>'create_employeestest',
     //                            '--schema'=>'user_id:integer, employee_id:integer, designation:text:nullable, department:string:nullable, marital_status:string:nullable, experience:string:nullable, blood_group:string:nullable, joining_date:dateTime:nullable, disability_percentage:string:nullable, status:integer:default(0)'
     //                        ]);
     // Artisan::call('migrate');
      
        $modules = GlobalModule::pluck('name','id');
		return view('admin.organization.create',['modules'=>$modules]);
	}
    public function edit(Request $request, $id){

            $org_data = ORG::find($id);
                if($request->isMethod('post')){

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
                }
                $org_data = ORG::find($id);
                $modules = GlobalModule::pluck('name','id');
        return view('admin.organization.edit',['org_data'=>$org_data,'modules'=> $modules ]);
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
        Session::put('organization_id',$org->id);
        
        //Widget Permisson
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org->id.'_widget_permissons',
                                '--schema'=>'role_id:integer, widget_id:integer:nullable, permisson:string:nullable'
                            ]);
	// USERS
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_users',
                                '--schema'=>'name:string, email:string, password:string, api_token:char(60), remember_token:string, user_type:string, role_id:integer:nullable, status:integer:default(0)'
                            ]);
          Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org->id.'_log_systems',
                                '--schema'=>'user_id:integer:nullable, type:string:nullable, route_name:string:nullable, text:text:nullable, ip_address:string:nullable'
                            ]);
       
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_users_types',
                                '--schema'=>'type:string, status:integer:default(0)'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_users_roles',
                                '--schema'=>'name:string, description:text:nullable, status:integer:default(0)'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_role_permissons',
                                '--schema'=>'role_id:integer, module_id:integer, read:string:nullable, write:string:nullable, delete:string:nullable, other:string:nullable, status:integer:default(1)'
                            ]);

		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_users_metas',
                                '--schema'=>'user_id:integer , key:string, value:text, type:string:nullable'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_users_notes',
                                '--schema'=>'user_id:integer, title:string, description:text, priority:string:default("low")'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_users_todos',
                                '--schema'=>'user_id:integer, title:string, description:text, start:dateTime:nullable, end:dateTime:nullable, priority:string:default("low"), status:integer:default(0)'
                            ]);
	Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_categories',
                                '--schema'=>'name:text, description:text:nullable, type:string, status:integer:default(1)'
                            ]);
    Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org->id.'_category_meta',
                                '--schema'=>'key:string, value:string, category_id:integer, status:integer:default(1)'
                            ]);
    

	Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_leaves',
                                '--schema'=>'name:text, employee_id:integer, reason_of_leave:string:nullable, leave_category_id:integer, from:date, to:date, description:text:nullable, total_days:integer:nullable, apply_by:string, approved_by:string:nullable, status:integer'
                            ]);

		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_designations',
                                '--schema'=>'name:string, status:integer:default(1)'
                            ]);
//Shifts
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_shifts',
                                '--schema'=>'name:string, from:string, to:string: status:integer:default(1)'
                            ]);

	
	//Pages 
			Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_pages',
                                '--schema'=>'title:string:nullable, sub_title:string:nullable, slug:string:nullable, content:text:nullable, tags:text:nullable, categories:string:nullable, post_type:string:nullable, attachments:string:nullable, version:string:nullable, revision:string:nullable, created_by:string:nullable, post_status:string:nullable, status:integer:default(1)'
                            ]);
				Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_page_metas',
                                '--schema'=>'page_id:integer, key:string, value:text'
                            ]);
	//EMPLOYEE
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_employees',
                                '--schema'=>'user_id:integer, employee_id:integer, designation:text:nullable, department:string:nullable, marital_status:string:nullable, experience:string:nullable, blood_group:string:nullable, joining_date:dateTime:nullable, disability_percentage:string:nullable, status:integer:default(0)'
                            ]);
	//Department
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_departments',
                                '--schema'=>'name:string, description:text:nullable, status:integer:default(1)'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_employee_meta',
                                '--schema'=>'employee_id:integer , key:string, value:text'
                            ]);
	//STUDENT
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_students',
                                '--schema'=>'user_id:integer, student_id:integer:nullable, dob:string:nullable,  qualification:string:nullable, college_university:string:nullable, joining_date:dateTime:nullable, status:integer:default(0)'
                            ]);

		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_student_meta',
                                '--schema'=>'student_id:integer, key:string, value:text'
                            ]);

	//TEAM MIGRATION
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_teams',
                                '--schema'=>'title:string, description:text:nullable, member_ids:text:nullable'
                            ]);

		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_support_tickets',
                                '--schema'=>'user_id:integer , title:string, description:text, type:string:nullable, assign_to:string:nullable, end:dateTime:nullable, priority:string:default("low"), status:integer:default(0)'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_support_ticket_metas',
                                '--schema'=>'user_id:integer ,key:string, value:text'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_contacts',
                                '--schema'=>'name:string , email:string'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_contact_metas',
                                '--schema'=>'contact_id:integer, key:string , value:text'
         
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_clients',
                                '--schema'=>'name:string, company_name:string:nullable, address:string:nullable, country:string:nullable, state:string:nullable, city:string:nullable, email:string:nullable, phone:string:nullable, additional_info:text:nullable'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_client_metas',
                                '--schema'=>'client_id:integer, key:string , value:text, type:string'
                            ]);

		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_attendances',
                                '--schema'=>'employee_id:string, user_id:integer:nullable, shift_id:integer:nullable, date:string, month:string, year:string, day:string:nullable, month_week_no:integer:nullable, total_hour:string:nullable, actual_hour:string:nullable, over_time:string:nullable, due_time:string:nullable, import_data:string:nullable, attendance_status:string:nullable, submited_by:string:nullable, check_for_checkin_checkout:string:null, in_out_data:string:nullable, lock_status:integer:default(1), deleted_at:timestamp:nullable'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_holidays',
                                '--schema'=>'title:string:nullable, description:text:nullable , date_of_holiday:date, status:integer:default(1)'
                            ]);

		
		
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_employee_short_leave',
                                '--schema'=>'employee_id:string, reason_of_leave:string:nullable, description:text:nullable, from:string, to:string,  approved_status:integer:default(0), approved_by:string:nullable'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_projects',
                                '--schema'=>'name:text, description:text:nullable, tags:text:nullable, category:string:nullable'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_project_categories',
                                '--schema'=>'name:text, description:text:nullable, status:integer:default(1)'
                            ]);
//_project_metas
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_project_metas',
                                '--schema'=>'project_id:integer, key:string , value:text, type:string'
                            ]);
//_project_tasks
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_project_tasks',
                                '--schema'=>'project_id:integer, title:string, description:text:nullable, assign_to:string:nullable, priority:string:default("low"), attachment:text:nullable, end_date:dateTime:nullable, status:integer:default(0)'
                            ]);
//ORGANIZATION TODOS
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org->id.'_project_todos',
                                '--schema'=>'project_id:integer, user_id:integer, title:string, description:text:nullable, start:dateTime:nullable, end:dateTime:nullable, priority:string:default("low"), status:integer:default(1)'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_project_notes',
                                '--schema'=>'project_id:integer, title:string, description:text:nullable, status:integer:default(1)'
                            ]);
//ORGANIZATION METAS
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_organization_settings',
                                '--schema'=>'key:string , value:text'
                            ]);
//ORGANIZATION METAS
		
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_services',
                                '--schema'=>'name:string, description:text:nullable,  cost:string:nullable, status:integer:default(0)'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_service_metas',
                                '--schema'=>'service_id:integer , key:string, value:text'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_orders',
                                '--schema'=>'name:string , description:text:nullable, cost:string:nullable, quantity:string:nullable, status:integer:default(0)'
                            ]);
		Artisan::call('make:migration:schema',[
								'--model'=>false,
                                'name'=>'create_'.$org->id.'_order_metas',
                                '--schema'=>'order_id:integer , key:string, value:text'
                            ]);
        Artisan::call('make:migration:schema',[
                                '--model'=>false,
                                'name'=>'create_'.$org->id.'_datasets',
                                '--schema'=>'dataset_name:string, description:string, datatset_table:string'
                            ]);
		Artisan::call('migrate');

		$org_usr = new User();
		$org_usr->fill($request->all()); 
		$org_usr->user_type = json_encode([1]);
		$org_usr->password = Hash::make($request->password);
		$org_usr->save();  

		$userTypes = [
        	['type'=>'Admin','status'=>1],
        	['type'=>'Employee','status'=>1],
        	['type'=>'Customer','status'=>1],
        	['type'=>'Student','status'=>1],
        ];

        UsersType::insert($userTypes);
        Session::flash('success', 'Organization create successfully');
        return redirect()->route('list.organizations');
	}

}

