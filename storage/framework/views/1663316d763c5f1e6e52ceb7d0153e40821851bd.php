<?php $__env->startSection('content'); ?>
<?php 
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Attendence',
	'add_new' => '+ Import Attendence'
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('organization.attendance._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
		<?php echo @$mark_attendance_date_formatted; ?> 
	</div>
	<div class="ac l40">
		<?php echo Form::open(['route'=>'hr.attendance' , 'method'=>'post','class'=>'ar'] ); ?>

			<div data-field-type="text" style="width: 40px;" class="aione-float-right field-wrapper  field-wrapper-name field-wrapper-type-text ">
				<div id="field_name" class="field field-type-text ">
					<input id="mark_attendance_date" type="date" name="mark-attendance-date" value="<?php echo e($mark_attendance_date); ?>" class="datepicker" >
				</div>
			</div>
		<?php echo Form::close(); ?>	
	</div>
</div>

<?php echo Form::open(['route'=>'hr_store.attendance' , 'method'=>'post'] ); ?>

	<?php echo Form::hidden('dates[year]',$mark_attendance_date->year,['class' => 'form-control']); ?>

	<?php if(strlen($mark_attendance_date->month)==1): ?>
	<?php echo Form::hidden('dates[month]','0'.$mark_attendance_date->month,['class' => 'form-control']); ?>

	<?php else: ?>
	<?php echo Form::hidden('dates[month]',$mark_attendance_date->month,['class' => 'form-control']); ?>

	<?php endif; ?>
	<?php echo Form::hidden('dates[date]',$mark_attendance_date->day,['class' => 'form-control']); ?>

	<?php echo Form::hidden('dates[day]',$mark_attendance_date->format('l'),['class' => 'form-control']); ?>

	<?php echo Form::hidden('dates[month_week_no]',$mark_attendance_date->weekOfMonth,['class' => 'form-control']); ?>

<div class="aione-table">
<table class="">
	<thead>
		<tr class="table-tr">
			<th>Status</th>
			<th>Employee</th>
			<th>Name</th>
			<th>Designation</th>
			<th>Department</th>
			<?php if($attendance_mode_manual): ?>
			<th>Attendance Status</th>
			<?php endif; ?>
			<?php if($attendance_mode_machine): ?>
			<th>Punch In Out</th>
			<?php endif; ?>
			<?php if($attendance_mode_system): ?>
			<th>Check In Out</th>
			<?php endif; ?>
			<th>Locked</th>
			<th>Warning</th>
 		</tr>
	</thead>
	<tbody>
	<?php $__currentLoopData = $employee_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys => $vals): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php  
		$lock_status = 1;
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
	 ?>
		<tr class="table-tr">
			<td><span class="mark-attendance-status <?php echo e(@$attendance_status_class); ?>"></span></td>
			<td><?php echo e(@$user_meta['employee_id']); ?> </td>
			<td><?php echo e(@$vals['name']); ?></td>
			<td><?php echo e(@$designation); ?></td>
			<td><?php echo e(@$department); ?></td>
			<?php if(empty($warning)): ?>

				<?php if($lock_status): ?>
					<?php if($attendance_mode_manual): ?>
						<td> 
							<?php echo Form::hidden($emp_id."[shift_id]", @$user_meta['user_shift'],['class' => '']); ?>

							<?php echo Form::select($emp_id."[attendance_status]",['present'=>'Present','absent'=>'Absent' ],@$attendance_status	,['class' => 'browser-default', ]); ?> 
						</td>
					<?php endif; ?>
					<?php if($attendance_mode_machine): ?>
						<td style="width: 130px;">
						<?php if(!empty($punch_in_out) ): ?>
							<?php $__currentLoopData = $punch_in_out; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="field-wrapper position-relative" style="position: relative;">
									<div class="field field-type-text">
									<?php echo Form::text($emp_id."[punch_in_out][]",($val == null) ? '--' : $val,['class' =>'remove_punch aione-float-left'.$emp_id,'id'=>$key.'punch_in_out'.$emp_id]); ?> 	 
										<a emp_id="<?php echo e($emp_id); ?>"  class="del_check position-absolute grey darken-2" style="position:absolute;top:10px;
										right: 10px;"><i class="fa fa-trash"></i> </a>	
									</div> 
								</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<span class="<?php echo e($emp_id); ?>"> </span>
									<a emp_id="<?php echo e($emp_id); ?>" class="add_more_punch aione-button m-0" style="width: 100%">+ Add</a>
							<?php else: ?>
							<div class="field-wrapper " style="position: relative;">
								<div class="field field-type-text">
									<?php echo Form::text($emp_id."[punch_in_out][]",null,['class' => 'timepicker remove_in_out'.$emp_id ,'id'=>'punch_in_out'.$emp_id]); ?>

								</div>
							</div>
							<span class="<?php echo e($emp_id); ?>"> </span>
							<a emp_id="<?php echo e($emp_id); ?>" class="add_more_punch aione-button m-0" style="width: 100%">+ Add</a>
							<?php endif; ?>
						</td>
					<?php endif; ?>
					<?php if($attendance_mode_system): ?>
							<td style="width: 130px;">
								<?php if(!empty($in_out_data)): ?>
								 <?php $__currentLoopData = $in_out_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								 <div>
								 	<div class="field-wrapper ">
									<div class="field field-type-text mb-10">
									 <?php echo Form::text($emp_id."[in_out_data][]",($val == null) ? '--' : $val,['class' => '','id'=>$key.'in_out_data'.$emp_id]); ?>  
									 <a class="del_check position-absolute grey darken-2" style="position:absolute;top:10px;
										right: 10px;"><i class="fa fa-trash"></i> </a>
									</div>
								</div>
								</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<span class="in_out<?php echo e($emp_id); ?>"> </span>
								<a emp_id="<?php echo e($emp_id); ?>" class="add_more_in_out aione-button">+ Add</a> 
								<?php else: ?>
								<div>
									<div class="field-wrapper ">
										<div class="field field-type-text">
										 <?php echo Form::text($emp_id."[in_out_data][]",null,['class' => 'timepicker', 'id'=>'in_out_data'.$emp_id]); ?> 
										 	<span class="in_out<?php echo e($emp_id); ?>"> </span>
										</div>
									</div>

								</div>

								<a emp_id="<?php echo e($emp_id); ?>" class="add_more_in_out aione-button" style="width: 84%">+ Add</a> 

								<?php endif; ?>
							</td>
						<?php endif; ?>
				<?php else: ?>
					<?php if($attendance_mode_manual): ?>
						<td><?php echo e(@$attendance_status); ?></td>
					<?php endif; ?>
					<?php if($attendance_mode_machine): ?>
						<?php if($punch_in_out): ?>
							<td>
							<?php $__currentLoopData = $punch_in_out; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div>
									<?php echo e(($val == null) ? '--' : $val); ?>

							</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</td>
						<?php else: ?>
							<td>--</td>
						<?php endif; ?>
					<?php endif; ?>
					<?php if($attendance_mode_system): ?>
						<?php if($in_out_data): ?>
							<td>
								<?php $__currentLoopData = $in_out_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php echo e($loop->iteration); ?>

									<?php $__currentLoopData = $val; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ip =>$times): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div>
											<?php echo e($ip); ?><?php echo e(($times == null) ? '--' : $times); ?>

										</div>

									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</td>
								<?php else: ?>
								<td>--</td>
							<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>
			<?php else: ?>
				<?php if($attendance_mode_system): ?>
					<td> </td>
				<?php endif; ?>
				<?php if($attendance_mode_manual): ?>
					<td></td>
				<?php endif; ?>
				<?php if($attendance_mode_machine): ?>
					<td></td>
				<?php endif; ?>
			<?php endif; ?>
				<td><?php echo e(($lock_status)?'Unlocked':'Locked'); ?></td>
				<td><?php echo e(@$warning); ?></td>
		</tr>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</tbody>
</table>	
</div>
	<div class="col s12 m3 l12 aione-field-wrapper right-align">
		<button class="" type="submit" >Save Attendance
		</button>
	</div>
<?php echo Form::close(); ?>

	
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>	
	<style type="text/css">
		.field-wrap{
			position: relative;
		}
		.field-wrap .delete-btn{
			position: absolute;
			right: 10px;
			top: 12px;
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
		$('.in_out'+emp_id).append('<div class="field-wrapper "> <div class="field field-type-text field-wrap"><input class="timepicker remove_in_out'+emp_id+'"  name="'+emp_id +'[in_out_data][]" type="text"><a class="del_check delete-btn del_in_out'+emp_id+'" emp_id="'+emp_id+'"><i class="fa fa-close red></i>" </a></div><script type="text/javascript"> $(".timepicker").pickatime({ default: "now", twelvehour: false, donetext: "OK", autoclose: false, vibrate: true })</sc'+'ript></div>')
	});

	$(document).on('click','.show_punch_in_out',function(e){
		e.preventDefault();
		$(this).siblings('.add_punch_in_out').toggle();
	});
	$(document).on('click','.del_check',function(e){
		e.preventDefault();
		emp_id = $(this).attr('emp_id');
		alert(emp_id);
		$('.remove_punch'+emp_id).remove();
		$('.del_punch'+emp_id).remove();
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
<?php $__env->stopSection(); ?>

<script type="text/javascript"> $(".timepicker").pickatime({ default: "now", twelvehour: false, donetext: "OK", autoclose: false, vibrate: true }); </script>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>