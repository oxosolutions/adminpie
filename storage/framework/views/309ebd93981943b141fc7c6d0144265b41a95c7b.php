<!DOCTYPE html>
<html lang="en">
<head>
	<?php echo $__env->make('admin.components._head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</head>
<style type="text/css">
   

</style>
<body>
    <div class="row">
        <div class="col s12 m12 l12 top-bar-color" style="z-index: 9999">
            <?php echo $__env->make('admin.components.new.topHeader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('admin.components.sidebars.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <div class="col s12 content-section background-design valign-wrapper" style="padding-left: 244px;">
            <?php 
                $url = $_SERVER['REQUEST_URI'];
                $string = explode('/',$url);
             ?>
            <div class="col s12 m6 l6 valign-center">
                <?php if(isset($string[2])): ?>
                    <h5 style="margin: 0px;"><?php echo e(ucfirst($string[2])); ?></h5>
                <?php else: ?>
                    <h5 style="margin: 0px;"><?php echo e(ucfirst($string[1])); ?></h5>
                <?php endif; ?>
            </div>
            <div class="col s12 m6 l6 right-align " style="padding-right: 10px">
                <ul class="aione-breadcrumb">
                    <?php $__currentLoopData = $string; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $crumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($crumb != "" || $crumb != null): ?>
                            <li><a href="<?php echo e($crumb); ?>"><?php echo e(ucfirst($crumb)); ?> </a>  </li>
                        <?php endif; ?>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
        <div class="page-content">
            <?php echo $__env->yieldContent('content'); ?>    
        </div>
        <?php echo $__env->make('admin.components._footer2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
</body>
	<?php echo $__env->make('admin.components._footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</html>

<script type="text/javascript">
    
</script>
