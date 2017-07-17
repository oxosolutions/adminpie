<?php $__env->startSection('content'); ?>
<?php 
    $page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'yes',
    'show_navigation' => 'yes',
    'page_title' => 'Tasks',
    'add_new' => '+ Add Tasks'
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
	<div class="row">
		<?php echo $__env->make('organization.project._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<div class="row">
			
            <?php echo Form::open(['route'=>'create.tasks','method'=>'POST','files'=>true]); ?>

                <?php if(array_key_exists('id',request()->route()->parameters())): ?>
                    <input type="hidden" name="project_id" value="<?php echo e(request()->route()->parameters()['id']); ?>">
                <?php endif; ?>
                <?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Task','button_title'=>'Save task','section'=>'tassec1']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
             <?php echo Form::close(); ?> 
			<?php echo $__env->make('common.tasks', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
	</div>
	<style type="text/css">
		.options{
		position: absolute;
		font-size: 14px;
		display: none;
		margin-top:-3px;
	}
	.hover-me:hover .options{
		display: block
	}
    .progress{
        position: absolute;
        z-index: 999;
        width: 700px;
        top: 60%;
        left: 30%;
        display: none;
    }

	 .task-font{
        font-size: 13px !important;padding-top: 10px !important;
    }
    .mt-10{
        margin-top: 10px !important;
    }
    .mr-5{
        margin-right: 5px !important;
    }
    .pl-5{
        padding-left: 5px !important;
    }
    .img-avatar{
        width: 40px !important;float: right !important;
    }
    .pt-10{
        padding-top: 10px;
    }
    .empty-box-text{
        font-size: 20px;
        font-weight: 700;
        color:#d8d8d8;
        text-align: center;
        
    }
    .projects-logo{
        
        background-color: #000;margin: 10%;

    }
     .p-15{
        padding: 15px !important;
    }
    .pv-5{
        padding: 5px 0px !important; 
    }
     .p-15{
        padding: 15px !important;
    }
    .mb-14{
    	margin-bottom: 14px !important;
    }
    .optional{

    }
    .p-10{
        padding: 10px !important;
    }
	</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>