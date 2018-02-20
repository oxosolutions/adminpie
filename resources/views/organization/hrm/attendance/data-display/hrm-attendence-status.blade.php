@if(!empty($attendance_data) && isset($attendance_data[$user_meta['employee_id']]) && !empty($attendance_data[$user_meta['employee_id']]))
		@if(isset($attendanceVal[$d]) && empty($attendanceVal[$d]['shift_hours']))
			@if(!empty($attendanceVal[$d]['punch_in_out']))
				<div class="attendance-sheet column attendance-status-off attendance-status-present">O</div>
			@else
				<div class="attendance-sheet column attendance-status-off">O</div>
			@endif
		@elseif(!empty($attendanceVal[$d]['shift_hours']))
{{--Holiday check--}}
			@if(!empty($holiday_data[$d]))
 				@if(!empty($attendanceVal[$d]) && !empty($attendanceVal[$d]['punch_in_out']))
					<div class="attendance-sheet column attendance-status-holiday attendance-status-present">H</div>
				@else
					<div class="attendance-sheet column attendance-status-holiday">H</div>
				@endif
{{-- Leave Check --}}
			@elseif($attendanceVal[$d]['attendance_status']=='leave')
				@if(!empty($attendanceVal[$d]) && !empty($attendanceVal[$d]['punch_in_out']))
					<div class="attendance-sheet column  attendance-status-leave ">L</div>
				@else
					<div class="attendance-sheet column attendance-status-leave">L</div>
				@endif
{{-- Loss of pay leave check --}}
			@elseif($attendanceVal[$d]['attendance_status']=='lop')
				@if(!empty($attendanceVal[$d]) && !empty($attendanceVal[$d]['punch_in_out']))
					<div class="attendance-sheet column  attendance-status-leave attendance-status-present ">U</div>
				@else
					<div class="attendance-sheet column attendance-status-leave">U</div>
				@endif
{{-- Punch In & Present check lop --}}
			@elseif(@$attendanceVal[$d]['attendance_status']=='present' || !empty($attendanceVal[$d]['punch_in_out']) )
				<div class="attendance-sheet column attendance-status-null attendance-status-present">w</div>
			@elseif(@$attendanceVal[$d]['attendance_status']=='absent')
				<div class="attendance-sheet column attendance-status-absent">A</div>
			@else 
				<div class="attendance-sheet column attendance-status-absent">A</div>
			@endif
		@else
			<div class="attendance-sheet column attendance-status-null">-</div>
		@endif
@else
	@if(!empty($holiday_data[$d]))
		<div class="attendance-sheet column attendance-status-holiday">H</div>
	@else
		<div class="attendance-sheet column " style="background-color:rgba(128, 128, 128, 0.38);height:31px"></div>
	@endif
@endif	