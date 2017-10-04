@extends('layouts.main')
@section('content')

@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Dataset:',
	'add_new' => '+ Add Visualization',
	'route' => 'add.visual'
	); 
@endphp
@include('common.pageheader',$page_title_data)
<style type="text/css">
	.aione-list{
		color: #757575
	}
	.aione-list > .aione-item{
		border: 1px solid #e8e8e8;
		margin-bottom: 5px;
		padding: 10px
	}
	.aione-list > .aione-item:first-child{
		font-weight: 600;
	}
	.truncate{
		    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
	}
</style>
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	@include('organization.dataset._tabs')
	<ul class="aione-list">
		<li class="aione-item ar">
			<div class="ac l25">Name of visualization</div>
			<div class="ac l25">Created at</div>
			<div class="ac l25">Description</div>
			<div class="ac l25">Actions</div>
		</li>
		<li class="aione-item ar">
			<div class="ac l25">Demo viz 1</div>
			<div class="ac l25">02-10-2017</div>
			<div class="ac l25 truncate">this is the demo decription sdfjsdjhsdjf sjdfhjsdfjsjdfjhsdjfsjk sdhfsdj</div>
			<div class="ac l25">
				<a href="">Edit</a> |
				<a href="">View</a> |
				<a href="">Share</a>
			</div>
		</li>
		<li class="aione-item ar">
			<div class="ac l25">Demo viz 2</div>
			<div class="ac l25">02-10-2017</div>
			<div class="ac l25 truncate">this is the demo decription</div>
			<div class="ac l25">
				<a href="">Edit</a> |
				<a href="">View</a> |
				<a href="">Share</a>
			</div>
		</li>
		<li class="aione-item ar">
			<div class="ac l25">Demo viz 3</div>
			<div class="ac l25">01-10-2017</div>
			<div class="ac l25 truncate">this is the demo decription</div>
			<div class="ac l25">
				<a href="">Edit</a> |
				<a href="">View</a> |
				<a href="">Share</a>
			</div>
		</li>
		<li class="aione-item ar">
			<div class="ac l25">Demo viz 4</div>
			<div class="ac l25">29-09-2017</div>
			<div class="ac l25 truncate">this is the demo decription</div>
			<div class="ac l25">
				<a href="">Edit</a> |
				<a href="">View</a> |
				<a href="">Share</a>
			</div>
		</li>
	</ul>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
{{--  @include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Visualization','button_title'=>'Save & Next','section'=>'vissec1']]) --}}
@include('common.page_content_secondry_end')
@include('common.pagecontentend')

@endsection