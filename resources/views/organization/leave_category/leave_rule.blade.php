@extends('layouts.main')
@section('content')
<div class="row">
	{!! Form::open(['route'=>'edit.category' ,	'class'=> 'form-horizontal', 'method' => 'post']) !!}
	<!-- {!! Form::open(['route'=>'meta.category' ,	'class'=> 'form-horizontal', 'method' => 'post']) !!} -->
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
				Applicable	Include Roles
			</div>
			<div class="col l9">
				@php
					if(isset($data['data']['role_include'])){
						
						$data['role_include'] = array_map('intval',json_decode($data['data']['role_include']));
					}
				@endphp
				{{Form::select('role_include[]',$data['roles'],@$data['role_include'],array('multiple'=>'multiple', 'placeholder'=>"Select Role"))}}
			</div>
		</div>
		<div class="row" style="padding-bottom: 15px">
			<div class="col l3" style="line-height: 30px">
				Applicable Exclude Roles
			</div>
			<div class="col l9">
				@php
					if(isset($data['data']['roles_exclude'])){
						
						$data['data']['roles_exclude'] = array_map('intval',json_decode($data['data']['roles_exclude']));
					}
				@endphp
				{{Form::select('roles_exclude[]',$data['roles'],@$data['data']['roles_exclude'],array('multiple'=>'multiple', 'placeholder'=>"Select Role"))}}
			</div>
		</div>
		
		<div class="row" style="padding-bottom: 15px">
			<div class="col l3" style="line-height: 30px">
				Applicable Incldue Designation
			</div>
			<div class="col l9">
				@php
					if(isset($data['data']['include_designation'])){

						$data['data']['include_designation'] = array_map('intval',json_decode($data['data']['include_designation']));
					}
				@endphp
				{{Form::select('include_designation[]',$data['designationData'],@$data['data']['include_designation'],array('multiple'=>'multiple', 'placeholder'=>"Select Designation"))}}
			</div>
		</div>

		<div class="row" style="padding-bottom: 15px">
			<div class="col l3" style="line-height: 30px">
				Applicable Exclude	Designation
			</div>
			<div class="col l9">
				@php
					if(isset($data['data']['exclude_designation'])){

						$data['data']['exclude_designation'] = array_map('intval',json_decode($data['data']['exclude_designation']));
					}
				@endphp
				{{Form::select('exclude_designation[]',$data['designationData'],@$data['data']['exclude_designation'],array('multiple'=>'multiple', 'placeholder'=>"Select Designation"))}}
			</div>
		</div>
		<div class="row" style="padding-bottom: 15px">
			<div class="col l3" style="line-height: 30px">
				Include Users
			</div>
			<div class="col l9">
			@php
					if(isset($data['data']['user_include'])){
						
						$data['user_include'] = array_map('intval',json_decode($data['data']['user_include']));
					}
				@endphp
				{{Form::select('user_include[]',$data['userData'],@$data['user_include'],array('multiple'=>'multiple', 'placeholder'=>"Select User"))}}
			</div>
		</div>

		<div class="row" style="padding-bottom: 15px">
			<div class="col l3" style="line-height: 30px">
				Applicable Exclude Users
			</div>
			<div class="col l9">
			@php
					if(isset($data['data']['user_exclude'])){
						
						$data['user_exclude'] = array_map('intval',json_decode($data['data']['user_exclude']));
					}
				@endphp
				{{Form::select('user_exclude[]',$data['userData'],@$data['user_exclude'],array('multiple'=>'multiple', 'placeholder'=>"Select User"))}}
			</div>
		</div>

		<div class="row" style="padding-bottom: 15px">
		{!! Form::submit('submit',['class'=>'btn blue white-text'])!!}
		</div>


	</div>
	
	<style type="text/css">
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
</style>
@endsection