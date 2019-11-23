<?php $__env->startSection('content'); ?>
<?php
	$page_title_data = array(
		'show_page_title' => 'yes',
		'show_add_new_button' => 'no',
		'show_navigation' => 'yes',
		'page_title' => 'Internal error',
		'add_new' => '+ Add Task'
	);
?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div class="ar ">
		<div class="ac l70 error-detail-wrapper">
			<div class="aione-error-title">
				<h4>Something went wrong!</h4>
			</div>
			<div class="aione-error-desc">
				You have experienced Internal Server Error. This might happen due to many reasons. You should try again.
			</div>
			<div style="padding: 30px 0">
				
				<button class="show-details" style="background-color: transparent;border: 1px solid;color: #454545">View Error Details</button>
			</div>
			<div>
				
					

			</div>
		</div>
		<div class="ac l30 aione-align-center">
			<img src="<?php echo e(asset('assets/images/robot-msg-error.png')); ?>" style="width: 200px">
		</div>
	</div>

	<div class="ar" style="background-color: white;max-height: 400px;overflow: auto">
		<div class="error-header" style="border-bottom: 3px solid #DF8220">
			<p style="font-weight: 300;padding: 20px"><span style="color:#0073AA;font-weight: 500">Error: </span><code style="font-size: 14px"><?php echo e($exception->getMessage()); ?></code></p>

		</div>
		<div class="error-content" style="padding: 20px;">
			<code>ERROR CODE : [ <?php echo e($exception->getCode()); ?> ]</code><br>
			<?php

				$filePath = explode('/',$exception->getFile());
				$count = count($filePath);
			?>
			<code>ERROR LOCATION : [ <?php echo e($filePath[$count-3].'/'.$filePath[$count-2].'/'.$filePath[$count-1]); ?> on <b>line: <?php echo e($exception->getLine()); ?></b> ]</code>

		</div>
		
		<?php $__currentLoopData = $exception->getTrace(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $trace): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

			<div class="error-content" style="padding: 15px; border-top:1px solid #CCC; ">
				<?php
					$class = explode('\\',@$trace['class']);
					$class = $class[count($class)-1];
					$file = explode('/',@$trace['file']);
					$file = $file[count($file)-1];
				?>
				<code>at <span style="color: red; font-weight: 100;"><?php echo e($class); ?>-><b><?php echo e($trace['function']); ?></b></span>()</code><br>
				
				<code>in <b><?php echo e(@$file); ?></b> (line <?php echo e(@$trace['line']); ?>)</code>

			</div>

		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		
	</div>
	
		<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>




    	
   
	
</div>
<script type="text/javascript">
	$(document).ready(function() {
		
		$('.show-details').click(function(){
			console.log('abc');	
			$('.error-content').slideToggle();
		})
	})
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>