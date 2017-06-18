<?php if(isset($options['type'])): ?>
	<?php if($options['type'] == 'inset'): ?>
		<div class="col s12 m2 l12 aione-field-wrapper">
				<?php echo Form::time(str_replace(' ','_',strtolower($collection->field_title)), null,['placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder'),'class'=>'timepicker']); ?>

		</div>
	<?php else: ?>
		<div class="row" style="padding:10px 0px">
			<div class="col l3" style="line-height: 30px">
				<?php echo e($collection->field_title); ?>

			</div>
			<div class="col l9">
				<?php echo Form::time(str_replace(' ','_',strtolower($collection->field_title)), null,['placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder'),'class'=>'timepicker']); ?>

			</div>
		</div>
	<?php endif; ?>
<?php else: ?>
	<div class="row" style="padding:10px 0px">
			<div class="col l3" style="line-height: 30px">
				<?php echo e($collection->field_title); ?>

			</div>
			<div class="col l9">
				<?php echo Form::time(str_replace(' ','_',strtolower($collection->field_title)), null,['placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder'),'class'=>'timepicker']); ?>

			</div>
		</div>
<?php endif; ?>

<script type="text/javascript">
	   $('.timepicker').pickatime({
		   default: 'now',
		   twelvehour: false, // change to 12 hour AM/PM clock from 24 hour
		   donetext: 'OK',
			 autoclose: false,
			 vibrate: true // vibrate the device when dragging clock hand
		});
</script>