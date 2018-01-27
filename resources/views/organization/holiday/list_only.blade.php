@extends('layouts.main')
@section('content')
@php
    $page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Holidays',
    'add_new' => '+ Add Tasks'
); 
@endphp
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('organization.profile._tabs')
<div class=" aione-table">
	@if($model != null && !$model->isEmpty())
	<table>
		<thead>
			<tr>
				<th>Name</th>
				<th>Date</th>
				<th>Description</th>	
			</tr>
		</thead>
		<tbody>
			@foreach($model as $k => $holidays)
				<tr>
					<td>{{$holidays->title}}</td>
					<td>{{date( 'D / d M Y' , strtotime($holidays->date_of_holiday) )}}</td>
					<td>{{$holidays->description}}</td>
				</tr>
			@endforeach		
		</tbody>
	</table>
	@else
	<div class="aione-message warning">
		No holiday available
	</div>
	@endif
</div>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
<style type="text/css">
/*.holidays-list table, td, th {    
    border: 1px solid #e8e8e8;
    text-align: left;
}

.holidays-list table {
    border-collapse: collapse;
    width: 100%;
}

.holidays-list th, td {
    padding: 15px;
}
.holidays-list th{
	font-weight: 600
}*/
</style>
@include('common.page_content_secondry_end')
@include('common.pagecontentend') 
@endsection