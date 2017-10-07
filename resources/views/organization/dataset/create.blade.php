@extends('layouts.main')
@section('content')

@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Add Dataset',
	'add_new' => 'All Datasets',
	'route' => 'list.dataset'
	); 
@endphp

@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
		{!! Form::open(['route'=>'save.dataset' , 'class'=> 'form-horizontal','method' => 'post'])!!}
			<div class="row no-margin-bottom">
				{!! FormGenerator::GenerateForm('add_dataset_form') !!}
			</div>
		{!!Form::close()!!}	
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')
	@include('common.page_content_secondry_end')
@include('common.pagecontentend')

@endsection