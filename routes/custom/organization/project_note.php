<?php

Route::get('project/notes/list',    ['as'=>'list.notes','uses'=>'project\NotesController@listNotes']);
Route::get('project/notes/{id}',    ['as'=>'notes.project','uses'=>'project\NotesController@index']);
Route::post('project/notes/save',   ['as'=>'save.notes','uses'=>'project\NotesController@createNotes']);
Route::post('project/notes/edit',   ['as'=>'edit.notes','uses'=>'project\NotesController@edit']);
Route::post('project/notes/delete', ['as'=>'delete.account.notes','uses'=>'project\NotesController@delete']);