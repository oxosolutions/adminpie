@extends('layouts.main')
@section('content')

@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Dataset: '.$dataset['dataset_name'],
	'add_new' => '+ Add Role'
	); 

@endphp
<style type="text/css">
	.ar .aione-box{
		border: 1px solid #e8e8e8;margin-bottom: 10px;margin-right:10px;padding: 10px
	}
</style>
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	@include('organization.dataset._tabs')
	{{Session::get('success')}}
	@php
		@$model = json_decode($dataset->defined_columns);
	@endphp
	{!!Form::model($model)!!}
		<div class="aione-table">
			<table class="compact">
				<thead>
					<tr>
						<td>Column name</td>
						<td>Column type</td>
						
					</tr>
				</thead>
				<tbody>
					@foreach($columns->toArray() as $key => $columnName)
						<tr>
							<td width="500">{{$columnName}}</td>
							<td>
								{!!Form::select($key,["/^[a-zA-Z][a-zA-Z\\s]+$/"=>'String','/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26]php)00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/'=>'Date','/^[0-9]+(\.[0-9]{1,5})?$/'=>'Number','area_code'=>'Area Code'],null,['class'=>'browser-default'])!!}
								{{-- <select class="browser-default" name="{{$key}}">
									<option value="string">String</option>	
									<option value="date">Date</option>	
									<option value="number">Number</option>	
									<option value="area_code">Area Code</option>	
								</select> --}}
							</td>
						</tr>
					@endforeach				
				</tbody>
			</table>
			<div style="margin-top: 15px">
				<a href="" class="btn blue" data-target="add_new_column">Add New Column</a>
				<button type="submit" class="btn blue" style="float: right">Save Changes</button>
			</div>
		</div>
	{!!Form::close()!!}
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
{!!Form::open(['route'=>['create.column',request()->route()->parameters()['id']]])!!}
@include('common.modal-onclick',['data'=>['modal_id'=>'add_new_column','heading'=>'Create Column','button_title'=>'Proceed','section'=>'create_column']])
{!!Form::close()!!}
@include('common.page_content_secondry_end')
@include('common.pagecontentend')

@endsection

