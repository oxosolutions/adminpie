@php
    $section = $sections->where('id',request()->input('sections'))->first();
    $field = $section->fields->where('id',request()->input('field'))->first();
    $fieldMeta = $field->fieldMeta->where('section_id',request()->input('sections'));
    $model = $field->toArray();
    $next_field = $fieldMeta->where('key','next_field')->first();
    $model['next_field'] = ($next_field != null)?$next_field->value:'';
    foreach($fieldMeta as $key => $value){
        if(in_array($value->key,['field_options','field_conditions','field_error_messages','field_validations'])){
            $model[$value->key] = json_decode($value->value,true);
        }else{
            $model[$value->key] = @$value->value;
        }
    }
@endphp

{!!Form::model($model,['route'=>[$route_slug.'update.field',request()->form_id,request()->input('sections'),request()->input('field')]])!!}

    {!! FormGenerator::GenerateForm('form_generator_fields',[],$model) !!}

{!!Form::close()!!}

<style type="text/css">
    
</style>
<script type="text/javascript">
    /*$(document).ready(function() {
        $('#field_prefix').hide();
        $('#field_postfix').hide();
        $('body').on('change','#field_field_type .field_type',function(e){
            e.preventDefault();
            e.stopPropagation();
            if($(this).val() == 'select'  || $(this).val() == 'multi_select' || $(this).val() == 'checkbox' || $(this).val() == 'radio'){
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

    });*/
    /*$('.add_message').unbind('click').bind('click' ,function(e){
        e.preventDefault();
        var count = $(this).attr('data-count');
        var appended_row = '<div class="appended_error"><input type="text" class="form-control" name="field_error_message['+count+'][]"><a href="javascript:;" style="float:right;" class="delete_message"><span class=" fa fa-trash"></span></a></div>';
        $(this).parents('.field_row').find('.messages').append(appended_row);
        $(this).parents('.field_row').find('.delete_message').show();
    });*/
    /*$('body').on('click','.delete_message',function(){
        $(this).parents('.appended_error').remove();
        // if($(this).parents('.form-group').find('div').length == 2){
        //     alert($(this).parents('.messages').find('.delete_message').length);
        // }
    });*/
    /*$('body').on('click','.delete_validation',function(){
        $(this).parents('.appended_vallidation').remove();
    });
    $('body').on('click','.delete_option',function(){
        $(this).parents('.main-option-div').remove();
    });

    $('body').on('click','.del_option',function(){
        $(this).parents('.del_opt').remove();
    });*/

    /*$('.add_validation').unbind('click').bind('click' ,function(){
        var count = $(this).attr('data-count');
        var appended_row = '<div class="appended_validation"><input type="text" name="field_validation['+count+'][]" class="form-control field-label-input"><a href="javascript:;" style="float:right;" class="delete_validation"><span class=" fa fa-trash"></span></a></div>';
        $(this).parents('.field_row').find('.validations').append(appended_row);
    });*/

    /*$('.add_options').unbind('click').bind('click' ,function(){
        var count = $('.key-counts').length;
       
        var appended_row = '<div class="col l12 form-group del_opt key-counts" style="padding:5px"><div class="row"><div class="col l5"><input type="text" id="test4" name="field_options[key][]"/><label for="test4">Key</label></div><div class="col l5"><input type="text" id="test5" name="field_options[value][]" /><label for="test4">Value</label></div><div class="col l2"><a href="javascript:;" class="add_options"><i class="fa fa-trash del_option"></i></a></div></div></div>';
        $(this).parents('.field_row').find('.appended_options').append(appended_row);
    });*/
</script>