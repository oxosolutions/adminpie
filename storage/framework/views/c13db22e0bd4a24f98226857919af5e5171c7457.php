
<?php echo Form::submit(ucwords(str_replace('_',' ',$collection->field_slug)),['class'=>$collection->field_slug,'id'=>'input_'.$collection->field_slug]); ?>

