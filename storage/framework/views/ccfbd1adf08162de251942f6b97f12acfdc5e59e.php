<?php $__env->startSection('content'); ?>
<?php 
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Dataset Define <span>'.get_dataset_title(request()->route()->parameters()['id']).'</span>',
	'add_new' => '+ Add Role'
	); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('organization.dataset._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   
    <nav id="aione_nav" class="aione-nav horizontal light custom-option-menu">
            <div class="aione-nav-background"></div>
            <ul id="aione_menu" class="aione-menu custom-aione-menu">
                
            
                <li class="aione-nav-item level0 bg-light-blue bg-darken-3 " style="margin-right: 15px"> 
                    <a class="white ph-50 export" style="width: 140px;color: white;text-align: center" >Export</a>
                    <ul class="side-bar-submenu">
                        <li class="aione-nav-item level1 "> 
                            <a onclick="window.location.href='<?php echo e(route('export.dataset',['id'=>request()->route()->parameters()['id'],'type'=>'xls'])); ?>'">Export as XLS</a>
                        </li>
                        <li class="aione-nav-item level1 "> 
                            <a onclick="window.location.href='<?php echo e(route('export.dataset',['id'=>request()->route()->parameters()['id'],'type'=>'csv'])); ?>'">Export as CSV</a>
                        </li>
                    </ul>
                </li>
                <li class="aione-nav-item level0 bg-cyan bg-darken-1 "> 
                    <a class="white clone" style="width: 140px;color: white;text-align: center" onclick="window.location.href='<?php echo e(route('clone.dataset',request()->route()->parameters()['id'])); ?>'">Clone</a>
                </li>
            </ul>
            <div class="aione-nav-toggle">
                <a href="#" class="nav-toggle "></a>
            </div>
            <div class="clear"></div>
        </nav>

<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>