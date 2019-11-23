<?php $__env->startSection('content'); ?>
<?php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Customize <span>'.get_survey_title(request()->route()->parameters()['id']).'</span>',
    'add_new' => '+ Add Media'
); 
$id = "";

?> 

<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('organization.survey._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php if(!empty($error)): ?>
		 <div class="aione-message warning">
		 	<?php echo e($error); ?>

		 </div>
    
    <?php else: ?>
   <?php if(!empty($form['forms_meta'])): ?>
		<?php
			$model =	collect($form['forms_meta'])->mapWithKeys(function($item){
						return [$item['key']=>$item['value']];
				});
		?>
		<?php echo Form::model($model, ['route'=>'save.custom.survey']); ?>


  	<?php else: ?>
	    <?php echo Form::open(['route'=>'save.custom.survey']); ?>

	   <?php endif; ?>
	      <?php echo Form::hidden('form_id',$form['id']); ?>      
	      <?php echo FormGenerator::GenerateForm('custom_code'); ?>

	    <?php echo Form::close(); ?>

	<?php endif; ?>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>