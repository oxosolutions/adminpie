<div class="row design-bg valign-wrapper">
		<div class="col s2">
			<?php  
			 $dt = '1-'.$current_month.'-'.$current_year;
			// 		$ym = date('Y-m', strtotime($dt));
			 ?>
			 	<i class="fa fa-angle-left"></i>
				<a onclick="attendance_filter({{$daily_previous_date}}, null, {{$daily_previous_month}} , {{$daily_previous_year}} )" style="cursor: pointer;" name="date" value="{{$daily_previous_date}}" class="nav left-align">{{$daily_previous_date}}Previous Day</a>
		</div>
		<div class="col s8">
			<div class="aione aione-heading center-align">
				<i class="fa fa-calendar-o" aria-hidden="true" style="margin: 0px 10px"></i>
				<span class="design-style">{{date('F, Y', strtotime($dt))}}</span>
			</div>	
		</div>
		
		<div class="col s2">
			<div class="right-align">
				<a onclick="attendance_filter({{$daily_next_date}}, null, {{$daily_next_month}} , {{$daily_next_year}} )" style="cursor: pointer" name="date" value="{{$daily_next_date}}" class="nav right-align">{{$daily_next_date}}Next Day</a>
				<i class="fa fa-angle-right"></i>
			</div>
		</div>	 
		<div style="clear: both;">
		</div>
  	</div>
  	<div id="dates" class="aione-navigation-1">
		@for($i=1; $i<=$total_days; $i++)
			@if($postDate==$i)
				<a style="cursor: pointer; color:red;" href="javascript:void(0)" onclick="attendance_filter({{$i}}, null, {{$current_month}} , {{$current_year}} )" name="date"  > {{$i}}</a>

			@else
				<a style="cursor: pointer;" href="javascript:void(0)" onclick="attendance_filter({{$i}}, null, {{$current_month}} , {{$current_year}} )" name="date"  > {{$i}}</a>
			@endif
		@endfor
	</div>