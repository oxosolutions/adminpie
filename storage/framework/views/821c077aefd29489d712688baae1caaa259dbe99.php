
<?php $__env->startSection('content'); ?>

<?php 

	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Dashboard',
	'add_new' => '+ Add Widget'
	); 
 ?>

<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div>
		<div class="row">
			<?php $__currentLoopData = $model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="col l3 pr-7">
					<div class="card shadow mt-0" style="">
						<div class="row center-align aione-widget-header" ><h5 class="m-0"><a href="<?php echo e(route($value['route'])); ?>"><?php echo e(ucfirst($key)); ?></a></h5></div>
						<div class="row center-align aione-widget-content" ><?php echo e($value['count']); ?> </div>
						<div class="row center-align aione-widget-footer" >
							<a href="<?php echo e(route($value['route'])); ?>" class="btn" style="background-color: #005A8B">All <?php echo e($key); ?></a>
						</div>
					</div>
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div> 
	<div class="row">	
		<div class="col l6 pr-7">
			<div class="card center-align chk-n-out" >
				<input id="token" type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" >
				<input type="hidden" class="status" value="<?php echo e($check_in_out_status); ?>" >
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
	

	





<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<style type="text/css">
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
			padding: 10px
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


<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>