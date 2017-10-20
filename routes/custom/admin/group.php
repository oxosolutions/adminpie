<?php
	
	Route::get('/group/create',		['as'=>'create.group','uses'=>'GroupController@create']);
	Route::get('/groups',		['as'=>'list.group','uses'=>'GroupController@index']);
	Route::get('/group/edit/{id}',	['as'=>'edit.group','uses'=>'GroupController@edit']);
	Route::post('/group/save',		['as'=>'save.group','uses'=>'GroupController@store']);
	Route::post('/group/update/{id}',	['as'=>'update.group','uses'=>'GroupController@update']);
	Route::get('/group/delete/{id}' , ['as'=>'delete.group','uses'=>'GroupController@destroy']);

?>