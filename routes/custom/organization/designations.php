<?php
Route::post('/designation/save',            ['as' => 'store.designation' , 'uses' => 'DesignationsController@save']);
Route::post('/designation/update',          ['as' => 'update.designation' , 'uses' => 'DesignationsController@update']);
Route::post('edit/designation',         ['as' => 'edit.designation','uses'=> 'DesignationsController@editUserDesignation']);
Route::get('delete/designation/{id}',       ['as' => 'delete.designation','uses'=> 'DesignationsController@deleteUserDesignation']);