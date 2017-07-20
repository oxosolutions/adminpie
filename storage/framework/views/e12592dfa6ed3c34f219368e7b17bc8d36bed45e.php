
<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Edit Customer',
	'add_new' => ''
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="row">
	<div class="col-md-12">
	 <?php echo Form::model($model, ['route'=>['update.client',$model->id ], 'class'=> 'form-horizontal','method' => 'post']); ?>
			<div class="row">
				<div class="col-md-12 ">
					<div class="panel panel-flat">

						<div class="panel-body">
							<?php echo FormGenerator::GenerateSection('clisec2',['type' => 'inset']); ?>

							<input type="hidden" name="user_id" value="<?php echo e($model->user_id); ?>">
							<div class="text-right">
								<button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php echo Form::close(); ?>

	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>