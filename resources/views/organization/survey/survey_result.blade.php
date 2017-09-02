@extends('layouts.main')
@section('content')
@php

if(!empty($data)){
$data = json_decode(json_encode($data->all()),true);
$keys = array_keys($data[0]);
}
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Survey Results',
    'add_new' => '+ Add Media'
); 
$id = "";
@endphp 
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('organization.survey._tabs')
@if(!empty($data))
	<div>
		<table>
	        <thead>
				<tr>
				@foreach($keys as $key =>$val)
					<th>{{$val}}</th>
					
				@endforeach
				</tr>
	        </thead>

	        <tbody>
	        @foreach($data as $keys => $vals )
				<tr>
					@foreach($vals as $queKey => $queVal)
					<td>{{$queVal}}</td>
					
					@endforeach
				</tr>
			@endforeach
				
	        </tbody>
	    </table>
            
	</div>

	@else
	<div><h2> No Data Exist</h2></div>
@endif

@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection