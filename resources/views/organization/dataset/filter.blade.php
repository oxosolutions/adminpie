@extends('layouts.main')
@section('content')

@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => __('organization/datasets.dataset_filter_page_title_text').' <span>'.get_dataset_title(request()->route()->parameters()['id']).'</span>',
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
				<div class="aione-border">
		            <div class="">
		                <h5 class="aione-align-center font-weight-400 m-0 pv-10 bg-grey bg-lighten-4 aione-border-bottom">
		                    {{ __('organization/datasets.vertical_filtration') }}
		                </h5>
		            </div>
		            <div class="p-15">
		            	{!! FormGenerator::GenerateSection('vertical_filtration') !!}	
						{{@Session::get('success')}}	
		            </div>
					
				</div>
				
			</div>		
			<div class="ac l50 ">
				<div class="aione-border">
				  	<div class="">
		                <h5 class="aione-align-center font-weight-400 m-0 pv-10 bg-grey bg-lighten-4 aione-border-bottom">
		                    {{ __('organization/datasets.horizontal_filtration') }}
		                </h5>
	            	</div>
	            	<div class="p-15">
	            		{!! FormGenerator::GenerateSection('horizontal_filtration',[],request()->all()) !!}	
	            	</div>
					
				</div>
			</div>
		</div>
	<div class="ar aione-float-right" style="margin: 14px 0px">
		<button class="aione-button" data-target="create-modal">{{ __('organization/datasets.create_subset_button_text') }}</button>
			@if(!empty($errors->all()))
				@if(@$errors->name)
					<script type="text/javascript">
						window.onload = function(){
							$('#create-modal').modal('open');
						}
					</script>
				@endif
			@endif
		<button class="aione-button">{{ __('organization/datasets.apply_filters_button_text') }}</button>
		<a class="aione-button" href="{{route('filter.dataset',request()->id) }}" >{{ __('organization/datasets.reset_form_button_text') }}</a>
		{{-- <button class="aione-button" onclick="window.location='{{route('filter.dataset',request()->id)}}'">Reset Form</button> --}}
	</div>
	{!!Form::close()!!}
	{{-- <div class="ac l50 right-align" style="float: right;"><button onclick="window.location='{{route('filter.dataset',request()->id)}}'">Reset Form</button></div> --}}
	<div class="ar">
		@if(!$records->isEmpty())
			<div class="ac l80" style="line-height: 48px">Showing {{$records->firstItem()}} to {{$records->lastItem()}} of total {{$records->total()}} records</div>
		@endif
	</div>
	
	{!!Form::open(['route'=>['create.dataset.subset',request()->id]])!!}
		<input type="hidden" name="filter_data" value="{{serialize(request()->all())}}" />
		@include('common.modal-onclick',['data'=>['modal_id'=>'create-modal','heading'=>__("organization/datasets.model_header"),'button_title'=>__("organization/datasets.proceed"),'section'=>'create_subset']])
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