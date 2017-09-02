@extends('layouts.main')
@section('content')

<style>
	 ul li label{
	 	width:300px;
	 	display: inline-block;
	 }

</style>

<div>

<h2>Drop Downs </h2>
<ul>
	<li>	
		<label for="">Employee user </label> 
			{!! Form::select('employee_user', users_drop_down('employee'),null,[]) !!}
	</li>
	<li>	
		<label for="">Categories  </label> 
			{!! Form::select('categories', categories_drop_down('leave'),null,[]) !!}
	</li>

	<li>	
		<label for="">Department  </label> 
			{!! Form::select('department', departments_drop_down(),null,[]) !!}
	</li>


</ul>

</div>

@endsection

