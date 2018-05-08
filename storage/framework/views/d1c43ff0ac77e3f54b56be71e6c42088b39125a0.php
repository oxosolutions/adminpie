<?php 

$check_login_logo = @get_organization_meta('login-form-show-logo');
$check_form_show_title = @get_organization_meta('login-form-show-title');
$check_form_show_tagline = @get_organization_meta('login-form-show-tagline');

$logo = @get_organization_meta('logo');
$title = @get_organization_meta('title');
$tagline = @get_organization_meta('tagline');


 ?>
<style type="text/css">
	
</style>
<?php if($check_login_logo != null): ?>
	<?php if($check_login_logo == '1'): ?>
		<div class="site-logo">
			<img src="<?php echo e(asset($logo)); ?>" >
		</div>
	<?php endif; ?>
<?php endif; ?>
<?php if($check_form_show_title != null): ?>
	<?php if($check_form_show_title == '1'): ?>
		<div class="site-title">
			<?php echo e($title); ?>

		</div>
	<?php endif; ?>
<?php endif; ?>
<?php if($check_form_show_tagline != null): ?>
	<?php if($check_form_show_tagline == '1'): ?>
		<div class="site-tagline">
			<?php echo e($tagline); ?>

		</div>
	<?php endif; ?>
<?php endif; ?>
