@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Form',
	'add_new' => '+ Add Widget'
	); 
@endphp

@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	{{-- {{Form::open(['route' => 'account.discussion' , 'method' => 'post'])}}
		{!! FormGenerator::GenerateForm('aione_form_fields_test',['type'=>'inset']) !!}
	{!! Form::close()!!} --}}
	<div class="row">
	<div class="aione-card col l12">
		<div class="aione-row"> 
			{!! FormGenerator::GenerateForm('aione_form_fields_test',[]) !!}
		</div>
	</div>
	<div class="aione-card col l12">
		<div class="aione-row"> 
			{{-- 
			{!! FormGenerator::GenerateForm('test_form',[]) !!}
			--}}
		</div>
	</div>
	</div>
	
	
	{{--
	{!! FormGenerator::GenerateForm('form_setting_form',[]) !!}
	 {!! FormGenerator::GenerateSection('addempsec1') !!} --}}

	@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection