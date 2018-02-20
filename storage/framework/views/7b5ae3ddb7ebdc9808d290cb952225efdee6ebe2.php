<?php 
	if($formFrom == 'admin'){
		$global = true;
	}else{
		$global = false;
	}
	$form_settings = (object) get_form_meta($collection->form_id,null,true,$global);
 ?>
<style type="text/css">
	.repeater-wrapper .repeater-row > i{
		z-index: 999999
	}
</style>
<div class="repeater-group <?php echo e(@$collection->section_slug); ?>" >
	<?php if($model != null && !empty($model[strtolower($collection->section_slug)])): ?>
		<div class="repeater-wrapper" id="sortable-options">
			<?php if(@$model[strtolower($collection->section_slug)] != ''): ?>
				<?php 
					$fieldOptions = $model[strtolower($collection->section_slug)];

					if(!is_array($fieldOptions)){
						$fieldOptions = json_decode($fieldOptions,true);
					}
				 ?>
			<?php endif; ?>
			<?php $__currentLoopData = $fieldOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="repeater-row ar">
					<i class="material-icons dp48 repeater-row-delete" style="z-index: 999999;">close</i>
					<div id="aione_form_section_<?php echo e($collection->id); ?>" class="aione-form-section">
						<div class="aione-row">
								
							<?php if( (@$form_settings->form_section_show_title && !empty($collection->section_name)) || (@$form_settings->form_show_section_description && !empty($collection->section_description))): ?>
								<div id="aione_form_section_header" class="aione-form-section-header">
									<div class="aione-row">
										<?php if(@$form_settings->form_section_show_title && !empty($collection->section_name)): ?>
											<h3 class="aione-form-section-title aione-align-<?php echo e(@$form_settings->form_section_title_align); ?>"><?php echo e($collection->section_name); ?></h3>
										<?php endif; ?>
										<?php if(@$form_settings->form_section_show_description && !empty($section->section_description)): ?>
											<h4 class="aione-form-section-description aione-align-<?php echo e(@$form_settings->form_section_description_align); ?>"><?php echo e($collection->section_description); ?></h4>
										<?php endif; ?>
									</div> <!-- .aione-row -->
								</div> <!-- .aione-form-header -->
							<?php endif; ?>
							<div id="aione_form_section_content" class="aione-form-section-content">
								<div class="aione-row ar">
									<?php 
										$options = [];
										$options['loop_index'] = $loop->index;
									 ?>
									<?php $__currentLoopData = $collection->fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $secKey => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php 
											$default_value = '';
											$options['from'] = 'repeater';
											$options['section_id'] = $collection->id;
											$default_value = @$value[$field->field_slug];
										 ?>
											<?php echo FormGenerator::GenerateField($field->field_slug, $options,$default_value, $formFrom); ?>	
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div> <!-- .aione-row -->
							</div> <!-- .aione-form-content -->

							</div> <!-- .aione-row -->
						</div> <!-- .aione-form-section -->
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	<?php else: ?>
		<div class="repeater-wrapper">
				<div class="repeater-row ar">
				<i class="material-icons dp48 repeater-row-delete">close</i>
				<div id="aione_form_section_<?php echo e($collection->id); ?>" class="aione-form-section">
					<div class="aione-row">
							
						<?php if( (@$form_settings->form_section_show_title && !empty($collection->section_name)) || (@$form_settings->form_show_section_description && !empty($collection->section_description))): ?>
							<div id="aione_form_section_header" class="aione-form-section-header">
								<div class="aione-row">
									<?php if(@$form_settings->form_section_show_title && !empty($collection->section_name)): ?>
										<h3 class="aione-form-section-title aione-align-<?php echo e(@$form_settings->form_section_title_align); ?>"><?php echo e($collection->section_name); ?></h3>
									<?php endif; ?>
									<?php if(@$form_settings->form_section_show_description && !empty($section->section_description)): ?>
										<h4 class="aione-form-section-description aione-align-<?php echo e(@$form_settings->form_section_description_align); ?>"><?php echo e($collection->section_description); ?></h4>
									<?php endif; ?>
								</div> <!-- .aione-row -->
							</div> <!-- .aione-form-header -->
						<?php endif; ?>
						<div id="aione_form_section_content" class="aione-form-section-content">
							<div class="aione-row ar">

								
								<?php $__currentLoopData = $collection->fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $secKey => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php 
										$options['from'] = 'repeater';
										$options['section_id'] = $collection->id;
										$options['loop_index'] = 0;
									 ?>
										<?php echo FormGenerator::GenerateField($field->field_slug, $options,'', $formFrom); ?>	
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
									
						</div> <!-- .aione-row -->
					</div> <!-- .aione-form-content -->

					</div> <!-- .aione-row -->
				</div> <!-- .aione-form-section -->
			</div>
		</div>
	<?php endif; ?>
	
		
	<button type="submit" class="aione-float-right aione-button add-new-repeater">Add New</button>
	<div style="clear: both">
		
	</div>
	
</div>