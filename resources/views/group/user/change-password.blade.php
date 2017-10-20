@extends('group.layouts.main')
@section('content')

@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Change Password',
	'add_new' => '+ Add User'
); 
@endphp
@include('common.pageheader',$page_title_data)		
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('group.user._tabs')
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

	{!!Form::open(['route'=>['change.group.user.pass']])!!}
		<input type="hidden" name="user_id" value="{{request()->route()->parameters()['id']}}">
		{!! FormGenerator::GenerateSection('group_user_change_pass') !!}
		<button type="submit">Save</button>
	{!!Form::close()!!}

@include('common.page_content_secondry_end')
@include('common.pagecontentend')


@endsection