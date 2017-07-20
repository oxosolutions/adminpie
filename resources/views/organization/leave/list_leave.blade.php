@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Leaves',
	'add_new' => '+ Add Leave'
); 
@endphp
@include('common.pageheader',$page_title_data) 

@if($data)
	@foreach(@$data as $key => $value)
		@php
			$id = $value->id;
			$model = ['name' => $value->name,'from' => $value->from, 'to' => $value->to , 'reason_of_leave' => $value->reason_of_leave, 'employee_id' => $value->employee_id , 'leave_category_id' => $value->leave_category_id];
		@endphp
	@endforeach
	<script type="text/javascript">
		$(window).load(function(){
			document.getElementById('modal-edit').click();
		});
	</script>
@endif	
@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
		@include('common.list.datalist')
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')
{!! Form::open(['route'=>'store.leave' , 'class'=> 'form-horizontal','method' => 'post'])!!}

@include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add leaves','button_title'=>'Save','section'=>'leavesection']])
{!!Form::close()!!}
@if(@$model)
	{!! Form::model($model ,['route'=>'edit.leave' , 'class'=> 'form-horizontal','method' => 'post'])!!}
	<input type="hidden" name="id" value="{{$id}}">
	<a href="#modal_edit" style="display: none" id="modal-edit"></a>
	@include('common.modal-onclick',['data'=>['modal_id'=>'modal_edit','heading'=>'Edit Leave','button_title'=>'update Leave','section'=>'leavesection']])
	{!!Form::close()!!}
@endif	
	
	@include('common.page_content_secondry_end')
@include('common.pagecontentend')
<style type="text/css">
.add-new-wrapper{
	display:none;
	position: relative;
}
.add-new-wrapper.active{
	display:block;
}
/*.add-new-wrapper:after{
    content: "";
    position: absolute;
    bottom: -16px;
    right: 100px;
    border-right: 12px solid transparent;
    border-left: 12px solid transparent;
    border-top: 16px solid #0288d1;
}*/
.modal-dialog{
	margin: 0px !important;
	width: 100%;
}
.modal .modal-content {
     padding: 0px; 
}
#modal1,#modal2{
	padding-right: 0px !important;
}
.modal-body{
	    padding-bottom: 12px;
}
.element-item{
	left: 1px !important;
	float: left;
	clear: both
}
.none{
	display: none
}
.list-view .project .project-detail{
    display:block;
}
[contenteditable]:focus{
	outline: 0px solid transparent;
}
.edit-fields{
	border:1px solid #e8e8e8;padding: 5px;
}
.shadow l4{
	min-width: 100%;
}
.close-model{
	    float: right;
    padding: 10px;
    margin-top: -50px;
    color: red;
    font-size: 22px
}
</style>

	<script type="text/javascript">
	$(document).ready(function(){

		
		$(document).on('blur', '.edit-fields',function(e){
			e.preventDefault();
			var postedData = {};
			postedData['name'] 			= $(this).parents('.shadow').find('.name').text();
			postedData['from'] 	= $(this).parents('.shadow').find('.from').text().trim();
			postedData['to'] 	= $(this).parents('.shadow').find('.to').text().trim();
			postedData['id'] 				= $(this).parents('.shadow').find('.id').val();
			postedData['status'] 			= $(this).parents('.shadow').find('.switch > label > input').prop('checked');
			postedData['_token'] 			= $('.shadow').find('._token').val();

			$.ajax({
				url:route()+'/leave/update',
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
			postedData['from'] 	= $(this).parents('.shadow').find('.from').text().trim();
			postedData['to'] 	= $(this).parents('.shadow').find('.to').text().trim();
			postedData['id'] 				= $(this).parents('.shadow').find('.shift_id').val();
			postedData['status'] 			= $(this).prop('checked');
			postedData['_token'] 			= $('.shadow').find('._token').val();

			$.ajax({
				url:route()+'/leave/update',
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
	/*$(".datepicker").pickadate({
			selectMonths:true,
			selectYear:15,
			min: new Date(new Date().getFullYear(),new Date().getMonth()+1,new Date().getDate())
		});*/
	$('.datepicker').on('open', function() {
	    $('.datepicker').appendTo('body');
	});

		
	</script>
@endsection