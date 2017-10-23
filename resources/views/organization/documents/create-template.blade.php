@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Create Template',
	'add_new' => 'All Templates',
	'route' => 'document.templates'
); 
@endphp	
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@if(@$model != null || @$model != "")
	{!! Form::model($model ,['route'=>'update.documant.template' , 'class'=> 'form-horizontal','method' => 'post']) !!}
	<input type="hidden" name="id" value="{{request()->route()->parameters()['id']}}">
@else
	{!! Form::open(['route'=>'save.document.template' , 'class'=> 'form-horizontal','method' => 'post']) !!}
@endif
		{!!FormGenerator::GenerateForm('document_create_template')!!}
		<button type="submit" >Save Template</button>
	{!!Form::close()!!}
	@if(Session::has('success-update'))
		<script type="text/javascript">Materialize.toast('updated Successfully' , 4000)</script>
	@endif
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection