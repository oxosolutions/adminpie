@extends('layouts.main')
@section('content')

<div class="row">
	<div class="col-md-12">
	{!! Form::open([ 'method' => 'POST', 'route' => 'save.organization' ,'class' => 'form-horizontal']) !!}

			<div class="row">
				<div class="col-md-12 ">
					<div class="panel panel-flat">

						<div class="panel-body">
							@include('admin.organization._form')				
							<div class="col l12">
								<button type="submit" class="btn btn-primary"> create Organization <i class="icon-arrow-right14 position-right"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		{!! Form::close() !!}
	</div>
</div>



@endsection
<style type="text/css">
	button{
		position: inherit !important;
	}
</style>