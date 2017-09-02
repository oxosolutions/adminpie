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


@php
	$name = str_replace(' ','_',strtolower($collection->field_slug)).$fieldType;
@endphp
@if(@$model != '' && @$model != null && @$model[$name] != '')
	{!!Form::text(str_replace(' ','_',strtolower($collection->field_slug)).$fieldType,null,['class'=>$collection->field_slug,'id'=>'input_'.$collection->field_slug,'readonly'=>'readonly'])!!}
@else
	{!!Form::text(str_replace(' ','_',strtolower($collection->field_slug)).$fieldType,$prefix.generate_filename($string_length,false).$postfix,['class'=>$collection->field_slug,'id'=>'input_'.$collection->field_slug,'readonly'=>'readonly'])!!}
@endif
		
