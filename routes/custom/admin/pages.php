<?php
	
    Route::get('create/page',   ['as'=> 'create.pages' , 'uses' => 'PagesController@create']);
    Route::post('/store/pages', ['as'=> 'store.pages' , 'uses' => 'PagesController@store']);
    Route::get('pages',         ['as'=> 'admin.pages' , 'uses' => 'PagesController@listPages']);


	Route::match(['post','get'],'page/view/{id}',['as' => 'admin.page.view' , 'uses' => 'PagesController@viewPageById']);
	Route::match(['post','get'],'pages/{slug}',['as' => 'admin.page.slug' , 'uses' => 'PagesController@viewPage']);

	Route::get('/page/edit/{id}',	['as'=>'admin.edit.pages' , 'uses'=>'PagesController@edit' ]);
	Route::get('/pages',			['as'=>'admin.list.pages' , 'uses'=>'PagesController@index' ]);
	Route::post('/page/save',		['as'=>'admin.store.page' , 'uses'=>'PagesController@save' ]);
	Route::post('/page/update',		['as'=>'admin.update.page', 'uses'=>'PagesController@update' ]);
	Route::get('/page/delete/{id}',	['as'=>'admin.delete.page', 'uses'=>'PagesController@delete' ]);

	Route::get('/page/setting/{id}',	['as'=>'admin.setting.pages' , 'uses' => 'PagesController@pageSetting']);
	Route::post('/save/page/setting',	['as'=>'admin.save.page.settings' , 'uses'=>'PagesController@savePageSetting' ]);
	Route::get('/page/custom/{id}',	['as'=>'admin.custom.setting' , 'uses' => 'PagesController@customeCode']);
	Route::post('/page/save/custom',	['as'=>'admin.custom.save.pages' , 'uses' => 'PagesController@saveCustomeCode']);
	Route::get('/page/delete/{id}',		['as'=>'admin.delete.page', 'uses'=>'PagesController@delete' ]);
	Route::post('page/status/update',	['as'=>'admin.update.status','uses'=>'PagesController@updateStatus']);


?>