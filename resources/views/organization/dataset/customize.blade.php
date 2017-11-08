@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Dataset Customize <span>'.get_dataset_title(request()->route()->parameters()['id']).'</span>',
    'add_new' => '+ Add Media'
); 
$id = "";

@endphp 

@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
    @include('organization.dataset._tabs')
		
    	{!! Form::model($model,['route'=>['save.custom.code',request()->route()->id]]) !!}
      		{!! FormGenerator::GenerateForm('custom_code') !!}
      	{!! Form::open() !!}
      
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection