<?php
	Route::get('tickets/active',	['as'=>'active.tickets','uses'=>'SupportsController@activeTickets']);
	Route::get('tickets/completed',	['as'=>'completed.tickets','uses'=>'SupportsController@completedTickets']);
	Route::get('tickets/settings',	['as'=>'settings.tickets','uses'=>'SupportsController@ticketSettings']);
	Route::get('ticket/add',		['as'=>'add.ticket','uses'=>'SupportsController@create']);
    Route::get('ticket/edit/{id}',  ['as'=>'edit.ticket','uses'=>'SupportsController@edit']);
    Route::get('ticket/delete/{id}',['as'=>'delete.ticket','uses'=>'SupportsController@delete'] );
    Route::post('ticket/update/{id}',['as'=>'update.ticket','uses'=>'SupportsController@update']);
	Route::get('ticket/{id}',		['as'=>'view.ticket','uses'=>'SupportsController@viewTicket']);
    Route::post('ticket/save',      ['as'=>'save.ticket','uses'=>'SupportsController@save'] );
?>