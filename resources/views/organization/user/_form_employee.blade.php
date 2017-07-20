<div class="row">
	<div class="row  aione-field-wrapper" style="margin-bottom: 0px">
		{!! Form::text('name',null , ['class'=>'no-margin-bottom aione-field','placeholder'=>'Name','required']) !!}
	</div>
	<div class="row  aione-field-wrapper" style="margin-bottom: 0px">
		{!! Form::text('email',null , ['class'=>'no-margin-bottom aione-field','placeholder'=>'Email','required']) !!}
	</div>
	<div class="row  aione-field-wrapper" style="margin-bottom: 0px">
		 {!!Form::select('role_id',App\Model\Organization\UsersRole::roles(),null,['class'=>'no-margin-bottom aione-field','placeholder'=>'Select Role'])!!}
	</div>
	<div class="row  aione-field-wrapper" style="margin-bottom: 0px">
		{!! Form::select('user_type[]',App\Model\Organization\UsersType::userTypes(),json_decode($model->user_type),["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Type ','multiple'])!!}
	</div>
	<div class="row">
		<button type="submit" class="btn blue">Update</button>
	</div>
	
</div>