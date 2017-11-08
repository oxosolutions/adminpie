<?php
	
	Route::POST('/create',												['as'=>'create.forms','uses'=>'FormBuilderController@createForm']);
	Route::get('/forms',												['as'=>'list.forms','uses'=>'FormBuilderController@listForm']);
	Route::get('/form/settings/{id}',									['as'=>'form.settings','uses'=>'FormBuilderController@formSettings']);
	Route::post('/form/savemeta/{is}', 									['as'=>'save.form.settings','uses'=>'FormBuilderController@storeSettings']);
	Route::get('form/custom/{id}',										['as'=>'form.custom' , 'uses' => 'FormBuilderController@customForm']);
	Route::get('form/preview/{id}',										['as'=>'form.preview' , 'uses' => 'FormBuilderController@previewForm']);
	Route::post('save/form/custom/{id}',								['as'=>'save.form.custom' , 'uses' => 'FormBuilderController@saveCustomForm']);
	Route::post('update/form/custom/{id}',								['as'=>'update.form.custom' , 'uses' => 'FormBuilderController@updateCustomForm']);
	Route::get('/forms/delete/{id}',									['as'=>'delete.form','uses'=>'FormBuilderController@deleteForm']);
	Route::get('/form/{form_id}/sections',								['as'=>'list.sections','uses'=>'FormBuilderController@sectionsList']);
	Route::post('/sections/create/{id}',								['as'=>'create.sections','uses'=>'FormBuilderController@createSection']);
	Route::get('/delete/sections/{id}',									['as'=>'del.section','uses'=>'FormBuilderController@deleteSection']);
	Route::get('/form/create',											['as'=>'create.form','uses'=>'FormBuilderController@index']);
	Route::get('/forms/fields/{form_id}/{section_id}',					['as'=>'list.field','uses'=>'FormBuilderController@listFields']);
	Route::get('/delete/field',											['as'=>'del.field','uses'=>'FormBuilderController@deleteField']);
	Route::post('/update/field/{form_id}/{section_id}',					['as'=>'update.field','uses'=>'FormBuilderController@updateField']);
	Route::get('/form/row',												['as'=>'form.row','uses'=>'FormBuilderController@addRow']);
	Route::post('/form/store/{form_id}/{section_id}',					['as'=>'form.store','uses'=>'FormBuilderController@store']);
	Route::get('/form/field',											['as'=>'form.field','uses'=>'FormBuilderController@formFields']);
	Route::get('/form/edit/{id}',										['as'=>'form.edit','uses'=>'FormBuilderController@editForm']);
	Route::get('/form/update/{id}',										['as'=>'form.udpate','uses'=>'FormBuilderController@updateForm']);
	Route::get('/field/delete/{id}',									['as'=>'field.delete','uses'=>'FormBuilderController@deletefield']);
	Route::post('/form/section/update/{form_id}',						['as'=>'section.update','uses'=>'FormBuilderController@updateSection']);
	Route::post('/form/field/create/{form_id}/{section_id}', 			['as'=>'create.field','uses'=>'FormBuilderController@createField']);
	Route::post('/form/update/field/{form_id}/{section_id}/{field_id}',	['as'=>'update.field','uses'=>'FormBuilderController@updateField']);
	Route::get('/form/section/delete/{section_id}',						['as'=>'section.delete','uses'=>'FormBuilderController@deleteSection']);
	Route::post('/section/sort',										['as'=>'section.sort','uses'=>'FormBuilderController@sectionSort']);
	Route::get('/field/sort/down/{id}',									['as'=>'field.down.sort','uses'=>'FormBuilderController@fieldSortDown']);
	Route::get('/field/sort/up/{id}',									['as'=>'field.up.sort','uses'=>'FormBuilderController@fieldSortUp']);
	Route::get('/field/clone/{id}',										['as'=>'field.clone','uses'=>'FormBuilderController@fieldClone']);
	Route::get('/section/clone/{id}',									['as'=>'section.clone','uses'=>'FormBuilderController@sectionClone']);
	Route::post('/section/move',										['as'=>'section.move','uses'=>'FormBuilderController@sectionMove']);
	Route::post('/field/move/{field_id}',								['as'=>'field.move','uses'=>'FormBuilderController@fieldMove']);
	Route::post('/section',												['as'=>'get.section','uses'=>'FormBuilderController@listSections']);
	Route::get('/form/clone/{id}',										['as'=>'form.clone','uses'=>'FormBuilderController@formClone']);

	Route::get('/field/sort' , 											['as' => 'sort.field' , 'uses' => 'FormBuilderController@sortField'])
?>	