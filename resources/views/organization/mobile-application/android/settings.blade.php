@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Android Application Settings',
	'add_new' => 'Download',
	'route' => 'download.android',
); 
	
  
@endphp	

@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	@include('organization.mobile-application.android._tabs')
	{!!Form::model(@$model,['route'=>'settings.update','files'=>true])!!}
		{!! FormGenerator::GenerateForm('android_application_setting_form') !!}
	{!!Form::close()!!}
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
	
@include('common.page_content_secondry_end')
@include('common.pagecontentend')

@endsection
