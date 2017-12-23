<?php

	/****************************************** All Routes For Admin *************************************************/
		//Public route
		Route::group(['middleware'=>'web'], function(){
			


				Route::get('page/{slug}',	['as'=>'view.pages' , 'uses'=>'Organization\cms\PagesController@viewPage' ]);
				Route::get('demo/{slug}',	['as'=>'demo.pages' , 'uses'=>'Organization\cms\PagesController@demoviewPage' ]);
				Route::post('comment/save',	['as'=>'save.comment' , 'uses'=>'Organization\cms\PagesController@save_comment' ]);
				Route::post('comment/update', ['as'=>'update.comment' , 'uses'=>'Organization\cms\PagesController@update_comment' ]);
				Route::get('like/{type}/{c_id}/{expression?}',	['as'=>'like.comment' , 'uses'=>'Organization\cms\PagesController@likedislike' ]);
				Route::get('comment/del/{c_id}',	['as'=>'del.comment' , 'uses'=>'Organization\cms\PagesController@deleteComment' ]);
				Route::get('comment/edit/{c_id}',	['as'=>'del.comment' , 'uses'=>'Organization\cms\PagesController@deleteComment' ]);
                Route::post('formdata/save',    ['as'=>'save.form.data','uses'=>'Admin\FormBuilderController@saveGeneratedForm']);

		});
		Route::group(['domain' => 'admin.'.env('MAIN_DOMAIN')], function () {
			Route::group(['namespace'=>'Admin'], function(){
				Route::group(['middleware' => 'auth.admin'], function(){

					Route::get('widget/sort/admin',	['as'=>'admin.widget.sort','uses'=>'DashboardController@widgetSort']);
					Route::get('/',				['as'=>'admin.dashboard','uses'=>'DashboardController@index']);

					//Activity 
					Route::get('activities', ['as'=>'activities' , 'uses'=>'ActivityTemplateController@index']);
					Route::match(['get','post'], 'activity/template', ['as'=>'activity.template' , 'uses'=>'ActivityTemplateController@create']);
					Route::match(['get','post'], 'activity/edit/{id?}', ['as'=>'activity.edit' , 'uses'=>'ActivityTemplateController@edit']);
					Route::get('activity/delete/{id?}', ['as'=>'activity.delete' , 'uses'=>'ActivityTemplateController@delete']);

					//Notification
					Route::get('notifications', ['as'=>'notifications' , 'uses'=>'ActivityTemplateController@notificationList']);
					Route::match(['get','post'], 'notification/template', ['as'=>'notification.template' , 'uses'=>'ActivityTemplateController@create_notification']);


					Route::get('widgets/{id?}', ['as'=>'index.widget' , 'uses'=>'WidgetController@index']);
					Route::get('widget/delete/{id}', ['as'=>'delete.widget' , 'uses'=>'WidgetController@delete']);
					Route::match(['get', 'post'],'widget/create', ['as'=>'create.widget' , 'uses'=>'WidgetController@create']);
					Route::match(['get', 'post'],'widget/edit/{id?}', ['as'=>'edit.widget' , 'uses'=>'WidgetController@edit']);
					Route::post('widget/status/update', ['as'=>'status.widget' , 'uses'=>'WidgetController@update_widget_status']);
					Route::post('sort/widget' , ['as' => 'sort.widget' , 'uses' => 'WidgetController@sort']);
					Route::get('sort/down/{id}' , ['as' => 'sort.down' , 'uses' => 'WidgetController@sortWidgetDown']);
					Route::get('sort/up/{id}' , ['as' => 'sort.up' , 'uses' => 'WidgetController@sortWidgetUp']);

					//Module route
					include_once 'custom/admin/module.php';
					
					Route::get('/drawSidebar',['as' => 'draw.sidebar' , 'uses' => 'ModuleController@drawSidebar']);

                    //Products routes
                    include_once 'custom/admin/products.php';


					//admin users
					Route::group(['prefix'=>'users'],function(){
						include_once 'custom/admin/users.php';
					});

					include_once 'custom/admin/organization.php';
					
					// group route
					include_once 'custom/admin/group.php';

					
					//All Routes For Form Builder
					include_once 'custom/admin/formbuilder.php';

					
					//settings
					include_once 'custom/admin/settings.php';

                    //Orders
                    include_once 'custom/admin/order.php';
					
					//pages
					Route::get('create/page',	['as'=> 'create.pages' , 'uses' => 'PagesController@create']);
					Route::post('/store/pages',	['as'=> 'store.pages' , 'uses' => 'PagesController@store']);
					Route::get('pages',			['as'=> 'admin.pages' , 'uses' => 'PagesController@listPages']);

					// Custom Maps
					include_once 'custom/admin/custom-maps.php';

				});
				Route::get('logout',  		['as'=> 'admin.logout','uses'=>'Auth\LoginController@logout']);
				Route::get('login',			['as'=>'admin.login','uses'=>'Auth\LoginController@showLoginForm']);
				Route::post('login',		['as'=>'login.post','uses'=>'Auth\LoginController@login']);
			
				//Routes for pages	
				include_once 'custom/admin/pages.php';
			});
							
			Route::group(['middleware' => 'auth.admin'], function(){

				Route::group(['prefix' => 'cms','namespace'=>'Organization\cms'],function(){

					//Routes for media
					include_once 'custom/admin/media.php';

					//Routes for categories
					include_once 'custom/admin/categories.php';

					//Routes for posts
					include_once 'custom/admin/posts.php';

					//Routes for menu
					include_once 'custom/admin/menu.php';
				});
			});
		});

	Route::group(['namespace'=>'Group','domain'=>'manage.'.env('MAIN_DOMAIN')], function(){
		Route::group(['middleware' => 'auth.group'], function(){
			Route::get('/',['as'=>'group.dashboard','uses'=>'DashboardController@index']);

			//Users
				include_once 'custom/group/user.php';

			//organization
				include_once 'custom/group/organization.php';


		});
		Route::get('logout',  		['as'=> 'group.logout','uses'=>'Auth\LoginController@logout']);
		Route::get('login/{auth_token?}',['as'=>'group.login','uses'=>'Auth\LoginController@showLoginForm']);
		Route::post('login',		['as'=>'group.post','uses'=>'Auth\LoginController@login']);
	});




			/******************************* All Routes For Admin *******************************************/
										//demo form route for setting
			/******************************* All Routes For Organization ************************************/

		Route::group(['namespace'=>'Organization'], function(){


			Route::post('/survey/filled/save', ['as'=>'filled.survey', 'uses'=>'survey\SurveyController@survey_filled_data_save']);
			Route::post('/survey/filled_view/save', ['as'=>'view.filled.survey', 'uses'=>'survey\SurveyController@survey_filled_by_view']);

			Route::match(['get','post'],'apply/{id?}',['as'=>'apply', 'uses'=>'hrm\ApplicantController@apply']);
			Route::get('jobs',['as'=>'openingss', 'uses'=>'hrm\JobOpeningController@public_view_jobs']);
			Route::get('logout',			['as'=>'org.logout','uses'=>'Auth\LoginController@logout']);
			Route::get('login/{id?}',		['as'=>'org.login','uses'=>'Auth\LoginController@showLoginForm']);
			Route::get('login-v2/{id?}',	['as'=>'org.login-v2','uses'=>'Auth\LoginController@showLoginFormv2']);
			Route::post('login',			['as'=>'org.login.post','uses'=>'Auth\LoginController@login']);
			Route::get('forgot-password',	['as'=>'forgot.password','uses'=>'Auth\LoginController@forgotpassword']);
			Route::get('forgot-password-v1',['as'=>'forgot.password-v1','uses'=>'Auth\LoginController@forgotpasswordv1']);
			Route::post('forgot',			['as'=>'forgot','uses'=>'Auth\LoginController@forgotMail']);
			Route::get('reset-password/UfcZNQ0sU5w52FoXk28', ['as'=>'edit.password' ,'uses' => 'Auth\LoginController@changePass']);
			Route::post('update-password', ['as'=>'update.pass' ,'uses' => 'Auth\LoginController@updatePass']);
			Route::get('register', ['as'=>'register' ,'uses' => 'Auth\LoginController@register']);
			Route::get('user/register', ['as'=>'org.register' ,'uses' => 'Auth\LoginController@registerUser']);

			//Email Template
			Route::get('emails',['as'=>'emails' , 'uses'=>'templates\EmailTemplateController@index']);

			Route::match(['get','post'],'/signup',	['as'=>'signup.user','uses'=>'Auth\RegisterController@userRegister']);
			// Route::post('/sign-up/save',		['as'=>'signup.user','uses'=>'users\UsersController@public_store_user']);
			
			// Route::get('/survey/report/{$id}', ['as'=>'survey.stats.reportss', 'uses'=>'survey\SurveyStatsController@survey_static_result']); 
			
			


			Route::group(['middleware' => ['auth.org','org.status']], function(){
				Route::get('404',['as' => 'demo5','uses' => function(){
					return View::make('common.404');
				}]);

                include_once "custom/organization/domains.php";


				//Roles Routes
				
				include_once 'custom/organization/roles.php';

				Route::get('/survey', ['as'=>'display.survey', 'uses'=>'survey\SurveyController@display_survey']);
				Route::post('/survey/save', ['as'=>'filled.survey', 'uses'=>'survey\SurveyController@survey_filled_data_save']);
				Route::get('/survey/delete/table/{table_name}', ['as'=>'delete.table', 'uses'=>'survey\SurveyController@delete_survey_table']);

				Route::get('/widgets', ['as'=>'list.widgets', 'uses'=>'widgets\WidgetsController@listWidgets']);
				Route::get('/widget/create', ['as'=>'create.widgets', 'uses'=>'widgets\WidgetsController@createWidget']);

				
				Route::group(['middleware'=>'role'],function(){
					Route::get('settings/department', ['as' => 'department.settings' , 'uses' => 'hrm\SettingController@departmentSetting']);
					Route::get('settings/organization' , ['as'=>'setting.org' , 'uses' => 'hrm\SettingController@orgSetting']);
					//Deleted employees
					Route::get('deleted/employees',['as'=>'deleted.employee','uses'=>'hrm\SettingController@deletedEmployees']);
					//Tools Widget
					Route::get('/tools',['as'=>'tools','uses'=>'tools\ToolsController@tools']);
				});
					Route::post('/tools/website-rank',['as'=>'website.rank','uses'=>'tools\ToolsController@websiteRank']);


				//Settings Module
				Route::get('settings/user' , ['as'=>'setting.user' , 'uses'=>'settings\SettingsController@user_settings']);
				Route::post('/settings/user/save',['as'=>'save.user.settings','uses'=>'settings\SettingsController@save_user_settings']);


				//visual
				include_once 'custom/organization/visualization.php';




				//survey routes
				include_once 'custom/organization/survey.php';



				//application routes
				include_once 'custom/organization/application.php';
				

				//new emails route by ashish
				Route::get('email',					['as'=>'emails' , 'uses'=>'email\EmailController@index']);
				Route::get('email/send', 			['as'=>'email.send' , 'uses'=>'email\EmailController@sendEmail']);
				Route::get('/email/delete/{id}',	['as'=>'delete.email','uses'=>'email\EmailController@deleteEmail']);
				Route::get('/document/delete/{id}',	['as'=>'delete.document','uses'=>'document\DocumentController@deleteDocument']);
				Route::post('/document/send',	['as'=>'document.send','uses'=>'document\DocumentController@sendDocument']);
				Route::post('campaign/save', 		['as'=>'save.campaign','uses'=>'email\EmailController@saveCampaign']);
				Route::get('campaign/edit/{id}', 	['as'=>'edit.campaign','uses'=>'email\EmailController@sendEmail']);
				Route::get('document/edit/{id}', 	['as'=>'edit.document','uses'=>'document\DocumentController@editDocument']);
				Route::get('email/templates', 		['as'=>'email.templates' , 'uses'=>'email\EmailController@templates']);
				Route::get('email/create-template', ['as'=>'create.template' , 'uses'=>'email\EmailController@createTemplates']);
				Route::get('document/create-template', ['as'=>'create.document.template' , 'uses'=>'document\DocumentController@createTemplates']);
				Route::get('email/edit-template/{id}',	['as'=>'edit.template' , 'uses'=>'email\EmailController@getInfoTemplates']);
				Route::get('document/edit-template/{id}',	['as'=>'edit.document.template' , 'uses'=>'document\DocumentController@getInfoTemplates']);
				Route::POST('email/update-template',	['as'=>'update.template' , 'uses'=>'email\EmailController@updateTemplates']);
				Route::POST('document/update-template',	['as'=>'update.documant.template' , 'uses'=>'document\DocumentController@updateTemplates']);
				Route::get('email/layouts', 		['as'=>'email.layouts' , 'uses'=>'email\EmailController@layouts']);
				Route::get('email/layout/delete/{id}', ['as'=>'email.layout.delete' , 'uses'=>'email\EmailController@deleteLayout']);
				Route::get('document/layout/delete/{id}', ['as'=>'document.layout.delete' , 'uses'=>'document\DocumentController@deleteLayout']);
				Route::get('email/edit-layout/{id}',	['as'=>'edit.layout' , 'uses'=>'email\EmailController@getInfolayout']);
				Route::get('document/document-layout/{id}',	['as'=>'document.layout' , 'uses'=>'document\DocumentController@getInfolayout']);
				Route::get('document/layout/preview/{id}',	['as'=>'document.layout.view' , 'uses'=>'document\DocumentController@layoutPreview']);
				Route::get('document/template/preview/{id}',	['as'=>'document.template.view' , 'uses'=>'document\DocumentController@TemplatePreview']);
				Route::POST('email/update-layout',	['as'=>'update.layout' , 'uses'=>'email\EmailController@updatelayout']);
				Route::POST('document/update-layout',	['as'=>'update.document.layout' , 'uses'=>'document\DocumentController@updatelayout']);
				Route::get('email/template/delete/{id}', ['as'=>'templates.delete' , 'uses'=>'document\DocumentController@deleteTemplates']);
				Route::get('email/create-layouts', 	['as'=>'create.layouts' , 'uses'=>'email\EmailController@createLayouts']);
				Route::get('document/create-layouts', 	['as'=>'create.document.layouts' , 'uses'=>'document\DocumentController@createLayouts']);
				Route::post('layout/save', 			['as'=>'save.layout' , 'uses'=>'email\EmailController@saveLayout']);
				Route::post('document/layout/save', 			['as'=>'save.document.layout' , 'uses'=>'document\DocumentController@saveLayout']);
				Route::post('template/save', 			['as'=>'save.template' , 'uses'=>'email\EmailController@saveTemplate']);
				Route::post('document/template/save', 			['as'=>'save.document.template' , 'uses'=>'document\DocumentController@saveTemplate']);

				Route::get('documents', ['as'=>'documents' , 'uses'=>'document\DocumentController@index']);
				Route::get('documents/create', ['as'=>'create.documents' , 'uses'=>'document\DocumentController@createDocument']);
				Route::post('documents/update', ['as'=>'update.documents' , 'uses'=>'document\DocumentController@updateDocument']);
				Route::post('documents/save', ['as'=>'save.documents' , 'uses'=>'document\DocumentController@saveDocument']);
				Route::get('documents/preview/{id}', ['as'=>'view.document' , 'uses'=>'document\DocumentController@viewDocument']);

				Route::get('document/templates', ['as'=>'document.templates' , 'uses'=>'document\DocumentController@templates']);
				Route::get('document/layouts', ['as'=>'document.layouts' , 'uses'=>'document\DocumentController@layouts']);
				Route::get('document/download/{id}', ['as'=>'document.download' , 'uses'=>'document\DocumentController@documentDownload']);

				Route::post('organization/settings/save',['as'=>'save.organization.settings','uses'=>'hrm\SettingController@saveOrganizationSettings']);
				Route::post('settings/save', ['as'=>'settings.save','uses'=>'hrm\SettingController@saveSettings']);
				Route::get('settings/hrm' , ['as'=>'setting.attendance' , 'uses'=>'hrm\SettingController@attendanceSetting']);
				Route::get('settings/emp' , ['as'=>'setting.employee' , 'uses' => 'hrm\SettingController@employeeSetting']);
				Route::get('settings/role' , ['as'=>'setting.role' , 'uses' => 'hrm\SettingController@roleSetting']);
				Route::get('settings/leaves' , ['as'=>'setting.leaves' , 'uses' => 'hrm\SettingController@leaveSetting']);
				
				Route::get('/', ['as' => 'org.dashboard' , 'uses' => function(){
					return redirect()->route('organization.dashboard');
				}]);
					
				//Dashboard routes
				include_once 'custom/organization/dashboard.php';

				//Chat Route is for design purpose only (auther: Ashish)
				Route::get('/chat', ['as' => 'org.chat' , 'uses' => function(){
					return view('organization.chat.chat');
				}]);


				Route::group(['middleware'=>'role'],function(){
					Route::get('/holiday/list/{id?}',['as'=>'holiday.list','uses'=>'hrm\HolidayController@holidayList']);

					Route::any('/account/leaves/{id?}',['middleware'=>'role', 'as'=>'account.leaves','uses'=>'hrm\EmployeeLeaveController@leave_listing']);
					Route::get('account/todo/{id?}',	['as'=>'account.todo','uses'=>'project\ProjectController@todo']);
					Route::get('account/tasks/{id?}',	['as'=>'account.tasks','uses'=>'account\TasksController@index']);
					Route::get('account/notes/{id?}',	['as'=>'account.notes','uses'=>'project\NotesController@index']);
				});
				Route::any('account/leave/{id?}',['as'=>'store.employeeleave' , 'uses'=>'hrm\EmployeeLeaveController@store']);

				//Notes
				Route::get('account/notes/list',	['as'=>'account.notes.list.ajax','uses'=>'project\NotesController@listNotes']);
				Route::post('account/notes/save',	['as'=>'save.account.notes','uses'=>'project\NotesController@createNotes']);
				Route::post('account/notes/edit',	['as'=>'edit.account.notes','uses'=>'project\NotesController@edit']);
				Route::post('account/notes/delete',	['as'=>'delete.account.notes','uses'=>'project\NotesController@delete']);

				
				// Route::post('project/tasks/employee/filter',['as'=>'filterEmployee.tasks','uses'=>'account\TasksController@filterEmployee']);

				Route::post('save/dashboard/widget',['as'=>'update.dashboard.widget','uses'=>'DashboardController@saveWidget']);
				Route::post('save/dashboard' , ['as' => 'dashboard.save', 'uses' => 'DashboardController@dashboards']);

				//profile
				Route::group(['prefix' => 'profile','namespace' => 'profile'],function(){
					include_once 'custom/organization/account.php';
				});

				//account
				Route::group(['prefix' => 'account','namespace' => 'account'],function(){
				
					Route::group(['middleware'=>'role'],function(){
						Route::get('/activities/{id?}',['as'=>'account.activities','uses'=>'AccountActivityController@listActivities']);
						Route::any('/attendance/{id?}',['as'=>'account.attandance','uses'=>'AttendanceController@myattendance']);
						Route::get('/profile/{id?}',['as'=>'account.profile','uses'=>'AccountController@profileDetails']);
						Route::patch('/profile/storeMeta/{id}',['as'=>'update.profile.meta','uses'=>'AccountController@storeMeta']);

						Route::get('/document/{id?}',['as'=>'account.document','uses'=>'AccountController@UserDocument']);
						Route::get('/delete/document/{id}',['as'=>'delete.user.document','uses'=>'AccountController@DelDocument']);

						Route::get('/performance/{id?}',['as'=>'account.performance','uses'=>function(){
							return view('organization.profile.performance');
						}]);
						Route::get('/emails/{id?}',['as'=>'account.emails','uses'=>'AccountController@emailsList']);
						Route::get('/emails/view/{id}',['as'=>'account.emails.view','uses'=>'AccountController@emailDetails']);
						
						Route::get('/chat/{id?}',['as'=>'account.chat','uses'=>function(){
							echo "chatinggg";
							// return view('organization.profile.chat');
						}]);
						Route::get('/discussion/{id?}',['as'=>'account.discussion','uses'=>function(){
							return view('organization.profile.discussion');
						}]);
						

						Route::get('/projects/{id?}',[ 'as'=>'account.projects','uses'=>'AccountController@listProjects']);

					});
					Route::post('/discussion/save',['as'=>'save.discussion','uses'=>'AccountController@saveDiscussion']);
					Route::post('change/password/admin' , ['as' => 'change.password.admin' , 'uses' => 'AccountController@checkExistingPassword']);
					Route::post('change/password' , ['as' => 'change.password' , 'uses' => 'AccountController@changePassword']);

					//upload profile image
					Route::post('/profile/upload',['as'=>'profile.picture','uses'=>'AccountController@uploadProfile']);
					Route::get('/profile-picture/remove/{id}',['as'=>'profile.picture.delete','uses'=>'AccountController@deleteProfilePicture']);
					Route::post('/attandance_monthly',['as'=>'account.attendance_monthly','uses'=>'AttendanceController@attendance_monthly']);
					Route::post('/attandance_weekly',['as'=>'account.attendance_weekly','uses'=>'AttendanceController@attendance_weekly']);

					//bookmarks
					Route::get('/bookmarks',	['as'=>'design.bookmark' , 'uses'=> 'BookmarkController@index']);
					Route::get('/bookmarks/create',	['as'=>'design.bookmark' , 'uses'=>function(){
						return view('organization.bookmarks.create');
					}]);
					
					Route::post('/bookmark/save',	['as'=>'save.bookmark' , 'uses'=>'BookmarkController@saveBookmark' ]);
					Route::get('/bookmark/edit/{id}',	['as'=>'edit.bookmark' , 'uses'=>'BookmarkController@editBookmark' ]);
					Route::post('/bookmark/delete',	['as'=>'delete.bookmark' , 'uses'=>'BookmarkController@deleteBookmark' ]);
					Route::post('/bookmark/update/{id}',	['as'=>'update.bookmark' , 'uses'=>'BookmarkController@updateBookmark' ]);
					Route::post('/add/category',	['as'=>'create.bookmark.category' , 'uses'=>'BookmarkController@addBookmarkCategories' ]);
					Route::get('/delete/category/{id}',	['as'=>'delete.bookmark.category' , 'uses'=>'BookmarkController@delCategory' ]);

				/********************************  Task Routes *********************************************/
					

				/*******************************************************************************************/
				
					
				});
				// //Pages 
				// 	Route::get('/pages',		['as'=>'list.pages' , 'uses'=>'PagesController@listPage' ]);
				// 	Route::get('/page/{id}',	['as'=>'edit.pages' , 'uses'=>'PagesController@edit' ]);
				// 	Route::post('/page/save',	['as'=>'store.page' , 'uses'=>'PagesController@save' ]);
				// 	Route::post('/page/update',	['as'=>'update.page' , 'uses'=>'PagesController@update' ]);

				//TEAM MANAGEMENT ROUTES

				
				
				//Employee	
				Route::group(['prefix'=>'hrm', 'namespace' => 'hrm'],function(){
					Route::group(['middleware'=>'role'],function(){
						// Route::post('role_permisson_save',		['as'=>'save.role_permisson', 'uses'=>'UserRoleController@role_permisson_save']);
						Route::get('employees', 				['as'=> 'list.employee' , 'uses' => 'EmployeeController@index']);
						Route::get('employee/export',			['as'=>	'export.employee','uses'=>'EmployeeController@export']);
						Route::get('employee/import',			['as'=>	'import.employee','uses'=>'EmployeeController@import']);
						Route::post('employee/import',			['as'=>	'import.employee.post','uses'=>'EmployeeController@importEmployee']);
						Route::get('leave-categories',			['as'=> 'leave.categories' , 'uses' =>'LeaveCategoryController@index']);
						Route::get('leaves/{id?}',				['as'=> 'leaves' , 'uses' =>'LeavesController@index']);
						Route::get('leave-categories',			['as'=> 'leave.categories' , 'uses' =>'LeaveCategoryController@index']);
						Route::get('/attendance',				['as'=> 'list.attendance' , 'uses' => 'AttendanceController@list_attendance']);
						Route::get('/holidays/{id?}',			['as'=> 'list.holidays' , 'uses' => 'HolidayController@listHoliday']);
						
						Route::post('/attendance/import',		['as'=> 'upload.attendance' , 'uses' => 'AttendanceController@attendance_import']);
						Route::get('/attendance/import',		['as' => 'import.form.attendance' , 'uses' => 'AttendanceController@import_form']);
						Route::post('employee/update', 			['as' => 'update.employee' , 'uses' => 'EmployeeController@update']);
						Route::get('employee/delete/{id}', 		['as' => 'delete.employee' , 'uses' => 'EmployeeController@delete']);
						Route::get('/designations/{id?}',		['as' => 'designations' , 'uses' => 'DesignationsController@index']);
						Route::get('/departments/{id?}',		['as' => 'departments' , 'uses' => 'DepartmentsController@index']);
						Route::get('shifts/{id?}',				['as' => 'shifts' , 'uses' =>'ShiftsController@index']);
						Route::get('openings',					['as' => 'list.opening', 'uses'=>'JobOpeningController@index']);
						Route::get('applicants',				['as' => 'list.applicant', 'uses'=>'ApplicantController@index']);
						Route::get('applications',				['as' => 'list.applicantions', 'uses'=>'ApplicationController@index']);


					});
				});
				Route::group(['prefix'=>'hrm', 'namespace' => 'hrm'],function(){

					Route::post('ajax_user_drop_down',['as'=>'user.drop-downs', 'uses'=>'LeaveCategoryController@get_user_by_designation']);
					Route::get('drop-downs',['as'=>'drop-downs', 'uses'=>'SalaryController@drop_downs']);
					Route::get('payscale/{id?}', ['as'=> 'list.payscale' , 'uses' => 'PayscaleController@index']);
					Route::post('payscale/store', ['as'=> 'store.payscale' , 'uses' => 'PayscaleController@store']);
					Route::get('payscale/delete/{id}', ['as'=> 'delete.payscale' , 'uses' => 'PayscaleController@delete']);
					Route::match(['post','get'],'payscale/edit/{id}', ['as'=> 'edit.payscale' , 'uses' => 'PayscaleController@edit']);

					// Route::get('/salary/{id?}',['as'=>'hrm.salary','uses'=>'SalaryController@index']);
					Route::match(['get','post'],'/salary/{id?}',['as'=>'hrm.salary','uses'=>'SalaryController@generate_salary']);
					Route::match(['get','post'],'generate/salary',['as'=>'hrm.generate.salary','uses'=>'SalaryController@generate_salary_slip']);
					Route::match(['get','post'],'generate/salary_view',['as'=>'hrm.generate.salary_view','uses'=>'SalaryController@generate_salary_slip_view']);
					Route::get('salary_slip/{id}',['as'=>'salary.slip.view','uses'=>'SalaryController@view_salary_slip']);
					Route::get('download_salary_slip/{id}',['as'=>'salary.slip.download','uses'=>'SalaryController@salary_download_pdf']);
					Route::get('salary_slip/delete/{id}',['as'=>'salary.slip.delete','uses'=>'SalaryController@delete_salary_slip']);
					// (){
					// 		return view('organization.profile.salary');
					// 	}]);

					Route::get('log',['as'=>'list.log', 'uses'=>'LogsystemController@viewLog']);
					Route::post('log',['as'=>'search.log', 'uses'=>'LogsystemController@search_log']);
					Route::get('application/{id}',['as'=>'applied.application', 'uses'=>'JobOpeningController@applied_application']);
					Route::get('employee/list',			['as'=>'employee.list.ajax','uses'=>'EmployeeController@employeeListDatatable']);
					Route::group(['middleware'=>'log'],function(){
						
							Route::get('application/{id}',				['as' => 'view.applicantion', 'uses'=>'ApplicationController@application_view']);
							Route::get('application/delete/{id}',				['as' => 'delete.applicantion', 'uses'=>'ApplicationController@delete']);


						Route::match(['get','post'],'applicant/create',['as'=>'applicant.create', 'uses'=>'ApplicantController@create']);
						Route::match(['get','post'],'applicant/edit/{id?}',['as'=>'edit.applicant', 'uses'=>'ApplicantController@update']);
						Route::get('applicant/delete/{id}',['as'=>'delete.applicant', 'uses'=>'ApplicantController@destroy']);


						Route::match(['get','post'],'opening/create',['as'=>'opening.create', 'uses'=>'JobOpeningController@create']);
						Route::match(['get','post'],'opening/update/{id?}',['as'=>'opening.update', 'uses'=>'JobOpeningController@update']);
						Route::get('opening/delete/{id}',['as'=>'delete.opening', 'uses'=>'JobOpeningController@destroy']);
						
						Route::get('application/apply/{id}',['as'=>'application', 'uses'=>'JobOpeningController@application']);

						//ROLE PERMISSON ROUTE
						// Route::get('role/create',['as'=>'create.role', 'uses'=>'UserRoleController@create']);
						
						
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
							Route::get('leave/category/delete/{id}',		['as' => 'delete.leave.category','uses'=>'LeaveCategoryController@delete']);
							Route::post('category/edit',		['as' => 'edit.category','uses'=>'LeaveCategoryController@editLeaveCat']);

						//Leave
							Route::post('leave/save',		['as' => 'store.leave' , 'uses' =>'LeavesController@save']);
							Route::post('leave/update',		['as' => 'update.leave' , 'uses' =>'LeavesController@update']);
							Route::get('leave/delete/{id}',		['as' => 'delete.leave' , 'uses' =>'LeavesController@delete']);
							Route::POST('leave/edit',		['as' => 'edit.leave' , 'uses' =>'LeavesController@editLeave']);
							Route::get('leave/approve/{id?}',		['as' => 'approve.leave' , 'uses' =>'LeavesController@approve_leave']);
							Route::get('leave/reject/{id?}',		['as' => 'reject.leave' , 'uses' =>'LeavesController@reject_leave']);


						//shifts
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
							Route::get('/attendance/files',				['as' => 'attendance.files' , 'uses' => 'AttendanceController@attendance_file']);



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
							// Route::get('/applications',		['as' => 'applications' , 'uses' => 'ApplicationController@index']);

						//Mail
							Route::get('/mails',		['as' => 'mails' , 'uses' => 'MailController@index']);

						//Applicants
							// Route::get('/applicants',		['as' => 'applicants' , 'uses' => 'ApplicantsController@index']);

						//Designation
							Route::post('/designation/save',			['as' => 'store.designation' , 'uses' => 'DesignationsController@save']);
							Route::post('/designation/update',			['as' => 'update.designation' , 'uses' => 'DesignationsController@update']);
							Route::post('edit/designation',			['as' => 'edit.designation','uses'=> 'DesignationsController@editUserDesignation']);
							Route::get('delete/designation/{id}',		['as' => 'delete.designation','uses'=> 'DesignationsController@deleteUserDesignation']);

						//Department
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
					Route::get('contacts', 				['as'=>'contact.list','uses'=>'ContactController@index']);
					Route::post('contacts/save', 		['as'=>'contact.save','uses'=>'ContactController@saveContact']);
					Route::get('contact/edit/{id}',		['as'=>'contact.edit','uses'=>'ContactController@edit']);
					Route::post('contact/update/{id}',	['as'=>'contact.update','uses'=>'ContactController@update']);
					Route::get('contact/delete/{id}',	['as'=>'delete.contact','uses'=>'ContactController@delete']);
					Route::post('client/save',			['as'=>'save.client','uses'=>'ClientController@save']);
					Route::get('client/view/{id}',		['as'=>'view.client','uses'=>'ClientController@view']);
					Route::get('client/edit/{id}',		['as'=>'edit.client','uses'=>'ClientController@edit']);
					Route::post('client/update/{id}',	['as'=>'update.client','uses'=>'ClientController@update']);
					Route::get('client/delete/{id}',	['as'=>'delete.client','uses'=>'ClientController@delete']);
					//Services
						Route::get('/services',['as'=>'list.services','uses'=>'ServicesController@index']);
						Route::match(['get','post'],'/service/save',['as'=>'save.service','uses'=>'ServicesController@create']);
						Route::get('/service/delete/{id}',['as'=>'delete.service','uses'=>'ServicesController@delete']);

						Route::match(['get','post'],'/service/price/{id?}',['as'=>'price.service','uses'=>'ServicesController@prices']);
						Route::get('delete/service/price/{id?}',['as'=>'delete.price.service','uses'=>'ServicesController@delete_pricing']);

					//customer
						Route::get('/customer',['as'=>'list.customer','uses'=>'CustomerController@index']);
					//Invoice
						Route::get('/invoices',['as'=>'list.invoice','uses'=>'BillingController@index']);
					//billing
						Route::get('/billings',['as'=>'list.billing','uses'=>'BillingController@billing']);
					//products
						Route::get('/products',['as'=>'list.products','uses'=>'ProductsController@index']);
						Route::get('/product/delete/{id}',['as'=>'delete.products','uses'=>'ProductsController@delete']);
						Route::match(['get','post'],'/product/save',['as'=>'save.product','uses'=>'ProductsController@create']);
						Route::match(['get','post'],'/product/price/{id?}',['as'=>'price.products','uses'=>'ProductsController@prices']);
						Route::get('delete/product/price/{id?}',['as'=>'delete.price.products','uses'=>'ProductsController@delete_pricing']);
					//Category price.products
						Route::get('product/category',['as'=>'list.product.category','uses'=>'CategoryController@product_category_listing']);
						Route::post('/category/save',['as'=>'save.crm.category','uses'=>'CategoryController@save_category']);
						Route::get('/category/delete/{id}',['as'=>'delete.crm.category','uses'=>'CategoryController@delete']);
					//service category
						Route::get('/service/category',['as'=>'list.service.category','uses'=>'CategoryController@service_category_listing']);


					//Leads
						Route::get('/leads',['as'=>'leads','uses'=>'LeadsController@index']);
					//sales
						Route::get('/sales',['as'=>'sales','uses'=>'SalesController@index']);
					//pricing
						Route::get('/pricing',['as'=>'pricing','uses'=>'BillingController@pricing']);
					//pricing
						Route::get('/payment-methods',['as'=>'payment-methods','uses'=>'PaymentMethodController@index']);
						Route::post('/payment-method/save',['as'=>'save.payment.method','uses'=>'PaymentMethodController@create']);
						Route::get('/payment-method/delete/{id}',['as'=>'delete.payment.method','uses'=>'PaymentMethodController@delete']);		
				});



				//notes
				Route::get('project/notes/list',	['as'=>'list.notes','uses'=>'project\NotesController@listNotes']);
				Route::get('project/notes/{id}',	['as'=>'notes.project','uses'=>'project\NotesController@index']);
				Route::post('project/notes/save',	['as'=>'save.notes','uses'=>'project\NotesController@createNotes']);
				Route::post('project/notes/edit',	['as'=>'edit.notes','uses'=>'project\NotesController@edit']);
				Route::post('project/notes/delete',	['as'=>'delete.account.notes','uses'=>'project\NotesController@delete']);
				// end notes


				
				//Project Routes
					include 'custom/organization/project.php';

				Route::get('/project/todo/list/{id?}',	['as'=>'list.todo','uses'=>'project\TodoController@listTodo']);
				Route::get('project/todo/{id?}',	['as'=>'todo.project','uses'=>'project\ProjectController@todo']);
				Route::post('/project/todo/create',	['as'=>'create.todo','uses'=>'project\TodoController@create']);
				
				Route::POST('/project/todo/edit',	['as'=>'edit.todo','uses'=>'project\TodoController@edit']);
				Route::POST('/project/todo/delete',	['as'=>'delete.todo','uses'=>'project\TodoController@delete']);
				Route::POST('/project/todo/filter',	['as'=>'filter.todo','uses'=>'project\TodoController@filterData']);
				
				//tasks
				Route::get('project/tasks/{id?}',['as'=> 'tasks.project','uses' => 'project\ProjectController@tasks']);
				
				

				Route::group(['namespace' => 'dataset'],function(){
					//dataset
					include_once 'custom/organization/dataset.php';

				});
			     
                include_once 'custom/organization/cms/menu.php';
						

					
					
				Route::group(['prefix'=>'cms','namespace' => 'cms'],function(){


					Route::group(['middleware' => 'role'],function(){
						Route::get('/categories/{id?}',['as'=>'categories','uses'=>'categoriesController@listdata']);
						Route::get('/posts',['as'=>'list.posts' , 'uses'=>'PagesController@listposts']);

						Route::match(['get','post'],'/design-settings',		['as'=>'design.settings' , 'uses'=>'PagesController@designSettings']);
					});
					
					//pages
					include_once 'custom/organization/pages.php';

					// posts
					Route::get('/posts/{id}',	['as'=>'edit.posts' , 'uses'=>'PagesController@editposts' ]);
					Route::post('/posts/save',	['as'=>'store.posts' , 'uses'=>'PagesController@savePosts' ]);
					Route::post('/posts/update',	['as'=>'update.posts', 'uses'=>'PagesController@updatePosts' ]);
					Route::get('/posts/delete/{id}',	['as'=>'delete.posts', 'uses'=>'PagesController@deletePosts' ]);
					Route::post('/posts/status/update',['as'=>'update.status.posts','uses'=>'PagesController@updateStatusPosts']);
					Route::post('/posts/save/custom-code',['as'=>'custom.save.post','uses'=>'PagesController@saveCustomeCode']);
					Route::get('/posts/setting/{id}',['as'=> 'setting.posts' , 'uses' => 'PagesController@pageSetting']);
					Route::get('/posts/custom/{id}',['as'=> 'custom.setting.posts' , 'uses' => 'PagesController@customeCode']);

					Route::post('/save/categories',['as' => 'category.save' , 'uses' => 'categoriesController@save']);
					Route::get('/delete/categories/{id}',['as' => 'category.delete' , 'uses' => 'categoriesController@delete']);
					Route::get('/edit/categories/{id}',['as' => 'category.edit' , 'uses' => 'categoriesController@getDataById']);
					Route::post('/update/categories/{id}',['as' => 'category.update' , 'uses' => 'categoriesController@updateCategory']);

					Route::get('/media',['as'=>'media','uses'=>'MediaController@index']);
					Route::get('/gallery',['as'=>'gallery','uses'=>'MediaController@gallery']);
					Route::post('/gallery-item',['as'=>'get.gallery.item','uses'=>'MediaController@getGalleryItem']);
					Route::post('/gallery/save',['as'=>'save.gallery.item','uses'=>'MediaController@saveGalleryItem']);
					Route::post('/update/media/info',['as'=>'media.info.update','uses'=>'MediaController@updateGalleryInfo']);


					Route::match(['get','post'],'/media/create',['as'=>'create.media','uses'=>'MediaController@create']);

					//sliders
					Route::get('sliders'			,['as' => 'list.sliders' , 'uses' => 'SliderController@index']);
					Route::get('slider/create' 		,['as' => 'create.slider' , 'uses' => 'SliderController@addSlide']);
					Route::post('slider/save' 		,['as' => 'save.slider' , 'uses' => 'SliderController@saveSlider']);
					Route::get('slider/delete/{id}' ,['as' => 'delete.slider' , 'uses' => 'SliderController@deleteSlider']);
					Route::get('slider/options/{id}',['as' => 'options.slider' , 'uses' => 'SliderController@sliderOptions']);
					Route::get('slider/edit/{id}'	,['as' => 'slider.edit' , 'uses' => 'SliderController@sliderEdit']);
					Route::post('slider/update'	,['as' => 'slider.update' , 'uses' => 'SliderController@sliderUpdate']);
					Route::post('save/options'		,['as' => 'options.save' , 'uses' => 'SliderController@saveSliderOptions']);
					Route::get('slider/settings/{id}',['as' => 'settings.slider' , 'uses' => 'SliderController@sliderSettings']);
					Route::post('save/settings'		,['as' => 'settings.save' , 'uses' => 'SliderController@saveSliderSettings']);
					
				});
				//Route::get('page/{slug}',	['as'=>'view.pages' , 'uses'=>'cms\PagesController@viewPage' ]);

				Route::group(['prefix'=>'support','namespace' => 'support'],function(){
					//include_once Auther: Ashish kumar
					include_once 'custom/organization/support.php';	
					Route::get('tickets',	['as'=>'support.tickets','uses'=>'SupportsController@index']);
					Route::get('categories',		['as'=>'support.categories','uses'=>'SupportsController@Categories']);
					Route::get('knowledge-base',	['as'=>'knowledge-base','uses'=>'SupportsController@knowledgeBase']);
					Route::get('faq',	['as'=>'faq','uses'=>'SupportsController@FAndQ']);
					Route::post('create/feedback',['as' => 'create.feedback' , 'uses' => 'FeedbackController@create']);
					Route::get('feedbacks',['as' => 'list.feedback' , 'uses' => 'FeedbackController@listFeedbacks']);
					Route::get('feedback/create',['as' => 'add.feedback' , 'uses' => 'FeedbackController@createFeedback']);
					Route::get('edit/feedback/{id}',['as' => 'edit.feedback' , 'uses' => 'FeedbackController@editFeedback']);
					Route::get('delete/feedback/{id}',['as' => 'delete.feedback' , 'uses' => 'FeedbackController@delete']);
					Route::post('update/feedback',['as' => 'update.feedback' , 'uses' => 'FeedbackController@update']);
				});

				Route::group(['namespace'=>'users'],function(){
					//Users
					include_once 'custom/organization/user.php';					
				});
				
					
			});
		});
					//custom maps
					Route::get('/maps/{type?}', 		['as'=>'org.custom.maps','uses'=>'Admin\CustomMapsController@index']);
					Route::post('/map/save',			['as'=>'org.save.custom.map','uses'=>'Admin\CustomMapsController@saveMap']);
					Route::get('/map/delete/{id}',		['as'=>'org.delete.custom.map','uses'=>'Admin\CustomMapsController@DeleteUserMap']);
					Route::get('/map/edit/{id}',		['as'=>'org.getData.custom.map','uses'=>'Admin\CustomMapsController@getDataById']);
					Route::post('/map/update/{id}',		['as'=>'org.update.custom.map','uses'=>'Admin\CustomMapsController@updateMap']);
					Route::get('/map/views/{id}',		['as'=>'org.global.view.map','uses'=>'Admin\CustomMapsController@viewMapUsers']);
					Route::get('/map/view/{id}',		['as'=>'org.view.map','uses'=>'Admin\CustomMapsController@viewUserMap']);
					Route::post('/map/export',			['as'=>'org.export.map','uses'=>'CustomMapsController@processExcelFile']);

					//forms
					include_once 'custom/organization/forms.php';
    //});


Route::get('access_denied',['as' => 'access.denied','uses' => function(){
	return View::make('errors.accessdenied');
}]);
Route::get('email-template',['as' => 'email.template','uses' => function(){
	return View::make('organization.login.reset-email-template');
}]);
	
	/****************************************** All Routes For Organization *************************************************/
	
	/****************************************** Pages for experiments *************************************************/
 
Route::get('docs',['as' => 'new.layout','uses' => function(){
	return View::make('organization.demo.NewLayout');
}]);
Route::group(['prefix'=>'front'], function(){	 
	Route::get('clients',['as' => '.create.clients','uses' => function(){
		return View::make('front.clients.index');
	}]);

});

	/***************************************** Public Route for Shared Survey ******************************************/
	Route::get('/survey/{token}',['middleware'=>'survey.auth','as'=>'embed.survey','uses'=>'Organization\survey\SurveyController@embededSurvey']);


	

	/***************************************** Public Route for Share Data ******************************************/

	Route::get('/public/custom-maps/{map_id}/{theme?}/{data?}',['as'=>'public.map','uses'=>'Admin\CustomMapsController@publicMaps']);
	Route::get('/public/maps/{map_id}/{theme?}/{source?}/{data?}',['as'=>'public.maps','uses'=>'Admin\CustomMapsController@public_maps']);
	
