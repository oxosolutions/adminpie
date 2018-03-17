
<?php $__env->startSection('content'); ?>
<?php 

	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Survey edit <span></span>',
	'add_new' => '+ Add Feedback'
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
	<div class="ar">
		<div class="ac l25">
			<div class="aione-border">
				<div class="p-10 bg-grey bg-lighten-3">
					Select Fields
				</div>
				<div class="p-10">
					<span class="display-inline-block p-10 bg-grey bg-lighten-3 mb-5" style="width: 49%;">Text</span>
					<span class="display-inline-block p-10 bg-grey bg-lighten-3 mb-5" style="width: 49%;">Textarea</span>
					<span class="display-inline-block p-10 bg-grey bg-lighten-3 mb-5" style="width: 49%;">Select</span>
					<span class="display-inline-block p-10 bg-grey bg-lighten-3 mb-5" style="width: 49%;">Multiselect</span>
					<span class="display-inline-block p-10 bg-grey bg-lighten-3 mb-5" style="width: 49%;">checkbox</span>
					<span class="display-inline-block p-10 bg-grey bg-lighten-3 mb-5" style="width: 49%;">Radio</span>	
				</div>
				
			</div>
		</div>
		<div class="ac l50">
			<div class="aione-border ">
				<div class="p-10 bg-grey bg-lighten-3">
					Select Fields
				</div>
				<div class="aione-accordion p-10">
					<div class="aione-item">
						<div class="aione-item-header">
							section 1
						</div>

						<div class="aione-item-content">
							section 1  fields
						</div>
					</div>
					<div class="aione-item">
						<div class="aione-item-header">
							section 2
						</div>

						<div class="aione-item-content">
							section 1  fields
						</div>
					</div>
					<div class="aione-item">
						<div class="aione-item-header">
							section 3
						</div>

						<div class="aione-item-content">
							section 1  fields
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="ac l25">
			<div class="aione-border p-10">
				<?php echo FormGenerator::GenerateForm('survey_generator_fields'); ?>

			</div>
		</div>
	</div>	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>