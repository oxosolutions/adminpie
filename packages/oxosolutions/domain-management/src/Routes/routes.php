<?php
    Route::group(['middleware'=>['web','auth:org'],'namespace'=>'OxoSolutions\DomainManagement\Controllers'], function(){
        Route::match(['get','post'],'domain/search', ['as'=>'domain.search','uses'=>'DomainController@search']);
        Route::post('domain/placeorder',['as'=>'place.order','uses'=>'DomainController@placeOrder']);
        Route::get('domain/myorders',['as'=>'domain.myorders','uses'=>'DomainController@myOrders']);
        Route::get('domain/delete/order',['as'=>'domain.delete.order','uses'=>'DomainController@deleteOrder']);
    });