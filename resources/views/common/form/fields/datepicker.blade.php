@php
	$placeholder = FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder');
    $fieldOptionsArray = [];
    $fieldOptionsArray['class'] = 'datepicker '.$collection->field_slug;
    $fieldOptionsArray['id'] = 'input_'.$collection->field_slug;
    $fieldOptionsArray['placeholder'] = $placeholder;
    $fieldOptionsArray['readonly'] = 'readonly';
    $fieldOptionsArray['data-validation'] = '';
    $validationString = '';
    if($field_validations != null){
        $javaScriptValidations = json_decode(@$field_validations);
        if(!empty($javaScriptValidations)){
            foreach($javaScriptValidations as $key => $validation){
                if(@$validation->field_validation == 'length'){
                    $fieldOptionsArray['data-validation-length'] = @$validation->validation_argument;
                }
                $validationString.= @$validation->field_validation.' ';
            }
            $fieldOptionsArray['data-validation'] = $validationString;
        }
    }
@endphp
				
{!!Form::date(str_replace(' ','_',strtolower($collection->field_slug)), null,$fieldOptionsArray)!!}
	
@if(Session::has('date_error'))
	<script type='text/javascript'>Materialize.toast('Date is already in use', 5000)</script>
@endif

<script type="text/javascript">
	  $('.datepicker').pickadate({
            format: 'yyyy/mm/dd',
		    selectMonths: true, // Creates a dropdown to control month
		    selectYears: 15 // Creates a dropdown of 15 years to control year
		    //
	  	});
	  $('.datepicker').on('open', function(){
	  		$('.datepicker').appendTo('body');
	  });
</script>