<?php
	$fieldType  = '';
?>
<?php if(isset($options['field_type']) && $options['field_type'] == 'array'): ?>
	<?php
		$fieldType  = '[]';
	?>
<?php endif; ?>
<?php
    $fieldOptionsArray = [];
    $fieldOptionsArray['class'] = $collection->field_slug;
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
				
<?php echo Form::password(str_replace(' ','_',strtolower($collection->field_slug)).$fieldType,$fieldOptionsArray); ?>

				
				
