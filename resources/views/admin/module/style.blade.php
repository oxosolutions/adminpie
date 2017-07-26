@extends('admin.layouts.main')
@section('content')
	@php
	$page_title_data = array(
	  'show_page_title' => 'yes',
	  'show_add_new_button' => 'no',
	  'show_navigation' => 'yes',
	  'page_title' => 'Modules Style',
	  'add_new' => ''
	); 
	@endphp
	@include('common.pageheader',$page_title_data)
	@include('common.pagecontentstart')
		@include('common.page_content_primary_start')
			<ul class="collapsible" data-collapsible="accordion">
			    <li>
			      	<div class="collapsible-header">Name of module</div>
			      	<div class="collapsible-body">
			      		<div class="row">
			      			<div class="col l6">
			      				<textarea></textarea>
			      			</div>
			      			<div class="col l6">
			      				<textarea></textarea>
			      			</div>
			      			<div class="col l6">
			      				colorpicker
			      			</div>
			      			<div class="col l6">
			      				iconpicker
			      			</div>
			      		</div>
			      	</div>
			    </li>
			    <li>
			      	<div class="collapsible-header">Name of module</div>
			      	<div class="collapsible-body">
			      		<div class="row">
			      			<div class="col l6">
			      				<div style="margin-left: 5px">
			      					Write Javascript code here
			      				</div>
			      				<div id="editor-js" style="height: 200px;margin: 5px 10px">
									
								</div>
			      			</div>
			      			<div class="col l6">
			      				<div style="margin-left: 5px">
			      					Write css code here
			      				</div>
			      				<div id="editor-css" style="height: 200px;margin: 5px 10px">
									
								</div>
			      			</div>
			      			<div class="col l6">
			      				colorpicker
			      			</div>
			      			<div class="col l6">
			      				iconpicker
			      			</div>
			      		</div>
			      	</div>
			    </li>
			    <li>
			      	<div class="collapsible-header">Name of module</div>
			      	<div class="collapsible-body">
			      		<div class="row">
			      			<div class="col l6">
			      				<textarea></textarea>
			      			</div>
			      			<div class="col l6">
			      				<textarea></textarea>
			      			</div>
			      			<div class="col l6">
			      				colorpicker
			      			</div>
			      			<div class="col l6">
			      				iconpicker
			      			</div>
			      		</div>
			      	</div>
			    </li>
			   
		  	</ul>
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
		editorCss.getSession().setMode("ace/mode/javascript");
	</script>
@endsection