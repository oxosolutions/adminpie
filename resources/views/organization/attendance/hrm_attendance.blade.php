@extends('layouts.main')
@section('content')

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
	    margin-top: 0px;
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
	input{
		margin: 0px !important;
	}
</style>
<?php
			if(isset($filter_dates)){
			//	dump($filter_dates);
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

		
<div class="card">
	<div class="row design-bg">
		{{-- <div class="col-md-4">
			<ul class="pager">
				<li class="previous"><a href="#">Previous Month</a></li>
			</ul>
		</div> --}}
		<div class="col-md-4">

		

			{!!Form::open(['route'=>'hr.attendance' , 'method'=>'post'] )!!}
			<div class="col s3 pr-7 right-align">
							<select name="date"  >
								@foreach($daysInMonth as $key =>$val)
								@if($date==$val)
								<option selected="selected" value="{{$val}}">{{$val}} </option>

									@else
										<option value="{{$val}}">{{$val}} </option>
									@endif
								@endforeach

							</select>
						</div>

			
						<div class="col s3 pl-7">
							<select name="month" >
								@foreach($MO_data as $key => $val)
									@if($month==$key)
										<option selected="selected" value="{{$key}}">{{$val}} </option>

									@else
										<option value="{{$key}}">{{$val}} </option>
									@endif
								@endforeach
								
							</select>

						</div>

						<div class="col s3 pr-7 right-align">
							<select  name="year">
								@foreach($year_data as $key =>$val)
								@if($year==$val)
								<option selected="selected" value="{{$val}}">{{$val}} </option>

									@else
										<option value="{{$val}}">{{$val}} </option>
									@endif
								@endforeach

							</select>
						</div>
			<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit" >Search
				<i class="material-icons right">save</i>
			</button>
			{!!Form::close()!!}
			<h5 class="design-style"><span>Attendance </span>{{$dateformat}}</h5>
		</div>
		{{-- <div class="col-md-4">
			<ul class="pager">
				<li class="next"><a href="#">Next Month</a></li>
			</ul>
		</div>	  --}}
	</div> 
	<div class="table-responsive">
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
					<th>In Time</th>
					<th>Leaving Time</th>
					<th>Lunch Start Time </th>
					<th>Lunch End Time </th>
					<th>Total Time</th>
					<th>Over Time</th>
					<th>Due Time</th>
				</tr>
			</thead>
			<tbody>
			
			@if(!empty($attendance_data))
				@foreach($attendance_data as $attKey => $attValue)
				
					@php 
					$total_hour =$due_time = $over_time = $total_time = $out_time = $in_time = $attendance_status = null; 

						$emp_id = $attValue['employee_id'];
						$attendance_status = $attValue['attendance_status'];
						$in_time = $attValue['in_time'];
						$out_time = $attValue['out_time'];
						//@$total_hour = $attendance_data[$empKey]['total_hour'];
						$over_time = $attValue['over_time'];
						$due_time = $attValue['due_time'];
						
					@endphp
			
					<tr class="table-tr">
						<td>{{$loop->index}}</td>
						<td>{{$attValue['employee_id']}}</td>
						<td>{{$attValue['employee']['employ_info']['name']}}</td>

						<td>{{$attValue['employee']['designations']['name']}}</td>
					
							<td>--</td>
						

						<td> {!! Form::select($emp_id."[attendance_status]",['present'=>'Present','absent'=>'Absent' , 'leave'=>'Leave'],$attendance_status	,['class' => '']) !!}</td>
						<td>{!! Form::text($emp_id."[in_time]",($in_time == null) ? '00:00' : $in_time,['class' => '','id'=>'in_'.$emp_id]) !!}</td>
						<td>{!! Form::text($emp_id."[out_time]",($out_time == null) ? '00:00' : $out_time,['class' => '','id'=>$emp_id, 'onclick'=>'add(this.id)']) !!}</td>
						<td>{!! Form::text($emp_id."[lunch_start_time]",'00:00',['class' => '']) !!}</td>
						<td>{!! Form::text($emp_id."[lunch_out]",'00:00',['class' => '']) !!}</td>
						<td>{!! Form::text($emp_id."[total_hour]",($total_hour==null)? '00:00': $total_hour,['class' => '']) !!}</td>
						<td>{!! Form::text($emp_id."[over_time]",($over_time==null)? '00:00' : $over_time,['class' => '']) !!}</td>
						<td>{!! Form::text($emp_id."[due_time]", ($due_time ==null)? '00:00': $due_time,['class' => '']) !!}</td>
					</tr>
					
				@endforeach

				@else
					@foreach($employee_data as $key => $attValue)
						@php 
						$total_hour =$due_time = $over_time = $total_time = $out_time = $in_time = $attendance_status = null; 

							$emp_id = $attValue['employee_id'];

						@endphp

						<tr class="table-tr">
						<td>{{$loop->index}}</td>
						<td>{{@$attValue['employee_id']}}</td>
						<td>{{@$attValue['employ_info']['name']}}</td>

						<td>{{@$attValue['designations']['name']}}</td>
					
							<td>--</td>
						

						<td> {!! Form::select($emp_id."[attendance_status]",['present'=>'Present','absent'=>'Absent' , 'leave'=>'Leave'],@$attendance_status	,['class' => '']) !!}</td>
						<td>{!! Form::text($emp_id."[in_time]",($in_time == null) ? '00:00' : $in_time,['class' => '','id'=>'in_'.$emp_id]) !!}</td>
						<td>{!! Form::text($emp_id."[out_time]",($out_time == null) ? '00:00' : $out_time,['class' => '','id'=>$emp_id, 'onclick'=>'add(this.id)']) !!}</td>
						<td>{!! Form::text($emp_id."[lunch_start_time]",'00:00',['class' => '']) !!}</td>
						<td>{!! Form::text($emp_id."[lunch_out]",'00:00',['class' => '']) !!}</td>
						<td>{!! Form::text($emp_id."[total_hour]",($total_hour==null)? '00:00': $total_hour,['class' => '']) !!}</td>
						<td>{!! Form::text($emp_id."[over_time]",($over_time==null)? '00:00' : $over_time,['class' => '']) !!}</td>
						<td>{!! Form::text($emp_id."[due_time]", ($due_time ==null)? '00:00': $due_time,['class' => '']) !!}</td>
					</tr>

					@endforeach

					
				
			@endif
				
			</tbody>
		</table>
		<div class="col s12 m3 l12 aione-field-wrapper right-align">
			<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit" >Save Attendance
				<i class="material-icons right">save</i>
			</button>
		</div>

	{!! Form::close() !!}
	</div>
</div>
	<script type="text/javascript">
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