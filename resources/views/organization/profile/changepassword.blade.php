@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Change Password',
	'add_new' => ''
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('organization.profile._profile_tabs')
{{-- {!! Form::open(['route' => 'change.password' ,'type' => 'POST'])!!} --}}
{!! Form::open(['route' => 'change.password.admin' ,'type' => 'POST'])!!}
	<div class="row" >
		@if(Session::has('success-password'))
			{{ Session::get('success-password') }}
		@endif
		@if(Session::has('error-password'))
			{{ Session::get('error-password') }}
		@endif
		<div class="row" >
			{{-- <div class="row" style="padding:10px 14px">
				<div class="col l3" style="line-height: 30px">
					Current Password
				</div>
				<div class="col l9">
					<input type="password" name="old_password" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px">
				</div>
			</div>
			<div class="row pv-10" style="padding-left:14px;padding-right: 14px ">
				<div class="col l3" style="line-height: 30px">
					New Password
				</div>
				<div class="col l9">
					<input type="password" name="new_password" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px">
				</div>
			</div>
			<div class="row pv-10" style="padding-left:14px;padding-right: 14px ">
				<div class="col l3" style="line-height: 30px">
					Confirm Password
				</div>
				<div class="col l9">
					<input type="password" name="confirm_password" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px">
				</div>
			</div>
		</div> --}}
		{!! FormGenerator::GenerateForm('profile_change_password_form') !!}
		{{-- <div class="row right-align" style="padding-right:15px" >
			<a href="" class="btn blue">Save</a>
		</div> --}}

	</div>
{!! Form::close() !!}
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection