<?php $__env->startSection('content'); ?>
	<?php if($data): ?>
		<?php
			$id = "";
		?>
		<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php
				$replace = ['"','[',']'];
				$ids = str_replace($replace,'',$value->member_ids);
				$m_ids = explode(',',$ids);
				$member_ids = array_map('intval',$m_ids);
				$id = $value->id;
				$data = [
							'title' 		=> $value->title,
							'description'	=> $value->description,
							'member_ids' 	=> $member_ids
						];
			?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<script type="text/javascript">
			$(window).load(function(){
				document.getElementById('add_new').click();
			});
		</script>
	<?php endif; ?>
<?php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Teams',
	'route' => 'create.team',
	'add_new' => '+ Add New Team' 
); 
?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php if($data): ?>
	<?php echo Form::model($data,['route'=>'edit.team','method'=>'POST']); ?>

	<input type="hidden" name="id" value="<?php echo e($id); ?>">
<?php else: ?>
	<?php echo Form::open(['route'=>'save.team'	,'method'=>'POST']); ?>

<?php endif; ?>	


<?php echo Form::close(); ?>	
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>