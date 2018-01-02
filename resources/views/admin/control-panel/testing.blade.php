@extends('admin.layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'no',
	'page_title' => 'Control Panel',
	'add_new' => ''
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
		@include('admin.control-panel._tabs')
		{!! Form::open(['route'=>'route.test','method'=>'post']) !!}
			{!! FormGenerator::GenerateForm('control_panel_testing_form') !!}
		{!! Form::close() !!}
		
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')
		<style type="text/css">
			.select2-container--open .select2-dropdown--above, .select2-container--open .select2-dropdown--below{
				min-height: 200px;
			    max-height: 200px;
			    overflow: auto;
			}
		</style>
	@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection