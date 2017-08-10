{{-- @extends('layouts.main')
@section('content')
@php
$page_title_data = array(
'show_page_title' => 'yes',
'show_add_new_button' => 'no',
'show_navigation' => 'yes',
'page_title' => 'Edit leave category',
'add_new' => '+ Add Role'
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
{!! FormGenerator::GenerateSection('leavecatsec2') !!}
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection
 --}}
@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
'show_page_title' => 'yes',
'show_add_new_button' => 'no',
'show_navigation' => 'yes',
'page_title' => 'Edit leave category',
'add_new' => '+ Add Role'
); 
@endphp
@include('common.pageheader',$page_title_data)
<div class="row">
	
	 {!! Form::open(['route'=>'meta.category' ,	'class'=> 'form-horizontal', 'method' => 'post']) !!}
	{!! Form::hidden('id',$data['id']) !!}

		<div class="row"  style="padding-bottom: 15px">
			
			<div class="col l3" style="line-height: 30px">
				Name
			</div>
			<div class="col l9">
				{{-- <input type="text" name="" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px "> --}}
				{!! Form::text('name',@$data['cat']['name'],['class'=>"aione-setting-field","style"=>"border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px"]) !!}
			</div>
		</div>	
		<div class="row"  style="padding-bottom: 15px">
			
			<div class="col l3" style="line-height: 30px">
				Description
			</div>
			<div class="col l9">
				{{-- <input type="text" name="" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px "> --}}
				 {{-- <textarea id="textarea1" class="materialize-textarea" style="border:1px solid #a8a8a8;margin-bottom: 0px;"></textarea> --}}
				 {!! Form::textarea('description',@$data['cat']['description'],['class'=>"materialize-textarea","id"=>"textarea1","style"=>"border:1px solid #a8a8a8;margin-bottom: 0px"]) !!}
			</div>
		</div>	

		<div class="row"  style="padding-bottom: 15px">
			<div class="col l3" style="line-height: 30px">
				No of Leaves 
			</div>
			<div class="col l9">
				
			    <div class="col l6 pr-7">
					{!! Form::text('number_of_day',@$data['data']['number_of_day'],['class'=>"aione-setting-field","style"=>"border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px"]) !!}
				</div>
				<div class="col l6 pl-7">

					{!! Form::select('valid_for',['monthly'=>'Monthly', 'yearly'=>'Yearly'],@$data['data']['valid_for'],['placeHolder'=>"Valid For"])!!}
				</div>
			</div>
		</div>	
		<div class="row" style="padding-bottom: 15px">
			
			<div class="col l3" style="line-height: 30px">
				No of day before apply
				{{@$data['apply_before']}}
			</div>
			<div class="col l9">
				{{-- <input type="text" name="" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px "> --}}
				{!!Form::text('apply_before',@$data['data']['apply_before'],['class'=>"aione-setting-field","style"=>"border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px"]) !!}
			</div>
		</div>
		<div class="row" style="padding-bottom: 15px">
			
			<div class="col l3" style="line-height: 30px">
				Applicable	ON 
			</div>
			<div class="col l9">
					<input  id="include_role" onclick="show_option(this.id)" type="button" value="Include Role"> 
					<input class=""  onclick="show_option(this.id)" id="exclude_role" type="button" value="Exclude Role">
				<input class="radio_button" type="radio" id="include_role" onclick="show_option(this.id)" > Include Role<input class="radio_button"  onclick="show_option(this.id)" type="radio" id="exclude_role"> Exclude Role
			</div>
		</div>
				@php
					if(isset($data['data']['role_include'])){
 						$data['role_include'] = array_map('intval',json_decode($data['data']['role_include']));
						echo '<div  class="row  include_role " style="padding-bottom: 15px">';
						echo "<script> $('#include_role').addClass('green'); </script>";
					}else{
							echo '<div  class="row  include_role hides" style="padding-bottom: 15px">';
					}
				@endphp

			<div class="col l3" style="line-height: 30px">
				Applicable	Include Roles
			</div>

			<div class="col l9">
				{{Form::select('role_include[]',$data['roles'],@$data['role_include'],array('id'=>'role_include', 'multiple'=>'multiple', 'placeholder'=>"Select Role"))}}
			</div>
		</div>
				@php
					if(isset($data['data']['roles_exclude'])){
						
						$data['data']['roles_exclude'] = array_map('intval',json_decode($data['data']['roles_exclude']));
						echo '<div class="row exclude_role " style="padding-bottom: 15px">';
						echo "<script> $('#exclude_role').addClass('green'); </script>";

					}else{
						echo '<div class="row exclude_role hides" style="padding-bottom: 15px">';

					}
				@endphp
			<div class="col l3" style="line-height: 30px">
				Applicable Exclude Roles
			</div>
			<div class="col l9">
				{{Form::select('roles_exclude[]',$data['roles'],@$data['data']['roles_exclude'],array('id'=>'roles_exclude','multiple'=>'multiple', 'placeholder'=>"Select Role"))}}
			</div>
		</div>

		<div class="row" style="padding-bottom: 15px">
			
			<div class="col l3" style="line-height: 30px">
				Applicable	ON 
			</div>
			<div class="col l9">
					<input  id="include_designation" onclick="show_option(this.id)" type="button" value="Include Designation"> 
					<input  onclick="show_option(this.id)" id="exclude_designation" type="button" value="Exclude Designation">
				<input class="radio_button" type="radio" id="include_designation" onclick="show_option(this.id)" > Include Designation<input class="radio_button"  onclick="show_option(this.id)" type="radio" id="exclude_designation"> Exclude Designation
			</div>
		</div>
		
				@php
					if(isset($data['data']['include_designation'])){
						$data['data']['include_designation'] = array_map('intval',json_decode($data['data']['include_designation']));
						echo	'<div class="row include_designation" style="padding-bottom: 15px">';
						echo "<script> $('#include_designation').addClass('green'); </script>";
					}else{
								echo '<div class="row include_designation hides" style="padding-bottom: 15px">';

					}
				@endphp
			<div class="col l3" style="line-height: 30px">
				Applicable Incldue Designation
			</div>
			<div class="col l9">
				{{Form::select('include_designation[]',$data['designationData'],@$data['data']['include_designation'],array('id'=>'designation_include', 'multiple'=>'multiple', 'placeholder'=>"Select Designation"))}}
			</div>
		</div>

				@php
					if(isset($data['data']['exclude_designation'])){

						$data['data']['exclude_designation'] = array_map('intval',json_decode($data['data']['exclude_designation']));
					echo '<div class="row exclude_designation" style="padding-bottom: 15px">';
					echo "<script> $('#exclude_designation').addClass('green'); </script>";

					}else{
							echo '<div class="row exclude_designation hides" style="padding-bottom: 15px">';
	
					}
				@endphp
			<div class="col l3" style="line-height: 30px">
				Applicable Exclude	Designation
			</div>
			<div class="col l9">
				{{Form::select('exclude_designation[]',$data['designationData'],@$data['data']['exclude_designation'],array('id'=>'designation_exclude', 'multiple'=>'multiple', 'placeholder'=>"Select Designation"))}}
			</div>
		</div>

		<div class="row" style="padding-bottom: 15px">
			
			<div class="col l3" style="line-height: 30px">
				Applicable	ON 
			</div>
			<div class="col l9">
					<input  id="include_user" onclick="show_option(this.id)" type="button" value="Include User"> 
					<input  id="exclude_user"  onclick="show_option(this.id)" type="button" value="Exclude User">
				<input class="radio_button" type="radio" id="include_user" onclick="show_option(this.id)" > Include User<input class="radio_button"  onclick="show_option(this.id)" type="radio" id="exclude_user"> Exclude User
		</div>
		</div>
			@php
					if(isset($data['data']['user_include'])){
						
						$data['user_include'] = array_map('intval',json_decode($data['data']['user_include']));
							echo	'<div class="row include_user " style="padding-bottom: 15px">';
							echo "<script> $('#include_user').addClass('green'); </script>";

					}else{
							echo	'<div class="row include_user hides" style="padding-bottom: 15px">';

					}
				@endphp
			<div class="col l3" style="line-height: 30px">
				Include Users
			</div>
			<div class="col l9">
				{{Form::select('user_include[]',$data['userData'],@$data['user_include'],array('id'=>'user_include', 'multiple'=>'multiple', 'placeholder'=>"Select User"))}}
			</div>
		</div>
			@php
					if(isset($data['data']['user_exclude'])){
						
						$data['user_exclude'] = array_map('intval',json_decode($data['data']['user_exclude']));
						echo '<div class="row exclude_user " style="padding-bottom: 15px">';
						echo "<script> $('#exclude_user').addClass('green'); </script>";
					}else{
						echo '<div class="row exclude_user hides" style="padding-bottom: 15px">';


					}
				@endphp

			<div class="col l3" style="line-height: 30px">
				Applicable Exclude Users
			</div>
			<div class="col l9">
				{{Form::select('user_exclude[]',$data['userData'],@$data['user_exclude'],array('id'=>'user_exclude','multiple'=>'multiple', 'placeholder'=>"Select User"))}}
			</div>
		</div>

		<div class="row" style="padding-bottom: 15px">
		{!! Form::submit('submit',['class'=>'btn blue white-text'])!!}
		</div>


	</div>
	
	<style type="text/css">
	.radio_button{
		position: inherit!important;
 		opacity: 3!important;
	}
		.aione-setting-field:focus{
			border-bottom: 1px solid #a8a8a8 !important;
			box-shadow: none !important;
		}
		.select-dropdown{
			margin-bottom: 0px !important;
		    border: 1px solid #a8a8a8 !important;
		    
		}
		.select-wrapper input.select-dropdown{
			height: 30px;
	    	line-height: 30px;
		}

		.pv-10{
			padding:10px 0px
		}
		.aione-setting-field:focus{
			border-bottom: 1px solid #a8a8a8 !important;
			box-shadow: none !important;
		}
		textarea{
			border-bottom: 1px solid #a8a8a8 !important;
			box-shadow: none !important;
		}
		.btn{
			background-color: #0288D1;
		}
		.select-dropdown{
			margin-bottom: 0px !important;
		    border: 1px solid #a8a8a8 !important;
		    
		}
		.select-wrapper input.select-dropdown{
			height: 30px;
	    	line-height: 30px;
		}
		.file-path{
			margin-bottom: 0px !important
		}
		.datepicker{
			margin-bottom: 0px !important
		}
		.level{
			margin: 0px !important;
		}
		.green{
			background-color: green;
		}
</style>
<script>
$(document).ready(function(){
$('.hides').hide();
})
function show_option(id){
	$('#'+id).addClass('green');
	if(id =='include_role'){
		$('#exclude_role').removeClass('green');
		$('.exclude_role').hide();
		$("#role_include").attr('name','role_include[]');
		$("#roles_exclude").attr('name','');
		}else if(id=='exclude_role'){
			$("#role_include").attr('name','');
			$("#roles_exclude").attr('name','roles_exclude[]');
			$('#include_role').removeClass('green');
			$('.include_role').hide();
		}
 	if(id =='include_designation'){
 		$('#exclude_designation').removeClass('green');
		$('.exclude_designation').hide();
		$("#designation_exclude").attr('name','');
		$("#designation_include").attr('name','include_designation[]');
		}else if(id=='exclude_designation'){
			$('#include_designation').removeClass('green');
			$('.include_designation').hide();
			$("#designation_exclude").attr('name','exclude_designation[]');
			$("#designation_include").attr('name','');
		}
	if(id =='include_user'){
		$('#exclude_user').removeClass('green');
		$('.exclude_user').hide();
		
		$("#user_exclude").attr('name','');
		$("#user_include").attr('name','user_include[]');
		}else if(id=='exclude_user'){
			$('.include_user').hide();
		$('#include_user').removeClass('green');
		$("#user_exclude").attr('name','user_exclude[]');
		$("#user_include").attr('name','');
		}
	$('.'+id).show();
}
</script>
@endsection