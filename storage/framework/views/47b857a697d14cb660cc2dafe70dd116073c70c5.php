<div class="row">
	<div class="row  aione-field-wrapper" style="margin-bottom: 0px">
		<?php echo Form::text('name',null , ['class'=>'no-margin-bottom aione-field','placeholder'=>'Name','required']); ?>

	</div>
	<div class="row  aione-field-wrapper" style="margin-bottom: 0px">
		<?php echo Form::text('email',null , ['class'=>'no-margin-bottom aione-field','placeholder'=>'Email','required']); ?>

	</div>
	<?php 
		$userRoles = $model->user_role_rel;
		if(!$userRoles->isEmpty()){
			$selectedRoles = $userRoles->groupBy('role_id')->toArray();
			$selectedRoles = @array_keys($selectedRoles);
		}
	 ?>
	<div class="row  aione-field-wrapper" style="margin-bottom: 0px">
		 <?php echo Form::select('role_id[]',App\Model\Organization\UsersRole::roles(),@$selectedRoles,['class'=>'no-margin-bottom aione-field','placeholder'=>'Select Role','multiple']); ?>

	</div>
	<div class="row">
		<button type="submit" class="btn blue">Update</button>
	</div>
	
</div>