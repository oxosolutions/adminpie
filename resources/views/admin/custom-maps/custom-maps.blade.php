@if(Auth::guard('admin')->check() == true)
	@php
		$layout = 'admin.layouts.main';
	@endphp
@else
	@php
		$layout = 'layouts.main';
	@endphp
@endif
@extends($layout)
{{-- @extends('admin.layouts.main') --}}
@section('content')
@php
	$link=$_SERVER['REQUEST_URI']; 
 	$url =explode('/',$link);
	$url = end($url);
		
@endphp
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Maps',
	'route' => 'add.map'
);
if(Auth::guard('admin')->check() != true){
	if($url != 'g'){
		$page_title_data['add_new'] = '+ Add Map';
		// $page_title_data['route'] = 'add.map';
	}
}else{
	$page_title_data['add_new'] = '+ Add Map';
}

@endphp
@include('common.pageheader',$page_title_data) 
@if(!Auth::guard('admin')->check())

@endif
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	@include('common.list.datalist')
	
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
	{{-- @if(!Auth::guard('admin')->check())
		{!!Form::open(['route'=>'org.save.custom.map'])!!}
	@else
		{!!Form::open(['route'=>'save.custom.map'])!!}
	@endif
		@include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Custom Map','button_title'=>'Save','section'=>'custommapsection']])
		<input type="hidden" name="type" value="{{$url}}">
	{!!Form::close()!!} --}}
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection