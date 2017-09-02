
		<?php echo Form::textarea(str_replace(' ','_',strtolower($collection->field_slug)),null,['class'=>$collection->field_slug,'id'=>'input_'.$collection->field_slug, 'rows'=>'3', 'cols'=>'100']); ?>

