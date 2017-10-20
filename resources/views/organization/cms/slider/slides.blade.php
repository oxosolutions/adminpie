@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Create Slider' ,
	'add_new' => 'All Sliders',
	'route' => 'list.sliders'
	); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
{{-- @include('organization.cms.slider._tabs') --}}
	{!! Form::open(['route' => 'save.slider' , 'method' => 'post' ,'files' => true]) !!}
		{!! FormGenerator::GenerateForm('create_slider_form') !!}
		<button type="submit"> Save </button>
	{!! Form::close() !!}
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection