<?php

    Route::get('cms/menus',     ['as'=>'list.menus' , 'uses'=>'cms\MenuController@index']);
    Route::post('cms/menus/create',['as'=>'create.menus' , 'uses'=>'cms\MenuController@create']);
    Route::get('cms/menus/edit/{id}',['as'=>'edit.menu' , 'uses'=>'cms\MenuController@edit']);
    Route::get('cms/menus/delete/{id}',['as'=>'delete.menu' , 'uses'=>'cms\MenuController@delete']);
    Route::post('cms/menus/item/create',['as'=>'create.menu.item' , 'uses'=>'cms\MenuController@createMenuItem']);
    Route::match(['get','post'],'cms/menus/item/update',['as'=>'update.menu.item' , 'uses'=>'cms\MenuController@updateMenuItem']);

    Route::get('cms/menus/item/delete/{id}',['as'=>'delete.menu.items' , 'uses'=>'cms\MenuController@DeleteMenuItem']);
    Route::post('cms/menus/item/get',['as'=>'get.menu.item' , 'uses'=>'cms\MenuController@getMenuItem']);
    Route::get('cms/menus/item',['as'=>'menu.item' , 'uses'=>'cms\MenuController@getMenuItems']);
    Route::get('change/order',['as'=>'change.order' , 'uses'=>'cms\MenuController@changeOrder']);

?>