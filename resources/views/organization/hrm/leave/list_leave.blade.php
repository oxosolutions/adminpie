@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Leaves',
	'add_new' => '+ Add Leave',
	'route' => 'leave.add'

); 
@endphp
@include('common.pageheader',$page_title_data) 
@if(Session::has('sucessful'))
	 <div class="aione-message success">
      {{Session::get('sucessful')}}   
   </div>
@endif

@if(!empty($error))
   <div class="aione-message warning">
      {{$error}}   
   </div>
   @endif
@if(Session::has('errorss'))
   @php
      $errorss = Session::get('errorss');
   @endphp
   @if(empty($errorss['from']) &&  empty($errorss['to']))
      @foreach($errorss as $key => $value)
            <div class="aione-message error" >  {{e($value)}} 
            </div>
      @endforeach
     {{--  {{dd($error)}} --}}
   @endif
   @if(!empty($errorss['from']))
      @foreach($errorss['from'] as $key => $value)
            <div class="aione-message error" >   {{e($value)}}
            </div>
      @endforeach
   @endif
   @if(!empty($errorss['to']))
      @foreach($errorss['to'] as $key => $value)
            <div class="aione-message error" >   {{e($value)}}
            </div>
      @endforeach
   @endif
@endif
@if($data)
{{-- {{dd($data['employee_id'])}}
 --}}	{{-- @foreach(@$data->toArray() as $key => $value) --}}
		@php
			$id = $data['id'];
			$model = ['leave_category_id'=>$data['leave_category_id'],'reason_of_leave' => $data['reason_of_leave'],'from' => $data['from'], 'to' => $data['to'] , 'employee_id' => $data['employee_id']];
		@endphp
	{{-- @endforeach --}}
	{{-- <script type="text/javascript">
		window.onload = function(){
			$('#add_new_model').modal('open');
		}
	</script> --}}
@endif	
@if($errors->any())
	<script type="text/javascript">
		window.onload = function(){
			$('#add_new_model').modal('open');
		}
	</script>
@endif
@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
	@if(@$model)
	{!! Form::model($model ,['route'=>'edit.leave' , 'class'=> 'form-horizontal','method' => 'post'])!!}
	<input type="hidden" name="id" value="{{$id}}">
	{!!FormGenerator::GenerateForm('add_leave_form',['type'=>'inset'],'','admin')!!}
	{{-- @include('common.modal-onclick',['data'=>['modal_id'=>'modal_edit','heading'=>'Edit Leave','button_title'=>'update Leave','form'=>'add_leave_form','model'=>$model]]) --}}
	{!! Form::submit() !!}
	{!!Form::close()!!}
@endif	
		@include('common.list.datalist')
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')


{{-- @include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add leave','button_title'=>'Save','form'=>'add_leave_form']]) --}}


	
	@include('common.page_content_secondry_end')
@include('common.pagecontentend')
<style type="text/css">
	
.picker__day--infocus {
    padding: 8px 0 !important;
}
.picker--focused .picker__day--selected, .picker__day--selected{
	border-radius: 0%;
}
</style>
<style type="text/css">
.add-new-wrapper{
	display:none;
	position: relative;
}
.add-new-wrapper.active{
	display:block;
}

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