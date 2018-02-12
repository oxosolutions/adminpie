<?php if(@$settings != null): ?>
	<?php 
		$check_login_logo = $settings->where('key' , 'login-form-show-logo')->first();
		$check_form_show_title = $settings->where('key' , 'login-form-show-title')->first();
		$check_form_show_tagline = $settings->where('key' , 'login-form-show-tagline')->first();
	 ?>
	<?php if($check_login_logo != null): ?>
		<?php if($check_login_logo->value == '1'): ?>
			<?php 
				$logo = $settings->where('key' , 'logo')->first();
			 ?>
				<div style="margin: 0 auto;border-radius: 50%;overflow: hidden;height: 120px;width: 120px;position: relative;">
					<img src="<?php echo e(asset($logo->value)); ?>" style="height: 120px;width: auto;position: absolute;left: 50%;top: 50%;    -webkit-transform: translateY(-50%) translateX(-50%);">
				</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if($check_form_show_title != null): ?>
		<?php if($check_form_show_title->value == '1'): ?>
			<?php 
				$title = $settings->where('key' , 'title')->first();
			 ?>
				<div style="text-align: center;margin: 20px;color: #168dc5;font-size: 25px; line-height: 1.4;">
					<?php echo e($title->value); ?>

				</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if($check_form_show_tagline != null): ?>
		<?php if($check_form_show_tagline->value == '1'): ?>
			<?php 
				$tagline = $settings->where('key' , 'tagline')->first();
			 ?>
				<div style="text-align: center;margin: 20px;color: #888">
					<?php echo e($tagline->value); ?>

				</div>
		<?php endif; ?>
	<?php endif; ?>
	
<?php endif; ?>