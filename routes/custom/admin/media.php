<?php

	Route::get('/media/list',				['as'=>'admin.media','uses'=>'MediaController@index']);
	Route::get('/gallery/list',				['as'=>'admin.gallery','uses'=>'MediaController@gallery']);
	Route::get('gallery-items',				['as'=>'admin.get.gallery.item','uses'=>'MediaController@getGalleryItem']);
	Route::post('/gallery/item/save',		['as'=>'admin.save.gallery.item','uses'=>'MediaController@saveGalleryItem']);
	Route::post('/update/media/infos',		['as'=>'admin.media.info.update','uses'=>'MediaController@updateGalleryInfo']);
	Route::match(['get','post'],'/create/media',['as'=>'admin.create.media','uses'=>'MediaController@create']);

?>