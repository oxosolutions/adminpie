@extends('layouts.main')
@section('content')
	@if(@$data)
		@foreach($data as $key => $value)
			@php
				$model = [
						'name' 	=>	$value->name ,
						'from' 	=>	$value->from ,
						'to'	=>	$value->to
					];
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
		<div class="col s12 m12 l3 offset-l9 ">
			<a id="add_new" href="#modal1" class="btn add-new display-form-button" >
				Add Shift
			</a>
			<div id="modal1" class="modal modal-fixed-footer">
				@if(@$data)
					{!! Form::model($model,['route'=>'edit.shifts' , 'class'=> 'form-horizontal','method' => 'post'])!!}
					<input type="hidden" name="id" value="{{@$data[0]->id}}">
				@else
					{!! Form::open(['route'=>'store.shifts' , 'class'=> 'form-horizontal','method' => 'post'])!!}
				@endif
					<div class="modal-header white-text" style="background-color: rgb(2,136,209)">
						<div class="row" style="padding:15px 10px">
							<div class="col l7">
								<h5 style="margin:0px">Add Shift</h5>	
							</div>
							<div class="col l5 right-align">
								<a href="javascript:;" class="closeDialog" style="color: white"><i class="fa fa-close"></i></a>
							</div>
								
						</div>
						
					</div>
					<div class="modal-content" style="padding: 30px">
						
						{!!FormGenerator::GenerateSection('addshiftsec1',['type'=>'inset'])!!}
						
					</div>
					<div class="modal-footer">
						<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit">Save Shift
							<i class="material-icons right">save</i>
						</button>
					</div>
				{!!Form::close()!!}
			</div>
			
		</div>
	</div>
	<div class="row">
		<div class="col s12 m12 l12 " >
			
			@include('common.list.datalist')
		</div>

		

	</div>
</div>


	<script type="text/javascript">
	$(document).ready(function(){


		 $('#modal1').modal(); 

		$(document).on('blur', '.edit-fields',function(e){
			e.preventDefault();
			var postedData = {};
			postedData['name'] 			= $(this).parents('.shadow').find('.shift_name').text();
			postedData['from'] 	= $(this).parents('.shadow').find('.shift_from').text().trim();
			postedData['to'] 	= $(this).parents('.shadow').find('.shift_to').text().trim();
			postedData['id'] 				= $(this).parents('.shadow').find('.shift_id').val();
			postedData['status'] 			= $(this).parents('.shadow').find('.switch > label > input').prop('checked');
			postedData['_token'] 			= $('.shadow').find('.shift_token').val();

			$.ajax({
				url:route()+'/shifts/update',
				type:'POST',
				data:postedData,
				success: function(res){
					console.log('data sent successfull');
				}
			});
			$('.editable h5 ,.editable p').removeClass('edit-fields');
		});
		$(document).on('change', '.switch > label > input',function(e){
			var postedData = {};
			postedData['name'] 			= $(this).parents('.shadow').find('.shift_name').text();
			postedData['from'] 	= $(this).parents('.shadow').find('.shift_from').text().trim();
			postedData['to'] 	= $(this).parents('.shadow').find('.shift_to').text().trim();
			postedData['id'] 				= $(this).parents('.shadow').find('.shift_id').val();
			postedData['status'] 			= $(this).prop('checked');
			postedData['_token'] 			= $('.shadow').find('.shift_token').val();

			$.ajax({
				url:route()+'/shifts/update',
				type:'POST',
				data:postedData,
				success: function(res){
					console.log('data sent successfull');
				}
			});
			$('.editable h5 ,.editable p').removeClass('edit-fields');
		});
		$('.editable h5 , .editable p').click(function(e){
			e.preventDefault();
			if (e.which == 13) {        
		        e.preventDefault();
		    }
			$(this).addClass('edit-fields');
		});
		
	});

		
	</script>
@endsection