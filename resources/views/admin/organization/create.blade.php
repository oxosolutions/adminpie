@extends('admin.layouts.main')
@section('content')


	{!! Form::open([ 'method' => 'POST', 'route' => 'save.organization' ,'class' => 'form-horizontal']) !!}

		@include('admin.organization._form')				
		<div class="row right-align pv-10">
			<button type="submit" class="btn btn-primary blue"> create Organization <i class="icon-arrow-right14 position-right"></i></button>	
		</div>						
		
							
						
	{!! Form::close() !!}
	

<style type="text/css">
	button{
		position: inherit !important;
	}
</style>
@endsection
