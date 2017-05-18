	<div class="form-group">
		<input type="hidden" name="project_id" value="{{$id}}">
		<input type="hidden" name="type" value="project_document">
		{!!Form::label('manager', 'Document:', ['class' => 'col-lg-3 control-label']);
		!!}
			<div class="col-lg-9">
			{!!Form::file('document',['class'=>'file-styled'])!!}
				
			</div>
	</div>
	