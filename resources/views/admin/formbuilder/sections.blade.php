@if(Auth::guard('admin')->check() == true)
	@php
        $route_slug = '';
		$layout = 'admin.layouts.main';
		$route = 'create.sections';
		$routeDelSec = 'del.section';
		$routeListField = 'list.field';
	@endphp
@else
	@php
        $route_slug = 'org.';
		$layout = 'layouts.main';
		$route = 'org.create.sections';
		$routeDelSec = 'org.del.section';
		$routeListField = 'org.list.field';
	@endphp
@endif
@php
	$section_id = ""; 
@endphp
@extends($layout)
@section('content')
@php
    $sectionData = $sections->where('id',request()->input('sections'))->first();
    $title = $form->form_title;
@endphp
@php
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'no',
  'show_navigation' => 'yes',
  'page_title' => 'Form: '.$title,
  'add_new' => '+ Apply leave'
); 
@endphp

@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
    <div class="module-wrapper">
        <div class="list-container">
            <nav id="aione_nav" class="aione-nav aione-nav-vertical">
                <div class="aione-nav-background"></div>
                <ul id="sortable" class="aione-menu">
                    <li class="aione-nav-item level0 unsortable {{(Request::input('sections') == 'all')?'nav-item-current':''}}">
                        <a href="{{Request::url()}}?sections=all">
                            <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-list"></i></span>
                            <span class="nav-item-text">
                                All Sections
                            </span>                      
                        </a>
                    </li>
                @php $index = 1;@endphp
				@foreach($sections as $key => $section)
					@php
						$section_id = $section->id;	
					@endphp
                    <li class="aione-nav-item level0 has-children {{(Request::input('sections') == $section->id)?'nav-item-current':''}}">
                        <a href="{{Request::url()}}?sections={{$section->id}}">
                            <span class="nav-item-icon " style="background:rgba(0, 0, 0, 0)"><i class="fa fa-amazon">
                                </i></span>
                            <span class="nav-item-text">
                                {{$section->section_name}}
                            </span>
                            <span class="nav-item-arrow"></span>
                        </a>
                        <ul id="sortable_submenu" class="side-bar-submenu">
                       @foreach($section->fields as $k => $fields)
                            <li class="aione-nav-item level1 {{(Request::input('field') == $fields->id)?'nav-item-current':''}}">
                                <a href="{{Request::url()}}?sections={{$section->id}}&field={{$fields->id}}">
                                    <span class="nav-item-icon">P</span>
                                    <span class="nav-item-text"> {{ucfirst($fields->field_title)}} ({{$fields->field_type}})</span>
                                </a>
                            </li>
                        @endforeach
                        </ul>
                        <i class="material-icons dp48 del">clear</i>    
                    </li>
                    @endforeach
                </ul>
            </nav>
        </div>
        <div class="Detail-container">
            
            @if(!Request::has('field'))

                @if(Request::has('sections') && Request::input('sections') != 'all')
                    <div id="" class="aione-tabs-wrapper">
                        <nav class="aione-nav aione-nav-horizontal">
                            <ul class="aione-tabs">
                                <li class="aione-tab ">
                                    <a href="#aione_modules_settings">
                                        <span class="nav-item-text">Settings</span>
                                    </a>
                                </li>
                                <li class="aione-tab ">
                                    <a href="#aione_modules_custom_css">
                                        <span class="nav-item-text">Custom CSS</span>
                                    </a>
                                </li>
                                <li class="aione-tab ">
                                    <a href="#aione_modules_custom_js">
                                        <span class="nav-item-text">Custom JS</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <div class="aione-tabs-content-wrapper">
                            <div id="aione_modules_settings" class="aione-tab-content">
                                Settings
                            </div>
                            <div id="aione_modules_custom_css" class="aione-tab-content">
                                CSS
                            </div>
                            <div id="aione_modules_custom_js" class="aione-tab-content">
                                JS
                            </div>
                        </div>
                    </div>
                    {!!Form::open(['route'=>[$route_slug.'section.update',request()->form_id]])!!}
                        <input type="hidden" name="section_id" value="{{Request::input('sections')}}" />
                        <div class="row no-margin-bottom">
                            <div class="input-field col l12">   
                                @php
                                    $sectionDetails = $sections->where('id',Request::input('sections'))->first();
                                @endphp
                                <input placeholder="Enter section name" name="section_name" id="user_name" type="text" value="{{($sectionDetails != null)?$sectionDetails->section_name:''}}" >
                                <label for="user_name">Section Name</label>
                            </div>

                            <div class="input-field col l12">
                                <input placeholder="Enter slug" name="section_slug" id="emailId" type="text" value="{{($sectionDetails != null)?$sectionDetails->section_slug:''}}" >
                                <label for="emailId">Slug</label>
                                
                            </div>

                            <div class="input-field col l12">
                                <input placeholder="Enter description" name="section_description" id="roleId" type="text" value="{{($sectionDetails != null)?$sectionDetails->section_description:''}}" >
                                <label for="roleId">Description</label>
                            </div>
                            @php
                                $sectionmeta = null;
                                $section = $sections->where('id',Request::input('sections'))->first();
                                if($section != null){
                                    $sectionmeta = $section->sectionMeta->where('key','section_type')->first();
                                }
                            @endphp
                            
                            <div class="input-field col l12">
                                <select class="no-margin-bottom aione-field" name="section_type">
                                    <option selected="selected" disabled="disabled" hidden="hidden" value="">Select type</option>
                                    <option value="Single" {{($sectionmeta != null && $sectionmeta->value == 'Single')?'selected':''}}>Single</option>
                                    <option value="Repeater" {{($sectionmeta != null && $sectionmeta->value == 'Repeater')?'selected':''}}>Repeater</option>
                                </select>
                            </div>
                            
                            @if(@$errors->has())
                                @foreach($errors->all() as $kay => $err)
                                    <div style="color: red">{{$err}}</div>
                                @endforeach
                            @endif

                            <div class="col s12 m12 l12 aione-field-wrapper center-align">
                              <button class="save_user btn waves-effect waves-light light-blue-text text-darken-2 white darken-2" type="submit">Save
                                <i class="material-icons right">save</i>
                              </button>
                            </div>

                        </div>
                    {!!Form::close()!!}
                @endif

                @if(Request::has('sections') && Request::input('sections') == 'all')
                    {!! Form::open(['route'=>[$route , request()->form_id] , 'class'=> 'form-horizontal','method' => 'post'])!!}
                        <div class="add-section">
                            <button class="btn blue" type="submit">Add Section</button>
                            <span>
                                <input type="text" name="name">
                                <input type="hidden" name="module_id" value="">    
                            </span>
                            <div class="clear"></div>
                            @if($errors->has('name'))
                                <span style="color: red;">{{$errors->first('name')}}</span>
                            @endif
                        </div>
                    {!!Form::close()!!}
                @endif
                @if(Request::has('sections') && Request::input('sections') != 'all')
                    {!!Form::open(['route'=>[$route_slug.'create.field',request()->form_id,Request::input('sections')]])!!}
                        <div class="add-section">
                            <button class="btn blue" type="submit">Add Field</button>
                            <span>
                                <input type="text" name="field_title">
                            </span>
                            <div class="clear"></div>
                        </div>
                    {!!Form::close()!!}
                @endif

                <ul class="collection">
                    @if(Request::has('sections') && Request::input('sections') == 'all')
                        @foreach($sections as $k => $section)
                            <li class="collection-item">{{ucfirst($section->section_name)}} ({{ucfirst($section->section_slug)}})<a href="{{route($route_slug.'section.delete',$section->id)}}" class="delete-field"><i class="material-icons dp48 del">clear</i></a>    </li>
                        @endforeach
                    @endif
                    @if(Request::has('sections') && Request::input('sections') != 'all')
                        @foreach($sections->where('id',Request::input('sections'))->first()->fields as $k => $field)
                            <li class="collection-item">{{ucfirst($field->field_title)}} ({{ucfirst($field->field_slug)}})<a href="{{route($route_slug.'field.delete',$field->id)}}" class="delete-field"><i class="material-icons dp48 del">clear</i></a>  </li>
                        @endforeach
                    @endif
                </ul>
            @endif
            @if(Request::has('field') && Request::input('field') != '')
                
                @if($sectionData->form->type == 'survey')
                    @include('admin.formbuilder._fields_survey')
                @else
                    @include('admin.formbuilder._field',['sections'=>$sections])
                @endif
            @endif
        </div>

        <div style="clear: both;padding:20px">
            
        </div>
        {{-- <div>
            these fields are just for demo purpose please ignore it
            @include('admin.formbuilder._fields_survey')
        </div> --}}
        
    </div>
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
    /*     .Detail-container .collection .collection-item > .material-icons{
            float: right;
            font-size: 16px;
            color: #757575;
            cursor: pointer;
            display: none
         }
         .Detail-container .collection .collection-item:hover .material-icons{
            display: block;
         }*/
          .Detail-container .collection .collection-item .delete-field{
            float: right;
            font-size: 16px;
            color: #757575;
            cursor: pointer;
            display: none
         }
         .Detail-container .collection .collection-item:hover .delete-field{
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
    <script type="text/javascript">
        $("#custom").spectrum({
            color: '#000',
            showAlpha: true,    
        });
        $(document).ready(function(){
            $(document).on('click','.list-modules .arrow',function(){ 
                if($(this).parents('li').hasClass('list-active')){
                    $(this).parents('li').removeClass('list-active');
                }else{
                    $(this).parents('li').addClass('list-active');
                    $(this).parents('li').siblings().removeClass('list-active');    
                }
                
            });

            $('.input1').iconpicker(".input1");

            $('#custom').change(function(){
                $('.color_picker').val($("#custom").spectrum('get').toRgbString());             
            });
            $('.font-awesome').change(function(){
                $('.font-awesome-text').val($(this).val());
            });
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
        });
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


        $( function() {
                $( "#sortable" ).sortable({
                    axis: "y"
                });
                $( "#sortable" ).disableSelection();
              } );
        $( function() {
                $( "#sortable_submenu" ).sortable({
                    axis: "y"
                });
                $( "#sortable_submenu" ).disableSelection();
              } );


        
    </script>
@endsection