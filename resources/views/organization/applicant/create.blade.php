@extends('layouts.main')
@section('content')
<div class="row">
	<div class="col-md-12">
	{!! Form::open(['route'=>'applicant.create', 'class'=> 'form-horizontal','method' => 'post'])!!}
			<div class="row">
				<div class="col-md-12 ">
					<div class="panel panel-flat">

						<div class="panel-body">
							{!! FormGenerator::GenerateSection('appsec1',['type'=>'inset'])!!}
							<div class="text-right">
								<button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		{!!Form::close()!!}
	</div>
</div>

@endsection()