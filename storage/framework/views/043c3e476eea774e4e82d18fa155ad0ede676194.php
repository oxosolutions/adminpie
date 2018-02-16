<?php 
    $fieldOptionsArray = [];
    $fieldOptionsArray['class'] = 'timepicker '.$collection->field_slug;
    $fieldOptionsArray['id'] = 'input_'.$collection->field_slug;
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
 ?>

<?php echo Form::time(str_replace(' ','_',strtolower($collection->field_slug)), null,$fieldOptionsArray); ?>

		
	


<script type="text/javascript">
	   $('.timepicker').pickatime({
		   default: 'now',
		   twelvehour: false, // change to 12 hour AM/PM clock from 24 hour
		   donetext: 'OK',
			 autoclose: false,
			 vibrate: true // vibrate the device when dragging clock hand
		});
</script>