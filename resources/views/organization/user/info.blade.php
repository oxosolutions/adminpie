@extends('layouts.main')
@section('content')

{{-- {{dump($type)}} --}}
<div class="row">
	<div class="">
	{!! Form::open(['route'=>'save.user_meta', 'class'=> 'form-horizontal','method' => 'post','id'=>'save-user-details'])!!}
		<input type="hidden" name="user_id" value="{{$send_data[0]['user_id']}}">
			
						@include ('organization.user._form_employee')

						{{-- 	<div class="text-right">
								<button type="submit" class="btn btn-primary">Update form <i class="icon-arrow-right14 position-right"></i></button>
							</div> --}}
						
		{!!Form::close()!!}
	</div>
</div>

@endsection()