@extends('layouts.main')
@section('content')

{{-- {{dump($type)}} --}}
<div class="row">
	<div class="">
	{!! Form::model($model,['route'=>['save.user.profile',$model->id]], ['class'=> 'form-horizontal','method' => 'post','id'=>'save-user-details'])!!}
			
						@include ('organization.user._form_employee')

						{{-- 	<div class="text-right">
								<button type="submit" class="btn btn-primary">Update form <i class="icon-arrow-right14 position-right"></i></button>
							</div> --}}
						
		{!!Form::close()!!}
	</div>
</div>

@endsection()