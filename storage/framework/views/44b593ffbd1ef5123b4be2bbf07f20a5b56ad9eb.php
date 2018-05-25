<?php $__env->startSection('content'); ?>
<?php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Add Leave',
	'add_new' => 'List Leave',
	'route' => 'leaves'

); 
?>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	

	 

<?php echo Form::open(['route'=>'store.employeeleave' , 'class'=> 'form-horizontal','method' => 'post']); ?>

               <input type="hidden" name="apply_by" value="hr">

<div id="field_187" data-conditions="0" data-field-type="select" class="field-wrapper ac field-wrapper-leave_category_id field-wrapper-type-select ">
	<div id="field_label_leave_category_id" class="field-label">
	<label for="input_leave_category_id"> 
		<h4 class="field-title" id="Employee's">Employee's</h4>
	</label>
	</div><!-- field label-->
	<div id="Employee's" class="field field-type-select">
	    <?php echo Form::select('employee',$employee_list,null,['class'=>'browser-default'] ); ?>

	</div><!-- field -->
</div>
           <?php echo FormGenerator::GenerateForm('account-leave-form'); ?>

           <?php echo Form::submit(); ?>

               
		<?php echo Form::close(); ?>



	
	<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<script type="text/javascript">
			 $(document).ready(function(){
     		 	$('#field_3241').hide(); //from
		      	$('#field_189').hide(); // to
		      	$('#field_3238').hide();//half type
		      	$('#field_3240').hide();// single date

		   })
		   $(document).on('change','#field_3232 select',function(){
		      console.log($(this).val());
		      if($(this).val() == 'half'){
		         $('#field_3241').show(); //from
		         $('#field_189').hide(); //189
		         $('#field_3238').show(); //half type
		         $('#field_3240').hide(); // single date
		         $('#field_3241').find('label > h4').text('Date');
		         
		      }
		      if($(this).val() == 'one_day'){
		          $('#field_3241').show();
		         $('#field_189').hide();
		         $('#field_3238').hide();
		         $('#field_3241').find('label > h4').text('Date');
		         
		         // $('#field_3240').show();
		      }
		      if($(this).val() == 'multi'){
		         $('#field_3241').show();
		         $('#field_189').show();
		         $('#field_3238').hide();
		         $('#field_3241').find('label > h4').text('From');;
		         
		         // $('#field_3240').hide();
		      }
		   })
		</script>
	<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>