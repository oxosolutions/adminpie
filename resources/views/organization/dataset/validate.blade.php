@extends('layouts.main')
@section('content')

@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Dataset:',
	'add_new' => '+ Add Role'
	); 
@endphp
<style type="text/css">
	.label-box{
		display: inline-block;
	    width: 20px;
	    height: 20px;
	    vertical-align: bottom;
	}
	.label-box-desc{
		line-height: 20px;
    	display: inline-block;
	}
	.aione-error-wrapper{
		padding: 10px;
		    background-color: rgba(255, 0, 0, 0.2);
		    margin-bottom: 14px
	}
</style>
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	@include('organization.dataset._tabs')
	<div class="ar">
		<div class="ac l80" style="padding: 14px 0px">
			<div style="margin-bottom: 14px">
				<span class="red label-box"></span>
				<span class="label-box-desc">Datacells with error values are highlighted with red background.</span>	
			</div>
			<div>
				<span class="green label-box"></span>
				<span class="label-box-desc">Rectified Datacells after revalidating.</span>
			</div>
			
		</div>
		<div class="ac l20">
			<button>Re-Validate</button>
		</div>
	</div>
	<div class="aione-error-wrapper">
		Total {{count($errors)}} errors ,<br>
		{{-- Error Locations (Column 3 X r17),(Column 5 X r1),(Column 1 X r6) --}}
		Error Locations:<br>
		@foreach($errors as $key => $error)
			@php
				$errorColumns = collect($error);
				$columns = array_keys($errorColumns->groupBy('col')->toArray());
				$columnNames = [];
				foreach($columns as $k => $v){
					$columnNames[] = $headers->{$v};
				}
				$columns = implode(',',$columnNames);
			@endphp
			<strong>Column:</strong>{{$columns}}, &nbsp;&nbsp;&nbsp;&nbsp;<strong>Row:</strong>{{$key}}<br>
		@endforeach
	</div>
	<div style="font-size: 13px;color: #757575">Showing 201 to 300 of total 15336 records</div>
	<div class="aione-table" style="margin-top: 14px">
		<table class="compact">
			<thead>
				<tr>
					<th>Row Id</th>
					@foreach($headers as $key => $header)
						@if(!in_array($key,['id','parent','status']))
							<th>{{$header}}</th>
						@endif
					@endforeach
				</tr>
			</thead>
			<tbody>
				@foreach($records as $key => $record)
					<tr>
						<td>{{$loop->index+1}}</td>
						@foreach($record as $k => $column)
							<td>{!!$column!!}</td>
						@endforeach
					</tr>
				@endforeach
			</tbody>
		</table>
		@if(!empty($records))
			{!!$paginate->render()!!}
		@endif
	</div>

@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
<style type="text/css">
	.dataset-validate-error{
		background-color: red;
		color: #FFF;
	}
</style>
@endsection