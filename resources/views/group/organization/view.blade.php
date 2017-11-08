@extends('group.layouts.main')
@section('content')
{{-- @if(!empty(Session::get('success')))
	<div class="aione-message success">
		{{Session::get('success')}}
	</div>
@endif

@if(!empty(Session::get('error')))
	<div class="aione-message error">
		{{Session::get('error')}}
	</div>
@endif --}}
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Organizations',
	'add_new' => '+ Add Organization',
	); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('group.organization._tabs')
	<div class="aione-table">
		<table>
			<thead>
				<tr>
					<th width="300">Field</th>
					<th>Value</th>
				</tr>
			</thead>
			<tbody>
				@foreach($model->toArray() as $key => $value)
					@if(!in_array($key, ['updated_at','created_by','id']))
						@if($key == 'group_id')
							<tr>
								<td>Group</td>
								<td>{{ Auth::guard('group')->user()->name }}</td>
							</tr>
						@elseif($key == 'modules')
							<tr>
								<td>{{ ucwords(str_replace('_',' ',$key)) }}</td>
								<td>
									@foreach($modules as $k => $item)
                                        <span class="bg-cyan white p-5 display-inline-block mb-5" style="cursor: pointer;">{{ $item }}</span>
                                    @endforeach
								</td>
							</tr>
						@else
							<tr>
								<td>{{ ucwords(str_replace('_',' ',$key)) }}</td>
								<td>{{ $value }}</td>
							</tr>
						@endif
					@endif
				@endforeach
			</tbody>
		</table>	
	</div>
	
	<h3 class="aione-align-center">Organization Users List</h3>
	<div class="aione-table">
		<table>
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $key => $user)
					<tr>
						<th>{{ $user->belong_group->name }}</th>
						<th>{{ $user->belong_group->email }}</th>
						<th>
							<a href="{{ url('user/view/'.$user->belong_group->id) }}">View</a> | 
							<a href="{{ url('user/edit/'.$user->belong_group->id) }}">Edit</a>
						</th>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')

@endsection
