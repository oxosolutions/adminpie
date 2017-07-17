<?php $__env->startSection('content'); ?>
	
<div class="fade-background">
</div>
<div id="projects" class="projects list-view">
	<div class="row">
		<div class="col s12 m9 l12 pr-7" >
			
			<div class="list">
				<div class="col s12 m9 l12 pr-7" style="margin-top: 14px">
			
					<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

				</div>
			</div>
		</div>

		<div class="col s12 m3 l12 pl-7" >
			<a href="#modal1"  class="btn" >
				Add New User
			</a>
			<?php echo Form::open(['method' => 'POST','class' => '','route' => 'store.user']); ?>

			<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'modal1','heading'=>'Add new user','button_title'=>'Save User','section'=>'usesec1']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo Form::close(); ?>

	
			
		</div>
	</div>
</div>



<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>