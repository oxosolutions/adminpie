<?php $__env->startSection('content'); ?>
<?php 
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'yes',
  'show_navigation' => 'yes',
  'page_title' => 'Edit Salary',
); 

// $data = $data->except(); 
// dump($data);
// foreach ($data as $key => $value) {

//   dump($key);
//   dump($value);
//   echo "<br>";
//   # code...
// }
    // dump($data['employee_id']);
    // $details = $salary->user_detail->metas->pluck('value','key');
     // $details['pay_scale']
     // App\\Model\\Organization
     
 ?> 

<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <?php echo Form::open(['route'=>'salary.slip.update']); ?>


  <?php $__currentLoopData = $data->toArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(in_array($key, ['created_at','updated_at'])): ?>
      <?php continue; ?>
      
    <?php endif; ?>

    <div class="form-group <?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
      <?php if($key =='id'): ?>
        <?php echo Form::hidden($key,$value, ['class'=>'form-control','placeholder'=>'Enter Role Name']); ?>


      <?php else: ?>
        
        
            <div id="field_46" data-conditions="0" data-field-type="text" class="field-wrapper ac field-wrapper-name field-wrapper-type-text ">
                <div id="field_label_name" class="field-label">

                    <label for="input_name">
                    <h4 class="field-title" id="<?php echo e($key,$key); ?>"><?php echo e(ucwords(str_replace('_',' ',$key,$key))); ?></h4>
                    </label>

                </div><!-- field label-->


                <div id="field_name" class="field field-type-text">

                    <input class="input-name" id="input_name" placeholder="Enter Designation" data-validation="" name="name" type="text" value="<?php echo e($value); ?>"> 

                </div><!-- field -->
            </div>
        <?php if($errors->has($key)): ?>
          <span class="help-block">
              <?php echo e($errors->first($key)); ?>

          </span>
        <?php endif; ?>
      <?php endif; ?>
      </div>

  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php echo Form::submit(); ?>

<?php echo Form::close(); ?>


  

  


</div>


<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>