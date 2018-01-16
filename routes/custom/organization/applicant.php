<?php
    Route::get('applicants',                ['as' => 'list.applicant', 'uses'=>'ApplicantController@index']);
    Route::get('applicant/create',          ['as' => 'create.applicant', 'uses'=>'ApplicantController@createApplicant']);
    Route::get('applications',              ['as' => 'list.applicantions', 'uses'=>'ApplicationController@index']);
    Route::post('applicant/save',           ['as' => 'save.applicant', 'uses'=>'ApplicantController@save']);
    Route::get('applicant/edit/{id}',            ['as' => 'edit.applicant', 'uses'=>'ApplicantController@edit']);
?>