@extends('layouts.main')
@section('content')
@php
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
	if(array_key_exists('role', $model)){
		if(!is_array($model['role'])){
			$role[] = $mapModel::where('id',$model['role'])->first()->name;
		}else{
			$role = $mapModel::whereIn('id',$model['role']->pluck('role_id'))->get();
		}
	}
	unset($model['role'] , $model['id'] , $model['metas'], $model['user_role_rel']);
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
    @include('common.page_content_primary_start')
		@include('organization.user._tabs')
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

					@foreach($model as $key => $value)
						@if($value != '' || $value != null || !empty($value))
							@if(!is_array($value))
								<tr>
									<td>
										{{ ucfirst(str_replace('_', " ", $key)) }}
									</td>
									<td>
										{{ $value }}
									</td>
								</tr>	
							@else
								<tr>
									<td>
										{{ ucfirst(str_replace('_', " ", $key)) }}
									</td>
									<td>
										@foreach($value as $k => $v)
											@php
											$array_key = array_keys($value);
												if(end($array_key) != $k){
													echo $v.' , ';
												}else{
													echo $v;
												}
											@endphp
										@endforeach
									</td>
								</tr>	
							@endif
						@endif
					@endforeach
					@if(@$role != null)
						<tr>
							<td>
								Roles
							</td>
							<td>
								@foreach(@$role as $k => $v)
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
			</div>
		</div>
	@include('common.page_content_primary_end')
    @include('common.page_content_secondry_start')
    @include('common.page_content_secondry_end')
	@include('common.pagecontentend')
@endsection
