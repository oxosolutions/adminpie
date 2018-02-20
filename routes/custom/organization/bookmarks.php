<?php
Route::get('/bookmarks',    ['as'=>'design.bookmark' , 'uses'=> 'BookmarkController@index']);
Route::get('/bookmarks/create', ['as'=>'design.bookmark' , 'uses'=>function(){
    return view('organization.bookmarks.create');
}]);

Route::post('/bookmark/save',   ['as'=>'save.bookmark' , 'uses'=>'BookmarkController@saveBookmark' ]);
Route::get('/bookmark/edit/{id}',   ['as'=>'edit.bookmark' , 'uses'=>'BookmarkController@editBookmark' ]);
Route::post('/bookmark/delete', ['as'=>'delete.bookmark' , 'uses'=>'BookmarkController@deleteBookmark' ]);
Route::post('/bookmark/update/{id}',    ['as'=>'update.bookmark' , 'uses'=>'BookmarkController@updateBookmark' ]);
Route::post('/add/category',    ['as'=>'create.bookmark.category' , 'uses'=>'BookmarkController@addBookmarkCategories' ]);
Route::get('/delete/category/{id}', ['as'=>'delete.bookmark.category' , 'uses'=>'BookmarkController@delCategory' ]);