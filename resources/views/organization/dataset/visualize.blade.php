@extends('layouts.main')
@section('content')

@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Dataset Visualization <span>'.get_dataset_title(request()->route()->parameters()['id']).'</span>',
	'add_new' => '+ Add Visualization',
	'route' => ['visualization.view',['dataset_id'=>$dataset['id']]]
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
				<li class="aione-item ar">
					<div class="ac l25">Name of visualization</div>
					<div class="ac l25">Description</div>
					<div class="ac l25">Created</div>
				</li>
			@foreach($visualizations as $key => $value)
			
				<li class="aione-item ar">
					<div class="ac l25"><a href="{{ url('visualization/edit/'.$value->id) }}">{{$value->name}}</a></div>
					<div class="ac l25">{{$value->description}}</div>
					<div class="ac l25">{{$value->created_at->diffForHumans()}}</div>
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