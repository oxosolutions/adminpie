<?php 
	$fieldType  = '';
	$string_length = @FormGenerator::GetMetaValue($collection->fieldMeta,'string_length');
	$prefix = @FormGenerator::GetMetaValue($collection->fieldMeta,'prefix');
	$postfix = @FormGenerator::GetMetaValue($collection->fieldMeta,'postfix');

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
	$name = str_replace(' ','_',strtolower($collection->field_slug)).$fieldType;

    $fieldOptionsArray = [];
    $fieldOptionsArray['class'] = $collection->field_slug;
    $fieldOptionsArray['id'] = 'input_'.$collection->field_slug;
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

 ?>
<?php if(@$model != '' && @$model != null && @$model[$name] != ''): ?>
	<?php echo Form::text(str_replace(' ','_',strtolower($collection->field_slug)).$fieldType,null,$fieldOptionsArray); ?>

<?php else: ?>
	<?php echo Form::text(str_replace(' ','_',strtolower($collection->field_slug)).$fieldType,$prefix.generate_filename($string_length,false).$postfix,$fieldOptionsArray); ?>

<?php endif; ?>
		
