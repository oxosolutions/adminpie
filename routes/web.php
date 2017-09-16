<?php

	/****************************************** All Routes For Admin *************************************************/
// Route::get('close/model' , ['as' => 'close.model', 'uses' => 'Organization\DashboardController@closeModal']);

	//Route::group(['prefix'=>'admin'], function(){

		Route::group(['domain' => 'manage.adminpie.com'], function () {
			Route::group(['namespace'=>'Admin'], function(){
				Route::group(['middleware' => 'auth.admin'], function(){
					//Activity 
					Route::get('activities', ['as'=>'activities' , 'uses'=>'ActivityTemplateController@index']);
					Route::match(['get','post'], 'activity/template', ['as'=>'activity.template' , 'uses'=>'ActivityTemplateController@create']);
					Route::match(['get','post'], 'activity/edit/{id?}', ['as'=>'activity.edit' , 'uses'=>'ActivityTemplateController@edit']);
					Route::get('activity/delete/{id?}', ['as'=>'activity.delete' , 'uses'=>'ActivityTemplateController@delete']);
					//Notification
					Route::get('notifications', ['as'=>'notifications' , 'uses'=>'ActivityTemplateController@notificationList']);
					Route::match(['get','post'], 'notification/template', ['as'=>'notification.template' , 'uses'=>'ActivityTemplateController@create_notification']);


					Route::match(['get','post'], 'email/template', ['as'=>'manage.email.template' , 'uses'=>'EmailTemplateController@create']);
					Route::match(['get','post'], 'email/edit/{id?}', ['as'=>'activity.edit' , 'uses'=>'EmailTemplateController@edit']);

					// Route::match(['get','post'], 'activity/edit/{id?}', ['as'=>'activity.edit' , 'uses'=>'ActivityTemplateController@edit']);
					// Route::get('activity/delete/{id?}', ['as'=>'activity.delete' , 'uses'=>'ActivityTemplateController@delete']);
					// 				
					//Widget Route
					//
					
					Route::get('widgets/{id?}', ['as'=>'index.widget' , 'uses'=>'WidgetController@index']);

					//these below 3 routes are only for design purpose
					Route::get('modules-design', ['as'=>'modulesdesign' , 'uses'=>function(){
						return view('admin.module-design');
					}]);
					Route::get('formbuilder', ['as'=>'modulesdesign' , 'uses'=>function(){
						return view('admin.formbuilder');
					}]);
					Route::get('widget', ['as'=>'widget' , 'uses'=>function(){
						return view('admin.widget');
					}]);

					Route::get('widget/delete/{id}', ['as'=>'delete.widget' , 'uses'=>'WidgetController@delete']);

					Route::match(['get', 'post'],'widget/create', ['as'=>'create.widget' , 'uses'=>'WidgetController@create']);
					Route::match(['get', 'post'],'widget/edit/{id?}', ['as'=>'edit.widget' , 'uses'=>'WidgetController@edit']);
					Route::post('widget/status/update', ['as'=>'status.widget' , 'uses'=>'WidgetController@update_widget_status']);
					Route::post('sort/widget' , ['as' => 'sort.widget' , 'uses' => 'WidgetController@sort']);
					Route::get('sort/down/{id}' , ['as' => 'sort.down' , 'uses' => 'WidgetController@sortWidgetDown']);
					Route::get('sort/up/{id}' , ['as' => 'sort.up' , 'uses' => 'WidgetController@sortWidgetUp']);
					// Route::post('widget/create', ['as'=>'create.widget' , 'uses'=>'WidgetController@create']);


					//Module route
					Route::get('/module/create',['as'=>'create.module' , 'uses'=>'ModuleController@create']);
					Route::post('/module/save',['as'=>'save.module' , 'uses'=>'ModuleController@save']);
					Route::match(['get','post'],'/module/edit/{id?}',['as'=>'edit.module' , 'uses'=>'ModuleController@edit']);
					Route::post('/module/update/{id}',['as'=>'update.module' , 'uses'=>'ModuleController@update']);
					Route::get('/module/delete/{id}',['as'=>'delete.module' , 'uses'=>'ModuleController@delete']);
					Route::get('/module/style/{id}',['as'=>'style.module' , 'uses'=>'ModuleController@style']);
					Route::post('/module/style/save',['as'=>'save.style.module' , 'uses'=>'ModuleController@saveStyle']);
					Route::post('/submodule/style/save',['as'=>'save.style.subModule' , 'uses'=>'ModuleController@saveStyleModule']);
					Route::get('/submodule/{id}',['as'=>'get.submodule' , 'uses'=>'ModuleController@getSubmodules']);

					Route::get('/modules/{id?}/{subModule?}',['as'=>'list.module' , 'uses'=>'ModuleController@listModule']);
					Route::get('module/add_route_row',['as'=>'route_row.module' , 'uses'=>'ModuleController@add_route_row']);
					Route::get('module/route/delete/{id}',['as'=>'delete.route' , 'uses'=>'ModuleController@delete_route']);
					Route::post('/module/status/update',['as'=>'status.module' , 'uses'=>'ModuleController@update_module_status']);

					Route::get('/singlemodule/{id?}',['as'=>'get.single.module','uses'=>'ModuleController@getSingleModule']);
					Route::get('/single/route/permission/{id?}',['as'=>'get.single.route.permission','uses'=>'ModuleController@getSingleRoutePermission']);
					
					//according to new design 
					Route::post('/save/module',['as'=>'module.save' , 'uses'=>'ModuleController@saveModule']);
					Route::post('/save/submodule',['as'=>'sub.module.save' , 'uses'=>'ModuleController@SubModuleSave']);
					Route::get('/delete/module/{id}',['as'=>'module.delete' , 'uses'=>'ModuleController@deleteModule']);
					Route::get('/delete/delModule/{id}',['as'=>'subModule.delete' , 'uses'=>'ModuleController@deletesubModule']);
					Route::POST('/edit/subModule',['as'=>'edit.subModule' , 'uses'=>'ModuleController@editsubModule']);
					Route::get('/delete/submodule/permission/{id}/{route_name}',['as'=>'delete.subModule.permission' , 'uses'=>'ModuleController@deletesubModulePermission']);

					//sort module
					Route::post('/sort/module',['as'=>'sort.module','uses'=>'ModuleController@sortModule']);
					Route::get('/module/sort/down/{id}',['as'=>'module.sort.down','uses'=>'ModuleController@sortModuleDown']);
					Route::get('/module/sort/up/{id}',['as'=>'module.sort.up','uses'=>'ModuleController@sortModuleUp']);
					Route::get('/submodule/sort/down/{id}/{subModule}',['as'=>'sub.module.sort.down','uses'=>'ModuleController@sortSubModuleDown']);
					Route::get('/submodule/sort/up/{id}/{subModule}',['as'=>'sub.module.sort.up','uses'=>'ModuleController@sortSubModuleUp']);


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
					Route::get('organization/change/status/{id}' , ['as' => 'change.org.status','uses' => 'OrganizationController@changeStatus']);

					/*
					* All Routes For Form Builder
					*/
					Route::POST('/create',				['as'=>'create.forms','uses'=>'FormBuilderController@createForm']);
					Route::get('/forms',				['as'=>'list.forms','uses'=>'FormBuilderController@listForm']);
					Route::get('/form/settings/{id}',	['as'=>'form.settings','uses'=>'FormBuilderController@formSettings']);
					Route::post('/form/savemeta/{is}', 	['as'=>'save.form.settings','uses'=>'FormBuilderController@storeSettings']);
					Route::get('form/custom/{id}',['as' => 'form.custom' , 'uses' => 'FormBuilderController@customForm']);
					Route::get('form/preview/{id}',		['as' => 'form.preview' , 'uses' => 'FormBuilderController@previewForm']);
					Route::post('save/form/custom/{id}',['as' => 'save.form.custom' , 'uses' => 'FormBuilderController@saveCustomForm']);
					Route::post('update/form/custom/{id}',['as' => 'update.form.custom' , 'uses' => 'FormBuilderController@updateCustomForm']);
					Route::get('/forms/delete/{id}',	['as'=>'delete.form','uses'=>'FormBuilderController@deleteForm']);
					Route::get('/form/{form_id}/sections',['as'=>'list.sections','uses'=>'FormBuilderController@sectionsList']);
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
					Route::get('/field/delete/{id}',	['as'=>'field.delete','uses'=>'FormBuilderController@deletefield']);
					Route::post('/form/section/update/{form_id}', ['as'=>'section.update','uses'=>'FormBuilderController@updateSection']);
					Route::post('/form/field/create/{form_id}/{section_id}', ['as'=>'create.field','uses'=>'FormBuilderController@createField']);
					Route::post('/form/update/field/{form_id}/{section_id}/{field_id}',['as'=>'update.field','uses'=>'FormBuilderController@updateField']);
					Route::get('/form/section/delete/{section_id}',['as'=>'section.delete','uses'=>'FormBuilderController@deleteSection']);
					Route::post('/section/sort',['as'=>'section.sort','uses'=>'FormBuilderController@sectionSort']);
					Route::get('/field/sort/down/{id}',['as'=>'field.down.sort','uses'=>'FormBuilderController@fieldSortDown']);
					Route::get('/field/sort/up/{id}',['as'=>'field.up.sort','uses'=>'FormBuilderController@fieldSortUp']);
					Route::get('/field/clone/{id}',['as'=>'field.clone','uses'=>'FormBuilderController@fieldClone']);
					Route::get('/section/clone/{id}',['as'=>'section.clone','uses'=>'FormBuilderController@sectionClone']);
					Route::post('/section/move',['as'=>'section.move','uses'=>'FormBuilderController@sectionMove']);
					Route::post('/field/move/{field_id}',['as'=>'field.move','uses'=>'FormBuilderController@fieldMove']);
					Route::post('/section',['as'=>'get.section','uses'=>'FormBuilderController@listSections']);

					Route::get('/form/clone/{id}',['as'=>'form.clone','uses'=>'FormBuilderController@formClone']);

					
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
				Route::get('settings/remove/logo', ['as' => 'remove.logo' , 'uses' => 'SettingController@removeLogo']);

				Route::get('logout',  		['as'=> 'admin.logout','uses'=>'Auth\LoginController@logout']);
				Route::get('login',			['as'=>'admin.login','uses'=>'Auth\LoginController@showLoginForm']);
				Route::post('login',		['as'=>'login.post','uses'=>'Auth\LoginController@login']);
				Route::get('create/page',	['as'=> 'create.pages' , 'uses' => 'PagesController@create']);
				Route::post('/store/pages',	['as'=> 'store.pages' , 'uses' => 'PagesController@store']);
				Route::get('pages',			['as'=> 'admin.pages' , 'uses' => 'PagesController@listPages']);
				

				// Custom Maps
				Route::get('/custom-maps/{type?}', 				['as'=>'custom.maps','uses'=>'CustomMapsController@index']);
				Route::get('/custom-maps/g', 				['as'=>'custom.maps.global','uses'=>'CustomMapsController@index']);
				Route::get('/custom-maps/u', 				['as'=>'custom.maps.user','uses'=>'CustomMapsController@index']);
				Route::post('/custom-map/save',			['as'=>'save.custom.map','uses'=>'CustomMapsController@saveMap']);
				Route::get('/custom-map/delete/{id}',	['as'=>'delete.custom.map','uses'=>'CustomMapsController@DeleteGlobalMap']);
				Route::get('/custom-map/edit/{id}',	['as'=>'getData.custom.map','uses'=>'CustomMapsController@getDataById']);
				Route::post('/custom-map/update/{id}',		['as'=>'update.custom.map','uses'=>'CustomMapsController@updateMap']);

				Route::get('/custom-map/view/{id}',		['as'=>'view.map','uses'=>'CustomMapsController@viewmap']);

			});
		});

			/******************************* All Routes For Admin *******************************************/
										//demo form route for setting
			/******************************* All Routes For Organization ************************************/

		Route::group(['namespace'=>'Organization'], function(){


			Route::get('/survey', ['as'=>'display.survey', 'uses'=>'survey\SurveyController@display_survey']);
			Route::post('/survey/save', ['as'=>'filled.survey', 'uses'=>'survey\SurveyController@save_survey']);
			Route::get('/survey/delete/table/{table_name}', ['as'=>'delete.table', 'uses'=>'survey\SurveyController@delete_survey_table']);

			// Route::post('/survey/filled/save', ['as'=>'filled.survey', 'uses'=>'survey\SurveyController@survey_filled_data_save']);


			Route::group(['middleware'=>'role'],function(){
				Route::get('settings/department', ['as' => 'department.settings' , 'uses' => 'hrm\SettingController@departmentSetting']);
				Route::get('settings/organization' , ['as'=>'setting.org' , 'uses' => 'hrm\SettingController@orgSetting']);
				//Deleted employees
				Route::get('deleted/employees',['as'=>'deleted.employee','uses'=>'hrm\SettingController@deletedEmployees']);
				//Tools Widget
				Route::get('/tools',['as'=>'tools','uses'=>'tools\ToolsController@tools']);
				Route::post('/tools/website-rank',['as'=>'website.rank','uses'=>'tools\ToolsController@websiteRank']);
			});
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
			Route::post('register', ['as'=>'register' ,'uses' => 'Auth\LoginController@register']);

		//Email Template
			Route::get('emails',['as'=>'emails' , 'uses'=>'templates\EmailTemplateController@index']);

			Route::match(['get','post'],'/signup',	['as'=>'signup.user','uses'=>'users\UsersController@public_store_user']);
			// Route::post('/sign-up/save',		['as'=>'signup.user','uses'=>'users\UsersController@public_store_user']);

			// visualization
			// 
			Route::group(['middleware'=>'role'],function(){
						
				Route::get('create/visualization' , ['as' => 'create.visual' , 'uses' => 'visualization\VisualisationController@create']);
			});
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

			Route::match(['get','post'],'/visualization/view/{id}',['as'=>'visualization.view','uses'=>'visualization\VisualisationController@embedVisualization']);
			Route::post('/visualization/settings/save/{id}',['as'=>'visualization.settings.save','uses'=>'visualization\VisualisationController@saveVisualizationSettings']);
			//surveys
			Route::get('/surveys',						['as'=>'list.survey','uses'=>'survey\SurveyController@listSurvey']);
			Route::get('/survey/{form_id}/sections',	['as'=>'survey.sections.list','uses'=>'survey\SurveyController@sectionsList']);
			Route::get('/survey/stats/{id}',			['as'=>'stats.survey','uses'=>'survey\SurveyStatsController@stats']);
			Route::get('/survey/structure/{id}',			['as'=>'structure.survey','uses'=>'survey\SurveyStatsController@survey_structure']);
			Route::match(['get','post'],'/survey/result/{id?}',			['as'=>'results.survey','uses'=>'survey\SurveyStatsController@survey_result']);
			Route::get('/survey/add',					['as'=>'create.survey','uses'=>'survey\SurveyController@createSurvey']);
			Route::get('/survey/settings/{id}',			['as'=>'survey.settings','uses'=>'survey\SurveyController@surveySettings']);
			Route::post('/survey/settings/save/{id}',	['as'=>'save.survey.settings','uses'=>'survey\SurveyController@saveSurveySettings']);
			Route::get('/survey/perview/{form_id}',		['as'=>'survey.perview','uses'=>'survey\SurveyController@surveyPerview']);
			Route::get('/survey/result',				['as'=>'result.survey','uses'=>'survey\SurveyController@resultSurvey']);
			Route::get('/survey/share/{id}',			['as'=>'share.survey','uses'=>'survey\SurveyController@shareSurvey']);
			Route::post('/survey/shareto/{id}',			['as'=>'save.shareto','uses'=>'survey\SurveyController@saveShareTo']);
			Route::get('/survey/shareto/delete/{id}',	['as'=>'survey.remove.shareto','uses'=>'survey\SurveyController@deleteShareTo']);

			Route::group(['middleware' => ['auth.org']], function(){
				//new emails route by ashish
				Route::get('email',					['as'=>'emails' , 'uses'=>'email\EmailController@index']);
				Route::get('email/send', 			['as'=>'email.send' , 'uses'=>'email\EmailController@sendEmail']);
				Route::get('/email/delete/{id}',	['as'=>'delete.email','uses'=>'email\EmailController@deleteEmail']);
				Route::post('campaign/save', 		['as'=>'save.campaign','uses'=>'email\EmailController@saveCampaign']);
				Route::get('campaign/edit/{id}', 	['as'=>'edit.campaign','uses'=>'email\EmailController@sendEmail']);
				Route::get('email/templates', 		['as'=>'email.templates' , 'uses'=>'email\EmailController@templates']);
				Route::get('email/create-template', ['as'=>'create.template' , 'uses'=>'email\EmailController@createTemplates']);
				Route::get('email/edit-template/{id}',	['as'=>'edit.template' , 'uses'=>'email\EmailController@getInfoTemplates']);
				Route::POST('email/update-template',	['as'=>'update.template' , 'uses'=>'email\EmailController@updateTemplates']);
				Route::get('email/layouts', 		['as'=>'email.layouts' , 'uses'=>'email\EmailController@layouts']);
				Route::get('email/layout/delete/{id}', ['as'=>'email.layout.delete' , 'uses'=>'email\EmailController@deleteLayout']);
				Route::get('email/edit-layout/{id}',	['as'=>'edit.layout' , 'uses'=>'email\EmailController@getInfolayout']);
				Route::POST('email/update-layout',	['as'=>'update.layout' , 'uses'=>'email\EmailController@updatelayout']);
				Route::get('email/template/delete/{id}', ['as'=>'email.templates.delete' , 'uses'=>'email\EmailController@deleteTemplates']);
				Route::get('email/create-layouts', 	['as'=>'create.layouts' , 'uses'=>'email\EmailController@createLayouts']);
				Route::post('layout/save', 			['as'=>'save.layout' , 'uses'=>'email\EmailController@saveLayout']);
				Route::post('template/save', 			['as'=>'save.template' , 'uses'=>'email\EmailController@saveTemplate']);

				Route::get('documents', ['as'=>'documents' , 'uses'=>'document\DocumentController@index']);
				Route::get('document/templates', ['as'=>'document.templates' , 'uses'=>'document\DocumentController@templates']);
				Route::get('document/layouts', ['as'=>'document.layouts' , 'uses'=>'document\DocumentController@layouts']);

				Route::post('organization/settings/save',['as'=>'save.organization.settings','uses'=>'hrm\SettingController@saveOrganizationSettings']);
				Route::post('settings/save', ['as'=>'settings.save','uses'=>'hrm\SettingController@saveSettings']);
				Route::get('settings/hrm' , ['as'=>'setting.attendance' , 'uses'=>'hrm\SettingController@attendanceSetting']);
				Route::get('settings/user' , ['as'=>'setting.user' , 'uses'=>'hrm\SettingController@userSetting']);
				Route::get('settings/emp' , ['as'=>'setting.employee' , 'uses' => 'hrm\SettingController@employeeSetting']);
				Route::get('settings/role' , ['as'=>'setting.role' , 'uses' => 'hrm\SettingController@roleSetting']);
				Route::get('settings/leaves' , ['as'=>'setting.leaves' , 'uses' => 'hrm\SettingController@leaveSetting']);
				
				Route::get('/', function(){
					return redirect()->route('organization.dashboard');
				});
					// Route::get('delete/dashboards/widget/{slug?}/{id?}/{widget_id?}',['as'=>'delete.widget.dashboard','uses'=>'DashboardController@deleteWidget']);
				Route::post('delete/dashboards/widget',['as'=>'delete.widget.dashboard','uses'=>'DashboardController@deleteWidget']);
				Route::get('delete/dashboards/{slug}',['as'=>'delete.dashboard','uses'=>'DashboardController@deleteDashboard']);
				Route::post('edit/dashboards',['as'=>'edit.dashboard','uses'=>'DashboardController@EditDashboard']);
				Route::post('update/dashboards',['as'=>'update.edit.dashboard','uses'=>'DashboardController@UpdateDashboard']);
				Route::post('sort/dashbaord',['as'=>'sort.dashboard','uses'=>'DashboardController@sortDashboard']);
				Route::group(['middleware'=>'role'],function(){
					Route::get('/holiday/list/{id?}',['as'=>'holiday.list','uses'=>'hrm\HolidayController@holidayList']);
					Route::get('dashboard/{id?}',['as'=>'organization.dashboard','uses'=>'DashboardController@index']);

					Route::any('/account/leaves/{id?}',['middleware'=>'role', 'as'=>'account.leaves','uses'=>'hrm\EmployeeLeaveController@leave_listing']);
					Route::get('account/todo/{id?}',	['as'=>'account.todo','uses'=>'project\ProjectController@todo']);
					Route::get('account/tasks/{id?}',			['as'=>'account.tasks','uses'=>'account\TasksController@index']);
					Route::get('account/notes/{id?}',['as'=>'account.notes','uses'=>'project\NotesController@index']);

				});
				Route::any('account/leave/{id?}',['as'=>'store.employeeleave' , 'uses'=>'hrm\EmployeeLeaveController@store']);

				//Notes
				Route::get('account/notes/list',	['as'=>'account.notes.list.ajax','uses'=>'project\NotesController@listNotes']);
				Route::post('account/notes/save',	['as'=>'save.account.notes','uses'=>'project\NotesController@createNotes']);
				Route::post('account/notes/edit',	['as'=>'edit.account.notes','uses'=>'project\NotesController@edit']);
				Route::post('account/notes/delete',	['as'=>'delete.account.notes','uses'=>'project\NotesController@delete']);

				Route::post('account/tasks/status/update',['as'=>'task.status.update','uses'=>'account\TasksController@changeStatus']);
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

				Route::post('save/dashboard/widget',['as'=>'update.dashboard.widget','uses'=>'DashboardController@saveWidget']);
				Route::post('save/dashboard' , ['as' => 'dashboard.save', 'uses' => 'DashboardController@dashboards']);

				//profile
				Route::group(['prefix' => 'account','namespace' => 'account'],function(){
					//change password
					Route::group(['middleware'=>'role'],function(){
						Route::get('/activities/{id?}',['as'=>'account.activities','uses'=>'AccountActivityController@listActivities']);
						Route::any('/attendance/{id?}',['as'=>'account.attandance','uses'=>'AttendanceController@myattendance']);
						Route::get('/profile/{id?}',['as'=>'account.profile','uses'=>'AccountController@profileDetails']);
						Route::get('/performance/{id?}',['as'=>'account.performance','uses'=>function(){
							return view('organization.profile.performance');
						}]);
						Route::get('/emails/{id?}',['as'=>'account.emails','uses'=>'AccountController@emailsList']);
						Route::get('/emails/view/{id}',['as'=>'account.emails.view','uses'=>'AccountController@emailDetails']);
						
						Route::get('/chat/{id?}',['as'=>'account.chat','uses'=>function(){
							return view('organization.profile.chat');
						}]);
						Route::get('/discussion/{id?}',['as'=>'account.discussion','uses'=>function(){
							return view('organization.profile.discussion');
						}]);

						Route::get('/projects/{id?}',[ 'as'=>'account.projects','uses'=>'AccountController@listProjects']);

					});

					Route::post('change/password' , ['as' => 'change.password' , 'uses' => 'AccountController@changePassword']);

					//upload profile image
					Route::post('/profile/upload',['as'=>'profile.picture','uses'=>'AccountController@uploadProfile']);
					Route::get('/profile-picture/remove/{id}',['as'=>'profile.picture.delete','uses'=>'AccountController@deleteProfilePicture']);
					Route::patch('/profile/update/{id}',['as'=>'update.profile','uses'=>'AccountController@update']);
					Route::patch('/profile/storeMeta/{id}',['as'=>'update.profile.meta','uses'=>'AccountController@storeMeta']);
					Route::post('/attandance_monthly',['as'=>'account.attendance_monthly','uses'=>'AttendanceController@attendance_monthly']);
					Route::post('/attandance_weekly',['as'=>'account.attendance_weekly','uses'=>'AttendanceController@attendance_weekly']);

					//bookmarks
					Route::get('/bookmarks',	['as'=>'design.bookmark' , 'uses'=> 'BookmarkController@index']);
					Route::get('/bookmarks/create',	['as'=>'design.bookmark' , 'uses'=>function(){
						return view('organization.bookmarks.create');
					} ]);
					Route::post('/bookmark/save',	['as'=>'save.bookmark' , 'uses'=>'BookmarkController@saveBookmark' ]);
					Route::get('/bookmark/edit/{id}',	['as'=>'edit.bookmark' , 'uses'=>'BookmarkController@editBookmark' ]);
					Route::post('/bookmark/delete',	['as'=>'delete.bookmark' , 'uses'=>'BookmarkController@deleteBookmark' ]);
					Route::post('/bookmark/update/{id}',	['as'=>'update.bookmark' , 'uses'=>'BookmarkController@updateBookmark' ]);
					Route::post('/add/category',	['as'=>'create.bookmark.category' , 'uses'=>'BookmarkController@addBookmarkCategories' ]);
					Route::get('/delete/category/{id}',	['as'=>'delete.bookmark.category' , 'uses'=>'BookmarkController@delCategory' ]);

				/********************************  Task Routes *********************************************/
					

				/*******************************************************************************************/
				
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

					Route::post('ajax_user_drop_down',['as'=>'user.drop-downs', 'uses'=>'LeaveCategoryController@get_user_by_designation']);
					Route::get('drop-downs',['as'=>'drop-downs', 'uses'=>'SalaryController@drop_downs']);
					Route::get('payscale/{id?}', ['as'=> 'list.payscale' , 'uses' => 'PayscaleController@index']);
					Route::post('payscale/store', ['as'=> 'store.payscale' , 'uses' => 'PayscaleController@store']);
					Route::get('payscale/delete/{id}', ['as'=> 'delete.payscale' , 'uses' => 'PayscaleController@delete']);
					Route::match(['post','get'],'payscale/edit/{id}', ['as'=> 'edit.payscale' , 'uses' => 'PayscaleController@edit']);

					// Route::get('/salary/{id?}',['as'=>'hrm.salary','uses'=>'SalaryController@index']);
					Route::match(['get','post'],'/salary/{id?}',['as'=>'hrm.salary','uses'=>'SalaryController@generate_salary']);
					// (){
					// 		return view('organization.profile.salary');
					// 	}]);

					Route::get('log',['as'=>'list.log', 'uses'=>'LogsystemController@viewLog']);
					Route::post('log',['as'=>'search.log', 'uses'=>'LogsystemController@search_log']);
					Route::get('application/{id}',['as'=>'applied.application', 'uses'=>'JobOpeningController@applied_application']);
					Route::get('employee/list',			['as'=>'employee.list.ajax','uses'=>'EmployeeController@employeeListDatatable']);
					Route::group(['middleware'=>'log'],function(){
						Route::group(['middleware'=>'role'],function(){
							Route::post('role_permisson_save',['as'=>'save.role_permisson', 'uses'=>'UserRoleController@role_permisson_save']);
							Route::get('employees', 				['as'=> 'list.employee' , 'uses' => 'EmployeeController@index']);
							Route::get('employee/export',			['as'=>	'export.employee','uses'=>'EmployeeController@export']);
							Route::get('employee/import',			['as'=>	'import.employee','uses'=>'EmployeeController@import']);
							Route::post('employee/import',			['as'=>	'import.employee.post','uses'=>'EmployeeController@importEmployee']);
							Route::get('leave-categories',			['as'=> 'leave.categories' , 'uses' =>'LeaveCategoryController@index']);
							Route::get('leaves/{id?}',				['as'=> 'leaves' , 'uses' =>'LeavesController@index']);
							Route::get('leave-categories',			['as'=> 'leave.categories' , 'uses' =>'LeaveCategoryController@index']);
							Route::get('/attendance',				['as'=> 'list.attendance' , 'uses' => 'AttendanceController@list_attendance']);
							Route::get('/holidays/{id?}',			['as'=> 'list.holidays' , 'uses' => 'HolidayController@listHoliday']);
							Route::get('roles',						['as'=>	'list.role', 'uses'=>'UserRoleController@listRole']);
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
					Route::group(['middleware'=>'role'],function(){
						Route::get('/datasets',['as' => 'list.dataset','uses' => 'DatasetController@listDataset']);
						Route::get('/dataset/import',['as' => 'import.dataset','uses' => 'DatasetController@importDataset']);
						Route::get('/dataset/create',['as' => 'create.dataset','uses' => 'DatasetController@craeteDataset']);
					});

					Route::get('/dataset/{id}',['as' => 'view.dataset','uses' => 'DatasetController@viewDataset']);
					Route::post('/import/dataset', ['as'=>'upload.dataset','uses'=>'DatasetController@uploadDataset']);
					Route::post('/dataset/save',['as'=>'save.dataset','uses'=>'DatasetController@store']);
					Route::post('/dataset/update/{id}',['as'=>'update.dataset','uses'=>'DatasetController@updateRecords']);
					Route::post('/dataset/create/column/{id}',['as'=>'create.column','uses'=>'DatasetController@createColumn']);
					Route::get('/delete/dataset/{id}',['as'=>'delete.dataset','uses'=>'DatasetController@deleteDataset']);
				});
					Route::get('cms/menus',		['as'=>'list.menus' , 'uses'=>'cms\MenuController@index']);
					Route::post('cms/menus/create',['as'=>'create.menus' , 'uses'=>'cms\MenuController@create']);
					Route::get('cms/menus/edit/{id}',['as'=>'edit.menu' , 'uses'=>'cms\MenuController@edit']);
					Route::get('cms/menus/delete/{id}',['as'=>'delete.menu' , 'uses'=>'cms\MenuController@delete']);
					Route::post('cms/menus/item/create',['as'=>'create.menu.item' , 'uses'=>'cms\MenuController@createMenuItem']);
					Route::match(['get','post'],'cms/menus/item/update',['as'=>'update.menu.item' , 'uses'=>'cms\MenuController@updateMenuItem']);

					Route::get('cms/menus/item/delete/{id}',['as'=>'delete.menu.items' , 'uses'=>'cms\MenuController@DeleteMenuItem']);
					Route::post('cms/menus/item/get',['as'=>'get.menu.item' , 'uses'=>'cms\MenuController@getMenuItem']);
					Route::get('cms/menus/item',['as'=>'menu.item' , 'uses'=>'cms\MenuController@getMenuItems']);

				Route::group(['prefix'=>'cms','namespace' => 'cms'],function(){
					Route::get('/page/{id}',	['as'=>'edit.pages' , 'uses'=>'PagesController@edit' ]);
					// Route::post('/page/update',	['as'=>'update.pages' , 'uses'=>'PagesController@updatePage' ]);
					Route::get('/pages',		['as'=>'list.pages' , 'uses'=>'PagesController@listPage' ]);

					Route::group(['middleware'=>'role'],function(){
						Route::get('/categories/{id?}',['as'=>'categories','uses'=>'categoriesController@listdata']);
						Route::get('/posts',		['as'=>'list.posts' , 'uses'=>'PagesController@listposts']);
						Route::get('/page/{slug}',	['as'=>'view.pages' , 'uses'=>'PagesController@pageView' ]);


						Route::get('/design-settings',		['as'=>'design.settings' , 'uses'=>'PagesController@designSettings']);
					});
					//Pages 
					Route::get('/pages/setting/{id}',['as'=> 'setting.pages' , 'uses' => 'PagesController@pageSetting']);
					Route::get('/pages/custom/{id}',['as'=> 'custom.setting.pages' , 'uses' => 'PagesController@customeCode']);
					Route::post('/pages/save/custom',['as'=> 'custom.save.pages' , 'uses' => 'PagesController@saveCustomeCode']);
				
					

					Route::post('/page/save',	['as'=>'store.page' , 'uses'=>'PagesController@save' ]);
					Route::post('/page/update',	['as'=>'update.page', 'uses'=>'PagesController@update' ]);
					Route::get('/page/delete/{id}',	['as'=>'delete.page', 'uses'=>'PagesController@delete' ]);
					
					//change status with ajax
					Route::post('/pages/status/update',['as'=>'update.status','uses'=>'PagesController@updateStatus']);

					// posts
					Route::get('/posts/{id}',	['as'=>'edit.posts' , 'uses'=>'PagesController@editposts' ]);
					Route::post('/posts/save',	['as'=>'store.posts' , 'uses'=>'PagesController@savePosts' ]);
					Route::post('/posts/update',	['as'=>'update.posts', 'uses'=>'PagesController@updatePosts' ]);
					Route::get('/posts/delete/{id}',	['as'=>'delete.posts', 'uses'=>'PagesController@deletePosts' ]);
					Route::post('/posts/status/update',['as'=>'update.status.posts','uses'=>'PagesController@updateStatusPosts']);
					// Route::get('/posts',['as'=>'posts','uses'=>'PostsController@index']);

					Route::post('/save/categories',['as' => 'category.save' , 'uses' => 'categoriesController@save']);
					Route::get('/delete/categories/{id}',['as' => 'category.delete' , 'uses' => 'categoriesController@delete']);
					Route::get('/edit/categories/{id}',['as' => 'category.edit' , 'uses' => 'categoriesController@getDataById']);
					Route::post('/update/categories/{id}',['as' => 'category.update' , 'uses' => 'categoriesController@updateCategory']);

					Route::get('/media',['as'=>'media','uses'=>'MediaController@index']);
					Route::get('/gallery',['as'=>'gallery','uses'=>'MediaController@gallery']);
					Route::post('/gallery-item',['as'=>'get.gallery.item','uses'=>'MediaController@getGalleryItem']);
					Route::post('/gallery/save',['as'=>'save.gallery.item','uses'=>'MediaController@saveGalleryItem']);


					Route::match(['get','post'],'/media/create',['as'=>'create.media','uses'=>'MediaController@create']);
				});
				Route::group(['prefix'=>'support','namespace' => 'support'],function(){
					Route::get('tickets',	['as'=>'support.tickets','uses'=>'SupportsController@index']);
					Route::get('categories',		['as'=>'support.categories','uses'=>'SupportsController@Categories']);
					Route::get('knowledge-base',	['as'=>'knowledge-base','uses'=>'SupportsController@knowledgeBase']);
					Route::get('faq',	['as'=>'faq','uses'=>'SupportsController@FAndQ']);
					Route::post('create/feedback',['as' => 'create.feedback' , 'uses' => 'FeedbackController@create']);
					Route::get('list/feedback',['as' => 'list.feedback' , 'uses' => 'FeedbackController@index']);
					Route::get('edit/feedback/{id}',['as' => 'edit.feedback' , 'uses' => 'FeedbackController@index']);
					Route::get('delete/feedback/{id}',['as' => 'delete.feedback' , 'uses' => 'FeedbackController@delete']);
					Route::post('update/feedback',['as' => 'update.feedback' , 'uses' => 'FeedbackController@update']);
				});

				Route::group(['namespace'=>'users'],function(){
					//Users
					Route::group(['middleware'=>'role'],function(){
						Route::get('/users', 			['as'=>'list.user','uses'=>'UsersController@index']);
						
					});
					Route::post('/user/store',		['as'=>'store.user','uses'=>'UsersController@store']);
					Route::get('/user/edit/{id}',	['as'=>'edit.user','uses'=>'UsersController@edit']);
					Route::get('/user/{id}',		['as'=>'info.user','uses'=>'UsersController@user_info']);
					Route::get('/delete/{id}',		['as'=>'delete.user','uses'=>'UsersController@deleteUser']);
					Route::get('/changeStatus/{id}',['as'=>'change.user.status','uses'=>'UsersController@changeStatus']);
					Route::post('/user/profile/update/{id}',['as'=>'save.user.profile','uses'=>'UsersController@user_meta']);
					Route::post('/user/update',		['as'=>'update.user','uses'=>'UsersController@update']);
					Route::POST('/change/password',	['as'=>'change.pass' , 'uses' => 'UsersController@changePassword']);
					Route::get('/sidebar/status/{status}',['as'=>'sidebar.active.inactive','uses'=>'UsersController@saveSideBarActiveStats']);
					
				});
			});
		});
    //});

Route::get('404',['as' => 'demo5','uses' => function(){
	return View::make('common.404');
}]);
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




	//forms
	Route::POST('/create/form',				['as'=>'org.create.forms','uses'=>'Admin\FormBuilderController@createForm']);
	Route::get('/forms/list',				['as'=>'org.list.forms','uses'=>'Admin\FormBuilderController@listForm']);
	Route::get('/form/settings/{id}',		['as'=>'org.form.settings','uses'=>'Admin\FormBuilderController@formSettings']);
	Route::post('/form/savemeta/{id}', 		['as'=>'org.save.form.settings','uses'=>'Admin\FormBuilderController@storeSettings']);
	Route::get('/form/delete/{id}',			['as'=>'org.delete.form','uses'=>'Admin\FormBuilderController@deleteForm']);
	Route::get('/form/{form_id}/sections',['as'=>'org.list.sections','uses'=>'Admin\FormBuilderController@sectionsList']);
	Route::post('/create/section/{id}',		['as'=>'org.create.sections','uses'=>'Admin\FormBuilderController@createSection']);
	Route::get('/delete/section/{id}',		['as'=>'org.del.section','uses'=>'Admin\FormBuilderController@deleteSection']);
	Route::get('/forms/create',				['as'=>'org.create.form','uses'=>'Admin\FormBuilderController@index']);
	Route::get('form/preview/{id}',			['as' => 'org.form.preview' , 'uses' => 'Admin\FormBuilderController@previewForm']);

	Route::get('form/custom/{id}',['as' => 'org.form.custom' , 'uses' => 'Admin\FormBuilderController@customForm']);
	Route::post('save/form/custom/{id}',['as' => 'org.save.form.custom' , 'uses' => 'Admin\FormBuilderController@saveCustomForm']);
	Route::post('update/form/custom/{id}',['as' => 'org.update.form.custom' , 'uses' => 'Admin\FormBuilderController@updateCustomForm']);

	Route::get('/form/fields/{form_id}/{section_id}',['as'=>'org.list.field','uses'=>'Admin\FormBuilderController@listFields']);
	Route::get('/delete/field',				['as'=>'org.del.field','uses'=>'Admin\FormBuilderController@deleteField']);
	Route::post('/update/field/{form_id}/{section_id}',['as'=>'org.update.field','uses'=>'Admin\FormBuilderController@updateField']);
	Route::get('/form/row',					['as'=>'org.form.row','uses'=>'Admin\FormBuilderController@addRow']);
	Route::post('/form/store/{form_id}/{section_id}',['as'=>'org.form.store','uses'=>'Admin\FormBuilderController@store']);
	Route::get('/form/field',				['as'=>'org.form.field','uses'=>'Admin\FormBuilderController@formFields']);
	Route::get('/form/edit/{id}',			['as'=>'org.form.edit','uses'=>'Admin\FormBuilderController@editForm']);
	Route::get('/form/update/{id}',			['as'=>'org.form.udpate','uses'=>'Admin\FormBuilderController@updateForm']);
	Route::get('/field/delete/{id}',		['as'=>'org.field.delete','uses'=>'Admin\FormBuilderController@deletefield']);
	Route::post('/form/section/update/{form_id}', ['as'=>'org.section.update','uses'=>'Admin\FormBuilderController@updateSection']);
	Route::post('/form/field/create/{form_id}/{section_id}', ['as'=>'org.create.field','uses'=>'Admin\FormBuilderController@createField']);
	Route::post('/form/update/field/{form_id}/{section_id}/{field_id}',['as'=>'org.update.field','uses'=>'Admin\FormBuilderController@updateField']);
	Route::get('/form/section/delete/{section_id}',['as'=>'org.section.delete','uses'=>'Admin\FormBuilderController@deleteSection']);
	Route::post('/section/sort',		['as'=>'org.section.sort','uses'=>'Admin\FormBuilderController@sectionSort']);
	Route::get('/field/sort/down/{id}',	['as'=>'org.field.down.sort','uses'=>'Admin\FormBuilderController@fieldSortDown']);
	Route::get('/field/sort/up/{id}',	['as'=>'org.field.up.sort','uses'=>'Admin\FormBuilderController@fieldSortUp']);
	
	Route::get('/field/clone/{id}',['as'=>'org.field.clone','uses'=>'Admin\FormBuilderController@fieldClone']);
	Route::get('/section/clone/{id}',['as'=>'org.section.clone','uses'=>'Admin\FormBuilderController@sectionClone']);
	Route::get('/form/clone/{id}',['as'=>'org.form.clone','uses'=>'Admin\FormBuilderController@formClone']);
	Route::post('/section/move',['as'=>'org.section.move','uses'=>'Admin\FormBuilderController@sectionMove']);
	Route::post('/field/move/{field_id}',['as'=>'org.field.move','uses'=>'Admin\FormBuilderController@fieldMove']);
	Route::post('/section',['as'=>'org.get.section','uses'=>'Admin\FormBuilderController@listSections']);


//custom maps
	Route::get('/custom-maps/{type?}', 		['as'=>'org.custom.maps','uses'=>'Admin\CustomMapsController@index']);
	Route::post('/custom-map/save',			['as'=>'org.save.custom.map','uses'=>'Admin\CustomMapsController@saveMap']);
	Route::get('/custom-map/delete/{id}',	['as'=>'org.delete.custom.map','uses'=>'Admin\CustomMapsController@DeleteUserMap']);
	Route::get('/custom-map/edit/{id}',		['as'=>'org.getData.custom.map','uses'=>'Admin\CustomMapsController@getDataById']);
	Route::post('/custom-map/update/{id}',	['as'=>'org.update.custom.map','uses'=>'Admin\CustomMapsController@updateMap']);
	Route::get('/custom-map/view/{id}',		['as'=>'org.view.map','uses'=>'Admin\CustomMapsController@viewmap']);

	Route::get('/survey/{token}',			['as'=>'embed.survey','uses'=>'Organization\survey\SurveyController@embededSurvey']);

	/***************************************** Public Route for Share Data ******************************************/

	Route::get('/public/custom-maps/{map_id}/{theme?}/{data?}',['as'=>'public.map','uses'=>'Admin\CustomMapsController@publicMaps']);
	
	Route::group(['middleware' => 'page.auth'],function(){
		Route::match(['post','get'],'page/view/{id}',['as' => 'page.view' , 'uses' => 'Organization\cms\PagesController@viewPageById']);
		Route::match(['post','get'],'page/{slug}',['as' => 'page.slug' , 'uses' => 'Organization\cms\PagesController@viewPage']);
	});
