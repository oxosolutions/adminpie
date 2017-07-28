@extends('layouts.main')
@section('content')

@php

	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Dashboard',
	'add_new' => '+ Add Widget'
	); 
@endphp

@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')

<div>
		<div class="row">
			@foreach($model as $key => $value)
				<div class="col l3 pr-7">
					<div class="card shadow mt-0" style="">
						<div class="row center-align aione-widget-header" ><h5 class="m-0"><a href="{{route($value['route'])}}">{{ucfirst($key)}}</a></h5></div>
						<div class="row center-align aione-widget-content" >{{$value['count']}} </div>
						<div class="row center-align aione-widget-footer" >
							<a href="{{route($value['route'])}}" class="btn" style="background-color: #005A8B">All {{$key}}</a>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div> 
	<div class="row">	
		<div class="col l6 pr-7">
			<div class="card center-align chk-n-out" >
				<input id="token" type="hidden" name="_token" value="{{csrf_token()}}" >
				<input type="hidden" class="status" value="{{$check_in_out_status}}" >
				<button href="javascript:;" status="check_in" class="checkInOut blue aione-btn" id="check_in" style="">
					<span>
						<span >
							<i class="fa fa-clock-o" style="font-size: 22px;"></i>
						</span>
						<span>
								<span style="font-size: 18px;margin-left: 5px">Check-In</span>
						</span>
					</span>
				</button>
				
				<button  status="check_out" class="checkInOut grey darken-2" id="check_out" style="display: inline-block;color: white;margin: 0 auto;padding: 8px 20px">
					<span>
						<span >
							<i class="fa fa-clock-o" style="font-size: 22px;"></i>
						</span>
						<span>
								<span style="font-size: 18px;margin-left: 5px">Check-Out</span>
						</span>
					</span>
				</button>
			</div>

		</div>
		
		
	</div>
	<div class="row">
		<div class="col l3">
			<div class="card shadow mt-0" style="border:1px solid #e1e1e1">
				<div class="center-align aione-widget-header" ><h5 class="m-0"><a href="#">Working Hours</a></h5></div>
				<div class="count">
					<span>11:02:06 Hrs</span>
				</div>
				<div class="in-out-button">
					<a href="">
						<i class="material-icons dp48">access_alarm</i>
						<div>
							<div style="font-size: 26px;color: white">
								Check In
							</div>
							<div style="color: white;font-size: 14px;line-height: 7px;">
								11:20:00 AM
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
	

	





@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

<style type="text/css">
		.count span{
			font-size: 32px;
			font-weight: 900;
			color: #8E8E8E;
			padding: 20px 0px;
			display: block;
    		text-align: center;
    		border-bottom: 1px solid #e8e8e8;
		}
		.in-out-button{
			padding: 14px;
			
		}
		.in-out-button a{
			display: block;
   			background-color: #00BC9B;
   			padding: 7px 30px;
		}
		.in-out-button a i{
			color: white;
			    font-size: 50px;
		}
		.in-out-button a > div{
			display: block;
			float: right;
		}
		.aione-widget-header{
			border-bottom: 1px solid #e8e8e8;cursor: pointer;
		}
		.aione-widget-header a{
			padding: 10px;color: black;display: block
		}
		.aione-widget-content{
			border-bottom: 1px solid #e8e8e8;padding: 10px;font-size: 72px
		}
		.aione-widget-footer{
			padding: 10px
		}
		.mt-0{
			margin-top: 0px;
		}
		.m-0{
			margin: 0px;
		}
		.aione-btn{
			display: inline-block;color: white;margin: 0 auto;padding: 8px 20px;
		}
		
	</style>
	<script type="text/javascript">
		 
	$(document).ready(function() {


		
		status = $(".status").val();
		if(status=='check_in')
		{
			$("#check_out").show();
			$("#check_in").hide();
		}else if(status=='not_employ'){
				$(".chk-n-out").hide();
			$("#check_in").hide();
		}else{
			$("#check_out").hide();
			$("#check_in").show();
		}

		$('#calendar').fullCalendar({
			
		});
		
	});

	$(document).on('click','.checkInOut',function(e){

		status = $(this).attr('status');
		postdata ={}; 
		postdata['_token'] = $("#token").val();
		postdata['status'] = status;
		$.ajax({
			url:route()+'hrm/attendance/check_in_out',
			type:'POST',
			data:postdata,
			success:function(res)
			{	
				$("#check_out , #check_in").show();
				 $("#"+status).hide();
				//$("#"+status).hide();
				// if(status=='check_in'){
					
				//  }else{
				// 	$("#check_in").show();
				//  }

				
			}
		});
	});

	// function checkInOut(e)
	// {	
	// 	e.preventDefault();
	// 	 token = $("#token").val();
	// 	$.ajax({
	// 		url:route()+'attendance/check_in_out',
	// 		type:'POST',
	// 		data:{'checkInOut':'check','token':token},
	// 		success:function(res)
	// 		{
	// 			console('success');
	// 		}
	// 	});
		
		
 //    }
	</script>


@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection