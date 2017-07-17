@extends('layouts.main')
@section('content')
<div class="row">
	<a href="#modal1" class="btn blue">add category</a>
	{!!Form::open(['route'=>'save.category','method'=>'POST'])!!}
	@include('common.modal-onclick',['data'=>['modal_id'=>'modal1','heading'=>'Add Category','button_title'=>'Save','section'=>'prosec5']])
	{!!Form::close()!!}	
</div>

@include('common.list.datalist')
@endsection