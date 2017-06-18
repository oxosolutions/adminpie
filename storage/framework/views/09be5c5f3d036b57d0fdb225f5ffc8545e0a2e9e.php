
<div>  
    <div class="row">
        <h5 style="margin-top: 0px">Add new Organization</h5>
        <?php if(@$errors->has()): ?>
           <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div style="color:red;"><?php echo e($error); ?></div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
    <div class="row">
        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
               Organization Title
           </div>
           <div class="col l9">
                              <?php echo Form::text('name',null,['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ;']); ?>

           </div>
        </div>
        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
               Slug
           </div>
           <div class="col l9">
              
               <?php echo Form::text('slug',null,[ 'class' => 'aione-setting-field', 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;']); ?>

           </div>
        </div>
        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
               Primary Domain
           </div>
           <div class="col l9">
              
               <?php echo Form::text('primary_domain',null,['class' => 'aione-setting-field', 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;']); ?>

           </div>
        </div>
        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
               Seondary Domains
           </div>
           <div class="col l9">
              
               <?php echo Form::text('secondary_domains',null,['class' => 'aione-setting-field', 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;']); ?>

           </div>
        </div>
        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
              Modules
           </div>
           <div class="col l9">
              

             
                  
               <?php echo Form::select('modules[]',$modules,null,['multiple'=>'multiple', 'class' => 'browser-default', 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;']); ?>

             


           </div>
        </div>
        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
               Organization Description
           </div>
           <div class="col l9">
              
               <?php echo Form::textarea('description',null,['rows' => '5' ,'class' => 'materialize-textarea', 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;']); ?>

           </div>
        </div>
        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
               Email
           </div>
           <div class="col l9">
              
               <?php echo Form::email('email',null,['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px; ']); ?> 
           </div>
        </div>

      <?php if(!str_contains(url()->current(), 'edit')): ?>
        <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
               Password
           </div>
           <div class="col l9">
               
                <?php echo Form::password('password',['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px; ']); ?>

           </div>
          
        </div>


         <div class="row pv-10">
           <div class="col l3" style="line-height: 32px">
              Confirm Password
           </div>
           <div class="col l9">
               
                <?php echo Form::password('confirm_password',['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px; ']); ?>

           </div>
          
        </div>
      <?php endif; ?>
       
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
