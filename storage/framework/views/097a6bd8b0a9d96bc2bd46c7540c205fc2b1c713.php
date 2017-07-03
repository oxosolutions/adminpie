<?php 
	$index=1;
 ?>
<ul>
	<?php $__currentLoopData = $modal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<li>
	<a href="javascript:;">
		<span><i class="fa fa-times" style="float: right;"></i></span>
		<input type="hidden" name="id" value="<?php echo e($value->id); ?>">
		<h2>#<?php echo e($index++); ?><span class="notes_title"><?php echo e($value->title); ?></span> </h2>
		<p class="notes_desc"><?php echo e($value->description); ?></p>
	</a>
	</li>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
