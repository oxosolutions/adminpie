@extends('admin.layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Model Associate',
	'add_new' => '+ Apply leave'
); 
@endphp
@include('common.pageheader',$page_title_data)

@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('admin.settings._tabs')
    {!! Form::model($model,['route'=>'save.model.associate']) !!}
    	<div style="min-height:80vh;max-height:80vh;overflow:scroll">
    		{!! FormGenerator::GenerateForm('model_setting',[],$model) !!}
    	</div>
	   	<button type="submit">Save</button>
    {!! Form::close() !!}
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection