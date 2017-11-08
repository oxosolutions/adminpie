@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Project Category',
	// 'add_new' => '+ Add Category'
);
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')

@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')


	@if(@$data)
		{!!Form::model(@$data,['route'=>'update.category','method'=>'POST'])!!}
		<input type="hidden" name="id" value="{{$data->id}}">
	@else
		{!!Form::open(['route'=>'save.category'	,'method'=>'POST'])!!}
	@endif	
		{!! FormGenerator::GenerateSection('prosec5') !!}
		<button type="submit">Create</button>
	{!!Form::close()!!}	

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection