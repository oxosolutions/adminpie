
<?php $__currentLoopData = $model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		
				<tr>
					<td style="width: 10%">
						<?php if($value->status == 0): ?>
							<input type="checkbox" class="filled-in todo-check" id="filled-in-box<?php echo e($value->id); ?>" checked="checked" />
						<label for="filled-in-box<?php echo e($value->id); ?>" style="vertical-align: middle"></label>
						<?php else: ?>
							<input type="checkbox" class="filled-in todo-check" id="filled-in-box<?php echo e($value->id); ?>"/>
							<label for="filled-in-box<?php echo e($value->id); ?>" style="vertical-align: middle"></label>
						<?php endif; ?>
							<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" class="shift_token" >
						<input type="hidden" name="_todo_id" value="<?php echo e($value->id); ?>" class="todo_id" >
					</td>
					<td style="width: 50%">
						<?php if($value->status == 0): ?>
							<span class=""  style="text-decoration: line-through;color:#d9d9d9" ><?php echo e($value->title); ?></span>
						<?php else: ?>
							<span class="project-name todo-name font-size-14 view-mode" ><?php echo e($value->title); ?></span>
							<div class="field-wrapper-text edit-mode">
								
								<div class="field field-type-text">
									<input class="text todo-name" id="input_password" name="password" type="text"  value="<?php echo e($value->title); ?>">
								</div><!-- field -->
							</div>
							
						<?php endif; ?>
					</td>
					<td style="width: 20%">
						<div class="view-mode">
							<div class="priority">
								<?php echo e($value->priority); ?>

							</div>	
						</div>
						<div class="field-wrapper-text edit-mode">
								
							<div class="field field-type-text">
								<select class="browser-default priority">
									<option value="Low">Low</option>
									<option value="High">High</option>
									<option value="Medium">Medium</option>
								</select>
							</div>
						</div>
						

					</td>
					<td style="width: 20%">
						<a href="javascript:;" class="edit-single"><i class="fa fa-pencil mr-5"></i>Edit</a>
						<a href="javascript:;" class="edit-mode green save-todo"><i class="fa fa-save mr-5 green"></i>Save</a>  |

						<a href="javascript:;" class="delete-todo"><i class="fa fa-trash mr-5 red" ></i><span class="red">Delete</span></a>
						

					</td>	
				</tr>
	
	
	<script type="text/javascript">
		 $(document).ready(function() {
		    $('select').material_select();
		  });
	</script>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>