<?php

Route::get('employees',                 ['as'=> 'list.employee' , 'uses' => 'EmployeeController@index']);
Route::get('employee/export',           ['as'=> 'export.employee','uses'=>'EmployeeController@export']);
Route::get('employee/import',           ['as'=> 'import.employee','uses'=>'EmployeeController@import']);
Route::post('employee/import',          ['as'=> 'import.employee.post','uses'=>'EmployeeController@importEmployee']);
Route::get('leave-categories',          ['as'=> 'leave.categories' , 'uses' =>'LeaveCategoryController@index']);
Route::get('leaves/{id?}',              ['as'=> 'leaves' , 'uses' =>'LeavesController@index']);



// Route::get('leave-categories',           ['as'=> 'leave.categories' , 'uses' =>'LeaveCategoryController@index']);
// Route::get('/attendance',                ['as'=> 'list.attendance' , 'uses' => 'AttendanceController@hrm_attendance_view']);

Route::get('/holidays/{id?}',           ['as'=> 'list.holidays' , 'uses' => 'HolidayController@listHoliday']);

Route::post('/attendance/import',       ['as'=> 'upload.attendance' , 'uses' => 'AttendanceController@attendance_import']);
Route::post('employee/update',          ['as' => 'update.employee' , 'uses' => 'EmployeeController@update']);
Route::get('employee/delete/{id}',      ['as' => 'delete.employee' , 'uses' => 'EmployeeController@delete']);
Route::get('/designations/{id?}',       ['as' => 'designations' , 'uses' => 'DesignationsController@index']);
Route::get('/departments/{id?}',        ['as' => 'departments' , 'uses' => 'DepartmentsController@index']);
Route::get('shifts/{id?}',              ['as' => 'shifts' , 'uses' =>'ShiftsController@index']);
Route::get('openings',                  ['as' => 'list.opening', 'uses'=>'JobOpeningController@index']);