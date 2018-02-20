<?php

Route::get('sliders'            ,['as' => 'list.sliders' , 'uses' => 'SliderController@index']);
Route::get('slider/create'      ,['as' => 'create.slider' , 'uses' => 'SliderController@addSlide']);
Route::post('slider/save'       ,['as' => 'save.slider' , 'uses' => 'SliderController@saveSlider']);
Route::get('slider/delete/{id}' ,['as' => 'delete.slider' , 'uses' => 'SliderController@deleteSlider']);
Route::get('slider/options/{id}',['as' => 'options.slider' , 'uses' => 'SliderController@sliderOptions']);
Route::get('slider/edit/{id}'   ,['as' => 'slider.edit' , 'uses' => 'SliderController@sliderEdit']);
Route::post('slider/update' ,['as' => 'slider.update' , 'uses' => 'SliderController@sliderUpdate']);
Route::post('save/options'      ,['as' => 'options.save' , 'uses' => 'SliderController@saveSliderOptions']);
Route::get('slider/settings/{id}',['as' => 'settings.slider' , 'uses' => 'SliderController@sliderSettings']);
Route::post('save/settings'     ,['as' => 'settings.save' , 'uses' => 'SliderController@saveSliderSettings']);