@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => __('organization/hrm.departments_list_page_title'),
	'add_new' => __('organization/hrm.department_list_page_add_department_button')
); 
@endphp
	@if(@$errors->has())
		<script type="text/javascript">
			window.onload = function(){
				$('#add_new_model').modal('open');
			}
		</script>
	@endif
	@if(@$data)
		@foreach(@$data as $key => $value)
			@php
				$model = ['name' => $value['name']];
			@endphp
		@endforeach
		<script type="text/javascript">
			window.onload = function(){
				$('#modal_edit').modal('open');
			}
			// $(document).ready(function(){
			// 	console.log('hello 2');
			// 	document.getElementById('modal-edit').click();
			// 	console.log('hello 3');
			// });
		</script>
		
	@endif

@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
		@include('common.list.datalist')
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')
		{!! Form::open(['route'=>'store.department' , 'class'=> 'form-horizontal','method' => 'post'])!!}
			

		@include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>__('organization/hrm.model_title_add_department'),'button_title'=>__('organization/hrm.save_department_btn'),'section'=>'adddepartment']])
		{!!Form::close()!!}
		@if(@$model)
			{!! Form::model($model ,['route'=>'edit.department' , 'class'=> 'form-horizontal','method' => 'post'])!!}
			<input type="hidden" name="id" value="{{$data[0]['id']}}">
			{{-- <a href="#modal_edit" style="display: none" id="modal-edit" data-target="modal_edit"></a> --}}
			@include('common.modal-onclick',['data'=>['modal_id'=>'modal_edit','heading'=>__('organization/hrm.model_title_edit_department'),'button_title'=>__('organization/hrm.update_department_btn'),'section'=>'adddepartment']])
		{!!Form::close()!!}
		@endif
	@include('common.page_content_secondry_end')
@include('common.pagecontentend')

<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('blur', '.edit-fields',function(e){
			e.preventDefault();
			var postedData = {};
			postedData['name'] 	 = $(this).parents('.shadow').find('.name').text();
			postedData['id'] 	 = $(this).parents('.shadow').find('.id').val();
			postedData['status'] = $(this).parents('.shadow').find('.switch > label > input').prop('checked');
			postedData['_token'] = $('.shadow').find('._token').val();

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
			postedData['name'] 	 = $(this).parents('.shadow').find('.name').text();
			postedData['id'] 	 = $(this).parents('.shadow').find('.id').val();
			postedData['status'] = $(this).prop('checked');
			postedData['_token'] = $('.shadow').find('._token').val();

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