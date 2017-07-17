
<?php $__env->startSection('content'); ?>

<div>
  <div class="card" style="margin-top: 0px;padding: 14px">  

 
    <div class="row">
        <h5 style="margin-top: 0px">Add new Form</h5>

    </div>
    <div class="row">
    <?php echo Form::open([ 'method' => 'POST', 'route' => 'create.forms' ,'class' => 'form-horizontal']); ?>

        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
               Form name
           </div>
           <div class="col l9">
              
                <?php echo Form::text('form_title',null,['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ']); ?>

                
           </div>
        </div>
        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
               Slug
           </div>
           <div class="col l9">
              
                <?php echo Form::text('form_slug',null,['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ']); ?>

           </div>
        </div>
        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
               Form Description
           </div>
           <div class="col l9">
              
                <?php echo Form::textarea('form_description',null,['rows' => '5' ,'class' => 'materialize-textarea' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;']); ?>

           </div>
        </div>
         <?php if(@$errors->has()): ?>
          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kay => $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="color: red"><?php echo e($err); ?></div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <div class="row pv-10">
           <div class="col l12 right-align">
            <button type="submit" class="btn btn-primary blue">Save</button>
           </div>
        </div>
       
     
    <?php echo Form::close(); ?> 
    </div>
    
</div>
<style type="text/css">
    .h-30{
        height: 30px;
    }
    
    .pv-10{
        padding:10px 0px
    }
    .aione-setting-field:focus{
        border-bottom: 1px solid #a8a8a8 !important;
        box-shadow: none !important;
    }
    textarea{
        border-bottom: 1px solid #a8a8a8 !important;
        box-shadow: none !important;
    }
</style>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>