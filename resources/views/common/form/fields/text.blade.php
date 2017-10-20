@php
	$fieldType  = '';
	$model = FormGenerator::GetMetaValue($collection->fieldMeta,'choice_model');
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
	if($model != false && $model != '' && $model != null){
		$exploded = explode('@',$model);
		$result = new $exploded[0];
		$exploded[1] = str_replace('()', '', $exploded[1]);
		$default_value = @$result->{$exploded[1]}();
	}
	if(@$settings['form_field_show_placeholder']){
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
		$name = strtolower($collection->section->section_slug).'['.$options['loop_index'].']['.$name.']';
	}
@endphp
{!!Form::text($name,$default_value,['class'=>$field_input_class,'id'=>$field_input_id,'placeholder'=>$placeholder, ' data-validation' => $field_validations])!!} 
