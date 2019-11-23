<?php
$sidebar_small = 1;
	$orgData = App\Model\Admin\GlobalGroup::where('id',Auth::guard('group')->user()->group_id)->first();

	$sidebar_small = App\Model\Group\GroupUserMeta::where(['user_id'=>Auth::guard('group')->user()->id,'key'=>'layout_sidebar_small'])->first();

	if(!empty($sidebar_small)){
		$sidebar_small = $sidebar_small->value;
	}
?>
<style type="text/css">
	.aione-main.sidebar-small .side-bar-text{
		display: none
	}
</style>
<input type="hidden"  name="_token" value="<?php echo e(csrf_token()); ?>">
<div id="aione_header_left" class="aione-header-left">
	<div class="aione-row">
		<div class="aione-header-item aione-nav-toggle">
			<a href="#" class="nav-toggle <?php echo e(($sidebar_small == 1)?'active':''); ?>"></a>
		</div>
		<?php if(@$show_logo): ?>
			<?php if(!empty($site_logo)): ?>
				<div class="aione-header-item aione-logo">
					<img src="<?php echo e(asset($site_logo)); ?>" />
				</div> <!-- .aione-header-item -->
			<?php endif; ?>
		<?php endif; ?>
				<div class="aione-header-item aione-site-title">
					 <h1 class="site-title"><?php echo e($orgData->name); ?></h1>
				</div> <!-- .aione-header-item -->
		<?php if(@$show_tagline): ?>
			<?php if(!empty($site_tagline)): ?>
				<div class="aione-header-item aione-site-tagline">
					<h2 class="site-tagline"><?php echo e($site_tagline); ?></h2>
				</div> <!-- .aione-header-item -->
			<?php endif; ?>
		<?php endif; ?>
	</div><!-- .aione-row -->
</div><!-- #aione_header_left -->
<div id="aione_header_right" class="aione-header-right">
	<div class="aione-row">
	
		<div class="aione-header-item aione-profile">
			<a href="#">
				<img class="user-avatar" src="<?php echo e(asset('assets/images/user.png')); ?>" >
			</a>
			<div class="aione-header-widget aione-profile-widget">
				<div class="aione-row">
					<div class="aione-widget-header">
						<h3 class="aione-widget-title">
							Welcome 
							<?php if(Auth::guard('group')->check()): ?>
								<?php echo e(@Auth::guard('group')->user()->name); ?>

							<?php endif; ?>
						</h3>
					</div> <!-- .aione-widget-header -->
					<div class="aione-widget-content">
						<ul class="profile-menu">
							<!--
							<li><a href="#" class="">Profile</a></li>
							
							
							<li><a href="#" class="">Privacy</a></li>
							<li><a href="#" class="">Notifications</a></li>
							<li><a href="#" class="">Settings</a></li>
							-->
						</ul>

					</div> <!-- .aione-widget-content -->
					<div class="aione-widget-footer">
						<div class="aione-widget-footer-left">

						</div> <!-- .aione-widget-footer-left -->
						<div class="aione-widget-footer-right">
							<a href="<?php echo e(route('group.logout')); ?>" class="button aione-button aione-button-small aione-logout-button">Logout</a>
						</div> <!-- .aione-widget-footer-right -->
					</div> <!-- .aione-widget-footer -->
					
				</div> <!-- .aione-row -->
			</div> <!-- .aione-header-widget -->
			
		</div> <!-- .aione-header-item -->
		
		
		
		
		
		
		
		
		
		
	
	</div><!-- .aione-row -->
</div><!-- #aione_header_right -->