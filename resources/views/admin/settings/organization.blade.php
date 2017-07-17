@extends('admin.layouts.main')
@section('content')
@include('admin.settings._tabs')
	{!!Form::open(['route'=>'save.organizationSettings','method'=>'POST'])!!}
		<div class="col l3" style="line-height: 30px">
			Primary Organization
		</div>
		<div class="col l9">
			@php
				$organizationListArray = App\Model\Admin\GlobalOrganization::organizationsList()->toArray();
				$organizationListArray[0] = 'Default';
			@endphp
			{!! Form::select('primary_organization',$organizationListArray,$model,['placeholder'=>'Select Primary Organization'])!!}
		</div>
		<input type="hidden" name="key" value="primary_organization">
		<button type="submit" class="btn blue">Save</button>
	{!!Form::close()!!}
@endsection