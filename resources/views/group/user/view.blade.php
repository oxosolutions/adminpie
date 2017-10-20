@extends('group.layouts.main')
@section('content')

@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'View User',
	'add_new' => '+ Add User'
); 
@endphp
@include('common.pageheader',$page_title_data)		
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('group.user._tabs')
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
	<div class="aione-table">
		<table class="aione-table">
			<tr>
				<td><b>Field</b></td>
				<td><b>Value</b></td>
			</tr>
			@foreach($model->toArray() as $key => $value)
				@if(in_array($key,['name','email','created_at']))
				<tr>
					<td>{{ucfirst(str_replace('_',' ',$key))}}</td>
					<td>{{$value}}</td>
				</tr>
				@endif
			@endforeach
		</table>
	</div>
@include('common.page_content_secondry_end')
@include('common.pagecontentend')


@endsection