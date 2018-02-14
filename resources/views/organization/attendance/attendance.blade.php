@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
		'show_page_title' => 'yes',
		'show_add_new_button' => 'no',
		'show_navigation' => 'yes',
		'page_title' => 'Attendance',
		'add_new' => 'List attendance',
		'route' => 'lists.attendance'
	); 
@endphp
@include('common.pageheader',$page_title_data) 
{{-- @if(Session::has('success'))
<p class="alert">{{ Session::get('success') }}</p>
@endif
@if(Session::has('error'))
<p class="alert">{{ Session::get('error') }}</p>
@endif --}}
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	@include('organization.attendance._tabs')

	<div id="hrm_attendance" class="hrm-attendance">
		<input id="token" type="hidden" name="_token" value="{{csrf_token()}}" >
		<input id="years" type="hidden" value="{{$data['year']}}" >
		<input id="months" type="hidden"  value="{{$data['month']}}" >
	
		<div id="main" class="main-container"></div>
	</div>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')

@endsection