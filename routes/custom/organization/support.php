<?php
	Route::get('tickets/active',	['as'=>'active.tickets','uses'=>'SupportsController@activeTickets']);
	Route::get('tickets/completed',	['as'=>'completed.tickets','uses'=>'SupportsController@completedTickets']);
	Route::get('tickets/settings',	['as'=>'settings.tickets','uses'=>'SupportsController@ticketSettings']);
	Route::get('ticket/add',		['as'=>'add.ticket','uses'=>'SupportsController@addTicket']);
	Route::get('ticket/{id}',		['as'=>'view.ticket','uses'=>'SupportsController@viewTicket']);

?>