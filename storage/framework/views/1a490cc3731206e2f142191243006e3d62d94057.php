
<?php $__env->startSection('content'); ?>
<?php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Add Pay Scale',
	'add_new' => 'List pay scale',
	'route' => 'list.payscale'
); 
?>	
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo Form::model(@$data['data'],['route'=>['edit.payscale' , $data["data"]->id] , 'class'=> 'form-horizontal','method' => 'post']); ?>

		<?php echo FormGenerator::GenerateForm('organization_hrm_payscale_form'); ?>

	<?php echo Form::close(); ?>

	<div class="ar">
		<div class="ac l50">
			<?php echo FormGenerator::GenerateForm('organization_hrm_payscale_earnings_form'); ?>

			<div class="aione-table">
				<table>
					<thead>
						<tr>
							<th>Allowances</th>
							<th>Amount</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>DA</td>
							<td>12000</td>
						</tr>
					</tbody>
				</table>
			</div>
				
		</div>
		<div class="ac l50">
			<?php echo FormGenerator::GenerateForm('organization_hrm_payscale_deductions_form'); ?>

		</div>
	</div>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<script type="text/javascript">
		$(document).ready(function(){
			var basic = $('.field-wrapper-basic_pay').find('input').val();
			$(document).on('keyup','.field-wrapper-percentage input',function(){
				console.log($(this).val());
				$(this).parent('.field-wrapper-percentage').next('.field-wrapper-amount').find('input').val('10');
			})
		})
	</script>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>