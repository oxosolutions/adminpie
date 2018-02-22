<?php if(Auth::guard('admin')->check() == true): ?>
  <?php 
        $from = 'admin';
        $layout = 'admin.layouts.main';
   ?>
<?php else: ?>
  <?php 
        $from = 'org';
        $layout = 'layouts.main';
   ?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>
<?php 
    
    $title = $form->form_title;


 ?>
<?php 
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'no',
  'show_navigation' => 'yes',
  'page_title' => 'Form <span>'.$title.'</span>',
  'add_new' => '+ Add Module'
); 
 ?>

<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('admin.formbuilder._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="aione-table">
        <table class="stripped">
            <?php if(!$model->isEmpty()): ?>
                <tr>
                    <?php $__currentLoopData = $model[0]->toArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!in_array($key,['updated_at'])): ?>
                            <th><b><?php echo e(ucwords(str_replace('_',' ',$key))); ?></b></th>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            <?php endif; ?>
            <?php if(!$model->isEmpty()): ?>
                <?php $__currentLoopData = $model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <?php $__currentLoopData = $value->toArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column_key => $column_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!in_array($column_key,['updated_at'])): ?>
                                <?php if($column_key == 'created_at'): ?>
                                    <td><?php echo e(\Carbon\Carbon::parse($column_value)->diffForHumans()); ?></td>
                                <?php else: ?>
                                    <td><?php echo e($column_value); ?></td>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </table>
        <?php echo $model->render(); ?>

    </div>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<style type="text/css">
   .subtitle{
                
   
    font-weight: 500;
    display: inline-block;

         }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>