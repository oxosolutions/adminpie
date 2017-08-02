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
<div id="projects" class="projects list-view">
	<div class="row">

	</div>
	<div class="row">
		<div class="col s12 m12 l12" >
				<table class="bordered">
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
		</div>

		
	</div>
</div>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

@include('common.page_content_secondry_end')
@include('common.pagecontentend') 
@endsection