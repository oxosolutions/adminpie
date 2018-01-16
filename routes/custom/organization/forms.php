<?php
	
	Route::POST('/create/form',										['as'=>'org.create.forms',				'uses'=>'Admin\FormBuilderController@createForm']);
	Route::get('/forms/list',										['as'=>'org.list.forms',				'uses'=>'Admin\FormBuilderController@listForm']);
	Route::get('/form/settings/{id}',								['as'=>'org.form.settings',				'uses'=>'Admin\FormBuilderController@formSettings']);
	Route::post('/form/savemeta/{id}', 								['as'=>'org.save.form.settings',		'uses'=>'Admin\FormBuilderController@storeSettings']);
	Route::get('/form/delete/{id}',									['as'=>'org.delete.form',				'uses'=>'Admin\FormBuilderController@deleteForm']);
	Route::get('/form/{form_id}/sections',							['as'=>'org.list.sections',				'uses'=>'Admin\FormBuilderController@sectionsList']);
	Route::post('/create/section/{id}',								['as'=>'org.create.sections',			'uses'=>'Admin\FormBuilderController@createSection']);
	Route::get('/delete/section/{id}',								['as'=>'org.del.section',				'uses'=>'Admin\FormBuilderController@deleteSection']);
	Route::get('/forms/create',										['as'=>'org.create.form',				'uses'=>'Admin\FormBuilderController@index']);
	Route::get('form/preview/{id}',									['as' => 'org.form.preview' , 			'uses' => 'Admin\FormBuilderController@previewForm']);
	Route::post('update/form',										['as' => 'org.update.form' , 			'uses' => 'Admin\FormBuilderController@updateFormDetails']);

	Route::get('form/custom/{id}',									['as' => 'org.form.custom' , 			'uses' => 'Admin\FormBuilderController@customForm']);
	Route::post('save/form/custom/{id}',							['as' => 'org.save.form.custom' , 		'uses' => 'Admin\FormBuilderController@saveCustomForm']);
	Route::post('update/form/custom/{id}',							['as' => 'org.update.form.custom' , 	'uses' => 'Admin\FormBuilderController@updateCustomForm']);

	Route::get('/form/fields/{form_id}/{section_id}',				['as'=>'org.list.field',				'uses'=>'Admin\FormBuilderController@listFields']);
	Route::get('/delete/field',										['as'=>'org.del.field',					'uses'=>'Admin\FormBuilderController@deleteField']);
	Route::post('/update/field/{form_id}/{section_id}',				['as'=>'org.update.field',				'uses'=>'Admin\FormBuilderController@updateField']);
	Route::get('/form/row',											['as'=>'org.form.row',					'uses'=>'Admin\FormBuilderController@addRow']);
	Route::post('/form/store/{form_id}/{section_id}',				['as'=>'org.form.store',				'uses'=>'Admin\FormBuilderController@store']);
	Route::get('/form/field',										['as'=>'org.form.field',				'uses'=>'Admin\FormBuilderController@formFields']);
	Route::get('/form/edit/{id}',									['as'=>'org.form.edit',					'uses'=>'Admin\FormBuilderController@editForm']);
	Route::get('/form/update/{id}',									['as'=>'org.form.udpate',				'uses'=>'Admin\FormBuilderController@updateForm']);
	Route::get('/field/delete/{id}',								['as'=>'org.field.delete',				'uses'=>'Admin\FormBuilderController@deletefield']);
	Route::post('/form/section/update/{form_id}',					['as'=>'org.section.update',			'uses'=>'Admin\FormBuilderController@updateSection']);
	Route::post('/form/field/create/{form_id}/{section_id}', 		['as'=>'org.create.field',				'uses'=>'Admin\FormBuilderController@createField']);
	Route::post('/form/update/field/{form_id}/{section_id}/{field_id}',['as'=>'org.update.field',			'uses'=>'Admin\FormBuilderController@updateField']);
	Route::get('/form/section/delete/{section_id}',					['as'=>'org.section.delete',			'uses'=>'Admin\FormBuilderController@deleteSection']);
	Route::post('/section/sort',									['as'=>'org.section.sort',				'uses'=>'Admin\FormBuilderController@sectionSort']);
	Route::get('/field/sort/down/{id}',								['as'=>'org.field.down.sort',			'uses'=>'Admin\FormBuilderController@fieldSortDown']);
	Route::get('/field/sort/up/{id}',								['as'=>'org.field.up.sort',				'uses'=>'Admin\FormBuilderController@fieldSortUp']);
	
	Route::get('/field/clone/{id}',									['as'=>'org.field.clone',				'uses'=>'Admin\FormBuilderController@fieldClone']);
	Route::get('/section/clone/{id}',								['as'=>'org.section.clone',				'uses'=>'Admin\FormBuilderController@sectionClone']);
	Route::get('/form/clone/{id}',									['as'=>'org.form.clone',				'uses'=>'Admin\FormBuilderController@formClone']);
	Route::post('/section/move',									['as'=>'org.section.move',				'uses'=>'Admin\FormBuilderController@sectionMove']);
	Route::post('/field/move/{field_id}',							['as'=>'org.field.move',				'uses'=>'Admin\FormBuilderController@fieldMove']);
	Route::post('/section',											['as'=>'org.get.section',				'uses'=>'Admin\FormBuilderController@listSections']);

	Route::get('/field/sort' , 										['as' => 'sort.field' , 				'uses' => 'Admin\FormBuilderController@sortField']);
    Route::get('/form/result/{id}',                                 ['as'=>'org.raw.data','uses'=>'Admin\FormBuilderController@rawData']);
?>