@extends('layouts.main')
@section('content')


{{Session::get('success')}}

@if(Session::has('success'))
<p class="alert">{{ Session::get('success') }}</p>
@endif

{{-- <div id="add_new_wrapper" class="add-new-wrapper light-blue darken-2 create-fields active" >
{!! Form::open(['route'=>'upload.attendance', "files"=>true , 'class'=> 'form-horizontal','method' => 'post'])!!}

		<div class="row no-margin-bottom ">
			<div class="col s12 m2 l3  input-field">
				{!!Form::text('title',null,['class' => 'validate','placeholder'=>'Enter Title','id'=>'attendence-title','style'=>'color:#fff'])!!}
				<label for="attendence-title">Enter title</label>

			</div>
			<div class="col s12 m2 l5 aione-field-wrapper file-field input-field">
				<div class="btn" style="margin-top: 0px">
			        <span>Choose File</span>
			        <input type="file" name="attendance_file" >
			    </div>
			    <div class="file-path-wrapper">
					{!!Form::text('file',null,['class' => 'file-path validate'])!!}
				</div>
			</div>
			
			<div class="col s12 m3 l4 aione-field-wrapper right-align">
				
					<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit" name="action" style="margin-top: 10px;">Upload Attendance
					<i class="material-icons right">save</i>
					</button>
			</div>
		</div>
	{!!Form::close()!!}
</div> --}}
<div class="row">
	{!! Form::open(['route'=>'upload.attendance', "files"=>true , 'class'=> 'form-horizontal','method' => 'post'])!!}
	<div class="row" style="padding:10px 0px">
		<div class="col l3" style="line-height: 30px">
			Enter title
		</div>
		<div class="col l9">
			{{-- <input type="text" name="" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px "> --}}
			{!!Form::text('title',null,['class' => 'aione-setting-field','id'=>'attendence-title','style'=>'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px'])!!}
		</div>
	</div>

	<div class="row pv-10" >
		<div class="col l3" style="line-height: 46px">
			Upload
		</div>
		<div class="col l9">
			<div class="file-field input-field" style="margin-top: 0px">
				<div class="btn">
					<span>Choose file</span>
					<input type="file" name="attendance_file">
				</div>
				<div class="file-path-wrapper">
					{{-- <input class="file-path validate" type="text"> --}}
					{!!Form::text('file',null,['class' => 'file-path validate'])!!}
				</div>
			</div>	
		</div>
	</div>
	<div  class="row">
		<button class="btn blue" type="submit" name="action" style="margin-top: 10px;">Upload Attendance
		<i class="material-icons right">save</i>
		</button>
	</div>
	{!!Form::close()!!}
</div>
<style type="text/css">
	
		.aione-setting-field:focus{
		border-bottom: 1px solid #a8a8a8 !important;
		box-shadow: none !important;
	}
</style>

@endsection