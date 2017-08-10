<?php if(isset($options['type'])): ?>
	<?php if($options['type'] == 'inset'): ?>
		<div class="col s12 m2 l12 aione-field-wrapper">
				<?php echo Form::date(str_replace(' ','_',strtolower($collection->field_title)), null,['placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder'),'class'=>'datepicker']); ?>

		</div>
		<div class="error-red">	
				<?php if(@$errors->has() || Session::has('date_error')): ?>
					<?php echo e($errors->first(str_replace(' ','_',strtolower($collection->field_title)))); ?>

					<span class="red-color"><?php echo e(Session::get('has-error')); ?></span>
				<?php endif; ?>
			</div>
	<?php else: ?>
		<div class="row" style="padding:10px 0px">
			<div class="col l3" style="line-height: 30px">
				<?php echo e($collection->field_title); ?>

			</div>
			<div class="col l9">
				<?php echo Form::date(str_replace(' ','_',strtolower($collection->field_title)), null,['placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder'),'class'=>'datepicker']); ?>

			</div>
			<div class="error-red">	
				<?php if(@$errors->has() || Session::has('date_error')): ?>
					<?php echo e($errors->first(str_replace(' ','_',strtolower($collection->field_title)))); ?>

					<span class="red-color"><?php echo e(Session::get('has-error')); ?></span>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
<?php else: ?>
	<div class="row" style="padding:10px 0px">
			<div class="col l3" style="line-height: 30px">
				<?php echo e($collection->field_title); ?>

			</div>
			<div class="col l9">
				<?php echo Form::date(str_replace(' ','_',strtolower($collection->field_title)), null,['placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder'),'class'=>'datepicker']); ?>

			</div>
			<div class="error-red">	
				<?php if(@$errors->has() || Session::has('date_error')): ?>
					<?php echo e($errors->first(str_replace(' ','_',strtolower($collection->field_title)))); ?>

					<span class="red-color"><?php echo e(Session::get('date_error')); ?></span>

				<?php endif; ?>
			</div>
		</div>
<?php endif; ?>
	<?php if(Session::has('date_error')): ?>
		<script type='text/javascript'>Materialize.toast('Date is already in use', 5000)</script>
	<?php endif; ?>

<script type="text/javascript">
	  $('.datepicker').pickadate({
		    selectMonths: true, // Creates a dropdown to control month
		    selectYears: 15, // Creates a dropdown of 15 years to control year
		    format: 'yyyy-mm-dd'
	  	});
	  $('.datepicker').on('open', function(){
	  		$('.datepicker').appendTo('body');
	  });
</script>