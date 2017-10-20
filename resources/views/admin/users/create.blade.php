@extends('admin.layouts.main')
@section('content')
{{-- page header is not working here  --}}
@php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'yes',
    'show_navigation' => 'yes',
    'page_title' => 'Add user',
    'add_new' => 'All Users',
    'route' => 'admin.list.users'
); 
@endphp
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	{!! Form::open(['route' => 'admin.create.user','type' => 'POST']) !!}
    	{!! FormGenerator::GenerateForm('admin_add_user_form') !!}
	{!! Form::close() !!}
	
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

@include('common.page_content_secondry_end')
@include('common.pagecontentend')

@endsection