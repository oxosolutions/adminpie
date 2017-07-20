<?php $__env->startSection('content'); ?>

	<?php if($data): ?>

		<?php 
			$id = "";
		 ?>
			<?php 
				$replace = ['"','[',']'];
				$ids = str_replace($replace,'',$data->member_ids);
				$m_ids = explode(',',$ids);
				$member_ids = array_map('intval',$m_ids);
				$id = $data->id;
				$data = [
							'title' 		=> $data->title,
							'description'	=> $data->description,
							'member_ids' 	=> $member_ids
						];
			 ?>
	<?php endif; ?>
<?php 
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Teams',
	'add_new' => '+ Add New Team' 
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>




<?php echo Form::model($data,['route'=>'edit.team','method'=>'POST']); ?>

	<input type="hidden" name="id" value="<?php echo e($id); ?>">
	<?php echo FormGenerator::GenerateSection('prosec2'); ?>

	<input type="submit" value="submit">
<?php echo Form::close(); ?>	
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>