<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Edit Organization',
    'add_new' => '+ Add Designation'
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="card" style="margin-top:0px;padding: 10px ">
	<?php echo Form::model($org_data, ['route' => ['edit.organization', $org_data->id]]); ?>

        <?php echo $__env->make('admin.organization._form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>                
        <div class="row right-align pv-10">
            <button type="submit" class="btn btn-primary blue">Update Organization<i class="icon-arrow-right14 position-right"></i>
            </button>  
        </div>    
    <?php echo Form::close(); ?>        
    </div>
    <?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>