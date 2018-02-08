<?php
    
    Route::get('tasks',         		['as'=>'project.tasks','uses'=>'project\TasksController@index']);
    Route::get('task/{id}',         	['as'=>'view.tasks','uses'=>'project\TasksController@viewTask']);
    Route::post('task/status/update',	['as'=>'task.status.update','uses'=>'project\TasksController@changeStatus']);
    Route::post('task/create', 			['as'=>'create.tasks','uses'=>'project\TasksController@create']);
    Route::post('task/delete', 			['as'=>'delete.tasks','uses'=>'project\TasksController@deleteTasks']);
    Route::get('task/edit/{id}',		['as'=>'edit.tasks','uses'=>'project\TasksController@editTask']);
    Route::post('task/update/{id}', 	['as'=>'update.tasks','uses'=>'project\TasksController@updateTask']);
    Route::post('task/priority/filter',	['as'=>'filterPriority.tasks','uses'=>'project\TasksController@filterPriority']);
    Route::get('task/attachment/remove/{id}/{index}',['as'=>'remove.task.attachment','uses'=>'project\TasksController@removeAttachment']);
    Route::post('task/attachment/upload/{id}',['as'=>'upload.task.attachment','uses'=>'project\TasksController@uploadAttachment']);

?>