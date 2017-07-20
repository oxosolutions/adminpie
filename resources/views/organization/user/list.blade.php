@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Users',
	'add_new' => '+ Add User'
); 
@endphp
@include('common.pageheader',$page_title_data)		
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('common.list.datalist')
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
{!! Form::open(['method' => 'POST','class' => '','route' => 'store.user']) !!}
@include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add new user','button_title'=>'Save User','section'=>'usesec1']])
{!! Form::close() !!}
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection