@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Add Employee',
	'add_new' => 'List Employees',
	'route' => 'list.employee'

); 
@endphp
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
	
	{!! Form::open(['route'=>'store.employee' , 'class'=> 'form-horizontal','method' => 'post'])!!}
		{!! FormGenerator::GenerateForm('addnewemploye') !!}
	{!!Form::close()!!}
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')

	@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection