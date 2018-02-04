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
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('organization.attendance._tabs')


<?php
	$errors = array();
	$attendance_mode_manual = $attendance_mode_machine = $attendance_mode_system = 0;

	$attendance_sources = get_organization_meta('attendance_sources');
	if($attendance_sources){
		$attendance_sources = json_decode($attendance_sources,true);
		if(is_array($attendance_sources)){
			$attendance_mode_manual = in_array('manual',$attendance_sources)?1:0;
			$attendance_mode_machine = in_array('machine',$attendance_sources)?1:0;
			$attendance_mode_system = in_array('system',$attendance_sources)?1:0;
		}
	}
	$mark_attendance_date = Carbon\Carbon::parse($mark_attendance_date);
	// $mark_attendance_date_formatted = $mark_attendance_date->format('j')."<sup>".$mark_attendance_date->format('S')."</sup> ".$mark_attendance_date->format('F, Y');

	// dump($mark_attendance_date);
	// dump($mark_attendance_date_formatted);



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


	<div class="ar aione-border pt-10 mb-15">
		<div class="ac l60 line-height-40">
			{!! @$mark_attendance_date_formatted !!} 
		</div>
		<div class="ac l40">
			{!!Form::open(['route'=>'hr.attendance' , 'method'=>'post','class'=>'ar'] )!!}
				{{-- {!! FormGenerator::GenerateForm('mark-attendance-datepicker-form')!!} --}}
				<div data-field-type="text" style="width: 40px;" class="aione-float-right field-wrapper  field-wrapper-name field-wrapper-type-text ">
					<div id="field_name" class="field field-type-text ">
						<input id="mark_attendance_date" type="date" name="mark-attendance-date" value="{{$mark_attendance_date}}" class="datepicker" >
					</div><!-- field -->
				</div>
			{!!Form::close()!!}	
		</div>
	</div>
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
		<div class="aione-table">
			<table class="">
				<thead>
					<tr class="table-tr">
						<th>Status</th>
						<th>Employee</th>
						<th>Name</th>
						<th>Designation</th>
						<th>Department</th>
						@if($attendance_mode_manual)
							<th>Attendance Status</th>
						@endif
						@if($attendance_mode_machine)
						<th>Punch In Out</th>		
						@endif
						@if($attendance_mode_system)
						<th>Check In Out</th>
						@endif
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
					$attendance_status_class = 'bg-red';	
					// $attendance_status_class = 'bg-green';	
			 		$user_meta  = $vals->metas_for_attendance->mapwithKeys(function($item){
				 					return [$item['key'] => $item['value'] ];
									 }); 
			 	
			 		if(!empty($user_meta['designation'])){
			 			$designation =	EmployeeHelper::get_designation($user_meta['designation']);
			 		}
			 		if(!empty($user_meta['department'])){
			 			$department =	EmployeeHelper::get_department($user_meta['department']);
			 		}
					 if(empty($user_meta['employee_id']) || empty($user_meta['user_shift']) || empty($user_meta['date_of_joining'])){
						continue;
					}
					if(date('Y-m-d', strtotime($user_meta['date_of_joining'])) > date('Y-m-d', strtotime($dateformat)) || ( !empty($user_meta['date_of_leaving']) && date('Y-m-d', strtotime($user_meta['date_of_leaving'])) < date('Y-m-d', strtotime($dateformat)))) {
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
							<td><span class="mark-attendance-status {{@$attendance_status_class}}"></span></td>
							<td>{{@$user_meta['employee_id']}} {{-- {{$user_meta['user_shift'] }} --}}</td>
							<td>{{@$vals['name']}}</td>

							<td>{{@$designation}}</td>
							<td>{{@$department}}</td>
						@if($lock_status)
							<td> {!! Form::hidden($emp_id."[shift_id]", @$user_meta['user_shift'],['class' => '']) !!}
								 {!! Form::select($emp_id."[attendance_status]",['present'=>'Present','absent'=>'Absent' , 'leave'=>'Leave','LP'=>'Loss of pay'],@$attendance_status	,['class' => 'browser-default', ]) !!}</td>
									
							@if($punch_in_out && $attendance_mode_machine)
									<td>
									@foreach($punch_in_out as $key =>$val)
									
									<div>
											{!! Form::text($emp_id."[punch_in_out][]",($val == null) ? '--' : $val,['class' => '','id'=>$key.'punch_in_out'.$emp_id]) !!} <a class="del_check">del </a>
									</div>
									@endforeach
									</td>
									@else
									
									
							@endif
							@if($in_out_data && $attendance_mode_system)
								
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
		</div>
		
		@if(@$lock_status==1)
			<div class="col s12 m3 l12 aione-field-wrapper right-align">
				<button class="" type="submit" >Save Attendance
					{{-- <i class="material-icons right">save</i> --}}
				</button>
			</div>
			@endif

		{!! Form::close() !!}
		@endif
	
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
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
	
	.mark-attendance-status{
		display: block;
		width: 10px;
		height: 10px;
		border-radius: 50%;
		margin: 0 auto;
	}
	#mark_attendance_date{
		text-indent: 100px;
	}
	#mark_attendance_date:before{
		content: "\f073";
		font-family: 'font-awesome';
	}

	
</style>
	<script type="text/javascript">
	$(document).on('change', 'input[id="mark_attendance_date"]',function(){
		this.form.submit();

	});
	$(document).ready(function(){
		// $('.add_punch_in_out').hide();
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