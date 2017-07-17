<?php $__env->startSection('content'); ?>
<div class="card" style="margin-top: 0pc;padding: 10px">
<?php 
$url = url()->current();
 ?>

<?php if(str_contains($url,'edit')): ?>

    <?php echo Form::model($data,['route' => 'edit.widget']); ?>

    <input type="hidden" name="id" value="<?php echo e($id); ?>">
<?php else: ?>
    <?php echo Form::open(['route' => 'create.widget']); ?>

<?php endif; ?>

    <div class="row">
        <div class="col l12" style="padding: 10px 0px;">
            title
        </div>
        <div class="col l12">
          <?php echo Form::text('title',null,['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ;']); ?>

        </div>
    </div>
     <div class="row">
        <div class="col l12" style="padding: 10px 0px;">
            slug
        </div>
        <div class="col l12">
          <?php echo Form::text('slug',null,['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ;']); ?>

        </div>
    </div>
     <div class="row">
        <div class="col l12" style="padding: 10px 0px;">
            Module
        </div>
       <?php echo Form::select('module_id',array_add($module_data,0,'default module'),@$data->module_id,['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ;']); ?>

    </div>
    <div class="col s12 m2 l12 " style="padding: 10px 0px">
                            Description
                        </div>
                        <div class="col s12 m2 l12 " style="padding: 10px 0px">
                            <?php echo Form::textarea('description',null,['rows' => '10' ,'class' => 'materialize-textarea', 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;']); ?>

                        </div>
      
    <div class="row" style="padding: 10px 0px">
        <div class="col l6">
             <?php echo Form::submit('Save Widget', ['class' => 'btn btn-primary']); ?>

        </div>
    </div>
<?php echo Form::close(); ?>

</div>
<style type="text/css">
     .aione-setting-field:focus{
        border-bottom: 1px solid #a8a8a8 !important;
        box-shadow: none !important;
    }
    textarea{
        border-bottom: 1px solid #a8a8a8 !important;
        box-shadow: none !important;
    }
</style>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>