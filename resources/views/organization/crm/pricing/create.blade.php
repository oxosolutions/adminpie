@extends('layouts.main')
@section('content')
<div class="row">
	<div class="col-md-12">
	<h1>Pricing</h1>
	{!! Form::open(['route'=>'price.products', 'class'=> 'form-horizontal','method' => 'post'])!!}
			<div class="row">
				<div class="col-md-12 ">
					<div class="panel panel-flat">
						<input type="text" name="id" value="{{$id}}">
						<div class="panel-body">
							@include ('organization.crm.pricing._form')
							<div class="text-right">
								<button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		{!!Form::close()!!}
	</div>
</div>

@endsection()