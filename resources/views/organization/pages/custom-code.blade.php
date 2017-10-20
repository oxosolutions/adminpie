@if(Auth::guard('admin')->check() == true)
  @php
        $from = 'admin';
        $layout = 'admin.layouts.main';
        $route = 'admin.custom.save.pages';
  @endphp
@else
  @php
        $from = 'org';
        $layout = 'layouts.main';
        $route = 'save.page.settings';
  @endphp
@endif
@extends($layout)


@section('content')
	
	{{-- <div class="row">
		<div class="col l12">
			<h5>Edit Details</h5>
			<div>
			{!! Form::model($page,['route'=>'update.page' ])!!}
				@include ('organization.pages._form')
			{!! Form::close()!!}
			</div>
		</div>
		
	</div> --}}
	@php
	$page_title_data = array(
	    'show_page_title' => 'yes',
	    'show_add_new_button' => 'no',
	    'show_navigation' => 'yes',
	    'page_title' => 'Custom Code :<span>'.$page->title.'</span>',
	    'add_new' => '+ Add Media'
	); 
	@endphp 
	@include('common.pageheader',$page_title_data) 
	@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
		@include('organization.pages._tabs')
		{{-- <div class="row">
		    <div class="col l6" style="padding-right: 20px">
		        <label>
		            Write css code here
		        </label>
		        <div id="editor-css" class="editor" style="height: 300px">
		        </div>
		  

		    </div>

		    <div class="col l6" style="padding-right: 20px">
		        <label>
		        Write Javascript code here
		        </label>
		        <div id="editor-js" class="editor" style="height: 300px">
		        </div>
		  
		    </div>
		    <button>save</button>
		</div> --}}
		

		{!! Form::model($customCode,['route' => $route , 'method' => 'post']) !!}
		<input type="hidden" name="page_id" value="{{ request()->route()->parameters()['id'] }}">
			{!! FormGenerator::GenerateForm('custom_code') !!}
		{!! Form::close() !!}
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')
		{{-- <script type="text/javascript">
		$(document).ready(function(){
			var editorJs = ace.edit("editor-js");
        editorJs.setTheme("ace/theme/monokai");
        editorJs.getSession().setMode("ace/mode/javascript");
        var editorCss = ace.edit("editor-css");
        editorCss.setTheme("ace/theme/monokai");
        editorCss.getSession().setMode("ace/mode/css");	

        editorJs.getSession().on("change", function () {
            var code = editorJs.getValue();
            $('input[name=js_code]').val(code);
        });
        editorCss.getSession().on("change", function () {
            var code = editorCss.getValue();
            $('input[name=css_code]').val(code);
        });

        if($('input[name=js_code]').val() != ""){
            editorJs.setValue($('.editor-js').val());
        } 
        if($('input[name=css_code]').val() != ""){
            editorCss.setValue($('.editor-css').val());
        } 
		})
		  
	</script> --}}
	@include('common.page_content_secondry_end')
	@include('common.pagecontentend')
@endsection()