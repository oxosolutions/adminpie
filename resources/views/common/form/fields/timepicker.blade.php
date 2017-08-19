@include('common.form.fields.includes.field-wrapper-start')
	@include('common.form.fields.includes.field-label-start')
		@include('common.form.fields.includes.label')
	@include('common.form.fields.includes.field-label-end')
	@include('common.form.fields.includes.field-start')
		
		{!!Form::time(str_replace(' ','_',strtolower($collection->field_title)), null,['id'=>'input_'.$collection->field_slug,'class'=>'timepicker '.$collection->field_slug])!!}
		@include('common.form.fields.includes.error')
	@include('common.form.fields.includes.field-end')
@include('common.form.fields.includes.field-wrapper-end')
		
	


<script type="text/javascript">
	   $('.timepicker').pickatime({
		   default: 'now',
		   twelvehour: false, // change to 12 hour AM/PM clock from 24 hour
		   donetext: 'OK',
			 autoclose: false,
			 vibrate: true // vibrate the device when dragging clock hand
		});
</script>