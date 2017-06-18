@extends('layouts.main')
@section('content')
	
<style type="text/css">

</style>
@if($data)
	@foreach(@$data as $key => $value)
		@php
			$id = $value->id;
			$model = ['name' => $value->name,'from' => $value->from, 'to' => $value->to , 'reason_of_leave' => $value->reason_of_leave, 'employee_id' => $value->employee_id , 'leave_category_id' => $value->leave_category_id];
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
		<div class="col l9">
			
		</div>
		
		<div class="col s12 m12 l3 pl-7">
			
			<a id="add_new" href="#modal1" class="btn add-new display-form-button" >
				Add Leave
			</a>
			<div id="modal1" class="modal modal-fixed-footer">
				@if(@$model)
					{!! Form::model($model ,['route'=>'edit.leave' , 'class'=> 'form-horizontal','method' => 'post'])!!}
					<input type="hidden" name="id" value="{{$id}}">
				@else
					{!! Form::open(['route'=>'store.leave' , 'class'=> 'form-horizontal','method' => 'post'])!!}
				@endif	
					<div class="modal-header">
				    	<h5 style="padding:0px 10px">Add leaves</h5>
				    	<a href="{{route('leaves')}}" class="close-model"><i class="fa fa-close"></i></a>
				    </div>
					<div class="modal-content" style="padding: 30px">
						{!!FormGenerator::GenerateSection('leavesection',['type'=>'inset'])!!}
					</div>
					<div class="modal-footer">
						<button class="btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit">Save leave
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
		

		 $('#modal1').modal({
		 	 dismissible: false
		 }); 
		 $('.close-model').click(function(){
		 	$('#modal1').modal('close');

		 });
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