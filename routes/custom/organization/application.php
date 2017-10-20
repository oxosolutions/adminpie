<?php
	
	Route::group(['prefix'=> 'application','namespace' => 'Application'],function(){
	   Route::get('/android/download/',	['as'=>'download.android','uses'=>'ApplicationController@download']);	
	   Route::get('/android/settings/',	['as'=>'settings.android','uses'=>'ApplicationController@settings']);	
	   Route::post('/android/settings/update',['as'=>'settings.update','uses'=>'ApplicationController@updateSettings']);
	   Route::get('/android/faqs/',	['as'=>'FAQs.android','uses'=>'ApplicationController@FAQ']);	
	   Route::get('/android/changelog/',	['as'=>'changelog.android','uses'=>'ApplicationController@changeLog']);	
	   Route::get('/android/documentation/',	['as'=>'documentation.android','uses'=>'ApplicationController@documentation']);	
	});

?>