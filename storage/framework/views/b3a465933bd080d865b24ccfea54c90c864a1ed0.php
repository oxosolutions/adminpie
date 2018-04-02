<?php $__env->startSection('content'); ?>

<?php 
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Dataset Validate <span>'.get_dataset_title(request()->route()->parameters()['id']).'</span>',
	'add_new' => '+ Add Role'
	); 
 ?>
<style type="text/css">
	.label-box{
		display: inline-block;
	    width: 20px;
	    height: 20px;
	    vertical-align: bottom;
	}
	.label-box-desc{
		line-height: 20px;
    	display: inline-block;
	}
	.aione-error-wrapper{
		padding: 10px;
		    background-color: rgba(255, 0, 0, 0.2);
		    margin-bottom: 14px
	}
    .aione-message{
        padding:5px;
        font-size: 15px;
        text-align: left;
    }
</style>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('organization.dataset._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <?php if($dataset->defined_columns == '' || $dataset->defined_columns == null): ?>
        <div class="aione-message warning" style="padding: 20px; text-align: center;font-size: 18px;">
            <i class="fa fa-info-circle" style="font-size: 20px;"></i> Dataset columns not defined!
        </div>
    <?php else: ?>
        <?php if(@$records != 'error'): ?>
            <div class="ar">
                <div class="ac l80" style="padding: 14px 0px">
                    <div style="margin-bottom: 14px">
                        <span class="red label-box"></span>
                        <span class="label-box-desc">Datacells with error values are highlighted with red background.</span>    
                    </div>
                    <div>
                        <span class="green label-box"></span>
                        
                    </div>
                    
                </div>
                <div class="ac l20">
                    <button>Re-Validate</button>
                </div>
            </div>
            <div class="aione-accordion">
                <div class="aione-item">
                    <div class="aione-item-header">
                        <span>Error Logs</span>
                        <span class="aione-float-right">Total <span class="red"><?php echo e(count($errors)); ?> errors.</span> Click here to view details.</span> 
                    </div>
                    <div class="aione-item-content">
                        
                        Error Locations:<br>
                        <?php $__currentLoopData = $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php 
                                $errorColumns = collect($error);
                                $columns = array_keys($errorColumns->groupBy('col')->toArray());
                                $columnNames = [];
                                foreach($columns as $k => $v){
                                    $columnNames[] = $headers->{$v};
                                }
                                $columns = implode(',',$columnNames);
                             ?>
                            <div class="aione-message error">
                                <strong>Column:</strong><?php echo e($columns); ?>, &nbsp;&nbsp;&nbsp;&nbsp;<strong>Row:</strong><?php echo e($key); ?><br>    
                            </div>
                            
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </div>
                </div>
            </div>
                
            <div style="font-size: 13px;color: #757575">Showing <?php echo e($paginate->firstItem()); ?> to <?php echo e($paginate->lastItem()); ?> of total <?php echo e($paginate->total()); ?> records</div>
            <div class="aione-table" style="margin-top: 14px">
                <?php if($headers == null): ?>
                    <div class="aione-message warning">
                        No records found for validate!
                    </div>
                <?php else: ?>
                    <table class="compact mb-12">
                        <thead>
                            <tr>
                                <th>Row Id</th>
                                <?php $__currentLoopData = $headers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $header): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!in_array($key,['id','parent','status'])): ?>
                                        <th><?php echo e($header); ?></th>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->index+1); ?></td>
                                    <?php $__currentLoopData = $record; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td><?php echo $column; ?></td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                <?php endif; ?>
                
                <?php if(!empty($records)): ?>
                    <?php echo $paginate->render(); ?>

                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="aione-message warning">
                <i class="fa fa-info-circle" style="font-size: 20px;"></i> Dataset table not found!
            </div>
        <?php endif; ?>
    <?php endif; ?>

<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<style type="text/css">
	.dataset-validate-error{
		background-color: red;
		color: #FFF;
	}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>