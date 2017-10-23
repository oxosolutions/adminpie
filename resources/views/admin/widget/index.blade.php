@extends('admin.layouts.main')
@section('content')

<style type="text/css">
    .module-wrapper > .list-container{
            float: left;
            width: 25%;
            border: 1px solid #e8e8e8;
            height: 100%;
            padding: 10px;
        }
        .module-wrapper > .Detail-container{
            float: right;
            width: 74%;
            border: 1px solid #e8e8e8;
            padding: 10px;
           
        }
        .list-modules > li > div,.list-sub-modules > li{
            border: 1px solid #e8e8e8;
            padding:10px 5px;
            margin-bottom: 5px;
            box-shadow: 1px 1px 1px 1px #F2F1F1;
            background-color: white;
        }
        .list-modules > li > div > .del,.list-sub-modules > li > .del{
            float: right;
            color: #757575;
            font-size: 18px;
            cursor: pointer;
        }
        .list-modules > li > div > .arrow{
            float: left;
            color: #757575;
            font-size: 18px;
            transform: rotate(270deg);
            cursor: pointer;
        }
        .list-sub-modules > li{
            margin-left: 10px;
             transition: opacity 1s ease-out;
        }
        .list-active .list-sub-modules{
            display: block;
            
        }
        .list-sub-modules{
            display: none;
        }
       .module-wrapper .editor{
            height: 200px;margin: 5px 10px
        }
        .module-wrapper .sp-preview{
            height: 40px;
            width: 40px;
        }
        .module-wrapper .sp-dd{
            padding: 2px 6px;
            height: 40px;
            line-height: 40px;
        }
        .module-wrapper .btn.blue{
            float: right;
           
            margin: 10px;
        }
        .aione-nav-item .material-icons{
            position: absolute;
            top: -10px;
            right: -10px;
            border: 3px solid white;
            line-height: 14px;
            height: 20px;
            background-color: red;
            font-size: 14px;
            border-radius: 50%;
            cursor: pointer;
            display: none;
        }
        .aione-nav-item:hover .material-icons{
            display: block
        }
        /*******************************/
         .Detail-container .collection{
            border: none;
        }
        .Detail-container .collection .collection-item{
            border: 1px solid #e8e8e8;
            margin-bottom: 5px;
        }
   
          .Detail-container .collection .collection-item .delete-field,.arrow-downward,.arrow-upward{
            float: right;
            font-size: 16px;
            color: #757575;
            cursor: pointer;
            display: none
         }
         .Detail-container .collection .collection-item:hover .delete-field{
            display: block;
         }
         .Detail-container .collection .collection-item:hover .arrow-downward{
            display: block;
         }
         .Detail-container .collection .collection-item:hover .arrow-upward{
            display: block;
         }
         .add-section > button {
            float: right;
        }
        .add-section > span{
            float: right;
            width: 200px
        }
