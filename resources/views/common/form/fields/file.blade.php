
@php
	if(isset($settings['field_variable']) && $settings['field_variable'] == 'slug'){
		$name = $collection->field_slug;
	}else{
		$name = str_replace(' ','_',strtolower($collection->field_slug));
	}
	if(@$options['from'] == 'repeater'){
		$name = strtolower($collection->section->section_slug).'['.$options['loop_index'].']['.$name.']';
		// dump($name);
	}
@endphp
{!! Form::hidden($name,null,[]) !!}
{!!Form::file($name,null,['class'=>$collection->field_slug,'id'=>'input_'.$collection->field_slug])!!}