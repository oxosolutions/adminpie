@extends('layouts.main')
@section('content')
<div id="projects" class="projects list-view">
	<div class="row">

	</div>
	<div class="row">
		<div class="col s12 m12 l12" >
				<table>
					<tbody>
						<th>Name</th>
						<th>Date</th>
						<th>Description</th>
					</tbody>
					<tbody>
						@foreach($model as $k => $holidays)
							<tr>
								<td>{{$holidays->title}}</td>
								<td>{{date( 'D / d M Y' , strtotime($holidays->date_of_holiday) )}}</td>
								<td>{{$holidays->description}}</td>
							</tr>
						@endforeach		
					</tbody>
				</table>
		</div>

		
	</div>
</div>
@endsection