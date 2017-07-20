<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Delete Confirmation',
    'add_new' => ''
);
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="row">
    <?php echo Form::open(['route'=>'role.delete' , 'method'=>'POST']); ?>

    <div class="row">
        The role you want to delete is assosiated with the following users.You may change the role of users
    </div>
    <div class="row">
        <div class="card">
            <div class="row">
                <div class="col l6 offset-l3">
                    <div class="row valign=-wrapper">
                        <div class="col l5">
                        <input type="hidden" name="old_role_id" value="<?php echo e($id); ?>">
                            Role <STRONG><?php echo e($roleList[$id]['name']); ?></STRONG>    
                        </div>
                        <div class="col l2">
                            Switch To
                        </div>
                        <div class="col l5">
                            <select name="new_role_id">
                                <?php $__currentLoopData = $roleList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roleKey =>$roleVal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                    <?php if($id!= $roleVal['id']): ?>)
                                        <option value="<?php echo e($roleVal['id']); ?>"  > <?php echo e($roleVal['name']); ?></option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="row">
            List of users
        </div>
        <?php $__currentLoopData = $roleUser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row">
            <input name="user[]" value="<?php echo e($value['id']); ?>" type="hidden">
                <?php echo e($value['name']); ?>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class=-"row">
        <button type="submit" class="btn blue">Delete Role</button>
    </div>
    <?php echo Form::close(); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>