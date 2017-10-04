<?php 
	if($formFrom == 'admin'){
		$global = true;
	}else{
		$global = false;
	}
	$form_settings = (object) get_form_meta($collection->form_id,null,true,$global);
 ?>


<div id="aione_form_section_<?php echo e($collection->id); ?>" class="aione-form-section">
	<div class="aione-row">

		<?php if( (@$form_settings->form_section_show_title && !empty($collection->section_name)) || (@$form_settings->form_show_section_description && !empty($collection->section_description))): ?>
		<div id="aione_form_section_header" class="aione-form-section-header">
			<div class="aione-row">
				<?php if(@$form_settings->form_section_show_title && !empty($collection->section_name)): ?>
					<h3 class="aione-form-section-title aione-align-<?php echo e(@$form_settings->form_section_title_align); ?>"><?php echo e($collection->section_name); ?></h1>
				<?php endif; ?>
				<?php if(@$form_settings->form_section_show_description && !empty($section->section_description)): ?>
					<h4 class="aione-form-section-description aione-align-<?php echo e(@$form_settings->form_section_description_align); ?>"><?php echo e($collection->section_description); ?></h2>
				<?php endif; ?>
			</div> <!-- .aione-row -->
		</div> <!-- .aione-form-header -->
		<?php endif; ?>
		<div id="aione_form_section_content" class="aione-form-section-content">
			<div class="aione-row ar">

			<?php $__currentLoopData = $collection->fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $secKey => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php 
						$options['section_id'] = $collection->id;
					 ?>
					<?php echo FormGenerator::GenerateField($field->field_slug, $options,$model, $formFrom); ?>

			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

			</div> <!-- .aione-row -->
		</div> <!-- .aione-form-content -->

	</div> <!-- .aione-row -->
</div> <!-- .aione-form-section -->