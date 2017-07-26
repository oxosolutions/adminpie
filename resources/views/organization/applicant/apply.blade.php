@extends('layouts.main')
@section('content')
		<h1>Apply Form</h1>
		<div class="row">
	<div class="col-md-12">
	{!! Form::open(['route'=>['apply'], 'class'=> 'form-horizontal','method' => 'post'])!!}
			<div class="row">
				<div class="col-md-12 ">
					<div class="panel panel-flat">
						<input name="opening_id" type="hidden" value="{{$id}}">

						<div class="panel-body">
							<section>
								<h3>Applicant Sign Up</h3>
								<ul>
									<li>Name<input name="name" type="text" ></li>
								
									<li>Email<input name="email" type="text" ></li>
									<li>Password <input name="password" type="text" ></li>
								</ul>
								
								

							</section>

							{!! FormGenerator::GenerateForm('appinfo',['type'=>'inset'])!!}
						</div>
					</div>
				</div>
			</div>
		{!!Form::close()!!}
	</div>
</div>
@endsection()