@extends('layouts.main')
@section('content')

@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Import Employees',
	'add_new' => '+ Add Employee',

	
); 
@endphp

@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')


{!! Form::open(['route'=>'import.employee.post' , 'class'=> 'form-horizontal','method' => 'post','files'=>true])!!}

		<div class="row no-margin-bottom">
			{!! FormGenerator::GenerateForm('import_employees_form') !!}
		</div>
	@if(Session::get('errors'))
		{{dump(Session::get('errors'))}}
	@endif
{!!Form::close()!!}
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection