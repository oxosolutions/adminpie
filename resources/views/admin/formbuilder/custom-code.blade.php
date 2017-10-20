@if(Auth::guard('admin')->check() == true)
  @php
        $from = 'admin';
        $layout = 'admin.layouts.main';
  @endphp
@else
  @php
        $from = 'org';
        $layout = 'layouts.main';
  @endphp
@endif
@extends($layout)
@section('content')
@php
    
    $title = $form->form_title;


@endphp
@php
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'no',
  'show_navigation' => 'yes',
  'page_title' => 'Form <span>'.$title.'</span>',
  'add_new' => '+ Add Module'
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('admin.formbuilder._tabs')
@if($data)
    {!! Form::model($data,['route' => ['update.form.custom',request()->route()->parameters()['id']]]) !!}
@else
    {!! Form::open(['route'=>['save.form.custom',request()->route()->parameters()['id']]]) !!}
@endif
{{-- <div class="row">
    <div class="col l6" style="padding-right: 20px">
        <label>
            Write css code here
        </label>
        <div id="editor-css" class="editor" style="height: 300px">
        </div>
      {!! Form::hidden('css', @$subModuleData->css,['class' => 'editor-css']) !!}

    </div>

    <div class="col l6" style="padding-right: 20px">
        <label>
        Write Javascript code here
        </label>
        <div id="editor-js" class="editor" style="height: 300px">
        </div>
        {!! Form::hidden('js', @$subModuleData->js,['class' => 'editor-js']) !!}


    </div>
    <button>save</button>
</div> --}}
    {!! FormGenerator::GenerateForm('custom_code') !!}
{!!Form::close()!!}
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
            $('input[name=js]').val(code);
        });
        editorCss.getSession().on("change", function () {
            var code = editorCss.getValue();
            $('input[name=css]').val(code);
        });

        if($('input[name=js]').val() != ""){
            editorJs.setValue($('.editor-js').val());
        } 
        if($('input[name=css]').val() != ""){
            editorCss.setValue($('.editor-css').val());
        } 
		})
		  
	</script> --}}
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
<style type="text/css">
   .subtitle{
                
   
    font-weight: 500;
    display: inline-block;

         }
</style>
@endsection