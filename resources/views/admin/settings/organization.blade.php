@extends('admin.layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Settings',
	'add_new' => '+ Apply leave'
); 
@endphp
@include('common.pageheader',$page_title_data)

@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('admin.settings._tabs')
	{!!Form::model($model,['route'=>'save.organizationSettings','method'=>'POST'])!!}
		<input type="hidden" name="key" value="primary_organization">
		{!! FormGenerator::GenerateForm('organization_setting_form') !!}
		<button type="submit" class="">Save</button>
	{!!Form::close()!!}
	@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection