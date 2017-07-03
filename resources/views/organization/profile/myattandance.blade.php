@extends('layouts.main')
@section('content')
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
		width: 2.1%;
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
	<div class="row">
		@include('organization.profile._tabs')
		<input id="token" type="hidden" name="_token" value="{{csrf_token()}}" >

		<div class="row">
			<div class="col l9 pr-7">
				<div class="card">
					<div class="row" style="margin-top: 14px ">
						<div class="col l6">
							<h5>Attendence (Yearly)</h5>
						</div>
						<div class="col l6">
							<a href="javascript:;" onclick="attendance_weekly_filter('1', {{$month}}, {{$year}})" class="btn blue" id="weekly">Weekly</a>
							<a href="javascript:;" onclick="attendance_monthly_filter({{$month}}, {{$year}})" class="btn blue" id="monthly">monthly</a>
							<a href="javascript:;" class="btn blue" id="yearly">Yearly</a>
						</div>	
					</div>

						
					{{--- YEARLY STARTS --}}
		<div class="row year-view">
			<div class="row" style="margin: 20px">
				<div class=" col l5 right-align">
					<i class="fa fa-arrow-left" style="line-height: 44px"></i>
				</div>
				<div class="col l2 center-align">
					<h5><a class='dropdown-button' href='#' data-activates='dropdown1'>{{$filter['year']}}</a></h5>
					 

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
					<i class="fa fa-arrow-right" style="line-height: 44px"></i>
				</div>
			</div>	
		
			<div id="attendance-data" class="row center-align" style="margin-top: 30px">
			<div class="line"><div class='mo'>Day</div>
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
										
											{{-- {{substr($data[$j]['attendance_status'], 0,1)}} --}}
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
					{{-- YEARLY ENDS --}}

	


					{{-- MONTHLY STARTS --}}

					@php
					$now = Carbon\Carbon::now();
			       echo  $where['year'] = $now->year;
			         $month = '06';//.$now->month;
			       $dayInMonth = $now->daysInMonth;

			        $dt = Carbon\Carbon::create($now->year, $now->month, 1);
			       $beforeDay = $dt->dayOfWeek;

			       							$val = collect($attendance_data[$month]);
											$data = $val->keyBy('date')->toArray();
					@endphp
					<div id="monthly-attendance" class="row month-view" style="padding: 20px 40px">
						<div class="row">
							
						</div>
						<div class="row" style="border: 1px solid #CCC">
							<div class="month">      
							  <ul>
							    <li class="prev"><i class="fa fa-arrow-left" ></i></li>
							    <li class="next"><i class="fa fa-arrow-right" ></i></li>
							    <li style="text-align:center">
							      {{$now->format('F')}},
							      <span style="font-size:18px">{{$now->year}}</span>
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
							<li style="color:white;">.</li>
							@endfor
							
							@for($j=1; $j<=$dayInMonth; $j++ )
							<li style="background-color: rgba(0,128,0,0.2);">{{$j}}</li>
							@endfor
							  
							</ul>

						</div>
					</div>
					{{-- MONTHLY ENNDS --}}

					{{-- WEEKLY STARTS --}}
					<div id="attendance-weekly" class="row week-view">
						<div class="row center-align" style="margin-top: 40px">
							<span><i class="fa fa-arrow-left" style="margin-right: 10px;line-height: 36px"></i></span>
							<span>04-Jun-2017 - 10-Jun-2017</span>
							<span><i class="fa fa-arrow-right" style="margin-left: 10px"></i></span>
							<span><a href="" class="btn-flat" style="position: absolute;right: 0px;border: 1px solid #e8e8e8;margin-right: 14px;">Check In</a></span>
						</div>
						<div class="row" >
							<div class="row center-align" style="padding:10px ">
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
							<div class="row center-align" style="padding:10px ">
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
							<div class="row center-align" style="padding:10px ">
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
							<div class="row center-align" style="padding:10px ">
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
							<div class="row center-align" style="padding:10px ">
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
							<div class="row center-align" style="padding:10px ">
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
							<div class="row center-align" style="padding:10px ">
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
					{{-- WEEKLY ENDS --}}
					
					
				</div>
			</div>
			<div class="col l3 pl-7">
				<div class="card" style="margin-top: 14px">
					<div class="row">
						<span style="font-weight: 600;padding: 10px 5px;display: block;border-bottom: 1px solid #e8e8e8">Attendence Stats</span>
					</div>
					<div class="row">
						<div class="row" style="padding: 10px 5px;">
							<div class="col l9">
								Leaves	
							</div>
							<div class="col l3 center-align">
								<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="red white-text ">32</span>
							</div>
							
						</div>
						<div class="divider">
							
						</div>
						<div class="row" style="padding: 10px 5px;">
							<div class="col l9">
								Extra Time	
							</div>
							<div class="col l3 center-align">
								<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="orange white-text ">187 Hours</span>
							</div>
							
						</div>
						<div class="divider">
							
						</div>
						<div class="row" style="padding: 10px 5px;">
							<div class="col l9">
								Working Days
							</div>
							<div class="col l3 center-align">
								<span style="padding: 4px 8px; font-size: 10px;border-radius: 3px" class="green white-text ">189</span>
							</div>
							
						</div>
					</div>
				</div>
					
			</div>
		</div>
	</div>
	<style type="text/css">
		td, th{
			padding: 0px !important;
			    border: 2px solid #FFF;
			    font-size: 12px;
			    max-width: 0px;
			    text-align: center;
			        line-height: 25px;
			        border-radius: 8px
		}
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
	</style>

	<script>
		function attendance_yearly_filter(year)
		{
			postData ={};
			//postData['month'] = month;
			postData['year']  = year;
			//postData['month_week_no'] = week;
			postData['_token'] = $("#token").val();
			console.log(postData);
			$.ajax({
					url:route()+'/attandance',
					type:'POST',
					data:postData,
					success:function(res){
						$('#attendance-data').html(res);

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
@endsection