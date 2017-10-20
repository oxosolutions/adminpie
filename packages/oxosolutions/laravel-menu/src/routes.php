<?php

Route::group(['middleware' => config('menu.middleware')], function () {
	//Route::get('wmenuindex', array('uses'=>'\Harimayco\Menu\Controllers\MenuController@wmenuindex'));
	Route::post('oxosolutions/addcustommenu', array('middleware'=>'web', 'as' => 'haddcustommenu', 'uses'=>'\OxoSolutions\Menu\Controllers\MenuController@addcustommenu'));
	Route::post('oxosolutions/deleteitemmenu', array('middleware'=>'web','as' => 'hdeleteitemmenu', 'uses'=>'\OxoSolutions\Menu\Controllers\MenuController@deleteitemmenu'));
	Route::post('oxosolutions/deletemenug', array('middleware'=>'web','as' => 'hdeletemenug', 'uses'=>'\OxoSolutions\Menu\Controllers\MenuController@deletemenug'));
	Route::post('oxosolutions/createnewmenu', array('middleware'=>'web','as' => 'hcreatenewmenu', 'uses'=>'\OxoSolutions\Menu\Controllers\MenuController@createnewmenu'));
	Route::post('oxosolutions/generatemenucontrol', array('middleware'=>'web','as' => 'hgeneratemenucontrol', 'uses'=>'\OxoSolutions\Menu\Controllers\MenuController@generatemenucontrol'));
	Route::post('oxosolutions/updateitem', array('middleware'=>'web','as' => 'hupdateitem', 'uses'=>'\OxoSolutions\Menu\Controllers\MenuController@updateitem'));
});
