
<?php $__env->startSection('content'); ?>
	
<?php if(@$data): ?>
	<?php $__currentLoopData = @$data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kay => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php 
			$model = [
						'title'			=>		$value->title,
						'description'	=>		$value->description,
						'from'			=>		$value->date_of_holiday
					];
		 ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<script type="text/javascript">
		$(window).load(function(){
			document.getElementById('add_new').click();
		});
	</script>
<?php endif; ?>
<div id="projects" class="projects list-view">
	<div class="row">
		<div class="col s12 m12 l3 offset-l9">
			
			<a id="add_new" href="#modal1" class="btn add-new display-form-button" >
				Add New Holiday
			</a>
			<div id="modal1" class="modal modal-fixed-footer">
					<?php if(@$data): ?>
						<?php echo Form::model($model , ['route'=>'edit.holiday' , 'class'=> 'form-horizontal','method' => 'post']); ?>

						<input type="hidden" name="id" value="<?php echo e(@$data[0]->id); ?>">
					<?php else: ?>
						<?php echo Form::open(['route'=>'store.holiday' , 'class'=> 'form-horizontal','method' => 'post']); ?>

					<?php endif; ?>
					<div class="modal-header">
				    	<h5 style="padding:0px 10px">Add shift</h5>
				    </div>
					<div class="modal-content" style="padding: 30px">
						
						<?php echo FormGenerator::GenerateSection('holidayadd',['type'=>'inset']); ?>

						
					</div>
					<div class="modal-footer">
						<button class="btn blue" type="submit" name="action">Save Holiday
								
						</button>
					</div>
				<?php echo Form::close(); ?>

			</div>
		
			

		</div>

	</div>
	<div class="row">
		<div class="col s12 m12 l12" >
			
			<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			 <a class="btn-floating fixed btn-large waves-effect waves-light red"><i class="fa fa-trash"></i></a>
		</div>

		
	</div>
</div>

        
<style type="text/css">

</style>
	<script type="text/javascript">
	$(document).ready(function(){
 			$('#modal1').modal(); 

		$(document).on('blur', '.edit-fields',function(e){
			e.preventDefault();
			var postedData = {};
			postedData['title'] 			= $(this).parents('.shadow').find('.holiday_name').text();
			postedData['date_of_holiday'] 	= $(this).parents('.shadow').find('.holiday_date').text().trim();
			postedData['id'] 				= $(this).parents('.shadow').find('.holiday_id').val();
			postedData['status'] 			= $(this).parents('.shadow').find('.switch > label > input').prop('checked');
			postedData['_token'] 			= $('.shadow').find('.holiday_token').val();

			$.ajax({
				url:route()+'/holiday/update',
				type:'POST',
				data:postedData,
				success: function(res){
					console.log('data sent successfull');
				}
			});
			$('.editable h5 ,.editable p').removeClass('edit-fields');
		});
		$(document).on('change', '.switch > label > input',function(e){
			var postedData = {};
			postedData['title'] 			= $(this).parents('.shadow').find('.holiday_name').text();
			postedData['date_of_holiday'] 	= $(this).parents('.shadow').find('.holiday_date').text().trim();
			postedData['id'] 				= $(this).parents('.shadow').find('.holiday_id').val();
			postedData['status'] 			= $(this).prop('checked');
			postedData['_token'] 			= $('.shadow').find('.holiday_token').val();

			$.ajax({
				url:route()+'/holiday/update',
				type:'POST',
				data:postedData,
				success: function(res){
					console.log('data sent successfull');
				}
			});
			$('.editable h5 ,.editable p').removeClass('edit-fields');
		});
		$('.editable h5 , .editable p').click(function(e){
			e.preventDefault();
			if (e.which == 13) {        
		        e.preventDefault();
		    }
			$(this).addClass('edit-fields');
		});
		
	});
		
		$(".datepicker").pickadate({
			selectMonths:true,
			selectYear:15,
			min: new Date(new Date().getFullYear(),new Date().getMonth()+1,new Date().getDate())
		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>