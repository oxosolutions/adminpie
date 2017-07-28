<?php $__env->startSection('content'); ?>


<?php echo Form::open(['route'=>'activity.edit']); ?>

<?php 
$use_for = $datas[0]['use_for'];
$slug = $datas[0]['slug'];
$language = $datas[0]['language'];
 ?>
<input type="hidden" name="use_for"  value="<?php echo e($use_for); ?>">
<ul>
	<li><label for="">Language</label><?php echo Form::select('language',['EN'=>'EN','FR'=>'FR'],$language,['class'=>'','placeholder'=>'select Language']); ?></li>
	<li><label for="">slug</label><input name="slug"  type="text" value="<?php echo e($slug); ?>"></li>



	<?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

		<?php if($value['type']=='self'): ?>
		<li><label for="">Self Content</label>
			<input name="template[<?php echo e($value->id); ?>][template]"  type="text" value="<?php echo e($value['template']); ?>">
			
		</li>
		<?php else: ?>
		<li>
			<ul>
				<li><h1>For Other </h1><br></li>
				<li><label for=""><?php echo e($value['gender']); ?>Content</label>
				<input name="template[<?php echo e($value->id); ?>][template]" type="text" value="<?php echo e($value['template']); ?>">
				
				</li>
				
			</ul>
		</li>
		<?php endif; ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<input type="submit">

<?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>