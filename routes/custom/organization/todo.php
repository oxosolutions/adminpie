<?php
Route::get('/project/todo/list/{id?}',  ['as'=>'list.todo','uses'=>'project\TodoController@listTodo']);
Route::get('project/todo/{id?}',    ['as'=>'todo.project','uses'=>'project\ProjectController@todo']);
Route::post('/project/todo/create', ['as'=>'create.todo','uses'=>'project\TodoController@create']);

Route::POST('/project/todo/edit',   ['as'=>'edit.todo','uses'=>'project\TodoController@edit']);
Route::POST('/project/todo/delete', ['as'=>'delete.todo','uses'=>'project\TodoController@delete']);
Route::POST('/project/todo/filter', ['as'=>'filter.todo','uses'=>'project\TodoController@filterData']); 