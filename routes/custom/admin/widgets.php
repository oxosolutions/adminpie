<?php
    
    Route::get('widgets/{id?}', ['as'=>'index.widget' , 'uses'=>'WidgetController@index']);
    Route::get('widget/delete/{id}', ['as'=>'delete.widget' , 'uses'=>'WidgetController@delete']);
    Route::match(['get', 'post'],'widget/create', ['as'=>'create.widget' , 'uses'=>'WidgetController@create']);
    Route::match(['get', 'post'],'widget/edit/{id?}', ['as'=>'edit.widget' , 'uses'=>'WidgetController@edit']);
    Route::post('widget/status/update', ['as'=>'status.widget' , 'uses'=>'WidgetController@update_widget_status']);
    Route::post('sort/widget' , ['as' => 'sort.widget' , 'uses' => 'WidgetController@sort']);
    Route::get('sort/down/{id}' , ['as' => 'sort.down' , 'uses' => 'WidgetController@sortWidgetDown']);
    Route::get('sort/up/{id}' , ['as' => 'sort.up' , 'uses' => 'WidgetController@sortWidgetUp']);

?>