@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Edit Contact',
	'add_new' => ''
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	 <?php echo Form::model($model, ['route'=>['contact.update',$model->id ], 'class'=> 'form-horizontal','method' => 'post']); ?>
		{!!FormGenerator::GenerateSection('consec1',['type' => 'inset'])!!}
		<button type="submit" class="btn blue " style="float: right">Submit form <i class="icon-arrow-right14 position-right"></i></button>
	{!!Form::close()!!}
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection()