<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'no',
	'page_title' => 'Version Control',
	'add_new' => ''
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="ar">
            <div class="ac l50">
                <div class="aione-border">
                    <div class="bg-grey bg-lighten-4 p-15 font-size-20">
                        Database Version 
                        <span class="aione-float-right">
                            9.5.5.0 Stable
                        </span>
                    </div>
                    <div class="p-30 aione-align-center line-height-28">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et metus eu neque vestibulum convallis. Mauris vestibulum arcu vel magna egestas, quis vehicula diam accumsan. 
                        <button class="mt-20">Check for new update</button>
                        <button class="mt-20">Update Now</button>
                    </div>
                </div>
            </div>
            <div class="ac l50">
                <div class="aione-border">
                    <div class="bg-grey bg-lighten-4 p-15 font-size-20">
                        UI/UX and Features Version 
                        <span class="aione-float-right">
                            66.0.3 Alpha
                        </span>
                    </div>
                    <div class="p-30 aione-align-center line-height-28" >
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et metus eu neque vestibulum convallis. Mauris vestibulum arcu vel magna egestas, quis vehicula diam accumsan.
                        <button class="mt-20">Check for new update</button>
                        <button class="mt-20">Update Now</button>

                    </div>
                </div>
            </div>
        </div>
    <?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>