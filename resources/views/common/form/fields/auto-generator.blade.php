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
@if(isset($options['type']))
	@if($options['type'] == 'inset')
		<div class="col s12 m2 l12 aione-field-wrapper">
			 {!!Form::text(str_replace(' ','_',strtolower($collection->field_title)).$fieldType,$prefix.generate_filename($string_length,false).$postfix,['class'=>'no-margin-bottom aione-field','placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder'),'readonly'=>'readonly'])!!}
		</div>
		<div class="error-red">	
			@if(@$errors->has())
				{{$errors->first(str_replace(' ','_',strtolower($collection->field_title)))}}
			@endif
		</div>
	@else
		<div class="row" style="padding:10px 0px">
			<div class="col l3" style="line-height: 30px">
				{{ucfirst($collection->field_title)}}
			</div>
			<div class="col l9">
				{!!Form::text(str_replace(' ','_',strtolower($collection->field_title)).$fieldType,$prefix.generate_filename($string_length,false).$postfix,['class'=>'no-margin-bottom aione-field','placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder'),'style'=>'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px','readonly'=>'readonly'])!!}
			</div>
			<div class="error-red">	
				@if(@$errors->has())
					{{$errors->first(str_replace(' ','_',strtolower($collection->field_title)))}}
				@endif
			</div>

		</div>
	@endif
@else
	<div class="row" style="padding:10px 0px">
		<div class="col l3" style="line-height: 30px">
			{{ucfirst($collection->field_title)}}
		</div>
		<div class="col l9">
			{!!Form::text(str_replace(' ','_',strtolower($collection->field_title)).$fieldType,$prefix.generate_filename($string_length,false).$postfix,['class'=>'no-margin-bottom aione-field','placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder'),'style'=>'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px','readonly'=>'readonly'])!!}
		</div>
		<div class="error-red">	
			@if(@$errors->has())
				{{$errors->first(str_replace(' ','_',strtolower($collection->field_title)))}}
			@endif
		</div>

	</div>
@endif
