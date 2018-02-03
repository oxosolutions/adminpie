@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Attendance',
	// 'add_new' => '+ Import Attendence',
	// 'route' => 'import.form.attendance',
	// 'second_button_route' => 'hr.attendance',
	// 'second_button_title' => 'Mark Attendence',
	'add_new' => 'List attendance',
	'route' => 'lists.attendance'
); 
@endphp
@include('common.pageheader',$page_title_data) 
@if(Session::has('success'))
<p class="alert">{{ Session::get('success') }}</p>
@endif
@if(Session::has('error'))
<p class="alert">{{ Session::get('error') }}</p>
@endif
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
{{-- <a href="{{ route('hr.attendance') }}" class="btn blue">Mark attendance</a> --}}
	@include('organization.attendance._tabs')

	<div id="att_data" >
		<input id="token" type="hidden" name="_token" value="{{csrf_token()}}" >
		<input id="years" type="hidden" value="{{$data['year']}}" >
		<input id="months" type="hidden"  value="{{$data['month']}}" >

		<div id="projects" class="projects list-view">
		
		</div>
	
		<div id="main" class="main-container">
		
		</div>
	</div>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
<style type="text/css">
#att_data .active
{
	background-color: #005A8B;
	-webkit-background-color: #005A8B;
}
#att_data li
{
	border-radius:0px;
	
	display: inline-block;
	

}

#att_data li:first-child > a{
	border-radius: 10px 0 0 10px

}
#att_data li:last-child > a{
	border-radius: 0 10px 10px 0;
}
#att_data li>a{
	padding:10px;
	display: inline-block;
	margin-right: -5px;
	border: 1px solid #e8e8e8;
	background-color: rgb(50, 136, 184);
	color: white;
	width: 100px;
	text-align: center;

}
#att_data .fa-calendar
{
	font-size: 25px;

}

#att_data .design-style
{
	font-size: 18px;
	line-height:50px;
}
#att_data .fa
{
	font-size:18px;
}
#att_data .btn
{
	border-radius: 0px;
	box-shadow: none;
}
#att_data .nav{
	color: #757575;
}
#att_data .nav:hover
{
	color:#505050;

}
/*Div table*/

#att_data .row
{
	width:100%;
	
}
#att_data .content
{
	width:12%;
	float:left;
	background-color: white;
} 
#att_data .column
{
	width: 2.50%;
    float: left;
    border-top:0.1px solid #e8e8e8;
    border-left:0.1px solid #e8e8e8;
    text-align: center;
    
}

#att_data .sunday
{
	background-color:#f2f2f2;
	color: #686868;
}
#att_data .absent-bg-color
{
	background-color:#F08B8A;
}

</style>
	<script type="text/javascript">
	$(document).ready(function(){
		year = $("#years").val();
		month = $("#months").val();
		if(month  && year){
			attendance_filter(null, null, month, year)
		}
		else{
		attendance_list();
		}
	});
	function showHide(show)
	{
		$("#"+show).show();
	}

	function attendance_list()
	{
		$.ajax({
				url:route()+'/attendance/list/ajax',
				type:'Get',
				success: function(res){
					
					$("#main").html(res);
					console.log('data sent successfull');
					$(".monthly").addClass("aione-active");
					$("#week ,#days").hide();
					$('select').material_select();
				}
			});
	}

	function attendance_filter(date, week, mo, yr)
	{
		console.log(date, week, mo, yr);
		var postData = {};
		postData['date'] = date;
		postData['week'] = week;
		postData['month'] = mo;
		postData['years'] = yr;
		postData['_token'] = $("#token").val();
		$.ajax({
				url:route()+'/attendance/list/ajax',
				type:'POST',
				data:postData,
				success: function(res){

					$("#main").html(res);
					$("#month , #week ,#days").hide();

					if(date)
					{
						$("#days").show();
						console.log('day');
						$(".daily").addClass("aione-active");

					}else if(week){
						$("#week").show();
						console.log('week');
						$(".weekly").addClass("aione-active");
					}else{
						$("#month").show();
						console.log('month');
						$(".monthly").addClass("aione-active");
					}
					$('select').material_select();
				
					console.log('data sent successfull ');
				}
			});
		}
		
		function lock(month, year)
		{
			var datas ={};
			datas['month'] =month;
			datas['year'] =year;
			datas['_token'] = $("#token").val();

			$.ajax({
				url:route()+'/attendance/lock',
				type:'POST',
				data:datas,
				success: function(res){
					console.log(res);
				}
			})
		}

		$(document).on('change', '.switch > label > input',function(e){
			var postedData = {};
			postedData['month']	= $("#current_month").val();
			postedData['year']	= $("#year").val();
			postedData['lock_status'] 			= $(this).prop('checked');
			postedData['_token'] 			= $("#token").val();

			$.ajax({
				url:route()+'/attendance/lock',
				type:'POST',
				data:postedData,
				success: function(res){
					console.log('data sent successfull');
				}
			});
			$('.editable h5 ,.editable p').removeClass('edit-fields');
		});

	function unlock(month, year)
		{
			var datas ={};
			datas['month'] =month;
			datas['year'] =year;
			datas['_token'] = $("#token").val();

			$.ajax({
				url:route()+'/attendance/lock',
				type:'POST',
				data:datas,
				success: function(res){
					console.log(res);
				}
			})
		}


	</script>
	
@endsection