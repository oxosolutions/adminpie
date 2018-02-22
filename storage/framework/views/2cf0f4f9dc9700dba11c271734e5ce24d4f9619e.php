<?php $__env->startSection('content'); ?>

<?php 

	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Import Dataset',
	'add_new' => 'All Datasets',
	'route' => 'list.dataset'
	); 
 ?>

<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
		<?php echo Form::open(['route'=>'upload.dataset','files'=>true]); ?>

		<?php echo FormGenerator::GenerateForm('import_dataset_form'); ?>

		<?php echo Form::close(); ?>

	<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
     
    <?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<style type="text/css">
		.aione-setting-field:focus{
		border-bottom: 1px solid #a8a8a8 !important;
		box-shadow: none !important;
	}
	textarea{
		border-bottom: 1px solid #a8a8a8 !important;
		box-shadow: none !important;
	}
	.btn{
		background-color: #0288D1;
	}
	.select-dropdown{
		margin-bottom: 0px !important;
	    border: 1px solid #a8a8a8 !important;
	    
	}
	.select-wrapper input.select-dropdown{
		height: 30px;
    	line-height: 30px;
	}
	.file-path{
		margin-bottom: 0px !important
	}
	.mb-10{
		margin-bottom:15px !important; 
	}
	</style>
	<script type="text/javascript">
		$(".url,.file_on_server,.import_from_survey").hide();
		$(document).ready(function(){
		    $('input[type="radio"]').click(function(){
		        var inputValue = $(this).attr("value");
		        if(inputValue == 'import_from_survey'){
		        	$(".box2").hide();
		        }else{
		        	$(".box2").show();
		        }
		        var targetBox = $("." + inputValue);
		        $(".box").not(targetBox).hide();
		        $(targetBox).show();
		    });
		    $('.action_type').change(function(){
		    	if($(this).val() == 'append' || $(this).val() == 'replace'){
		    		$('.datasets_list').prop('disabled',false);
		    		$('select').material_select();
		    	}else{
		    		$('.datasets_list').prop('disabled',true);
		    		$('select').material_select();
		    	}
		    });

            $('#field_3178').css('display','none');
            $('input[name=import_source]').click(function(){
                if($(this).val() == 'from_survey' || $(this).val() == 'google' || $(this).val() == 'from_api'){
                    $('#field_3178').show();
                    $('input[name=data_type]').each(function(){
                        if($(this).val() == 'static'){
                            $(this).prop('checked',true);
                        } 
                    });
                }else{
                    $('#field_3178').hide();
                }
            });
		});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>