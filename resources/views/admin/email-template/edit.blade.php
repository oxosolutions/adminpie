@extends('admin.layouts.main')
@section('content')


{!! Form::open(['route'=>'email.edit'])!!}
<ul> 
	<li><label for="">Language</label>{!! Form::select('language',['EN'=>'EN','FR'=>'FR'],NULL,['class'=>'','placeholder'=>'select Language'])!!}</li>
	<li><label for="">slug</label><input name="slug"  type="text"></li>
	<li><label for="">Content</label>
	<textarea name="template"  cols="60" rows="50"></textarea>
	</li>
	
</ul>
<input type="submit">

{!! Form::close()!!}

@endsection