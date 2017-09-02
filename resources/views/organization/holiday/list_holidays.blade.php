@extends('layouts.main')
@section('content')
	@if(@$errors->has() || Session::has('date_error'))
		<script type="text/javascript">
			window.onload = function(){
				$('#add_new_model').modal('open');
			}
		</script>
	@endif
@if(@$data)
	@foreach(@$data as $kay => $value)
		@php
			$model = [
						'title'			=>		$value->title,
						'description'	=>		$value->description,
						'date_of_holiday'=>		$value->date_of_holiday
					];
		@endphp
	@endforeach
	<script type="text/javascript">
		window.onload = function(){
			$('#modal_edit').modal('open');
		}
	</script>
@endif
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Holidays',
	'add_new' => '+ Add Holiday'
); 
@endphp
@include('common.pageheader',$page_title_data) 	
@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
	@include('common.list.datalist')
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')

		{!! Form::open(['route'=>'store.holiday' , 'class'=> 'form-horizontal','method' => 'post'])!!}
			@include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add New Holiday','button_title'=>'Save Holiday','section'=>'holidayadd']])
		{!!Form::close()!!}
		@if(@$data)
			{!! Form::model($model , ['route'=>'edit.holiday' , 'class'=> 'form-horizontal','method' => 'post'])!!}
				<input type="hidden" name="id" value="{{@$data[0]->id}}">
				<a href="#modal_edit" style="display: none" id="modal-edit"></a>
				@include('common.modal-onclick',['data'=>['modal_id'=>'modal_edit','heading'=>'Edit Holiday','button_title'=>'update Holiday','section'=>'holidayadd']])
			{!!Form::close()!!}
		@endif
	@include('common.page_content_secondry_end')
@include('common.pagecontentend')


<script type="text/javascript">
	$(document).ready(function(){
 		

		$(document).on('blur', '.edit-fields',function(e){
			e.preventDefault();
			var postedData = {};
			postedData['title'] 			= $(this).parents('.shadow').find('.holiday_name').text();
			postedData['date_of_holiday'] 	= $(this).parents('.shadow').find('.holiday_date').text().trim();
			postedData['id'] 				= $(this).parents('.shadow').find('.holiday_id').val();
			postedData['status'] 			= $(this).parents('.shadow').find('.switch > label > input').prop('checked');
			postedData['_token'] 			= $('.shadow').find('.holiday_token').val();

			$.ajax({
				url:route()+'/holiday/update',
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
			postedData['title'] 			= $(this).parents('.shadow').find('.holiday_name').text();
			postedData['date_of_holiday'] 	= $(this).parents('.shadow').find('.holiday_date').text().trim();
			postedData['id'] 				= $(this).parents('.shadow').find('.holiday_id').val();
			postedData['status'] 			= $(this).prop('checked');
			postedData['_token'] 			= $('.shadow').find('.holiday_token').val();

			$.ajax({
				url:route()+'/holiday/update',
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
		
		$(".datepicker").pickadate({
			selectMonths:true,
			selectYear:15,
			min: new Date(new Date().getFullYear(),new Date().getMonth()+1,new Date().getDate())
		});
	</script>
@endsection