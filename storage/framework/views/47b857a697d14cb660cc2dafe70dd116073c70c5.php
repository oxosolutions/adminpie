<div class="row">
	<div class="row">
		<?php echo Form::text('name',null , ['placeholder'=>'Name','required']); ?>

	</div>
	<div class="row">
		<?php echo Form::text('email',null , ['placeholder'=>'Email','required']); ?>

	</div>
	<div class="row">
		 <?php echo Form::select('role_id',App\Model\Organization\UsersRole::roles(),null,['class'=>'no-margin-bottom aione-field','placeholder'=>'Select Role']); ?>

	</div>
	<div class="row">
		<?php echo Form::select('user_type[]',App\Model\Organization\UsersType::userTypes(),json_decode($model->user_type),["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Type ','multiple']); ?>

	</div>
	<div class="row">
		<button type="submit">Update</button>
	</div>
	
</div>