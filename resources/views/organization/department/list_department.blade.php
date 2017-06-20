@extends('layouts.main')
@section('content')
	@if(@$data)
		@foreach(@$data as $key => $value)
			@php
				$model = ['name' => $value['name']];
			@endphp
		@endforeach
	@endif
<div class="fade-background">
</div>

<div id="projects" class="projects list-view">
	<div class="row">
		<div class="col l9">
			
		</div>
		<div class="col l3">
			<a id="add_new" href="#modal1" class="btn add-new display-form-button" >
				Add Department
			</a>
			<div id="modal1" class="modal">
			@if(@$model)
				{!! Form::model($model ,['route'=>'edit.department' , 'class'=> 'form-horizontal','method' => 'post'])!!}
				<input type="hidden" name="id" value="{{$data[0]['id']}}">
			@else
				{!! Form::open(['route'=>'store.department' , 'class'=> 'form-horizontal','method' => 'post'])!!}
			@endif	
					<div class="modal-header white-text" style="background-color: rgb(2,136,209)">
						<div class="row" style="padding:15px 10px">
							<div class="col l7">
								<h5 style="margin:0px">Add Department</h5>	
							</div>
							<div class="col l5 right-align">
								<a href="javascript:;" class="closeDialog" style="color: white"><i class="fa fa-close"></i></a>
							</div>
								
						</div>
						
					</div>
					<div class="modal-content" style="background-color: white">
						
						{!!FormGenerator::GenerateField('departmentadd',['type' => 'inset'])!!}
					</div>
					<div class="modal-footer">
						<button class="ml-4 btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit">Save Department
							<i class="material-icons right">save</i>
						</button>
					</div>
				{!!Form::close()!!}
			</div>

{{-- 
			<div id="add_new_wrapper" class="add-new-wrapper  add-form">
				{!! Form::open(['route'=>'store.department' , 'class'=> 'form-horizontal','method' => 'post'])!!}

					<div class="row no-margin-bottom">
						<div class="col s12 m2 l12 aione-field-wrapper">
							{!!FormGenerator::GenerateField('departmentadd',['type' => 'inset'])!!}
							<input name="name" class="no-margin-bottom aione-field" type="text" placeholder="Department Title" />
						</div>
						

						<div class="col s12 m3 l12 aione-field-wrapper">
							<button class="ml-4 btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit">Save Department
								<i class="material-icons right">save</i>
							</button>
						</div>
					</div>
				{!!Form::close()!!}
			</div>
 --}}
		</div>
		
			
	</div>
	<div class="row">
		<div class="col s12 m12 l12 " >
				
			<div class="row">
				@include('common.list.datalist')
			</div>
		</div>

		<div class="col s12 m12 l3 pl-7">
			{{-- <a id="add_new" class="add-new" href="#">
				<div class="card shadow hoverable light-blue darken-2 no-margin-top">	
					<div class="card-content center-align p-10">
				      <span class="card-title activator white-text text-darken-2 no-margin-bottom"><i class="material-icons">add_circle_outline</i> New Department</span>
				    </div>
				</div>
			</a> --}}
		

		</div>

	</div>
</div>

<style type="text/css">
/*.add-new-wrapper{
	display:none;
	position: relative;
}
.add-new-wrapper.active{
	display:block;
}
.add-new-wrapper:after{
    content: "";
    position: absolute;
    bottom: -16px;
    right: 100px;
    border-right: 12px solid transparent;
    border-left: 12px solid transparent;
    border-top: 16px solid #0288d1;
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
}*/
</style>
	<script type="text/javascript">
	$(document).ready(function(){
	  $('#modal1').modal({
	    startingTop: '4%', // Starting top style attribute
      	endingTop: '10%'
	  });

	  if($('input[name=name]').val() != ''){
	 	$('.display-form-button').click();
	 }
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