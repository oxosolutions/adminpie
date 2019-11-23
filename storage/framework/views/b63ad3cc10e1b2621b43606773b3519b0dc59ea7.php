<?php $__env->startSection('content'); ?>
<?php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => __('organization/datasets.list_dataset_page_title_text'),
	'add_new' => __('organization/datasets.add_dataset_button_text'),
	'route' => 'create.dataset',
	'second_button_title' => __('organization/datasets.import_dataset_button_text'),
	'second_button_route' => 'import.dataset',
); 
?>	
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  
   
<div id="projects" class="projects list-view">
	<div class="row">
		<div class="col l3  pl-7" style="float: right;margin-bottom: 14PX;">
			
				
				<div id="add_new_model" class="modal modal-fixed-footer ">
					<?php echo Form::open(['route'=>'save.dataset' , 'class'=> 'form-horizontal','method' => 'post']); ?>

					<div class="modal-header white-text  blue darken-1">
						<div class="row" style="padding:15px 10px;margin: 0px">
							<div class="col l7 left-align">
								<h5 style="margin:0px"><?php echo e(__('organization/datasets.create_dataset')); ?></h5>	
							</div>
							<div class="col l5 right-align">
								<a href="javascript:;" name="closeModel" onclick="close()" id="closemodal" class="closeDialog close-model-button" style="color: white"><i class="fa fa-close"></i></a>
							</div>	
						</div>
					</div>
					<div class="modal-content">
					

						<div class="row no-margin-bottom">
							
							<div class="row">
								<div class="col l12" style="line-height: 30px">
									<?php echo e(__('organization/datasets.dataset_name')); ?>

								</div>
								<div class="col l12">
									<input type="text" name="dataset_name" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ">
									<?php if($errors->has('dataset_name')): ?>
	                                    <span class="help-block" style="color: red;">
	                                        <strong><?php echo e($errors->first('dataset_name')); ?></strong>
	                                    </span>
	                                <?php endif; ?>
								</div>
							</div>
							<div class="row">
								<div class="col l12" style="line-height: 30px">
									<?php echo e(__('organization/datasets.description')); ?>

								</div>
								<div class="col l12">
									 <textarea id="textarea1" name="dataset_description" class="materialize-textarea" style="border:1px solid #a8a8a8;margin-bottom: 0px;"></textarea>
									 <?php if($errors->has('dataset_description')): ?>
	                                    <span class="help-block" style="color: red;">
	                                        <strong><?php echo e($errors->first('dataset_description')); ?></strong>
	                                    </span>
	                                <?php endif; ?>
								</div>
							</div>
							
							<div class="col s12 m6 l12 aione-field-wrapper">
								
							</div>
						</div>
					
				    </div>
				    <div class="modal-footer">
				      	<button class="btn blue" type="submit"><?php echo e(__('organization/datasets.save')); ?>

						</button>
				    </div>
				    <?php echo Form::close(); ?>

				</div>
				
			
		</div>
	</div>
	<div class="row">
		<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
</div>

<script type="text/javascript">
		  $(document).ready(function(){
		    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
		    $('.modal').modal();
		  });
		$(document).ready(function(){
			$('#test1').change(function(){
			alert("chamnges");
			});
		});
		$('.close-model-button').click(function(){
			$("#add_new_model").modal('close');
		});
</script>
<style type="text/css">
	.aione-setting-field:focus{
		border-bottom: 1px solid #a8a8a8 !important;
		box-shadow: none !important;
	}
	textarea{
		border-bottom: 1px solid #a8a8a8 !important;
		box-shadow: none !important;
	}
	.btn{
		background-color: #0288D1;
	}
	.select-dropdown{
		margin-bottom: 0px !important;
	    border: 1px solid #a8a8a8 !important;
	    
	}
	.select-wrapper input.select-dropdown{
		height: 30px;
    	line-height: 30px;
	}
	.file-path{
		margin-bottom: 0px !important
	}

</style>
 <?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>