<?php $__env->startSection('content'); ?>

<?php 
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'View Group&nbsp;&nbsp;<span>'.$group_data->name.'</span>',
    'add_new' => '+ Add User'
); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php echo $__env->make('admin.group._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="aione-table">
        <table class="mb-20">
            <thead>
                <tr>
                    <th width="200">Field</th>    
                    <th>Value</th>    
                </tr>
                
            </thead>
            <tbody>
                <?php $__currentLoopData = $group_data->toArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!in_array($key,['id','created_by','updated_at'])): ?>
                        <tr>
                            <td><?php echo e(ucwords(str_replace('_',' ',$key))); ?></td>
                            <?php if(is_array($value)): ?>
                                <td>
                                    <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="bg-cyan white p-5 display-inline-block mb-5" style="cursor: pointer;"><?php echo e($item); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                
                            <?php else: ?>
                                <td><?php echo e($value); ?></td>
                            <?php endif; ?>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>Organizations</td>
                    <td>
                        <?php $__currentLoopData = $oragnizations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('auth.organization',$key)); ?>" target="_blank"><span class="bg-teal white p-5 display-inline-block" style="cursor: pointer;"><?php echo e($value); ?></span></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                </tr>
            </tbody>
        </table>
       
    </div>
  <?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>