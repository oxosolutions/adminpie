@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Designations',
	'add_new' => '+ Add Designation'
); 
	$id = "";
	@endphp	

		@if(@$data)
			@foreach(@$data as $k => $v)
				@php
					$newData = $v->name;
					$id = $v->id;
				@endphp
			@endforeach
			
				<script type="text/javascript">
				$(window).load(function(){
					document.getElementById('modal-edit').click();
				});
			</script>
		@endif
		@php
			@$model = ['name' => @$newData];
			
	@endphp
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	@include('common.list.datalist')
	
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
	@if(@$newData == 'undefined' || @$newData == '' || @$newData == null)
		{!! Form::open(['route'=>'store.designation' , 'class'=> 'form-horizontal','method' => 'post']) !!}

	@endif
	@include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add designation','button_title'=>'Save Designation','section'=>'titlesection']])
	 {!!Form::close()!!}
	@if(@$model)
		{!! Form::model(@$model,['route'=>'edit.designation' , 'class'=> 'form-horizontal','method' => 'post']) !!}
			<input type="hidden" name="id" value="{{$id}}">
			<a href="#modal_edit" style="display: none" id="modal-edit"></a>
			@include('common.modal-onclick',['data'=>['modal_id'=>'modal_edit','heading'=>'Edit designation','button_title'=>'update Designation','section'=>'titlesection']])
		{!!Form::close()!!}
	@endif
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
	<a href="#" class="btn sign-in"></a>
	@include('common.confirm-alert',['message'=>'My Message','sub_message'=>'You clicked the button!...'])
  <!-- Modal Trigger -->
  <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Modal</a>

  <!-- Modal Structure -->
  <div id="modal1" class="modal modal-fixed-footer">
  	<div class="modal-header" style="padding: 15px;border-bottom: 1px solid #e8e8e8">
  		<h5 style="display: inline-block;">Heading Area</h5>
  		<i class="material-icons dp32" style="float: right">clear</i>
  	</div>
    <div class="modal-content scrollbar" id="style-2">
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
      a<br>
    </div>
    <div class="modal-footer">
    	<a href=""  >Cancel</a>
      	<a href="#!" class="save" >Save Changes</a>
    </div>
  </div>
  <script type="text/javascript">
  	 $(document).ready(function(){
	    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
	    $('.modal').modal();
	  });
         
  </script>
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