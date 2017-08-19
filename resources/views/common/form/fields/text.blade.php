@php
	$fieldType  = '';
	$class_name = FormGenerator::GetMetaValue($collection->fieldMeta,'field_class');
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

@include('common.form.fields.includes.field-wrapper-start')
	@include('common.form.fields.includes.field-label-start')
		@include('common.form.fields.includes.label')
	@include('common.form.fields.includes.field-label-end')
	@include('common.form.fields.includes.field-start')
	<div>
	</div>
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
				// dump($collection->section->section_slug);
				$name = $collection->section->section_slug.'[0]['.$name.']';
			}
		@endphp
		{!!Form::text($name,$default_value,['class'=>$collection->field_slug.' '.$class_name,'id'=>'input_'.$collection->field_slug,'placeholder'=>$placeholder, ' data-validation'=>'required'])!!}
		@include('common.form.fields.includes.error')
	@include('common.form.fields.includes.field-end')
@include('common.form.fields.includes.field-wrapper-end')
