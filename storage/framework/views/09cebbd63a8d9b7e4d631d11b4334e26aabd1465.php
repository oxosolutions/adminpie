	<?php echo Form::model($model,['route'=>'save.organization.settings','method'=>'POST','files'=>true]); ?>

		<?php echo FormGenerator::GenerateForm('orgset',['details'=>'You can change your organization settings like email, title and logo.','title'=>'Settings'],$model); ?>

	<?php echo Form::close(); ?>