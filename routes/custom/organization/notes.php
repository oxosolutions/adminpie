<?php
    Route::get('account/notes/list',    ['as'=>'account.notes.list.ajax','uses'=>'project\NotesController@listNotes']);
    Route::post('account/notes/save',   ['as'=>'save.account.notes','uses'=>'project\NotesController@createNotes']);
    Route::post('account/notes/edit',   ['as'=>'edit.account.notes','uses'=>'project\NotesController@edit']);
    Route::post('account/notes/delete', ['as'=>'delete.account.notes','uses'=>'project\NotesController@delete']);
    Route::get('account/notes/{id?}',   ['as'=>'account.notes','uses'=>'project\NotesController@index']);

?>