@php
	if(isset($settings['field_variable']) && $settings['field_variable'] == 'slug'){
		$name = $collection->field_slug;
	}else{
		$name = str_replace(' ','_',strtolower($collection->field_slug));
	}
	if(@$options['from'] == 'repeater'){
		$name = strtolower($collection->section->section_slug).'['.$options['loop_index'].']['.$name.']';
	}
    $fieldOptionsArray = [];
    $fieldOptionsArray['class'] = $collection->field_slug;
    $fieldOptionsArray['id'] = 'input_'.$collection->field_slug;
    $fieldOptionsArray['rows'] = 5;
    $fieldOptionsArray['cols'] = 20;
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
{!!Form::textarea($name,null,$fieldOptionsArray)!!}
