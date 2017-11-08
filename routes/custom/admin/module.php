<?php
	
	Route::get('/module/create',['as'=>'create.module' , 'uses'=>'ModuleController@create']);
	Route::post('/module/save',['as'=>'save.module' , 'uses'=>'ModuleController@save']);
	Route::match(['get','post'],'/module/edit/{id?}',['as'=>'edit.module' , 'uses'=>'ModuleController@edit']);
	Route::post('/module/update/{id}',['as'=>'update.module' , 'uses'=>'ModuleController@update']);
	Route::get('/module/delete/{id}',['as'=>'delete.module' , 'uses'=>'ModuleController@delete']);
	Route::get('/module/style/{id}',['as'=>'style.module' , 'uses'=>'ModuleController@style']);
	Route::post('/module/style/save',['as'=>'save.style.module' , 'uses'=>'ModuleController@saveStyle']);
	Route::post('/submodule/style/save',['as'=>'save.style.subModule' , 'uses'=>'ModuleController@saveStyleModule']);
	Route::get('/submodule/{id}',['as'=>'get.submodule' , 'uses'=>'ModuleController@getSubmodules']);
	Route::get('/modules/{id?}/{subModule?}',['as'=>'list.module' , 'uses'=>'ModuleController@listModule']);
	Route::get('module/add_route_row',['as'=>'route_row.module' , 'uses'=>'ModuleController@add_route_row']);
	Route::get('module/route/delete/{id}',['as'=>'delete.route' , 'uses'=>'ModuleController@delete_route']);
	Route::get('/module/status/update/{id?}',['as'=>'status.module' , 'uses'=>'ModuleController@update_module_status']);
	Route::get('/singlemodule/{id?}',['as'=>'get.single.module','uses'=>'ModuleController@getSingleModule']);
	Route::get('/single/route/permission/{id?}',['as'=>'get.single.route.permission','uses'=>'ModuleController@getSingleRoutePermission']);

	//according to new design 
	Route::post('/save/module',['as'=>'module.save' , 'uses'=>'ModuleController@saveModule']);
	Route::post('/save/submodule',['as'=>'sub.module.save' , 'uses'=>'ModuleController@SubModuleSave']);
	Route::get('/delete/module/{id}',['as'=>'module.delete' , 'uses'=>'ModuleController@deleteModule']);
	Route::get('/delete/delModule/{id}',['as'=>'subModule.delete' , 'uses'=>'ModuleController@deletesubModule']);
	Route::get('/status/submodule/{id}',['as'=>'status.change.submodule' , 'uses'=>'ModuleController@changeStatusSubModule']);
	Route::POST('/edit/subModule',['as'=>'edit.subModule' , 'uses'=>'ModuleController@editsubModule']);
	Route::get('/delete/submodule/permission/{id}/{route_name}',['as'=>'delete.subModule.permission' , 'uses'=>'ModuleController@deletesubModulePermission']);
	//sort module
	Route::post('/sort/module',['as'=>'sort.module','uses'=>'ModuleController@sortModule']);
	Route::get('/module/sort/down/{id}',['as'=>'module.sort.down','uses'=>'ModuleController@sortModuleDown']);
	Route::get('/module/sort/up/{id}',['as'=>'module.sort.up','uses'=>'ModuleController@sortModuleUp']);
	Route::get('/submodule/sort/down/{id}/{subModule}',['as'=>'sub.module.sort.down','uses'=>'ModuleController@sortSubModuleDown']);
	Route::get('/submodule/sort/up/{id}/{subModule}',['as'=>'sub.module.sort.up','uses'=>'ModuleController@sortSubModuleUp']);

?>