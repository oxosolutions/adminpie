<?php $__env->startSection('content'); ?>

<?php 
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Dataset Define <span>'.get_dataset_title(request()->route()->parameters()['id']).'</span>',
	'add_new' => '+ Add Role'
	); 

 ?>
<style type="text/css">
	.ar .aione-box{
		border: 1px solid #e8e8e8;margin-bottom: 10px;margin-right:10px;padding: 10px
	}
</style>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('organization.dataset._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php if(!empty($dataset)): ?>
        <?php echo e(Session::get('success')); ?>

        <?php 
            @$model = json_decode($dataset->defined_columns);

         ?>
        <?php echo Form::model($model); ?>

            <div class="aione-table">
                <table class="compact">
                    <thead>
                        <tr>
                            <td>Column name</td>
                            <td>Edit header</td>
                            <td>Column type</td>
                            <td>Action</td>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $columns->toArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $columnName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td width="300"><?php echo e($columnName); ?></td>
                                <td width="300">
                                    <div class="field field-type-text">
                                        <input type="text" name="header[<?php echo e($key); ?>]" value="<?php echo e($columnName); ?>" class="browser-default" />
                                    </div>
                                </td>
                                <td>
                               
                                <?php echo Form::select($key,
                                        [   "/^[\s\S]*$/" =>   'Text',
                                            "/^[a-zA-Z ]*$/" =>   'String(Only Alphabets)',
                                            '/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26]php)00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/' =>  'Date',
                                        '/^[0-9]*$/'                    =>  'Number',
                                        '/^[0-9]+(\.[0-9]{1,5})?$/'     =>  'Integer',
                                        '/^\d*[02468]$/'                =>  'Even Number',
                                        '/^\d*[13579]$/'                =>  'Odd Number',
                                        '/^\d{10}$/'                    =>  'Mobile Number(10 Digit Only)',
                                        //'area_code'                    =>  'Area Code'
                                        ],null,['class'=>'browser-default']); ?>     
                                <!--  Code BY : Amrit END-->    

                                </td>
                                <td><a href="<?php echo e(route('delete.column',[request()->route()->id ,$key])); ?>"><i class="fa fa-trash" style="color: red"></i></a></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>             
                    </tbody>
                </table>
                <div style="margin-top: 15px">
                    
                    <button type="submit" class="" style="float: right">Save Changes</button>
                </div>
            </div>
        <?php echo Form::close(); ?>

    <?php else: ?>
        <div class="aione-message warning">
            <i class="fa fa-info-circle" style="font-size: 20px;"></i> Dataset table not found!
        </div>
    <?php endif; ?>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo Form::open(['route'=>['create.column',request()->route()->parameters()['id']]]); ?>

<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'add_new_column','heading'=>'Create Column','button_title'=>'Proceed','section'=>'create_column']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo Form::close(); ?>

<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>