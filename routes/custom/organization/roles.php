<?php

	Route::get('roles', ['as'=>	'list.role', 'uses'=>'users\UserRoleController@listRole']);
	Route::post('role/save',['as'=>'role.store', 'uses'=>'users\UserRoleController@save']);
	Route::match(['get','post'],'role/delete/{id?}',['as'=>'role.delete', 'uses'=>'users\UserRoleController@Delete']);
	Route::get('role/assign/{id}',[/*'middleware'=>'role', */'as'=>'role.assign', 'uses'=>'users\UserRoleController@assign']);

?>