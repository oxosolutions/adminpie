@extends('layouts.main')
@section('content')
@php
	$id = "";
@endphp
@if(@$data)
	@foreach(@$data as $key => $value)
		
		@php
			$data = ['name' => $value->name , 'category' => $value->category];
			$id = $value->id;
		@endphp
	@endforeach
	<script type="text/javascript">
		$(window).load(function(){
			document.getElementById('add_new').click();
		});
	</script>
@endif
<div class="fade-background">
</div>
<div id="projects" class="projects list-view">
	<div class="row">
		<div class="col s12 m9 l12 pr-7" >
			
			{{-- {!!global_draw_widget('cl')!!} --}}
			{{-- <div class="list" id="list"></div> --}}
			@include('common.list.datalist')
		</div>

		<div class="col s12 m3 l3 pl-7" >
			<a id="add_new" href="#modal1" class="btn add-new display-form-button" >
				Add Project
			</a>
			@if(@$data)
				{!! Form::model(@$data,['route'=>'update.project', 'class'=> 'form-horizontal','method' => 'post'])!!} 
				<input type="hidden" name="id" value="{{$id}}">
			@else
				{!! Form::open(['route'=>'save.project', 'class'=> 'form-horizontal','method' => 'post'])!!}
			@endif
			@include('common.modal-onclick',['data'=>['modal_id'=>'modal1','heading'=>'Add Projects','button_title'=>'Save','section'=>'prosec1']])
			{{-- <div id="modal1" class="modal">
				<div class="modal-header">
					<h5>Add Projects</h5>
				</div>
				<div class="modal-content">
					
				</div>
			
					
					{!!FormGenerator::GenerateSection('prosec1',['type' => 'inset'])!!}
					<div class="modal-footer">
				    	
				    	<button class="btn blue" type="submit">Save
							<i class="material-icons right">save</i>
						</button>
				    </div>
				
				  	
			</div> --}}
			{!!Form::close()!!}
			
			
		</div>
	</div>
</div>

<script type="text/javascript">
 $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
  });

</script>
	
@endsection