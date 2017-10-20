<?php
	
	Route::get('/datasets',['as' => 'list.dataset','uses' => 'DatasetController@listDataset']);
	Route::get('/dataset/import',['as' => 'import.dataset','uses' => 'DatasetController@importDataset']);
	Route::get('/dataset/create',['as' => 'create.dataset','uses' => 'DatasetController@craeteDataset']);
		
	Route::get('/dataset/edit/{id}',['as' => 'edit.dataset','uses' => 'DatasetController@editDataset']);
	Route::match(['get','post'],'/dataset/define/{id}',['as' => 'define.dataset','uses' => 'DatasetController@defineDataset']);
	Route::get('/dataset/filter/{id}',['as' => 'filter.dataset','uses' => 'DatasetController@filterDataset']);
	Route::post('/dataset/subset/{id}',['as' => 'create.dataset.subset','uses' => 'DatasetController@createSubset']);
	Route::get('/dataset/validate/{id}',['as' => 'validate.dataset','uses' => 'DatasetController@validateDataset']);
	Route::post('/dataset/create/rows',['as' => 'create.dataset.rows','uses' => 'DatasetController@createDatasetRows']);
	Route::get('/dataset/visualize/{id}',['as' => 'visualize.dataset','uses' => 'DatasetController@visualizeDataset']);
	Route::get('/dataset/collaborate/{id}',['as' => 'collaborate.dataset','uses' => 'DatasetController@collaborateDataset']);
	Route::get('/dataset/customize/{id}',['as' => 'customize.dataset','uses' => 'DatasetController@customizeDataset']);
	Route::get('/dataset/export/{id}/{type}',['as'=>'export.dataset','uses'=>'DatasetController@exportDataset']);
	Route::get('/dataset/clone/{id}',['as'=>'clone.dataset','uses'=>'DatasetController@creaetClone']);
	Route::get('/dataset/{id}/{action?}/{record_id?}',['as' => 'view.dataset','uses' => 'DatasetController@viewDataset']);
	Route::post('/import/dataset', ['as'=>'upload.dataset','uses'=>'DatasetController@uploadDataset']);
	Route::post('/dataset/save',['as'=>'save.dataset','uses'=>'DatasetController@store']);
	Route::post('/dataset/update/{id}',['as'=>'update.dataset','uses'=>'DatasetController@updateRecords']);
	Route::post('/dataset/create/column/{id}',['as'=>'create.column','uses'=>'DatasetController@createColumn']);
	Route::get('/delete/dataset/{id}',['as'=>'delete.dataset','uses'=>'DatasetController@deleteDataset']);
	Route::post('/update/dataset' , ['as' => 'dataset.update' ,'uses' => 'DatasetController@updateDataset']);
	Route::get('/delete/record/{id?}/{record_id}' , ['as' => 'delete.record' ,'uses' => 'DatasetController@deleteDatasetRecord']);
	Route::get('/history/record/{id?}/{record_id}' , ['as' => 'history.record' ,'uses' => 'DatasetController@ViewHistoryRecord']);
	Route::match(['get','post'],'/datasets/merge' , ['as' => 'merge.dataset' ,'uses' => 'DatasetOperationController@mergeDataset']);
	Route::get('/datasets/duplicate/{id}' , ['as' => 'duplicate.dataset' ,'uses' => 'DatasetOperationController@duplicate']);

?>