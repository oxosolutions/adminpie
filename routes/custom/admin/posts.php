<?php
	
	Route::get('/posts',				['as'=>'admin.list.posts' , 'uses'=>'PagesController@listposts']);
	Route::post('/posts/save',			['as'=>'admin.store.posts' , 'uses'=>'PagesController@savePosts' ]);
	Route::get('/posts/delete/{id}',	['as'=>'admin.delete.posts', 'uses'=>'PagesController@deletePosts' ]);
	Route::get('/posts/{id}',			['as'=>'admin.edit.posts' , 'uses'=>'PagesController@editposts' ]);
	Route::post('/posts/update',		['as'=>'admin.update.posts', 'uses'=>'PagesController@updatePosts' ]);
	Route::get('/posts/setting/{id}',	['as'=>'admin.setting.posts' , 'uses' => 'PagesController@pageSetting']);
	Route::get('/posts/custom/{id}',	['as'=>'admin.custom.setting.posts' , 'uses' => 'PagesController@customeCode']);
	Route::post('admin/posts/status/update',['as'=>'admin.update.status.posts','uses'=>'PagesController@updateStatusPosts']);

?>