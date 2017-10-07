@extends('layouts.main')
@section('content')

@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Dataset: '.$dataset['dataset_name'],
	'add_new' => '+ Add Visualization',
	'route' => ['add.visual',['dataset_id'=>$dataset['id']]]
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
	@if($visualizations->isEmpty())
		<div class="aione-message warning">
			No Visualizations Found!
		</div>
	@else
		<ul class="aione-list">
			@foreach($visualizations as $key => $value)
				<li class="aione-item ar">
					<div class="ac l25">Name of visualization</div>
					<div class="ac l25">Created at</div>
					<div class="ac l25">Description</div>
					<div class="ac l25">Actions</div>
				</li>
			@endforeach
		</ul>
	@endif
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
{{--  @include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Visualization','button_title'=>'Save & Next','section'=>'vissec1']]) --}}
@include('common.page_content_secondry_end')
@include('common.pagecontentend')

@endsection