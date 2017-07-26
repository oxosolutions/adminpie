
@extends('layouts.main')
@section('content')
<div class="row">
	<div class="col-md-12">
	{!! Form::model($model, ['route'=>['edit.applicant',$model['id']], 'class'=> 'form-horizontal','method' => 'post'])!!}
			<div class="row">

				<div class="col-md-12 ">
					<div class="panel panel-flat">
						<input type="text" value="{{$id}}">
						<div class="panel-body">
							{!! FormGenerator::GenerateForm('appinfo',['type'=>'inset'])!!}
						</div>
					</div>
				</div>
			</div>
		{!!Form::close()!!}
	</div>
</div>
@endsection()