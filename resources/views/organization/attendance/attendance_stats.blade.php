
@if(!empty($attendanceVal))
<h3> Attendance stats </h3>
	@php
	    $working_days_in_month = $attendanceVal->whereNotIn('shift_hours',[null])->count();
	    $loss_of_pay_days = $attendanceVal->whereIn('attendance_status',['lop','absent'])->whereNotIn('shift_hours',[null])->count();
	    $absent = $attendanceVal->whereIn('attendance_status',['absent'])->whereNotIn('shift_hours',[null])->count();
	    $un_paid = $attendanceVal->whereIn('attendance_status',['lop'])->whereNotIn('shift_hours',[null])->count();
	    $leaves_in_month = $attendanceVal->whereIn('attendance_status',['leave'])->whereNotIn('shift_hours',[null])->count();
	    $due_time = $attendanceVal->where('over_time' ,'<', 0)->sum('over_time');
	    $extra_time = $attendanceVal->where('over_time' ,'>', 0)->sum('over_time');
	    $all_stats = $attendanceVal->whereNotIn('over_time' ,[null]);
	@endphp
	<div class="left-hand">
		<h5> Holidays days {{ $holiday_data->count() }} </h5>
		<h5> working days {{ $working_days_in_month }} </h5>
		<h5> Loss of Pay days {{ $loss_of_pay_days }} </h5>
		<h5> Total Leave {{ $leaves_in_month }} </h5>
		<h5> Total Absent {{ $absent }} </h5>
		<h5> Total Un Paid Leave {{ $un_paid }} </h5>
		<h5> Total Due Time  {{ convert_sec_to_hour(abs($due_time))	 }} </h5>
		<h5> Total Extra Time{{ convert_sec_to_hour($extra_time)	 }} </h5>
	</div>
	<div class="right-hand">
		<table>
			<tr>
				@foreach($all_stats->keys() as $head)
				<th>{{$head}} </th>
				@endforeach
			</tr>
			<tr>
			@foreach($all_stats->keys() as $key)
				@if($all_stats[$key]['over_time'] < 0)
				<td>-{{convert_sec_to_hour(abs($all_stats[$key]['over_time'])) }}</td>
				@else
					<td>{{convert_sec_to_hour($all_stats[$key]['over_time']) }}</td>
				@endif
			@endforeach
			</tr>
		</table>
	</div>
@else
<h3> No Attendance stats </h3>

@endif