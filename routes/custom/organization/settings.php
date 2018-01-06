<?php
    Route::get('settings/user' , ['as'=>'setting.user' , 'uses'=>'settings\SettingsController@user_settings']);
    Route::post('/settings/user/save',['as'=>'save.user.settings','uses'=>'settings\SettingsController@save_user_settings']);
    Route::post('organization/settings/save',['as'=>'save.organization.settings','uses'=>'hrm\SettingController@saveOrganizationSettings']);
    Route::post('settings/save', ['as'=>'settings.save','uses'=>'hrm\SettingController@saveSettings']);
    Route::get('settings/hrm' , ['as'=>'setting.attendance' , 'uses'=>'hrm\SettingController@attendanceSetting']);
    Route::get('settings/emp' , ['as'=>'setting.employee' , 'uses' => 'hrm\SettingController@employeeSetting']);
    Route::get('settings/role' , ['as'=>'setting.role' , 'uses' => 'hrm\SettingController@roleSetting']);
    Route::get('settings/leaves' , ['as'=>'setting.leaves' , 'uses' => 'hrm\SettingController@leaveSetting']);
    Route::get('settings/support', ['as'=>'support.settings','uses'=>'hrm\SettingController@supportSettings']);
    Route::post('settings/support/save', ['as'=>'save.support.settings','uses'=>'hrm\SettingController@saveSupportSettings']);

?>