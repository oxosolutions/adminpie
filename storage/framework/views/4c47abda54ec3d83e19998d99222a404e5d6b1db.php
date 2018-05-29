<?php $__env->startSection('content'); ?>
<?php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Search Domain'
); 
?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo Form::open(); ?>

	   <?php echo FormGenerator::GenerateForm('domain_search'); ?>

    <?php echo Form::close(); ?>

    
    <?php if(!empty($result)): ?>
      
        <div class="aione-table">
            <table>
                <thead>
                    <tr>
                        <th width="300">Domain</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $result['response']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $domain): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($key); ?></td>
                            <td>
                                <?php if($domain->status == 'available'): ?>
                                    <span class="bg-cyan white p-5 display-inline-block mb-5" style="cursor: pointer;">Available</span>
                                <?php else: ?>
                                    <span class="bg-red white p-5 display-inline-block mb-5" style="cursor: pointer;">Un-available</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php echo Form::open(['route'=>'place.order','id'=>'place_order']); ?>

                                    <?php echo Form::hidden('domain',$key); ?>

                                    <?php if($domain->status == 'available'): ?>
                                        <a href="#" class="aione-tooltip" title="Place Order" onclick="document.getElementById('place_order').submit()">
                                            <i class="fa fa-cart-plus font-size-30" style="color: green; width: 40%;"></i>
                                        </a>
                                    <?php else: ?>
                                        <i class="fa fa-close font-size-30" style="color: red"></i>
                                    <?php endif; ?>
                                <?php echo Form::close(); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>    
        </div>
    <?php endif; ?>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>