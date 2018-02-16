@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Add Contact',
	'add_new' => 'list Contacts',
	'route' => 'contact.list'
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
	{!! Form::open(['route'=>'contact.save' , 'class'=> 'form-horizontal','method' => 'post'])!!}
		{{-- @include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add client','button_title'=>'Save Client','section'=>'consec1']]) --}}
		{!! FormGenerator::GenerateForm('organization_crm_contact_form') !!}
	{!!Form::close()!!}
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')	
	@include('common.page_content_secondry_end')
@include('common.pagecontentend')

	
@endsection