
{!!Form::time(str_replace(' ','_',strtolower($collection->field_slug)), null,['id'=>'input_'.$collection->field_slug,'class'=>'timepicker '.$collection->field_slug])!!}
		
	


<script type="text/javascript">
	   $('.timepicker').pickatime({
		   default: 'now',
		   twelvehour: false, // change to 12 hour AM/PM clock from 24 hour
		   donetext: 'OK',
			 autoclose: false,
			 vibrate: true // vibrate the device when dragging clock hand
		});
</script>