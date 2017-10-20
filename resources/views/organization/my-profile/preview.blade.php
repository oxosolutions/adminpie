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
	'page_title' => 'View Profile',
	'add_new' => ''
); 
@endphp
@php
	$mapModel = 'App\\Model\\Organization\\UsersRole';

	$role = $mapModel::whereIn('id',$model->user_role_rel->pluck('role_id'))->get();
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
    @include('common.page_content_primary_start')
		@include('organization.my-profile._profile_tabs')
		<div class="row">
			<div class="aione-table">
				<table class="wide">
					 <thead>
			            <tr>
			                <th>Field</th>
			                <th>Value</th>
			                
			            </tr>
			          </thead>
					<tbody>

						
					@foreach($AdditionalData as $key => $value)
						<tr>
							<td>
								{{ ucfirst(str_replace('_', " ", $key)) }}
							</td>
							<td>
								{{ $value }}
							</td>
						</tr>	
					@endforeach
					@if($role != null)
						<tr>
							<td>
								Roles
							</td>
							<td>
								@foreach($role->pluck('name') as $k => $v)
									{{ $v }}
									@if(!$loop->last)
										{{ ' ,' }}
									@endif
									
								@endforeach
							</td>
						</tr>
					@endif
					</tbody>
				</table>
				{{-- <table class="wide">
		          <thead>
		            <tr>
		                <th>Name</th>
		                <th>Item Name</th>
		                
		            </tr>
		          </thead>

		          <tbody>
		            <tr>
		              <td>Alvin</td>
		              <td>Eclair</td>
		              
		            </tr>
		            <tr>
		              <td>Alan</td>
		              <td>Jellybean</td>
		              
		            </tr>
		            <tr>
		              <td>Jonathan</td>
		              <td>Lollipop</td>
		              
		            </tr>
		          </tbody>
		        </table> --}}
			</div>
		</div>
	@include('common.page_content_primary_end')
    @include('common.page_content_secondry_start')
    @include('common.page_content_secondry_end')
	@include('common.pagecontentend')
@endsection
