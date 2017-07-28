@extends('admin.layouts.main')
@section('content')
	@php
	$subModule_id = request()->route()->parameters()['id'];
	$sub_name = App\Model\Admin\GlobalSubModule::where('id',$subModule_id)->get()[0]->name;

	$page_title_data = array(
	  'show_page_title' => 'yes',
	  'show_add_new_button' => 'no',
	  'show_navigation' => 'yes',
	  'page_title' => 'Modules Style: '.$sub_name,
	  'add_new' => ''
	); 

	$data = [
				'css' => $model->css,
				'js' => $model->js,
				'color' => $model->color,
				'icon' => $model->icon
			];
			// dd($data);
	@endphp

	@include('common.pageheader',$page_title_data)
	@include('common.pagecontentstart')
		@include('common.page_content_primary_start')
			@if(@$model)
				{!! Form::model($data,['route' => 'save.style.module' , 'method' => 'post'])!!}	
			@else
				{!! Form::open(['route' => 'save.style.module' , 'method' => 'post'])!!}
			@endif
      		<div class="row custom-code">
      			<div class="col l6">
      				<label>
      					Write Javascript code here
      				</label>
      				<div id="editor-js" class="editor">
					</div>
      			</div>
      			{!! Form::hidden('js', null,['class' => 'editor-js']) !!}

      			<div class="col l6">
      				<label>
      					Write css code here
      				</label>
      				<div id="editor-css" class="editor" >
						
					</div>
      			</div>
      			{!! Form::hidden('css', null,['class' => 'editor-css']) !!}
      			<div class="col l6">
      				<label>
      					Select a color
      				</label>
      				<div class="col l12">
      					{{-- <input type='color' name="color" />	 --}}
      					<input type="text" id="custom">
      					{!! Form::hidden('color', null,['class' => 'color_picker']) !!}
      				</div>
      			</div>
      			<div class="col l6">
  					<label>
  						Select an icon
      				</label>
  					<div class="col l12 aione-field-wrapper">
  				 		<input type="text" class="input1 input font-awesome" placeholder="Pick an icon" />	
  				 		{{-- <input type="text" name="icon" class="font-awesome-text" value=""> --}}
  				 		{!! Form::hidden('icon', null,['class' => 'font-awesome-text']) !!}						
  				 		<input type="hidden" name="sub_modules_id" value="{{request()->route()->parameters()['id']}}">		      						
  					</div>
      			</div>
      		</div>
			<button class="btn blue save-settings" type="submit">Save Settings</button>

		{!! Form::close() !!}
		@include('common.page_content_primary_end')
		@include('common.page_content_secondry_start')
		@include('common.page_content_secondry_end')
	@include('common.pagecontentend')
	<script type="text/javascript">
		var editorJs = ace.edit("editor-js");
		editorJs.setTheme("ace/theme/monokai");
		editorJs.getSession().setMode("ace/mode/javascript");
		var editorCss = ace.edit("editor-css");
		editorCss.setTheme("ace/theme/monokai");
		editorCss.getSession().setMode("ace/mode/css");
		$("#custom").spectrum({
		    color: '#000',
		    showAlpha: true,
		});
		$(document).ready(function(){
	    	$('.input1').iconpicker(".input1");
	    	//get color
	    	$('#custom').change(function(){
	    		$('.color_picker').val($("#custom").spectrum('get').toRgbString());	    		
	    	});
	    	$('.font-awesome').change(function(){
	    		$('.font-awesome-text').val($(this).val());
	    	});
	    	editorJs.getSession().on("change", function () {
	    		var code = editorJs.getValue();
	    		$('input[name=js]').val(code);
		    });
	    	editorCss.getSession().on("change", function () {
	    		var code = editorCss.getValue();
	    		$('input[name=css]').val(code);
		    });

	    	if($('.editor-js').val() != ""){
	    		editorJs.setValue($('.editor-js').val());
	    	} 
	    	if($('.editor-css').val() != ""){
	    		editorCss.setValue($('.editor-css').val());
	    	} 

	    	if($('input[name=icon]').val() != ""){
	    		$('.geticonval > i').each(function(){
	    			if($(this).attr('class') == 'fa '+$('input[name=icon]').val()){
	    				$(this).parent().addClass('geticonval selectedicon');
	    				$('.font-awesome').val($('input[name=icon]').val());
	    			}else{
	    				console.log("not in class");
	    			}
	    		});
		   	}
		   	if($('input[name=color]').val() != ""){
		   		$('.sp-preview-inner').css({'background-color': $('input[name=color]').val()});
		   	}

	    	// sp-preview-inner

	    	// var $editor = $('#editor');
		    // if ($editor.length > 0) {
		    //     var editor = ace.edit('editor');
		    //     editor.session.setMode("ace/mode/css");
		    //     $editor.closest('form').submit(function() {
		    //         var code = editor.getValue();
		    //         $editor.prev('input[type=hidden]').val(code);                
		    //     });
		    // }




	    });

	</script>
	<style type="text/css">
		.howl-iconpicker .geticonval{
			width: 52px;
			height: 48px;
		}
		.howl-iconpicker-close{
			width: 260px;
		}
		.custom-code .editor{
			height: 200px;margin: 5px 10px
		}
		.sp-preview{
			width: 400px;
    		height: 28px;
		}
		..sp-replacer{
			display: block;
		}
		.custom-code .col{
			margin-bottom: 10px
		}
		button.save-settings{
			float: right;
		}
		input[type='color']{
			 display: block;
   			 width: 98%;
   			 height: 48px;
		}
	</style>
@endsection