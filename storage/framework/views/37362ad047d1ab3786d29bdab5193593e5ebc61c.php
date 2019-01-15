<style type="text/css">
	.aione-topbar-item p {
		margin-top: 8px;
	}
	.aione-topbar-logo-item{
		height: 60px;
	    width: 60px;
	    border-radius: 100%;
	}
	.aione-header-logo{
		width: 40%;
    	float: left;
	}
	.aione-header-menu #aione_menu{
		float: right
	}
	.aione-header-logo .grey{
		margin-top: 2px;
	}
</style>
<?php if(@$design_settings['topbar_left_widgets'] || @$design_settings['topbar_right_widgets']): ?>
	<div id="aione_topbar" class="aione-topbar">
		
		<div class="row-wrapper">
			<div class="ar">
				<div class="ac l50 m50 s100 left-content">
					<?php if(@$design_settings['topbar_left_widgets']): ?>
						<?php $__currentLoopData = @$design_settings['topbar_left_widgets']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $widget_key => $widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div id="" class="aione-topbar-item">
								<p><?php echo @$widget['widget_content']; ?></p>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
				</div>
				<div class="ac l50 m50 s100 right-content">
					<?php if(@$design_settings['topbar_right_widgets']): ?>
						<?php $__currentLoopData = @$design_settings['topbar_right_widgets']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $widget_key => $widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div id="" class="aione-topbar-item" >
								<?php echo @$widget['widget_content']; ?>

							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
				</div>
			</div>
		</div><!-- .row-wrapper -->
	</div><!-- #aione_header -->
<?php endif; ?>