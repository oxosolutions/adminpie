
<?php $__env->startSection('content'); ?>
	<?php if(@$data): ?>
		<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php 
				$model = [
						'name' 	=>	$value->name ,
						'from' 	=>	$value->from ,
						'to'	=>	$value->to
					];
			 ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<script type="text/javascript">
			$(window).load(function(){
				document.getElementById('add_new').click();
			});
		</script>
	<?php endif; ?>


<div class="fade-background">
</div>
<div id="projects" class="projects list-view">
	<div class="row">
		<div class="col s12 m12 l3 offset-l9 ">
			<a id="add_new" href="#modal1" class="btn add-new display-form-button" >
				Add Shift
			</a>
			<div id="modal1" class="modal modal-fixed-footer">
				<?php if(@$data): ?>
					<?php echo Form::model($model,['route'=>'edit.shifts' , 'class'=> 'form-horizontal','method' => 'post']); ?>

					<input type="hidden" name="id" value="<?php echo e(@$data[0]->id); ?>">
				<?php else: ?>
					<?php echo Form::open(['route'=>'store.shifts' , 'class'=> 'form-horizontal','method' => 'post']); ?>

				<?php endif; ?>
					<div class="modal-header">
				    	<h5 style="padding:0px 10px">Add shift</h5>
				    </div>
					<div class="modal-content" style="padding: 30px">
						
						<?php echo FormGenerator::GenerateSection('addshiftsec1',['type'=>'inset']); ?>

						
					</div>
					<div class="modal-footer">
						<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit">Save Shift
							<i class="material-icons right">save</i>
						</button>
					</div>
				<?php echo Form::close(); ?>

			</div>
			
		</div>
	</div>
	<div class="row">
		<div class="col s12 m12 l12 " >
			
			<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>

		

	</div>
</div>


	<script type="text/javascript">
	$(document).ready(function(){


		 $('#modal1').modal(); 

		$(document).on('blur', '.edit-fields',function(e){
			e.preventDefault();
			var postedData = {};
			postedData['name'] 			= $(this).parents('.shadow').find('.shift_name').text();
			postedData['from'] 	= $(this).parents('.shadow').find('.shift_from').text().trim();
			postedData['to'] 	= $(this).parents('.shadow').find('.shift_to').text().trim();
			postedData['id'] 				= $(this).parents('.shadow').find('.shift_id').val();
			postedData['status'] 			= $(this).parents('.shadow').find('.switch > label > input').prop('checked');
			postedData['_token'] 			= $('.shadow').find('.shift_token').val();

			$.ajax({
				url:route()+'/shifts/update',
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
			postedData['name'] 			= $(this).parents('.shadow').find('.shift_name').text();
			postedData['from'] 	= $(this).parents('.shadow').find('.shift_from').text().trim();
			postedData['to'] 	= $(this).parents('.shadow').find('.shift_to').text().trim();
			postedData['id'] 				= $(this).parents('.shadow').find('.shift_id').val();
			postedData['status'] 			= $(this).prop('checked');
			postedData['_token'] 			= $('.shadow').find('.shift_token').val();

			$.ajax({
				url:route()+'/shifts/update',
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

		
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>