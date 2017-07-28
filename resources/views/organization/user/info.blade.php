@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Edit Users',
	'add_new' => ''
); 
@endphp
@include('common.pageheader',$page_title_data)	
@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
		{{-- @php
			$data = json_decode($model->user_type);
			$model['user_type'] = array_map('intval',$data);
		@endphp --}}
	{!! Form::model($model,['route'=>['save.user.profile',$model->id]], ['class'=> 'form-horizontal','method' => 'post','id'=>'save-user-details'])!!}
			@include ('organization.user._form_employee')
	{!!Form::close()!!}
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')
	
	@include('common.page_content_secondry_end')
@include('common.pagecontentend')
	

@endsection()