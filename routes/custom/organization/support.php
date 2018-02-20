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
    Route::post('assign/ticket/{ticket_id}',['as'=>'assign.ticket','uses'=>'SupportsController@assignTicket']);
    Route::post('post/comment/{ticket_id}',['as'=>'post.ticket','uses'=>'SupportsController@postComment']);


    //Support and Tickets
    Route::get('tickets',   ['as'=>'support.tickets','uses'=>'SupportsController@index']);
    Route::get('categories',        ['as'=>'support.categories','uses'=>'SupportsController@Categories']);
    Route::get('knowledge-base',    ['as'=>'knowledge-base','uses'=>'SupportsController@knowledgeBase']);
    Route::get('faq',   ['as'=>'faq','uses'=>'SupportsController@FAndQ']);
    Route::post('create/feedback',['as' => 'create.feedback' , 'uses' => 'FeedbackController@create']);
    Route::get('feedbacks',['as' => 'list.feedback' , 'uses' => 'FeedbackController@listFeedbacks']);
    Route::get('feedback/create',['as' => 'add.feedback' , 'uses' => 'FeedbackController@createFeedback']);
    Route::get('edit/feedback/{id}',['as' => 'edit.feedback' , 'uses' => 'FeedbackController@editFeedback']);
    Route::get('delete/feedback/{id}',['as' => 'delete.feedback' , 'uses' => 'FeedbackController@delete']);
    Route::post('update/feedback',['as' => 'update.feedback' , 'uses' => 'FeedbackController@update']);
?>