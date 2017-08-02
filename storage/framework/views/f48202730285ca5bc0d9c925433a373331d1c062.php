<?php $__env->startSection('content'); ?>
<?php 
    $page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'yes',
    'show_navigation' => 'yes',
    'page_title' => 'Credentials',
    'add_new' => '+ Add Credentials'
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div>
    <?php echo $__env->make('organization.project._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
	<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo Form::open(['route' => 'credientals.save' , 'type' => 'POST']); ?>

	<div id="add_new_model" class="modal modal-fixed-footer">
		
		<div class="modal-header white-text  blue darken-1" ">
		<div class="row" style="padding:15px 10px">
			<div class="col l7 left-align">
				<h5 style="margin:0px">CREATE CREDENTIAL</h5>	
			</div>
			<div class="col l5 right-align">
				<a href="javascript:;" name="closeModel" onclick="close()" id="closemodal" class="closeDialog close-model-button" style="color: white"><i class="fa fa-close"></i></a>
			</div>
				
		</div>
		
	</div>
		<div class="modal-content">
		<?php echo FormGenerator::GenerateSection('cresec1',['type'=>'inset',@$model]); ?>

		
			<div >
				<div id="repeat" class="col l12" >
					<div class="row" style="border: 1px solid #e8e8e8;padding: 10px">
						<div>
							<i class="fa fa-close delete-row" style="float: right"></i>
						</div>
						<div class="col s12 m2 l12 aione-field-wrapper">
							 <input class="no-margin-bottom aione-field" placeholder="Title" name="title[]" type="text">
						</div>
						


						<div class="col s12 m2 l12 aione-field-wrapper">
							 <input class="no-margin-bottom aione-field" placeholder="Username or Email" name="email[]" type="text">
						</div>
			


						<div class="col s12 m2 l12 aione-field-wrapper">
							 <input class="no-margin-bottom aione-field" placeholder="Password" name="password[]" type="password" value="">
						</div>
						
					</div>
				</div>
				<div>
					<a href="javascript:;" class="btn blue add-row">Add Row</a>
				</div>
			</div>
		</div>
		
		<div class="modal-footer">
			<?php if(request()->route()->parameters()['id']): ?>
				<input type="hidden" name="project_id" value="<?php echo e(request()->route()->parameters()['id']); ?>">
			<?php endif; ?>
			<input type="submit" class="btn btn-primary" name="submit" value="submit">

		</div>
	</div>
	
	<?php echo Form::close(); ?>

		
</div>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<style type="text/css">
	   
    .projects-logo{
        
        background-color: #000;margin: 10%;

    }
    .p-15{
        padding: 15px !important;
    }
    .pv-5{
        padding: 5px 0px !important; 
    }
    .project-logo{
        color: white;width: 70px;margin: 0 auto; line-height: 70px;font-size: 24px;border-radius: 50%
    }
</style>
<script type="text/javascript">
		$(document).ready(function(){
			$('#add_new_model').modal({
				 dismissible: false
			});
			
		})
	
</script>
<script type="text/javascript">
	  $(".add-row").click(function(){
	  		var html = $("#repeat .row").html();
	        $("#repeat").append('<div class="row" style="border: 1px solid #e8e8e8;padding: 10px">'+html+'</div>');
	        $('.delete-row').show();
	    });
	    $("#repeat").on('click','.delete-row',function(){
	        $(this).parent().parent().remove();
	        countAppendedRows();
	    });
	    function countAppendedRows() {
	    	if($('#repeat').find('.row').length == 1 ){
		    	$('.delete-row').remove();
		    }
	    }
	    countAppendedRows();
</script>
<?php $__env->stopSection(); ?>	
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>