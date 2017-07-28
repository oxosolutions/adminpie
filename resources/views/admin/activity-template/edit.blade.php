@extends('admin.layouts.main')
@section('content')


{!! Form::open(['route'=>'activity.edit'])!!}
@php
$use_for = $datas[0]['use_for'];
$slug = $datas[0]['slug'];
$language = $datas[0]['language'];
@endphp
<input type="hidden" name="use_for"  value="{{$use_for}}">
<ul>
	<li><label for="">Language</label>{!! Form::select('language',['EN'=>'EN','FR'=>'FR'],$language,['class'=>'','placeholder'=>'select Language'])!!}</li>
	<li><label for="">slug</label><input name="slug"  type="text" value="{{$slug}}"></li>



	@foreach($datas as $key =>$value)

		@if($value['type']=='self')
		<li><label for="">Self Content</label>
			<input name="template[{{$value->id}}][template]"  type="text" value="{{$value['template']}}">
			{{-- <input name="template[self][type]"  type="hidden" value="self"> --}}
		</li>
		@else
		<li>
			<ul>
				<li><h1>For Other </h1><br></li>
				<li><label for="">{{$value['gender'] }}Content</label>
				<input name="template[{{$value->id}}][template]" type="text" value="{{$value['template']}}">
				{{-- <input name="template[male][type]" value='other' type="hidden">
				<input name="template[male][gender]" value='male' type="hidden"> --}}
				</li>
				
			</ul>
		</li>
		@endif
	@endforeach
</ul>
<input type="submit">

{!! Form::close()!!}

@endsection