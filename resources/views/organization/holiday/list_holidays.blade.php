@extends('layouts.main')
@section('content')
	
@if(@$data)
	@foreach(@$data as $kay => $value)
		@php
			$model = [
						'title'			=>		$value->title,
						'description'	=>		$value->description,
						'from'			=>		$value->date_of_holiday
					];
		@endphp
	@endforeach
	<script type="text/javascript">
		$(window).load(function(){
			document.getElementById('add_new').click();
		});
	</script>
@endif
<div id="projects" class="projects list-view">
	<div class="row">
		<div class="col s12 m12 l3 offset-l9">
			
			<a id="add_new" href="#modal1" class="btn add-new display-form-button" >
				Add New Holiday
			</a>
			<div id="modal1" class="modal modal-fixed-footer">
					@if(@$data)
						{!! Form::model($model , ['route'=>'edit.holiday' , 'class'=> 'form-horizontal','method' => 'post'])!!}
						<input type="hidden" name="id" value="{{@$data[0]->id}}">
					@else
						{!! Form::open(['route'=>'store.holiday' , 'class'=> 'form-horizontal','method' => 'post'])!!}
					@endif
					<div class="modal-header white-text" style="background-color: rgb(2,136,209)">
						<div class="row" style="padding:15px 10px">
							<div class="col l7">
								<h5 style="margin:0px">Add New Holiday</h5>	
							</div>
							<div class="col l5 right-align">
								<a href="javascript:;" class="closeDialog" style="color: white"><i class="fa fa-close"></i></a>
							</div>
								
						</div>
						
					</div>
					<div class="modal-content" style="padding: 30px">
						{{-- <div class="col s12 m2 l12 aione-field-wrapper">
							<input name="title" class="no-margin-bottom aione-field" type="text" placeholder="Holiday Name" />
						</div>
						<div class="col s12 m2 l12 aione-field-wrapper">
							
							<input  type="date" class="datepicker" name="from" class="no-margin-bottom aione-field " type="text" placeholder="From dd-mm-year" />
						</div>
						<div class="col s12 m2 l12 aione-field-wrapper">
							<textarea name="description" class="no-margin-bottom aione-field" placeholder="Holiday Description" /></textarea>
						</div>
 --}}
						{!!FormGenerator::GenerateSection('holidayadd',['type'=>'inset'])!!}
						
					</div>
					<div class="modal-footer">
						<button class="btn blue" type="submit" name="action">Save Holiday
								
						</button>
					</div>
				{!!Form::close()!!}
			</div>
		{{-- 	<div id="add_new_wrapper" class="add-new-wrapper add-form ">
				{!! Form::open(['route'=>'store.holiday' , 'class'=> 'form-horizontal','method' => 'post'])!!}

					<div class="row no-margin-bottom">
						<div class="col s12 m2 l12 aione-field-wrapper">
							<input name="title" class="no-margin-bottom aione-field" type="text" placeholder="Holiday Name" />
						</div>
						<div class="col s12 m2 l12 aione-field-wrapper">
							
							<input  type="date" class="datepicker" name="from" class="no-margin-bottom aione-field " type="text" placeholder="From dd-mm-year" />
						</div>
						<div class="col s12 m2 l12 aione-field-wrapper">
							<textarea name="description" class="no-margin-bottom aione-field" placeholder="Holiday Description" /></textarea>
						</div>

						<div class="col s12 m3 l12 aione-field-wrapper">
							<button class="btn blue" type="submit" name="action">Save Holiday
								
							</button>
						</div>
					</div>
				{!!Form::close()!!}
			</div> --}}
			

		</div>

	</div>
	<div class="row">
		<div class="col s12 m12 l12" >
			
			@include('common.list.datalist')
			 <a class="btn-floating fixed btn-large waves-effect waves-light red"><i class="fa fa-trash"></i></a>
		</div>

		
	</div>
</div>

        
<style type="text/css">

</style>
	<script type="text/javascript">
	$(document).ready(function(){
 			$('#modal1').modal(); 

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