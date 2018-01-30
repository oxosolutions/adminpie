@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
		'show_page_title' => 'yes',
		'show_add_new_button' => 'no',
		'show_navigation' => 'yes',
		'page_title' => 'Attendance',
		'add_new' => '+ Add Task'
	);
@endphp

@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('organization.profile._tabs')
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
		</div>
			
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
						
						@for($j=1; $j<=31; $j++ )
						<div class="display-inline-block bg-grey bg-lighten-3 aione-align-center mt-4 line-height-80 aione-border border-grey border border-lighten-1" style="width: calc( 14.28% - 4px);">{{$j}}</div>
						@endfor
						
					</div>
				</div>
			</div>	

			{{-- <div class="weekly p-20">
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
			</div> --}}
			
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
@include('common.page_content_primary_end')
		@include('common.page_content_secondry_start')
		@include('common.page_content_secondry_end')
		@include('common.pagecontentend')
		
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