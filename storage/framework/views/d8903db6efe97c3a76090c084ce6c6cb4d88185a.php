<?php if(Session::has('sucess')): ?>
	<div class="aione-message success">
		<ul class="aione-messages aione-align-center">
			<li class="aione-align-center"><?php echo e(Session::get('sucess')); ?></li>
		</ul>
	</div>
<?php endif; ?> 
 
<?php if(isset($survey_setting['survey_timer'])  && ($survey_setting['survey_timer']==true)): ?>
	<?php if(isset($survey_setting['timer_type']) && ($survey_setting['timer_type']=="survey_expiry_time")): ?>
		<h3>  <?php echo e($survey_setting['survey_time_lefts']); ?> Survey Expired</h3>
 	<?php endif; ?>
<?php endif; ?>
<?php if(!empty($error)): ?>
	<?php if(is_array($error)): ?>
		<div class="aione-message error">
		    <ul class="aione-messages">
		        <li><?php echo e(implode($error)); ?> </li>
		    </ul>
		</div>
	<?php else: ?>
		<div class="aione-message error">
		    <ul class="aione-messages">
		        <li><?php echo e($error); ?> </li>
		    </ul>
		</div>
	<?php endif; ?>
	<?php if(!empty($error['survey_authorization_required'])): ?>
		<a href="<?php echo e(route('org.login')); ?>"> Login </a>
	<?php endif; ?>
<?php endif; ?>