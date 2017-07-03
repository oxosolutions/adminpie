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
			<div id="modal1" class="modal modal-fixed-footer">
					
					<div class="modal-header white-text" style="background-color: rgb(2,136,209)">
						<div class="row" style="padding:15px 10px">
							<div class="col l7">
								<h5 style="margin:0px">Add New Team</h5>	
							</div>
							<div class="col l5 right-align">
								<a href="javascript:;" class="closeDialog" style="color: white"><i class="fa fa-close"></i></a>
							</div>
								
						</div>
						
					</div>
					@if($data)
						{!!Form::model($data,['route'=>'edit.team','method'=>'POST'])!!}
						<input type="hidden" name="id" value="{{$id}}">
					@else
						{!!Form::open(['route'=>'save.team','method'=>'POST'])!!}
					@endif	
						<div class="modal-content" style="padding: 30px">
							{!!FormGenerator::GenerateSection('prosec2',['type'=>'inset'])!!}
						</div>
						<div class="modal-footer">
							<button class="btn blue" type="submit" name="action">Save</button>
						</div>
					{!!Form::close()!!}
			</div>
	
			

		</div>

	</div>
	<div class="row">
		<div class="col s12 m12 l12" >
			
			@include('common.list.datalist')
		</div>

		
	</div>
</div>

        
<script type="text/javascript">
	$(document).ready(function(){
		$('#modal1').modal(); 
	});
</script>
@endsection