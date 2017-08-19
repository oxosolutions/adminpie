@include('common.form.fields.includes.field-wrapper-start')
	@include('common.form.fields.includes.field-label-start')
		@include('common.form.fields.includes.label')
	@include('common.form.fields.includes.field-label-end')
	@include('common.form.fields.includes.field-start')
		{!!Form::textarea(str_replace(' ','_',strtolower($collection->field_title)),null,['class'=>$collection->field_slug,'id'=>'input_'.$collection->field_slug, 'rows'=>'3', 'cols'=>'100'])!!}
		@include('common.form.fields.includes.error')
	@include('common.form.fields.includes.field-end')
@include('common.form.fields.includes.field-wrapper-end')
