@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Send Email',
	'add_new' => '+ Add Email'
); 
@endphp	
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
{{-- 	section
	{!!FormGenerator::GenerateSection('modsec1',['type'=>'inset'],'','org')!!}
	field
	{!!FormGenerator::GenerateField('modsec1f1',['type'=>'inset'],'','org')!!}
	form
	{!!FormGenerator::GenerateForm('model',['type'=>'inset'],'','org')!!} --}}
	{{-- @include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'This is Heading','button_title'=>'Save Data','section'=>'modsec1']]) --}}
	  {{-- <input name="group1" type="radio" id="test1" value="custom_email" checked/>
      <label for="test1">Custom Email</label>
      <input name="group1" type="radio" id="test2" value="pre_defined_email"/>
      <label for="test2">Pre Defined Email</label>
      <div class="custom_email box">
      	custom email
      </div>
      <div class="pre_defined_email box">
      	predefined email
      </div> --}}
    <div class="row">
    	<div class="col l9 pr-7">
    		<div class="aione-field-wrapper">
    			<div class="label">
    				To
    				<span style="float: right"><a>Choose custom list</a></span>
    			</div>
				 {!!Form::text('send-to',null,['class'=>'no-margin-bottom aione-field','placeholder'=>'To'])!!}
			</div>
			<div class="aione-field-wrapper">
				<div class="label">
    				Subject
    				
    			</div>
				 {!!Form::text('subject',null,['class'=>'no-margin-bottom aione-field','placeholder'=>'Subject'])!!}
			</div>
			<div class="aione-field-wrapper">
				<div class="label">
    				Message
    				<span style="float: right"><a>Choose template</a></span>
    				<span style="float: right"><a>Choose layout</a>|</span>
    			</div>
				 {!!Form::textarea('subject',null,['size' => '100x100','class'=>'no-margin-bottom aione-field','placeholder'=>'Message','style'=>'height:300px'])!!}
			</div>
			<div class="attachments">
				<div class="item">
					Name Of the File.jpg
					<i class="material-icons dp48">clear</i>
				</div>
				<div class="item">
					Name Of the File.jpg
					<i class="material-icons dp48">clear</i>
				</div>
				<div class="item">
					Name Of the File.jpg
					<i class="material-icons dp48">clear</i>
				</div>
				<div class="item">
					Name Of the File.jpg
					<i class="material-icons dp48">clear</i>
				</div>
				<div class="item">
					Name Of the File.jpg
					<i class="material-icons dp48">clear</i>
				</div>
				<div class="item">
					Name Of the File.jpg
					<i class="material-icons dp48">clear</i>
				</div>

			</div>
			<div>
				<a href="" class="btn-flat">+ Add an Attachment</a>
			</div>
    	</div>  
    	<div class="col l3 pl-7">
    		<div class="card">
    			<div class="headline">User List</div>
    			<div style="max-height: 150px;min-height: 150px">
    				
    			</div>
    		</div>
    		<div class="card">
    			<div class="headline">Selected Layout</div>
    			<div class="content">
    				<select class="browser-default">
    					<option>Select Layout</option>
    					<option>Option 1</option>
    					<option>Option 2</option>
    					<option>Option 3</option>
    				</select>
    			</div>
    		</div>
    		<div class="card">
    			<div class="headline">Selected Template</div>
    			<div class="content">
    				<select class="browser-default">
    					<option>Select Layout</option>
    					<option>Option 1</option>
    					<option>Option 2</option>
    					<option>Option 3</option>
    				</select>
    			</div>
    		</div>
    	</div>  
    </div>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
	{{-- add email modal start--}}
	@include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Email','button_title'=>'Save Email','section'=>'emasec1']])
	{{-- add email modal end--}}
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
<script type="text/javascript">
	// $(".pre_defined_email").hide();
	// $(document).ready(function(){
	//     $('input[type="radio"]').click(function(){
	//         var inputValue = $(this).attr("value");
	//         var targetBox = $("." + inputValue);
	//         $(".box").not(targetBox).hide();
	//         $(targetBox).show();
	//     });
	// });
</script>
<style type="text/css">
	.label{
		padding: 5px 0px
	}
	
	.card .headline{
		border-bottom: 1px solid #e8e8e8;
		padding: 10px
	}
	.card .content{
		padding: 10px;
		background-color: white
	}
	.attachments{
		margin:10px 0px;
	}
	.attachments .item{
		margin-bottom: 10px;
		background-color: #f2f2f2;
		border: 1px solid #e8e8e8;
		padding: 10px
	}
	.attachments .item > i{
		float: right;
		font-size: 18px;
		color: #676767
	}
</style>
@endsection
