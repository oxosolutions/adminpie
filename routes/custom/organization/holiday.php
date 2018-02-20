<?php
Route::get('/holidays/{id?}',       ['as' => 'list.holidays' , 'uses' => 'HolidayController@listHoliday']);
Route::post('/holiday_save',        ['as' => 'store.holiday' , 'uses' => 'HolidayController@save']);
Route::get('/holidays/edit/{id}',   ['as' => 'edit.holiday' , 'uses' => 'HolidayController@edit']);
Route::post('/holiday/update',      ['as' => 'update.holiday' , 'uses' => 'HolidayController@update']);
Route::post('/holiday/edit',        ['as' => 'edit.holiday' , 'uses' => 'HolidayController@editHoliday']);
Route::get('/holiday/delete/{id}',  ['as' => 'delete.holiday' , 'uses' => 'HolidayController@deleteHoliday']);