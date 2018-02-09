<?php
    
    Route::post('/survey/filled/save', ['as'=>'filled.survey', 'uses'=>'survey\SurveyController@survey_filled_data_save']);
    Route::post('/survey/filled_view/save', ['as'=>'view.filled.survey', 'uses'=>'survey\SurveyController@survey_filled_by_view']);

    Route::match(['get','post'],'apply/{id?}',['as'=>'apply', 'uses'=>'hrm\ApplicantController@apply']);
    Route::get('jobs',['as'=>'openingss', 'uses'=>'hrm\JobOpeningController@public_view_jobs']);
    Route::get('logout',            ['as'=>'org.logout','uses'=>'Auth\LoginController@logout']);
    Route::get('login-v2/{id?}',    ['as'=>'org.login-v2','uses'=>'Auth\LoginController@showLoginFormv2']);
    Route::post('login',            ['as'=>'org.login.post','uses'=>'Auth\LoginController@login']);
    Route::get('forgot-password',   ['as'=>'forgot.password','uses'=>'Auth\LoginController@forgotpassword']);
    Route::get('forgot-password-v1',['as'=>'forgot.password-v1','uses'=>'Auth\LoginController@forgotpasswordv1']);
    Route::post('forgot',           ['as'=>'forgot','uses'=>'Auth\LoginController@forgotMail']);
    Route::get('reset-password/{token}', ['as'=>'edit.password' ,'uses' => 'Auth\LoginController@changePass']);
    Route::post('update-password', ['as'=>'update.pass' ,'uses' => 'Auth\LoginController@updatePass']);
    Route::get('register', ['as'=>'register' ,'uses' => 'Auth\LoginController@register']);
    Route::get('user/register', ['as'=>'org.register' ,'uses' => 'Auth\LoginController@registerUser']);
    Route::get('userlogin/social/{from}',['as'=>'social.login','uses'=>'Auth\LoginController@socialLogin']);
    Route::get('login/{id?}/{social_token?}',       ['as'=>'org.login','uses'=>'Auth\LoginController@showLoginForm']);

    //Email Template
    Route::get('emails',['as'=>'emails' , 'uses'=>'templates\EmailTemplateController@index']);

    Route::match(['get','post'],'/signup',  ['as'=>'signup.user','uses'=>'Auth\RegisterController@userRegister']);

    Route::get('create/password/{token}',['as'=>'create.password','uses'=>'Auth\RegisterController@createPassword']);
    Route::post('create/password/save', ['as'=>'save.create.password','uses'=>'Auth\RegisterController@saveCreatePassword']);
?>