<?php if(isset($options['type'])): ?>
	<?php if($options['type'] == 'inset'): ?>
		<?php 
			$model = FormGenerator::GetMetaValue($collection->fieldMeta,'choice_model');
			if($model != false && $model != '' && $model != null){
				$exploded = explode('@',$model);
				$result = new $exploded[0];
				$exploded[1] = str_replace('()', '', $exploded[1]);
			}
		 ?>
		<?php if($model != false && $model != '' && $model != null): ?>
			<div class="col s12 m2 l12 aione-field-wrapper">
				<?php echo Form::select($collection->field_title,$result->$exploded[1](),null,["class"=>"no-margin-bottom aione-field" , 'placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder')]); ?>

			</div>
		<div class="error-red">	
			<?php if(@$errors->has()): ?>
				<?php echo e($errors->first(str_replace(' ','_',strtolower($collection->field_title)))); ?>

			<?php endif; ?>
		</div>

		<?php else: ?>
			<?php 
				$optionValues = json_decode(FormGenerator::GetMetaValue($collection->fieldMeta,'field_options'), true);
				$arrayOptions = array_combine($optionValues['key'], $optionValues['value']);
			 ?>
			<div class="col s12 m2 l12 aione-field-wrapper">
				<?php echo Form::select($collection->field_title,$arrayOptions,null,["class"=>"no-margin-bottom aione-field" , 'placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder')]); ?>

			</div>
		<div class="error-red">	
			<?php if(@$errors->has()): ?>
				<?php echo e($errors->first(str_replace(' ','_',strtolower($collection->field_title)))); ?>

			<?php endif; ?>
		</div>

		<?php endif; ?>
	<?php else: ?>
		<div class="col l3" style="line-height: 30px">
			<?php echo e($collection->field_title); ?>

		</div>
		<div class="col l9">
			<?php 
				$optionValues = json_decode(FormGenerator::GetMetaValue($collection->fieldMeta,'field_options'), true);
				$arrayOptions = array_combine($optionValues['key'], $optionValues['value']);
			 ?>
			<?php echo Form::select(str_replace(' ','_',strtolower($collection->field_title)),$arrayOptions,null,['placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder')]); ?>

		</div>
		<div class="error-red">	
			<?php if(@$errors->has()): ?>
				<?php echo e($errors->first(str_replace(' ','_',strtolower($collection->field_title)))); ?>

			<?php endif; ?>
		</div>

	<?php endif; ?>
<?php else: ?>

	<?php 
		$model = FormGenerator::GetMetaValue($collection->fieldMeta,'choice_model');
		if($model != false && $model != '' && $model != null){
			$exploded = explode('@',$model);
			$result = new $exploded[0];
			$exploded[1] = str_replace('()', '', $exploded[1]);
		}
	 ?>
	<?php if($model != false && $model != '' && $model != null): ?>
		<div class="col l3" style="line-height: 30px">
			<?php echo e($collection->field_title); ?>

		</div>
		<div class="col l9">
			<?php echo Form::select($collection->field_title,$result->$exploded[1](),null,['placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder')]); ?>

		</div>
	<?php else: ?>
		<div class="col l3" style="line-height: 30px">
			<?php echo e($collection->field_title); ?>

		</div>
		<div class="col l9">
			<?php 
				$optionValues = json_decode(FormGenerator::GetMetaValue($collection->fieldMeta,'field_options'), true);
				$arrayOptions = array_combine($optionValues['key'], $optionValues['value']);
			 ?>
			<?php echo Form::select(str_replace(' ','_',strtolower($collection->field_title)),$arrayOptions,null,['placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder')]); ?>

		</div>
	<?php endif; ?>
<?php endif; ?>