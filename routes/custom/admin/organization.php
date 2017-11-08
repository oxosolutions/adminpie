<?php
	
	Route::get('/organization/create',		['as'=>'create.organization','uses'=>'OrganizationController@create']);
	Route::post('/organization/save',		['as'=>'save.organization','uses'=>'OrganizationController@save']);
	Route::get('/organization/list',		['as'=>'list.organizations','uses'=>'OrganizationController@listOrg']);
	Route::get('/organization/view/{id}',	['as'=>'view.organization','uses'=>'OrganizationController@viewOrg']);
	Route::get('/organization/delete/{id}',	['as'=>'delete.organization','uses'=>'OrganizationController@delete']);
	Route::match(['get','post'],'/organization/edit/{id?}',	['as'=>'edit.organization','uses'=>'OrganizationController@edit']);
	Route::get('/organization/clone/{id}',  ['as'=>'create.organizationClone','uses'=>'OrganizationController@cloneOrganization']);
	Route::get('/organization/auth/{id}' ,['as'=>'auth.organization','uses'=>'OrganizationController@authAttemptOrganization']);
	Route::get('organization/change/status/{id}' , ['as' => 'change.org.status','uses' => 'OrganizationController@changeStatus']);

?>