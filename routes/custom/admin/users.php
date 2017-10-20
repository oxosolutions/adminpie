<?php
	/* Lst user*/
	Route::get('/', 							['as'=>'admin.list.users',         	'uses' => 'users\UsersController@index']);
	
	/* create user*/
	Route::get('/add/user',						['as'=>'admin.add.user',         	'uses' => 'users\UsersController@addUser']);
	Route::POST('/create/user',					['as'=>'admin.create.user',         'uses' => 'users\UsersController@createUser']);
	
	/* Edit user*/
	Route::get('/user/{id}',					['as'=>'admin.user.get',         	'uses' => 'users\UsersController@getUserById']);
	Route::POST('/user/edit/{id}',				['as'=>'admin.user.edit',         	'uses' => 'users\UsersController@editUser']);
	
	/* delete user*/
	Route::get('/delete/user/{id}',				['as'=>'delete.admin.user',         'uses' => 'users\UsersController@deleteUser']);
	
	/* change password */
	Route::get('/change-password/{id}',			['as'=>'admin.changepass.user',     'uses' => 'users\UsersController@changePass']);
	Route::POST('/change/password',				['as'=>'admin.change.pass',         'uses' => 'users\UsersController@changePassword']);


	
	// Route::get('/list', 			['as'=>'list.users','uses'=>'users\UsersController@list_user']);

?>