@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Create Applicant',
	'add_new' => 'List Applicant'
); 

	 
@endphp
@include('common.pageheader',$page_title_data) 
	{!! Form::open(['route'=>'save.applicant', 'class'=> 'form-horizontal','method' => 'post'])!!}
		{!! FormGenerator::GenerateForm('appform')!!}
	{!!Form::close()!!}
@endsection()