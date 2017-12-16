@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Edit Profile',
	'add_new' => ''
); 
@endphp
@include('common.pageheader',$page_title_data)	
@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
	@if(!Session::has('error'))
		@include('organization.user._tabs')

		{!! Form::model($model,['route'=>['update.userDetails',$model['id']]], ['class'=> 'form-horizontal','method' => 'post','id'=>'save-user-details'])!!}

			{!! FormGenerator::GenerateForm('organization_edit_user_form') !!}
			@if($form_slug != null)
	            {!! FormGenerator::GenerateForm($form_slug,[],null,'org') !!}
	   		@endif
			<button type="submit">save</button>
			
		{!!Form::close()!!}
	@endif
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')
	
	@include('common.page_content_secondry_end')
@include('common.pagecontentend')
	

@endsection()