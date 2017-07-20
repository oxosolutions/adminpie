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
					<div class="card shadow" style="margin-top: 0px;">
						<div class="row center-align aione-widget-header" ><h5 style="margin: 0px"><a href="{{route($value['route'])}}" style="display: block">{{ucfirst($key)}}</a></h5></div>
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
			<div class="card center-align chk-n-out" style="padding: 14px">
				<input id="token" type="hidden" name="_token" value="{{csrf_token()}}" >
				<input type="hidden" class="status" value="{{$check_in_out_status}}" >
				<button href="javascript:;" status="check_in" class="checkInOut blue" id="check_in" style="display: inline-block;color: white;margin: 0 auto;padding: 8px 20px">
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
	

	





@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

<style type="text/css">
		.aione-widget-header{
			border-bottom: 1px solid #e8e8e8;cursor: pointer;
		}
		.aione-widget-header a{
			padding: 10px;color: black
		}
		.aione-widget-content{
			border-bottom: 1px solid #e8e8e8;padding: 10px;font-size: 72px
		}
		.aione-widget-footer{
			padding: 10px
		}
		.my-stats li{
			padding: 10px
		}
		.my-stats ul{
			margin-top: 0px !important
		}
		.collapsible{
			
		}
		.aione-progress-bg {
		    background: #f2f2f2;
		    min-height: 10px;
		    border:1px solid #a8a8a8;
		}


		.aione-progress-inside {
		    width: 80%;
		    height: 10px;
		    background: #22adba;
		    background-color: #2978A2;
		    background-size: 10% 100%, 100% 100%;
		}
		li.active{
			box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14),0 1px 5px 0 rgba(0,0,0,0.12),0 3px 1px -2px rgba(0,0,0,0.2)
		}
		.fc-toolbar{
			display: none;
		}
		table{
			border-collapse: separate !important;
		}
		.fc-basic-view .fc-body .fc-row{
			min-height: 1px;
		}
		.fc-scroller{
			height:174px !important;
		}
		td{
			text-align: center
		}
		.switch label .lever{
			width: 30px !important;
			height:16px !important;
		}
		.switch label .lever:after{
			width: 14px !important;
			height: 14px !important;
			left: 1px ;
			top:1px !important;
		}
		.switch label input[type=checkbox]:checked+.lever:after{
			    background-color: white !important;
		}
		.switch label input[type=checkbox]:checked+.lever:after{
			left: 15px;
		}
		.switch label input[type=checkbox]:checked+.lever{
			background-color: #6DAD25 !important;
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