	<div class="form-group">
		<input type="hidden" name="project_id" value="<?php echo e($id); ?>">
		<input type="hidden" name="type" value="project_document">
		<?php echo Form::label('manager', 'Document:', ['class' => 'col-lg-3 control-label']);; ?>

			<div class="col-lg-9">
			<?php echo Form::file('document',['class'=>'file-styled']); ?>

				
			</div>
	</div>
	