
@extends('layouts.main')
@section('content')
<div class="row">
	<div class="col-md-12">
	{!! Form::model($model, ['route'=>['opening.update',$model['id']], 'class'=> 'form-horizontal','method' => 'post','files'=>true])!!}
			<div class="row">
				<div class="col-md-12 ">
					<div class="panel panel-flat">

						<div class="panel-body">
							{!! FormGenerator::GenerateSection('opening',['type'=>'inset'])!!}
							<div class="text-right">
								<button type="submit" class="btn btn-primary">Update Opening <i class="icon-arrow-right14 position-right"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		{!!Form::close()!!}
	</div>
</div>
@endsection()