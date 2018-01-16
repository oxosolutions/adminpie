<?php
    
    Route::get('products',['as'=>'products.list','uses'=>'ProductsController@index']);
    Route::get('product/create',['as'=>'create.admin.product','uses'=>'ProductsController@create']);
    Route::post('product/save',['as'=>'save.admin.product','uses'=>'ProductsController@save']);
    Route::get('product/edit/{id}',['as'=>'edit.admin.product','uses'=>'ProductsController@edit']);
    Route::get('product/delete/{id}',['as'=>'delete.admin.product','uses'=>'ProductsController@delete']);
    Route::post('product/update/{id}',['as'=>'update.admin.product','uses'=>'ProductsController@update']);
?>