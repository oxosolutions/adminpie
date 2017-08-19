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