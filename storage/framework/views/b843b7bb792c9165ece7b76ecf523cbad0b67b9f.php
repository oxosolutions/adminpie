<?php $__env->startSection('content'); ?>
	
<div class="fade-background">
</div>
<div id="projects" class="projects list-view">
	<div class="row">
		<div class="col s12 m3 l3 offset-s9" >
			<a id="add_new" href="#modal1" class="btn add-new display-form-button" >
				Add Leave Category
			</a>
			<div id="modal1" class="modal modal-fixed-footer">
				<?php echo Form::open(['route'=>'store.leaveCat' , 'class'=> 'form-horizontal','method' => 'post']); ?>

					<div class="modal-header white-text" style="background-color: rgb(2,136,209)">
						<div class="row" style="padding:15px 10px">
							<div class="col l7">
								<h5 style="margin:0px">Add Leave Category</h5>	
							</div>
							<div class="col l5 right-align">
								<a href="javascript:;" class="closeDialog" style="color: white"><i class="fa fa-close"></i></a>
							</div>								
						</div>
					</div>
					<div class="modal-content" style="padding: 30px;background-color: white">
						
						<?php echo FormGenerator::GenerateSection('leavecatsec1',['type'=>'inset']); ?>

						
					</div>
					<div class="modal-footer">
						<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit">Save Leave Category
							<i class="material-icons right">save</i>
						</button>
					</div>
				<?php echo Form::close(); ?>

			</div>
			
			
		</div>
	</div>
	<div class="row">
		<div class="col s12 m9 l12 " >
			
			<?php echo $__env->make('common.list.datalist', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>

		
	</div>
</div>
<script type="text/javascript">
	
		
		 $('#modal1').modal(); 

		$(document).on('change', '.switch > label > input',function(e){
			var postedData = {};
			// postedData['title'] 			= $(this).parents('.shadow').find('.holiday_name').text();
			// postedData['date_of_holiday'] 	= $(this).parents('.shadow').find('.holiday_date').text().trim();
			postedData['id'] 				= $(this).parents('.shadow').find('.cat_id').val();
			postedData['status'] 			= $(this).prop('checked');
			postedData['_token'] 			= $('.shadow').find('.token').val();

			$.ajax({
				url:route()+'/leave/category_status',
				type:'POST',
				data:postedData,
				success: function(res){
					console.log('data sent successfull');
				}
			});
			// $('.editable h5 ,.editable p').removeClass('edit-fields');
		});

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>