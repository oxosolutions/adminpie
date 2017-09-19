@extends('layouts.main')
@section('content')
@php
	// $isEmployee = App\Model\Organization\Employee::where('user_id' , $model->id)->first();
	$isEmployee = is_employee(@request()->route()->parameters()['id']);
	$isAdmin = is_admin();
@endphp
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Profile',
	'add_new' => ''
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
    @include('common.page_content_primary_start')
		@include('organization.profile._tabs')
		<div class="row">
			<div class="col l9 pr-7">
				<table>
					@foreach($model->toArray() as $key => $value)
						@if($key != 'dashboards' && $key != 'metas' && $key != 'user_role_rel' && $key != 'password' && $key != 'api_token' && $key != 'remember_token' && $key != 'status')
							<tbody>
								<tr>
									<th>
										{{ ucfirst(str_replace('_', " ", $key)) }}
									</th>
									<td>
										{{ $value }}
									</td>
								</tr>
							</tbody>
						@endif
					@endforeach
				</table>
			</div>
		</div>
	@include('common.page_content_primary_end')
    @include('common.page_content_secondry_start')
    @include('common.page_content_secondry_end')
	@include('common.pagecontentend')
@endsection
