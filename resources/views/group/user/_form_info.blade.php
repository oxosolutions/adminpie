<div class="form-group">
{{-- <input type="hidden" name="project_id" value="{{$id}}"> --}}
<input type="hidden" name="type" value="project_info">
	{!!Form::label('des', 'Designation:', ['class' => 'col-lg-3 control-label']);
	!!}
		<div class="col-lg-9">
		{!!Form::select('project_type',['e-commerce'=>'E Commerence', 'portfolio'=>'portfolio'],null,['class' => 'form-control','placeholder'=>'Select Project type'])!!}
			
		</div>
	</div>
	<div class="form-group">
	{!!Form::label('dev_with', 'Role:', ['class' => 'col-lg-3 control-label']);
	!!}
		<div class="col-lg-9">
		{!!Form::select('develop_with',['core'=>'core', 'cms'=>'CMS', 'MVC'=>'MVC Framework'],null,['class' => 'form-control' ,'placeholder'=>'Select Develop With'])!!}
			
		</div>
	</div>
	<div class="form-group">
	{!!Form::label('language', 'Programming Language:', ['class' => 'col-lg-3 control-label']);
	!!}
		<div class="col-lg-9">
		{!!Form::select('Programming_Language',['dot_net'=>'.Net', 'php'=>'PHP'],null,['class' => 'form-control','placeholder'=>'Select Programming Language'])!!}
			
		</div>
	</div>
	<div class="form-group">
	{!!Form::label('dev_with', 'user type:', ['class' => 'col-lg-3 control-label']);
	!!}
		<div class="col-lg-9">
		{!!Form::select('develop_with',['core'=>'core', 'cms'=>'CMS', 'MVC'=>'MVC Framework'],null,['class' => 'form-control' ,'placeholder'=>'Select Develop With'])!!}
			
		</div>
	</div>
	<div class="form-group">
	{!!Form::label('framework', 'Framework list:', ['class' => 'col-lg-3 control-label']);
	!!}
		<div class="col-lg-9">
		{!!Form::select('framework',['zend'=>'zend', 'laravel'=>'laravel'],null,['class' => 'form-control' ,'placeholder'=>'Select Framework'])!!}
			
		</div>
	</div>
	<div class="form-group">
	{!!Form::label('cms', 'Cms list:', ['class' => 'col-lg-3 control-label']);
	!!}
		<div class="col-lg-9">
		{!!Form::select('cms',['worpress'=>'Word-press', 'shopify'=>'Shopify'],null,['class' => 'form-control' ,'placeholder'=>'Select Cms'])!!}
			
		</div>
</div>