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
'page_title' => 'Edit Leave Category',
'add_new' => '+ Add Role'
); 

// dump($data, current_organization_user_id());

@endphp
@if(Session::has('success'))
	<div class="aione-message success">
		<p> {{ Session::get('success') }}</p>
	</div>
@endif
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
<div class="row">
			<input id="token" type="hidden" name="_token" value="{{csrf_token()}}" >
			@if(isset($data))
			@php
			// $data = collect($data);
			@endphp
			{{-- {{dump($data)}} --}}
					 {!! Form::model($data,['route'=>'meta.category' ,	'class'=> 'form-horizontal', 'method' => 'post']) !!}
				@else
	 {!! Form::open(['route'=>'meta.category' ,	'class'=> 'form-horizontal', 'method' => 'post']) !!}
			@endif

	{!! Form::hidden('id',$data['id']) !!}
		{!! FormGenerator::GenerateForm('edit_leave_category_form') !!}
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

$("#include_designation").on('change',function(event){
	des_id = $('#include_designation').val();
	data = {};
	data['des_id'] =	des_id;
	data['_token'] = 	$('#token').val();
	$.ajax({
		url:route()+'/ajax_user_drop_down',
		method:'POST',
		data:data,
		success:function(res){
			$("#user_drop_down").html(res);
		}
	});
});

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
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')	
@endsection