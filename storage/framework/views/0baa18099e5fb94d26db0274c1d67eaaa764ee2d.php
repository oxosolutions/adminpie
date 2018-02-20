
		
<?php echo Form::button(str_replace(' ','_',strtolower($collection->field_slug)),['data-target'=>$collection->field_slug,'id'=>'input_'.$collection->field_slug,'class'=>'timepicker '.$collection->field_slug]); ?>

		