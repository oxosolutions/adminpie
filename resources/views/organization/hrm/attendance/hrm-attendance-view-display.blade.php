@php
	if(!empty($date_handling)){
		extract($date_handling);
	}
	$postDate = 01;
	if(!empty(Session::get('date'))) {
		$fdate = $postDate = Session::get('date');
	}
@endphp
<div class="aione-border mb-10">
	<div class="p-10 aione-align-right">
		<ul class="hrm-attendance-view-switch">
		    <li class="month-tab"><a href="#" onclick="attendance_filter(null, null, {{$current_month}} , {{$current_year}} )" class="hrm-attendance-monthly" id="monthly">Monthly</a></li>
		    <li class="week-tab" ><a href="#" onclick="attendance_filter(null, 1, {{$current_month}} , {{$current_year}} )" class="hrm-attendance-weekly" id="weekly">Weekly</a></li>
		    <li class="daily-tab" ><a href="#" onclick="attendance_filter(1, null, {{$current_month}} , {{$current_year}} )" class="hrm-attendance-daily" id="daily">Daily</a></li>
		</ul>		
	</div>
</div>

@if(empty($condition['date']) && empty($condition['week']) ) {{-- Month trey  --}}
	<div id="month">
		@include('organization.hrm.attendance.monthly-navigate')
	</div> 
@elseif(!empty($condition['week']))
	<div id="week">
		@include('organization.hrm.attendance.weekly-navigate')
	</div> 
@elseif(!empty($condition['date']))
	<div id="days">
		@include('organization.hrm.attendance.daily-navigate')
	</div>
@endif
@include('organization.hrm.attendance.hrm-attendance-view-data')
