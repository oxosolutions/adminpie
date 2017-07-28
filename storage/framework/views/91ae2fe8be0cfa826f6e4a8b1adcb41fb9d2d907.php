<?php $__env->startSection('content'); ?>

<?php echo Form::open(['route'=>'activity.template']); ?>

<input type="hidden" name="use_for"  value="activity">
<ul> 
	<li><label for="">Language</label><?php echo Form::select('language',['EN'=>'EN','FR'=>'FR'],NULL,['class'=>'','placeholder'=>'select Language']); ?></li>
	<li><label for="">slug</label><input name="slug"  type="text"></li>
	<li><label for="">Self Content</label>
		<input name="template[self][template]"  type="text">
		<input name="template[self][type]"  type="hidden" value="self">
	</li>
	<li>
		<ul>
			<li><h1>For Other </h1><br></li>
			<li><label for="">Male Content</label>
			<input name="template[male][template]" type="text">
			<input name="template[male][type]" value='other' type="hidden">
			<input name="template[male][gender]" value='male' type="hidden">
			</li>
			<li><label for="">Female Content</label>			
				<input name="template[female][template]" type="text"></li>
				<input  name="template[female][type]" value='other' type="hidden">
				<input  name="template[female][gender]" value='female' type="hidden">
		</ul>
</ul>
<input type="submit">

<?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>