
<?php $__env->startSection('content'); ?>
<?php 
	$id = "";
 ?>
<?php if(@$data): ?>
	<?php $__currentLoopData = @$data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		
		<?php 
			$data = ['name' => $value->name , 'category' => $value->category];
			$id = $value->id;
		 ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<script type="text/javascript">
		$(window).load(function(){
			document.getElementById('add_new').click();
		});
	</script>
<?php endif; ?>
<div class="fade-background">
</div>
<div id="projects" class="projects list-view">
	<div class="row">
		<div class="col s12 m9 l12 pr-7" >
			
			
			
			<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>

		<div class="col s12 m3 l3 pl-7" >
			<a id="add_new" href="#modal1" class="btn add-new display-form-button" >
				Add Project
			</a>
			<?php if(@$data): ?>
				<?php echo Form::model(@$data,['route'=>'update.project', 'class'=> 'form-horizontal','method' => 'post']); ?> 
				<input type="hidden" name="id" value="<?php echo e($id); ?>">
			<?php else: ?>
				<?php echo Form::open(['route'=>'save.project', 'class'=> 'form-horizontal','method' => 'post']); ?>

			<?php endif; ?>
			<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'modal1','heading'=>'Add Projects','button_title'=>'Save','section'=>'prosec1']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			
			<?php echo Form::close(); ?>

			
			
		</div>
	</div>
</div>

<script type="text/javascript">
 $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
  });

</script>
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>