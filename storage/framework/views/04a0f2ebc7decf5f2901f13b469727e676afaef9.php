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
<div id="projects" class="projects list-view">
	<div class="row">
		<div class="col s12 m12 l3 offset-l9">
			
			<a id="add_new" href="#modal1" class="btn add-new display-form-button" >
				Add New team
			</a>
			<?php if($data): ?>
				<?php echo Form::model($data,['route'=>'edit.team','method'=>'POST']); ?>

				<input type="hidden" name="id" value="<?php echo e($id); ?>">
			<?php else: ?>
				<?php echo Form::open(['route'=>'save.team'	,'method'=>'POST']); ?>

			<?php endif; ?>	
		
			<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'modal1','heading'=>'Add New Team','button_title'=>'Save','section'=>'prosec2']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo Form::close(); ?>

	
			

		</div>

	</div>
	<div class="row">
		<div class="col s12 m12 l12" >
			
			<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>

		
	</div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>