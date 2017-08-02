@extends('admin.layouts.main')
@section('content')
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Edit Email Template',
	'add_new' => '+ Add Department'
); 
@endphp
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
		<div class="row">
			<div class="col l6 pr-7">
				{!! Form::select('language',['EN'=>'EN','FR'=>'FR'],NULL,['class'=>'browser-default','placeholder'=>'select Language'])!!}	
			</div>
			<div class="col l6 pl-7">
				<div class="col s12 m2 l12 aione-field-wrapper">
					 {!!Form::text('slug',null,['class'=>'no-margin-bottom aione-field','placeholder'=>'Enter Slug'])!!}
				</div>
			</div>
			<div class="col l12">
				 
			</div>
		</div>
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')
	@include('common.page_content_secondry_end')
@include('common.pagecontentend')

@endsection