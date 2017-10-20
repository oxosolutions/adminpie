@extends('group.layouts.main')
@section('content')

@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Users',
	'add_new' => '+ Add Organization',
	'route' => 'create.grouporganization'
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
 @include('group.organization._tabs')
 	{!!Form::open(['route'=>['add.user.to.organization',request()->route('id')]])!!}
 		{!! FormGenerator::GenerateForm('assign_group_users') !!}
	{!!Form::close()!!}
@include('common.list.datalist')
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')

@endsection
