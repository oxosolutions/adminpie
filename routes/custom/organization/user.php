<?php	
	/* List User */
	Route::get('/users', 						['as'=>'list.user',					'uses'=>'UsersController@index']);

	/* Create User */
	Route::get('/user/create', 					['as'=>'create.user',				'uses'=>'UsersController@createUser']);
	Route::post('/user/store',					['as'=>'store.user',				'uses'=>'UsersController@store']);

	/* view User */
	Route::get('user/view/{id?}',				['as'=>'user.view',					'uses'=>'UsersController@userView']);
	
	/* edit User */
	Route::get('/user/edit/{id?}',				['as'=>'user.details',				'uses'=>'UsersController@userDetails']);
	Route::post('/user/update/{id}',			['as'=>'update.userDetails',		'uses'=>'UsersController@updateUserDetails']);
	
	/* Change Password User */
	Route::get('/user/change-password/{id}',	['as'=>'changepass.user',			'uses'=>'UsersController@changePass']);
	Route::POST('/change/password',				['as'=>'change.pass' , 				'uses'=>'UsersController@changePassword']);
	
	/* Delete User */
	Route::get('/delete/{id}',					['as'=>'delete.user',				'uses'=>'UsersController@deleteUser']);
	
	/* change status of User */
	Route::get('/changeStatus/{id}',			['as'=>'change.user.status',		'uses'=>'UsersController@changeStatus']);



	Route::post('role_permisson_save',		['as'=>'save.role_permisson', 'uses'=>'UserRoleController@role_permisson_save']);
	
	// Route::get('/users/edit/{id}',			['as'=>'edit.user','uses'=>'UsersController@edit']);
	// Route::post('/user/update',				['as'=>'update.user','uses'=>'UsersController@update']);
	// Route::get('/sidebar/status/{status}',	['as'=>'sidebar.active.inactive','uses'=>'UsersController@saveSideBarActiveStats']);
	// 
?>