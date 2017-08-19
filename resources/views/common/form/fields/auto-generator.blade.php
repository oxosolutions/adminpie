@php
	$fieldType  = '';
	$string_length = @FormGenerator::GetMetaValue($collection->fieldMeta,'string_length');
	$prefix = @FormGenerator::GetMetaValue($collection->fieldMeta,'prefix');
	$postfix = @FormGenerator::GetMetaValue($collection->fieldMeta,'postfix');
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
		
		{!!Form::text(str_replace(' ','_',strtolower($collection->field_title)).$fieldType,$prefix.generate_filename($string_length,false).$postfix,['class'=>$collection->field_slug,'id'=>'input_'.$collection->field_slug,'readonly'=>'readonly'])!!}
		@include('common.form.fields.includes.error')
	@include('common.form.fields.includes.field-end')
@include('common.form.fields.includes.field-wrapper-end')
		
