@if($options['type'] == 'inset')
	
			{!!Form::submit(str_replace(' ','_',strtolower($collection->field_slug)).$fieldType,$default_value,['class'=>$collection->field_slug,'id'=>'input_'.$collection->field_slug])!!}
@endif