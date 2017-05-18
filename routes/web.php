<?php


	/****************************************** All Routes For Admin *************************************************/
		Route::group(['prefix'=>'admin','namespace'=>'Admin'], function(){

			Route::group(['middleware' => 'auth.admin'], function(){
				Route::get('/',						['as'=>'admin.dashboard','uses'=>'DashboardController@index']);
				Route::get('/organization/create',	['as'=>'create.organization','uses'=>'OrganizationController@create']);
				Route::post('/organization/save',	['as'=>'save.organization','uses'=>'OrganizationController@save']);
				Route::get('/organization/list',	['as'=>'list.organization','uses'=>'OrganizationController@listOrg']);
			});
			
			Route::get('logout',  		['as'=> 'admin.logout','uses'=>'Auth\LoginController@logout']);
			Route::get('login',			['as'=>'admin.login','uses'=>'Auth\LoginController@showLoginForm']);
			Route::post('login',		['as'=>'admin.login.post','uses'=>'Auth\LoginController@login']);
			Route::get('create/page',	['as'=> 'create.pages' , 'uses' => 'PagesController@create']);
			Route::post('/store/pages',	['as'=> 'store.pages' , 'uses' => 'PagesController@store']);

		});

	/******************************* All Routes For Admin *******************************************/


	/******************************* All Routes For Organization ************************************/

		Route::group(['namespace'=>'Organization'], function(){

			Route::group(['middleware' => 'auth.org'], function(){

				Route::get('/',['as'=>'organization.dashboard','uses'=>'DashboardController@index']);
				//Pages 
					Route::get('/pages',		['as'=>'list.pages' , 'uses'=>'PagesController@list' ]);
					Route::get('/page/{id}',	['as'=>'edit.pages' , 'uses'=>'PagesController@edit' ]);
					Route::post('/page/save',	['as'=>'store.page' , 'uses'=>'PagesController@save' ]);
					Route::post('/page/update',	['as'=>'update.page' , 'uses'=>'PagesController@update' ]);

				//TEAM MANAGEMENT ROUTES

					Route::get('teams',				['as'=>'list.team' , 'uses'=>'ManageTeamController@list']);
					Route::get('team/{id}',			['as'=>'info.team' , 'uses'=>'ManageTeamController@info']);
					Route::post('team/save',		['as'=>'save.team' , 'uses'=>'ManageTeamController@save']);
					Route::post('team_info/save',	['as'=>'save.team_info' , 'uses'=>'ManageTeamController@save_info']);

				
				//Employee				

				Route::group(['prefix'=>'hrm','namespace' => 'hrm'],function(){
					//employee
						Route::get('employees', 				['as' => 'list.employee' , 'uses' => 'EmployeeController@index']);
						Route::post('employee/save', 			['as' => 'store.employee' , 'uses' => 'EmployeeController@save']);
						Route::post('employee/update', 			['as' => 'update.employee' , 'uses' => 'EmployeeController@update']);
						Route::post('employee/update/name',		['as' => 'update.employee.name', 'uses'=> 'EmployeeController@updateEmployeeName']);
						Route::get('designations/list/ajax',	['as' => 'designations.list.ajax','uses'=> 'EmployeeController@getDesignationList']);
						Route::post('update/designation',		['as' => 'update.user.designation','uses'=> 'EmployeeController@updateUserDesignation']);
						Route::get('employee/list/ajax',		['as' => 'employee.list.aax','uses'=> 'EmployeeController@getEmployeeList']);
					//leave Category
						Route::get('leave-categories',			['as' => 'leave.categories' , 'uses' =>'CategoryController@index']);
						Route::post('leave/categories/save',	['as' => 'store.leaveCat' , 'uses' =>'CategoryController@save']);
						Route::post('leave/categories/update',	['as' => 'update.leaveCat' , 'uses' =>'CategoryController@update']);
						Route::post('leave/rule',				['as' => 'rule.leave' , 'uses' =>'CategoryController@leave_rule']);

					//Leave
						Route::get('leaves',			['as' => 'leaves' , 'uses' =>'LeavesController@index']);
						Route::post('leave/save',		['as' => 'store.leave' , 'uses' =>'LeavesController@save']);
						Route::post('leave/update',		['as' => 'update.leave' , 'uses' =>'LeavesController@update']);


					//shifts
						Route::get('shifts',			['as' => 'shifts' , 'uses' =>'ShiftsController@index']);
						Route::post('shifts/save',		['as' => 'store.shifts' , 'uses' =>'ShiftsController@save']);
						Route::post('shifts/update',	['as' => 'update.shifts' , 'uses' =>'ShiftsController@update']);
					//Leaves
						Route::get('leaves',			['as' => 'leaves' , 'uses' => 'LeavesController@index']);
						Route::get('leaves-categories',	['as' => 'leaves_categories' , 'uses' => 'LeavesController@leave_categories']);
					//attendance ajax

				Route::get('/attendance/list',				['as' => 'ajax.list.attendance' , 'uses' => 'AttendanceController@ajax']);
				Route::post('/attendance/list',				['as' => 'ajax.list.attendance' , 'uses' => 'AttendanceController@ajax']);


					//attendance
						Route::get('attendance/hr',				['as'=>'hr.attendance', 'uses' => 'AttendanceController@attendance_by_hr']);
						Route::post('attendance/hr_fill',		[ 'as'=>'hr_store.attendance', 'uses' => 'AttendanceController@attendance_fill_hr']);
						Route::post('attendance/check_in_out',	['as' => 'checkinout.attendance' , 'uses' => 'AttendanceController@check_in_out']);
						Route::get('/design_attendance',		[ 'uses' => 'AttendanceController@design_attendance']);
						Route::post('/attendance',		['as' => 'filter' , 'uses' => 'AttendanceController@list_attendance']);
						Route::get('/attendance',				['as' => 'list.attendance' , 'uses' => 'AttendanceController@list_attendance']);
						Route::post('/attendance/import',		['as' => 'upload.attendance' , 'uses' => 'AttendanceController@attendance_import']);
						Route::get('import',['as' => 'import' ,'uses' => function(){
							return view('organization.attendance.import_attendance');
						}]);

					//holidays
						Route::post('/holiday_save',		['as' => 'store.holiday' , 'uses' => 'HolidayController@save']);
						Route::get('/holidays',				['as' => 'list.holidays' , 'uses' => 'HolidayController@list']);
						Route::get('/holidays/edit/{id}',	['as' => 'edit.holiday' , 'uses' => 'HolidayController@edit']);
						Route::post('/holiday/update',		['as' => 'update.holiday' , 'uses' => 'HolidayController@update']);

					//Application
						Route::get('/applications',		['as' => 'applications' , 'uses' => 'ApplicationController@index']);

					//Mail
						Route::get('/mails',		['as' => 'mails' , 'uses' => 'MailController@index']);

					//Applicants
						Route::get('/applicants',		['as' => 'applicants' , 'uses' => 'ApplicantsController@index']);

					//Designation
						Route::get('/designations',		['as' => 'designations' , 'uses' => 'DesignationsController@index']);
						Route::post('/designation/save',['as' => 'store.designation' , 'uses' => 'DesignationsController@save']);
						Route::post('/designation/update',['as' => 'update.designation' , 'uses' => 'DesignationsController@update']);

					//Department
						Route::get('/departments',		['as' => 'departments' , 'uses' => 'DepartmentsController@index']);
						Route::post('/department/save',		['as' => 'store.department' , 'uses' => 'DepartmentsController@save']);
						Route::post('/department/update',		['as' => 'update.department' , 'uses' => 'DepartmentsController@update']);


					//Forms
						Route::get('/forms',		['as' => 'forms' , 'uses' => 'FormsController@forms']);
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
						Route::get('project/notes/{id}',	['as'=>'notes.project','uses'=>'ProjectController@notes']);
						Route::get('project/documentation/{id}',	['as'=>'documentation.project','uses'=>'ProjectController@documentation']);
						Route::get('project/todo/{id}',	['as'=>'todo.project','uses'=>'ProjectController@todo']);
						Route::get('project/test',function(){
							return view('organization.project.test');
						});
						Route::get('/',['as'=>'list.project','uses'=>'ProjectController@list']);
						
						//tasks
						Route::get('tasks',['as'=> 'tasks','uses' => 'ProjectController@tasks']);


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

					Route::get('/', 			['as'=>'users','uses'=>'UsersController@index']);
					Route::get('/users/create', 	['as'=>'create.users','uses'=>'UsersController@create']);
					Route::post('/users/store',		['as'=>'store.user','uses'=>'UsersController@store']);
					Route::get('/users/edit/{id}',	['as'=>'edit.user','uses'=>'UsersController@edit']);
					Route::get('/user/{id}',		['as'=>'info.user','uses'=>'UsersController@user_info']);
	 				Route::post('/user_meta',		['as'=>'save.user_meta','uses'=>'UsersController@user_meta']);
	 				Route::post('/user/update',		['as'=>'update.user','uses'=>'UsersController@update']);
					Route::get('logout',  			['as'=>'org.logout','uses'=>'Auth\LoginController@logout']);
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
	