@extends('group.layouts.main')
@section('content')

@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'View User',
	'add_new' => '+ Add User'
);
	
@endphp
@include('common.pageheader',$page_title_data)		
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('group.user._tabs')
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
	<div class="aione-table">
		<table class="aione-table">
			<tr>
				<td width="300"><b>Field</b></td>
				<td><b>Value</b></td>
			</tr>
			@foreach($model->toArray() as $key => $value)
				@if(in_array($key,['name','email']))
				<tr>
					<td>{{ucfirst(str_replace('_',' ',$key))}}</td>
					<td>{{$value}}</td>
				</tr>
				@endif
			@endforeach
			<tr>
				<td>Organizations having this user:</td>
				<td>
					@foreach($organizationsList as $key => $organization)
						<span class="bg-cyan white p-5 display-inline-block mb-5" style="cursor: pointer;">{{ $organization['name'] }}</span>
					@endforeach
				</td>
			</tr>
		</table>
		<div class="center mt-2p">
			<h5>Organizations having this user</h5>
		</div>
		<table class="aione-table">
			<thead>
				<tr>
					<th width="300">Organization Name</th>
					<th>Role Name</th>
				</tr>
			</thead>
			<tbody>
				@foreach($organizationsList as $key => $organization)
					<tr>
						<td>{{ $organization['name'] }}</td>
						<td>
							@foreach($organization['roles'] as $k => $role)
								<span class="bg-teal white p-5 display-inline-block mb-5" style="cursor: pointer;">{{ $role->name }}</span>
							@endforeach
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@include('common.page_content_secondry_end')
@include('common.pagecontentend')


@endsection