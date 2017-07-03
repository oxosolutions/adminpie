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
				<a id="add_new" href="#modal1" class="btn-flat waves-effect waves-light-blue" style="border: 1px solid #a8a8a8;">
					Add Designation
				</a>
				<div id="modal1" class="modal modal-fixed-footer">
				@if(@$newData == 'undefined' || @$newData == '' || @$newData == null)
					{!! Form::open(['route'=>'store.designation' , 'class'=> 'form-horizontal','method' => 'post']) !!}
				@else
					{!! Form::model(@$model,['route'=>'edit.designation' , 'class'=> 'form-horizontal','method' => 'post']) !!}
					<input type="hidden" name="id" value="{{$id}}">
				@endif
					<div class="modal-header white-text" style="background-color: rgb(2,136,209)">
				    	<div class="row" style="padding:15px 10px">
				    		<div class="col l7">
				    			<h5 style="margin:0px">Add designation</h5>	
				    		</div>
				    		<div class="col l5 right-align">
				    			<a href="javascript:;" class="closeDialog"><i class="fa fa-close"></i></a>
				    		</div>
				    			
				    	</div>
				    	
				    </div>
				    <div class="modal-content" style="background-color: white">
				    	
				    	{!!FormGenerator::GenerateField('designation',['type' => 'inset'])!!}
				    </div>
				    <div class="modal-footer">
				    	{{-- <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Save</a> --}}
				    	<button class="btn blue" type="submit">Save Designation
									<i class="material-icons right">save</i>
								</button>
				    </div>
				    {!!Form::close()!!}
				</div>
		<div class="col s12 m9 l12 pr-7" style="margin-top: 14px">
			
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
<style type="text/css">
	.closeDialog{
		color: #fff;
	}
</style>
@endsection