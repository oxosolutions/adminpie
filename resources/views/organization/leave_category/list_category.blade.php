@extends('layouts.main')
@section('content')
	
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Leave Category',
	'add_new' => '+ Add Leave Category'
); 
@endphp
@include('common.pageheader',$page_title_data) 
{!! Form::open(['route'=>'store.leaveCat' , 'class'=> 'form-horizontal','method' => 'post'])!!}

@include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Leave Category','button_title'=>'Save Leave','section'=>'leavecatsec1']])
{!!Form::close()!!}
@include('common.list.datalist')
<script type="text/javascript">
		$(document).on('change', '.switch > label > input',function(e){
			var postedData = {};
		
			postedData['id'] 				= $(this).parents('.shadow').find('.cat_id').val();
			postedData['status'] 			= $(this).prop('checked');
			postedData['_token'] 			= $('.shadow').find('.token').val();

			$.ajax({
				url:route()+'/leave/category_status',
				type:'POST',
				data:postedData,
				success: function(res){
					console.log('data sent successfull');
				}
			});
			
		});

</script>

@endsection