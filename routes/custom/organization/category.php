<?php

Route::post('/save/categories',['as' => 'category.save' , 'uses' => 'categoriesController@save']);
Route::get('/delete/categories/{id}',['as' => 'category.delete' , 'uses' => 'categoriesController@delete']);
Route::get('/edit/categories/{id}',['as' => 'category.edit' , 'uses' => 'categoriesController@getDataById']);
Route::post('/update/categories/{id}',['as' => 'category.update' , 'uses' => 'categoriesController@updateCategory']);