<?php
    $fieldOptionsArray = [];
    $fieldOptionsArray['class'] = $field_input_class;
    $fieldOptionsArray['id'] = $field_input_id;
    $fieldOptionsArray['placeholder'] = $placeholder;
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
<?php echo Form::textarea(str_replace(' ','_',strtolower($collection->field_slug)), null,$fieldOptionsArray); ?>

<div class="aione-code-editor-wrapper">
	<div  class="aione-code-editor-meta"><span class="editor-action-fullscreen"><i class="fa fa-expand"></i></span></div>
	<div id="<?php echo e($field_input_id); ?>_editor" class="aione-code-editor" data-mode="<?php echo e(@$field_meta->field_custom_code_language); ?>" data-theme="<?php echo e(@$field_meta->field_custom_code_theme); ?>"></div> 
</div>