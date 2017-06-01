@extends('admin.layouts.main')
@section('content')
@foreach($model as $key => $value)
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
				<div class="col l9">
					<input type="number" name="role_id" value="{{$value->role_id}}" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ">
				</div>
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
	</style>
@endsection