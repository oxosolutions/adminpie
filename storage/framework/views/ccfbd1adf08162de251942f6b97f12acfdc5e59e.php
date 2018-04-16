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
<style type="text/css">
     .custom-radio-field label{
        vertical-align: middle;
        display: block;
        line-height: 40px;
        cursor: pointer;
        font-size: 18px;
    }
    .custom-radio-field label > .desc{
        padding-bottom: 25px;
        margin-left: 40px;
        font-size: 14px;
    }
    .custom-radio-field label:hover{
        background:rgba(22, 141, 197, 0.1)  
    }
    .custom-radio-field input{
        float: left;
        text-align: left;
        margin: 10px !important;
    }
    .custom-radio-field > div{
        border-bottom: 1px solid #e8e8e8
    }
</style>
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
    <div class="ar mt-100">
        <div class="ac l50 ">
            <div class="aione-border">
                <div class=" p-15 pb-30">
                    <div class="">
                        <h4>You're about to download Dataset</h4>
                    </div>
                    <div class=" ">
                        What's your preferred file format
                    </div>
                </div>
                <div>
                    <div id="field_2" data-conditions="0" data-field-type="radio" class="field-wrapper ac field-wrapper-layout field-wrapper-type-radio horizontal">
                        <div id="field_layout" class="field field-type-radio custom-radio-field">
                            <div id="field_option_layout " class="">
                                <input class="layout m-8" id="option_layout0" data-validation=" " name="slum_zone" type="radio" value="north"  checked="checked">
                                <label for="option_layout0" class="field-option-label active">
                                    <div>
                                        CSV File
                                    </div>
                                    <div class="desc">
                                        Works with google sheet and other tools
                                    </div>         
                                </label>
                            </div>
                            <div id="field_option_layout" class="">
                                <input class="layout m-8" id="option_layout1" data-validation=" "  name="slum_zone" type="radio" value="east" checked="checked">
                                <label for="option_layout1" class="field-option-label">
                                    <div>
                                        XLSX File
                                    </div>
                                    <div class="desc">
                                        Works with all versions of excel 
                                    </div>
                                </label>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                        <!-- field -->
                    </div>
                    <div>
                        <button class="aione-float-right">Download</button>
                    </div>
                </div>
            </div>
                
        </div>
        <div class="ac l50">
            <div class="aione-border">
                <div class=" p-15 pb-30">
                    <div class="">
                        <h4>Lorem ipsum dolor sit amet.</h4>
                    </div>
                    <div class=" ">
                        In congue mauris vel vehicula laoreet.
                    </div>
                </div>
                <div class="aione-align-center p-40">
                    <button>Click here to make clone</button>
                </div>
            </div>
                
        </div>
    </div>

<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>