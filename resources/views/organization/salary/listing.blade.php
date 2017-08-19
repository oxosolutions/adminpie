@extends('layouts.main')
@section('content')

<div>
			{!! Form::open(['route'=>'hrm.salary'])!!}
				{!! Form::selectMonth('month') !!}
				{!! Form::selectRange('year',2005,2030) !!}

			{!! Form::submit()!!}
			
			<input type="text" name='generate' value='generate'>
			<input type="submit" value='generate'>
			
				

			{!! Form::close()!!}	
</div>
@endsection