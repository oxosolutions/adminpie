@extends('admin.layouts.main')
@section('content')
@php

	$page_title_data = array(
	    'show_page_title' => 'yes',
	    'show_add_new_button' => 'no',
	    'show_navigation' => 'yes',
	    'page_title' => 'Edit User',
	    'add_new' => '+ Add Designation'
	);

@endphp
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	
		@php
			$roleModel = 'App\\Model\\Admin\\GlobalUsersRole';
			$role = $roleModel::where('id',$plugins["model"]->role_id)->pluck('id','role_name');
			$plugins['model']->role_id = $role;
		@endphp
		{{-- {{dd($plugins['model'])}} --}}
		{!! Form::model($plugins['model'],['route' => ['admin.user.edit' , $plugins["model"]->id ] , 'type' =>'post']) !!}

			{!! FormGenerator::GenerateForm('admin_edit_user_form') !!}
			<div class="row">
				<div class="col l12">
					<button class="" type="submit">Update</button>
				</div>
			</div>
		{!! Form::close() !!}
	
	<style type="text/css">
		.aione-setting-field:focus{
		border-bottom: 1px solid #a8a8a8 !important;
		box-shadow: none !important;
	}
	.input-field{
		margin-top: 0px
	}
	</style>


@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection