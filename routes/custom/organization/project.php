<?php
//Project
	Route::group(['middleware'=>'role'],function(){
		Route::get('projects',['as'=>'list.project','uses'=>'project\ProjectController@listProject']);
	});

    /*********************************************** By Rahul *******************************************************/

	Route::get('/project/create',		['as'=>'create.project',    'uses'=>'project\ProjectController@create']);
    Route::post('project/save',         ['as'=>'save.project',      'uses'=>'project\ProjectController@save']);
	Route::get('project/details/{id}',  ['as'=>'details.project',   'uses'=>'project\ProjectController@details']);
    Route::get('project/delete/{id}',   ['as'=>'delete.project',    'uses'=>'project\ProjectController@delete']);
    Route::post('project/details/update/{id}',['as'=>'update.project.details','uses'=>'project\ProjectController@updateProjectDetails']);
    Route::post('upload/attachments/{id}',   ['as'=>'upload.project.attachments','uses'=>'project\ProjectController@uploadAttachments']);
    Route::get('delete/attachment/{attachment_index}/{id}',['as'=>'delete.project.attachment','uses'=>'project\ProjectController@deleteProjectAttachment']);
    Route::post('assign/team/{id}',['as'=>'assign.project.team','uses'=>'project\ProjectController@assignTeam']);
    Route::get('remove/project/teams/{project_id}/{index_id}',['as'=>'remove.project.team','uses'=>'project\ProjectController@removeProjectTeams']);
    Route::post('assign/users/{id}',['as'=>'assign.project.user','uses'=>'project\ProjectController@assignUsers']);
    Route::get('remove/assigned/user/{project_id}/{user_index}',['as'=>'remove.assigned.user','uses'=>'project\ProjectController@removeAssignedUsers']);

//Project Tasks
    Route::get('project/tasks/{project_id}',['as'=> 'tasks.project','uses' => 'project\ProjectController@tasks']);

    /****************************************************************************************************************/








    //Project Category
    Route::get('/project/categories',   ['as'=>'categories.project',            'uses'=>'project\ProjectController@categories']);
    Route::get('/project/categories/create',['as'=>'categories.create',         'uses'=>'project\ProjectController@createCategories']);
    Route::get('/project/categories/edit/{id}',['as'=>'categories.edit',        'uses'=>'project\ProjectController@editCategories']);
    Route::post('category/save',        ['as'=>'save.category',                 'uses'=>'project\ProjectController@saveCategory']);
    Route::post('category/update',      ['as'=>'update.category',               'uses'=>'project\ProjectController@updateCategory']);
    Route::get('project/category/delete/{id}',['as'=>'delete.category',         'uses'=>'project\ProjectController@deleteCategories']);



	/*Route::get('project/edit-info/{id}',['as'=>'add_project_info.project' ,		'uses'=>'project\ProjectController@add_project_info']);
	Route::post('project/save-info',	['as'=>'save.project_meta' , 			'uses'=>'project\ProjectController@save_project_meta']);
	Route::get('project/view/{id}',		['as'=>'view.project',					'uses'=>'project\ProjectController@view']);
	
	Route::post('project/add-client',	['as'=>'add_client.project',			'uses'=>'project\ProjectController@add_client']);



// save teams in project
	Route::POST('update/team/{id}', 		['as' => 'update.team' , 			'uses'=>'project\ProjectController@updateTeam']);
	
	
	Route::post('project/update/{id?}',		['as'=>'update.project',			'uses'=>'project\ProjectController@update']);
	
	Route::get('project/credentials/{id}',	['as'=>'credentials.project',		'uses'=>'project\ProjectController@credentials']);
	Route::get('project/activities/{id}',	['as'=>'activities.project',		'uses'=>'project\ProjectController@activities']);
	Route::get('project/calender/{id}',		['as'=>'calender.project',			'uses'=>'project\ProjectController@calender']);

//Documenttion
	Route::get('project/documentation/{id}',['as'=>'documentation.project',		'uses'=>'project\ProjectController@documentation']);


//attachment
	Route::get('project/attachments/{id}',	['as'=>'attachment.project',		'uses'=>'project\ProjectController@attachments']);
	Route::POST('upload/project/attachment',['as'=>'upload.attachment.project',	'uses'=>'project\ProjectController@saveAttachment']);
	Route::post('view/attachment',			['as' => 'view.attachment' , 		'uses'=>'project\ProjectController@getAttachment']);
	Route::get('delete/attachment/{id}'	,	['as' => 'delete.attachment' , 		'uses'=>'project\ProjectController@deleteAttachment']);*/


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


//Tasks For user Account
	Route::post('/account/tasks/status/update',['as'=>'task.status.update','uses'=>'account\TasksController@changeStatus']);
	Route::post('/account/tasks/create',	['as'=>'create.tasks','uses'=>'account\TasksController@create']);
	Route::post('/account/tasks/delete',	['as'=>'delete.tasks','uses'=>'account\TasksController@deleteTasks']);
	Route::get('/account/tasks/edit/{id}',['as'=>'edit.task','uses'=>'account\TasksController@editTask']);
	Route::post('/account/tasks/update',	['as'=>'update.tasks','uses'=>'account\TasksController@updateTask']);
	Route::post('/account/tasks/priority/filter',['as'=>'filterPriority.tasks','uses'=>'account\TasksController@filterPriority']);
	

	


?>