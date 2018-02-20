<?php

Route::get('/media',['as'=>'media','uses'=>'MediaController@index']);
Route::get('/gallery',['as'=>'gallery','uses'=>'MediaController@gallery']);
Route::post('/gallery-item',['as'=>'get.gallery.item','uses'=>'MediaController@getGalleryItem']);
Route::post('/gallery/save',['as'=>'save.gallery.item','uses'=>'MediaController@saveGalleryItem']);
Route::post('/update/media/info',['as'=>'media.info.update','uses'=>'MediaController@updateGalleryInfo']);
Route::match(['get','post'],'/media/create',['as'=>'create.media','uses'=>'MediaController@create']);