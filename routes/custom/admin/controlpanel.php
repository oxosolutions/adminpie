<?php
    
    Route::get('control-panel/testing',      ['as'=>'testing.control', 'uses'=>'ControlPanelController@testing']);
    Route::match(['get','post'],'control-panel/consistency',  ['as'=>'consistency.control', 'uses'=>'ControlPanelController@consistency']);
    Route::post('route/test',                ['as'=>'route.test','uses'=>'ControlPanelController@runRouteTest']);
    Route::get('remove-specific-directory',  ['as'=>'remove.specific.directory','uses'=>'ControlPanelController@removeSpecificDirectory']);
    Route::post('bulk-delete-directories',   ['as'=>'bulk.delete.directories','uses'=>'ControlPanelController@bulkDeleteDirs']);

    Route::post('bulk-delete-tables',        ['as'=>'bulk.delete.tables','uses'=>'ControlPanelController@bulkDeleteTables']);

    Route::get('drop-specific-table',        ['as'=>'remove.specific.table','uses'=>'ControlPanelController@removeSpecificTable']);

    Route::get('method/testing',             ['as'=>'method.testing','uses'=>'ControlPanelController@methodsTesting']);
    Route::post('/method/serve',             ['as'=>'method.serve','uses'=>'ControlPanelController@methodServe']);
?>