@php
if(!empty($date_handling)){
	extract($date_handling);
dump($condition); 
	
}

		$postDate = 01;
		if(!empty(Session::get('date')))
		{
		 	$fdate = $postDate = Session::get('date');
		}
			
@endphp
<div class="aione-border mb-10">
	<div class="p-10 aione-align-right">
		<ul class="hrm-attendance-view-switch">
		    <li class="active"><a href="#" onclick="attendance_filter(null, null, {{$current_month}} , {{$current_year}} )" class="hrm-attendance-monthly" id="monthly">Monthly</a></li>
		    <li><a href="#" onclick="attendance_filter(null, 1, {{$current_month}} , {{$current_year}} )" class="hrm-attendance-weekly" id="weekly">Weekly</a></li>
		    <li><a href="#" onclick="attendance_filter(1, null, {{$current_month}} , {{$current_year}} )" class="hrm-attendance-daily" id="daily">Daily</a></li>
		</ul>		
	</div>
</div>
{{-- Month trey  --}}
<div id="month">
	@include('organization.hrm.attendance.monthly-navigate')
</div> 
{{-- week trey  --}}
<div id="week">
	@include('organization.hrm.attendance.weekly-navigate')
</div> 
{{-- Day trey  --}}
<div id="days">
	@include('organization.hrm.attendance.daily-navigate')
</div>
@include('organization.hrm.attendance.hrm-attendance-view-data')