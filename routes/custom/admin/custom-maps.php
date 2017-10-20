<?php
	
	Route::get('/maps/{type?}', 	['as'=>'custom.maps','uses'=>'CustomMapsController@index']);
	Route::get('/maps/g', 			['as'=>'custom.maps.global','uses'=>'CustomMapsController@index']);
	Route::get('/maps/u', 			['as'=>'custom.maps.user','uses'=>'CustomMapsController@index']);
	Route::post('/map/save',		['as'=>'save.custom.map','uses'=>'CustomMapsController@saveMap']);
	Route::get('/map/delete/{id}',	['as'=>'delete.custom.map','uses'=>'CustomMapsController@DeleteGlobalMap']);
	Route::get('/map/edit/{id}',	['as'=>'getData.custom.map','uses'=>'CustomMapsController@getDataById']);
	Route::post('/map/update/{id}',	['as'=>'update.custom.map','uses'=>'CustomMapsController@updateMap']);
	Route::get('/map/view/{id}',	['as'=>'view.map','uses'=>'CustomMapsController@viewMap']);
	Route::get('/map/add',	['as'=>'add.map','uses'=>'CustomMapsController@addMap']);

?>