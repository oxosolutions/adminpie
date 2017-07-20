<?php

	/****************************************** All Routes For Admin *************************************************/
// Route::get('close/model' , ['as' => 'close.model', 'uses' => 'Organization\DashboardController@closeModal']);
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

				Route::get('/singlemodule/{id?}',['as'=>'get.single.module','uses'=>'ModuleController@getSingleModule']);
				Route::get('/single/route/permission/{id?}',['as'=>'get.single.route.permission','uses'=>'ModuleController@getSingleRoutePermission']);
				
				//sort module
				Route::post('/sort/module',['as'=>'sort.module','uses'=>'ModuleController@sortModule']);


				Route::get('/drawSidebar',['as' => 'draw.sidebar' , 'uses' => 'ModuleController@drawSidebar']);
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
				Route::get('/organization/clone/{id}',  ['as'=>'create.organizationClone','uses'=>'OrganizationController@cloneOrganization']);
				Route::get('/organization/auth/{id}' ,['as'=>'auth.organization','uses'=>'OrganizationController@authAttemptOrganization']);


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
			Route::get('settings/department', ['as' => 'department.settings' , 'uses' => 'SettingController@departmentSetting']);
			Route::post('/settings/save',['as'=>'save.settings','uses'=>'SettingController@saveSettingMeta']);
			Route::post('/settings/save/organization',['as'=>'save.organizationSettings','uses'=>'SettingController@saveOrganization']);
			Route::get('settings/shifts', ['as' => 'shifts.settings' , 'uses' => 'SettingController@shiftsSetting']);
			Route::get('settings/holidays', ['as' => 'holidays.settings' , 'uses' => 'SettingController@holidaysSetting']);
			Route::get('settings/leave-cat', ['as' => 'leave.settings' , 'uses' => 'SettingController@leaveSetting']);
			Route::get('settings/role', ['as' => 'role.settings' , 'uses' => 'SettingController@roleSetting']);
			Route::get('settings/default/organization', ['as' => 'organization.settings' , 'uses' => 'SettingController@organization']);

			Route::get('logout',  		['as'=> 'admin.logout','uses'=>'Auth\LoginController@logout']);
			Route::get('login',			['as'=>'admin.login','uses'=>'Auth\LoginController@showLoginForm']);
			Route::post('login',		['as'=>'login.post','uses'=>'Auth\LoginController@login']);
			Route::get('create/page',	['as'=> 'create.pages' , 'uses' => 'PagesController@create']);
			Route::post('/store/pages',	['as'=> 'store.pages' , 'uses' => 'PagesController@store']);
			Route::get('pages',	['as'=> 'admin.pages' , 'uses' => 'PagesController@listPages']);
			

			// Custom Maps
			Route::get('/custom-maps', 				['as'=>'custom.maps','uses'=>'CustomMapsController@index']);
			Route::post('/custom-map/save',			['as'=>'save.custom.map','uses'=>'CustomMapsController@saveMap']);
			Route::get('/custom-map/delete/{id}',	['as'=>'delete.custom.map','uses'=>'CustomMapsController@DeleteMap']);
			Route::get('/custom-map/edit/{id}',	['as'=>'getData.custom.map','uses'=>'CustomMapsController@getDataById']);
			Route::post('/custom-map/update',		['as'=>'update.custom.map','uses'=>'CustomMapsController@updateMap']);

		});
	});

	/******************************* All Routes For Admin *******************************************/
			//demo form route for setting
			


	/******************************* All Routes For Organization ************************************/
		Route::group(['namespace'=>'Organization'], function(){
			Route::get('logout',['as'=>'org.logout','uses'=>'Auth\LoginController@logout']);
			Route::get('login/{id?}',		['as'=>'org.login','uses'=>'Auth\LoginController@showLoginForm']);
			Route::post('login',	['as'=>'org.login.post','uses'=>'Auth\LoginController@login']);
			
			Route::group(['middleware' => ['auth.org']], function(){

				Route::get('/holiday/list',['as'=>'holiday.list','uses'=>'hrm\HolidayController@holidayList']);

				Route::get('settings/department', ['as' => 'department.settings' , 'uses' => 'hrm\SettingController@departmentSetting']);
				Route::get('settings/organization' , ['as'=>'setting.org' , 'uses' => 'hrm\SettingController@orgSetting']);
				Route::post('organization/settings/save',['as'=>'save.organization.settings','uses'=>'hrm\SettingController@saveOrganizationSettings']);
				Route::get('settings/attendance' , ['as'=>'setting.attendance' , 'uses'=>'hrm\SettingController@attendanceSetting']);
				Route::get('settings/emp' , ['as'=>'setting.employee' , 'uses' => 'hrm\SettingController@employeeSetting']);
				Route::get('settings/role' , ['as'=>'setting.role' , 'uses' => 'hrm\SettingController@roleSetting']);
				Route::get('settings/leaves' , ['as'=>'setting.leaves' , 'uses' => 'hrm\SettingController@leaveSetting']);
				
				
				Route::group(['middleware'=>'role'],function(){
					Route::get('/',['as'=>'organization.dashboard','uses'=>'DashboardController@index']);

					});
				//Notes
				Route::get('account/notes',['as'=>'account.notes','uses'=>'project\NotesController@index']);
				Route::get('account/notes/list',	['as'=>'account.notes.list.ajax','uses'=>'project\NotesController@listNotes']);
				Route::post('account/notes/save',	['as'=>'save.account.notes','uses'=>'project\NotesController@createNotes']);
				Route::post('account/notes/edit',	['as'=>'edit.account.notes','uses'=>'project\NotesController@edit']);

				Route::post('account/tasks/status/update',['as'=>'task.status.update','uses'=>'account\TasksController@changeStatus']);
				Route::get('account/tasks',			['as'=>'account.tasks','uses'=>'account\TasksController@index']);
				Route::post('account/tasks/create',	['as'=>'create.tasks','uses'=>'account\TasksController@create']);
				Route::post('account/tasks/delete',	['as'=>'delete.tasks','uses'=>'account\TasksController@deleteTasks']);
				Route::get('account/tasks/edit/{id}',['as'=>'edit.task','uses'=>'account\TasksController@editTask']);
				Route::post('account/tasks/update',	['as'=>'update.tasks','uses'=>'account\TasksController@updateTask']);
				Route::post('account/tasks/priority/filter',['as'=>'filterPriority.tasks','uses'=>'account\TasksController@filterPriority']);
				

				Route::post('project/tasks/status/update',['as'=>'task.status.update','uses'=>'account\TasksController@changeStatus']);
				Route::get('project/tasks',			['as'=>'project.tasks','uses'=>'account\TasksController@index']);
				Route::post('project/tasks/create',	['as'=>'create.tasks','uses'=>'account\TasksController@create']);
				Route::post('project/tasks/delete',	['as'=>'delete.tasks','uses'=>'account\TasksController@deleteTasks']);
				Route::get('project/tasks/edit/{id}',['as'=>'edit.tasks','uses'=>'account\TasksController@editTask']);
				Route::post('project/tasks/update',	['as'=>'update.tasks','uses'=>'account\TasksController@updateTask']);
				Route::post('project/tasks/priority/filter',['as'=>'filterPriority.tasks','uses'=>'account\TasksController@filterPriority']);
				// Route::post('project/tasks/employee/filter',['as'=>'filterEmployee.tasks','uses'=>'account\TasksController@filterEmployee']);
				
				Route::any('/account/leaves',['middleware'=>'role', 'as'=>'account.leaves','uses'=>'hrm\EmployeeLeaveController@index']);
				Route::get('account/todo',	['as'=>'account.todo','uses'=>'project\ProjectController@todo']);

				//profile
				Route::group(['prefix' => 'account','namespace' => 'account'],function(){
					//change password
					Route::group(['middleware'=>'role'],function(){
						Route::get('/activities',['as'=>'account.activities','uses'=>'AccountActivityController@listActivities']);
						Route::any('/attendance',['as'=>'account.attandance','uses'=>'AttendanceController@myattendance']);

					});

					Route::get('/',['as'=>'organization.dashboard','uses'=>'DashboardController@index']);
					Route::post('change/password' , ['as' => 'change.password' , 'uses' => 'AccountController@changePassword']);

					//upload profile image
					Route::get('/profile/{id?}',['as'=>'account.profile','uses'=>'AccountController@profileDetails']);
					Route::post('/profile/upload',['as'=>'profile.picture','uses'=>'AccountController@uploadProfile']);
					Route::get('/emails',['as'=>'account.emails','uses'=>'AccountController@emailsList']);
					Route::patch('/profile/update/{id}',['as'=>'update.profile','uses'=>'AccountController@update']);
					Route::patch('/profile/storeMeta/{id}',['as'=>'update.profile.meta','uses'=>'AccountController@storeMeta']);
					Route::post('/attandance_monthly',['as'=>'account.attendance_monthly','uses'=>'AttendanceController@attendance_monthly']);
					Route::post('/attandance_weekly',['as'=>'account.attendance_weekly','uses'=>'AttendanceController@attendance_weekly']);

					

				/********************************  Task Routes *********************************************/
					

				/*******************************************************************************************/
				

					Route::get('/performance',['as'=>'account.performance','uses'=>function(){
						return view('organization.profile.performance');
					}]);
					Route::get('/projects',[ 'as'=>'account.projects','uses'=>function(){
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
				// //Pages 
				// 	Route::get('/pages',		['as'=>'list.pages' , 'uses'=>'PagesController@listPage' ]);
				// 	Route::get('/page/{id}',	['as'=>'edit.pages' , 'uses'=>'PagesController@edit' ]);
				// 	Route::post('/page/save',	['as'=>'store.page' , 'uses'=>'PagesController@save' ]);
				// 	Route::post('/page/update',	['as'=>'update.page' , 'uses'=>'PagesController@update' ]);

				//TEAM MANAGEMENT ROUTES

					Route::get('teams/{id?}',		['as'=>'list.team' , 'uses'=>'ManageTeamController@listTeam']);
					Route::get('info/teams/{id?}',	['as'=>'editinfo.team' , 'uses'=>'ManageTeamController@getTeamById']);
					Route::get('team/{id}',			['as'=>'info.team' , 'uses'=>'ManageTeamController@info']);
					Route::post('team/save',		['as'=>'save.team' , 'uses'=>'ManageTeamController@save']);
					Route::post('team_info/save',	['as'=>'save.team_info' , 'uses'=>'ManageTeamController@save_info']);
					Route::get('delete/team/{id}',	['as'=>'delete.team','uses' => 'ManageTeamController@deleteTeam']);
					Route::post('edit/team',	['as'=>'edit.team','uses' => 'ManageTeamController@editTeam']);
				
				//Employee	

							

				Route::group(['prefix'=>'hrm', 'namespace' => 'hrm'],function(){

					Route::get('log',['as'=>'list.log', 'uses'=>'LogsystemController@viewLog']);
					Route::post('log',['as'=>'search.log', 'uses'=>'LogsystemController@search_log']);
	
					
					Route::group(['middleware'=>'log'],function(){

						Route::group(['middleware'=>'role'],function(){
							Route::post('role_permisson_save',['as'=>'save.role_permisson', 'uses'=>'UserRoleController@role_permisson_save']);
							Route::get('employees', 				[ 'as' => 'list.employee' , 'uses' => 'EmployeeController@index']);
							Route::get('leave-categories',			['as' => 'leave.categories' , 'uses' =>'LeaveCategoryController@index']);
							Route::get('leaves/{id?}',			[ 'as' => 'leaves' , 'uses' =>'LeavesController@index']);
							Route::get('leave-categories',			['as' => 'leave.categories' , 'uses' =>'LeaveCategoryController@index']);
							Route::get('/attendance',				['as' => 'list.attendance' , 'uses' => 'AttendanceController@list_attendance']);
							Route::get('/holidays/{id?}',		['as' => 'list.holidays' , 'uses' => 'HolidayController@listHoliday']);
							Route::get('roles',['as'=>'list.role', 'uses'=>'UserRoleController@listRole']);
							Route::post('/attendance/import',		['as' => 'upload.attendance' , 'uses' => 'AttendanceController@attendance_import']);
							Route::get('/attendance/import',		['as' => 'import.form.attendance' , 'uses' => 'AttendanceController@import_form']);
							Route::post('employee/update', 			['as' => 'update.employee' , 'uses' => 'EmployeeController@update']);
							Route::get('employee/delete/{id}', 			['as' => 'delete.employee' , 'uses' => 'EmployeeController@delete']);

						});


						Route::match(['get','post'],'applicant/create',['as'=>'applicant.create', 'uses'=>'ApplicantController@create']);
						Route::get('applicants',['as'=>'list.applicant', 'uses'=>'ApplicantController@index']);
						Route::match(['get','post'],'applicant/edit/{id?}',['as'=>'edit.applicant', 'uses'=>'ApplicantController@update']);
						Route::get('applicant/delete/{id}',['as'=>'delete.applicant', 'uses'=>'ApplicantController@destroy']);


						Route::match(['get','post'],'opening/create',['as'=>'opening.create', 'uses'=>'JobOpeningController@create']);
						Route::get('openings',['as'=>'list.opening', 'uses'=>'JobOpeningController@index']);
						Route::match(['get','post'],'opening/update/{id?}',['as'=>'opening.update', 'uses'=>'JobOpeningController@update']);
						Route::get('opening/delete/{id}',['as'=>'delete.opening', 'uses'=>'JobOpeningController@destroy']);

						Route::any('employee/leave/{id?}',['as'=>'list.employeeleave' , 'uses'=>'EmployeeLeaveController@index']);
						//Route::get('employee/leave',['as'=>'list.employeeleave' , 'uses'=>'EmployeeLeaveController@index']);


						//ROLE PERMISSON ROUTE
						// Route::get('role/create',['as'=>'create.role', 'uses'=>'UserRoleController@create']);
						Route::post('role/save',['as'=>'role.store', 'uses'=>'UserRoleController@save']);
						Route::match(['get','post'],'role/delete/{id?}',['as'=>'role.delete', 'uses'=>'UserRoleController@Delete']);
						Route::get('role/assign/{id}',['middleware'=>'role', 'as'=>'role.assign', 'uses'=>'UserRoleController@assign']);
						
						//END ROLE PERMISSON ROUTE
						//employee
							Route::post('employee/save', 			[  'as' => 'store.employee' , 'uses' => 'EmployeeController@save']);
							Route::post('employee/edit', 			['as' => 'edit.employee' , 'uses' => 'EmployeeController@editEmployee']);
							Route::post('employee/update/name',		['as' => 'update.employee.name', 'uses'=> 'EmployeeController@updateEmployeeName']);
							


							Route::get('employee/list/ajax',		['as' => 'employee.list.aax','uses'=> 'EmployeeController@getEmployeeList']);
						//leave Category
							
							Route::post('leave/category_status',	['as' => 'status.leaveCat' , 'uses' =>'LeaveCategoryController@manage_status']);

							Route::post('leave/categories/save',	['as' => 'store.leaveCat' , 'uses' =>'LeaveCategoryController@save']);
							Route::post('leave/categories/update',	['as' => 'update.leaveCat' , 'uses' =>'LeaveCategoryController@update']);
							Route::any('category/meta/{id?}',		['as' => 'meta.category' , 'uses' =>'LeaveCategoryController@categoryMeta']);
							Route::get('category/delete/{id}',		['as' => 'delete.category','uses'=>'LeaveCategoryController@delete']);
							Route::post('category/edit',		['as' => 'edit.category','uses'=>'LeaveCategoryController@editLeaveCat']);

						//Leave
							Route::post('leave/save',		['as' => 'store.leave' , 'uses' =>'LeavesController@save']);
							Route::post('leave/update',		['as' => 'update.leave' , 'uses' =>'LeavesController@update']);
							Route::get('leave/delete/{id}',		['as' => 'delete.leave' , 'uses' =>'LeavesController@delete']);
							Route::POST('leave/edit',		['as' => 'edit.leave' , 'uses' =>'LeavesController@editLeave']);
							Route::POST('leave/approve',		['as' => 'approve.leave' , 'uses' =>'LeavesController@approve_leave']);


						//shifts
							Route::get('shifts/{id?}',		['as' => 'shifts' , 'uses' =>'ShiftsController@index']);
							Route::post('shifts/save',	['as' => 'store.shifts' , 'uses' =>'ShiftsController@save']);
							Route::post('shifts/update',['as' => 'update.shifts' , 'uses' =>'ShiftsController@update']);
							Route::get('shifts/delete/{id}',	['as' => 'delete.shifts' , 'uses' =>'ShiftsController@delete']);		
							Route::post('shift/edit/{id?}',	['as' => 'edit.shifts' , 'uses' =>'ShiftsController@editShifts']);		
						//Leaves
							Route::get('leaves-categories',	['as' => 'leaves_categories' , 'uses' => 'LeavesController@leave_categories']);
							Route::get('delete/leave-categories/{id?}',	['as' => 'delete.leaves_categories' , 'uses' => 'LeavesController@deleteLeaveCategories']);
						//attendance ajax
						//widget permission
							Route::post('widget_permission_save',	['as' => 'save.widget_permission' , 'uses' => 'UserRoleController@widget_permission_save']);

							Route::get('/attendance/list/ajax', ['as' => 'ajax.list.attendance' , 'uses' =>'AttendanceController@ajax']);
							Route::post('/attendance/list/ajax',	['as' => 'ajax.list.attendance' , 'uses' => 'AttendanceController@ajax']);
							Route::post('/attendance/lock',				['as' => 'ajax.lock.attendance' , 'uses' => 'AttendanceController@lock_status']);



						//attendance
							Route::match(['get','post'],'attendance/edit', ['as'=>'hr.attendance', 'uses' => 'AttendanceController@attendance_by_hr']);
							Route::post('attendance/hr_fill',		[ 'as'=>'hr_store.attendance', 'uses' => 'AttendanceController@attendance_fill_hr']);
							Route::post('attendance/check_in_out',	['as' => 'checkinout.attendance' , 'uses' => 'AttendanceController@check_in_out']);
							Route::post('/attendance',		['as' => 'filter' , 'uses' => 'AttendanceController@list_attendance']);
							

						//holidays
							Route::get('/holidays/{id?}',		['as' => 'list.holidays' , 'uses' => 'HolidayController@listHoliday']);
							Route::post('/holiday_save',		['as' => 'store.holiday' , 'uses' => 'HolidayController@save']);
							Route::get('/holidays/edit/{id}',	['as' => 'edit.holiday' , 'uses' => 'HolidayController@edit']);
							Route::post('/holiday/update',		['as' => 'update.holiday' , 'uses' => 'HolidayController@update']);
							Route::post('/holiday/edit',		['as' => 'edit.holiday' , 'uses' => 'HolidayController@editHoliday']);
							Route::get('/holiday/delete/{id}',	['as' => 'delete.holiday' , 'uses' => 'HolidayController@deleteHoliday']);

						//Application
							Route::get('/applications',		['as' => 'applications' , 'uses' => 'ApplicationController@index']);

						//Mail
							Route::get('/mails',		['as' => 'mails' , 'uses' => 'MailController@index']);

						//Applicants
							// Route::get('/applicants',		['as' => 'applicants' , 'uses' => 'ApplicantsController@index']);

						//Designation
							Route::get('/designations/{id?}',	[  'as' => 'designations' , 'uses' => 'DesignationsController@index']);
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
					Route::group(['middleware'=>'role'],function(){
						Route::get('clients',			['as'=>'list.client','uses'=>'ClientController@listClients']);

					});

					Route::get('client/create',			['as'=>'create.client','uses'=>'ClientController@create']);
					Route::post('client/save',			['as'=>'save.client','uses'=>'ClientController@save']);
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




				//notes
				Route::get('project/notes/list',	['as'=>'list.notes','uses'=>'project\NotesController@listNotes']);
				Route::get('project/notes/{id}',	['as'=>'notes.project','uses'=>'project\NotesController@index']);
				Route::post('project/notes/save',	['as'=>'save.notes','uses'=>'project\NotesController@createNotes']);
				Route::post('project/notes/edit',	['as'=>'edit.notes','uses'=>'project\NotesController@edit']);
				// end notes


				
				//Project Routes
				Route::group(['middleware'=>'role'],function(){
					Route::get('projects',['as'=>'list.project','uses'=>'project\ProjectController@listProject']);

				});
				
				Route::get('/project/categories',	['as'=>'categories.project','uses'=>'project\ProjectController@categories']);
				Route::post('category/save',		['as'=>'save.category','uses'=>'project\ProjectController@saveCategory']);
				Route::post('category/update',		['as'=>'update.category','uses'=>'project\ProjectController@updateCategory']);
				Route::get('project/edit-info/{id}',			[ 'as'=>'add_project_info.project' , 'uses'=>'project\ProjectController@add_project_info']);
				Route::post('project/save-info',	['as'=>'save.project_meta' , 'uses'=>'project\ProjectController@save_project_meta']);
				Route::get('project/view/{id}',		['as'=>'view.project','uses'=>'project\ProjectController@view']);
				Route::get('project/delete/{id}',	['as'=>'delete.project','uses'=>'project\ProjectController@delete']);
				Route::post('project/add-client',	['as'=>'add_client.project','uses'=>'project\ProjectController@add_client']);
				



				// save teams in project
				Route::POST('update/team/{id}', ['as' => 'update.team' , 'uses' => 'project\ProjectController@updateTeam']);
				
				Route::post('project/save',			['as'=>'save.project','uses'=>'project\ProjectController@save']);
				Route::post('project/update/{id?}',	['as'=>'update.project','uses'=>'project\ProjectController@update']);
				Route::get('project/details/{id}',	['as'=>'details.project','uses'=>'project\ProjectController@details']);
				Route::get('project/credentials/{id}',	['as'=>'credentials.project','uses'=>'project\ProjectController@credentials']);
				Route::get('project/activities/{id}',	['as'=>'activities.project','uses'=>'project\ProjectController@activities']);
				Route::get('project/calender/{id}',	['as'=>'calender.project','uses'=>'project\ProjectController@calender']);
				
				Route::get('project/documentation/{id}',	['as'=>'documentation.project','uses'=>'project\ProjectController@documentation']);
				
				//attachment
				Route::get('project/attachments/{id}',	['as'=>'attachment.project','uses'=>'project\ProjectController@attachments']);
				Route::POST('upload/project/attachment',['as'=>'upload.attachment.project','uses'=>'project\ProjectController@saveAttachment']);
				Route::post('view/attachment',['as' => 'view.attachment' , 'uses' => 'project\ProjectController@getAttachment']);
				Route::get('delete/attachment/{id}',['as' => 'delete.attachment' , 'uses' => 'project\ProjectController@deleteAttachment']);

				//credientals
				Route::post('save/credientals',['as' => 'credientals.save' , 'uses' => 'project\ProjectController@saveCredientals']);
				Route::get('delete/crediental/{id}',['as' => 'delete.crediental' , 'uses' => 'project\ProjectController@deleteCredentials']);
				Route::get('project/crediental/edit/{id}',['as' => 'details.crediental' , 'uses' => 'project\ProjectController@editCrediental']);
				Route::POST('update/crediental',['as' => 'update.crediental' , 'uses' => 'project\ProjectController@updateCredientals']);


				Route::get('/project/todo/list/{id?}',	['as'=>'list.todo','uses'=>'project\TodoController@listTodo']);
				Route::get('project/todo/{id?}',	['as'=>'todo.project','uses'=>'project\ProjectController@todo']);
				Route::post('/project/todo/create',	['as'=>'create.todo','uses'=>'project\TodoController@create']);
				
				Route::POST('/project/todo/edit',	['as'=>'edit.todo','uses'=>'project\TodoController@edit']);
				Route::POST('/project/todo/delete',	['as'=>'delete.todo','uses'=>'project\TodoController@delete']);
				Route::POST('/project/todo/filter',	['as'=>'filter.todo','uses'=>'project\TodoController@filterData']);
				
				//tasks
				Route::get('project/tasks/{id?}',['as'=> 'tasks.project','uses' => 'project\ProjectController@tasks']);
				
				

				Route::group(['namespace' => 'dataset'],function(){
					Route::get('/datasets',['as' => 'list.dataset','uses' => 'DatasetController@listDataset']);
					Route::get('/dataset/import',['as' => 'import.dataset','uses' => 'DatasetController@importDataset']);
					Route::post('/import/dataset', ['as'=>'upload.dataset','uses'=>'DatasetController@uploadDataset']);
					Route::post('/dataset/save',['as'=>'save.dataset','uses'=>'DatasetController@store']);
				});
				Route::group(['prefix'=>'cms','namespace' => 'cms'],function(){
					//Pages 
					Route::get('/pages',		['as'=>'list.pages' , 'uses'=>'PagesController@listPage' ]);
					Route::get('/page/{id}',	['as'=>'edit.pages' , 'uses'=>'PagesController@edit' ]);
					Route::post('/page/save',	['as'=>'store.page' , 'uses'=>'PagesController@save' ]);
					Route::post('/page/update',	['as'=>'update.page', 'uses'=>'PagesController@update' ]);
					Route::get('/page/delete/{id}',	['as'=>'delete.page', 'uses'=>'PagesController@delete' ]);
					//change status with ajax
					Route::post('/pages/status/update',['as'=>'update.status','uses'=>'PagesController@updateStatus']);

					// posts
					Route::get('/posts',		['as'=>'list.posts' , 'uses'=>'PagesController@listposts']);
					Route::get('/posts/{id}',	['as'=>'edit.posts' , 'uses'=>'PagesController@editposts' ]);
					Route::post('/posts/save',	['as'=>'store.posts' , 'uses'=>'PagesController@savePosts' ]);
					Route::post('/posts/update',	['as'=>'update.posts', 'uses'=>'PagesController@updatePosts' ]);
					Route::get('/posts/delete/{id}',	['as'=>'delete.posts', 'uses'=>'PagesController@deletePosts' ]);
					Route::post('/posts/status/update',['as'=>'update.status.posts','uses'=>'PagesController@updateStatusPosts']);
					// Route::get('/posts',['as'=>'posts','uses'=>'PostsController@index']);

					Route::get('/categories/{id?}',['as'=>'categories','uses'=>'categoriesController@listdata']);
					Route::post('/save/categories',['as' => 'category.save' , 'uses' => 'categoriesController@save']);
					Route::get('/delete/categories/{id}',['as' => 'category.delete' , 'uses' => 'categoriesController@delete']);
					Route::get('/edit/categories/{id}',['as' => 'category.edit' , 'uses' => 'categoriesController@getDataById']);
					Route::post('/update/categories/{id}',['as' => 'category.update' , 'uses' => 'categoriesController@updateCategory']);

					Route::get('/media',['as'=>'media','uses'=>'MediaController@index']);
				});
				Route::group(['prefix'=>'support','namespace' => 'support'],function(){
					Route::get('tickets',	['as'=>'support.tickets','uses'=>'SupportsController@index']);
					Route::get('categories',		['as'=>'support.categories','uses'=>'SupportsController@Categories']);
					Route::get('knowledge-base',	['as'=>'knowledge-base','uses'=>'SupportsController@knowledgeBase']);
					Route::get('faq',	['as'=>'faq','uses'=>'SupportsController@FAndQ']);
				});

				Route::group(['namespace'=>'users'],function(){
					//Users
					Route::get('/users', 			['as'=>'list.user','uses'=>'UsersController@index']);
					Route::post('/user/store',		['as'=>'store.user','uses'=>'UsersController@store']);
					Route::get('/user/edit/{id}',	['as'=>'edit.user','uses'=>'UsersController@edit']);
					Route::get('/user/{id}',		['as'=>'info.user','uses'=>'UsersController@user_info']);
					Route::post('/user/profile/update/{id}',['as'=>'save.user.profile','uses'=>'UsersController@user_meta']);
					Route::post('/user/update',		['as'=>'update.user','uses'=>'UsersController@update']);
				});
			});
		// visualization
			Route::get('create/visualization' , ['as' => 'create.visual' , 'uses' => 'visualization\VisualisationController@create']);
			Route::get('visualization/edit/charts/{id?}' , ['as' => 'edit.visual' , 'uses' => 'visualization\VisualisationController@edit']);
			Route::post('/visualization/save', ['as'=>'save.visualization','uses' => 'visualization\VisualisationController@createVisualization']);
			Route::get('/visualization/delete/{id}',['as'=>'delete.visualization','uses'=>'visualization\VisualisationController@delete_visualization']);
			Route::get('/visualization/setting/{id}',['as'=>'setting.visualization','uses'=>'visualization\VisualisationController@setting_visualization']);
			Route::get('/visualization/users/{id}',['as'=>'user.visualization','uses'=>'visualization\VisualisationController@user_visualization']);
			Route::get('/visualization/append/{id?}/{length?}',['as'=>'appendData.visualization','uses'=>'visualization\VisualisationController@getDataByAjax']);
			Route::get('/visualization/filter/{id?}',['as'=>'filter.visualization','uses'=>'visualization\VisualisationController@getFilterByAjax']);
			Route::get('/visualization/edit/{id}',['as'=>'edit.visualization','uses'=>'visualization\VisualisationController@getDataById']);

			Route::post('/visualization/charts/save/{visualization_id?}',['as'=>'save.charts','uses'=>'visualization\VisualisationController@saveCharts']);

			Route::post('/visualization/update/{id}',['as'=>'update.visualization','uses'=>'visualization\VisualisationController@updateVizDetails']);

		});

	Route::get('404',['as' => 'demo5','uses' => function(){
		return View::make('common.404');
	}]);
	Route::get('access_denied',['as' => 'access.denied','uses' => function(){
		return View::make('errors.accessdenied');
	}]);
	
	/****************************************** All Routes For Organization *************************************************/
	
	/****************************************** Pages for experiments *************************************************/
 
	Route::get('new-layout',['as' => 'new.layout','uses' => function(){
		return View::make('organization.demo.NewLayout');
	}]);
	Route::group(['prefix'=>'front'], function(){	 
		Route::get('clients',['as' => '.create.clients','uses' => function(){
			return View::make('front.clients.index');
		}]);

	});


	/***************************************** Public Route for Share Data ******************************************/

	 Route::get('/public/custom-maps/{map_id}/{theme?}/{data?}',['as'=>'public.map','uses'=>'Admin\CustomMapsController@publicMaps']);
