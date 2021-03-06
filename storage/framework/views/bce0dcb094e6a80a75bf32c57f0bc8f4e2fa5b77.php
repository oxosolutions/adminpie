<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $__env->make('components._head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>
<body>
    <div id="aione_wrapper" class="aione-wrapper aione-layout-wide aione-theme-arcane">
        <div class="aione-row">
            <div id="aione_header" class="aione-header">
                <div class="aione-row">
                
                    <?php echo $__env->make('group.components.topHeader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
                 
                </div><!-- .aione-row -->
            </div><!-- #aione_header -->
            <div id="aione_main" class="aione-main">
                <div class="aione-row">
                    <div id="aione_sidebar" class="aione-sidebar">
                        <div class="aione-row">
                                <?php echo $__env->make('group.components.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div><!-- .aione-row -->
                    </div><!-- #aione_sidebar -->
                    <div id="aione_content" class="aione-content">
                        <div class="aione-row">
                            <?php echo $__env->yieldContent('content'); ?>
                            <?php echo $__env->make('group.components._footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div><!-- .aione-row -->
                    </div><!-- #aione_content -->
                    <div class="clear"></div><!-- .clear -->
                </div><!-- .aione-row -->
            </div><!-- #aione_main -->
            <div class="clear"></div><!-- .clear -->
        </div><!-- .aione-row -->
    </div><!-- #aione_wrapper -->
    
    <?php echo $__env->make('components._footerscripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</body>
</html>