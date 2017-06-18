
<?php if(!empty($data)): ?>
	<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<div class="row hover-me" style="padding:14px;">
		<div class="row valign-wrapper">
			<div class="col s7">
				<div class="row valign-wrapper">
					<div class="col">
						<a href="" data-toggle="popover" title="<?php echo e($val->employ_info->name); ?>" data-content="TEST">
						<div class="blue white-text" style="text-align: center;width: 32px;line-height: 32px;">
							<?php echo e(ucwords(substr($val->employ_info->name, 0, 1))); ?>

						</div>
						</a>
					</div>
					<div class="col" style="padding-left: 10px">
						<div style="" class=""><span class="project-name name edit" id="<?php echo e($val->employ_info->id); ?>"> <?php echo e($val->employ_info->name); ?></span></div>
						<div class="options">
							<a href="" style="padding-right:10px">Edit</a>
							
							<a href="javascript:;" onclick="deleteAlert()" style="padding-right:10px;color: red">Delete</a>
						</div>
					</div>
				</div>

			</div>
			<div class="col s3 extra-option">
				<span><?php echo e($val->employee_id); ?></span>
			</div>
			<div class="col s2 right-align">
				<div class="switch">
				    <label>
						
							<?php if($val->status == '0'): ?>
								<input type="checkbox">
							<?php else: ?>
								<input type="checkbox" checked="checked">
							<?php endif; ?>
						
				      <span class="lever"></span>
				      
				    </label>
				  </div>
			</div>	
		</div>
	</div>
	<style type="text/css">
		.options{
			position: absolute;
			font-size: 14px;
			display: none;
			margin-top:-3px;
		}
		.hover-me:hover .options{
			display: block
		}
	</style>
	<script type="text/javascript">
		function deleteAlert(){
			swal({   
				title: "Are you sure?",   
				text: "You will not be able to recover this imaginary file!",   
				type: "warning",   
				showCancelButton: true,   
				confirmButtonColor: "#DD6B55",   
				confirmButtonText: "Yes, delete it!",   
				closeOnConfirm: false }, 
				function(){   
					swal("Deleted!", "Your imaginary file has been deleted.", "success");
				 });
		}
	</script>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>