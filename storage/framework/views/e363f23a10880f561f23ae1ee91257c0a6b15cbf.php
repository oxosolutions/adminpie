
<?php $__currentLoopData = $model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<div class="card-panel shadow white z-depth-1 hoverable project todo_list add-details">
		<div class="row valign-wrapper no-margin-bottom ">
			<div class="col l1 s2 center-align project-image-wrapper">
				<a href="" data-toggle="popover" title=" " data-content="TEST">
					<div class="defualt-logo"><?php echo e(ucfirst(mb_substr($value->title, 0, 1))); ?></div>
				</a>
			</div>
			<div class="col l11 s10 editable">
				<div class="row m-0 valign-wrapper">
					<div class="col s7 m7 l7">
						<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" class="shift_token" >
						<input type="hidden" name="_todo_id" value="<?php echo e($value->id); ?>" class="todo_id" >
						<a href="javascript:;" data-toggle="popover" title="Popover title" data-content="TEST" >
							<h5 class="project-title black-text flow-text truncate line-height-35">
								<?php if($value->status == 0): ?>
									<span class="project-name todo-name font-size-14"  style="text-decoration: line-through;color:#d9d9d9" ><?php echo e($value->title); ?></span>
								<?php else: ?>
									<span class="project-name todo-name font-size-14" ><?php echo e($value->title); ?></span>
								<?php endif; ?>
							</h5>
						</a>
					</div>

					<div class="col s3 m3 l3">
						<span class="blue white-text ph-10 priority-badge"><?php echo e($value->priority); ?></span>
						<span id="select-priority " class="edit-priority" style="display: none">
						<?php  $list_values = ['Low' => 'Low' ,'Medium' => 'Medium' ,'High' => 'High' ];  ?>
							<select >
								
								<?php $__currentLoopData = $list_values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option <?php echo e(($list == $value->priority)?"selected":""); ?> value="<?php echo e($key); ?>"><?php echo e($list); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						    </select>

						</span>
					</div>
					<div class="col s2 m2 l2 right-align">
						<p style="margin: 0px;">

							<span>
								<a href="javascript:;" class="delete-todo">
									<i class="fa fa-close" style="width: 18px;cursor:pointer;text-align: center;color: #888;font-size: 18px;margin-right: 8px;"></i>
								</a>
									
							</span>
							<span>
								<a href="javascript:;" class="edit-todo"><i class="fa fa-pencil" style="color: grey;margin-right: 10px"></i></a> 
							</span>
							<?php if($value->status == 0): ?>
								<input type="checkbox" class="filled-in todo-check" id="filled-in-box<?php echo e($value->id); ?>" checked="checked" />
							<label for="filled-in-box<?php echo e($value->id); ?>" style="vertical-align: middle"></label>
							<?php else: ?>
								<input type="checkbox" class="filled-in todo-check" id="filled-in-box<?php echo e($value->id); ?>"/>
								<label for="filled-in-box<?php echo e($value->id); ?>" style="vertical-align: middle"></label>
							<?php endif; ?>
							
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="todo-details" style="display: none;border-top: 1px solid #e8e8e8;margin-top: 12px">
			<div class="row" >
				<div class="col l1">
				</div>
				<div class="col l8 todo-desc" style="padding: 10px 0px 0px 0px">
					<?php echo e($value->description); ?>

				</div>
				<div class="col l3 right-align" style="margin-top: 10px">	
					<button class="waves-effect waves-teal btn-flat white-text blue save-todo" style="display: none" onclick="editTodo()">save</button>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		 $(document).ready(function() {
    $('select').material_select();
  });
	</script>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>