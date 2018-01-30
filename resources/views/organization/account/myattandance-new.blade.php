@php
	$page_title_data = array(
		'show_page_title' => 'yes',
		'show_add_new_button' => 'no',
		'show_navigation' => 'yes',
		'page_title' => 'Attendance',
		'add_new' => '+ Add Task'
	);
@endphp
@extends('layouts.main')
@section('content')
<style type="text/css">
	
</style>
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')

@include('organization.profile._tabs')

	@php
	$now = Carbon\Carbon::now();
	$year= $now->year;
	$now->subMonth();
	$month = $now->month;
	if(strlen($month)==1)
	{
		$month = '0'.$month;
	}

	//$dt = Carbon\Carbon::create($now->year, $now->month, 1);
	//$beforeDay = $dt->dayOfWeek;
	@endphp
	<div class="ar">
		<div class="ac l50">
			<div class="aione-border mb-25 p-15">
				<div class="display-inline-block">
					Name :
				</div>
				<div class="display-inline-block">
					Ashish Kumar
				</div>
			</div>
		</div>
		<div class="ac l50">
			<div class="aione-border  mb-25 p-7">
				<div class="aione-float-right">
					<button class="aione-button bg-light-blue bg-darken-3 white ml-0" style="margin-right: -5px;background-color:rgb(243, 129, 115)">Yearly</button>
					<button class="aione-button bg-light-blue bg-darken-3 white ml-0" style="margin-right: -5px">Monthly</button>
					<button class="aione-button bg-light-blue bg-darken-3 white ml-0" style="margin-right: -5px">Weekly</button>
					
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<div class="ar">
		<div class="ac l100">
			<div class="aione-border mb-25">
				<div class="bg-grey bg-lighten-3 p-10 font-size-20 aione-border-bottom">
					View attendance
					<div class="aione-float-right font-size-16	">
						<button class="aione-button" style="margin-top: -10px">
							<i class="fa fa-chevron-left line-height-24 font-size-13"></i>
						</button>
							
						<span class="aione-align-center display-inline-block" style="width: 200px">1-12-2018 - 7-12-2018 </span>
						<button class="aione-button" style="margin-top: -10px">
							<i class="fa fa-chevron-right line-height-24 font-size-13"></i>
						</button>
					</div>
				</div>
				<div class="p-40">
					<div class="yearly p-40">
						<div class="font-size-9 ">

							<div class="font-size-10 display-inline-block line-height-0 aione-align-center" style="width: 50px">Days</div>
							@for($i=1; $i<=31; $i++)
							<div class=" display-inline-block box aione-align-center ">{{$i}}</div>
							@endfor
						</div>
						@for($i=1; $i<=12; $i++ )
							@if(strlen($i) ==1)
								@php
								$i ='0'.$i;
								@endphp
							@endif

							@php
								$postDate=1;
								$month_wise   = Carbon\Carbon::create($filter['year'], $i, $postDate, 0);
								$dayInMonth = $month_wise->daysInMonth;
							@endphp
							<div class="font-size-0" style="font-size: 0">
								<div class="font-size-10 display-inline-block line-height-0 aione-align-center" style="vertical-align: bottom;width: 50px">{{substr($month_wise->format(' F'),0,4)}}</div>
								@if(!empty($attendance_data[$i]))
									@php
										$val = collect($attendance_data[$i]);
										$data = $val->keyBy('date')->toArray();
									@endphp
									@for($j=1; $j<=$dayInMonth; $j++)
										
										@if(!empty($data[$j]['attendance_status']))
											@if($data[$j]['attendance_status']=='present')
												<div class="dark-green display-inline-block box ml-2 mt-2"></div>
											@elseif($data[$j]['attendance_status']=='absent')
												<div class="pale-yellow display-inline-block box ml-2 mt-2"></div>
											@elseif($data[$j]['attendance_status']=='Sunday')
												<div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2"></div>
											@elseif($data[$j]['attendance_status']=='leave')
												<div class="light-green display-inline-block box ml-2 mt-2"></div>
											@else
												<div class="light-green display-inline-block box ml-2 mt-2"></div>
											@endif
										@else
											<div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2"></div>
										@endif


									@endfor
								@else
									@for($j=1; $j<=$dayInMonth; $j++)
										<div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2"></div>
									@endfor
								@endif
							
							</div>
						@endfor	
					</div>
					@php
					$now = Carbon\Carbon::now();
					$where['year'] = $now->year;
					$month = $now->month;
					if(strlen($month)==1)
					{
						$month = '0'.$month;
					}
					$dayInMonth = $now->daysInMonth;
					$dt = Carbon\Carbon::create($now->year, $now->month, 1);
					$beforeDay = $dt->dayOfWeek;
					if(!empty($attendance_data[$month])){
						$val = collect($attendance_data[$month]);
						$data = $val->keyBy('date')->toArray();
					}

					@endphp
					<div id="monthly-attendance" class="monthly p-40">
						<div class="aione-border">
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
								@for($i=1; $i<$beforeDay; $i++)
									<li class="white-text">.</li>
								@endfor
								@for($j=1; $j<=$dayInMonth; $j++ )
								<div class="display-inline-block bg-grey bg-lighten-3 aione-align-center mt-4 line-height-80 aione-border border-grey border border-lighten-1" style="width: calc( 14.28% - 4px);">{{$j}}</div>
								@endfor
								
							</div>
						</div>
					</div>	

					<div class="weekly p-20">
						<div class=" aione-align-center aione-line-wrapper mb-20" style="position: relative;">
							<div class="display-inline-block line-height-30 aione-float-left">
								Mon,05  |  Check in : 9:10 am  
							</div>
							<div class="white display-inline-block line-height-30 bg-green ph-100">
								Present
							</div>
							<div class="display-inline-block aione-float-right line-height-30">
								Check out : 9:10 am | 8:21 Hours Total
							</div>
							<div class="clear"></div>
						</div>
						<div class=" aione-align-center aione-line-wrapper mb-20" style="position: relative;">
							<div class="display-inline-block line-height-30 aione-float-left">
								Mon,05  |  Check in : 9:10 am  
							</div>
							<div class="white display-inline-block line-height-30 bg-green ph-100">
								Present
							</div>
							<div class="display-inline-block aione-float-right line-height-30">
								Check out : 9:10 am | 8:21 Hours Total
							</div>
							<div class="clear"></div>
						</div>
						<div class=" aione-align-center aione-line-wrapper mb-20" style="position: relative;">
							<div class="display-inline-block line-height-30 aione-float-left">
								Mon,05  |  Check in : 9:10 am  
							</div>
							<div class="white display-inline-block line-height-30 bg-green ph-100">
								Present
							</div>
							<div class="display-inline-block aione-float-right line-height-30">
								Check out : 9:10 am | 8:21 Hours Total
							</div>
							<div class="clear"></div>
						</div>
					</div>
					
					<div class="weekly p-20">
						<ul>
							<li class="ar p-10">
								<div class="ac l20">
									Days
								</div>
								<div class="ac l20">
									Check In
								</div>
								<div class="ac l20">
									Check Out
								</div>
								<div class="ac l20">
									Total Hours
								</div>
								<div class="ac l20">
									Attendance Status
								</div>
							</li>
							<li class="ar p-10">
								<div class="ac l20 p-10">
									13 March
								</div>
								<div class="ac l20 p-10">
									9:00
								</div>
								<div class="ac l20 p-10">
									17:00
								</div>
								<div class="ac l20 p-10">
									8:20 
								</div>
								<div class="ac l20 bg-green white p-10 aione-align-center">
									Present
								</div>
							</li>
							<li class="ar p-10">
								<div class="ac l20 p-10">
									13 March
								</div>
								<div class="ac l20 p-10">
									9:00
								</div>
								<div class="ac l20 p-10">
									17:00
								</div>
								<div class="ac l20 p-10">
									8:20 
								</div>
								<div class="ac l20 bg-green white p-10 aione-align-center">
									Present
								</div>
							</li>
							<li class="ar p-10">
								<div class="ac l20 p-10">
									13 March
								</div>
								<div class="ac l20 p-10">
									9:00
								</div>
								<div class="ac l20 p-10">
									17:00
								</div>
								<div class="ac l20 p-10">
									8:20 
								</div>
								<div class="ac l20 bg-green white p-10 aione-align-center">
									Present
								</div>
							</li>
						</ul>
					</div>
					
				</div>
			</div>
		</div>
	</div>

		<div class="row">
			
			@if(!empty($error))
			<div class="aione-message warning">
				{{$error}}	
			</div>
			
			@else
			<input id="token" type="hidden" name="_token" value="{{csrf_token()}}" >
			<div class="row">
				<div class="col l12 pr-7">
					<div class="card">
						<div class="row mt-14" >
							<div class="col l6">
								<h5>Attendence (Yearly)</h5>
							</div>
							<div class="col l6 right-align">
								<a href="javascript:;" onclick="attendance_weekly_filter('1', {{$month}}, {{$year}})" class="btn blue" id="weekly">Weekly</a>
								<a href="javascript:;" onclick="attendance_monthly_filter({{$month}}, {{$year}})" class="btn blue" id="monthly">monthly</a>
								<a href="javascript:;" class="btn blue" id="yearly">Yearly</a>
							</div>
						</div>


					
						<div id="yearly_data" class="row year-view">
							<div class="font-size-9 ">
								<div class="font-size-10 display-inline-block line-height-0 aione-align-center" style="width: 50px">Days</div>
								@for($i=1; $i<=31; $i++)
								<div class=" display-inline-block box aione-align-center ">{{$i}}</div>
								@endfor
							</div>
							@for($i=1; $i<=12; $i++ )
								@if(strlen($i) ==1)
									@php
									$i ='0'.$i;
									@endphp
								@endif

								@php
									$postDate=1;
									$month_wise   = Carbon\Carbon::create($filter['year'], $i, $postDate, 0);
									$dayInMonth = $month_wise->daysInMonth;
								@endphp
								<div class="font-size-0" style="font-size: 0">
									<div class="font-size-10 display-inline-block line-height-0 aione-align-center" style="vertical-align: bottom;width: 50px">{{substr($month_wise->format(' F'),0,4)}}</div>
									@if(!empty($attendance_data[$i]))
										@php
											$val = collect($attendance_data[$i]);
											$data = $val->keyBy('date')->toArray();
										@endphp
										@for($j=1; $j<=$dayInMonth; $j++)
											
											@if(!empty($data[$j]['attendance_status']))
												@if($data[$j]['attendance_status']=='present')
													<div class="dark-green display-inline-block box ml-2 mt-2"></div>
												@elseif($data[$j]['attendance_status']=='absent')
													<div class="pale-yellow display-inline-block box ml-2 mt-2"></div>
												@elseif($data[$j]['attendance_status']=='Sunday')
													<div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2"></div>
												@elseif($data[$j]['attendance_status']=='leave')
													<div class="light-green display-inline-block box ml-2 mt-2"></div>
												@else
													<div class="light-green display-inline-block box ml-2 mt-2"></div>
												@endif
											@else
												<div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2"></div>
											@endif


										@endfor
									@else
										@for($j=1; $j<=$dayInMonth; $j++)
											<div class="bg-grey bg-lighten-2 display-inline-block box ml-2 mt-2"></div>
										@endfor
									@endif
								
								</div>
							@endfor
							<div class="row m-20" >
								<div class=" col l5 right-align">
									<i class="fa fa-arrow-left lh-44" onclick="attendance_yearly_filter({{$filter['year']-1}})" ></i>
								</div>
								<div class="col l2 center-align">
									<h5><a  id='year_display' class='dropdown-button' href='#' data-activates='dropdown1'>{{@$filter['year']}}</a></h5>

									<!-- Dropdown Structure -->
									<ul id='dropdown1' class='dropdown-content'>
										<li>
											<button onclick="attendance_yearly_filter('2016')"> 2016</button>
										</li>
										<li>
											<button onclick="attendance_yearly_filter('2017')"> 2017</button>
										</li>
										<li>
											<button onclick="attendance_yearly_filter('2018')"> 2018</button>
										</li>
										<li>
											<button onclick="attendance_yearly_filter('2019')"> 2019</button>
										</li>
										<li><button onclick="attendance_yearly_filter('2020')"> 2020</button></li>
									</ul>

								</div>
								<div class="col l5">
									<i class="fa fa-arrow-right lh-44" onclick="attendance_yearly_filter({{$filter['year']+1}})"></i>
								</div>
							</div>

							<div id="attendance-data" class="row center-align mt-30" >
								<div class="line">
									<div class='mo'>Day</div>
									@for($i=1; $i<=31; $i++)
									<div class='square days'>{{$i}}</div>
									@endfor
								</div>
								@for($i=1; $i<=12; $i++ )
									@if(strlen($i) ==1)
										@php
										$i ='0'.$i;
										@endphp
									@endif

									@php
										$postDate=1;
										$month_wise   = Carbon\Carbon::create($filter['year'], $i, $postDate, 0);
										$dayInMonth = $month_wise->daysInMonth;
									@endphp
									<div class="line">
										<div class='mo'>{{substr($month_wise->format(' F'),0,4)}}</div>
											@if(!empty($attendance_data[$i]))
												@php
													$val = collect($attendance_data[$i]);
													$data = $val->keyBy('date')->toArray();
												@endphp
												@for($j=1; $j<=$dayInMonth; $j++)
													@if(!empty($data[$j]['attendance_status']))
														@if($data[$j]['attendance_status']=='present')
															<div class='square present'>p</div>
														@elseif($data[$j]['attendance_status']=='absent')
															<div class='square absent'>a</div>
														@elseif($data[$j]['attendance_status']=='Sunday')
															<div class='square sunday'>s</div>
														@elseif($data[$j]['attendance_status']=='leave')
															<div class='square leave'>l</div>
														@else
															<div class='square leave'>0</div>
													@endif
													@else
														<div class='square empty'>{{$j}}</div>
													@endif
												@endfor
											@else
												@for($j=1; $j<=$dayInMonth; $j++)
												<div class='square empty'>{{$j}}</div>
												@endfor
											@endif
										</div>
										
								@endfor
							</div>
						</div>
					
						@php
						$now = Carbon\Carbon::now();
						$where['year'] = $now->year;
						$month = $now->month;
						if(strlen($month)==1)
						{
							$month = '0'.$month;
						}
						$dayInMonth = $now->daysInMonth;
						$dt = Carbon\Carbon::create($now->year, $now->month, 1);
						$beforeDay = $dt->dayOfWeek;
						if(!empty($attendance_data[$month])){
							$val = collect($attendance_data[$month]);
							$data = $val->keyBy('date')->toArray();
						}

						@endphp
						<div id="monthly-attendance" class="row month-view ph-40 pv-20" >
							<div class="row">

							</div>
							<div class="row " style="border: 1px solid #CCC">
								<div class="month">
									<ul>
										<li class="prev"><i class="fa fa-arrow-left" ></i></li>
										<li class="next"><i class="fa fa-arrow-right" ></i></li>
										<li class="center-align">
											{{$now->format('F')}},
											<span  class="fs-18">{{$now->year}}</span>
										</li>
									</ul>
								</div>
								<ul class="weekdays">
									<li>Mo</li>
									<li>Tu</li>
									<li>We</li>
									<li>Th</li>
									<li>Fr</li>
									<li>Sa</li>
									<li>Su</li>
								</ul>
								<ul class="days">
									@for($i=1; $i<$beforeDay; $i++)
									<li class="white-text">.</li>
									@endfor

									@for($j=1; $j<=$dayInMonth; $j++ )
									<li style="background-color: rgba(0,128,0,0.2);">{{$j}}</li>
									@endfor

								</ul>
							</div>
						</div>
					
						<div id="attendance-weekly" class="row week-view">
							<div class="row center-align mt-40" >
								<span><i class="fa fa-arrow-left mr-10 lh-36" ></i></span>
								<span>04-Jun-2017 - 10-Jun-2017</span>
								<span><i class="fa fa-arrow-right ml-10" ></i></span>
								<span><a href="" class="btn-flat mr-14" style="position: absolute;right: 0px;border: 1px solid #e8e8e8;">Check In</a></span>
							</div>
							<div class="row" >
								<div class="row center-align p-10">
									<div class="col l2">
										Mon,05
									</div>
									<div class="col l8 present">
										<div class="aione-line-bg">
											<span class="absence-status">Present</span>
										</div>
									</div>
									<div class="col l2">
										08:12Hrs
									</div>
								</div>
								<div class="row center-align p-10" >
									<div class="col l2 ">
										Tues,06
									</div>
									<div class="col l8 present">
										<div class="aione-line-bg">
											<span class="absence-status">Present</span>
										</div>
									</div>
									<div class="col l2">
										08:12Hrs
									</div>
								</div>
								<div class="row center-align p-10" >
									<div class="col l2">
										Wed,07
									</div>
									<div class="col l8 present">
										<div class="aione-line-bg">
											<span class="absence-status">Present</span>
										</div>
									</div>
									<div class="col l2">
										08:12Hrs
									</div>
								</div>
								<div class="row center-align p-10" >
									<div class="col l2">
										Thru,08
									</div>
									<div class="col l8">
										<div class="aione-line-bg">
											<span class="absence-status">Absent</span>
										</div>
									</div>
									<div class="col l2">
										08:12Hrs
									</div>
								</div>
								<div class="row center-align p-10">
									<div class="col l2">
										Fri,09
									</div>
									<div class="col l8 present">
										<div class="aione-line-bg">
											<span class="absence-status">Present</span>
										</div>
									</div>
									<div class="col l2">
										08:12Hrs
									</div>
								</div>
								<div class="row center-align p-10" >
									<div class="col l2">
										Sat,10
									</div>
									<div class="col l8 weekend">
										<div class="aione-line-bg">
											<span class="absence-status">Weekend</span>
										</div>
									</div>
									<div class="col l2">
										08:12Hrs
									</div>
								</div>
								<div class="row center-align p-10" >
									<div class="col l2">
										Sun,11
									</div>
									<div class="col l8 weekend">
										<div class="aione-line-bg">
											<span class="absence-status">Weekend</span>
										</div>
									</div>
									<div class="col l2">
										08:12Hrs
									</div>
								</div>
							</div>
						</div>
						


					</div>
				</div>

			</div>
			@endif
		</div>
		@include('common.page_content_primary_end')
		@include('common.page_content_secondry_start')
		@include('common.page_content_secondry_end')
		@include('common.pagecontentend')
		<style type="text/css">
			/*td, th{
				padding: 0px !important;
				border: 2px solid #FFF;
				font-size: 12px;
				max-width: 0px;
				text-align: center;
				line-height: 25px;
				border-radius: 8px
			}*/
			.absence-status{
				border: 1px solid #f0989a;padding: 5px 25px;
				font-size: 13px;
				color: #696969;
				border-radius: 4px;
				position: absolute;
				top: 50%;
				left: 50%;
				min-width: 120px;
				margin-top: -16.5px;
				margin-left: -60px;
				background-color: white;
			}
			.aione-line-bg{
				background-color: #f0989a;height: 1px;overflow: inherit;position: relative;top: 10px;
			}
			.present .absence-status{
				border-color: green
			}
			.present .aione-line-bg{
				background-color: green;
			}
			.weekend .absence-status{
				border-color: orange
			}
			.weekend .aione-line-bg{
				background-color: orange;
			}
			/**********************************STARTS Css for month view in attendence  *********************************************/
			.month-view ul {list-style-type: none;}

			.month-view .month {

				width: 100%;

				padding: 20px;

			}
			.month-view .month ul {
				margin: 0;
				padding: 0;
			}
			.month-view .month ul li {

				font-size: 20px;
				text-transform: uppercase;
				letter-spacing: 3px;
			}
			.month-view .month .prev {
				float: left;

			}
			.month-view .month .next {
				float: right;

			}
			.month-view .weekdays {
				margin: 0;
				padding: 10px 0;
				background-color: #eee

			}
			.month-view .weekdays li {
				display: inline-block;
				width: 13.6%;
				color: #666;
				text-align: center;
				line-height: 40px;
			}
			.month-view .days {


				margin: 3px;
			}
			.month-view .days li {
				list-style-type: none;
				display: inline-block;
				width: 13.6%;
				text-align: center;
				margin-bottom: 3px;
				font-size:12px;
				color: #777;
				line-height: 40px
			}
			.month-view .days li .active {
				padding: 5px;
				background: #1abc9c;
				color: white !important;
				padding: 10px;
			}
			/**********************************ENDS Css for month view in attendence  *********************************************/
			.p-10{
				padding:10px
			}
			.mt-14{
				margin-top: 14px
			}
			.m-20{
				margin: 20px
			}
			.lh-44{
				line-height: 44px
			}
			.mt-30{
				margin-top: 30px
			}
			.ph-40{
				padding-left: 40px;
				padding-right: 40px
			}
			.pv-20{
				padding-top: 20px;
				padding-bottom: 20px
			}
			.ml-20{
				margin-left: 10px
			}
			.mr-14{
				margin-right: 14px
			}
			.mr-10{
				margin-right: 10px
			}
			.lh-36{
				line-height: 36px
			}
			.mt-40{
				margin-top: 40px
			}
			.fs-18{
				font-size:18px
			}
		</style>
		<script>
			function attendance_yearly_filter(year)
			{
				postData ={};
				postData['year']  = year;
				postData['_token'] = $("#token").val();
				$.ajax({
					url:route()+'/attendance',
					type:'POST',
					data:postData,
					success:function(res){
						$("#year_display").html(year);
						$('#yearly_data').html(res);
					}
				});

			}
			function attendance_monthly_filter(month, year)
			{
				postData ={};
				postData['month'] = month;
				postData['year']  = year;
			//postData['month_week_no'] = week;
			postData['_token'] = $("#token").val();
			console.log(postData);
			$.ajax({
				url:route()+'/attandance_monthly',
				type:'POST',
				data:postData,
				success:function(res){
					$('#monthly-attendance').html(res);
				}
			});

		}
		function attendance_weekly_filter(week_no, month, year)
		{
			postData ={};
			postData['month'] = month;
			postData['year']  = year;
			postData['month_week_no'] = week_no;
			postData['_token'] = $("#token").val();
			console.log(postData);
			$.ajax({
				url:route()+'/attandance_weekly',
				type:'POST',
				data:postData,
				success:function(res){
					$('#attendance-weekly').html(res);
				}
			});

		}
		// 	function attendance_filter(date, week, mo, yr)
	// {
		// 	console.log(date, week, mo, yr);
		
		// 	var postData = {};
		// 	postData['date'] = date;
		// 	postData['week'] = week;
		// 	postData['month'] = mo;
		// 	postData['years'] = yr;
		// 	postData['_token'] = $("#token").val();
		// 	$.ajax({
				// 			url:route()+'/attendance/list',
				// 			type:'POST',
				// 			data:postData,
				// 			success: function(res){
					// 				$("#main").html(res);
					// 				$("#month , #week ,#days").hide();
					// 				if(date)
					// 				{
						// 					$("#days").show();
					// 				}else if(week){
						// 					$("#week").show();
					// 				}else{
						// 					$("#month").show();
					// 				}
					// 				$('select').material_select();

					// 				console.log('data sent successfull');
				// 			}
			// 		});
		// 	}
	</script>


	<style>
		.line{
			width: 100%;
			display: flex;
		}
		.mo{
			width: 5%;
			height: 18px;
			display: block;
			float: left;
			margin-right: 2px;
			font-size: 13px;
		}
		.square{
			width: 15px;
			height: 15px;
			display: block;
			float: left;
			margin-left: 2px;
			margin-right: 2px;
			margin-bottom: 4px;
		}
		.present{
			background-color: green;
			color: green;
			font-size: 1px;
		}
		.absent{
			background-color: red;
			color: red;
			font-size: 1px;
		}
		.leave{
			background-color: orange;
			color:orange;
			font-size: 1px;
		}
		.holiday{
			background-color: yellow;
			color:yellow;
			font-size: 1px;
		}
		.sunday{
			background-color: pink;
			color:pink;
			font-size: 1px;
		}
		.empty{
			background-color: grey;
			color:grey;
			font-size: 1px;
		}
		.days{
			font-size: 13px;
		}
		.box{
			height: 14px;
			width: 14px
		}
		.bg-grey-light{
			background-color:rgb(238, 238, 238);
		}
		.dark-green{
			background-color: rgb(30, 104, 35)
		}
		.normal-green{
			background-color: rgb(68, 163, 64)
		}
		.light-green{
			background-color: rgb(140, 198, 101)
		}
		.pale-yellow{
			background-color: rgb(214, 230, 133)
		}
	</style>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.month-view').hide();
			$(".week-view").hide();
			$("#weekly").click(function(){
				$('.month-view').hide();
				$('.week-view').show();
				$(".year-view").hide();
			});
			$("#monthly").click(function(){
				$('.week-view').hide();
				$('.year-view').hide();
				$(".month-view").show();
			});
			$("#yearly").click(function(){
				$('.year-view').show();
				$('.month-view').hide();
				$(".week-view").hide();
			});
		});
	</script>

	@endsection