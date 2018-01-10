<?php
    Route::get('/document/delete/{id}', ['as'=>'delete.document','uses'=>'document\DocumentController@deleteDocument']);
    Route::post('/document/send',   ['as'=>'document.send','uses'=>'document\DocumentController@sendDocument']);
    Route::get('document/edit/{id}',    ['as'=>'edit.document','uses'=>'document\DocumentController@editDocument']);
    Route::get('document/create-template', ['as'=>'create.document.template' , 'uses'=>'document\DocumentController@createTemplates']);
    Route::get('document/edit-template/{id}',   ['as'=>'edit.document.template' , 'uses'=>'document\DocumentController@getInfoTemplates']);
    Route::POST('email/update-template',    ['as'=>'update.template' , 'uses'=>'email\EmailController@updateTemplates']);
    Route::POST('document/update-template', ['as'=>'update.documant.template' , 'uses'=>'document\DocumentController@updateTemplates']);
    Route::get('document/layout/delete/{id}', ['as'=>'document.layout.delete' , 'uses'=>'document\DocumentController@deleteLayout']);
    Route::get('document/document-layout/{id}', ['as'=>'document.layout' , 'uses'=>'document\DocumentController@getInfolayout']);
    Route::get('document/layout/preview/{id}',  ['as'=>'document.layout.view' , 'uses'=>'document\DocumentController@layoutPreview']);
    Route::get('document/template/preview/{id}',    ['as'=>'document.template.view' , 'uses'=>'document\DocumentController@TemplatePreview']);
    Route::POST('document/update-layout',   ['as'=>'update.document.layout' , 'uses'=>'document\DocumentController@updatelayout']);
    Route::get('document/create-layouts',   ['as'=>'create.document.layouts' , 'uses'=>'document\DocumentController@createLayouts']);
    Route::post('document/layout/save',             ['as'=>'save.document.layout' , 'uses'=>'document\DocumentController@saveLayout']);
    Route::post('document/template/save',           ['as'=>'save.document.template' , 'uses'=>'document\DocumentController@saveTemplate']);
    Route::get('documents', ['as'=>'documents' , 'uses'=>'document\DocumentController@index']);
    Route::get('documents/create', ['as'=>'create.documents' , 'uses'=>'document\DocumentController@createDocument']);
    Route::post('documents/update', ['as'=>'update.documents' , 'uses'=>'document\DocumentController@updateDocument']);
    Route::post('documents/save', ['as'=>'save.documents' , 'uses'=>'document\DocumentController@saveDocument']);
    Route::get('documents/preview/{id}', ['as'=>'view.document' , 'uses'=>'document\DocumentController@viewDocument']);

    Route::get('document/templates', ['as'=>'document.templates' , 'uses'=>'document\DocumentController@templates']);
    Route::get('document/layouts', ['as'=>'document.layouts' , 'uses'=>'document\DocumentController@layouts']);
    Route::get('document/download/{id}', ['as'=>'document.download' , 'uses'=>'document\DocumentController@documentDownload']);
    
    Route::get('document/assign/{id}', ['as'=>'document.assign' , 'uses'=>'document\DocumentController@documentAssign']);


?>