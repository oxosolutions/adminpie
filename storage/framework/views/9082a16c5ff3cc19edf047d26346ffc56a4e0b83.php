<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.settings._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo FormGenerator::GenerateSection('setsec2'); ?>

<a href="" class="btn blue">Save</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>