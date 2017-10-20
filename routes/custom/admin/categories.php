<?php
	Route::get('/categories/{id?}',			['as'=>'admin.categories','uses'=>'categoriesController@listdata']);
	Route::post('/save/categories',			['as' => 'admin.category.save' , 'uses' => 'categoriesController@save']);
	Route::get('/delete/categories/{id}',	['as' => 'admin.category.delete' , 'uses' => 'categoriesController@delete']);
	Route::get('/edit/categories/{id}',		['as' => 'admin.category.edit' , 'uses' => 'categoriesController@getDataById']);
	Route::post('/update/categories/{id}',	['as' => 'admin.category.update' , 'uses' => 'categoriesController@updateCategory']);
?>