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
	$lock_status	=1; 
 	$designation 	= $department = null;
 	$attValue 		=  $attendance_data->toArray();

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
	$mark_attendance_date_formatted = $mark_attendance_date->format('j')."<sup>".$mark_attendance_date->format('S')."</sup> ".$mark_attendance_date->format('F, Y');
	$dateformat = $mark_attendance_date->toDayDateTimeString();
?>
<div class="ar aione-border pt-10 mb-15">
	<div class="ac l60 line-height-40">
		{!! @$mark_attendance_date_formatted !!} 
	</div>
	<div class="ac l40">
		{!!Form::open(['route'=>'hr.attendance' , 'method'=>'post','class'=>'ar'] )!!}
			<div data-field-type="text" style="width: 40px;" class="aione-float-right field-wrapper  field-wrapper-name field-wrapper-type-text ">
				<div id="field_name" class="field field-type-text ">
					<input id="mark_attendance_date" type="date" name="mark-attendance-date" value="{{$mark_attendance_date}}" class="datepicker" >
				</div>
			</div>
		{!!Form::close()!!}	
	</div>
</div>

{!!Form::open(['route'=>'hr_store.attendance' , 'method'=>'post'] )!!}
	{!! Form::hidden('dates[year]',$mark_attendance_date->year,['class' => 'form-control']) !!}
	@if(strlen($mark_attendance_date->month)==1)
	{!! Form::hidden('dates[month]','0'.$mark_attendance_date->month,['class' => 'form-control']) !!}
	@else
	{!! Form::hidden('dates[month]',$mark_attendance_date->month,['class' => 'form-control']) !!}
	@endif
	{!! Form::hidden('dates[date]',$mark_attendance_date->day,['class' => 'form-control']) !!}
	{!! Form::hidden('dates[day]',$mark_attendance_date->format('l'),['class' => 'form-control']) !!}
	{!! Form::hidden('dates[month_week_no]',$mark_attendance_date->weekOfMonth,['class' => 'form-control']) !!}
