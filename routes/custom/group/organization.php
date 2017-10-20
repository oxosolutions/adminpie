<?php
	
	Route::get('group/organization/create',		['as'=>'create.grouporganization','uses'=>'GroupOrganizationController@create']);
	Route::post('/organization/save',			['as'=>'save.grouporganization','uses'=>'GroupOrganizationController@save']);
	Route::get('/organization/create',			['as'=>'create.groupOrganization','uses'=>'GroupOrganizationController@create']);
	Route::post('/organization/save',			['as'=>'save.groupOrganization','uses'=>'GroupOrganizationController@save']);
	Route::get('/organization/list',			['as'=>'list.groupOrganizations','uses'=>'GroupOrganizationController@listOrg']);
	Route::get('/organization/delete/{id}',		['as'=>'delete.groupOrganization','uses'=>'GroupOrganizationController@delete']);
	Route::match(['get','post'],'/organization/edit/{id?}',	['as'=>'edit.groupOrganization','uses'=>'GroupOrganizationController@edit']);
	Route::get('/organization/users/{id}',		['as'=>'users.groupOrganization','uses'=>'GroupOrganizationController@users']);
	Route::get('/organization/clone/{id}',  	['as'=>'create.groupOrganizationClone','uses'=>'GroupOrganizationController@cloneOrganization']);
	Route::get('/organization/auth/{id}' ,		['as'=>'group.auth.organization','uses'=>'GroupOrganizationController@authAttemptOrganization']);
	Route::get('organization/change/status/{id}' , ['as' => 'change.org.status','uses' => 'GroupOrganizationController@changeStatus']);
	Route::post('organization/adduser/{oragnization_id}',['as'=>'add.user.to.organization','uses'=>'GroupOrganizationController@addNewUserToOrganization']);
	Route::get('revoke/user/{user_id}', ['as'=>'revoke.user','uses'=>'GroupOrganizationController@revokeUser']);

?>