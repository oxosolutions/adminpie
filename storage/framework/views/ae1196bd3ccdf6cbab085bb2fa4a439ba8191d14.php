<?php $__env->startSection('content'); ?>
    <div class="card" style="margin-top:0px;padding: 10px ">

   
        
	<?php echo Form::model($org_data, ['route' => ['edit.organization', $org_data->id]]); ?>

        <?php echo $__env->make('admin.organization._form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>                
        <div class="row right-align pv-10">
            <button type="submit" class="btn btn-primary blue">Update Organization<i class="icon-arrow-right14 position-right"></i>
            </button>  
        </div>    
    <?php echo Form::close(); ?>        
    </div>

	

<style type="text/css">
	button{
		position: inherit !important;
	}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>