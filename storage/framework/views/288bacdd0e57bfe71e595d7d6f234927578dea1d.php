<?php 
	$footer_widgets = $design_settings['footer_widgets'];
	$count = 0;
	foreach ($footer_widgets as $key => $widget) {
		if(1){
			$count++;
		}
	}
	$column_class = "s100 m".round(100/$count)." l".round(100/$count);
	
 ?>
<?php if($count > 0): ?>
<div id="aione_footer" class="aione-footer <?php echo e(@$design_settings['footer_theme']); ?>">
	
	<div class="wrapper aione-align-left font-weight-100">
		<div class="ar pv-30 pl-5p pr-5p">
			<?php $__currentLoopData = @$design_settings['footer_widgets']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $widget_key => $widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if(1): ?>
					<div class="ac <?php echo e(@$column_class); ?>">
						
						<h5 class="mt-10 white"><?php echo @$widget['widget_title']; ?></h5>
						
						<nav id="aione_nav" class="aione-nav vertical dark slide-up">
							<ul id="aione_menu" class="aione-menu">
								<?php echo @$widget['widget_content']; ?>

							</ul>
						</nav>
					</div>
				<?php endif; ?>				
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div><!-- .row-wrapper -->
	
</div>
</div><!-- .aione-footer -->
<?php endif; ?>

