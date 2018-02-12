<?php 
$form_id =  $collection->id;
$form_title =  $collection->form_title;
$form_description =  $collection->form_description;
if($formFrom == 'admin'){
	$global = true;
}else{
	$global = false;
}
$form_settings = (object) get_form_meta($form_id,null,true,$global);

$aione_form_border = $aione_form_section_border = $aione_form_field_border = "";

if(@$form_settings->form_border){
	$aione_form_border = "aione-form-border";
}
if(@$form_settings->form_secion_show_border){
	$aione_form_section_border = "aione-form-section-border";
}
if(@$form_settings->form_field_show_border){
	$aione_form_field_border = "aione-form-field-border";
}

 ?>

<div id="aione_form_wrapper_<?php echo e($form_id); ?>" class="aione-form-wrapper aione-form-theme-<?php echo e(@$form_settings->form_theme); ?> aione-form-label-position-<?php echo e(@$form_settings->form_label_position); ?> aione-form-style-<?php echo e(@$form_settings->form_style); ?> <?php echo e($aione_form_border); ?> <?php echo e($aione_form_field_border); ?> <?php echo e($aione_form_section_border); ?>">
	<div class="aione-row">
		<?php if( (@$form_settings->form_show_title && !empty($form_title)) || (@$form_settings->form_show_description && !empty($form_description))): ?>
			<div id="aione_form_header" class="aione-form-header">
				<div class="aione-row">
					<?php if(@$form_settings->form_show_title && !empty($form_title)): ?>
						<h1 class="aione-form-title aione-align-<?php echo e(@$form_settings->form_title_align); ?>"><?php echo e($form_title); ?></h1>
					<?php endif; ?>
					<?php if(@$form_settings->form_show_description && !empty($form_description)): ?>
						<h2 class="aione-form-description aione-align-<?php echo e(@$form_settings->form_description_align); ?>"><?php echo e($form_description); ?></h2>
					<?php endif; ?>
				</div> <!-- .aione-row -->
			</div> <!-- .aione-form-header -->
		<?php endif; ?>
		<div id="aione_form_content" class="aione-form-content">
			<div class="aione-row aione-<?php echo e(@$form_settings->form_section_style); ?>">
			<?php $__currentLoopData = $collection->section; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				
				<?php 
					$options['form_id'] = $collection->id; 
				 ?>
				<?php echo FormGenerator::GenerateSection($section->section_slug, $options,$model, $formFrom); ?>


			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

			</div> <!-- .aione-row -->
		</div> <!-- .aione-form-content -->

		<?php if(@$form_settings->form_show_save_button || @$form_settings->form_show_reset_button ): ?>
		<div id="aione_form_footer" class="aione-form-footer">
			<div class="aione-row">
			<?php 
				$save_button_text = 'Submit';
				$cancel_button_text = 'Cancel';
				if(!empty(@$form_settings->form_save_button_text)){
					$save_button_text = $form_settings->form_save_button_text;
				}
				if(!empty(@$form_settings->form_reset_button_text)){
					$cancel_button_text = $form_settings->form_reset_button_text;
				}
			 ?>

			<?php if(@$form_settings->form_show_save_button): ?>
				<input type="submit" class="aione-button" value="<?php echo e($save_button_text); ?>" />
			<?php endif; ?>
			<?php if(@$form_settings->form_show_reset_button): ?>
				<input type="submit" class="aione-button" value="<?php echo e($cancel_button_text); ?>" />
			<?php endif; ?>
				
			</div> <!-- .aione-row -->
		</div> <!-- .aione-form-footer -->
		<?php endif; ?>

	<textarea class="form_conditions" id="form_<?php echo e($form_id); ?>" style="display: none;"><?php echo e(json_encode(FormGenerator::GetCurrentFormConditions())); ?></textarea>
	</div> <!-- .aione-row -->
</div> <!-- .aione-form-wrapper -->