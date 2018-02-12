<?php 
	$class_name = FormGenerator::GetMetaValue($collection->fieldMeta,'field_class');
	$field_input_class = "input-".$collection->field_slug;
	$field_input_id = "input_".$collection->field_slug;
	$field_validations = null;
	$field_validation = "";
    $placeholder = FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder');
	$field_validations = FormGenerator::GetMetaValue($collection->fieldMeta,'field_validations');

	$field_conditions = FormGenerator::GetMetaValue($collection->fieldMeta,'field_conditions');

	$field_meta = array(); 

	$field_meta['field_custom_code_theme'] = FormGenerator::GetMetaValue($collection->fieldMeta,'field_custom_code_theme');
	$field_meta['field_custom_code_language'] = FormGenerator::GetMetaValue($collection->fieldMeta,'field_custom_code_language');
	$has_conditions = 0;
	$field_meta = (object) $field_meta;
	if($field_conditions != ''){
		$conditions = json_decode($field_conditions, true);
		// dump($conditions);
		if(!empty($conditions) && @$conditions[0]['condition_value'] != null){
			$has_conditions = 1;
		}
	}

 ?>
<div id="field_<?php echo e($collection->id); ?>" data-conditions="<?php echo e(@$has_conditions); ?>" data-field-type="<?php echo e($collection->field_type); ?>" class="field-wrapper ac field-wrapper-<?php echo e($collection->field_slug); ?> field-wrapper-type-<?php echo e($collection->field_type); ?> <?php echo e($class_name); ?>">
	<?php if(@$settings['form_field_show_label'] || @$settings['form_field_show_description']): ?>
		<?php if(!empty(@$collection->field_title) || !empty(@$collection->field_description)): ?>
			<div id="field_label_<?php echo e($collection->field_slug); ?>" class="field-label">

				<label for="input_<?php echo e($collection->field_slug); ?>">
					<?php if(!empty(@$collection->field_title) && @$settings['form_field_show_label']): ?>
						<h4 class="field-title" id="<?php echo e($collection->field_title); ?>"><?php echo $collection->field_title; ?></h4>
					<?php endif; ?>
					<?php if(!empty(@$collection->field_description) && @$settings['form_field_show_description']): ?>
						<p class="field-description"><?php echo $collection->field_description; ?></p>
					<?php endif; ?>
				</label>

			</div><!-- field label-->
		<?php endif; ?>
	<?php endif; ?>
	

	<div id="field_<?php echo e($collection->field_slug); ?>" class="field field-type-<?php echo e($collection->field_type); ?>">
	
		<?php if(View::exists('common.form.fields.'.$field)): ?>
			<?php echo $__env->make('common.form.fields.'.$field, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php else: ?> 
			<div class="aione-message error">
				<?php echo e(__('messages.form_field_missing')); ?>

			</div>
		<?php endif; ?>
		<?php 
			if(isset($settings['field_variable']) && $settings['field_variable'] == 'slug'){
				$name = $collection->field_slug;
			}else{
				$name = str_replace(' ','_',strtolower($collection->field_slug));
			}
			if(@$options['from'] == 'repeater'){
				$name = strtolower($collection->section->section_slug).'['.$options['loop_index'].']['.$name.']';
			}
		 ?>
		<?php if(@$errors->has($name)): ?>
			<span class="aione-field-error">
			<?php echo e($errors->first($name)); ?>

			</span>
		<?php endif; ?>
	</div><!-- field -->
    <?php 
        $question_repeater = @FormGenerator::GetMetaValue($collection->fieldMeta,'question_repeater');
     ?>
    <?php if($question_repeater == 'yes'): ?>
        <?php echo Form::button('Add More',['class'=>'add_more_text']); ?>

    <?php endif; ?>
    
</div><!-- field wrapper -->