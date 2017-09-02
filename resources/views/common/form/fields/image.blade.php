@php
	$fieldType  = '';
	$required = '';
	$class_name = FormGenerator::GetMetaValue($collection->fieldMeta,'field_class');
	$requiredOrNot = FormGenerator::GetMetaValue($collection->fieldMeta,'field_required');
	if($requiredOrNot == 'yes'){
		$required = 'required';
	}
@endphp
<h5>Image File</h5>
@php
	if(isset($settings['show_placeholder']) && $settings['show_placeholder'] != '' && $settings['show_placeholder'] == 'yes'){
		$placeholder = FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder');
	}else{
		$placeholder = '';
	}
	$name = str_replace(' ','_',strtolower($collection->field_slug));
@endphp
{!!Form::text($name,null,['class'=>$collection->field_slug.' '.$class_name,'id'=>'input_'.$collection->field_slug,'placeholder'=>$placeholder, ' data-validation' => $required])!!}