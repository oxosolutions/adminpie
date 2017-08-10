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
	<div class="row ">
		{{-- {!!Form::file('import_employee',null,['class'=>'no-margin-bottom aione-field','placeholder'=>'Choose File','style'=>'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px'])!!} --}}

		 <div class="file-field input-field">
			<div class="">
			<span>Choose file to import</span>
				<input type="file">
				{!!Form::file('import_employee',null)!!}
			</div>
			<div class="file-path-wrapper">
				{!!Form::text('import_employee',null,['class'=>'file-path validate'])!!}
			</div>
	    </div>
	</div>
	@if(Session::get('errors'))
		{{dump(Session::get('errors'))}}
	@endif
	<button type="submit" class="btn blue">Import</button>
{!!Form::close()!!}
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection