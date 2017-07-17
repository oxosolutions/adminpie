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
<div id="projects" class="projects list-view">
	<div class="row">
		<div class="col s12 m12 l3 offset-l9">
			
			<a id="add_new" href="#modal1" class="btn add-new display-form-button" >
				Add New team
			</a>
			@if($data)
				{!!Form::model($data,['route'=>'edit.team','method'=>'POST'])!!}
				<input type="hidden" name="id" value="{{$id}}">
			@else
				{!!Form::open(['route'=>'save.team'	,'method'=>'POST'])!!}
			@endif	
		
			@include('common.modal-onclick',['data'=>['modal_id'=>'modal1','heading'=>'Add New Team','button_title'=>'Save','section'=>'prosec2']])
			{!!Form::close()!!}
	
			

		</div>

	</div>
	<div class="row">
		<div class="col s12 m12 l12" >
			
			@include('common.list.datalist')
		</div>

		
	</div>
</div>


@endsection