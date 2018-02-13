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
<?php echo Form::hidden(str_replace(' ','_',strtolower($collection->field_slug)),0); ?>

<?php echo Form::checkbox(str_replace(' ','_',strtolower($collection->field_slug)),1,null,$fieldOptionsArray); ?>

<label class="switch" for="input_<?php echo e($collection->field_slug); ?>">
    <span class="handle"></span>
</label>