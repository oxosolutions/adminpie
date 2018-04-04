<?php 
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
 ?>
<?php echo Form::model($model,['route'=>[$route_slug.'update.field',request()->form_id,request()->input('sections'),request()->input('field')]]); ?>


    <?php echo FormGenerator::GenerateForm('form_generator_fields',[],$model); ?>


<?php echo Form::close(); ?>





<script type="text/javascript">
    //Fields to Hide

    var field_type = $('#field_397 select').val();

    $('#field_397 select').change(function(){
        var selected_field = $(this).val();
        if($.inArray(selected_field,['select','multi_select']) !== -1){
            $('#field_409').show();
            $('#field_3270 input[value="model"]').attr('checked',true);
        }else{
            $('#field_409').hide();
            $('#field_3270 input[value="model"]').attr('checked',false);
        }
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        var selectedFill = '<?php echo e(@$model["prefilled_with"]); ?>';
        console.log(selectedFill);
        var toHide = '';
        switch(selectedFill){
            case'static':
                toHide = '#field_3258, #field_409, #field_3259, #field_3257';
            break;

            case'model':
                toHide = '#field_3258, #field_3259, #field_3257, #field_406, .field_options';
            break;

            case'dataset':
                toHide = '#field_3257, #field_406, .field_options';
            break;

            case'survey':
                toHide = '#field_3258, #field_406, .field_options';
            break;
            default:
                toHide = '#field_3258, #field_409, #field_3259, #field_3257, #field_406, .field_options';

        }
        $(toHide).hide();

        $('#field_3270 input').click(function(){
            if($(this).val() == 'model'){
                $('#field_409').show();
                $('#field_3258').hide();
                $('#field_3259').hide();
                $('#field_3257').hide();
                $('#field_406').hide();
                $('.field_options').hide();
                // $('#field_3259 select').html('');
            }else if($(this).val() == 'dataset'){
                $('#field_3258').show();
                $('#field_409').show();
                $('#field_3259').show();
                $('#field_3257').hide();
                $('#field_406').hide();
                $('.field_options').hide();
                
                // $('#field_3259 select').html('');
            }else if($(this).val() == 'survey'){
                $('#field_3257').show();
                $('#field_3259').show();
                $('#field_409').show();
                $('#field_3258').hide();
                $('#field_406').hide();
                $('.field_options').hide();
                // $('#field_3259 select').html('');
            }else if($(this).val() == 'static'){
                // $('.field_options').show();
                $('#field_406').show();
                $('#field_3257').hide();
                $('#field_3259').hide();
                $('#field_409').hide();
                $('#field_3258').hide();
                $('.field_options').show();
                // $('#field_3259 select').html('');
            }
        });

        $('#field_3258 select').change(function(){
            var datasetId = $(this).val();
            $.ajax({
               type:'GET',
               url: route()+'/dataset/columns/',
               data: {dataset: datasetId,status:true},
               success: function(result){
                    $('#field_3259 select').html(result);
                    $('#field_3259 select').val('<?php echo e(@$model['select_column']); ?>');
               }
            });
        });
        $('#field_3257 select').change(function(){
            var surveyId = $(this).val();
            $.ajax({
               type:'GET',
               url: route()+'/survey/columns' ,
               data: {survey_id: surveyId},
               success: function(result){
                    $('#field_3259 select').html(result);
                    $('#field_3259 select').val('<?php echo e(@$model['select_column']); ?>');
               }
            });
        });
    });
</script>