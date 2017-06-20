<?php

	/****************************************** All Routes For Admin *************************************************/

	Route::group(['domain' => 'manage.adminpie.com'], function () {
		Route::group(['namespace'=>'Admin'], function(){

			Route::group(['middleware' => 'auth.admin'], function(){
			//Widget Route
				Route::get('widgets', ['as'=>'index.widget' , 'uses'=>'WidgetController@index']);
				Route::get('widget/delete/{id}', ['as'=>'delete.widget' , 'uses'=>'WidgetController@delete']);

				Route::match(['get', 'post'],'widget/create', ['as'=>'create.widget' , 'uses'=>'WidgetController@create']);
				Route::match(['get', 'post'],'widget/edit/{id?}', ['as'=>'edit.widget' , 'uses'=>'WidgetController@edit']);
				Route::post('widget/status/update', ['as'=>'status.widget' , 'uses'=>'WidgetController@update_widget_status']);
	
				// Route::post('widget/create', ['as'=>'create.widget' , 'uses'=>'WidgetController@create']);


			//Module route
				Route::get('/module/create',['as'=>'create.module' , 'uses'=>'ModuleController@create']);
				Route::post('/module/save',['as'=>'save.module' , 'uses'=>'ModuleController@save']);
				Route::match(['get','post'],'/module/edit/{id?}',['as'=>'edit.module' , 'uses'=>'ModuleController@edit']);
				Route::post('/module/update/{id}',['as'=>'update.module' , 'uses'=>'ModuleController@update']);
				Route::get('/module/delete/{id}',['as'=>'delete.module' , 'uses'=>'ModuleController@delete']);
				Route::get('/modules',['as'=>'list.module' , 'uses'=>'ModuleController@listModule']);
				Route::get('module/add_route_row',['as'=>'route_row.module' , 'uses'=>'ModuleController@add_route_row']);
				Route::get('module/route/delete/{id}',['as'=>'delete.route' , 'uses'=>'ModuleController@delete_route']);
				Route::post('/module/status/update',['as'=>'status.module' , 'uses'=>'ModuleController@update_module_status']);


			//Module route end
			//admin users
				Route::group(['prefix'=>'users'],function(){
					Route::get('/', 				['as'=>'admin_users','uses'=>'UsersController@index']);
					Route::get('/list', 			['as'=>'list.users','uses'=>'UsersController@list_user']);
					Route::get('/new-list-design', 	['as'=>'new.list.design','uses' => function(){
						return view('admin.users.newList');
					}]);
					Route::get('/delete/user',		['as'=>'delete.user' , 'uses' => 'UsersController@deleteUser']);
					Route::POST('/create/user',		['as'=>'create.user' , 'uses' => 'UsersController@createUser']);
					Route::get('/user/{id}',		['as'=>'user.get' , 'uses' => 'UsersController@getUserById']);
					Route::POST('/edit/user/{id}',	['as'=>'user.edit' , 'uses' => 'UsersController@editUser']);
				});

				Route::get('/',							['as'=>'admin.dashboard','uses'=>'DashboardController@index']);
				Route::get('/organization/create',		['as'=>'create.organization','uses'=>'OrganizationController@create']);
				Route::post('/organization/save',		['as'=>'save.organization','uses'=>'OrganizationController@save']);
				Route::get('/organization/list',		['as'=>'list.organizations','uses'=>'OrganizationController@listOrg']);
				Route::get('/organization/delete/{id}',	['as'=>'delete.organization','uses'=>'OrganizationController@delete']);
				Route::match(['get','post'],'/organization/edit/{id?}',	['as'=>'edit.organization','uses'=>'OrganizationController@edit']);


				/*
				* All Routes For Form Builder
				*/
				Route::POST('/create',				['as'=>'create.forms','uses'=>'FormBuilderController@createForm']);
				Route::get('/forms',				['as'=>'list.forms','uses'=>'FormBuilderController@listForm']);
				Route::get('/forms/delete/{id}',	['as'=>'delete.form','uses'=>'FormBuilderController@deleteForm']);
				Route::get('/form/sections/{form_id}',['as'=>'list.sections','uses'=>'FormBuilderController@sectionsList']);
				Route::post('/create/sections/{id}',		['as'=>'create.sections','uses'=>'FormBuilderController@createSection']);
				Route::get('/delete/sections/{id}',	['as'=>'del.section','uses'=>'FormBuilderController@deleteSection']);
				Route::get('/form/create',			['as'=>'create.form','uses'=>'FormBuilderController@index']);
				Route::get('/forms/fields/{form_id}/{section_id}',['as'=>'list.field','uses'=>'FormBuilderController@listFields']);
				Route::get('/delete/field',			['as'=>'del.field','uses'=>'FormBuilderController@deleteField']);
				Route::post('/update/field/{form_id}/{section_id}',['as'=>'update.field','uses'=>'FormBuilderController@updateField']);
				Route::get('/form/row',				['as'=>'form.row','uses'=>'FormBuilderController@addRow']);
				Route::post('/form/store/{form_id}/{section_id}',['as'=>'form.store','uses'=>'FormBuilderController@store']);
				Route::get('/form/field',			['as'=>'form.field','uses'=>'FormBuilderController@formFields']);
				Route::get('/form/edit/{id}',		['as'=>'form.edit','uses'=>'FormBuilderController@editForm']);
				Route::get('/form/update/{id}',		['as'=>'form.udpate','uses'=>'FormBuilderController@updateForm']);
				Route::get('/field/delete/{id}',		['as'=>'field.delete','uses'=>'FormBuilderController@deletefield']);

				/************************************************************************************************************/

			});
			//settings
			Route::get('settings', ['as' => 'list.settings' , 'uses' => 'SettingController@list_setting']);
			
			Route::get('logout',  		['as'=> 'admin.logout','uses'=>'Auth\LoginController@logout']);
			Route::get('login',			['as'=>'admin.login','uses'=>'Auth\LoginController@showLoginForm']);
			Route::post('login',		['as'=>'login.post','uses'=>'Auth\LoginController@login']);
			Route::get('create/page',	['as'=> 'create.pages' , 'uses' => 'PagesController@create']);
			Route::post('/store/pages',	['as'=> 'store.pages' , 'uses' => 'PagesController@store']);
			Route::get('pages',	['as'=> 'admin.pages' , 'uses' => 'PagesController@listPages']);
			

		});
	});

	/******************************* All Routes For Admin *******************************************/


	/******************************* All Routes For Organization ************************************/
		Route::group(['namespace'=>'Organization'], function(){
			Route::get('logout',['as'=>'org.logout','uses'=>'Auth\LoginController@logout']);

			Route::group(['middleware' => 'auth.org'], function(){

				//visualization
				Route::get('view/visual' , ['as'=>'view.visual' , 'uses' => function(){
					return view('organization.visualization.view');
				}]);
				Route::get('edit/visual' , ['as'=>'edit.visual' , 'uses' => function(){
					return view('organization.visualization.edit');
				}]);
				Route::get('/list/visual' , ['as'=>'list.visual' , 'uses' => function(){
					return view('organization.visualization.list');
				}]);
				
				Route::get('/',['as'=>'organization.dashboard','uses'=>'DashboardController@index']);
				//profile
				
				Route::group(['prefix' => 'account','namespace' => 'account'],function(){
					Route::get('/emails',['as'=>'account.emails','uses'=>'AccountController@emailsList']);
					Route::get('/profile/{id?}',['as'=>'account.profile','uses'=>'AccountController@profileDetails']);
					Route::patch('/profile/update/{id}',['as'=>'update.profile','uses'=>'AccountController@update']);
					Route::get('/activities',['as'=>'account.activities','uses'=>function(){
						return view('organization.profile.activities');
					}]);
					Route::get('/attandance',['as'=>'account.attandance','uses'=>function(){
						return view('organization.profile.myattandance');
					}]);
					Route::any('/leaves',['as'=>'account.leaves','uses'=>'hrm\EmployeeLeaveController@index']);
					Route::get('/tasks',['as'=>'account.tasks','uses'=>function(){
						return view('organization.profile.tasks');
					}]);
					Route::get('/todo',['as'=>'account.todo','uses'=>function(){
						return view('organization.profile.to-do');
					}]);
					Route::get('/ToDo/{id}',['as'=>'view.todo','uses'=>function(){
						return view('organization.profile.view_todo');
					}]);
					Route::get('/notes',['as'=>'account.notes','uses'=>function(){
						return view('organization.profile.notes');
					}]);
					Route::get('/performance',['as'=>'account.performance','uses'=>function(){
						return view('organization.profile.performance');
					}]);
					Route::get('/projects',['as'=>'account.projects','uses'=>function(){
						return view('organization.profile.projects');
					}]);
					
					Route::get('/salary',['as'=>'account.salary','uses'=>function(){
						return view('organization.profile.salary');
					}]);
					Route::get('/chat',['as'=>'account.chat','uses'=>function(){
						return view('organization.profile.chat');
					}]);
					Route::get('/discussion',['as'=>'account.discussion','uses'=>function(){
						return view('organization.profile.discussion');
					}]);
					Route::get('/profile/edit',['as'=>'profile.edit','uses'=>function(){
						return view('organization.profile.edit');
					}]);
					Route::get('/profile/changepassword',['as'=>'profile.changepassword','uses'=>function(){
						return view('organization.profile.changepassword');
					}]);
				});
				//Pages 
					Route::get('/pages',		['as'=>'list.pages' , 'uses'=>'PagesController@listPage' ]);
					Route::get('/page/{id}',	['as'=>'edit.pages' , 'uses'=>'PagesController@edit' ]);
					Route::post('/page/save',	['as'=>'store.page' , 'uses'=>'PagesController@save' ]);
					Route::post('/page/update',	['as'=>'update.page' , 'uses'=>'PagesController@update' ]);

				//TEAM MANAGEMENT ROUTES

					Route::get('teams',				['as'=>'list.team' , 'uses'=>'ManageTeamController@listTeam']);
					Route::get('team/{id}',			['as'=>'info.team' , 'uses'=>'ManageTeamController@info']);
					Route::post('team/save',		['as'=>'save.team' , 'uses'=>'ManageTeamController@save']);
					Route::post('team_info/save',	['as'=>'save.team_info' , 'uses'=>'ManageTeamController@save_info']);

				
				//Employee	

							

				Route::group(['prefix'=>'hrm', 'namespace' => 'hrm'],function(){

					Route::get('log',['as'=>'list.log', 'uses'=>'LogsystemController@viewLog']);
					Route::post('log',['as'=>'search.log', 'uses'=>'LogsystemController@search_log']);
	
					Route::group(['middleware'=>'log'],function(){

						Route::any('employee/leave/{id?}',['as'=>'list.employeeleave' , 'uses'=>'EmployeeLeaveController@index']);
						//Route::get('employee/leave',['as'=>'list.employeeleave' , 'uses'=>'EmployeeLeaveController@index']);


						//ROLE PERMISSON ROUTE
						// Route::get('role/create',['as'=>'create.role', 'uses'=>'UserRoleController@create']);
						Route::get('roles',['as'=>'list.role', 'uses'=>'UserRoleController@listRole']);
						Route::post('role/save',['as'=>'role.store', 'uses'=>'UserRoleController@save']);
						Route::get('role/assign/{id}',['as'=>'role.assign', 'uses'=>'UserRoleController@assign']);
						Route::post('role_permisson_save',['as'=>'save.role_permisson', 'uses'=>'UserRoleController@role_permisson_save']);
						
						//END ROLE PERMISSON ROUTE
						//employee
							Route::get('employees', 				[ 'middleware'=>'log' ,'as' => 'list.employee' , 'uses' => 'EmployeeController@index']);
							Route::post('employee/save', 			['as' => 'store.employee' , 'uses' => 'EmployeeController@save']);
							Route::post('employee/edit', 			['as' => 'edit.employee' , 'uses' => 'EmployeeController@editEmployee']);
							Route::get('employee/delete/{id}', 			['as' => 'delete.employee' , 'uses' => 'EmployeeController@delete']);
							Route::post('employee/update', 			['as' => 'update.employee' , 'uses' => 'EmployeeController@update']);
							Route::post('employee/update/name',		['as' => 'update.employee.name', 'uses'=> 'EmployeeController@updateEmployeeName']);
							
							// Route::get('designations/list/ajax',	['as' => 'designations.list.ajax','uses'=> 'EmployeeController@getDesignationList']);
							// Route::post('update/designation',		['as' => 'update.user.designation','uses'=> 'EmployeeController@updateUserDesignation']);
							


							Route::get('employee/list/ajax',		['as' => 'employee.list.aax','uses'=> 'EmployeeController@getEmployeeList']);
						//leave Category
							Route::get('leave-categories',			['as' => 'leave.categories' , 'uses' =>'LeaveCategoryController@index']);
							Route::post('leave/category_status',	['as' => 'status.leaveCat' , 'uses' =>'LeaveCategoryController@manage_status']);

							Route::post('leave/categories/save',	['as' => 'store.leaveCat' , 'uses' =>'LeaveCategoryController@save']);
							Route::post('leave/categories/update',	['as' => 'update.leaveCat' , 'uses' =>'LeaveCategoryController@update']);
							Route::any('category/meta/{id?}',		['as' => 'meta.category' , 'uses' =>'LeaveCategoryController@categoryMeta']);
							Route::get('category/delete/{id}',		['as' => 'delete.category','uses'=>'LeaveCategoryController@delete']);
							Route::post('category/edit',		['as' => 'edit.category','uses'=>'LeaveCategoryController@editLeaveCat']);

						//Leave
							Route::get('leaves/{id?}',			['as' => 'leaves' , 'uses' =>'LeavesController@index']);
							Route::post('leave/save',		['as' => 'store.leave' , 'uses' =>'LeavesController@save']);
							Route::post('leave/update',		['as' => 'update.leave' , 'uses' =>'LeavesController@update']);
							Route::get('leave/delete/{id}',		['as' => 'delete.leave' , 'uses' =>'LeavesController@delete']);
							Route::POST('leave/edit',		['as' => 'edit.leave' , 'uses' =>'LeavesController@editLeave']);

						//shifts
							Route::get('shifts/{id?}',		['as' => 'shifts' , 'uses' =>'ShiftsController@index']);
							Route::post('shifts/save',	['as' => 'store.shifts' , 'uses' =>'ShiftsController@save']);
							Route::post('shifts/update',['as' => 'update.shifts' , 'uses' =>'ShiftsController@update']);
							Route::get('shifts/delete/{id}',	['as' => 'delete.shifts' , 'uses' =>'ShiftsController@delete']);		
							Route::post('shift/edit/{id?}',	['as' => 'edit.shifts' , 'uses' =>'ShiftsController@editShifts']);		
						//Leaves
							Route::get('leaves-categories',	['as' => 'leaves_categories' , 'uses' => 'LeavesController@leave_categories']);
							Route::get('delete/leave-categories/{id?}',	['as' => 'delete.leaves_categories' , 'uses' => 'LeavesController@deleteLeaveCategories']);
						//attendance ajax
						//widget permission
							Route::post('widget_permission_save',	['as' => 'save.widget_permission' , 'uses' => 'UserRoleController@widget_permission_save']);

							Route::get('/attendance/list', ['as' => 'ajax.list.attendance' , 'uses' =>'AttendanceController@ajax']);
							Route::post('/attendance/list',				['as' => 'ajax.list.attendance' , 'uses' => 'AttendanceController@ajax']);


						//attendance
							Route::match(['get','post'],'attendance/hr', ['as'=>'hr.attendance', 'uses' => 'AttendanceController@attendance_by_hr']);
							Route::post('attendance/hr_fill',		[ 'as'=>'hr_store.attendance', 'uses' => 'AttendanceController@attendance_fill_hr']);
							Route::post('attendance/check_in_out',	['as' => 'checkinout.attendance' , 'uses' => 'AttendanceController@check_in_out']);
							Route::get('/design_attendance',		[ 'uses' => 'AttendanceController@design_attendance']);
							Route::post('/attendance',		['as' => 'filter' , 'uses' => 'AttendanceController@list_attendance']);
							Route::get('/attendance',				['as' => 'list.attendance' , 'uses' => 'AttendanceController@list_attendance']);
							Route::post('/attendance/import',		['as' => 'upload.attendance' , 'uses' => 'AttendanceController@attendance_import']);
							Route::get('/attendance/import/form',		['as' => 'import.form.attendance' , 'uses' => 'AttendanceController@import_form']);
							Route::get('import',['as' => 'import' ,'uses' => function(){
								return view('organization.attendance.import_attendance');
							}]);

						//holidays
							Route::post('/holiday_save',		['as' => 'store.holiday' , 'uses' => 'HolidayController@save']);
							Route::get('/holidays/{id?}',		['as' => 'list.holidays' , 'uses' => 'HolidayController@listHoliday']);
							Route::get('/holidays/edit/{id}',	['as' => 'edit.holiday' , 'uses' => 'HolidayController@edit']);
							Route::post('/holiday/update',		['as' => 'update.holiday' , 'uses' => 'HolidayController@update']);
							Route::post('/holiday/edit',		['as' => 'edit.holiday' , 'uses' => 'HolidayController@editHoliday']);
							Route::get('/holiday/delete/{id}',	['as' => 'delete.holiday' , 'uses' => 'HolidayController@deleteHoliday']);

						//Application
							Route::get('/applications',		['as' => 'applications' , 'uses' => 'ApplicationController@index']);

						//Mail
							Route::get('/mails',		['as' => 'mails' , 'uses' => 'MailController@index']);

						//Applicants
							Route::get('/applicants',		['as' => 'applicants' , 'uses' => 'ApplicantsController@index']);

						//Designation
							Route::get('/designations/{id?}',			[  'as' => 'designations' , 'uses' => 'DesignationsController@index']);
							Route::post('/designation/save',			['as' => 'store.designation' , 'uses' => 'DesignationsController@save']);
							Route::post('/designation/update',			['as' => 'update.designation' , 'uses' => 'DesignationsController@update']);
							Route::post('edit/designation',			['as' => 'edit.designation','uses'=> 'DesignationsController@editUserDesignation']);
							Route::get('delete/designation/{id}',		['as' => 'delete.designation','uses'=> 'DesignationsController@deleteUserDesignation']);

						//Department
							Route::get('/departments/{id?}',	['as' => 'departments' , 'uses' => 'DepartmentsController@index']);
							Route::post('/department/save',		['as' => 'store.department' , 'uses' => 'DepartmentsController@save']);
							Route::get('/department/update',	['as' => 'update.department' , 'uses' => 'DepartmentsController@update']);
							Route::post('/department/edit',	['as' => 'edit.department' , 'uses' => 'DepartmentsController@editDepartment']);
							Route::get('/department/delete/{id?}',	['as' => 'delete.department' , 'uses' => 'DepartmentsController@delete']);


						//Forms
							Route::get('/forms', ['as' => 'forms' , 'uses' => 'FormsController@forms']);
					});
				});
				Route::group(['prefix'=>'crm','namespace' => 'crm'],function(){
					//CLIENT Routes

					Route::get('client/create',			['as'=>'create.client','uses'=>'ClientController@create']);
					Route::post('client/save',			['as'=>'save.client','uses'=>'ClientController@save']);
					Route::get('client/list',			['as'=>'list.client','uses'=>'ClientController@listClients']);
					Route::get('client/view/{id}',		['as'=>'view.client','uses'=>'ClientController@view']);
					Route::get('client/edit/{id}',		['as'=>'edit.client','uses'=>'ClientController@edit']);
					Route::post('client/update/{id}',	['as'=>'update.client','uses'=>'ClientController@update']);
					Route::get('client/delete/{id}',	['as'=>'delete.client','uses'=>'ClientController@delete']);
					//Services
						Route::get('/services',['as'=>'list.services','uses'=>'ServicesController@index']);
					//customer
						Route::get('/customer',['as'=>'list.customer','uses'=>'CustomerController@index']);
					//Invoice
						Route::get('/invoices',['as'=>'list.invoice','uses'=>'BillingController@invoice']);
					//billing
						Route::get('/billings',['as'=>'list.billing','uses'=>'BillingController@billing']);
					//products
						Route::get('/products',['as'=>'list.products','uses'=>'ProductsController@index']);
					//Leads
						Route::get('/leads',['as'=>'leads','uses'=>'LeadsController@index']);
					//sales
						Route::get('/sales',['as'=>'sales','uses'=>'SalesController@index']);
					//pricing
						Route::get('/pricing',['as'=>'pricing','uses'=>'BillingController@pricing']);
					//pricing
						Route::get('/payment-methods',['as'=>'payment-methods','uses'=>'BillingController@payment_method']);
				});




				Route::group(['prefix'=>'projects','namespace' => 'project'],function(){
					//project
						//notes
						Route::get('project/notes/list',	['as'=>'list.notes','uses'=>'NotesController@listNotes']);
						Route::get('project/notes/{id}',	['as'=>'notes.project','uses'=>'NotesController@index']);
						Route::post('project/notes/save',	['as'=>'save.notes','uses'=>'NotesController@createNotes']);
						Route::post('project/notes/edit',	['as'=>'edit.notes','uses'=>'NotesController@edit']);
						// end notes
						Route::get('categories',['as'=>'categories.project','uses'=>'ProjectController@categories']);
						Route::post('category/save',		['as'=>'save.category','uses'=>'ProjectController@saveCategory']);
						Route::post('category/update',		['as'=>'update.category','uses'=>'ProjectController@updateCategory']);
						Route::get('project/{id}',			[ 'as'=>'add_project_info.project' , 'uses'=>'ProjectController@add_project_info']);
						Route::post('project_info/save',	['as'=>'save.project_meta' , 'uses'=>'ProjectController@save_project_meta']);
						Route::get('project/view/{id}',		['as'=>'view.project','uses'=>'ProjectController@view']);
						Route::post('project/add_client',	['as'=>'add_client.project','uses'=>'ProjectController@add_client']);

						Route::get('projects/list',			['as'=>'projects.list.ajax','uses'=>'ProjectController@projectsList']);
						Route::get('project/create',		['as'=>'create.project','uses'=>'ProjectController@create']);
						Route::post('project/save',			['as'=>'save.project','uses'=>'ProjectController@save']);
						Route::get('project/edit/{id}',		['as'=>'edit.project','uses'=>'ProjectController@edit']);
						Route::post('project/update/{id}',	['as'=>'update.project','uses'=>'ProjectController@update']);
						Route::get('project/details/{id}',	['as'=>'details.project','uses'=>'ProjectController@details']);
						Route::get('project/credentials/{id}',	['as'=>'credentials.project','uses'=>'ProjectController@credentials']);
						Route::get('project/activities/{id}',	['as'=>'activities.project','uses'=>'ProjectController@activities']);
						Route::get('project/calender/{id}',	['as'=>'calender.project','uses'=>'ProjectController@calender']);
						
						Route::get('project/documentation/{id}',	['as'=>'documentation.project','uses'=>'ProjectController@documentation']);
						Route::get('/project/todo/list',	['as'=>'list.todo','uses'=>'TodoController@listTodo']);
						Route::get('project/todo/{id}',	['as'=>'todo.project','uses'=>'ProjectController@todo']);
						Route::post('/project/todo/create',	['as'=>'create.todo','uses'=>'TodoController@create']);
						
						Route::POST('/project/todo/edit',	['as'=>'edit.todo','uses'=>'TodoController@edit']);
						Route::POST('/project/todo/delete',	['as'=>'delete.todo','uses'=>'TodoController@delete']);
						Route::POST('/project/todo/filter',	['as'=>'filter.todo','uses'=>'TodoController@filterData']);
						Route::get('project/test',function(){
							return view('organization.project.test');
						});
						Route::get('/',['as'=>'list.project','uses'=>'ProjectController@listProject']);
						
						//tasks
						Route::get('tasks',['as'=> 'list.tasks','uses' => 'ProjectController@tasks']);

				
				});
				Route::group(['prefix'=>'dataset','namespace' => 'dataset'],function(){
					Route::get('/list',['as' => 'list.dataset','uses' => 'DatasetController@listDataset']);
					Route::get('/import',['as' => 'import.dataset','uses' => 'DatasetController@importDataset']);
					Route::post('/import/dataset', ['as'=>'upload.dataset','uses'=>'DatasetController@uploadDataset']);
					Route::post('/dataset/save',['as'=>'save.dataset','uses'=>'DatasetController@store']);
				});
				Route::group(['prefix'=>'cms','namespace' => 'cms'],function(){
					Route::get('pages',['as'=>'pages','uses'=>'PagesController@index']);
					Route::get('posts',['as'=>'posts','uses'=>'PostsController@index']);
					Route::get('media',['as'=>'media','uses'=>'MediaController@index']);
				});
				Route::group(['prefix'=>'support','namespace' => 'support'],function(){
					Route::get('support-tickets',	['as'=>'support.tickets','uses'=>'SupportsController@index']);
					Route::get('Categories',		['as'=>'support.categories','uses'=>'SupportsController@Categories']);
					Route::get('knowledge-base',	['as'=>'knowledge-base','uses'=>'SupportsController@knowledgeBase']);
					Route::get('F&Q',	['as'=>'F&Q','uses'=>'SupportsController@FAndQ']);
				});
				Route::group(['prefix'=>'users','namespace'=>'users'],function(){
					//Users

					Route::get('/', 				['as'=>'list.user','uses'=>'UsersController@index']);
					Route::get('/users/create', 	['as'=>'create.users','uses'=>'UsersController@create']);
					Route::post('/users/store',		['as'=>'store.user','uses'=>'UsersController@store']);
					Route::get('/users/edit/{id}',	['as'=>'edit.user','uses'=>'UsersController@edit']);
					Route::get('/user/{id}',		['as'=>'info.user','uses'=>'UsersController@user_info']);
						Route::post('/user_meta',		['as'=>'save.user_meta','uses'=>'UsersController@user_meta']);
						Route::post('/user/update',		['as'=>'update.user','uses'=>'UsersController@update']);
				});

			});

			Route::get('login',		['as'=>'org.login','uses'=>'Auth\LoginController@showLoginForm']);
			Route::post('login',	['as'=>'org.login.post','uses'=>'Auth\LoginController@login']);

		});
	/****************************************** All Routes For Organization *************************************************/
	//**** Attendance Route

	Route::get('/upload_attendence_form', 	['uses' => 'AttendanceController@upload_attendence_form']);
	Route::get('/design_attendance', 		['uses' => 'AttendanceController@design_attendance']);

	/****************************************** Demo Pages for experiments *************************************************/
 
 // PLEASE IGNORE THIS
		Route::get('demo1',['as' => 'demo1','uses' => function(){
			return View::make('organization.demo.demo1');
		}]);
		Route::get('demo2',['as' => 'demo2','uses' => function(){
			return View::make('organization.demo.demo2');
		}]);
		Route::get('demo3',['as' => 'demo3','uses' => function(){
			return View::make('organization.demo.demo3');
		}]);
		Route::get('demo4',['as' => 'demo4','uses' => function(){
			return View::make('organization.demo.demo4');
		}]);
		Route::get('demo5',['as' => 'demo5','uses' => function(){
			return View::make('organization.demo.demo5');
		}]);
		Route::get('demo6',['as' => 'demo6','uses' => function(){
			return View::make('organization.demo.demo6');
		}]);
		Route::get('demo7',['as' => 'demo7','uses' => function(){
			return View::make('organization.demo.demo7');
		}]);
	Route::group(['prefix'=>'front'], function(){	 
		Route::get('clients',['as' => '.create.clients','uses' => function(){
			return View::make('front.clients.index');
		}]);

	});

	Route::get('/abc', function(){
		return view('organization.demo.demo3');
	});

	// For Front View
	Route::group(['namespace'=>'front'],function(){
		Route::get('demo',['as'=> 'demo','uses'=>function(){
			return View::make('back.front.pages.demo');
		}]);
		route::get('dashboard',['as'=>'dashboard','uses'=>function(){
			return View::make('back.front.pages.dashboard.dashboard');
		}]);
	});
	
