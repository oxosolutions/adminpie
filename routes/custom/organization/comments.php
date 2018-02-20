<?php

    Route::post('comment/post',['as'=>'post.comment','uses'=>'comments\CommentsController@postComment']);
