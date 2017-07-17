
	{!!Form::model($model,['route'=>'save.organization.settings','method'=>'POST','files'=>true])!!}
		{!!FormGenerator::GenerateForm('orgset',['details'=>'You can change your organization settings like email, title and logo.','title'=>'Settings'])!!}
	{!!Form::close()!!}
