
<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Services',
	'add_new' => '+ Add Services'
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo Form::open(['route'=>'save.service' , 'class'=> 'form-horizontal','method' => 'post']); ?>

				<div >
					<ul>
						<li><label for="">Service Name</label> <input name="name" type="text"></li>
						<?php 
						$data = 'App\Model\Organization\Category';
						$product_type = $data::category_list_by_type("service");

						 ?>
						<li><label for="">Service type</label> <?php echo Form::select('type',$product_type,null,[]); ?></li>
						<li><label for="">Description</label><textarea name="description" id="" cols="30" rows="10"></textarea></li>
						<li><input type="submit" value="Save"></li>

					</ul>

				</div>
				
			<?php echo Form::close(); ?>

	
	<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>