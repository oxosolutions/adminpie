@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Attendence',
	'add_new' => '+ Import Attendence'
); 
@endphp
@include('common.pageheader',$page_title_data) 
<script type="text/javascript">
	
</script>
@if(Session::has('success'))
<p class="alert">{{ Session::get('success') }}</p>
@endif


@if(Session::has('error'))
<p class="alert">{{ Session::get('error') }}</p>
@endif
	<div id="att_data" class="card" style="margin-top: 0px;padding:10px">
		<input id="token" type="hidden" name="_token" value="{{csrf_token()}}" >
			{{-- <div id="add_new_wrapper" class="add-new-wrapper light-blue darken-2 create-fields" >
			{!! Form::open(['route'=>'upload.attendance', "files"=>true , 'class'=> 'form-horizontal','method' => 'post'])!!}

					<div class="row no-margin-bottom ">
						<div class="col s12 m2 l3  input-field">
							{!!Form::text('title',null,['class' => 'validate','placeholder'=>'Enter Title','id'=>'attendence-title','style'=>'color:#fff'])!!}
							<label for="attendence-title">Enter title</label>

						</div>
						<div class="col s12 m2 l5 aione-field-wrapper file-field input-field">
							<div class="btn" style="margin-top: 0px">
						        <span>Choose File</span>
						        <input type="file" name="attendance_file" >
						    </div>
						    <div class="file-path-wrapper">
								{!!Form::text('file',null,['class' => 'file-path validate'])!!}
							</div>
						</div>
						
						<div class="col s12 m3 l4 aione-field-wrapper right-align">
							
								<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit" name="action" style="margin-top: 10px;">Upload Attendance
								<i class="material-icons right">save</i>
								</button>
						</div>
					</div>
				{!!Form::close()!!}
			</div> --}}
		<div id="projects" class="projects list-view">
			<div class="row ">
				{{-- <div class="col s12 m12 l6 " >
					<ul class="class-list" style="margin: 0px;margin-top: 4px">
						<li style="display: inline-block;"><a style="margin-top: 0px" onclick="showHide('month')"  class="btn monthly">Monthly</a></li>
						
						<li style="display: inline-block;"><a style="margin-top: 0px"  class="btn weekly">Weekly</a></li>

						<li style="display: inline-block;"><a style="margin-top: 0px" class="btn daily" >Daily</a></li>
					</ul>
				</div>
 --}} 			<div class="col l6">
 						
				</div>
				<div class="col s12 m12 l6 right-align">
					
					<a  href="{{route('import.form.attendance')}}" class="btn" style="width: 50%;margin-top: 4px;background-color: #0288D1">
						Import Attendence
					</a>
					<a  href="{{route('hr.attendance')}}" class="btn" style="width: 50%;margin-top: 4px;background-color: #0288D1">
						Mark Attendence
					</a>
				</div>
			</div>
		</div>
	
		<div id="main" class="main-container">
		
		</div>
		
	</div>
	<style type="text/css">
#att_data .active
{
	background-color: #005A8B;
	-webkit-background-color: #005A8B;
}
#att_data li
{
	border-radius:0px;
	margin-left:-4px;
}
#att_data li:first-child
{
	margin:0;
}
#att_data .fa-calendar
{
	font-size: 25px;

}
#att_data .main-container
{
	border-top:1px solid #e8e8e8;
	margin-top:15px;
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
#att_data a{
	color:black;
}
#att_data .nav:hover
{
	color:#2196F3;

}
/*Div table*/

#att_data .row
{
	width:100%;
	border: none;
}
#att_data .content
{
	width:10%;
	float:left;
	background-color: white;
} 
#att_data .column
{
	width: 2.66%;
    float: left;
    border-top:0.1px solid #e8e8e8;
    border-left:0.1px solid #e8e8e8;
    text-align: center;
    
}
#att_data .present-bg-color
{
	background-color:#79BEDB;
	
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
		attendance_list();

		$(".monthly").click(function(){
			$(this).addClass("active");
			$(".weekly").removeClass("active");
			$(".daily").removeClass("active");
		});
			$(".weekly").click(function(){
			$(this).addClass("active");
			$(".monthly").removeClass("active");
			$(".daily").removeClass("active");
		});
			$(".daily").click(function(){
			$(this).addClass("active");
			$(".monthly").removeClass("active");
			$(".weekly").removeClass("active");
		});

	});
	function showHide(show)
	{
		$("#"+show).show();
	}

	function attendance_list()
	{
		$.ajax({
				url:route()+'/attendance/list',
				type:'Get',
				success: function(res){
					
					$("#main").html(res);
					console.log('data sent successfull');
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
				url:route()+'/attendance/list',
				type:'POST',
				data:postData,
				success: function(res){

					$("#main").html(res);
					$("#month , #week ,#days").hide();

					if(date)
					{
						$("#days").show();
					}else if(week){
						$("#week").show();
					}else{
						$("#month").show();
					}
					$('select').material_select();
				
					console.log('data sent successfull');
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