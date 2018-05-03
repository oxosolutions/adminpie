




	<?php 
		$check_login_logo = get_organization_meta('login-form-show-logo');
		$check_form_show_title = get_organization_meta('login-form-show-title');
		$check_form_show_tagline = get_organization_meta('login-form-show-tagline');


	 ?>
	<?php if($check_login_logo != null): ?>
		<?php if($check_login_logo == '1'): ?>
			<?php 
				$logo = get_organization_meta('logo');

			 ?>
				<div style="margin: 0 auto;border-radius: 50%;overflow: hidden;height: 120px;width: 120px;position: relative;">
					<img src="<?php echo e(asset($logo)); ?>" style="height: 120px;width: auto;position: absolute;left: 50%;top: 50%;    -webkit-transform: translateY(-50%) translateX(-50%);">
				</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if($check_form_show_title != null): ?>
		<?php if($check_form_show_title == '1'): ?>
			<?php 
				$title = get_organization_meta('title');
			 ?>
				<div style="text-align: center;margin: 20px;color: #168dc5;font-size: 25px; line-height: 1.4;">
					<?php echo e($title); ?>

				</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if($check_form_show_tagline != null): ?>
		<?php if($check_form_show_tagline == '1'): ?>
			<?php 
				$tagline = get_organization_meta('tagline');
			 ?>
				<div style="text-align: center;margin: 20px;color: #888">
					<?php echo e($tagline); ?>

				</div>
		<?php endif; ?>
	<?php endif; ?>
	