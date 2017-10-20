<?php
	
	Route::get('menus',					['as'=>'admin.list.menus' , 'uses'=>'MenuController@index']);
	Route::post('menus/create',			['as'=>'admin.create.menus' , 'uses'=>'MenuController@create']);
	Route::get('menus/edit/{id}',		['as'=>'admin.edit.menu' , 'uses'=>'MenuController@edit']);
	Route::get('menus/delete/{id}',		['as'=>'admin.delete.menu' , 'uses'=>'MenuController@delete']);
	Route::match(['get','post'],'admin/menus/item/update',['as'=>'admin.update.menu.item' , 'uses'=>'MenuController@updateMenuItem']);
	Route::get('admin/menus/item',		['as'=>'admin.menu.item' , 'uses'=>'MenuController@getMenuItems']);
	Route::get('admin/change/order',	['as'=>'admin.change.order' , 'uses'=>'MenuController@changeOrder']);

?>