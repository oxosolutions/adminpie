@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Change Password',
	'add_new' => ''
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('organization.my-profile._profile_tabs')
{{-- {!! Form::open(['route' => 'change.password' ,'type' => 'POST'])!!} --}}
{!! Form::open(['route' => 'update.profile.password' ,'type' => 'POST'])!!}

		@if(Session::has('success-password'))
			{{ Session::get('success-password') }}
		@endif
		@if(Session::has('error-password'))
			{{ Session::get('error-password') }}
		@endif
		
		{!! FormGenerator::GenerateForm('profile_change_password_form') !!}

{!! Form::close() !!}
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection