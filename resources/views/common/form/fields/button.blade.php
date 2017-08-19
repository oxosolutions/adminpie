@if($options['type'] == 'inset')
	@include('common.form.fields.includes.field-wrapper-start')
		@include('common.form.fields.includes.field-label-start')
			@include('common.form.fields.includes.label')
		@include('common.form.fields.includes.field-label-end')
		@include('common.form.fields.includes.field-start')
			{!!Form::submit(str_replace(' ','_',strtolower($collection->field_title)).$fieldType,$default_value,['class'=>$collection->field_slug,'id'=>'input_'.$collection->field_slug])!!}
			@include('common.form.fields.includes.error')
		@include('common.form.fields.includes.field-end')
	@include('common.form.fields.includes.field-wrapper-end')
@endif