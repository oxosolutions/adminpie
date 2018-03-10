<?php $__currentLoopData = $model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php if($file->extension == 'pdf'): ?>
		<div gallery-item-id="<?php echo e($file->id); ?>" class="gallery-item">
			<div class="icon-wrapper">
				<i class="fa fa-file-pdf-o icon-logo" aria-hidden="true"></i>	
			</div>
			
			<div class="desc">
				<?php echo e($file->original_name); ?><br><span class="size">size: <?php echo e(number_format($file->size / 1024, 2) . ' KB'); ?></span>
			</div>
		</div>
	<?php elseif($file->extension == 'jpg' || $file->extension == 'jpeg' || $file->extension == 'png'): ?>
		<div gallery-item-id="<?php echo e($file->id); ?>" class="gallery-item">
			<img src="<?php echo e(asset('media/'.$file->original_name)); ?>">
			<div class="desc">
				<?php echo e($file->original_name); ?><br><span class="size">size: <?php echo e(number_format($file->size / 1024, 2) . ' KB'); ?></span>
			</div>
		</div>
	<?php elseif($file->extension == 'docx' || $file->extension == 'doc'): ?>
		<div gallery-item-id="<?php echo e($file->id); ?>" class="gallery-item">
			<div class="icon-wrapper">
				<i class="fa fa-file-text-o icon-logo" aria-hidden="true"></i>
			</div>
			<div class="desc">
				<?php echo e($file->original_name); ?><br><span class="size">size: <?php echo e(number_format($file->size / 1024, 2) . ' KB'); ?></span>
			</div>
		</div>
	<?php elseif($file->extension == 'mp4'): ?>
		<div gallery-item-id="<?php echo e($file->id); ?>" class="gallery-item">
			<div class="icon-wrapper">
				<i class="fa fa-file-video-o icon-logo" aria-hidden="true"></i>
			</div>
			<div class="desc">
				<?php echo e($file->original_name); ?><br><span class="size">size: <?php echo e(number_format($file->size / 1024, 2) . ' KB'); ?></span>
			</div>
		</div>
	<?php elseif($file->extension == 'mp3'): ?>
		<div gallery-item-id="<?php echo e($file->id); ?>" class="gallery-item">
			<div class="icon-wrapper">
				<i class="fa fa-file-audio-o icon-logo" aria-hidden="true"></i>
			</div>
			<div class="desc">
				<?php echo e($file->original_name); ?><br><span class="size">size: <?php echo e(number_format($file->size / 1024, 2) . ' KB'); ?></span>
			</div>
		</div>
	<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>