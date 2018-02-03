{{-- MONTHLY STARTS --}}

@php
	$dt = Carbon\Carbon::create($filter['year'], $filter['month'], 1);
	$current_mo = $dt->format('F');
	$current_yr =$dt->year;
	$beforeDay = $dt->dayOfWeek;
	$dayInMonth = $dt->daysInMonth;
	$dt->subMonth();
	$previous_mo = $dt->month;
	$previous_yr = $dt->year;
	$dt->addMonths(2);
	$nxt_mo = $dt->month;
	$nxt_yr = $dt->year;
// 						$val = collect($attendance_data[$month]);
					// $data = $val->keyBy('date')->toArray();

@endphp
<div class="aione-border">
	<div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom mb-30">
			Monthly Attendance View 
			<div class="aione-float-right font-size-16	">
				<button class="aione-button monthly" year="{{$previous_yr}}" month="{{$previous_mo}}" style="margin-top: -10px">
					<i class="fa fa-chevron-left line-height-24 font-size-13"  ></i>
				</button>
				<span id="year_display"  class="aione-align-center display-inline-block" style="width: 200px">{{$current_mo}}, {{$current_yr}} </span>
				<button class="aione-button monthly" style="margin-top: -10px" year="{{$nxt_yr}}" month="{{$nxt_mo}}">
					<i class="fa fa-chevron-right line-height-24 font-size-13"  ></i>
				</button>
			</div>
		</div>
	<div class="font-size-16 font-weight-600 aione-align-center pv-20">
		<div class="display-inline-block " style="width: calc( 14.28% - 5px);">Sunday</div>
		<div class="display-inline-block " style="width: calc( 14.28% - 5px)">Monday</div>
		<div class="display-inline-block " style="width: calc( 14.28% - 5px)">Tuesday</div>
		<div class="display-inline-block " style="width: calc( 14.28% - 5px)">Wednesday</div>
		<div class="display-inline-block " style="width: calc( 14.28% - 5px)">Thrusday</div>
		<div class="display-inline-block " style="width: calc( 14.28% - 5px)">Friday</div>
		<div class="display-inline-block " style="width: calc( 14.28% - 5px)">Saturday</div>
	</div>
	<div class="ml-4">
		@for($i=1; $i<=$beforeDay; $i++)
			<div class="display-inline-block bg-grey bg-lighten-3 aione-align-center mt-4 line-height-80 aione-border border-grey border border-lighten-1" style="width: calc( 14.28% - 4px);">.</div>
		@endfor
		@for($j=1; $j<=$dayInMonth; $j++ )
		@if(!empty($attendance_data[$j]['attendance_status']))
			@if($attendance_data[$j]['attendance_status']=='present')
				<div class="dark-green display-inline-block bg-grey  aione-align-center mt-4 line-height-80 aione-border border-grey border border-lighten-1" style="width: calc( 14.28% - 4px);">{{$j}}
			</div>			
			@elseif($attendance_data[$j]['attendance_status']=='absent')
				<div class="display-inline-block bg-grey bg-lighten-3 aione-align-center mt-4 line-height-80 aione-border border-grey border border-lighten-1" style="width: calc( 14.28% - 4px);">{{$j}}</div>			
			@elseif($attendance_data[$j]['attendance_status']=='Sunday')
				<div class="display-inline-block bg-grey bg-lighten-3 aione-align-center mt-4 line-height-80 aione-border border-grey border border-lighten-1" style="width: calc( 14.28% - 4px);">{{$j}}</div>
			@elseif($attendance_data[$j]['attendance_status']=='leave')
				<div class="display-inline-block bg-grey bg-lighten-3 aione-align-center mt-4 line-height-80 aione-border border-grey border border-lighten-1" style="width: calc( 14.28% - 4px);">{{$j}}</div>			
			@else
				<div class="display-inline-block bg-grey bg-lighten-3 aione-align-center mt-4 line-height-80 aione-border border-grey border border-lighten-1" style="width: calc( 14.28% - 4px);">{{$j}}</div>			@endif
		@else
		<div class="display-inline-block bg-grey bg-lighten-3 aione-align-center mt-4 line-height-80 aione-border border-grey border border-lighten-1" style="width: calc( 14.28% - 4px);">{{$j}}</div>
		@endif
			
		@endfor
	</div>
</div>
					
					{{-- MONTHLY ENNDS --}}
