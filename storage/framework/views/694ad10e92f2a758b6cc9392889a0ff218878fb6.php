<div class="col l3" style="line-height: 25px;">
	<?php echo e($collection->field_title); ?>

</div>
<div class="col l9">
	<div class="row">
		<?php 
			$optionValues = json_decode(FormGenerator::GetMetaValue($collection->fieldMeta,'field_options'));
			// dd($optionValues);
		 ?>
		<?php $__currentLoopData = $optionValues->key; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="col l3">
				<?php echo Form::radio(str_replace(' ','_',strtolower($collection->field_title)),$optionValues->key[$loop->index],false,['id'=>str_replace(' ','_',strtolower($collection->field_title)).$loop->index]); ?>

		    	<label for="<?php echo e(str_replace(' ','_',strtolower($collection->field_title)).$loop->index); ?>"><?php echo e($optionValues->value[$loop->index]); ?></label>    
			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
		<div class="error-red">	
			<?php if(@$errors->has()): ?>
				<?php echo e($errors->first(str_replace(' ','_',strtolower($collection->field_title)))); ?>

			<?php endif; ?>
		</div>

	
</div>