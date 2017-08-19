@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Attendence',
	'add_new' => '+ Import Attendence'
); 
@endphp
@include('common.pageheader',$page_title_data) 
<style type="text/css">

	body{
		background-color: #ffffff;
	}
	.main-container{
		padding:17px;
	}
	.form_group{
		margin:30px;
	    font-size: 16px;
	    font-weight: 400;
	    color: #5d5c5c;
	    font-family: 'Open Sans', sans-serif;
	}
	.form-control{
		background: #f8f8f8;
	}
	.btn {
	    background: #2196F3;
	    margin-top: 30px;
	}
	.input-group{
		margin-left: 54px;
	   
	}
	.table > thead > tr > th{
		    padding: 7px 7px !important;
	}	
	.table > tbody > tr > td{
		  padding: 7px 7px;
	}
	.pager li > a{
		    background-color: #006694;
		    color: #ffffff;
	}
	.design-style{
		
	    text-align: center;
	   
	}
	.design-bg{
		background: #ececec;
	    padding: 24px 14px 15px 14px;
	    border-radius: 3px;
	    border: 1px solid #ddd;
	    margin-bottom: 10px;
	}
	.present-bg-color{
		background: #8BC34A;
	    color: #fff;
	}
	.absent-bg-color{
		background:#e53935;
		color: #fff;
	}
	.pager li > a:hover{
		background-color: #006694;
	}
	.table-tr{
		text-align: center;
	}
	/*select{
		display: block;
	}*/
	table {
    border-collapse: collapse;
    width: 100%;
	}

	th, td {
	    text-align: left;
	    padding: 8px;
	}

	tr:nth-child(even){background-color: #f2f2f2}

	th {
	    background-color: #e8e8e8;
	    color: #676767;
	    font-weight: 700
	}
	input{
		margin: 0px !important;
	}
</style>
<?php


			if(isset($filter_dates)){
				$dateFilter = $filter_dates['year'].'-'.$filter_dates['month'].'-'.$filter_dates['date'];
				$current_date_time = Carbon\Carbon::parse($dateFilter);
			}else{
					$current_date_time = Carbon\Carbon::now('Asia/Calcutta');
				}
		$dateformat = $current_date_time->toDayDateTimeString();
		$daysinmo = $current_date_time->daysInMonth;
		$month 	= $current_date_time->month;
		$year 	= $current_date_time->year;
		$date	= $current_date_time->day;
		$month_week_no = $current_date_time->weekOfMonth;
		$day =  $current_date_time->format('l');

		$MO_data = ['01'=>'JAN', '02'=>'FEB', '03'=>'MAR', '04'=>'APR' ,'05'=>'MAY', '06'=>'JUN','07'=>'JUL', '08'=>'AUG','09'=>'SEP', '10'=>'OCT','11'=>'NOV', '12'=>'DEC'];
		$year_data = range(2015, 2050);
		$daysInMonth = range(1, $daysinmo);
?>


{{-- <div class="row">
	<h5 class="text-center">Attendance<span style="font-size:26;"> {{$dateformat}}</span></h5>
</div> --}}

@include('common.pagecontentstart')
@include('common.page_content_primary_start')		
<div class="card">
	<div class="row design-bg">
		{{-- <div class="col-md-4">
			<ul class="pager">
				<li class="previous"><a href="#">Previous Month</a></li>
			</ul>
		</div> --}}
		<div class="col-md-4">
			<div class="row">
				{!!Form::open(['route'=>'hr.attendance' , 'method'=>'post'] )!!}
					<div class="col s3 pr-7 right-align">
						<select name="date"  class="browser-default">
							@foreach($daysInMonth as $key =>$val)
							@if($date==$val)
							<option selected="selected" value="{{$val}}">{{$val}} </option>

								@else
									<option value="{{$val}}">{{$val}} </option>
								@endif
							@endforeach

						</select>
					</div>
					<div class="col s3 pl-7 pr-7">
						<select name="month" class="browser-default">
							@foreach($MO_data as $key => $val)
								@if($month==$key)
									<option selected="selected" value="{{$key}}">{{$val}} </option>
								@else
									<option value="{{$key}}">{{$val}} </option>
								@endif
							@endforeach
						</select>
					</div>
 					<div class="col s3 pl-7 pr-7 right-align">
						<select  name="year" class="browser-default">  
							@foreach($year_data as $key =>$val)
							@if($year==$val)
							<option selected="selected" value="{{$val}}">{{$val}} </option>

								@else
									<option value="{{$val}}">{{$val}} </option>
								@endif
							@endforeach
						</select>
					</div>
					<div class="col s3 pl-7">
						<button class="btn blue" type="submit"  style="margin: 6px;width: 100%;">Search
							
						</button>	
					</div>
					
				{!!Form::close()!!}
			</div>
			
			<div class="row">
				<h5 class="design-style"><span>Attendance </span>{{$dateformat}}</h5>	
			</div>
			
		</div>
		{{-- <div class="col-md-4">
			<ul class="pager">
				<li class="next"><a href="#">Next Month</a></li>
			</ul>
		</div>	  --}}
	</div> 
	<div class="table-responsive">
	@if($day=='Sunday')
		<h1> Sunday off </h1>
	@else
	{!!Form::open(['route'=>'hr_store.attendance' , 'method'=>'post'] )!!}
					{!! Form::hidden('dates[year]',$year,['class' => 'form-control']) !!}
					@if(strlen($month)==1)
					{!! Form::hidden('dates[month]','0'.$month,['class' => 'form-control']) !!}
					@else
					{!! Form::hidden('dates[month]',$month,['class' => 'form-control']) !!}
					@endif
					{!! Form::hidden('dates[date]',$date,['class' => 'form-control']) !!}
					{!! Form::hidden('dates[day]',$day,['class' => 'form-control']) !!}
					{!! Form::hidden('dates[month_week_no]',$month_week_no,['class' => 'form-control']) !!}
					
<table class="table table-bordered table-striped">
	<thead>
		<tr class="table-tr">
			<th>Sr</th>
			<th>Employee</th>
			<th>Name</th>
			<th>Designation</th>
			<th>Department</th>
			<th>Attendance Status</th>
			<th>Punch In Out</th>		
			<th>Check In Out</th>
 		</tr>
	</thead>
	<tbody>
	<?php
	 	$lock_status	=1; 
	 	$designation 	= $department = null;
		$attValue 		=  $attendance_data->toArray();
	?>
		@foreach($employee_data as $keys => $vals)
		@php 
 		$user_meta  = $vals->metas_for_attendance->mapwithKeys(function($item){
	 					return [$item['key'] => $item['value'] ];
						 }); 
 		if(!empty($user_meta['designation'])){
 			$designation =	EmployeeHelper::get_designation($user_meta['designation']);
 		}
 		if(!empty($user_meta['department'])){
 			$department =	EmployeeHelper::get_department($user_meta['department']);
 		}
		 if(empty($user_meta['employee_id']) || empty($user_meta['shift']) || empty($user_meta['joining_date'])){
			continue;
		}
		if(date('Y-m-d', strtotime($user_meta['joining_date'])) > date('Y-m-d', strtotime($dateformat))){
				continue;
		}
 			$in_out_data = $punch_in_out = $attendance_status = null;
			$emp_id = $user_meta['employee_id'];
			if(!empty($attValue[$emp_id]['attendance_status'])){
				$attendance_status = $attValue[$emp_id]['attendance_status'];
			}
			if(!empty($attValue[$emp_id]['punch_in_out'])){
				$punch_in_out = json_decode($attValue[$emp_id]['punch_in_out'],true);
			}
			if(!empty($attValue[$emp_id]['in_out_data'])){
				$in_out_data = json_decode($attValue[$emp_id]['in_out_data'],true);
			}
			if(!empty($attValue[$emp_id]['lock_status'])){
				$lock_status = $attValue[$emp_id]['lock_status'];
			}
		@endphp

		
			<tr class="table-tr">
				<td>{{$loop->iteration}}</td>
				<td>{{@$user_meta['employee_id']}}</td>
				<td>{{@$vals['name']}}</td>

				<td>{{@$designation}}</td>
				<td>{{@$department}}</td>
			@if($lock_status)
				<td> {!! Form::select($emp_id."[attendance_status]",['present'=>'Present','absent'=>'Absent' , 'leave'=>'Leave'],@$attendance_status	,['class' => '']) !!}</td>
				@if($punch_in_out)
						<td>
						@foreach($punch_in_out as $key =>$val)
						<div>
								{!! Form::text($emp_id."[punch_in_out][]",($val == null) ? '--' : $val,['class' => '','id'=>$key.'punch_in_out'.$emp_id]) !!} <a class="del_check">del </a>
						</div>
						@endforeach
						</td>
						@else
						<td><button class="show_punch_in_out">add punch in out time1</button> <div class="add_punch_in_out">{!! Form::text($emp_id."[punch_in_out][]", null,['class' => '','id'=>$key.'punch_in_out'.$emp_id]) !!}
						{!! Form::text($emp_id."[punch_in_out][]",null,['class' => '','id'=>$key.'punch_in_out'.$emp_id]) !!}  </div> </td>
				@endif
				@if($in_out_data)
					
						<td>
						@foreach($in_out_data as $key =>$val)
						{{$loop->iteration}}
							@foreach($val as $ip =>$times)
								<div>
										 {{$ip}}{!! Form::text($emp_id."[in_out_data][][$ip]",($times == null) ? '--' : $times,['class' => '','id'=>$key.'in_out_data'.$emp_id]) !!}  <a class="del_check">del </a>
								</div>
							@endforeach
						@endforeach
						</td>
						@else
						<td>--</td>
					@endif
			@else
				<td>{{@$attendance_status}}</td>
				@if($punch_in_out)
						<td>
						@foreach($punch_in_out as $key =>$val)
						<div>
								{{($val == null) ? '--' : $val}}
						</div>
						@endforeach
						</td>
						@else
						<td>--</td>
					@endif
					
				@if($in_out_data)
					
						<td>
						@foreach($in_out_data as $key =>$val)
						{{$loop->iteration}}
							@foreach($val as $ip =>$times)
								<div>
										 {{$ip}}{{($times == null) ? '--' : $times}}
								</div>

							@endforeach
						@endforeach
						</td>
						@else
						<td>--</td>
					@endif
			@endif
			</tr>
	

		
		@endforeach
		
	</tbody>
</table>
		@if(@$lock_status==1)
		<div class="col s12 m3 l12 aione-field-wrapper right-align">
			<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit" >Save Attendance
				<i class="material-icons right">save</i>
			</button>
		</div>
		@endif

	{!! Form::close() !!}
	@endif
	</div>
</div>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
	<script type="text/javascript">
	$(document).ready(function(){
		$('.add_punch_in_out').hide();
	});

	$(document).on('click','.show_punch_in_out',function(e){
		e.preventDefault();
		$(this).siblings('.add_punch_in_out').toggle();
	});
	$(document).on('click','.del_check',function(e){
			e.preventDefault();
			$(this).parent().remove();
	});
		$(document).ready(function(){
			$('.add-new').off().click(function(e){
				e.preventDefault();
				$('.add-new-wrapper').toggleClass('active'); 
			});

		});

		function add(id)
		{
		valuestop =	$("#"+id).val();
		valuestart = 	$("#in_"+id).val();
		// console.log(out+''+inTime);

//create date format          
var timeStart 	= 	new Date("01/05/2017 " + valuestart).getHours();
var timeEnd 	=	 new Date("01/05/2017 " + valuestop).getHours();

var hourDiff =timeStart - timeEnd;
console.log('difference  '+hourDiff);



// 		var startTime=moment("12:16:59 am", "HH:mm:ss a");
// var endTime=moment("06:12:07 pm", "HH:mm:ss a");
// var duration = moment.duration(endTime.diff(startTime));
// var hours = parseInt(duration.asHours());
// var minutes = parseInt(duration.asMinutes())-hours*60;

// alert (hours + ' hour and '+ minutes+' minutes');
		}
	</script>
@endsection()