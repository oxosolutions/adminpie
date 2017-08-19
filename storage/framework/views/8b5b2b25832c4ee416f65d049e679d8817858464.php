<?php 
	$fieldType  = '';
	$class_name = FormGenerator::GetMetaValue($collection->fieldMeta,'field_class');
 ?>
<?php if(isset($options['field_type']) && $options['field_type'] == 'array'): ?>
	<?php 
		$fieldType  = '[]';
	 ?>
<?php endif; ?>
<?php if(isset($options['default_value']) && $options['default_value'] != ''): ?>
	<?php 
		$default_value = $options['default_value'];
	 ?>
<?php else: ?>
	<?php 
		$default_value = null;
	 ?>
<?php endif; ?>

<?php echo $__env->make('common.form.fields.includes.field-wrapper-start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.form.fields.includes.field-label-start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('common.form.fields.includes.label', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.form.fields.includes.field-label-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.form.fields.includes.field-start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div>
	</div>
		<?php 
			if(isset($settings['show_placeholder']) && $settings['show_placeholder'] != '' && $settings['show_placeholder'] == 'yes'){
				$placeholder = FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder');
			}else{
				$placeholder = '';
			}
			if(isset($settings['field_variable']) && $settings['field_variable'] == 'slug'){
				$name = $collection->field_slug;
			}else{
				$name = str_replace(' ','_',strtolower($collection->field_slug));
			}
			if(@$options['from'] == 'repeater'){
				// dump($collection->section->section_slug);
				$name = $collection->section->section_slug.'[0]['.$name.']';
			}
		 ?>
		<?php echo Form::text($name,$default_value,['class'=>$collection->field_slug.' '.$class_name,'id'=>'input_'.$collection->field_slug,'placeholder'=>$placeholder, ' data-validation'=>'required']); ?>

		<?php echo $__env->make('common.form.fields.includes.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.form.fields.includes.field-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.form.fields.includes.field-wrapper-end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
