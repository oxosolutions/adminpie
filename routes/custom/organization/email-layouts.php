<?php

    Route::get('email',                 ['as'=>'emails' , 'uses'=>'email\EmailController@index']);
    Route::get('email/send',            ['as'=>'email.send' , 'uses'=>'email\EmailController@sendEmail']);
    Route::get('email/edit-template/{id}',  ['as'=>'edit.template' , 'uses'=>'email\EmailController@getInfoTemplates']);
    Route::get('/email/delete/{id}',    ['as'=>'delete.email','uses'=>'email\EmailController@deleteEmail']);
    Route::post('campaign/save',        ['as'=>'save.campaign','uses'=>'email\EmailController@saveCampaign']);
    Route::get('campaign/edit/{id}',    ['as'=>'edit.campaign','uses'=>'email\EmailController@sendEmail']);
    Route::get('email/templates',       ['as'=>'email.templates' , 'uses'=>'email\EmailController@templates']);
    Route::get('email/create-template', ['as'=>'create.template' , 'uses'=>'email\EmailController@createTemplates']);
    Route::get('email/layouts',         ['as'=>'email.layouts' , 'uses'=>'email\EmailController@layouts']);
    Route::get('email/layout/delete/{id}', ['as'=>'email.layout.delete' , 'uses'=>'email\EmailController@deleteLayout']);
    Route::get('email/edit-layout/{id}',    ['as'=>'edit.layout' , 'uses'=>'email\EmailController@getInfolayout']);
    Route::POST('email/update-layout',  ['as'=>'update.layout' , 'uses'=>'email\EmailController@updatelayout']);
    Route::get('email/template/delete/{id}', ['as'=>'templates.delete' , 'uses'=>'document\DocumentController@deleteTemplates']);
    Route::get('email/create-layouts',  ['as'=>'create.layouts' , 'uses'=>'email\EmailController@createLayouts']);
    Route::post('layout/save',          ['as'=>'save.layout' , 'uses'=>'email\EmailController@saveLayout']);
    Route::post('template/save',            ['as'=>'save.template' , 'uses'=>'email\EmailController@saveTemplate']);

?>