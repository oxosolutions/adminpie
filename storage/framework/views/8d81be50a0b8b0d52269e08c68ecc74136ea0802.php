
<?php $__env->startSection('content'); ?>
	<?php 
	$id = "";
		if(@$data){
			foreach(@$data as $k => $v){
				$newData = $v->name;
				$id = $v->id;
			}
		}
		@$model = ['name' => @$newData];
	 ?>	
<div class="fade-background">
</div>

<div id="projects" class="projects list-view">
	<div class="row">
		<div class="col l9">
			
		</div>
		<div class="col l3">

			<a id="add_new" href="#modal1" class="btn add-new display-form-button" >
				Add Designation
			</a>
			<div id="modal1" class="modal modal-fixed-footer">
			<?php if(@$newData == 'undefined' || @$newData == '' || @$newData == null): ?>
				<?php echo Form::open(['route'=>'store.designation' , 'class'=> 'form-horizontal','method' => 'post']); ?>

			<?php else: ?>
				<?php echo Form::model(@$model,['route'=>'edit.designation' , 'class'=> 'form-horizontal','method' => 'post']); ?>

				<input type="hidden" name="id" value="<?php echo e($id); ?>">
			<?php endif; ?>
				<div class="modal-header">
			    	<h5>Add designation</h5>
			    </div>
			    <div class="modal-content">
			    	
			    	<?php echo FormGenerator::GenerateField('designation',['type' => 'inset']); ?>

			    </div>
			    <div class="modal-footer">
			    	
			    	<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit">Save Designation
								<i class="material-icons right">save</i>
							</button>
			    </div>
			    <?php echo Form::close(); ?>

			</div>
			<div id="add_new_wrapper" class="add-new-wrapper add-form ">
				

					
						
						
						
						
					
				

			</div>	
		</div>
		
	</div>
	<div class="row">
		<div class="col s12 m9 l12 pr-7" >
			
			<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>

		<div class="col s12 m3 l3 pl-7" >
			
			
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
	    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
	  $('#modal1').modal();

	 if($('input[name=name]').val() != ''){
	 	$('.display-form-button').click();
	 }
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>