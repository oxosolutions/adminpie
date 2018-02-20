<?php
    Route::get('/maps/{type?}',         ['as'=>'org.custom.maps','uses'=>'Admin\CustomMapsController@index']);
    Route::post('/map/save',            ['as'=>'org.save.custom.map','uses'=>'Admin\CustomMapsController@saveMap']);
    Route::get('/map/delete/{id}',      ['as'=>'org.delete.custom.map','uses'=>'Admin\CustomMapsController@DeleteUserMap']);
    Route::get('/map/edit/{id}',        ['as'=>'org.getData.custom.map','uses'=>'Admin\CustomMapsController@getDataById']);
    Route::post('/map/update/{id}',     ['as'=>'org.update.custom.map','uses'=>'Admin\CustomMapsController@updateMap']);
    Route::get('/map/views/{id}',       ['as'=>'org.global.view.map','uses'=>'Admin\CustomMapsController@viewMapUsers']);
    Route::get('/map/view/{id}',        ['as'=>'org.view.map','uses'=>'Admin\CustomMapsController@viewUserMap']);
    Route::post('/map/export',          ['as'=>'org.export.map','uses'=>'CustomMapsController@processExcelFile']);
?>