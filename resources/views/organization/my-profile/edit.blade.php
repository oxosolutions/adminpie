@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' =>  __('organization/profile.profile_edit_page_title_text'),
	'add_new' => ''
); 
@endphp
@include('common.pageheader',$page_title_data)	
@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
		@include('organization.my-profile._profile_tabs')
		{{-- @php
			$data = json_decode($model->user_type);
			$model['user_type'] = array_map('intval',$data);
		@endphp --}}
		
	{!! Form::model($model,['route'=>['update.profile',$model['id']]], ['class'=> 'form-horizontal','method' => 'post','id'=>'save-user-details'])!!}

			
			{!! FormGenerator::GenerateForm('user_registration_form') !!}
			@if($additional_form != null)
				{!! FormGenerator::GenerateForm($additional_form,[],null,'org') !!}
			@endif
			<button type="submit">save</button>
	{!!Form::close()!!}
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')
	@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection()