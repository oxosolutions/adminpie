<?php
	Route::get('/view',['as'=>'profile.view','uses'=>'ProfileController@view']);
	Route::get('/edit',['as'=>'profile.edit','uses'=>'ProfileController@edit']);
	Route::get('/changepassword',['as'=>'profile.changepassword','uses'=>'ProfileController@changePassword']);
	Route::post('/updateUserProfile/{id}',['as'=>'update.profiles','uses'=>'ProfileController@updateProfile']);
	Route::post('profile/updatePassword',['as'=>'update.profile.password','uses'=>'ProfileController@updatePassword']);
	Route::get('profile-picture' , ['as' => 'profile-picture.details' , 'uses' => 'ProfileController@getCurrentProfilePicture']);
	
	// Route::patch('/profile/update/{id}',['as'=>'update.profile','uses'=>'AccountController@update']);
?>