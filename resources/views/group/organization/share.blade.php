@extends('group.layouts.main')
@section('content')
{{-- @if(!empty(Session::get('success')))
	<div class="aione-message success">
		{{Session::get('success')}}
	</div>
@endif

@if(!empty(Session::get('error')))
	<div class="aione-message error">
		{{Session::get('error')}}
	</div>
@endif --}}
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Organizations',
	'add_new' => '+ Add Organization',
	'route' => 'create.grouporganization'
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
 @include('group.organization._tabs')

@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')

@endsection
