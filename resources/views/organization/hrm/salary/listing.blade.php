@extends('layouts.main')
@section('content')
{{-- <script>
			navigator.geolocation.getCurrentPosition(function(position, html5Error) {

     		geo_loc = processGeolocationResult(position);
     		currLatLong = geo_loc.split(",");
     		initializeCurrent(currLatLong[0], currLatLong[1]);
});

</script> --}}

<div>
			{!! Form::open(['route'=>'hrm.salary'])!!}
				{!! Form::selectMonth('month') !!}
				{!! Form::selectRange('year',2016,2030) !!}

			{!! Form::submit()!!}
			
			
			<input type="submit" name='generate' value='generate'>
			
				

			{!! Form::close()!!}	

			

			<table>
				<tr>
					<th>employee id</th>
					<th>salary</th>
					<th>year</th>
					<th>month</th>
					<th>lock status</th>
				</tr>
				<tbody>
				@foreach(@$salary_data as $key => $value)
					<tr>
						<td>{{$value['employee_id']}}</td>
						<td>{{$value['amount']}}</td>
						<td>{{$value['year']}}</td>
						<td>{{$value['month']}}</td>
						<td>{{$value['lock']}}</td>
					</tr>
				@endforeach
				</tbody>
			</table>
</div>
@endsection