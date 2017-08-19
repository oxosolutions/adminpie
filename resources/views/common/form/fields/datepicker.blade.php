
		@include('common.form.fields.includes.field-wrapper-start')
			@include('common.form.fields.includes.field-label-start')
				@include('common.form.fields.includes.label')
			@include('common.form.fields.includes.field-label-end')
			@include('common.form.fields.includes.field-start')
				
				{!!Form::date(str_replace(' ','_',strtolower($collection->field_title)), null,['id'=>'input_'.$collection->field_slug,'class'=>'datepicker '.$collection->field_slug])!!}
				@include('common.form.fields.includes.error')
			@include('common.form.fields.includes.field-end')
		@include('common.form.fields.includes.field-wrapper-end')
	{{-- 	<div class="col s12 m2 l12 aione-field-wrapper">
				{!!Form::date(str_replace(' ','_',strtolower($collection->field_title)), null,['placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder'),'class'=>'datepicker'])!!}
		</div>
		<div class="error-red">	
			@if(@$errors->has() || Session::has('date_error'))
				{{$errors->first(str_replace(' ','_',strtolower($collection->field_title)))}}
				<span class="red-color">{{Session::get('has-error')}}</span>
			@endif
		</div> --}}


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