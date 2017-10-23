@extends('layouts.main')
@section('content')

@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Dataset <span>'.get_dataset_title(request()->route()->parameters()['id']).'</span>',
	'add_new' => '+ Add Role'
	); 
@endphp
<style type="text/css">

	.aione-box{
		border: 1px solid #e8e8e8;
	    padding: 10px	
	}
	.aione-box:after{
		content: '';
		display: table;
		clear: both;
	}
</style>
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	@include('organization.dataset._tabs')

	{!!Form::open(['method'=>'GET'])!!}
		<div class="ar">
			<div class="ac l50">
				<div class=" aione-box">
					{!! FormGenerator::GenerateSection('vertical_filtration') !!}	
					{{@Session::get('success')}}
				</div>
				
			</div>		
			<div class="ac l50 ">
				<div class="aione-box">
					{!! FormGenerator::GenerateSection('horizontal_filtration',[],request()->all()) !!}
				</div>
				
			</div>
		</div>
	<div class="ar" style="margin: 14px 0px">
		<div class="ac l50"><button data-target="create-modal">Create Subset</button></div>
		<div class="ac l50 right-align" style="float: right;"><button>Apply Filters</button></div>
	</div>
	{!!Form::close()!!}
	<div class="ac l50 right-align" style="float: right;"><button onclick="window.location='{{route('filter.dataset',request()->id)}}'">Reset Form</button></div>
	<div class="ar">
		@if(!$records->isEmpty())
			<div class="ac l80" style="line-height: 48px">Showing {{$records->firstItem()}} to {{$records->lastItem()}} of total {{$records->total()}} records</div>
		@endif
	</div>
	
	{!!Form::open(['route'=>['create.dataset.subset',request()->id]])!!}
		<input type="hidden" name="filter_data" value="{{serialize(request()->all())}}" />
		@include('common.modal-onclick',['data'=>['modal_id'=>'create-modal','heading'=>'Enter details for new dataset','button_title'=>'Proceed','section'=>'create_subset']])
	{!!Form::close()!!}
	@if(!$records->isEmpty())
	
	<div class="aione-table">
		<table class="compact">
			<thead>
				<tr>
					@foreach(request()->select_column as $header_key => $column_name)
						<th>{{$headers[$column_name]}}</th>
					@endforeach
				</tr>
			</thead>
			<tbody>
				@foreach($records as $record_key => $record_value)
				<tr>
					@foreach($record_value as $col_key => $col_val)
						<td>{{$col_val}}</td>
					@endforeach
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	{!!$records->appends(request()->input())->render()!!}
	@endif
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')

@endsection