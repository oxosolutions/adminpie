@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Service Categories',
	'add_new' => '+ Add Service Category',
	'route' => 'add.service.category'
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
		@include('common.list.datalist')
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')

{{-- 	{!! Form::open(['route'=>'save.crm.category' , 'class'=> 'form-horizontal','method' => 'post'])!!}
			<div>
			<input type="hidden" name="type" value="service">
				<ul>
					<li><label for="">Category Name</label><input name="name" type="text"></li>
					<li><label for="">Description</label><textarea name="description"  id="" cols="30" rows="10"></textarea></li>
					<li><input type="submit" value="save Category"></li>
				</ul>
			</div>

				
			{!!Form::close()!!} --}}
	
	@include('common.page_content_secondry_end')
@include('common.pagecontentend')

	
@endsection