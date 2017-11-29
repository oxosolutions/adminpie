<?php
	
	Route::get('page/view/{id}',['as' => 'page.view.byid' , 'uses' => 'PagesController@viewPageById']);
	Route::get('/page/edit/{id}',	['as'=>'edit.pages' , 'uses'=>'PagesController@edit' ]);
	Route::get('/pages',		['as'=>'list.pages' , 'uses'=>'PagesController@listPage' ]);
	Route::post('/save/page/setting',		['as'=>'save.page.settings' , 'uses'=>'PagesController@savePageSetting' ]);
    Route::match(['get','post'],'/genearte/html', ['as'=>'generate.html','uses'=>'PagesController@exportHTML']);

	//Pages 
	Route::get('/pages/setting/{id}',['as'=> 'setting.pages' , 'uses' => 'PagesController@pageSetting']);
	Route::get('/pages/custom/{id}',['as'=> 'custom.setting.pages' , 'uses' => 'PagesController@customeCode']);
	Route::post('/pages/save/custom',['as'=> 'custom.save.pages' , 'uses' => 'PagesController@saveCustomeCode']);

	Route::post('/page/save',	['as'=>'store.page' , 'uses'=>'PagesController@save' ]);
	Route::post('/page/update',	['as'=>'update.page', 'uses'=>'PagesController@update' ]);
	Route::get('/page/delete/{id}',	['as'=>'delete.page', 'uses'=>'PagesController@delete' ]);
	
	//change status with ajax
	Route::post('/pages/status/update',['as'=>'update.status','uses'=>'PagesController@updateStatus']);


?>