<div class="aione-table">
<table class="">
	<thead class="bg-grey bg-darken-3 grey lighten-2">
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
			<th>Locked</th>
			<th>Warning</th>
 		</tr>
	</thead>
	<tbody>
	@foreach($employee_data as $keys => $vals)
	@php
		$lock_status=1;
		$warning=Null;
 		$attendance_status_class = 'bg-red';
		$user_meta  = $vals->metas_for_attendance->mapwithKeys(function($item){
			return [$item['key'] => $item['value'] ];
		});
		$emp_id = $user_meta['employee_id'];
		if(empty($user_meta['date_of_joining'])){
			continue;
		}
		if(empty($user_meta['employee_id'])){
			$warning ="Invalid Employee Id"; 
		}else{
		
		if(date('Y-m-d', strtotime($user_meta['date_of_joining'])) > date('Y-m-d', strtotime($dateformat)) || ( !empty($user_meta['date_of_leaving']) && date('Y-m-d', strtotime($user_meta['date_of_leaving'])) < date('Y-m-d', strtotime($dateformat)))) {
				continue;
		}
		if(!empty($user_meta['user_shift'])){
			$shifts =	EmployeeHelper::get_shift($user_meta['user_shift']);
			
			if(empty($shifts["from"])  || empty($shifts["to"]) || empty($shifts["working_days"])){
				$warning =  "Invalid Shift";
			}

		}else{
			$warning =  "Invalid Shift";
		}
		
		if(empty($shifts)){
			 $warning = "Invalid Shift";
		}
 		if(!empty($user_meta['designation'])){
 			$designation =	EmployeeHelper::get_designation($user_meta['designation']);
 		}
 		if(!empty($user_meta['department'])){
 			$department =	EmployeeHelper::get_department($user_meta['department']);
 		}
 		$in_out_data = $punch_in_out = $attendance_status = null; 
		if(!empty($attValue[$emp_id]['attendance_status'])){
			$attendance_status = $attValue[$emp_id]['attendance_status'];
		}
		if(!empty($attValue[$emp_id]['punch_in_out'])){
			$punch_in_out = array_filter(json_decode($attValue[$emp_id]['punch_in_out'],true));
		}
		if(!empty($attValue[$emp_id]['in_out_data'])){
			$in_out_data = array_filter(json_decode($attValue[$emp_id]['in_out_data'],true));
		}
		if(isset($attValue[$emp_id]['lock_status']) && $attValue[$emp_id]['lock_status'] ==0 ){
			$lock_status = 0;
		}
	}
	@endphp
		<tr class="table-tr">
			<td><span class="mark-attendance-status {{@$attendance_status_class}}"></span></td>
			<td>{{@$user_meta['employee_id']}} </td>
			<td>{{@$vals['name']}}</td>
			<td>{{@$designation}}</td>
			<td>{{@$department}}</td>
			@if(empty($warning))

				@if($lock_status)
					@if($attendance_mode_manual)
						<td style="text-align: center;">
							{!! Form::hidden($emp_id."[shift_id]", @$user_meta['user_shift'],['class' => '']) !!}
                            @if($attendance_status != 'leave')
							{!! Form::select($emp_id."[attendance_status]",['present'=>'Present','absent'=>'Absent' ],@$attendance_status	,['class' => 'browser-default', ]) !!} 
                            @else
                                Leave
                                {!! Form::hidden($emp_id."[attendance_status]", 'leave',['class' => '']) !!}
                            @endif
						</td>
					@endif
					@if($attendance_mode_machine)
						<td style="width: 130px;">
						@if(!empty($punch_in_out) )
							@foreach($punch_in_out as $key =>$val)
								<div class="field-wrapper position-relative" style="position: relative;">
									<div class="field field-type-text">
									{!! Form::text($emp_id."[punch_in_out][]",($val == null) ? '--' : $val,['class' =>'remove_punch aione-float-left'.$emp_id,'id'=>$key.'punch_in_out'.$emp_id]) !!} 	 
										<a emp_id="{{$emp_id}}"  class="del_check position-absolute grey darken-2" style="position:absolute;top:10px;
										right: 10px;"><i class="fa fa-trash"></i> </a>	
									</div> 
								</div>
							@endforeach
								<span class="{{$emp_id}}"> </span>
									<a emp_id="{{$emp_id}}" class="add_more_punch aione-button m-0" style="width: 100%">+ Add</a>
							@else
							<div class="field-wrapper " style="position: relative;">
								<div class="field field-type-text">
									{!! Form::text($emp_id."[punch_in_out][]",null,['class' => 'timepicker remove_in_out'.$emp_id ,'id'=>'punch_in_out'.$emp_id]) !!}
								</div>
							</div>
							<span class="{{$emp_id}}"> </span>
							<a emp_id="{{$emp_id}}" class="add_more_punch aione-button m-0" style="width: 100%">+ Add</a>
							@endif
						</td>
					@endif
					@if($attendance_mode_system)                           
							<td style="width: 130px;">
								@if(!empty($in_out_data))
								 @foreach($in_out_data as $key =>$val)
								 <div>
								 	<div class="field-wrapper ">
									<div class="field field-type-text">
									 {!! Form::text($emp_id."[in_out_data][]",($val == null) ? '--' : $val,['class' => 'mb-10','id'=>$key.'in_out_data'.$emp_id]) !!}  
									 <a class="del_check position-absolute grey darken-2" style="position:absolute;top:10px;
										right: 10px;"><i class="fa fa-trash"></i> </a>
									</div>
								</div>
								</div>
								@endforeach
								<span class="in_out{{$emp_id}}"> </span>
								<a emp_id="{{$emp_id}}" class="add_more_in_out aione-button">+ Add</a> 
								@else
								<div>
									<div class="field-wrapper ">
										<div class="field field-type-text">
										 {!! Form::text($emp_id."[in_out_data][]",null,['class' => 'timepicker', 'id'=>'in_out_data'.$emp_id]) !!} 
										 	<span class="in_out{{$emp_id}}"> </span>
										</div>
									</div>

								</div>

								<a emp_id="{{$emp_id}}" class="add_more_in_out aione-button" style="width: 84%">+ Add</a> 

								@endif
							</td>
						@endif
				@else
					@if($attendance_mode_manual)
						<td>{{@$attendance_status}}</td>
					@endif
					@if($attendance_mode_machine)
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
					@endif
					@if($attendance_mode_system)
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
				@endif
			@else
				@if($attendance_mode_system)
					<td> </td>
				@endif
				@if($attendance_mode_manual)
					<td></td>
				@endif
				@if($attendance_mode_machine)
					<td></td>
				@endif
			@endif
				<td>{{($lock_status)?'Unlocked':'Locked'}}</td>
				<td>{{@$warning}}</td>
		</tr>
	@endforeach
	</tbody>
