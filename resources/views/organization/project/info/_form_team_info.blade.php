	<div class="form-group">
		<input type="hidden" name="project_id" value="{{$id}}">
		<input type="hidden" name="type" value="project_info">
		{!!Form::label('manager', 'Project Manager:', ['class' => 'col-lg-3 control-label']);
		!!}
			<div class="col-lg-9">
			{!!Form::select('project_manager',['e-commerce'=>'E Commerence', 'portfolio'=>'portfolio'],null,['class' => 'form-control'])!!}
				
			</div>
	</div>
	<div class="form-group">
		{!!Form::label('language', 'Programming Lead:', ['class' => 'col-lg-3 control-label']);
		!!}
			<div class="col-lg-9">
			{!!Form::select('programming_lead',['dot_net'=>'.Net', 'php'=>'PHP'],null,['class' => 'form-control'])!!}
				
			</div>
	</div>
	<div class="form-group">
		{!!Form::label('dev_with', 'Developer Require:', ['class' => 'col-lg-3 control-label']);
		!!}
			<div class="col-lg-9">
			{!!Form::select('framework',['core'=>'core', 'cms'=>'CMS', 'MVC'=>'MVC Framework'],null,['class' => 'form-control'])!!}
				
			</div>
	</div>
	<div class="form-group">
		{!!Form::label('framework', 'Designer list:', ['class' => 'col-lg-3 control-label']);
		!!}
			<div class="col-lg-9">
			{!!Form::select('framework',['zend'=>'zend', 'laravel'=>'laravel'],null,['class' => 'form-control'])!!}
				
			</div>
	</div>
	<div class="form-group">
		{!!Form::label('framework', 'Tester Required:', ['class' => 'col-lg-3 control-label']);
		!!}
			<div class="col-lg-9">
			{!!Form::select('framework',['worpress'=>'Word-press', 'shopify'=>'Shopify'],null,['class' => 'form-control'])!!}
				
			</div>
	</div>