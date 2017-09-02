
				
{!!Form::date(str_replace(' ','_',strtolower($collection->field_slug)), null,['id'=>'input_'.$collection->field_slug,'class'=>'datepicker '.$collection->field_slug])!!}
	
@if(Session::has('date_error'))
	<script type='text/javascript'>Materialize.toast('Date is already in use', 5000)</script>
@endif

<script type="text/javascript">
	  $('.datepicker').pickadate({
		    selectMonths: true, // Creates a dropdown to control month
		    selectYears: 15, // Creates a dropdown of 15 years to control year
		    format: 'yyyy-mm-dd'
	  	});
	  $('.datepicker').on('open', function(){
	  		$('.datepicker').appendTo('body');
	  });
</script>