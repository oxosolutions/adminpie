<?php 
	$class_name = FormGenerator::GetMetaValue($collection->fieldMeta,'field_class');
 ?>

		<?php 

			$optionValues = json_decode(FormGenerator::GetMetaValue($collection->fieldMeta,'field_options'),true);
			if(isset($optionValues['key'])){
				$status = false;
				$arrayOptions = array_combine($optionValues['key'], $optionValues['value']);
			}else{
				$status = true;
				$collect = collect($optionValues);
				/*$keys = array_keys($collect->groupBy('key')->toArray());

				$values = array_keys($collect->groupBy('value')->toArray());
				$arrayOptions = array_combine($keys, $values);*/
				$arrayOptions =null;
				if(!empty($collect->toArray())){
					
					$arrayOptions = $collect->mapwithKeys(function($items){
						if(!empty(@$items['value'])){
							return [@$items['key']=>$items['value']];
						}
					});
				}
			}

            if(!function_exists('javascriptCheckBoxValidations')){
                function javascriptCheckBoxValidations($loop, $collection, $field_validations, $class_name){
                    $fieldOptionsArray = [];
                    $fieldOptionsArray['class'] = $class_name;
                    $fieldOptionsArray['id'] = 'option_'.str_replace(' ','_',strtolower($collection->field_slug)).$loop->index;
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
                    return $fieldOptionsArray;
                }
            }

		 ?>
		<?php if($status == false): ?>
			
			<?php $__currentLoopData = $arrayOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div id="field_option_<?php echo e($collection->field_slug); ?>" class="field-option">
					<?php echo Form::checkbox(str_replace(' ','_',strtolower($collection->field_slug)).'[]',$key,null,javascriptCheckBoxValidations($loop,$collection,$field_validations,$class_name)); ?>

			    	<label for="option_<?php echo e(str_replace(' ','_',strtolower($collection->field_slug)).$loop->index); ?>" class="field-option-label"><?php echo $value; ?></label>    
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php else: ?>
			<?php $__currentLoopData = $arrayOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div id="field_option_<?php echo e($collection->field_slug); ?>" class="field-option">
					<?php echo Form::checkbox(str_replace(' ','_',strtolower($collection->field_slug)).'[]',$key,null,javascriptCheckBoxValidations($loop,$collection,$field_validations,$class_name)); ?>

			    	<label for="option_<?php echo e(str_replace(' ','_',strtolower($collection->field_slug)).$loop->index); ?>" class="field-option-label"><?php echo $value; ?></label>    
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endif; ?>
		