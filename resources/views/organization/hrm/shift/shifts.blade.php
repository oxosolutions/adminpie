@extends('layouts.main')
@section('content')
	@if(@$data)
		@foreach($data as $key => $value)
			@php
				$model = [
						'name' 	=>	$value->name ,
						'from' 	=>	$value->from ,
						'to'	=>	$value->to,
						'working_days' => json_decode($value->working_days)
					];
			@endphp
		@endforeach
		<script type="text/javascript">
			window.onload = function(){
				$('#modal_edit').modal('open');
			}
		</script>
	@endif

@if(@$errors->has())
	<script type="text/javascript">
		window.onload = function(){
				$('#add_new_model').modal('open');
			}
	</script>
@endif

@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Shifts',
	'add_new' => '+ Add Shift'
); 
@endphp
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('common.list.datalist')
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
{!! Form::open(['route'=>'store.shifts' , 'class'=> 'form-horizontal','method' => 'post'])!!}
@include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Shift','button_title'=>'Save Shift','section'=>'addshiftsec1']])
{!!Form::close()!!}
@if(@$data)
	{!! Form::model($model,['route'=>'edit.shifts' , 'class'=> 'form-horizontal','method' => 'post'])!!}
	<input type="hidden" name="id" value="{{@$data[0]->id}}">
	<a href="#modal_edit" style="display: none" id="modal-edit"></a>
	@include('common.modal-onclick',['data'=>['modal_id'=>'modal_edit','heading'=>'Edit Shift','button_title'=>'update Shift','section'=>'addshiftsec1']])

	{!!Form::close()!!}
@endif

@include('common.page_content_secondry_end')
@include('common.pagecontentend')

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
		$('.fa-close').click(function(){
			location.reload();
		});
	});

		
	</script>
@endsection