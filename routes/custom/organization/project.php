<?php
//Project
	Route::group(['middleware'=>'role'],function(){
		Route::get('projects',['as'=>'list.project','uses'=>'project\ProjectController@listProject']);
	});
	Route::get('/project/create',		['as'=>'create.project',				'uses'=>'project\ProjectController@create']);
	Route::get('/project/categories',	['as'=>'categories.project',			'uses'=>'project\ProjectController@categories']);
	Route::get('/project/categories/create',['as'=>'categories.create',			'uses'=>'project\ProjectController@createCategories']);
	Route::get('/project/categories/edit/{id}',['as'=>'categories.edit',		'uses'=>'project\ProjectController@editCategories']);
	Route::post('category/save',		['as'=>'save.category',					'uses'=>'project\ProjectController@saveCategory']);
	Route::post('category/update',		['as'=>'update.category',				'uses'=>'project\ProjectController@updateCategory']);
	Route::get('project/category/delete/{id}',['as'=>'delete.category',			'uses'=>'project\ProjectController@deleteCategories']);
	Route::get('project/edit-info/{id}',['as'=>'add_project_info.project' ,		'uses'=>'project\ProjectController@add_project_info']);
	Route::post('project/save-info',	['as'=>'save.project_meta' , 			'uses'=>'project\ProjectController@save_project_meta']);
	Route::get('project/view/{id}',		['as'=>'view.project',					'uses'=>'project\ProjectController@view']);
	Route::get('project/delete/{id}',	['as'=>'delete.project',				'uses'=>'project\ProjectController@delete']);
	Route::post('project/add-client',	['as'=>'add_client.project',			'uses'=>'project\ProjectController@add_client']);



// save teams in project
	Route::POST('update/team/{id}', 		['as' => 'update.team' , 			'uses'=>'project\ProjectController@updateTeam']);
	
	Route::post('project/save',				['as'=>'save.project',				'uses'=>'project\ProjectController@save']);
	Route::post('project/update/{id?}',		['as'=>'update.project',			'uses'=>'project\ProjectController@update']);
	Route::get('project/details/{id}',		['as'=>'details.project',			'uses'=>'project\ProjectController@details']);
	Route::get('project/credentials/{id}',	['as'=>'credentials.project',		'uses'=>'project\ProjectController@credentials']);
	Route::get('project/activities/{id}',	['as'=>'activities.project',		'uses'=>'project\ProjectController@activities']);
	Route::get('project/calender/{id}',		['as'=>'calender.project',			'uses'=>'project\ProjectController@calender']);

//Documenttion
	Route::get('project/documentation/{id}',['as'=>'documentation.project',		'uses'=>'project\ProjectController@documentation']);


//attachment
	Route::get('project/attachments/{id}',	['as'=>'attachment.project',		'uses'=>'project\ProjectController@attachments']);
	Route::POST('upload/project/attachment',['as'=>'upload.attachment.project',	'uses'=>'project\ProjectController@saveAttachment']);
	Route::post('view/attachment',			['as' => 'view.attachment' , 		'uses'=>'project\ProjectController@getAttachment']);
	Route::get('delete/attachment/{id}'	,	['as' => 'delete.attachment' , 		'uses'=>'project\ProjectController@deleteAttachment']);


//credientals
	Route::post('save/credientals',				['as' => 'credientals.save' , 	'uses'=>'project\ProjectController@saveCredientals']);
	Route::get('delete/crediental/{id}',		['as' => 'delete.crediental' , 	'uses'=>'project\ProjectController@deleteCredentials']);
	Route::get('project/crediental/edit/{id}',	['as' => 'details.crediental' ,	'uses'=>'project\ProjectController@editCrediental']);
	Route::POST('update/crediental',			['as' => 'update.crediental' , 	'uses'=>'project\ProjectController@updateCredientals']);






//Team

	Route::get('teams/{id?}',		['as'=>'list.team' , 		'uses'=>'ManageTeamController@listTeam']);
	
	Route::get('team/create',		['as'=>'create.team' , 		'uses'=>'ManageTeamController@create']);
	Route::post('team/save',		['as'=>'save.team' , 		'uses'=>'ManageTeamController@save']);
	
	Route::get('team/{id}',			['as'=>'info.team' , 		'uses'=>'ManageTeamController@info']);
	Route::get('info/teams/{id?}',	['as'=>'editinfo.team' , 	'uses'=>'ManageTeamController@getTeamById']);
	Route::post('team_info/save',	['as'=>'save.team_info' , 	'uses'=>'ManageTeamController@save_info']);
	Route::post('edit/team',		['as'=>'edit.team',			'uses'=>'ManageTeamController@editTeam']);
	
	Route::get('delete/team/{id}',	['as'=>'delete.team',		'uses'=>'ManageTeamController@deleteTeam']);


//Tasks
	Route::post('/account/tasks/status/update',['as'=>'task.status.update','uses'=>'account\TasksController@changeStatus']);
	Route::post('/account/tasks/create',	['as'=>'create.tasks','uses'=>'account\TasksController@create']);
	Route::post('/account/tasks/delete',	['as'=>'delete.tasks','uses'=>'account\TasksController@deleteTasks']);
	Route::get('/account/tasks/edit/{id}',['as'=>'edit.task','uses'=>'account\TasksController@editTask']);
	Route::post('/account/tasks/update',	['as'=>'update.tasks','uses'=>'account\TasksController@updateTask']);
	Route::post('/account/tasks/priority/filter',['as'=>'filterPriority.tasks','uses'=>'account\TasksController@filterPriority']);
	

	Route::post('project/tasks/status/update',['as'=>'task.status.update','uses'=>'account\TasksController@changeStatus']);
	Route::get('project/tasks',			['as'=>'project.tasks','uses'=>'account\TasksController@index']);
	Route::post('project/tasks/create',	['as'=>'create.tasks','uses'=>'account\TasksController@create']);
	Route::post('project/tasks/delete',	['as'=>'delete.tasks','uses'=>'account\TasksController@deleteTasks']);
	Route::get('project/tasks/edit/{id}',['as'=>'edit.tasks','uses'=>'account\TasksController@editTask']);
	Route::post('project/tasks/update',	['as'=>'update.tasks','uses'=>'account\TasksController@updateTask']);
	Route::post('project/tasks/priority/filter',['as'=>'filterPriority.tasks','uses'=>'account\TasksController@filterPriority']);


?>