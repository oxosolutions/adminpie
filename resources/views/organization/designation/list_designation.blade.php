@extends('layouts.main')
@section('content')
	@php
	$id = "";
		if(@$data){
			foreach(@$data as $k => $v){
				$newData = $v->name;
				$id = $v->id;
			}
		}
		@$model = ['name' => @$newData];
	@endphp	
<div class="fade-background">
</div>

<div id="projects" class="projects list-view">
	<div class="row">
		<div class="col l9">
			
		</div>
		<div class="col l3">

			<a id="add_new" href="#modal1" class="btn add-new display-form-button" >
				Add Designation
			</a>
			<div id="modal1" class="modal modal-fixed-footer">
			@if(@$newData == 'undefined' || @$newData == '' || @$newData == null)
				{!! Form::open(['route'=>'store.designation' , 'class'=> 'form-horizontal','method' => 'post']) !!}
			@else
				{!! Form::model(@$model,['route'=>'edit.designation' , 'class'=> 'form-horizontal','method' => 'post']) !!}
				<input type="hidden" name="id" value="{{$id}}">
			@endif
				<div class="modal-header">
			    	<h5>Add designation</h5>
			    </div>
			    <div class="modal-content">
			    	
			    	{!!FormGenerator::GenerateField('designation',['type' => 'inset'])!!}
			    </div>
			    <div class="modal-footer">
			    	{{-- <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Save</a> --}}
			    	<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit">Save Designation
								<i class="material-icons right">save</i>
							</button>
			    </div>
			    {!!Form::close()!!}
			</div>
			<div id="add_new_wrapper" class="add-new-wrapper add-form ">
				

					{{-- <div class="row no-margin-bottom"> --}}
						{{-- {!!FormGenerator::GenerateField('designation',['type' => 'inset'])!!} --}}
						{{-- <div class="col s12 m2 l12 aione-field-wrapper">
							<input name="name" class="no-margin-bottom aione-field" type="text" placeholder="Designation Title" />
						</div> --}}
						
						{{-- <div class="col s12 m6 l12 aione-field-wrapper">
							<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit">Save Designation
								<i class="material-icons right">save</i>
							</button>
						</div>
					</div> --}}
					{{--  <div id="modal1" class="modal">
					    <div class="modal-content">
					      <h4>Modal Header</h4>
					      <p>A bunch of text</p>
					    </div>
					    <div class="modal-footer">
					      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
					    </div>
					  </div> --}}
				

			</div>	
		</div>
		
	</div>
	<div class="row">
		<div class="col s12 m9 l12 pr-7" >
			
			@include('common.list.datalist')
		</div>

		<div class="col s12 m3 l3 pl-7" >
			
			
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
	    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
	  $('#modal1').modal();

	 if($('input[name=name]').val() != ''){
	 	$('.display-form-button').click();
	 }
  });
</script>
@endsection