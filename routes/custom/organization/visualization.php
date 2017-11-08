<?php
	Route::get('/visualizations' , ['as' => 'visualizations' , 'uses' => 'visualization\VisualisationController@index']);
	Route::get('visualization/create/{dataset_id?}' , ['as' => 'create.visual' , 'uses' => 'visualization\VisualisationController@addVisual']);
	
	Route::get('visualization/edit/{id}' , ['as' => 'edit.visualization' , 'uses' => 'visualization\VisualisationController@edit']);
	Route::post('/visualization/save', ['as'=>'save.visualization','uses' => 'visualization\VisualisationController@createVisualization']);
	Route::get('/visualization/delete/{id}',['as'=>'delete.visualization','uses'=>'visualization\VisualisationController@delete_visualization']);
	Route::get('/visualization/setting/{id}',['as'=>'setting.visualization','uses'=>'visualization\VisualisationController@setting_visualization']);
	Route::get('/visualization/collaborate/{id}',['as'=>'collaborate.visualization','uses'=>'visualization\VisualisationController@collaborate_visualization']);
	Route::get('/visualization/customize/{id}',['as'=>'customize.visualization','uses'=>'visualization\VisualisationController@customize_visualization']);
	Route::post('visualization/customize/update/{id}',['as'=>'update.customize.visualization','uses'=>'visualization\VisualisationController@udpateCustomize']);
	Route::get('/visualization/append/{id?}/{length?}',['as'=>'appendData.visualization','uses'=>'visualization\VisualisationController@getDataByAjax']);
	Route::get('/visualization/filter/{id?}',['as'=>'filter.visualization','uses'=>'visualization\VisualisationController@getFilterByAjax']);
	//Route::get('/visualization/edit/{id}',['as'=>'edit.visualization','uses'=>'visualization\VisualisationController@getDataById']);
	Route::post('/visualization/charts/save/{visualization_id?}',['as'=>'save.charts','uses'=>'visualization\VisualisationController@saveCharts']);
	Route::post('/visualization/update/{id}',['as'=>'update.visualization','uses'=>'visualization\VisualisationController@updateVizDetails']);
	Route::match(['get','post'],'/visualization/view/{id}',['as'=>'visualization.view','uses'=>'visualization\VisualisationController@embedVisualization']);
	Route::post('/visualization/settings/save/{id}',['as'=>'visualization.settings.save','uses'=>'visualization\VisualisationController@saveVisualizationSettings']);

	Route::get('/chartsettings/',['as'=>'get.chart.settings','uses'=>'visualization\VisualisationController@getChartSettings']);
	Route::post('visualization/chartssettings/save',['as'=>'save.chart.settings','uses'=>'visualization\VisualisationController@saveChartSettings']);
	Route::get('/visualization/{embed_token}' ,['as'=>'public.view.visualization','uses'=>'visualization\VisualisationController@embedVisualization']);
?>