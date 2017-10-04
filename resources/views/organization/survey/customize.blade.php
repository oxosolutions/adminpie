@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Customize',
    'add_new' => '+ Add Media'
); 
$id = "";

@endphp 

@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
    @include('organization.survey._tabs')
      {!! FormGenerator::GenerateForm('custom_code') !!}
      
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection