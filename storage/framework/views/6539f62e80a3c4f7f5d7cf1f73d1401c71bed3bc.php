<?php $__env->startSection('content'); ?>
<div>
<?php 
// dd($model);
	$data = [];
	$index = 0;
	$model2 = [];
 ?>
    <?php echo $__env->make('organization.project._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    	<?php 
    		$model2['website_title'] = $model[0]->website_title;
    		$model2['login_url'] = $model[0]->login_url;
    		$model2['redirect_url'] = $model[0]->redirect_url;
    		$model2['project_id'] = $model[0]->project_id;
    	 ?>

   

	<div id="projects" class="projects list-view">
	    <div class="row">

			<div class="col s12 m3 l12 pl-7" >
				<?php echo Form::model($model2,['route' => 'update.crediental' , 'method' => 'POST']); ?>

						<input type="hidden" name="id" value="<?php echo e($model[0]->id); ?>">
						<?php echo FormGenerator::GenerateSection('cresec1',['type'=>'inset']); ?>

						
							<?php $__currentLoopData = $model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php $__currentLoopData = json_decode($value->data); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div id="repeat">
										<div class="row" style="padding:15px 10px; ">
											<div>
												<i class="fa fa-close delete-row" style="float: right"></i>
											</div>
											<div class="col l12">
												<div class="col s12 m2 l12 aione-field-wrapper">
													<input class="no-margin-bottom aione-field" value="<?php echo e($v->title); ?>" placeholder="Title" name="title[]" type="text">
												</div>
												<div class="error-red"></div>

												<div class="col s12 m2 l12 aione-field-wrapper">
											 		<input class="no-margin-bottom aione-field" value="<?php echo e($v->email); ?>" placeholder="Username or Email" name="email[]" type="text">
												</div>
												<div class="error-red">	</div>
												
												<div class="col s12 m2 l12 aione-field-wrapper">
													<input class="no-margin-bottom aione-field" value="<?php echo e($v->password); ?>" placeholder="Password" name="password[]" type="password" value="">
												</div>
												<div class="error-red"></div>
									
											</div>
											
										</div>	
									</div>
									
									
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php 
									$index++;
								 ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<div>
								<a href="javascript:;" class="btn blue add-row">Add Row</a>
							</div>
							<?php if(request()->route()->parameters()['id']): ?>
								<input type="hidden" name="project_id" value="<?php echo e(request()->route()->parameters()['id']); ?>">
							<?php endif; ?>
							<input type="submit" class="btn btn-primary" name="submit" value="submit">
				<?php echo Form::close(); ?>

			
			</div>
		</div>
	</div>
</div>
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
			$('#modal2').modal({
				 dismissible: false
			});
			
		})

	  $(".add-row").click(function(){
	  		
	        $("#repeat").append('<div class="row" style="padding:15px 10px; "> <div class="col l12"> <div> <i class="fa fa-close delete-row" style="float: right"></i> </div><div class="col s12 m2 l12 aione-field-wrapper"> <input class="no-margin-bottom aione-field"  placeholder="Title" name="title[]" type="text"> </div> <div class="error-red"></div> <div class="col s12 m2 l12 aione-field-wrapper"> <input class="no-margin-bottom aione-field"  placeholder="Username or Email" name="email[]" type="text"> </div> <div class="error-red"> </div> <div class="col s12 m2 l12 aione-field-wrapper"> <input class="no-margin-bottom aione-field"  placeholder="Password" name="password[]" type="password" value=""> </div> <div class="error-red"></div> </div> </div>');
	        $('.delete-row').show();
	    });
	    $("#repeat").on('click','.delete-row',function(){
	        $(this).parent().parent().remove();
	        countAppendedRows();
	    });
	    function countAppendedRows() {
	    	if($('#repeat').find('.row').length == 1 ){
		    	$('.delete-row').hide();
		    }
	    }
	    countAppendedRows();
					
</script>
<?php $__env->stopSection(); ?>	
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>