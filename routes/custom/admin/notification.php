<?php

    Route::get('notifications', ['as'=>'notifications' , 'uses'=>'ActivityTemplateController@notificationList']);
    Route::match(['get','post'], 'notification/template', ['as'=>'notification.template' , 'uses'=>'ActivityTemplateController@create_notification']);

?>