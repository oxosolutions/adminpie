<?php 
	$fieldType  = '';
	$model = FormGenerator::GetMetaValue($collection->fieldMeta,'choice_model');
 ?>
<?php if(isset($options['field_type']) && $options['field_type'] == 'array'): ?>
	<?php 
		$fieldType  = '[]';
	 ?>
<?php endif; ?>
<?php if(isset($options['default_value']) && $options['default_value'] != ''): ?>
	<?php 
		$default_value = $options['default_value'];
	 ?>
<?php else: ?>
	<?php 
		$default_value = null;
	 ?>
<?php endif; ?>

<?php 
	if($model != false && $model != '' && $model != null){
		$exploded = explode('@',$model);
		$result = new $exploded[0];
		$exploded[1] = str_replace('()', '', $exploded[1]);
		$default_value = @$result->{$exploded[1]}();
	}
	if(@$settings['form_field_show_placeholder']){
		$placeholder = FormGenerator::GetMetaValue($collection->fieldMeta,'field_placeholder');
	}else{
		$placeholder = '';
	}
	if(isset($settings['field_variable']) && $settings['field_variable'] == 'slug'){
		$name = $collection->field_slug;
	}else{
		$name = str_replace(' ','_',strtolower($collection->field_slug));
	}
	if(@$options['from'] == 'repeater'){
		$name = strtolower($collection->section->section_slug).'['.$options['loop_index'].']['.$name.']';
	}
    $question_repeater = @FormGenerator::GetMetaValue($collection->fieldMeta,'question_repeater');
    $textArray = '';
    if($question_repeater == 'yes'){
        $textArray = '[]';
    }
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
<?php echo Form::text($name.$textArray,$default_value,$fieldOptionsArray); ?> 

