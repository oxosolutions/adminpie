@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Departments',
	'add_new' => '+ Add Department'
); 
@endphp
	@if(@$errors->has())
		<script type="text/javascript">
			$(window).load(function(){
				$('.modal').modal('open');
				$('#modal-edit').modal({
					dismissible : true
				});
			});
		</script>
	@endif
	@if(@$data)
		@foreach(@$data as $key => $value)
			@php
				$model = ['name' => $value['name']];
			@endphp
		@endforeach
		<script type="text/javascript">
			$(window).load(function(){
				document.getElementById('modal-edit').click();
			});
		</script>
		
	@endif

@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
		@include('common.list.datalist')
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')
		{!! Form::open(['route'=>'store.department' , 'class'=> 'form-horizontal','method' => 'post'])!!}
			

		@include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Department','button_title'=>'Save Department','section'=>'adddepartment']])
		{!!Form::close()!!}
		@if(@$model)
			{!! Form::model($model ,['route'=>'edit.department' , 'class'=> 'form-horizontal','method' => 'post'])!!}
			<input type="hidden" name="id" value="{{$data[0]['id']}}">
			<a href="#modal_edit" style="display: none" id="modal-edit"></a>
			@include('common.modal-onclick',['data'=>['modal_id'=>'modal_edit','heading'=>'Edit Department','button_title'=>'update Department','section'=>'adddepartment']])
		{!!Form::close()!!}
		@endif
	@include('common.page_content_secondry_end')
@include('common.pagecontentend')

<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('blur', '.edit-fields',function(e){
			e.preventDefault();
			var postedData = {};
			postedData['name'] 			= $(this).parents('.shadow').find('.name').text();
			postedData['id'] 				= $(this).parents('.shadow').find('.id').val();
			postedData['status'] 			= $(this).parents('.shadow').find('.switch > label > input').prop('checked');
			postedData['_token'] 			= $('.shadow').find('._token').val();

			$.ajax({
				url:route()+'/department/update',
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
			postedData['name'] 			= $(this).parents('.shadow').find('.name').text();
			postedData['id'] 				= $(this).parents('.shadow').find('.id').val();
			postedData['status'] 			= $(this).prop('checked');
			postedData['_token'] 			= $('.shadow').find('._token').val();

			$.ajax({
				url:route()+'/department/update',
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