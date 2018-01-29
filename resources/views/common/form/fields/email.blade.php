@php
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
@endphp

{!!Form::email(str_replace(' ','_',strtolower($collection->field_slug)),null,$fieldOptionsArray)!!}