@php
	$fieldType  = '';
	$required = '';
	$class_name = FormGenerator::GetMetaValue($collection->fieldMeta,'field_class');
	$requiredOrNot = FormGenerator::GetMetaValue($collection->fieldMeta,'field_required');
	if($requiredOrNot == 'yes'){
		$required = 'required';
	}
@endphp
@if(isset($options['field_type']) && $options['field_type'] == 'array')
	@php
		$fieldType  = '[]';
	@endphp
@endif
@if(isset($options['default_value']) && $options['default_value'] != '')
	@php
		$default_value = $options['default_value'];
	@endphp
@else
	@php
		$default_value = null;
	@endphp
@endif

@php
	if(isset($settings['show_placeholder']) && $settings['show_placeholder'] != '' && $settings['show_placeholder'] == 'yes'){
		$placeholder = FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder');
	}else{
		$placeholder = '';
	}
	if(isset($settings['field_variable']) && $settings['field_variable'] == 'slug'){
		$name = $collection->field_slug;
	}else{
		$name = str_replace(' ','_',strtolower($collection->field_slug));
	}
	if(@$options['from'] == 'repeater'){
		$name = $collection->section->section_slug.'['.$options['loop_index'].']['.$name.']';
	}
@endphp
{!!Form::number($name,$default_value,['class'=>$collection->field_slug.' '.$class_name,'id'=>'input_'.$collection->field_slug,'placeholder'=>$placeholder, ' data-validation' => $required])!!}
