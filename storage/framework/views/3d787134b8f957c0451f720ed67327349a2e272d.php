
<?php $__env->startSection('content'); ?>
<?php 
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Edit Slider <span>'.'test'.'</span>' ,
	'add_new' => 'All Slider',
	'route' => 'create.slider'
	); 
	$id = request()->route()->parameters()['id'];
 ?>
<?php 
	$slider = $model['slider'];
	$model['slider'] = json_decode($slider , true);
	$model['setting'] = json_decode($model['setting'] , true);
	$newModel = [];
	$arrayModel = $model->toArray();

	if(!empty($arrayModel['slider'])){
		foreach($arrayModel['slider'] as $sliderKey => &$singleSlider){
			if(empty($singleSlider['file'])){
				$singleSlider['file'] = '';
			}
		}
	}
 ?> 
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('organization.cms.slider._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<div class="ar">
		<div class="ac l70 ">
			<div class="aione-border p-10">
				<?php if($arrayModel != ''): ?>
					<?php echo Form::model($arrayModel,['route' => 'slider.update' , 'method' => 'post' ,'files' => true]); ?>

				<?php else: ?>
					<?php echo Form::open(['route' => 'slider.update' , 'method' => 'post' ,'files' => true]); ?>

				<?php endif; ?>	
				<input type="hidden" name="slider_id" value="<?php echo e($arrayModel['id']); ?>">

				<div class=" bg-white aione-border bg-lighten-5 mb-10">
			        <div class="aione-title aione-border-top aione-border-right aione-border-left">
			            <h5 class="aione-align-center font-weight-400 m-0 pv-10 bg-grey bg-lighten-4">
			                Edit Slider
			            </h5>
			        </div>
			        <div class="p-10">
						<?php echo FormGenerator::GenerateForm('create_slider_form'); ?>

			        </div>
			    </div>
			    <div class="aione-border mb-10">
			        <div class="aione-title aione-border-top aione-border-right aione-border-left">
			            <h5 class="aione-align-center font-weight-400 m-0 pv-10 bg-grey bg-lighten-4">
			                Slides
			            </h5>
			        </div>
			        <div class="p-10">
						<?php echo FormGenerator::GenerateForm('cms_slides_form',[],$arrayModel); ?>

			        </div>
			    </div>
				<button type="submit">Save</button>
			    <?php echo Form::close(); ?>

			</div>
				

		</div>
		<div class="ac l30 ">
			<div class="aione-border p-10">
				<div class="mb-10 aione-border">
			        <div class="aione-title aione-border-top aione-border-right aione-border-left">
			            <h5 class="aione-align-center font-weight-400 m-0 pv-10 bg-grey bg-lighten-4">
			                Slider Settings
			            </h5>
			        </div>
			        <div>
				        <?php if($model['setting'] != null): ?>
						<?php echo Form::model($model['setting'],['route' => 'settings.save' , 'method' => 'post']); ?>

			        <?php else: ?>
						<?php echo Form::open(['route' => 'settings.save' , 'method' => 'post']); ?>

			        <?php endif; ?>
						<input type="hidden" name="slider_id" value="<?php echo e($id); ?>">
			        	<?php echo FormGenerator::GenerateForm('slider_settings_form'); ?>

			    	<?php echo Form::close(); ?>


			        </div>
			    </div>
			</div>
				
		</div>
	</div>
			
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>