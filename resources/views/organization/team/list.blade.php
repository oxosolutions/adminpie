@extends('layouts.main')
@section('content')
	@if($data)
		@php
			$id = "";
		@endphp
		@foreach($data as $key => $value)
			@php
				$replace = ['"','[',']'];
				$ids = str_replace($replace,'',$value->member_ids);
				$m_ids = explode(',',$ids);
				$member_ids = array_map('intval',$m_ids);
				$id = $value->id;
				$data = [
							'title' 		=> $value->title,
							'description'	=> $value->description,
							'member_ids' 	=> $member_ids
						];
			@endphp
		@endforeach
		<script type="text/javascript">
			$(window).load(function(){
				document.getElementById('add_new').click();
			});
		</script>
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
@include('common.page_content_primary_start')
@include('common.list.datalist')
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@if($data)
	{!!Form::model($data,['route'=>'edit.team','method'=>'POST'])!!}
	<input type="hidden" name="id" value="{{$id}}">
@else
	{!!Form::open(['route'=>'save.team'	,'method'=>'POST'])!!}
@endif	

@include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add New Team','button_title'=>'Save','section'=>'prosec2']])
{!!Form::close()!!}	
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection