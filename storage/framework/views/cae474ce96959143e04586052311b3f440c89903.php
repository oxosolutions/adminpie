
<?php if(isset($options['type'])): ?>
	<?php if($options['type'] == 'inset'): ?>
		<div class="col s12 m2 l12 aione-field-wrapper" style="margin-bottom: 10px">

			<div class="row">
				<div class="col l3">Select file</div>
				<div class="col l9">
					<?php echo Form::file(str_replace(' ','_',strtolower($collection->field_title)),null,['class'=>'no-margin-bottom aione-field','placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder')]); ?>

				</div>
			</div>
			 
		</div>
		<div class="error-red">	
			<?php if(@$errors->has()): ?>
				<?php echo e($errors->first(str_replace(' ','_',strtolower($collection->field_title)))); ?>

			<?php endif; ?>
		</div>
	<?php else: ?>
		<div class="row" style="padding:10px 0px;margin-bottom: 10px">
			<div class="col l3" style="line-height: 30px">
				<?php echo e(ucfirst($collection->field_title)); ?>

			</div>
			<div class="col l9">
				<?php echo Form::file(str_replace(' ','_',strtolower($collection->field_title)),null,['class'=>'no-margin-bottom aione-field','placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder'),'style'=>'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px']); ?>

			</div>
			<div class="error-red">	
				<?php if(@$errors->has()): ?>
					<?php echo e($errors->first(str_replace(' ','_',strtolower($collection->field_title)))); ?>

				<?php endif; ?>
			</div>

		</div>
	<?php endif; ?>
<?php else: ?>
	<div class="row" style="padding:10px 0px;margin-bottom: 10px">
		<div class="col l3" style="line-height: 30px">
			<?php echo e(ucfirst($collection->field_title)); ?>

		</div>
		<div class="col l9" style="position: relative;">
				<?php if(isset($model[str_replace(' ','_',strtolower($collection->field_title))])): ?>
					<img src="<?php echo e(asset($model[str_replace(' ','_',strtolower($collection->field_title))])); ?>" width="300" class="logo-image"><br/><br/><br/>
					<a href="#" class="submit-logo" data-value="<?php echo e(str_replace(' ','_',strtolower($collection->field_title))); ?>_delete" style="cursor: pointer"><i class="fa fa-times-circle-o" style="position: absolute;font-size: 24px;color: white;top: 10px;left: 270px"></i></a>
					<button type='submit' name="<?php echo e(str_replace(' ','_',strtolower($collection->field_title))); ?>_delete"  style="display: none" value="submit">submit</button>
				<?php endif; ?>
			<?php echo Form::file(str_replace(' ','_',strtolower($collection->field_title)),null,['class'=>'no-margin-bottom aione-field','placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder'),'style'=>'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px']); ?>

		</div>
		<div class="error-red">	
			<?php if(@$errors->has()): ?>
				<?php echo e($errors->first(str_replace(' ','_',strtolower($collection->field_title)))); ?>

			<?php endif; ?>
		</div>

	</div>
<?php endif; ?>
<script type="text/javascript">
$(document).ready(function(){
	$(document).on('click','.submit-logo',function(e){
		e.preventDefault();
		$('button[name='+$(this).attr('data-value')+']').click();
	})
})
	
</script>
