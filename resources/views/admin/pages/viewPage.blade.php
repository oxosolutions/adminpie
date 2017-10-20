@extends('admin.layouts.main')
@section('content')
	@php
	$page_title_data = array(
	    'show_page_title' => 'yes',
	    'show_add_new_button' => 'no',
	    'show_navigation' => 'yes',
	    'page_title' => 'View Page'
	); 
	@endphp
	@include('common.pageheader',$page_title_data) 
	@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
	{!! $pageData->content !!}
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')
	@include('common.page_content_secondry_end')
	@include('common.pagecontentend')
@endsection()
