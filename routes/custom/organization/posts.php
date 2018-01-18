<?php
    
    Route::get('/posts/{id}',   ['as'=>'edit.posts' , 'uses'=>'PagesController@editposts' ]);
    Route::post('/posts/save',  ['as'=>'store.posts' , 'uses'=>'PagesController@savePosts' ]);
    Route::post('/posts/update',    ['as'=>'update.posts', 'uses'=>'PagesController@updatePosts' ]);
    Route::get('/posts/delete/{id}',    ['as'=>'delete.posts', 'uses'=>'PagesController@deletePosts' ]);
    Route::post('/posts/status/update',['as'=>'update.status.posts','uses'=>'PagesController@updateStatusPosts']);
    Route::post('/posts/save/custom-code',['as'=>'custom.save.post','uses'=>'PagesController@saveCustomeCode']);
    Route::get('/posts/setting/{id}',['as'=> 'setting.posts' , 'uses' => 'PagesController@pageSetting']);
    Route::get('/posts/custom/{id}',['as'=> 'custom.setting.posts' , 'uses' => 'PagesController@customeCode']);

?>