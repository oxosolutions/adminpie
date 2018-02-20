
@if(!empty($attendanceVal))
{{-- <h3> Attendance stats </h3> --}}
	@php
	dump(1232);
	// function difference_secs($time_1 , $time_2){
	// 	$start_shift = new Carbon\Carbon($time_1);
	// 		$come_at = new Carbon\Carbon($time_2);
	// 		$diff = $start_shift->diffInSeconds($come_at);
	// 		$secs = convert_sec_to_hour($diff);
	// 	return $secs;
	// }
	$data = $attendanceVal->whereNotIn('shift_hours',[null])->whereNotIn('punch_in_out',[null]);
		$shift = $data->mapWithKeys(function($item , $key){
		$come_late =  $go_early = Null;
		$shift_hr = json_decode($item->shift_hours);
		$punch_in_out = json_decode($item->punch_in_out);
		if($shift_hr[0] < $punch_in_out[0]){
			$come_late = difference_secs($shift_hr[0] , $punch_in_out[0]);
		}
		// if(!empty($punch_in_out[2]) && ($shift_hr[2] > $punch_in_out[2])){
		// 	$go_late = difference_secs($shift_hr[2] , $punch_in_out[2]);
		// }
		return[$key=>['come_late'=>$come_late , 'go_early'=>$go_early]];
	});
	// dump($shift);
	    $working_days_in_month = $attendanceVal->whereNotIn('shift_hours',[null])->count();
	    $loss_of_pay_days = $attendanceVal->whereIn('attendance_status',['lop','absent'])->whereNotIn('shift_hours',[null])->count();
	    $absent = $attendanceVal->whereIn('attendance_status',['absent'])->whereNotIn('shift_hours',[null])->count();
	    $un_paid = $attendanceVal->whereIn('attendance_status',['lop'])->whereNotIn('shift_hours',[null])->count();
	    $leaves_in_month = $attendanceVal->whereIn('attendance_status',['leave'])->whereNotIn('shift_hours',[null])->count();
	    $due_time = $attendanceVal->where('over_time' ,'<', 0)->sum('over_time');
	    $extra_time = $attendanceVal->where('over_time' ,'>', 0)->sum('over_time');
	    $all_stats = $attendanceVal->whereNotIn('over_time' ,[null]);
	    dump($all_stats);
	@endphp
	<div class="">
		<div class="ar aione-align-center">
	
			
			<div class="ac l14 p-0">
				<div class="aione-border">
					<div class="bg-grey bg-lighten-3">working days</div>
					<div>{{ $working_days_in_month }} </div>
				</div>
			</div>
			<div class="ac l14 p-0">
				<div class="aione-border">
					<div class="bg-grey bg-lighten-3">Loss of Pay days</div>
					<div>{{ $loss_of_pay_days }} </div>
				</div>
			</div>
			<div class="ac l14 p-0">
				<div class="aione-border">
					<div class="bg-grey bg-lighten-3">Total Leave</div>
					<div>{{ $leaves_in_month }} </div>
				</div>
			</div>
			<div class="ac l14 p-0">
				<div class="aione-border">
					<div class="bg-grey bg-lighten-3">Total Absent</div>
					<div>{{ $absent }} </div>
				</div>
			</div>
			<div class="ac l16 p-0">
				<div class="aione-border">
					<div class="bg-grey bg-lighten-3">Total Un Paid Leave </div>
					<div>{{ $un_paid }} </div>
				</div>
			</div>
			<div class="ac l14 p-0">
				<div class="aione-border">
					<div class="bg-grey bg-lighten-3">Total Due Time</div>
					<div>{{ convert_sec_to_hour(abs($due_time))	 }} </div>
				</div>
			</div>
			<div class="ac l14 p-0">
				<div class="aione-border">
					<div class="bg-grey bg-lighten-3">Total Extra Time</div>
					<div>{{ convert_sec_to_hour($extra_time)	 }} </div>
				</div>
			</div>
	
		</div>
	</div>
	{{-- <div class="left-hand">
		<h5> Holidays days {{ $holiday_data->count() }} </h5>
		<h5> working days {{ $working_days_in_month }} </h5>
		<h5> Loss of Pay days {{ $loss_of_pay_days }} </h5>
		<h5> Total Leave {{ $leaves_in_month }} </h5>
		<h5> Total Absent {{ $absent }} </h5>
		<h5> Total Un Paid Leave {{ $un_paid }} </h5>
		<h5> Total Due Time  {{ convert_sec_to_hour(abs($due_time))	 }} </h5>
		<h5> Total Extra Time{{ convert_sec_to_hour($extra_time)	 }} </h5>
	</div> --}}
	<div class="right-hand">
		{{ dump(count($all_stats)) }}
	@foreach($all_stats as $key =>$val)

		@if($all_stats[$key]['over_time'] > 0)
			<div class="display-inline-block aione-align-center p-5 aione-border line-height-20">
				<span class="font-weight-700">{{$loop->count}} {{$key}}</span>
				<br>
				<span class="green darken-2">{{ convert_sec_to_hour($val['over_time']) }}</span>
			</div>
		@else
			<div class="display-inline-block aione-align-center p-5 aione-border line-height-20">
				<span class="font-weight-700">{{$key}}</span>
				<br>
				<span class="red darken-2">{{convert_sec_to_hour(abs($val['over_time'])) }}</span>
			</div>
		@endif
	@endforeach
		
	</div>
@else
<div class="aione-message error ">
	No Attendance stats
</div>


@endif