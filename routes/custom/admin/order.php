<?php
    
    Route::match(['get','post'],'orders',['as'=>'list.admin.orders','uses'=>'OrderController@index']);
    Route::get('order/delete/{id}',['as'=>'delete.admin.order','uses'=>'OrderController@delete']);

?>