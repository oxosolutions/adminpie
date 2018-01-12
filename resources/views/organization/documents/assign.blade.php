@extends('layouts.main')
@section('content')
@php

	$page_title_data = array(
		'show_page_title' => 'yes',
		'show_add_new_button' => 'yes',
		'show_navigation' => 'yes',
		'page_title' => 'Assign Documents',
		'add_new' => 'Assign Document',
		'route' => 'documents'
	);
@endphp	
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
    {!! Form::open(['route'=>['save.assign.document',request()->id]]) !!}
    	{!! FormGenerator::GenerateForm('assign_document_form') !!}
    {!! Form::close() !!}
@include('common.page_content_primary_end')
@include('common.pagecontentend')
@endsection
