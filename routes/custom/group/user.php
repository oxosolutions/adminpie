<?php
	/* list user*/
	Route::get('users',					['as'=>'group.users','uses'=>'user\UsersController@index']);
	
	/* create user*/
	Route::get('user/create',			['as'=>'create.group.users','uses'=>'user\UsersController@createUser']);
	Route::post('user/save',			['as'=>'save.group.user','uses'=>'user\UsersController@store']);

	/* delete user*/
	Route::get('user/delete/{id}',		['as'=>'delete.group.user','uses'=>'user\UsersController@deleteUser']);

	/* view user*/
	Route::get('user/view/{id}',		['as'=>'view.group.user','uses'=>'user\UsersController@view']);
	
	/* edit user*/
	ROute::post('user/update/{id}',		['as'=>'update.group.user','uses'=>'user\UsersController@update']);
	Route::get('/user/edit/{id?}',		['as'=>'user.group.details','uses'=>'user\UsersController@userDetails']);
	
	/* change password */
	Route::get('user/changepass/{id}',	['as'=>'pass.group.user','uses'=>'user\UsersController@changePass']);
	Route::POST('/change/password',			['as'=>'change.group.user.pass' , 'uses' => 'user\UsersController@changePassword']);

	/* change Status*/
	Route::get('/changeStatus/{id}',	['as'=>'change.user.group.status','uses'=>'user\UsersController@changeStatus']);

	Route::get('user/edit/{id}',		['as'=>'edit.group.user','uses'=>'user\UsersController@edit']);
	//Ajax Route used in common.js public/js/common.js
	Route::get('user/validate',['as'=>'group.user.validate','uses'=>'user\UsersController@validateUserEmail']);
?>