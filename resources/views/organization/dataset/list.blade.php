@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Datasets',
	'add_new' => '+ Add Dataset',
	'route' => 'create.dataset',
	'second_button_title' => '+ Import Dataset',
	'second_button_route' => 'import.dataset',
); 
@endphp	
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
    @include('common.page_content_primary_start')
  
   
<div id="projects" class="projects list-view">
	<div class="row">
		<div class="col l3  pl-7" style="float: right;margin-bottom: 14PX;">
			
				
				<div id="add_new_model" class="modal modal-fixed-footer ">
					{!! Form::open(['route'=>'save.dataset' , 'class'=> 'form-horizontal','method' => 'post'])!!}
					<div class="modal-header white-text  blue darken-1">
						<div class="row" style="padding:15px 10px;margin: 0px">
							<div class="col l7 left-align">
								<h5 style="margin:0px">Create Dataset</h5>	
							</div>
							<div class="col l5 right-align">
								<a href="javascript:;" name="closeModel" onclick="close()" id="closemodal" class="closeDialog close-model-button" style="color: white"><i class="fa fa-close"></i></a>
							</div>	
						</div>
					</div>
					<div class="modal-content">
					

						<div class="row no-margin-bottom">
							
							<div class="row">
								<div class="col l12" style="line-height: 30px">
									Dataset Name
								</div>
								<div class="col l12">
									<input type="text" name="dataset_name" class="aione-setting-field" style="border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ">
									@if ($errors->has('dataset_name'))
	                                    <span class="help-block" style="color: red;">
	                                        <strong>{{ $errors->first('dataset_name') }}</strong>
	                                    </span>
	                                @endif
								</div>
							</div>
							<div class="row">
								<div class="col l12" style="line-height: 30px">
									Description
								</div>
								<div class="col l12">
									 <textarea id="textarea1" name="dataset_description" class="materialize-textarea" style="border:1px solid #a8a8a8;margin-bottom: 0px;"></textarea>
									 @if ($errors->has('dataset_description'))
	                                    <span class="help-block" style="color: red;">
	                                        <strong>{{ $errors->first('dataset_description') }}</strong>
	                                    </span>
	                                @endif
								</div>
							</div>
							
							<div class="col s12 m6 l12 aione-field-wrapper">
								
							</div>
						</div>
					
				    </div>
				    <div class="modal-footer">
				      	<button class="btn blue" type="submit">Save
						</button>
				    </div>
				    {!!Form::close()!!}
				</div>
				
			
		</div>
	</div>
	<div class="row">
		@include('common.list.datalist')
	</div>
</div>

<script type="text/javascript">
		  $(document).ready(function(){
		    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
		    $('.modal').modal();
		  });
		$(document).ready(function(){
			$('#test1').change(function(){
			alert("chamnges");
			});
		});
		$('.close-model-button').click(function(){
			$("#add_new_model").modal('close');
		});
</script>
<style type="text/css">
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

</style>
 @include('common.page_content_primary_end')
    @include('common.page_content_secondry_start')

    @include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection