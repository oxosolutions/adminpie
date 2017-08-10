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




<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>		
<div class="card">
	<div class="row design-bg">
		
		<div class="col-md-4">
			<div class="row">
				<?php echo Form::open(['route'=>'hr.attendance' , 'method'=>'post'] ); ?>

					<div class="col s3 pr-7 right-align">
						<select name="date"  class="browser-default">
							<?php $__currentLoopData = $daysInMonth; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php if($date==$val): ?>
							<option selected="selected" value="<?php echo e($val); ?>"><?php echo e($val); ?> </option>

								<?php else: ?>
									<option value="<?php echo e($val); ?>"><?php echo e($val); ?> </option>
								<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

						</select>
					</div>


					<div class="col s3 pl-7 pr-7">
						<select name="month" class="browser-default">
							<?php $__currentLoopData = $MO_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($month==$key): ?>
									<option selected="selected" value="<?php echo e($key); ?>"><?php echo e($val); ?> </option>
								<?php else: ?>
									<option value="<?php echo e($key); ?>"><?php echo e($val); ?> </option>
								<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</div>

					<div class="col s3 pl-7 pr-7 right-align">
						<select  name="year" class="browser-default">  
							<?php $__currentLoopData = $year_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php if($year==$val): ?>
							<option selected="selected" value="<?php echo e($val); ?>"><?php echo e($val); ?> </option>

								<?php else: ?>
									<option value="<?php echo e($val); ?>"><?php echo e($val); ?> </option>
								<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

						</select>
					</div>
					<div class="col s3 pl-7">
						<button class="btn blue" type="submit"  style="margin: 6px;width: 100%;">Search
							
						</button>	
					</div>
					
				<?php echo Form::close(); ?>

			</div>
			
			<div class="row">
				<h5 class="design-style"><span>Attendance </span><?php echo e($dateformat); ?></h5>	
			</div>
			
		</div>
		
	</div> 
	<div class="table-responsive">
	<?php if($day=='Sunday'): ?>
		<h1> Sunday off </h1>
	<?php else: ?>
	<?php echo Form::open(['route'=>'hr_store.attendance' , 'method'=>'post'] ); ?>

					<?php echo Form::hidden('dates[year]',$year,['class' => 'form-control']); ?>

					<?php if(strlen($month)==1): ?>
					<?php echo Form::hidden('dates[month]','0'.$month,['class' => 'form-control']); ?>

					<?php else: ?>
					<?php echo Form::hidden('dates[month]',$month,['class' => 'form-control']); ?>

					<?php endif; ?>
					<?php echo Form::hidden('dates[date]',$date,['class' => 'form-control']); ?>

					<?php echo Form::hidden('dates[day]',$day,['class' => 'form-control']); ?>

					<?php echo Form::hidden('dates[month_week_no]',$month_week_no,['class' => 'form-control']); ?>

					
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
			

				<?php $lock_status=1; 
					$attValue =  $attendance_data->toArray();
				?>
				<?php $__currentLoopData = $employee_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keys => $vals): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php  
					$in_out_data = $punch_in_out = $attendance_status = null; 
					$emp_id = $vals['employee_id'];
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
				 ?>

				
					<tr class="table-tr">
						<td><?php echo e($loop->iteration); ?></td>
						<td><?php echo e(@$vals['employee_id']); ?></td>
						<td><?php echo e(@$vals['employ_info']['name']); ?></td>

						<td><?php echo e(@$vals['designations']['name']); ?></td>
						<td><?php echo e(@$vals['department_rel']['name']); ?></td>
					<?php if($lock_status): ?>
						<td> <?php echo Form::select($emp_id."[attendance_status]",['present'=>'Present','absent'=>'Absent' , 'leave'=>'Leave'],@$attendance_status	,['class' => '']); ?></td>
						<?php if($punch_in_out): ?>
								<td>
								<?php $__currentLoopData = $punch_in_out; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div>
										<?php echo Form::text($emp_id."[punch_in_out][]",($val == null) ? '--' : $val,['class' => '','id'=>$key.'punch_in_out'.$emp_id]); ?> <a class="del_check">del </a>
								</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</td>
								<?php else: ?>
								<td><button class="show_punch_in_out">add punch in out time</button> <div class="add_punch_in_out"><?php echo Form::text($emp_id."[punch_in_out][]", null,['class' => '','id'=>$key.'punch_in_out'.$emp_id]); ?>

								<?php echo Form::text($emp_id."[punch_in_out][]",null,['class' => '','id'=>$key.'punch_in_out'.$emp_id]); ?>  </div> </td>
						<?php endif; ?>
						<?php if($in_out_data): ?>
							
								<td>
								<?php $__currentLoopData = $in_out_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php echo e($loop->iteration); ?>

									<?php $__currentLoopData = $val; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ip =>$times): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div>
												 <?php echo e($ip); ?><?php echo Form::text($emp_id."[in_out_data][][$ip]",($times == null) ? '--' : $times,['class' => '','id'=>$key.'in_out_data'.$emp_id]); ?>  <a class="del_check">del </a>
										</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</td>
								<?php else: ?>
								<td>--</td>
							<?php endif; ?>
					<?php else: ?>
						<td><?php echo e(@$attendance_status); ?></td>
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
					</tr>
			

				
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				
			</tbody>
		</table>
		<?php if(@$lock_status==1): ?>
		<div class="col s12 m3 l12 aione-field-wrapper right-align">
			<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit" >Save Attendance
				<i class="material-icons right">save</i>
			</button>
		</div>
		<?php endif; ?>

	<?php echo Form::close(); ?>

	<?php endif; ?>
	</div>
</div>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>