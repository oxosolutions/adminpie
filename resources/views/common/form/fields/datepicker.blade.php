@if(isset($options['type']))
	@if($options['type'] == 'inset')
		<div class="col s12 m2 l12 aione-field-wrapper">
				{!!Form::date(str_replace(' ','_',strtolower($collection->field_title)), null,['placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder'),'class'=>'datepicker'])!!}
		</div>
		<div class="error-red">	
				@if(@$errors->has() || Session::has('date_error'))
					{{$errors->first(str_replace(' ','_',strtolower($collection->field_title)))}}
					<span class="red-color">{{Session::get('has-error')}}</span>
				@endif
			</div>
	@else
		<div class="row" style="padding:10px 0px">
			<div class="col l3" style="line-height: 30px">
				{{$collection->field_title}}
			</div>
			<div class="col l9">
				{!!Form::date(str_replace(' ','_',strtolower($collection->field_title)), null,['placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder'),'class'=>'datepicker'])!!}
			</div>
			<div class="error-red">	
				@if(@$errors->has() || Session::has('date_error'))
					{{$errors->first(str_replace(' ','_',strtolower($collection->field_title)))}}
					<span class="red-color">{{Session::get('has-error')}}</span>
				@endif
			</div>
		</div>
	@endif
@else
	<div class="row" style="padding:10px 0px">
			<div class="col l3" style="line-height: 30px">
				{{$collection->field_title}}
			</div>
			<div class="col l9">
				{!!Form::date(str_replace(' ','_',strtolower($collection->field_title)), null,['placeholder'=>FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder'),'class'=>'datepicker'])!!}
			</div>
			<div class="error-red">	
				@if(@$errors->has() || Session::has('date_error'))
					{{$errors->first(str_replace(' ','_',strtolower($collection->field_title)))}}
					<span class="red-color">{{Session::get('date_error')}}</span>

				@endif
			</div>
		</div>
@endif
	@if(Session::has('date_error'))
		<script type='text/javascript'>Materialize.toast('Date is already in use', 5000)</script>
	@endif

<script type="text/javascript">
	  $('.datepicker').pickadate({
		    selectMonths: true, // Creates a dropdown to control month
		    selectYears: 15 // Creates a dropdown of 15 years to control year
	  	});
	  $('.datepicker').on('open', function(){
	  		$('.datepicker').appendTo('body');
	  });
</script>