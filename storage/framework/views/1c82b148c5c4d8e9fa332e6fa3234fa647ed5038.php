<?php $__env->startSection('content'); ?>

<?php echo Form::open(['route'=>'manage.email.template']); ?>

<ul> 
	<li><label for="">Language</label><?php echo Form::select('language',['EN'=>'EN','FR'=>'FR'],NULL,['class'=>'','placeholder'=>'select Language']); ?></li>
	<li><label for="">slug</label><input name="slug"  type="text"></li>
	<li><label for="">Content</label>
	<textarea name="template"  cols="60" rows="50"></textarea>
	</li>
	
</ul>
<input type="submit">

<?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>