</table>	
</div>
	<div class="col s12 m3 l12 aione-field-wrapper right-align">
		<button class="" type="submit" >Save Attendance
		</button>
	</div>
{!! Form::close() !!}
	
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')	
	<style type="text/css">
		.field-wrap{
			position: relative;
		}
		.field-wrap .delete-btn{
			position: absolute;
			right: 10px;
			top: 12px;
			color: red;
		}
		.timepicker{
			margin-bottom: 10px !important;
		}
		.field{
			padding: 0;
		}
	</style>
	<script type="text/javascript">
	$(document).on('change', 'input[id="mark_attendance_date"]',function(){
		this.form.submit();

	});
	$(document).on('click','.add_more_punch', function(){
		

		emp_id = $(this).attr('emp_id');
		$('.'+emp_id).append('<div class="field-wrapper "> <div class="field field-type-text field-wrap"><input class="timepicker remove_punch'+emp_id+'"  name="'+emp_id +'[punch_in_out][]" type="text"> <a class="del_check delete-btn del_punch'+emp_id+'"" emp_id="'+emp_id+'"><i class="fa fa-close red></i>" </a></div><script type="text/javascript"> $(".timepicker").pickatime({ default: "now", twelvehour: false, donetext: "OK", autoclose: false, vibrate: true })</sc'+'ript></div>')
	});
	$(document).on('click','.add_more_in_out', function(){
		emp_id = $(this).attr('emp_id');
		$('.in_out'+emp_id).append('<div class="field-wrapper "> <div class="field field-type-text field-wrap mt-10"><input class="timepicker remove_in_out '+emp_id+'"  name="'+emp_id +'[in_out_data][]" type="text"><a class="del_check delete-btn del_in_out'+emp_id+'" emp_id="'+emp_id+'"><i class="fa fa-close red></i>" </a></div><script type="text/javascript"> $(".timepicker").pickatime({ default: "now", twelvehour: false, donetext: "OK", autoclose: false, vibrate: true })</sc'+'ript></div>')
	});

	$(document).on('click','.show_punch_in_out',function(e){
		e.preventDefault();
		$(this).siblings('.add_punch_in_out').toggle();
	});
	$(document).on('click','.del_check',function(e){
		e.preventDefault();
		emp_id = $(this).attr('emp_id');
//		alert(emp_id);
		$(this).parents('.field-wrapper ').remove();
//		$('.del_punch'+emp_id).remove();
	});
		$(document).ready(function(){
			$('.timepicker').pickatime({
			   default: 'now',
			   twelvehour: false, // change to 12 hour AM/PM clock from 24 hour
			   donetext: 'OK',
				 autoclose: false,
				 vibrate: true // vibrate the device when dragging clock hand
			});
			$('.datepicker').pickadate({
			    selectMonths: true, // Creates a dropdown to control month
			    selectYears: 15, // Creates a dropdown of 15 years to control year,
			    today: 'Today',
			    clear: 'Clear',
			    close: 'Ok',
			    closeOnSelect: false, // Close upon selecting a date,
			    format:'dd-mm-yyyy'
			  });
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

<script type="text/javascript"> $(".timepicker").pickatime({ default: "now", twelvehour: false, donetext: "OK", autoclose: false, vibrate: true }); </script>