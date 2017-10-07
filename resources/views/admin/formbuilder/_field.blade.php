
@php
    $section = $sections->where('id',request()->input('sections'))->first();
    $field = $section->fields->where('id',request()->input('field'))->first();
    $fieldMeta = $field->fieldMeta->where('section_id',request()->input('sections'));
    $model = [];
    $model['field_title'] = $field->field_title;
    $model['field_type'] = $field->field_type;
    $model['field_description'] = $field->field_description;
    $model['field_order'] = $field->field_order;
    $model['field_slug'] = $field->field_slug;
    $next_field = $fieldMeta->where('key','next_field')->first();
    $model['next_field'] = ($next_field != null)?$next_field->value:'';

   foreach($fieldMeta as $key => $value){
        $model[$value->key] = @$value->value;
   }
    $sectionOptions = $fieldMeta->where('key','field_options')->first();
    $conditionsOptions = $fieldMeta->where('key','field_conditions')->first();
    $model['field_options'] = [];
    if($sectionOptions != null){
        $model['field_options'] = json_decode($sectionOptions->value,true);
    }
    if($conditionsOptions != null){
        $model['field_conditions'] = json_decode($conditionsOptions->value,true);
    }
@endphp

{!!Form::model($model,['route'=>[$route_slug.'update.field',request()->form_id,request()->input('sections'),request()->input('field')]])!!}

    {!! FormGenerator::GenerateForm('form_generator_fields',[],$model) !!}
    
    {{-- <div class="fields_list active-field">
        <div class="row field_row">
            <div class="col l4 left-align grey lighten-5 " style="padding:20px">
                <span class="field-title">Field Label*</span><br>
                <span class="field-description">This is the name which will appear on the EDIT page</span>
            </div>
            <div class="col l8 form-group"  style="padding: 10px">
                 <input type="text" required="required" name="field_title" value="{{$field->field_title}}" class="form-control field-label-input">
            </div>
        </div>
        <div class="row field_row">
            <div class="col l4 left-align grey lighten-5" style="padding:44px 20px">
                <span class="field-title">Field Description</span><br>
                <span class="field-description">Field Description</span> 
            </div>
            <div class="col l8 form-group" style="padding:10px">
               
                <input type="text" id="textarea2" class="materialize-textarea" required="required" name="field_description" value="{{$field->field_description}}">
            </div>  
        </div>
        <div class="row field_row">
            <div class="col l4 left-align grey lighten-5" style="padding: 30px 20px">
                <span class="field-title" style="line-height: 36px">Field Type*</span>         
            </div>
            <div class="col l8 input-field" style="padding:10px">
                <select name="field_type" required="required" class="field_type select_type">
                 <optgroup label="Basic">
                        <option value="" selected="selected">Select Type</option>
                        <option value="text" {{($field->field_type == 'text')?'selected':''}}>Text</option>
                        <option value="textarea" {{($field->field_type == 'textarea')?'selected':''}} >Text Area</option>
                        <option value="number" {{($field->field_type == 'number')?'selected':''}} >Number</option>
                        <option value="email" {{($field->field_type == 'email')?'selected':''}} >Email</option>
                        <option value="password" {{($field->field_type == 'password')?'selected':''}} >Password</option>
                        <option value="datepicker" {{($field->field_type == 'datepicker')?'selected':''}} >Datepicker</option>
                        <option value="timepicker" {{($field->field_type == 'timepicker')?'selected':''}} >Timepicker</option>
                        <option value="switch" {{($field->field_type == 'switch')?'selected':''}} >Switch</option>
                        <option value="editor" {{($field->field_type == 'editor')?'selected':''}} >Editor</option>
                        <option value="auto-generator" {{($field->field_type == 'auto-generator')?'selected':''}} >Auto Generator Text</option>
                    </optgroup>
                    <optgroup label="Content">
                        <option value="image" {{($field->field_type == 'image')?'selected':''}} >Image</option>
                        <option value="file" {{($field->field_type == 'file')?'selected':''}} >File</option>
                    </optgroup>
                    <optgroup label="Choice">
                        <option value="select" {{($field->field_type == 'select')?'selected':''}} >Select</option>
                        <option value="multi_select" {{($field->field_type == 'multi_select')?'selected':''}} >Multi Select</option>
                        <option value="checkbox" {{($field->field_type == 'checkbox')?'selected':''}} >Checkbox</option>
                        <option value="radio" {{($field->field_type == 'radio')?'selected':''}} >Radio Button</option>
                        <option value="media" {{($field->field_type == 'media')?'selected':''}} >Media</option>
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
                 <input type="text" name="field_order" required="required" class="form-control field-label-input" value="{{$field->order}}">
            </div>
        </div>
        <div class="row field_row postfix">
            <div class="col l4 left-align grey lighten-5" style="padding:20px">
            <span class="field-title">prefix</span><br>
                <span class="field-description">Text will place on starting of random numbers</span>
            </div>
            <div class="col l8 form-group" style="padding:10px">
                 <input type="text" name="prefix" class="form-control field-label-input" value="{{@$fiedlMeta->where('key','prefix')->first()->value}}">
            </div>
        </div>
        <div class="row field_row postfix">
            <div class="col l4 left-align grey lighten-5" style="padding:20px">
            <span class="field-title">Postfix</span><br>
                <span class="field-description">Text will place on end of random numbers</span>
            </div>
            <div class="col l8 form-group" style="padding:10px">
                 <input type="text" name="postfix" value="{{@$fiedlMeta->where('key','postfix')->first()->value}}">
            </div>
        </div>
        <div class="row field_row postfix">
            <div class="col l4 left-align grey lighten-5" style="padding:20px">
            <span class="field-title">Length</span><br>
                <span class="field-description">Enter the random number/string length, default value will be 30</span>
            </div>
            <div class="col l8 form-group" style="padding:10px">
                 <input  type="text" name="string_length" value="{{@$fiedlMeta->where('key','string_length')->first()->value}}">
            </div>
        </div>

        <div class="row field_row">
            <div class="col l4 left-align grey lighten-5 " style="padding:20px">
                <span class="field-title">Field Slug*</span><br>
                <span class="field-description"></span>
            </div>
            <div class="col l8 form-group"  style="padding: 10px">
                 <input type="text" name="field_slug" value="{{@$field->field_slug}}">
            </div>
        </div>
        <div class="row field_row">
            <div class="col l4 left-align grey lighten-5" style="padding:44px 20px">
                <span class="field-title">Field Required?</span><br>
            </div>
            <div class="col l8 form-group" style="padding:10px">
                <select name="field_required">
                   <option value="yes" {{(@$fiedlMeta->where('key','field_required')->first()->value == 'yes')?'selected':''}}>Yes</option>
                    <option value="no" {{(@$fiedlMeta->where('key','field_required')->first()->value == 'no')?'selected':''}}>No</option>
                </select>
            </div>  
        </div>
        <div class="row field_row">
            <div class="col l4 left-align grey lighten-5" style="padding:20px">
                <span class="field-title">Field Error Messages</span><br>
                <span class="field-description">eg. Show extra content</span> 
            </div>
            <div class="col l6 form-group messages" style="padding:5px">
            	
            		<div class="appended_error">
                		<input type="text" class="form-control" name="field_error_message">
                		<a href="javascript:;" style="float:right;" class="delete_message"><span class=" fa fa-trash"></span></a>
            		</div>
               
            </div>  
            <div class="col l1 form-group" style="padding:5px">
                <a href="javascript:;" class="add_message" data-count=" ">Add</a>
            </div>  
        </div>
        <div class="row field_row">
            <div class="col l4 left-align grey lighten-5" style="padding:20px">
                <span class="field-title">Field Validation</span><br>
                <span class="field-description">validations</span>
            </div>
            <div class="col l6 form-group validations" style="padding:10px">
           
           
            	<div class="appended_vallidation">
                    @php
                        $validateArray = [];
                        $validationValue = @$fiedlMeta->where('key','field_validation')->first()->value;
                        if($validationValue != null){
                            $validateArray = json_decode($validationValue);

                        }
                    @endphp
                    <select name="field_validation[]" multiple placeholder="Select Validation Type">
                        <option disabled>Select Validation Type</option>
                        <option value="required" {{(in_array('required',$validateArray))?'selected':''}}>Required</option>
                        <option value="url" {{(in_array('url',$validateArray))?'selected':''}}>URL</option>
                        <option value="email" {{(in_array('email',$validateArray))?'selected':''}}>Email</option>
                    </select>
                	
            	</div>
           
            </div>
            
        </div>
            <div class="row field_row main-option-row" style="display: {{(in_array($field->field_type,['select','multi_select','checkbox','radio']))?'block':'none'}}">
                <div class="col l4 left-align grey lighten-5" style="padding:44px 20px">
                    <span class="field-title">Field options</span><br>
                </div>
                <div class="col l8 form-group" style="padding:5px">
                    @php
                        $combine_array = null;
                        $fieldOptions = @$fiedlMeta->where('key','field_options')->first()->value;
                       
                        @$keys = json_decode($fieldOptions)->key;
                        @$values = json_decode($fieldOptions)->value;
                        if(!empty($keys) || $keys != null){
                            $combine_array = array_combine($keys, $values);            
                        }
                       if($combine_array == null){
                            $combine_array = [];
                       }
                    @endphp
                    @foreach($combine_array as $key => $value)
                        <div class="row main-option-div key-counts">
                            <div class="col l5">
                                <div class="field_options_key">
                                    <input type="text" id="test4" name="field_options[key][]" value="{{$key}}"/>
                                    <label for="test4">Key</label>
                                </div>
                            </div>
                            <div class="col l5">
                                <div class="field_options_value">
                                    <input type="text" id="test5" name="field_options[value][]" value="{{$value}}"/>
                                    <label for="test4">Value</label>
                                    <div class="col l2" style="float: right;">
                                        <a href="javascript:;" class="delete_option"><i class="fa fa-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col l2">
                        <a href="javascript:;" class="add_options btn btn-primary">Add</a>
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
                <input type="text" name="choice_model" value="{{@$fiedlMeta->where('key','choice_model')->first()->value}}">
            </div>  
        </div>

        <div class="row field_row">
            <div class="col l4 left-align grey lighten-5" style="padding:20px">
                <span class="field-title">Field Formatting</span><br>
                <span class="field-description">Affects value on front end</span> 
            </div>
            <div class="col l8 form-group" style="padding:10px">
                <select name="field_format">
                    <option value="" disabled selected>Choose your option</option>
                   <option value="plain" {{(@$fiedlMeta->where('key','field_format')->first()->value == 'plain')?'selected':''}}>Plain</option>
                    <option value="text" {{(@$fiedlMeta->where('key','field_format')->first()->value == 'text')?'selected':''}}>HTML</option>
                </select>
            </div>  
        </div>        
        <div class="row field_row">
            <div class="col l4 left-align grey lighten-5" style="padding:20px">
                <span class="field-title">Field Placeholder</span><br>
                <span class="field-description">Appears within the input</span> 
            </div>
            <div class="col l8 form-group" style="padding:10px">
                <input type="text" name="field_placeholder" value="{{@$fiedlMeta->where('key','field_placeholder')->first()->value}}">
            </div>  
        </div>
        <div class="row field_row">
            <div class="col l4 left-align grey lighten-5" style="padding:20px">
                <span class="field-title">Field Tooltip</span><br>
                <span class="field-description">Appears on hover</span> 
            </div>
            <div class="col l8 form-group" style="padding:10px">
                <input type="text" name="field_tooltip" value="{{@$fiedlMeta->where('key','field_tooltip')->first()->value}}">
            </div>  
        </div>
        <div class="row field_row">
            <div class="col l4 left-align grey lighten-5" style="padding:20px">
                <span class="field-title">Field value</span><br>
                <span class="field-description">Appears</span> 
            </div>
            <div class="col l8 form-group" style="padding:10px">
                <input type="text" name="field_value" value="{{@$fiedlMeta->where('key','field_value')->first()->value}}">
            </div>  
        </div>
        <div class="row field_row">
            <div class="col l4 left-align grey lighten-5" style="padding:20px">
                <span class="field-title">Field class</span><br>
                <span class="field-description">Appears</span> 
            </div>
            <div class="col l8 form-group" style="padding:10px">
                <input type="text" name="field_class" class="form-control" value="{{@$fiedlMeta->where('key','field_class')->first()->value}}">
            </div>  
        </div>
     
    </div> --}}
    {{-- <button type="submit" class="btn blue">
        Save
    </button> --}}
  {{--   <style type="text/css">
        .prefix{
            display: none;
        }
        .postfix{
            display: {{($field->field_type == 'auto-generator')?'block':'none'}};
        }
    </style> --}}
{!!Form::close()!!}
<style type="text/css">
    
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $('#field_prefix').hide();
        $('#field_postfix').hide();
        $('body').on('change','#field_field_type .field_type',function(e){
            e.preventDefault();
            e.stopPropagation();
            if($(this).val() == 'select'  || $(this).val() == 'multi_select' || $(this).val() == 'checkbox' || $(this).val() == 'radio'){
                console.log('hello111');
                $('.main-option-row').show();
            }else{
                $('.main-option-row').hide();
            }
            if($(this).val() == 'auto-generator'){
                $('#field_prefix').show();
                $('#field_postfix').show();
            }else{
                $('.prefix').hide();
                $('.postfix').hide();
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
        var count = $('.key-counts').length;
       
        var appended_row = '<div class="col l12 form-group del_opt key-counts" style="padding:5px"><div class="row"><div class="col l5"><input type="text" id="test4" name="field_options[key][]"/><label for="test4">Key</label></div><div class="col l5"><input type="text" id="test5" name="field_options[value][]" /><label for="test4">Value</label></div><div class="col l2"><a href="javascript:;" class="add_options"><i class="fa fa-trash del_option"></i></a></div></div></div>';
        $(this).parents('.field_row').find('.appended_options').append(appended_row);
    });
</script>