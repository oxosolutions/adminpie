<?php $__env->startSection('content'); ?>

<?php 
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => __('organization/datasets.dataset_filter_page_title_text').' <span>'.get_dataset_title(request()->route()->parameters()['id']).'</span>',
	'add_new' => '+ Add Role'
	); 
 ?>
<style type="text/css">

	.aione-box{
		border: 1px solid #e8e8e8;
	    padding: 10px	
	}
	.aione-box:after{
		content: '';
		display: table;
		clear: both;
	}
</style>
<?php echo $__env->make('common.pageheader',$page_title_data, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentstart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_primary_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('organization.dataset._tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo Form::open(['method'=>'GET']); ?>

		<div class="ar">
			<div class="ac l50">
				<div class="aione-border">
		            <div class="">
		                <h5 class="aione-align-center font-weight-400 m-0 pv-10 bg-grey bg-lighten-4 aione-border-bottom">
		                    <?php echo e(__('organization/datasets.vertical_filtration')); ?>

		                </h5>
		            </div>
		            <div class="p-15">
		            	<?php echo FormGenerator::GenerateSection('vertical_filtration'); ?>	
						<?php echo e(@Session::get('success')); ?>	
		            </div>
					
				</div>
				
			</div>		
			<div class="ac l50 ">
				<div class="aione-border">
				  	<div class="">
		                <h5 class="aione-align-center font-weight-400 m-0 pv-10 bg-grey bg-lighten-4 aione-border-bottom">
		                    <?php echo e(__('organization/datasets.horizontal_filtration')); ?>

		                </h5>
	            	</div>
	            	<div class="p-15">
	            		<?php echo FormGenerator::GenerateSection('horizontal_filtration',[],request()->all()); ?>	
	            	</div>
					
				</div>
			</div>
		</div>
	<div class="ar aione-float-right" style="margin: 14px 0px">
		<button class="aione-button" data-target="create-modal"><?php echo e(__('organization/datasets.create_subset_button_text')); ?></button>
			<?php if(!empty($errors->all())): ?>
				<?php if(@$errors->name): ?>
					<script type="text/javascript">
						window.onload = function(){
							$('#create-modal').modal('open');
						}
					</script>
				<?php endif; ?>
			<?php endif; ?>
		<button class="aione-button"><?php echo e(__('organization/datasets.apply_filters_button_text')); ?></button>
		<a class="aione-button" href="<?php echo e(route('filter.dataset',request()->id)); ?>" ><?php echo e(__('organization/datasets.reset_form_button_text')); ?></a>
		
	</div>
	<?php echo Form::close(); ?>

	
	<div class="ar">
		<?php if(!$records->isEmpty()): ?>
			<div class="ac l80" style="line-height: 48px">Showing <?php echo e($records->firstItem()); ?> to <?php echo e($records->lastItem()); ?> of total <?php echo e($records->total()); ?> records</div>
		<?php endif; ?>
	</div>
	
	<?php echo Form::open(['route'=>['create.dataset.subset',request()->id]]); ?>

		<input type="hidden" name="filter_data" value="<?php echo e(serialize(request()->all())); ?>" />
		<?php echo $__env->make('common.modal-onclick',['data'=>['modal_id'=>'create-modal','heading'=>__("organization/datasets.model_header"),'button_title'=>__("organization/datasets.proceed"),'section'=>'create_subset']], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo Form::close(); ?>

	<?php if(!$records->isEmpty()): ?>
	
	<div class="aione-table">
		<table class="compact">
			<thead>
				<tr>
					<?php $__currentLoopData = request()->select_column; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $header_key => $column_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<th><?php echo e($headers[$column_name]); ?></th>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record_key => $record_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<?php $__currentLoopData = $record_value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col_key => $col_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<td><?php echo e($col_val); ?></td>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div>
	<?php echo $records->appends(request()->input())->render(); ?>

	<?php endif; ?>
<?php echo $__env->make('common.page_content_primary_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_start', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.page_content_secondry_end', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.pagecontentend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>