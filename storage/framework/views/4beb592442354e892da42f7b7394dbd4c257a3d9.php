    <?php 
        @$keys = json_decode(App\Model\Admin\FieldMeta::getMetaByKey(@$value->fieldMeta,'field_options'))->key;
        @$values = json_decode(App\Model\Admin\FieldMeta::getMetaByKey(@$value->fieldMeta,'field_options'))->value;
        if(!empty($keys) || $keys != null){
            $combine_array = array_combine($keys, $values);            
        }
     ?>
    
    <div class="main-row">
        <div class="row form-row option-trigger" style="background-color: #fff;padding: 15px 10px">

        <div class="col l2">
          <div style="float: left;background-color: grey;text-align: center;width: 42px;margin-top: -11px;margin-bottom: -11px;line-height: 67px;" class="handle">
            <a href="">
              <i class="fa fa-arrows" style="color: white"></i>
            </a>
          </div>
          <span style="border:1px solid #e8e8e8;line-height: 46px;width: 34px;margin: 0 auto;margin-left:10px;border-radius: 50%;padding:10px 15px;" class="row-count"><?php echo e($index); ?></span>
          <div style="clear: both">
              
          </div>
        </div>
        <div class="col l4">
          <div class="row">
            <div class="col l12 field-label">
              <?php echo e(@$value->field_title); ?>

            </div>
            <div class="" style="font-size: 12px;height: 0px">
              <span class="options">
                <input type="hidden" name="field_id[<?php echo e($rowCount); ?>]" value="<?php echo e(@$value->id); ?>">
                <a href="javascript:void(0)" class="edit-fields" style="border:0px !important;padding: 0px">Edit </a> |
                <a href="<?php echo e(route('field.delete',$value->id)); ?>" class="delete-row">Delete </a>
              </span>
            </div>
          </div>
        </div>
            <?php 
                $slug[]['name'] = $value->field_slug;
             ?>
        
        
            <div class="col l4 field-name-text"><?php echo e(@$value->field_slug); ?></div>
            <div class="col l2 field-type"><?php echo e(ucfirst(@$value->field_type)); ?></div>
        
      </div>
      <div class="fields-list" style="display: none;border-top:1px;border-color: #e8e8e8;border-style: solid">
        <div colspan=100% style="padding: 0px;">
           <div>

            <div class="fields_list active-field">
                <div class="row field_row">
                    <div class="col l4 left-align grey lighten-5 " style="padding:20px">
                        <span class="field-title">Field Label*</span><br>
                        <span class="field-description">This is the name which will appear on the EDIT page</span>
                    </div>
                    <div class="col l8 form-group"  style="padding: 10px">
                         <input type="text" required="required" name="field_title[<?php echo e($rowCount); ?>]" value="<?php echo e(@$value->field_title); ?>" class="form-control field-label-input">
                    </div>
                </div>
                <div class="row field_row">
                    <div class="col l4 left-align grey lighten-5" style="padding:44px 20px">
                        <span class="field-title">Field Description</span><br>
                        <span class="field-description">Field Description</span> 
                    </div>
                    <div class="col l8 form-group" style="padding:10px">
                        
                        <input type="text" id="textarea2" class="materialize-textarea" required="required" name="field_description[<?php echo e($rowCount); ?>]" value="<?php echo e(@$value->field_description); ?>">
                    </div>  
                </div>
                <div class="row field_row">
                    <div class="col l4 left-align grey lighten-5" style="padding: 30px 20px">
                        <span class="field-title" style="line-height: 36px">Field Type*</span>         
                    </div>
                    <div class="col l8 input-field" style="padding:10px">
                        <select name="field_type[<?php echo e($rowCount); ?>]" required="required" class="field_type select_type">
                         <optgroup label="Basic">
                                <option value="" selected="selected">Select Type</option>
                                <option value="text" <?php echo e((@$value->field_type == 'text')?'selected':''); ?>>Text</option>
                                <option value="textarea" <?php echo e((@$value->field_type == 'textarea')?'selected':''); ?>>Text Area</option>
                                <option value="number" <?php echo e((@$value->field_type == 'number')?'selected':''); ?>>Number</option>
                                <option value="email" <?php echo e((@$value->field_type == 'email')?'selected':''); ?>>Email</option>
                                <option value="password" <?php echo e((@$value->field_type == 'password')?'selected':''); ?>>Password</option>
                                <option value="datepicker" <?php echo e((@$value->field_type == 'datepicker')?'selected':''); ?>>Datepicker</option>
                                <option value="timepicker" <?php echo e((@$value->field_type == 'timepicker')?'selected':''); ?>>Timepicker</option>
                                <option value="switch" <?php echo e((@$value->field_type == 'switch')?'selected':''); ?>>Switch</option>
                                <option value="editor" <?php echo e((@$value->field_type == 'editor')?'selected':''); ?>>Editor</option>
                            </optgroup>
                            <optgroup label="Content">
                                <option value="image" <?php echo e((@$value->field_type == 'image')?'selected':''); ?>>Image</option>
                                <option value="file" <?php echo e((@$value->field_type == 'file')?'selected':''); ?>>File</option>
                            </optgroup>
                            <optgroup label="Choice">
                                <option value="select" <?php echo e((@$value->field_type == 'select')?'selected':''); ?>>Select</option>
                                <option value="multi_select" <?php echo e((@$value->field_type == 'multi_select')?'selected':''); ?>>Multi Select</option>
                                <option value="checkbox" <?php echo e((@$value->field_type == 'checkbox')?'selected':''); ?>>Checkbox</option>
                                <option value="radio" <?php echo e((@$value->field_type == 'radio')?'selected':''); ?>>Radio Button</option>
                            </optgroup>
                        </select>
                          
                    </div>  
                </div>
                <div class="row field_row">
                    <div class="col l4 left-align grey lighten-5" style="padding:20px">
                    <span class="field-title">Field Order</span><br>
                        <span class="field-description">Question Order be in number [0-9]</span>
                    </div>
                    <div class="col l8 form-group" style="padding:10px">
                         <input type="text" name="field_order[<?php echo e($rowCount); ?>]" required="required" class="form-control field-label-input" value="<?php echo e(@$value->field_order); ?>">
                    </div>
                </div>
                <div class="row field_row">
                    <div class="col l4 left-align grey lighten-5 " style="padding:20px">
                        <span class="field-title">Field Slug*</span><br>
                        <span class="field-description"></span>
                    </div>
                    <div class="col l8 form-group"  style="padding: 10px">
                         <input type="text" name="field_slug[<?php echo e($rowCount); ?>]" required="" class="form-control field-label-input" value="<?php echo e(@$value->field_slug); ?>">
                    </div>
                </div>
                <div class="row field_row">
                    <div class="col l4 left-align grey lighten-5" style="padding:44px 20px">
                        <span class="field-title">Field Required?</span><br>
                    </div>
                    <div class="col l8 form-group" style="padding:10px">
                        <select name="field_required[<?php echo e($rowCount); ?>]">
                           <option value="yes" <?php echo e((App\Model\Admin\FieldMeta::getMetaByKey(@$value->fieldMeta,'field_required') == 'yes')?'selected':''); ?>>Yes</option>
                            <option value="no" <?php echo e((App\Model\Admin\FieldMeta::getMetaByKey(@$value->fieldMeta,'field_required') == 'no')?'selected':''); ?>>No</option>
                        </select>
                    </div>  
                </div>
                <div class="row field_row">
                    <div class="col l4 left-align grey lighten-5" style="padding:20px">
                        <span class="field-title">Field Error Messages</span><br>
                        <span class="field-description">eg. Show extra content</span> 
                    </div>
                    <div class="col l6 form-group messages" style="padding:5px">
                    	<?php   
                            $errorMessages = json_decode(App\Model\Admin\FieldMeta::getMetaByKey(@$value->fieldMeta,'field_error_message'));
	                     ?>
	                    <?php $__currentLoopData = @$errorMessages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error => $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    		<div class="appended_error">
	                    		<input type="text" class="form-control" name="field_error_message[<?php echo e($rowCount); ?>][]" value="<?php echo e(@$message); ?>">
	                    		<a href="javascript:;" style="float:right;" class="delete_message"><span class=" fa fa-trash"></span></a>
                    		</div>
	                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>  
                    <div class="col l1 form-group" style="padding:5px">
                        <a href="javascript:;" class="add_message" data-count="<?php echo e($rowCount); ?>">Add</a>
                    </div>  
                </div>
                <div class="row field_row">
                    <div class="col l4 left-align grey lighten-5" style="padding:20px">
                        <span class="field-title">Field Validation</span><br>
                        <span class="field-description">validations</span>
                    </div>
                    <div class="col l6 form-group validations" style="padding:10px">
                    <?php   
                        $validation = json_decode(App\Model\Admin\FieldMeta::getMetaByKey(@$value->fieldMeta,'field_validation'));
					 ?>
                    <?php $__currentLoopData = @$validation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyValidation => $validationList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    	<div class="appended_vallidation">
                        	<input type="text" name="field_validation[<?php echo e($rowCount); ?>][]" class="form-control field-label-input" value="<?php echo e(@$validationList); ?>">
                        	<a href="javascript:;" style="float:right;" class="delete_validation"><span class=" fa fa-trash"></span></a>
                    	</div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <a href="javascript:;" class="btn add_validation" data-count="<?php echo e($rowCount); ?>">Add</a>
                </div>
                
                    <div class="row field_row main-option-row">
                        <div class="col l4 left-align grey lighten-5" style="padding:44px 20px">
                            <span class="field-title">Field options</span><br>
                        </div>
                        <div class="col l8 form-group" style="padding:5px">
                            <?php if(!empty($keys) || $keys != null): ?>
                                <?php $__currentLoopData = $combine_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ke => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="row main-option-div">
                                        <div class="col l5">
                                            <div class="field_options_key">
                                                <input type="text" id="test4" name="field_options[<?php echo e($rowCount); ?>][key][]" value="<?php echo e($ke); ?>"/>
                                                <label for="test4">Key</label>
                                            </div>
                                        </div>
                                        <div class="col l5">
                                            <div class="field_options_value">
                                                <input type="text" id="test5" name="field_options[<?php echo e($rowCount); ?>][value][]" value="<?php echo e($data); ?>"/>
                                                <label for="test4">Value</label>
                                                <div class="col l2" style="float: right;">
                                                    <a href="javascript:;" class="delete_option"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <div class="row main-option-div">
                                    <div class="col l5">
                                        <div class="field_options_key">
                                            <input type="text" id="test4" name="field_options[<?php echo e($rowCount); ?>][key][]" value=""/>
                                            <label for="test4">Key</label>
                                        </div>
                                    </div>
                                    <div class="col l5">
                                        <div class="field_options_value">
                                            <input type="text" id="test5" name="field_options[<?php echo e($rowCount); ?>][value][]" value=""/>
                                            <label for="test4">Value</label>
                                            <div class="col l2" style="float: right;">
                                                <a href="javascript:;" class="delete_option"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="col l2">
                                <a href="javascript:;" class="add_options btn btn-primary" data-count="<?php echo e($rowCount); ?>">Add</a>
                            </div>
                            <div class="appended_options">
                                
                            </div>
                        </div>
                    </div>

                <div class="row field_row main-option-row">
                    <div class="col l4 left-align grey lighten-5" style="padding:20px">
                        <span class="field-title">Model Associate</span><br>
                        <span class="field-description">Enter the model name which one is associate with this dropdown</span> 
                    </div>
                    <div class="col l8 form-group" style="padding:10px">
                        <input type="text" name="choice_model[<?php echo e($rowCount); ?>]" class="form-control" value="<?php echo e(App\Model\Admin\FieldMeta::getMetaByKey(@$value->fieldMeta,'choice_model')); ?>">
                    </div>  
                </div>

                <div class="row field_row">
                    <div class="col l4 left-align grey lighten-5" style="padding:20px">
                        <span class="field-title">Field Formatting</span><br>
                        <span class="field-description">Affects value on front end</span> 
                    </div>
                    <div class="col l8 form-group" style="padding:10px">
                        <select name="field_format[<?php echo e($rowCount); ?>]">
                            <option value="" disabled selected>Choose your option</option>
                           <option value="plain" selected="<?php echo e((App\Model\Admin\FieldMeta::getMetaByKey(@$value->fieldMeta,'field_format') == 'plain')?'checked':''); ?>">Plain</option>
                            <option value="text" selected="<?php echo e((App\Model\Admin\FieldMeta::getMetaByKey(@$value->fieldMeta,'field_format') == 'text')?'checked':''); ?>">HTML</option>
                        </select>
                    </div>  
                </div>        
                <div class="row field_row">
                    <div class="col l4 left-align grey lighten-5" style="padding:20px">
                        <span class="field-title">Field Placeholder</span><br>
                        <span class="field-description">Appears within the input</span> 
                    </div>
                    <div class="col l8 form-group" style="padding:10px">
                        <input type="text" name="field_placeholder[<?php echo e($rowCount); ?>]" class="form-control" value="<?php echo e(App\Model\Admin\FieldMeta::getMetaByKey(@$value->fieldMeta,'field_placeholder')); ?>">
                    </div>  
                </div>
                <div class="row field_row">
                    <div class="col l4 left-align grey lighten-5" style="padding:20px">
                        <span class="field-title">Field Tooltip</span><br>
                        <span class="field-description">Appears on hover</span> 
                    </div>
                    <div class="col l8 form-group" style="padding:10px">
                        <input type="text" name="field_tooltip[<?php echo e($rowCount); ?>]" class="form-control" value="<?php echo e(App\Model\Admin\FieldMeta::getMetaByKey(@$value->fieldMeta,'field_tooltip')); ?>">
                    </div>  
                </div>
                <div class="row field_row">
                    <div class="col l4 left-align grey lighten-5" style="padding:20px">
                        <span class="field-title">Field value</span><br>
                        <span class="field-description">Appears</span> 
                    </div>
                    <div class="col l8 form-group" style="padding:10px">
                        <input type="text" name="field_value[<?php echo e($rowCount); ?>]" class="form-control" value="<?php echo e(App\Model\Admin\FieldMeta::getMetaByKey(@$value->fieldMeta,'field_value')); ?>">
                    </div>  
                </div>
                <div class="row field_row">
                    <div class="col l4 left-align grey lighten-5" style="padding:20px">
                        <span class="field-title">Field class</span><br>
                        <span class="field-description">Appears</span> 
                    </div>
                    <div class="col l8 form-group" style="padding:10px">
                        <input type="text" name="field_class[<?php echo e($rowCount); ?>]" value="<?php echo e(App\Model\Admin\FieldMeta::getMetaByKey(@$value->fieldMeta,'field_class')); ?>" class="form-control">
                    </div>  
                </div>
                
            </div>
          </div>
        </div>
      </div>
    </div>
    
<script type="text/javascript">
    $(document).ready(function() {
        $('select').material_select();
        $('.main-option-row').hide();
        $('body').on('change','.field_type',function(e){
            e.preventDefault();
            e.stopPropagation();
            if($(this).val() == 'select'  || $(this).val() == 'multi_select' || $(this).val() == 'checkbox' || $(this).val() == 'radio'){
                $('.main-option-row').show();
            }else{
                $('.main-option-row').hide();
            }
        });

    });
    $('.add_message').unbind('click').bind('click' ,function(e){
        e.preventDefault();
        var count = $(this).attr('data-count');
        var appended_row = '<div class="appended_error"><input type="text" class="form-control" name="field_error_message['+count+'][]"><a href="javascript:;" style="float:right;" class="delete_message"><span class=" fa fa-trash"></span></a></div>';
        $(this).parents('.field_row').find('.messages').append(appended_row);
        $(this).parents('.field_row').find('.delete_message').show();
    });
    $('body').on('click','.delete_message',function(){
        $(this).parents('.appended_error').remove();
        // if($(this).parents('.form-group').find('div').length == 2){
        //     alert($(this).parents('.messages').find('.delete_message').length);
        // }
    });
    $('body').on('click','.delete_validation',function(){
        $(this).parents('.appended_vallidation').remove();
    });
    $('body').on('click','.delete_option',function(){
        $(this).parents('.main-option-div').remove();
    });

    $('body').on('click','.del_option',function(){
        $(this).parents('.del_opt').remove();
    });    

    $('.add_validation').unbind('click').bind('click' ,function(){
        var count = $(this).attr('data-count');
        var appended_row = '<div class="appended_validation"><input type="text" name="field_validation['+count+'][]" class="form-control field-label-input"><a href="javascript:;" style="float:right;" class="delete_validation"><span class=" fa fa-trash"></span></a></div>';
        $(this).parents('.field_row').find('.validations').append(appended_row);
    });

    $('.add_options').unbind('click').bind('click' ,function(){
        var count = $(this).attr('data-count');
        var appended_row = '<div class="col l12 form-group del_opt" style="padding:5px"><div class="row"><div class="col l5"><input type="text" id="test4" name="field_options['+count+'][key][]"/><label for="test4">Key</label></div><div class="col l5"><input type="text" id="test5" name="field_options['+count+'][value][]" /><label for="test4">Value</label></div><div class="col l2"><a href="javascript:;" class="add_options"><i class="fa fa-trash del_option"></i></a></div></div></div>';
        $(this).parents('.field_row').find('.appended_options').append(appended_row);
    });
</script>
<style type="text/css">
	.delete_message:first-child{
		display: none;
	}
</style>