@extends('layouts.main')
@section('content')
<style type="text/css">
		.recent-five li{
			padding: 7px 10px;
			width: 100%
		}
		.recent-five li a{
			float: right;
		}
		.mb-10{
			margin-bottom: 10px
		}
		.pr-14{
			padding-right: 14px !important;
		}
		.fix-height{
			min-height: 230px;max-height: 230px
		}
		.back > .card > div{
			margin-bottom: 5px
		}
		.btn-unflip{
			position: absolute;
			top: 0;
			right: 0;
		}
		/*.btn-unflip-2{
			position: absolute;
			top: 0;
			right: 0;
		}
		.btn-unflip-3{
			position: absolute;
			top: 0;
			right: 0;
		}
		.btn-unflip-4{
			position: absolute;
			top: 0;
			right: 0;
		}
		.btn-unflip-5{
			position: absolute;
			top: 0;
			right: 0;
		}*/
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
		.in-out-button a#start{
			display: block;
   			background-color: #00BC9B;
   			padding: 7px 30px;
		}
		.in-out-button a#start .check-out{
			display: none;
		} 
		.in-out-button a#stop .check-in{
			display: none;
		} 
		.in-out-button a#stop{
			display: block;
   			background-color: #d9534f;
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
			padding: 0px 10px
		}
		.aione-widget-footer .all{
			float: left;
			width: 45%;
			font-size: 14px;
			font-weight: 600;
			padding: 10px 5px;
			border: 0px;
			border-radius: 4px;
		}
		.aione-widget-footer .recent{
			float: right;
			width: 54%;
			font-size: 14px;
			font-weight: 600;
			padding: 10px 0px;
			border: 0px;
			border-radius: 4px;
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
		.add-btn{
			font-size: 14px;
			font-weight: 600;
			padding: 10px 5px;
			border: 0px;
			border-radius: 4px;	
			width: 100%;

		}
		.add-widget{
					border:2px dashed #e8e8e8;
					margin-top: 10px;
					min-height: 230px;max-height: 230px
					padding: 50px 20px;
					cursor: pointer;
				}
				.plus-sign{
					width: 100%;
					font-size: 72px;
					font-weight: 800;
					color: #676767;

				}
	</style>
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
@include('organization.dashboard._tabs')
		<div class="row">
		
			{{-- @foreach($model as $key => $value)
				<div class="col l3 pr-7">
					<div class="card shadow mt-0" style="">
						<div class="row center-align aione-widget-header" ><h5 class="m-0"><a href="{{route($value['route'])}}">{{ucfirst($key)}}</a></h5></div>
						<div class="row center-align aione-widget-content" >{{$value['count']}} </div>
						<div class="row center-align aione-widget-footer" >
							<a href="{{route($value['route'])}}" class="btn" style="background-color: #005A8B">All {{$key}}</a>
						</div>
					</div>
				</div>
			@endforeach --}}
			@php
				$count = [];
			@endphp
			@foreach($widgets as $widgetKey => $widget)
				@php
					$count[] = $widget->id;
				@endphp
			@endforeach
			@php
				$isAdmin = in_array('administrator',get_user_roles());
			@endphp
			@foreach($widgets as $widgetKey => $widget)
				@php
					$file = (!$isAdmin)?$widget->widgets->slug:$widget->slug;
				@endphp
				@if(View::exists('organization.widgets.'.$file))
					@php
						if($isAdmin){
							$widget['widgets'] = $widget;
						}
					@endphp
					@include('organization.widgets.'.$file , ['data'=>$widget,'count' => count($count),'isAdmin'=>$isAdmin])
				@endif
				{{-- @php
					try{
				@endphp
						@include('organization.widgets.'.$widget->widgets->slug)
				@php
					}catch(\Exception $e){

					}
				@endphp --}}
			@endforeach
			<div class="col l3">
				<div class="add-widget row" data-target="add-widget">
					<div class="col l12 center-align plus-sign" style="">
						+
					</div>
					<div class="col l12 center-align">
						Add New Widget
					</div>
				</div>
			</div>
			@include('common.modal-onclick',['data'=>['modal_id'=>'add-widget','heading'=>'Add Widget','button_title'=>'Save','section'=>'widsec1']])
			{{-- <div id="add-widget" class="modal modal-fixed-footer" style="overflow-y: hidden;">
				<div class="modal-header white-text  blue darken-1" ">
					<div class="row" style="padding:15px 10px;margin: 0px">
						<div class="col l7 left-align">
							<h5 style="margin:0px">Add Widget</h5>	
						</div>
						<div class="col l5 right-align">
							<a href="javascript:;" name="closeModel" onclick="close()" id="closemodal" class="closeDialog close-model-button" style="color: white"><i class="fa fa-close"></i></a>
						</div>	
					</div>
				</div>
				<div class="modal-content" style="padding: 20px;padding-bottom: 60px">
					
				</div>
				<div class="modal-footer">
					<button class="btn blue " type="submit" name="action">Add
					</button>
				</div>	
			</div> --}}
			
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
					<span ><time id="timer">00:00:00</time> Hrs</span>
				</div>
				<div class="in-out-button">

					<a href="#" id="start">
						<i class="material-icons dp48">access_alarm</i>
						<div>
							<div class="check-in" style="font-size: 26px;color: white">
								Check In
							</div>
							<div class="check-out" style="font-size: 26px;color: white">
								Check Out
							</div>

							<div style="color: white;font-size: 14px;line-height: 7px;">
								<div class="" id="clock_1"></div>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>



@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')


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
 //**********************stop watch********************************8
var h1 = document.getElementById('timer'),
    start = document.getElementById('start'),
    stop = document.getElementById('stop'),
    clear = document.getElementById('clear'),
    seconds = 0, minutes = 0, hours = 0,
    t;

function add() {
    seconds++;
    if (seconds >= 60) {
        seconds = 0;
        minutes++;
        if (minutes >= 60) {
            minutes = 0;
            hours++;
        }
    }
    
    h1.textContent = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);

    timer();
}
function timer() {
    t = setTimeout(add, 1000);
}
// timer();
$(document).on('click','.in-out-button > a' , function(){
	if($(this).attr('id') == 'start'){
		$(this).attr('id','stop');
		timer();
	}else{
		$(this).attr('id','start');
		clearTimeout(t);
	}
});

// /* Start button */
// start.onclick =function(){
// 	timer();
// }

//  Stop button 
// stop.onclick = function() {
//     clearTimeout(t);
// }

/* Clear button */
/*clear.onclick = function() {
    h1.textContent = "00:00:00";
    seconds = 0; minutes = 0; hours = 0;
}*/

 //***********************************************************
	</script>


@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection