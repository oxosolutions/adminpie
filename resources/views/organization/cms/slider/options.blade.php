@extends('layouts.main')
@section('content')

@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Slider Options <span>'.'test'.'</span>' ,
	'add_new' => '+ Add Role'
	); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('organization.cms.slider._tabs')
	@if($optionsData != null)
		{!! Form::model($optionsData,['route' => 'options.save' , 'method' => 'post']) !!}
	@else
		{!! Form::open(['route' => 'options.save' , 'method' => 'post']) !!}
	@endif
		{!! FormGenerator::GenerateForm('cms_slider_form') !!}
		{{-- {!! FormGenerator::GenerateSection('SliderSettings') !!} --}}
		<input type="hidden" name="slider_id" value="{{ request()->route()->parameters()['id'] }}">
		<button type="submit"> Save </button>
	{!! Form::close() !!}
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')

@endsection