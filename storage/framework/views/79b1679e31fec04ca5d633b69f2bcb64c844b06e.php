<?php
    $skip = ['device_detail','mac_address','imei','created_by','created_at','deleted_at'];
    $index = 0;
?>

<table style="border: 1px solid #e8e8e8; width: 100%; border-collapse: collapse;border-spacing: 0;font-family: Helvetica,Arial,sans-serif;" width="100%">
    <thead style="padding: 0; margin: 0; border: none;">
        <tr style="border-bottom: 1px solid #e8e8e8;">
            <th style="font-weight: 700; border-right: 1px solid #e8e8e8; padding: 5px;">Field</th>
            <th style="font-weight: 700; border-right: none; padding: 5px;">Value</th>
        </tr>
    </thead>
    <tbody>
      <?php $__currentLoopData = $model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(!in_array($key,$skip)): ?>
          <?php 
          $bg_color = '#ffffff';
          if($index % 2 == 0){
            $bg_color = '#f8f8f8';
          }
          $index++;

          ?>
          <tr style="border-bottom: 1px solid #e8e8e8; background-color: <?php echo e($bg_color); ?>;" bgcolor="<?php echo e($bg_color); ?>">
            <td style="border-right: 1px solid #e8e8e8; padding: 5px;"><?php echo e(str_replace('_', ' ', ucwords(@$key))); ?></td>
            <td style="border-right: none; padding: 5px;"><?php echo e(@$value); ?></td>
          </tr>
        <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>