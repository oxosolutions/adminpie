<?php $__env->startSection('content'); ?>
<?php 
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Application Detail',
    'add_new' => 'All Applications',
    'route' => 'list.applicantions'
); 
 ?>

<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<div class="aione-table">
            <table class="stripped">
                <thead>
                    <tr>
                        <th>Field</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td><?php echo e($application->name); ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo e($application->email); ?></td>
                    </tr>
                    <?php $__currentLoopData = $application->applications->application_meta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($value->key == 'application_attachment'): ?>
                            <tr>
                                <td>Resume</td>
                                <td><a href="<?php echo e(url('/').'/'.upload_path('application_attachments').'/'.$value->value); ?>"><?php echo e($value->value); ?></a></td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td><?php echo e(ucfirst($value->key)); ?></td>
                                <td><?php echo e($value->value); ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <br/>
        
	<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>