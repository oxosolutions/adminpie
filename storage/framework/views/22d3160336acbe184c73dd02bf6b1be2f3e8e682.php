<?php $__currentLoopData = $collection->fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $secKey => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php echo FormGenerator::GenerateField($field->field_slug, $options,'', $formFrom); ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>