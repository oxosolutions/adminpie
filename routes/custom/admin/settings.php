<?php
	Route::get('settings', ['as' => 'list.settings' , 'uses' => 'SettingController@list_setting']);
	Route::get('settings/department', ['as' => 'department.settings' , 'uses' => 'SettingController@departmentSetting']);
	Route::get('settings/model-associate', ['as' => 'model.settings' , 'uses' => 'SettingController@modelSetting']);
	Route::post('/settings/save',['as'=>'save.settings','uses'=>'SettingController@saveSettingMeta']);
	Route::post('/settings/save/organization',['as'=>'save.organizationSettings','uses'=>'SettingController@saveOrganization']);
	Route::get('settings/shifts', ['as' => 'shifts.settings' , 'uses' => 'SettingController@shiftsSetting']);
	Route::get('settings/holidays', ['as' => 'holidays.settings' , 'uses' => 'SettingController@holidaysSetting']);
	Route::get('settings/leave-cat', ['as' => 'leave.settings' , 'uses' => 'SettingController@leaveSetting']);
	Route::get('settings/role', ['as' => 'role.settings' , 'uses' => 'SettingController@roleSetting']);
	Route::get('settings/default/organization', ['as' => 'organization.settings' , 'uses' => 'SettingController@organization']);
	Route::get('settings/remove/logo', ['as' => 'remove.logo' , 'uses' => 'SettingController@removeLogo']);

    Route::post('settings/save-model-associate',['as'=>'save.model.associate','uses'=>'SettingController@saveModelAssociate']);
?>