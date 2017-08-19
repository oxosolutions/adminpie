<?php echo $__env->make('common.form.fields.includes.field-wrapper-start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.form.fields.includes.field-label-start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('common.form.fields.includes.label', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.form.fields.includes.field-label-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.form.fields.includes.field-start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo Form::textarea(str_replace(' ','_',strtolower($collection->field_title)),null,['class'=>$collection->field_slug,'id'=>'input_'.$collection->field_slug, 'rows'=>'3', 'cols'=>'100']); ?>

		<?php echo $__env->make('common.form.fields.includes.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.form.fields.includes.field-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.form.fields.includes.field-wrapper-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
