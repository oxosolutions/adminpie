@extends('layouts.main')
@section('content')

{{-- {{dd(json_decode($data->member_ids))}} --}}
	@if($data)

		@php
			$id = "";
		@endphp
			@php
				$replace = ['"','[',']'];
				$ids = str_replace($replace,'',$data->member_ids);
				$m_ids = explode(',',$ids);
				$member_ids = array_map('intval',$m_ids);
				$id = $data->id;
				$data = [
							'title' 		=> $data->title,
							'description'	=> $data->description,
							'member_ids' 	=> $member_ids
						];
			@endphp
	@endif
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Teams',
	'add_new' => '+ Add New Team' 
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
{{-- @include('common.page_content_primary_start') --}}
{{-- @include('common.list.datalist') --}}
{{-- @include('common.page_content_primary_end') --}}

{!!Form::model($data,['route'=>'edit.team','method'=>'POST'])!!}
	<input type="hidden" name="id" value="{{$id}}">
	{{-- {!!FormGenerator::GenerateSection('prosec2')!!} --}}
	{!! FormGenerator::GenerateForm('team') !!}
{!!Form::close()!!}	
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection