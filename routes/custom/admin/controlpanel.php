<?php
    
    Route::get('control-panel/testing',      ['as'=>'testing.control', 'uses'=>'ControlPanelController@testing']);
    Route::match(['get','post'],'control-panel/consistency',  ['as'=>'consistency.control', 'uses'=>'ControlPanelController@consistency']);
    Route::post('route/test',                ['as'=>'route.test','uses'=>'ControlPanelController@runRouteTest']);
?>