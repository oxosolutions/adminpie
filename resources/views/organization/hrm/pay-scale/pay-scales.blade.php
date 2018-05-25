@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Pay Scale',
	'add_new' => '+ Add Pay Scale'
); 
	$id = "";
  
	@endphp	

  @if(!$errors->isEmpty())
    <script type="text/javascript">
      $(window).load(function(){
        $('.modal').modal('open');
      });
    </script>
  @endif
  @if(@$data)
    
    <script type="text/javascript">
      window.onload = function(){
      $('#modal_edit').modal('open');
    }
    </script>
  @endif
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	@include('common.list.datalist')
	
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
	@if(@$data == null || @$data == 'undefined' || @$data == '')
		{!! Form::open(['route'=>'store.payscale' , 'class'=> 'form-horizontal','method' => 'post']) !!}
	@endif
        {{-- {!! FormGenerator::GenerateForm('organization_hrm_payscale_form',['type'=>'inset'])!!} --}}

	@include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Payscale','button_title'=>'Save Payscale','section'=>'paysec1']])
	 {!!Form::close()!!}
	@if(@$data)
		{!! Form::model(@$data['data'],['route'=>['edit.payscale' , $data["data"]->id] , 'class'=> 'form-horizontal','method' => 'post']) !!}
			{{-- <input type="hidden" name="id" value="{{$data["data"]-><i></i>d}}"> --}}
			<a href="#modal_edit" style="display: none" id="modal-edit"></a>

			@include('common.modal-onclick',['data'=>['modal_id'=>'modal_edit','heading'=>'Edit PaySlip','button_title'=>'update Pay Slip','section'=>'paysec1']])
		{!!Form::close()!!}
	@endif
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@if(Session::has('success-update'))
    <script type="text/javascript">Materialize.toast('updated Successfully' , 4000)</script>
  @endif
  <style type="text/css">
  	.modal-footer a{
  		font-size: 13px;margin: 8px;display: inline-block;
  	}
  	.modal-footer .save{
  		color: white;background-color: #2196f3;border-color: #2196f3;    padding: 8px 12px;    border-radius: 3px;    cursor: pointer;    font-weight: 400;    text-align: center;vertical-align: middle;
  	}
  	.modal{
  		    overflow-y: hidden;
  		    border-radius: 4px;
  	}
  	.modal-header i{
  		color: #a9a9a9;
  		cursor: pointer;
  	}
  	.modal-header i:hover{
  		color:#676767;
  	}
  

	#style-2::-webkit-scrollbar-thumb
	{
		border-radius: 5px;
		-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
		background-color: #dcdcdc;
	}

  </style>
@endsection