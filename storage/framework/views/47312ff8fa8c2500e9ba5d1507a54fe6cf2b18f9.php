<?php 
$post_id = 9;
$get_slider = get_slider();

$post_meta = get_post_meta($post_id,true);
if(isset($post_meta['post_slider_slug'])){
	$post_slider_slug = $post_meta['post_slider_slug'];

	$slider = get_slider($post_slider_slug);
	$slides = $slider->slides;
	$slider_meta = $slider->meta;

	$slider_attributes = "";
	foreach ($slider_meta as $key => $value) {
		
	}
}
if(!isset($slides)){
	$slides = [];
}
 ?>
<div id="aione_slider" class="aione-slider">
	<div class="wrapper">

		<div id="aione_slider_<?php echo e(rand(111111,999999)); ?>" class="aione-slider-wrapper owl-carousel " <?php echo e(@slider_attributes); ?>>
			<?php $__currentLoopData = @$slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="aione-slider-item">
				<div class="aione-slider-image">
					<img alt="<?php echo e(@$slide->$title); ?>" src="<?php echo e(@$slide->$image); ?>" />
				</div>
				<div class="aione-slider-content">
					<h1 class="aione-slider-heading"><?php echo e(@$slide->$heading); ?></h1>
					<h1 class="aione-slider-subheading"><?php echo e(@$slide->$subheading); ?></h1>
				</div>
			</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
		
	</div><!-- .aione-row --> 
</div><!-- #aione_header -->