<?php
    
    Route::get('activities', ['as'=>'activities' , 'uses'=>'ActivityTemplateController@index']);
    Route::match(['get','post'], 'activity/template', ['as'=>'activity.template' , 'uses'=>'ActivityTemplateController@create']);
    Route::match(['get','post'], 'activity/edit/{id?}', ['as'=>'activity.edit' , 'uses'=>'ActivityTemplateController@edit']);
    Route::get('activity/delete/{id?}', ['as'=>'activity.delete' , 'uses'=>'ActivityTemplateController@delete']);

?>