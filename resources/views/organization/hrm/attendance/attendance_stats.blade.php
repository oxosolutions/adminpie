
@if(!empty($attendanceVal))
	@php
	$data = $attendanceVal->whereNotIn('shift_hours',[null])->whereNotIn('punch_in_out',[null]);
		$shift = $data->mapWithKeys(function($item , $key){
		$come_late =  $go_early = Null;
		$shift_hr = json_decode($item->shift_hours);
		$punch_in_out = json_decode($item->punch_in_out);
		if($shift_hr[0] < $punch_in_out[0]){
			$come_late = difference_secs($shift_hr[0] , $punch_in_out[0]);
		}
		return[$key=>['come_late'=>$come_late , 'go_early'=>$go_early]];
	});
	    $working_days_in_month = $attendanceVal->whereNotIn('shift_hours',[null])->count();
	    $loss_of_pay_days = $attendanceVal->whereIn('attendance_status',['lop','absent'])->whereNotIn('shift_hours',[null])->count();
	    // $not_mark_attendance = $attendanceVal->whereNotIn('attendance_status',['lop','absent'])->whereNotIn('shift_hours',[null])->whereIn('punch_in_out',[null])->count();
	    $absent = $attendanceVal->whereIn('attendance_status',['absent'])->whereNotIn('shift_hours',[null])->count();

	    $un_paid = $attendanceVal->whereIn('attendance_status',['lop'])->whereNotIn('shift_hours',[null])->count();
	    $leaves_in_month = $attendanceVal->whereIn('attendance_status',['leave'])->whereNotIn('shift_hours',[null])->count();
	    $due_time = $attendanceVal->where('over_time' ,'<', 0)->sum('over_time');
	    $extra_time = $attendanceVal->where('over_time' ,'>', 0)->sum('over_time');
	    $all_stats = $attendanceVal->whereNotIn('over_time' ,[null]);
	    // dump($holiday_data->toArray());
		$holiday_count = $holiday_data->count();
		$holiday_absent_count  = 0;
		if($holiday_count > 0){
			$holiday_absent  = $holiday_data->keys()->toArray();
			$holiday_absent_count = $attendanceVal->whereIn('date',$holiday_absent)->whereIn('attendance_status',['absent'])->whereIn('punch_in_out',[NULL])->whereNotIn('shift_hours',[null])->count();
			// $holiday_offday_absent_count = $attendanceVal->whereIn('date',$holiday_absent)->whereNotIn('shift_hours',[null])->count();

			$working_days_in_month = $working_days_in_month - $holiday_count;
			if($absent >0){
				$absent = $absent - $holiday_absent_count;
			}
		}
		if($loss_of_pay_days >0 ){
			    $loss_of_pay_days = $loss_of_pay_days - $holiday_absent_count;
		}
	@endphp
	<div class="">
		<div class="ar aione-align-center mb-10">
			<div class="ac l13 pl-0">
				<div class="aione-border border-light-blue border-lighten-3">
					<div class="bg-white font-size-13"><span>working days</span><span class="pl-5 
						light-blue">{{ $working_days_in_month }} </span></div>
				</div>
			</div>
			<div class="ac l14 pl-0">
				<div class="aione-border border-light-blue border-lighten-3">
					<div class="bg-white font-size-13"><span>Loss of Pay days</span><span class="pl-5 light-blue">{{ $loss_of_pay_days }}</span></div>
				</div>
			</div>
			{{-- <div class="ac l14 pl-0">
				<div class="aione-border border-light-blue border-lighten-3">
					<div class="bg-white font-size-13"><span>No Mark days</span><span class="pl-5 light-blue"> {{$not_mark_attendance}}</span></div>
				</div>
			</div> --}}
			<div class="ac l13 pl-0">
				<div class="aione-border border-light-blue border-lighten-3 ">
					<div class="bg-white font-size-13"><span>Total Leave</span><span class="pl-5 light-blue">{{ $leaves_in_month }}</span></div>
				</div>
			</div>
			<div class="ac l13 pl-0">
				<div class="aione-border border-light-blue border-lighten-3 ">
					<div class="bg-white font-size-13"><span>Total Absent</span><span class="pl-5 light-blue">{{ $absent }}</span></div>
					
				</div>
			</div>
			<div class="ac l16 pl-0">
				<div class="aione-border border-light-blue border-lighten-3">
					<div class="bg-white font-size-13"><span>Total Un Paid Leave</span><span class="pl-5 light-blue">{{ $un_paid }}</span></div>
				</div>
			</div>
			<div class="ac l13 pl-0">
				<div class="aione-border border-light-blue border-lighten-3">
					<div class="bg-white  font-size-13"><span>Total Due Time</span><span class="pl-5 light-blue">{{ convert_sec_to_hour(abs($due_time))  }}</span></div>
					
				</div>
			</div>
			<div class="ac l16 pl-0">
				<div class="aione-border border-light-blue border-lighten-3">
					<div class="bg-white font-size-13"><span>Total Extra Time</span><span class="pl-5 light-blue">{{ convert_sec_to_hour($extra_time)	 }} </span></div>
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
	<div class="right-hand aione-align-center">
		{{-- {{ dump(count($all_stats)) }} --}}
		<div class="display-inline-block aione-align-center p-5 aione-border line-height-20">
				<span class="font-weight-700">DAY</span>
				<br>
				<span class="green darken-2">Over</span>/<span class="red darken-2">Due</span> Time
			</div>
	@foreach($all_stats as $key =>$val)

		@if($all_stats[$key]['over_time'] > 0)

			<div class="display-inline-block aione-align-center p-5 aione-border line-height-20">
				<span class="font-weight-700"> {{$key}}</span>
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
<div class="aione-message error">
	No Attendance stats
</div>


@endif
<style type="text/css">
	.aione-message{
		width: 88.4%;
		font-size: 16px;
		padding: 5px;
	}
	#hrm_attendance .content{
		width: 13%;
	}
</style>