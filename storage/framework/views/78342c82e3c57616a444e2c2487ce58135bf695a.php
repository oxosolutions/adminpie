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
<div id="aione_footer" class="aione-footer">
	<div class="row-wrapper">
		<div class="ar">
			<?php $__currentLoopData = @$design_settings['footer_widgets']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $widget_key => $widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if(1): ?>
					<div class="ac <?php echo e(@$column_class); ?>">
						<div class="footer-widget-title">
							<h5><?php echo @$widget['widget_title']; ?></h5>
						</div>
						<div class="footer-widget-content">
							<?php echo @$widget['widget_content']; ?>

						</div>
					</div>
				<?php endif; ?>				
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div><!-- .row-wrapper -->
</div>
<?php endif; ?>

