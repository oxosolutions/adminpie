<?php 
	$fieldType  = '';
	$required = '';
	$class_name = FormGenerator::GetMetaValue($collection->fieldMeta,'field_class');
	$requiredOrNot = FormGenerator::GetMetaValue($collection->fieldMeta,'field_required');
	if($requiredOrNot == 'yes'){
		$required = 'required';
	}
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
	if(isset($settings['show_placeholder']) && $settings['show_placeholder'] != '' && $settings['show_placeholder'] == 'yes'){
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
		$name = $collection->section->section_slug.'['.$options['loop_index'].']['.$name.']';
	}
    $fieldOptionsArray = [];
    $fieldOptionsArray['class'] = $collection->field_slug.' '.$class_name;
    $fieldOptionsArray['id'] = 'input_'.$collection->field_slug;
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
<?php echo Form::number($name,$default_value,$fieldOptionsArray); ?>

