@extends('admin.layouts.main')
@section('content')
{{-- @php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Edit Organization',
    'add_new' => '+ Add Designation'
); 
@endphp
@include('common.pageheader',$page_title_data)  --}}
@foreach($plugins['model'] as $key => $value)
	<div class="row">
		<form method="POST" action="{{route('user.edit',$value->id)}}">
			<div class="row" style="padding:10px 0px">
				<div class="col l3" style="line-height: 30px">
					Name
				</div>
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<div class="col l9">
					<input type="text" name="name" value="{{$value->name}}" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ">
				</div>
			</div>
			<div class="row" style="padding:10px 0px">
				<div class="col l3" style="line-height: 30px">
					Email
				</div>
				<div class="col l9">
					<input type="email" name="email" value="{{$value->email}}" disabled="disabled" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ">
				</div>
			</div>
			<div class="row" style="padding:10px 0px">
				<div class="col l3" style="line-height: 30px">
					Role ID
				</div>
				<div class="input-field col l9">
					<label for="roleId"></label>
					<select name="role_id">
						@foreach($plugins['roles'] as $key => $val)
							<option {{($value->role_id == $key)?'selected': ''}} value="{{$key}}">{{$val}}</option>
						@endforeach
					</select>
	            </div>
				{{-- <div class="col l9">
					<input type="number" name="role_id" value="{{$value->role_id}}" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ">
				</div> --}}
			</div>
			<div class="row">
				<div class="col l12">
					<button class="btn right-align blue" type="submit">Update</button>
				</div>
			</div>
		</form>
	</div>
@endforeach

	<style type="text/css">
		.aione-setting-field:focus{
		border-bottom: 1px solid #a8a8a8 !important;
		box-shadow: none !important;
	}
	.input-field{
		margin-top: 0px
	}
	</style>
@endsection