</style>
@php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'yes',
    'show_navigation' => 'yes',
    'page_title' => 'Widgets',
    'add_new' => '+ Add Widget',
    'route' => 'create.widget'
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
  
    <div class="module-wrapper">
        <div class="list-container">
            <nav id="aione_nav" class="aione-nav light vertical">
                <div class="aione-nav-background"></div>
                <ul id="aione_menu" class="aione-menu sortable">
                    <li class="aione-nav-item level0 unsortable ">
                        <a href="{{ route('index.widget') }}">
                            <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-list">
                                </i></span>
                            <span class="nav-item-text">
                                List Widgets
                            </span>
                            {{-- <span class="nav-item-arrow"></span> --}}
                        </a>
                        <ul id="sortable_submenu" class="side-bar-submenu">
                          
                        </ul>
                       
                    </li>
                    @if(!empty($data))
                        @foreach($data as $key => $val)
                            @php
                                $ids = [];
                                
                            @endphp
                            @foreach($val->widgets as $k => $widgets)
                                @php
                                    $ids[] = $widgets->id;

                                @endphp 
                            @endforeach
                            <li class="aione-nav-item level0 has-children {{ (in_array(@request()->route()->parameters()['id'],$ids))?'nav-item-selected':'' }} ">

                                <input type="hidden" name="id" class="id" value="{{ $val->id }}">
                                <input type="hidden" name="orderBy" class="orderBy" value="{{ $val->order }}">
                                <a href="#">
                                    <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa {{$val->icon}}">
                                        </i></span>
                                    <span class="nav-item-text">
                                        {{$val->name}}
                                    </span>
                                    <span class="nav-item-arrow"></span>
                                </a>
                                <ul id="sortable_submenu" class="side-bar-submenu">
                                
                                    @foreach($val->widgets as $k => $widgets)
                                        <li class="aione-nav-item level1 {{($widgets->id == @request()->route()->parameters()['id'])?'active-state' :''}}  ">
                                            <a href="{{ route('index.widget',['id'=>$widgets->id]) }}">
                                                <span class="nav-item-icon">{{$widgets->id}}</span>
                                                <span class="nav-item-text">{{$widgets->title}}</span>
                                            </a>
                                        </li>

                                    @endforeach
                                </ul>    
                            </li>
                        @endforeach
                    @endif
                </ul>
            </nav>
        </div>
        <div class="Detail-container">
            @if($widgetData == null)
                <ul class="collection">
                    @if(!empty($data))
                        @php
                            $check_id = 0;
                        @endphp
                       
                        @foreach($listWidgets as $key => $val)
                            
                            <li class="collection-item">
                                {{-- <input type="hidden" name="title" value="{{$val->title}}" class="title" > --}}
                                <input type="hidden" name="_token" value="{{csrf_token()}}" class="token" >
                                <input type="hidden" name="id" class="id" value="{{ $val->id }}">

                                <input type="checkbox" class="filled-in status-toggle" id="test{{$check_id}}" 
                                    {{($val->status == '0'?'':'checked="checked"')}}/> 
                                <label for="test{{$check_id}}"> {{$val->title}}</label>
                                
                                <a href="{{route('delete.widget',['id'=>$val->id])}}" class="delete-field">
                                    <i class="material-icons dp48 del red">clear</i>
                                </a>
                                <script type="text/javascript">
                                    $(document).on('click','.delete-field',function(e){
                                        e.preventDefault();
                                        var href = $(this).attr("href");
                                        swal({   
                                            title: "Are you sure?",   
                                            text: "You will not be able to recover!",   
                                            type: "warning",   
                                            showCancelButton: true,   
                                            confirmButtonColor: "#DD6B55",   
                                            confirmButtonText: "Yes, delete it!",   
                                            closeOnConfirm: false 
                                        }, 
                                        function(){
                                            window.location = href;
                                           swal("Deleted!", "Your widget has been deleted.", "success"); 
                                       });
                                    })
                                </script>
                                <a href="{{ route('sort.down',['id'=>$val->id]) }}" class="arrow-downward">
                                    <i class="material-icons dp48 orange">arrow_downward</i>
                                </a>
                                <a href="{{ route('sort.up',['id'=>$val->id]) }}" class="arrow-upward">
                                    <i class="material-icons dp48 green">arrow_upward</i>
                                </a>
                            </li>
                            
                        @php
                            $check_id++;
                        @endphp
                        @endforeach
                    @endif
                </ul>
            @else
                <div id="" class="aione-tabs-wrapper">
                    <nav class="aione-nav aione-nav-horizontal">
                        <ul class="aione-tabs ">
                            <li class="aione-tab active">
                                <a href="#aione_modules_settings">
                                    <span class="nav-item-text">Settings</span>
                                </a>
                            </li>
                            <li class="aione-tab ">
                                <a href="#aione_modules_custom_css">
                                    <span class="nav-item-text">Customize</span>
                                </a>
                            </li>
                            {{-- <li class="aione-tab ">
                                <a href="#aione_modules_custom_js">
                                    <span class="nav-item-text">Custom JS</span>
                                </a>
                            </li> --}}
                        </ul>
                    </nav>
                        <div class="aione-tabs-content-wrapper">
                            {!! Form::model($widgetData,['route' => 'edit.widget']) !!}
                           
                           <input type="hidden" name="id" class="id" value="{{ $widgetData->id }}">
                            <div id="aione_modules_settings" class="aione-tab-content active">
                               
                                 {{--   <div class="row">
                                        <div class="col l12" style="padding: 10px 0px;">
                                            title
                                        </div>
                                        <div class="col l12">
                                          {!! Form::text('title',null,['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ;']) !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col l12" style="padding: 10px 0px;">
                                            slug
                                        </div>
                                        <div class="col l12">
                                          {!! Form::text('slug',null,['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ;']) !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col l12" style="padding: 10px 0px;">
                                            Module
                                        </div>
                                     {!! Form::select('module_id',array_add($module_data,0,'default module'),@$widgetData->module_id,['class' => 'aione-setting-field' , 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;height: 30px ;']) !!}
                                    </div>
                                    <div class="col s12 m2 l12 " style="padding: 10px 0px">
                                        Description
                                    </div>
                                    <div class="col s12 m2 l12 " style="padding: 10px 0px">
                                        {!! Form::textarea('description',null,['rows' => '10' ,'class' => 'materialize-textarea', 'style' => 'border:1px solid #a8a8a8;margin-bottom: 0px;']) !!}
                                    </div> --}}

                                    
                                {!! FormGenerator::GenerateForm('add_edit_widget_form') !!}
                            </div>

                            <div id="aione_modules_custom_css" class="aione-tab-content">
                                {{-- <div class="col l6">
                                    <label>
                                        Write css code here
                                    </label>
                                    <div id="editor-css" class="editor" >
                                    </div>
                                    {!! Form::hidden('css', @$widgetData->css,['class' => 'editor-css']) !!}

                                </div> --}}
                                 {!! FormGenerator::GenerateForm('custom_code') !!}
                            </div>
                            <div id="aione_modules_custom_js" class="aione-tab-content">
                                {{-- <div class="col l6">
                                    <label>
                                    Write Javascript code here
                                    </label>
                                    <div id="editor-js" class="editor">
                                    </div>
                                    {!! Form::hidden('js', @$widgetData->js,['class' => 'editor-js']) !!}

                                </div> --}}
                            </div>
                          {{--   <div class="row" style="padding: 10px 0px">
                                <div class="col l6">
                                     {!! Form::submit('Update Widget', ['class' => 'btn btn-primary']) !!}
                                </div>
                            </div> --}}
                            {!! Form::close() !!}
                        </div>
                </div>
                <script type="text/javascript">
                     var editorJs = ace.edit("editor-js");
                    editorJs.setTheme("ace/theme/monokai");
                    editorJs.getSession().setMode("ace/mode/javascript");
                    var editorCss = ace.edit("editor-css");
                    editorCss.setTheme("ace/theme/monokai");
                    editorCss.getSession().setMode("ace/mode/css");
                    // $("#custom").spectrum({
                    //     color: '#000',
                    //     showAlpha: true,
                    // });

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
                </script>
            @endif
            
        </div>
        <div style="clear: both;padding:20px">
            
        </div>
        
        
    </div>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
<script type="text/javascript">


   //  $(document).ready(function(){
    


   //       $('.sortable').sortable({
   //          axis: 'y',
   //          items: "li:not(.unsortable)",
   //          update: function (event, ui) {
   //            var id = [];
   //            var orderBy = [];
   //            var data = $(this).sortable('serialize');

   //            $('.id').each(function($v){
   //              id.push($(this).val());
   //            });

   //            $('.orderBy').each(function($v){
   //              orderBy.push($(this).val());
   //            });

   //          $.ajax({
   //              url: route()+'/sort/widget',
   //              type: 'POST',
   //              data: {id : id,_token : $('input[name=_token]').val()},
   //              success:function(){
   //                console.log()
   //              }
   //          });
   //        }
   //      });
   // });

    $(document).on('change', '.status-toggle',function(e){
      // e.preventDefault();
      var postedData = {};
      postedData['id']        = $(this).parents('.collection-item').find('.id').val();
      postedData['status']      = $(this).prop('checked');
      postedData['_token']      = $('.collection-item').find('.token').val();

      $.ajax({
        url:route()+'/widget/status/update',
        type:'POST',
        data:postedData,
        success: function(res){
          console.log('data sent successfull');
        }
      });
      $('.editable h5 ,.editable p').removeClass('edit-fields');
    });


      



</script>
@endsection