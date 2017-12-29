@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Edit Product',
	'add_new' => ''
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	 {!!Form::model($model[0], ['route'=>['update.product',$model[0]->id ], 'class'=> 'form-horizontal','method' => 'post'])!!}
		{!!FormGenerator::GenerateForm('create_product_form')!!}
		<input type="hidden" name="user_id" value="{{$model[0]->user_id}}">
	
	{!!Form::close()!!}
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection