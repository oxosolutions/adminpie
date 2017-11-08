<?php
	Route::post('delete/dashboards/widget',		['as'=>'delete.widget.dashboard','uses'=>'DashboardController@deleteWidget']);
	Route::get('delete/dashboards/{slug}',		['as'=>'delete.dashboard','uses'=>'DashboardController@deleteDashboard']);
	Route::post('edit/dashboards',				['as'=>'edit.dashboard','uses'=>'DashboardController@EditDashboard']);
	Route::post('update/dashboards',			['as'=>'update.edit.dashboard','uses'=>'DashboardController@UpdateDashboard']);
	Route::post('sort/dashbaord',				['as'=>'sort.dashboard','uses'=>'DashboardController@sortDashboard']);
	Route::get('dashboard/{id?}',				['as'=>'organization.dashboard','uses'=>'DashboardController@index']);

	Route::post('widget/sort',					['as'=>'widget.sort','uses'=>'DashboardController@widgetSort']);

?>