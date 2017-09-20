@extends('layouts.main')
@section('content')
<style type="text/css">
	#card-alert{
		position: absolute;
	    top: 10px;
	    width: 98%;
	}
	#card-alert i{
		float: right;
		cursor: pointer
	}
</style>
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Users',
	'add_new' => '+ Add User'
); 
@endphp
@include('common.pageheader',$page_title_data)		
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('common.list.datalist')
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

	<!-- <div id="card-alert" class="card green lighten-5"><div class="card-content green-text">Password Change Successfully<i class="material-icons dp48">clear</i></div></div> -->

{!! Form::open(['method' => 'POST','class' => '','route' => 'store.user']) !!}
	@include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add new user','button_title'=>'Save User','section'=>'organization_user_edit']])
{!! Form::close() !!}

{!! Form::open(['method' => 'POST','class' => '','route' => 'change.pass']) !!}
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	@include('common.modal-onclick',['data'=>['modal_id'=>'change_password','heading'=>'Change Password','button_title'=>'Save ','section'=>'changepasssec2']])
{!! Form::close() !!}

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@if(Session::has('exist_email'))
	<script type="text/javascript">
		$(document).ready(function(){
			Materialize.toast('Email already in use ',4000);
		});
	</script>
@endif
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click','.change_password',function(){
			var user_id = $(this).attr('id');
			var data = '<input type="hidden" name="user_id" value="'+user_id+'">';
			$('#change_password').append(data);
		});
		$(document).on('click','#card-alert i',function(){
			$('#card-alert').remove();
		});
	});

</script>
@endsection