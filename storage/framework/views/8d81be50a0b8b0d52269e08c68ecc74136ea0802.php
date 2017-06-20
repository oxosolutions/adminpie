
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
 <div class="fixed-action-btn">
    <a class="btn-floating btn-large red">
      <i class="large material-icons">mode_edit</i>
    </a>
    <ul>
      <li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a></li>
      <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
      <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
      <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
    </ul>
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
				<div class="modal-header white-text" style="background-color: rgb(2,136,209)">
			    	<div class="row" style="padding:15px 10px">
			    		<div class="col l7">
			    			<h5 style="margin:0px">Add designation</h5>	
			    		</div>
			    		<div class="col l5 right-align">
			    			<a href="javascript:;" class="closeDialog"><i class="fa fa-close"></i></a>
			    		</div>
			    			
			    	</div>
			    	
			    </div>
			    <div class="modal-content" style="background-color: white">
			    	
			    	<?php echo FormGenerator::GenerateField('designation',['type' => 'inset']); ?>

			    </div>
			    <div class="modal-footer">
			    	
			    	<button class="btn blue" type="submit">Save Designation
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
<style type="text/css">
	.closeDialog{
		color: #fff;
	}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>