@extends('admin.layouts.main')
@section('content')
{{-- page header is not working here  --}}

@php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'yes',
    'show_navigation' => 'yes',
    'page_title' => 'Add Map',
    'add_new' => 'All Maps',
    'route' => 'custom.maps'
); 
@endphp
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	@if(!Auth::guard('admin')->check())
        {!!Form::open(['route'=>'org.save.custom.map'])!!}
    @else
        {!!Form::open(['route'=>'save.custom.map'])!!}
    @endif
    	{!! FormGenerator::GenerateForm('custommaps') !!}
       
	{!! Form::close() !!}
	
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

@include('common.page_content_secondry_end')
@include('common.pagecontentend')

@endsection