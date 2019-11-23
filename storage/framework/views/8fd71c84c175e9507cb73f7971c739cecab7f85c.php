<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $__env->make('components._head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php

        $sidebar_small = App\Model\Organization\UsersMeta::getUserMeta('layout_sidebar_small');
        
        $custom_css = App\Model\Organization\OrganizationSetting::getSettings('admin_custom_css');
        $custom_js = App\Model\Organization\OrganizationSetting::getSettings('admin_custom_js');
        $admin_footer_content = App\Model\Organization\OrganizationSetting::getSettings('admin_footer_content');

        $user_roles = get_user_roles(); 

        $user_role_classes = array();
        foreach($user_roles as $user_role){
            $user_role_classes[] = "user-role-".$user_role;
        }
        $user_role_classes = implode(" ",$user_role_classes);


    ?>
    <style type="text/css">
        <?php echo @$custom_css; ?>

    </style>
    <style type="text/css">
        <?php echo @get_module_css(); ?>

    </style>
</head>
<body class="<?php echo e(@$user_role_classes); ?>">
    <div id="aione_wrapper" class="aione-wrapper aione-layout-wide aione-theme-arcane">
        <div class="aione-row">
            <div id="aione_header" class="aione-header">
                <div class="aione-row">
                    <?php echo $__env->make('components.topHeader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
                </div><!-- .aione-row -->
            </div><!-- #aione_header -->
            <div id="aione_main" class="aione-main <?php echo e(($sidebar_small == 1)?'sidebar-small':''); ?>">
                <div class="aione-row">
                    <div id="aione_sidebar" class="aione-sidebar">
                        <div class="aione-row">
                            <?php echo $__env->make('components.sidebars.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        
                        </div><!-- .aione-row -->
                    </div><!-- #aione_sidebar -->
                    <div id="aione_content" class="aione-content">
                        <div class="aione-row">
                            <?php echo $__env->yieldContent('content'); ?>
                            
                            <?php echo $__env->make('components._footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            
                        </div><!-- .aione-row -->
                    </div><!-- #aione_content -->
                    <div class="clear"></div><!-- .clear -->
                </div><!-- .aione-row -->
            </div><!-- #aione_main -->
            <div class="clear"></div><!-- .clear -->
        </div><!-- .aione-row -->
    </div><!-- #aione_wrapper -->
    
    <?php echo $__env->make('components._footerscripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <script type="text/javascript">
        <?php echo @$custom_js; ?>

    </script> 
    <script type="text/javascript">
        <?php echo @get_module_js(); ?>

    </script> 
</body>
</html>