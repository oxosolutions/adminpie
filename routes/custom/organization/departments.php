<?php

Route::post('/department/save',     ['as' => 'store.department' , 'uses' => 'DepartmentsController@save']);
Route::get('/department/update',    ['as' => 'update.department' , 'uses' => 'DepartmentsController@update']);
Route::post('/department/edit', ['as' => 'edit.department' , 'uses' => 'DepartmentsController@editDepartment']);
Route::get('/department/delete/{id?}',  ['as' => 'delete.department' , 'uses' => 'DepartmentsController@delete']);