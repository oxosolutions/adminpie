
<?php $__env->startSection('content'); ?>
<?php 
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => __('organization/datasets.dataset_structure_page_title_text').' <span>'.get_dataset_title(request()->route()->parameters()['id']).'</span>',
	'add_new' => '+ Add Role'
	); 
 ?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('organization.dataset._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <input type="hidden" value="<?php echo e(json_encode($columns->toArray())); ?>" class="columns_json" /> 
    
    <div class="mb-20 add-column">
    	<div class="aione-border">
            <div class="bg-grey bg-lighten-3 aione-border-bottom p-15 font-size-17  ">
			
	           <?php echo e(__('organization/datasets.create_column')); ?> 
	        </div>
	        <div class="aione-item-content">
	            <?php echo Form::open(['route'=>['create.column',request()->route()->parameters()['id']]]); ?>

	                <?php echo Form::hidden('completed_formula',null,['class'=>'completed_formula']); ?>

	                <?php echo FormGenerator::GenerateForm('create_column_dataset'); ?>

	                <div class="formula-builder">
	                	
	                		<span class="">
                                <select class="browser-default select2-structure-dataset selected_formula" placeholder="Select Formula">
                                    <option value="">Select Formula</option>
                                    <option value="SUM">SUM</option>
                                    <option value="CONCATENATE">CONCATENATE</option>
                                </select>
                            </span>(<span class="repeater_div "></span>)
	                	<a class="aione-button aione-float-right add_column" href="javascript:;">+</a>
	                </div>
	                <button><?php echo e(__('organization/datasets.create_column_button_text')); ?></button>
	            
	            <?php echo Form::close(); ?>      
	        </div>
		</div>
    </div>
	<?php echo Form::open(['route'=>['define.dataset',request()->id]]); ?>

    	<div class="aione-border">
            <div class="bg-grey bg-lighten-3 aione-border-bottom p-15 font-size-17  ">
                <?php echo e(__('organization/datasets.define_dataset')); ?>

            </div>
            <div class="">
                <div class="aione-table">
                    <table class="compact">
                        <thead>
                            <tr>
                                <td><?php echo e(__('organization/datasets.column_name')); ?></td>
                                <td><?php echo e(__('organization/datasets.edit_header')); ?></td>
                                <td><?php echo e(__('organization/datasets.column_type')); ?></td>
                                <td><?php echo e(__('organization/datasets.action')); ?></td>
                                
                            </tr>
                        </thead>
                        <tbody>
                             <?php $__currentLoopData = $columns->toArray(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $columnName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td width="300"><?php echo e($columnName); ?></td>
                                    <td width="300">
                                        <div class="field field-type-text">
                                            <input type="text" name="header[<?php echo e($key); ?>]" value="<?php echo e($columnName); ?>" class="browser-default" />
                                        </div>
                                    </td>
                                    <td>
                                    <?php echo Form::select($key,
                                            [   
                                            "/^[\s\S]*$/" =>   'Text',
                                            "/^[a-zA-Z ]*$/" =>   'String(Only Alphabets)',
                                            '/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26]php)00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/' =>  'Date',
                                            '/^[0-9]*$/'                    =>  'Number',
                                            '/^[0-9]+(\.[0-9]{1,5})?$/'     =>  'Integer',
                                            '/^\d*[02468]$/'                =>  'Even Number',
                                            '/^\d*[13579]$/'                =>  'Odd Number',
                                            '/^\d{10}$/'                    =>  'Mobile Number(10 Digit Only)',
                                            '/([A-Z0-9])/'                  =>  'AlphaNumeric'
                                            //'area_code'                    =>  'Area Code'
                                            ],@$defined[$key],['class'=>'browser-default']); ?>     
                                    <!--  Code BY : Amrit END-->    

                                    </td>
                                    <td>
                                    	<a href="<?php echo e(route('delete.column',[request()->route()->id ,$key])); ?>"><i class="fa fa-trash" style="color: red"></i></a>
                                    	<a href="#" class="go-to-form"><?php echo e(__('organization/datasets.add_column_here')); ?></a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>       
                        </tbody>
                    </table>
                </div>
            </div>
            <button class="mt-20" type="submit">Save</button>
        </div>
    <?php echo Form::close(); ?>

<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<style type="text/css">
		#field_3091,#field_3092, #field_3093, #field_3094, #field_3095,#field_3096,.add-column,.formula-builder{
            display: none;
        }
        .formula-builder{
        	border: 2px dashed #e8e8e8;
        	background: #f9f9f9;
        	min-height: 60px;
        	margin: 10px;
        	font-size: 20px;
        	padding: 15px;
        }
        .select2-structure-dataset{
        	margin: 0 10px;
        	position: relative;
        }
        .select2-container{
        	width: 10% !important
        }
        .column_span{
            position: relative;
            /*margin-bottom: 20px;*/
            padding: 20px 10px;
        }
        .column_span .delete-icon{
            position: absolute;
                top: 0px;
    right: 10px;
    display: none;
    cursor: pointer;
        }
        .column_span:hover .delete-icon{
            display: block
        }
 	</style>
	<script type="text/javascript">
		$('#field_3090 input').click(function(){
            if($(this).val() == 'static_value'){
                $('#field_3091').show();
                $('#field_3092, #field_3093, #field_3094, #field_3095, #field_3096').hide();
            }else if($(this).val() == 'value_with_refrence'){
                $('#field_3091, #field_3096').hide();
                $('#field_3092, #field_3093, #field_3094, #field_3095').show();
            }else if($(this).val() == 'formula'){
                $('#field_3096,.formula-builder').show();
                $('#field_3092, #field_3093, #field_3094, #field_3095').hide();
            }
        });
        // dataset/columns
        $('#field_3093 select').change(function(){
            $.ajax({
                type:'GET',
                url: route()+'/dataset/columns',
                data: {dataset:$(this).val()},
                success: function(result){
                    $('#field_3094 select').html(result);
                    $('#field_3095 select').html(result);
                }
            });
        });

        $('.selected_formula').change(function(){
            var formulaSelected = $(this).val();
            var columnsOptions = '<option value="">Select Column</option>';
            var columnsJson = JSON.parse($('.columns_json').val());
            $.each(columnsJson, function(key,value){
                columnsOptions += '<option value="'+key+'">'+value+'</option>';
            });
            switch(formulaSelected){
               default:
                    window.htmlContent = `<span class="column_span">
                                            <select name="selected_columns[]" class="browser-default select2-structure-dataset columns_dropdown">
                                                `+columnsOptions+`
                                            </select>
                                            <div class="comma display-inline"></div>
                                            <span class="delete-icon"><i class="fa fa-trash"></i></span>
                                        </span>`;
            }
            $('.repeater_div').html(htmlContent);
            setTimeout(function(){
                $('.select2-structure-dataset').select2();
            },10)
        });
        $('.add_column').click(function(){
            $('.columns_dropdown:last').parent('span').find('.comma').html(',');
            $('.repeater_div').append(htmlContent);
            $('.select2-structure-dataset').select2();
            var columnsLength = $('.columns_dropdown').length;
            // console.log(columnsLength);
        });

        $('body').on('change','.columns_dropdown', function(){
            var formulaSelected = $('.selected_formula').val();
            var completedFormula = '';
            var columnsArray = [];
            $('.columns_dropdown').each(function(){
                columnsArray.push($(this).children('option:selected').text());
            });
            switch(formulaSelected){
                default:
                    completedFormula = formulaSelected+'('+columnsArray.join(',')+')';
            }
            $('.completed_formula').val(completedFormula);
        });

        $(".go-to-form").on("click", function() {

        	$('.add-column').show();
		   
		});
	</script>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>