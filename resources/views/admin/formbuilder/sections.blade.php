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
    @$title = $form->form_title;
@endphp
@php
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'yes',
  'show_navigation' => 'yes',
  'page_title' => __('forms.form_page_title_text').'<span>'.@$title.'</span>',
  'add_new' => __('forms.export_survey_button_text'),
  'route' => ['export.survey',$form->id],
 
); 
@endphp
{{-- (Request::route()->action['as'] == 'survey.sections.list')?'Survey:':'Form:' --}}
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
<style type="text/css">
	.edit-form-detail,.edit-section-detail,.add-section,.add-field{
		display: none;
	}
	.module-wrapper > .list-container{
		display: none;
	}
	.module-wrapper.sidebar-active > .list-container{
		display: block;
	
	}
	.aione-breadcumb > div{
		position: relative;

	}
	.aione-breadcumb > div > button{
		position: absolute;
		right: 5px;
		top: 5px;
		display: block;

	}
	/*.aione-breadcumb > div:hover > button{
		display: block;

	}*/
	.aione-breadcumb > div:after{
		    content: '';
    border-left: 15px solid #ffffff;
    border-top: 21px solid transparent;
    border-bottom: 21px solid transparent;
    height: 0;
    position: absolute;
    width: 0;
    padding: 0;
    margin-left: 20px;
        top: 0;
    right: -15px;
	}
	.aione-breadcumb > div:before{
		    content: '';
   border-left: 15px solid transparent;
    border-top: 21px solid #FFFFFF;
    border-bottom: 21px solid #FFFFFF;
    height: 0;
    position: absolute;
    width: 0;
    padding: 0;
    margin-left: -35px;
    top: 0;
    left: 20px;
	}
	.aione-breadcumb > div:first-child:before{
		content: '';
		border: none;
	}
	.aione-breadcumb > div:first-child{
		/*padding-left: 20px;*/
	}
    .aione-tooltip:hover:before{
        z-index: 9
    }
    .edit-icon-button{
        background-color: #f5f5f5;width: 30px;border-radius: 50%
    }
    .toggle-sidenav .show{
        display: inline-block;
    }
    .toggle-sidenav .hidden{
        display:none;
    }
    .toggle-sidenav.active .show{
        display: none;
    }
    .toggle-sidenav.active .hidden{
        display:inline-block;
    }
    .aione-bars{
        display: inline-block;
        position: relative;
        text-align: center;
        width: 20px;
        height: 20px;
      
    }
    .aione-bars:before{
        content: "";
        position: absolute;
        width: 100%;
        top: 2px;
        bottom: 2px;
        display: block;
        border-top: 2px solid #454545;
        border-bottom: 2px solid #454545;
    }
    .aione-bars:after{
        content: "";
        position: absolute;
        width: 100%;
        top: 50%;
        bottom: 0;
        display: block;
        margin: -1px 0 0 0;
        border-top: 2px solid #454545;
    }
</style>
<script type="text/javascript">
	$('body').on('click','.edit-form-detail-button',function(){
		$('.edit-form-detail').toggle();
	});
	$('body').on('click','.edit-section-detail-button',function(){
		// console.log("edit");
		$('.edit-section-detail').toggle();
	});
	$('body').on('click','.add-section-button',function(){
		$('.add-section').toggle();
	});
	$('body').on('click','.add-field-button',function(){
		$('.add-field').toggle();
	});
	$('body').on('click','.toggle-sidenav',function(){
        $('.module-wrapper').toggleClass('sidebar-active');
		$(this).toggleClass('active');

	});
</script>
@if(!empty($error))
 @include('organization.survey._tabs')
    <div class="aione-message warning">
        {{$error}}
    </div>

@elseif(!@$permission)
    <div>
        <div class="access-denied">{{__('forms.access_denied')}}</div>
        <div class="permission">{{__('forms.permission')}}</div>
    </div>
@else
    
    @if($form->type == 'survey')
        @include('organization.survey._tabs')
    @else
        @include('admin.formbuilder._tabs')
    @endif
    <div class="aione-border  mb-20 bg-grey bg-lighten-3 p-5">
    	<div class="display-inline-block p-10 toggle-sidenav aione-tooltip"  title="Show Sidebar" style="    vertical-align: middle;">
            {{-- <a class="aione-tooltip show"  title="Show Sidebar">
                <i class="fa fa-bars"></i>                
            </a>
            <a class="aione-tooltip hidden"  title="Hide Sidebar">
                <i class="fa fa-close"></i>      
            </a> --}}
            <a class="aione-bars " >
                   
            </a>
    	</div>
    	<div class="display-inline-block aione-breadcumb">
    		<div class="p-5  display-inline-block ml-20 bg-white line-height-32">
	    		<b>{{__('forms.form_page_title_text')}}:</b><a href=""> {{@ strip_tags($title)}} </a>
	    		<span class="ml-6 edit-form-detail-button aione-tooltip" title="Edit Form Details"><i class="fa fa-pencil line-height-30 aione-align-center edit-icon-button" style=""></i></span>
	    	</div>
	    	@if(Request::has('sections'))
    	    	<div class="p-5  display-inline-block ml-20 bg-white line-height-32">
    	    		<b>Section:</b><a href=""> {{ $sections->where('id',request()->sections)->first()->section_name }}</a>
    	    		<span class=" ml-6  edit-section-detail-button aione-tooltip" title="Edit Form Details"><i class="fa fa-pencil line-height-30 aione-align-center edit-icon-button" style=""></i></span>
    	    	</div>
            @endif
            @if(Request::has('field'))
                @php
                    $sectionFields = $sections->where('id',Request::input('sections'))->first()->fields;
                @endphp
    	    	<div class="p-5 pr-50 display-inline-block ml-20 bg-white line-height-32">
    	    		<b>{{__('forms.field')}}:</b> {{ strip_tags($sectionFields->where('id',request()->field)->first()->field_title) }}  
    	    		{{-- <button class="aione-button edit-section-detail-button" title="Edit Form Details"><i class="fa fa-pencil"></i></button> --}}
    	    	</div>
            @endif
    	</div>
	    	
    	{{-- <div class="pv-10 display-inline-block ml-20">
    		Field: basic details <button class="aione-button aione-tooltip" title="Edit Form Details"><i class="fa fa-pencil"></i></button>
    	</div> --}}
    </div>
    <input type="hidden" name="_token" value="{{csrf_token() }}">

    

        <div class="module-wrapper ">
            <div class=" mb-10 edit-form-detail">
                  {{-- @if((Request::has('sections') && Request::input('sections') == 'all') || empty(Request::input())) --}}
                        {!! Form::model($form,['class' => 'form' ,'route' => 'org.update.form']) !!}
                            <input type="hidden" name="id" value="{{$form->id}}">
                            {!! FormGenerator::GenerateForm('edit_form_form') !!}
                        {!! Form::close() !!}

                        
                    {{-- @endif --}}
            </div>
            <div class="list-container">
                <nav id="aione_nav" class="aione-nav light vertical">
                    <div class="aione-nav-background"></div>
                    <ul id="sortable" class="aione-menu">
                        <li class="aione-nav-item level0 unsortable {{(Request::input('sections') == 'all' || empty(Request::input()))?'nav-item-current':''}}">
                            <a href="{{Request::url()}}?sections=all" id="all_list">
                                <span class="nav-item-icon"><i class="fa fa-bars"></i></span>
                                <span class="nav-item-text">
                                    {{__('forms.all_sections')}}
                                </span>
                            </a>
                        </li>
                    @php $index = 1;@endphp
    				@foreach($sections as $key => $section)
    					@php
    						$section_id = $section->id;	
    					@endphp
                        <li class="aione-nav-item level0 has-children {{(Request::input('sections') == $section->id)?'nav-item-current':''}}" section-id={{ $section->id }}>
                            <a href="{{Request::url()}}?sections={{$section->id}}">
                                <span class="nav-item-icon"><i class="fa fa-terminal"></i></span>
                                <span class="nav-item-text">
                                    {{$section->section_name}}
                                </span>
                                <span class="nav-item-arrow"></span>
                            </a>
                            <ul class="side-bar-submenu">
                           @foreach($section->fields as $k => $fields)
                                <li class="aione-nav-item level1 unsortable {{(Request::input('field') == $fields->id)?'nav-item-current':''}}">
                                    <a href="{{Request::url()}}?sections={{$section->id}}&field={{$fields->id}}">
                                        <span class="nav-item-icon">P</span>
                                        <span class="nav-item-text"> {{$fields->field_title}} ({{$fields->field_type}})</span>
                                    </a>
                                </li>
                            @endforeach
                            </ul>
                            
                        </li>
                    @endforeach
                    </ul>
                </nav>
            </div>
            <div class="Detail-container">
                @php
                    $section_id = request()->input('sections');
                    $sectionFormData = [];
                    $data = [];
                @endphp
                @foreach($sections as $key => $value)
                    @if($value->id == $section_id)
                        @php
                            $sectionFormData[$key] = $value;   
                        @endphp
                    @endif    
                @endforeach
                @foreach($sectionFormData as $key => $value)
                    @foreach($value->sectionMeta as $k => $v)
                        @php
                            $data[$v->key] = $v->value;
                        @endphp
                    @endforeach
                    @php
                        $data['section_name'] = $value->section_name;
                        $data['section_slug'] = $value->section_slug;
                        $data['section_description'] = $value->section_description;
                    @endphp
                @endforeach
                

                {!!Form::model($data,['route'=>[$route_slug.'section.update',request()->form_id]])!!}
                    <input type="hidden" name="section_id" value="{{Request::input('sections')}}" />
                    <div class="row no-margin-bottom edit-section-detail">
                        
                        {!! FormGenerator::GenerateForm('form_generator_section_edit') !!}
                        @if(@$errors->has())
                            @foreach($errors->all() as $kay => $err)
                                <div style="color: red">{{$err}}</div>
                            @endforeach
                        @endif

                      

                    </div>
                {!!Form::close()!!}


                @if(!Request::has('field'))

                    {{-- @if(Request::has('sections') && Request::input('sections') != 'all') --}}
                        
                    {{-- @endif --}}

                    @if((Request::has('sections') && Request::input('sections') == 'all') || empty(Request::input()))
                       {{--  {!! Form::model($form,['class' => 'form' ,'route' => 'org.update.form']) !!}
                            <input type="hidden" name="id" value="{{$form->id}}">
                            {!! FormGenerator::GenerateForm('edit_form_form') !!}
                        {!! Form::close() !!} --}}
                        {!! Form::open(['route'=>[$route , request()->form_id] , 'class'=> 'form-horizontal','method' => 'post'])!!}
                            <div class="add-section">
                               

                                {!! FormGenerator::GenerateForm('add_section_form') !!} 
                                <div class="clear"></div>
                                @if($errors->has('name'))
                                    <span style="color: red;">{{$errors->first('name')}}</span>
                                @endif
                            </div>
                        {!!Form::close()!!}
                    @endif
                    @if(Request::has('sections') && Request::input('sections') != 'all')
                        {!!Form::open(['route'=>[$route_slug.'create.field',request()->form_id,Request::input('sections')],'class'=>'add-field-mini-form add-field'])!!}
                                {!! FormGenerator::GenerateForm('add_field_from_section') !!}  
                                {!!Form::hidden('type',$form->type)!!}
                        {!!Form::close()!!}
                    @endif

                    <ul class="collection aione-form-section-border" id="sortable-fields">
                        
                        @if((Request::has('sections') && Request::input('sections') == 'all') || empty(Request::input()))
                            <div id="aione_form_section_header" class="aione-form-section-header">
                                <div class="aione-row aione-float-left">
                                    <h3 class="aione-form-section-title aione-align-left">{{__('forms.sections')}}</h3>
                                    <h4 class="aione-form-section-description aione-align-left">{{__('forms.section_description')}}</h4>

                                </div> <!-- .aione-row -->
                        		<button class="add-section-button aione-float-right aione-button pv-10">{{__('forms.add_new_section_button_text')}}</button>
                        		<div class="clear"></div>
                            </div>
                            @if($sections->count() > 0)
                                @foreach($sections as $k => $section)
                                
                                    <li class="collection-item section_id" section_id="{{$section->id}}">
                                        <a href="{{Request::url()}}?sections={{$section->id}}">{{$section->section_name}} ({{$section->section_slug}})</a>
                                        <div class="item-options">
                                            <a href="{{route($route_slug.'section.delete',$section->id)}}" class="delete-field confirm-delete">
                                                <i class="material-icons dp48 del red">clear</i>

                                            </a>
                                            

                                             <a href="{{route($route_slug.'section.clone',$section->id)}}" class="delete-field">
                                                <i class="fa fa-clone"></i>
                                            </a>
                                            
                                            <a href="javascript:;" class="arrow-upward">
                                                <i class=" material-icons dp48 green">arrow_upward</i>   
                                            </a>
                                            
                                            <a href="javascript:;" class="arrow-downward">
                                                <i class=" material-icons dp48 orange">arrow_downward</i>    
                                            </a>
                                            <a href="javascript:;" class="move" section-id="{{ $section->id }}" data-target="list-forms">
                                                <i class=" material-icons dp48 blue">forward</i>    
                                            </a>
                                        </div>
                                       
                                        <div id="list-forms" class="modal modal-fixed-footer" style="overflow-y: hidden;">
                                            <div class="modal-header">
                                                <h5>{{__('forms.copy_or_move_model_text')}}</h5>  
                                                <a href="javascript:;" name="closeModel" onclick="close()" id="closemodal" class="closeDialog close-model-button" style="color: white"><i class="fa fa-close"></i></a>
                                            </div>
                                             {!! Form::open([ 'method' => 'POST', 'route' =>$route_slug.'section.move' ,'class' => 'form-horizontal']) !!}
                                            <div class="modal-content">
                                                 {!! Form::select('move_to',listForms(),null,['class'=>' browser-default ','id'=>'input_','placeholder'=>'Select form'])!!}
                                                    <input type="hidden" name="sectionId" value="">
                                                 {!! FormGenerator::GenerateField('want_to') !!}
                                                  
                                            </div>
                                            <div class="modal-footer">
                                               
                                                <button class="btn blue " type="submit" name="action">{{__('forms.proceed')}}
                                                </button>
                                            </div>
                                            {!! Form::close() !!}  
                                        </div>
                                        <script type="text/javascript">
                                            $('#list-forms').modal({
                                                 dismissible: true
                                            });
                                        </script>
                                        
                                    </li>
                                @endforeach
                            @else
                                <div class="aione-message warning">
                                    {{ __('forms.no_section_available') }}
                                </div>
                            @endif
                        @endif
                        @if(Request::has('sections') && Request::input('sections') != 'all')
                            <div id="aione_form_section_header" class="aione-form-section-header">
                                <div class="aione-row aione-float-left">
                                    <h3 class="aione-form-section-title aione-align-left ">{{__('forms.fields')}}</h3>
                                    <h4 class="aione-form-section-description aione-align-left">{{__('forms.field_description')}}</h4>
                                </div> <!-- .aione-row -->
                                <button class="add-field-button aione-float-right aione-button pv-10">{{__('forms.add_new_field_button_text')}}</button>
                        		<div class="clear"></div>
                            </div>
                            @php
                                $fields = $sections->where('id',Request::input('sections'))->first()->fields;
                                $firstField = @$fields->toArray()[0]['id'];
                            @endphp

                            @if($fields->count() > 0)
                                @foreach($sections->where('id',Request::input('sections'))->first()->fields as $k => $field)
                                    <li class="collection-item field_id" field_id="{{$field->id}}">
                                        @if($form->type == 'survey')
                                            @php
                                                $question_id = '';
                                                $questionID = $field->fieldMeta->where('key','question_id')->first();
                                                if($questionID != null){
                                                    $question_id = $questionID->value;
                                                }
                                            @endphp
                                            <span class="question-id">{{$question_id}}</span>
                                        @endif
                                       
                                        <a href="{{Request::url()}}?sections={{Request::input('sections')}}&field={{$field->id}}">
                                            {{$field->field_title}} ({{$field->field_slug}})
                                        </a>
                                         <div class="item-options">
                                            <a href="{{route($route_slug.'field.delete',$field->id)}}" class="delete-field confirm-delete" >
                                                <i class="material-icons dp48 del red">clear</i>

                                            </a>
                                           

                                            <a href="{{route($route_slug.'field.clone',$field->id)}}" class="delete-field">
                                                <i class="fa fa-clone"></i>
                                            </a>

                                          
                                            @if(Auth::guard('admin')->check())                                                
                                                @php
                                                    $down = 'field.down.sort';
                                                    $up = 'field.up.sort';
                                                @endphp
                                            @else   
                                                @php
                                                    $down = 'org.field.down.sort';
                                                    $up = 'org.field.up.sort';
                                                @endphp
                                            @endif
                                                @if($field->id != $firstField)
                                                    <a href="{{ route($up,$field->id) }}" class="arrow-upward">
                                                        <i class=" material-icons dp48 green">arrow_upward</i>    
                                                    </a>
                                                @endif
                                                <a href="{{ route($down,$field->id) }}" class="arrow-downward">
                                                    <i class=" material-icons dp48 orange">arrow_downward</i>    
                                                </a>

                                            <a href="javascript:;" class="move field_move" field_id="{{ $field->id }}" data-target="sections-list">
                                                <i class=" material-icons dp48 blue">forward</i>    
                                            </a>
                                        </div>
                                        <div id="sections-list" class="modal modal-fixed-footer" style="overflow-y: hidden;">
                                            <div class="modal-header">
                                                <h5>{{__('forms.destination')}}</h5>  
                                                <a href="javascript:;" name="closeModel" onclick="close()" id="closemodal" class="closeDialog close-model-button" style="color: white"><i class="fa fa-close"></i></a>
                                            </div>
                                            @if(Auth::guard('admin')->check())
                                                @php
                                                    $route = 'field.move';
                                                @endphp
                                            @else   
                                                @php
                                                    $route = 'org.field.move';
                                                @endphp
                                            @endif
                                            @php
                                                $sectionData = '';
                                            @endphp
                                             {!! Form::open([ 'method' => 'POST', 'route' =>[$route,$field->id] ,'class' => 'form-horizontal']) !!}
                                            <div class="modal-content">
                                                    {{__('forms.select_form')}}
                                                {!! Form::select('move_to_form',listForms(),null,['class'=>' browser-default form-list','id'=>'input_','placeholder'=>'Select form'])!!}
                                                    {{__('forms.select_section')}}
                                                    
                                                {{-- {!! Form::select('move_to_section',[] , null,['class'=>' browser-default section-list ','id'=>'input_','placeholder'=>'Select form'])!!} --}}
                                                <input type="hidden" name="field_id">
                                                <select name="move_to_section" class="browser-default section-list">
                                                    <option>{{__('forms.select_section')}}</option>
                                                </select>
                                                 {!! FormGenerator::GenerateField('want_to') !!}
                                                  
                                            </div>

                                            <script type="text/javascript">
                                                $(document).unbind("change").on('change','.form-list',function(e){
                                                    e.stopPropagation();
                                                    var formId = $(this).val();
                                                    $.ajax({
                                                        url:route()+'/section',
                                                        type:'post',
                                                        data:{_token:$('input[name=_token]').val(),formId:formId},
                                                        success:function(res){
                                                             $('#section_name').remove();
                                                            $.each(res,function(i,v){
                                                               
                                                                $('.section-list').append('<option id="section_name" value="'+i+'">'+v+'</option>');
                                                            });
                                                        }
                                                    });
                                                });
                                                $(document).unbind('click').on('click','.field_move',function(){
                                                    var field_id = $(this).attr('field_id');
                                                    $('input[name=field_id]').val(field_id);
                                                });
                                            </script>
                                            <div class="modal-footer">
                                                <button class="btn blue " type="submit" name="action">{{__('forms.proceed')}}
                                                </button>
                                            </div>
                                            {!! Form::close() !!}  
                                        </div>
                                        <script type="text/javascript">
                                            $('#sections-list').modal({
                                                 dismissible: true
                                            });
                                        </script>
                                    </li>
                                @endforeach
                            @else
                                <div class="aione-message warning">
                                    {{ __('forms.no_fields_available') }}
                                </div>
                            @endif
                        @endif
                    </ul>
                @endif
                @if(Session::has('null_order'))
                    <script type="text/javascript">
                        $(document).ready(function(){
                            Materialize.toast({{ Session::get('null_order') }} ,6000);
                        });
                    </script>
                @endif
                @if(Request::has('field') && Request::input('field') != '')
                    
                    @include('admin.formbuilder._field',['sections'=>$sections])
                    {{-- @if($form->type == 'survey')
                        @include('admin.formbuilder._fields_survey')
                    @else
                        @include('admin.formbuilder._field',['sections'=>$sections])
                    @endif --}}
                @endif
            </div>

            <div style="clear: both;padding:20px">

            </div>
            
        </div>
    @endif
    <style type="text/css">
        .permission{
            font-size: 20px;
            font-weight: 500;
            color: #999;
        }
        .access-denied{
            font-size: 40px;
            font-weight: 200;
        }
        .module-wrapper > .list-container{
            float: left;
            width: 25%;
            border: 1px solid #e8e8e8;
            height: 100%;
            padding: 10px;
        }
        .module-wrapper > .Detail-container{
            float: right;
            width: 100%;
           /* border: 1px solid #e8e8e8;
            padding: 10px;*/
           
        }
          .module-wrapper.sidebar-active > .Detail-container{
            
            width: 74%;
                       
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
                padding: 15px;
                border: 1px solid #e8e8e8;
                margin: 0;
        }
        .Detail-container .collection .collection-item{
            border: 1px solid #e8e8e8;
               margin-bottom: 10px;
            position: relative;
                padding: 10px;
        }
        .Detail-container .collection .collection-item:last-child{
            margin-bottom: 0px
        }
         .Detail-container .collection .collection-item a{
            color: #666;
         }
        .Detail-container .collection .collection-item .item-options{
            display: inline-block;
            float: right;
        }
        .Detail-container .collection .collection-item .question-id{
            position: absolute;
            top: -15px;
            padding: 3px 22px;
            background-color: #e8e8e8;
            font-size: 13px;

        }
   
          .Detail-container .collection .collection-item .delete-field,
          .Detail-container .collection .collection-item .arrow-upward,
          .Detail-container .collection .collection-item .arrow-downward,
          .Detail-container .collection .collection-item .move{
            float: right;
            font-size: 16px;
            color: #757575;
            cursor: pointer;
            display: none
         }
         .Detail-container .collection .collection-item:hover .delete-field,
         .Detail-container .collection .collection-item:hover .arrow-upward,
         .Detail-container .collection .collection-item:hover .arrow-downward,
         .Detail-container .collection .collection-item:hover .move{
            display: block;
         }
         .Detail-container .collection .collection-item:first-child:hover .arrow-upward{
            display: none
         }
         .Detail-container .collection .collection-item:last-child:hover .arrow-downward{
            display: none
         }
         .subtitle{
                
   
            font-weight: 500;
            display: inline-block;

         }
        /*.add-section > button {
            float: right;
        }
        .add-section > span{
            float: right;
            width: 200px
        }*/
       /* .add-section .add-field-form > div,
        .add-section .add-field-form > button{
            float: left;
            width: 23%;
            margin: 0px 10px 0px 0px;
        }*/

    </style>
 
    <script type="text/javascript">

        $(document).on('click','.confirm-delete',function(e){
            e.preventDefault();
            var href = $(this).attr("href");
            swal({   
                title: '{{__('forms.delete_swal_title')}}',   
                text: '{{__('forms.delete_swal_text')}}',   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: '{{__('forms.delete_swal_confirm_button_text')}}',   
                closeOnConfirm: false 
            }, 
            function(){
                window.location = href;
               swal('{{__('forms.deleted')}}', '{{__('forms.delete_swal_success_text')}}', '{{__('forms.success')}}'); 
           });
        })

        $('#sortable-fields').sortable({
            stop: function(){
                if($(this).find('li').attr('section_id')){
                    var ids = [];
                    $('#sortable-fields > .section_id').each(function(){
                        if($(this).attr('section_id') != undefined){
                            ids.push($(this).attr('section_id'));
                        }
                    });
                    $.ajax({
                        url : route()+'/section/sort',
                        type : 'post',
                        data : {id : ids , _token : $('input[name=_token]').val() },
                        success : function(){
                            Materialize.toast('{{__('forms.sorted_successfully')}}',4000);
                        }
                    });
               }else{
                    var field_order = [];
                    $('#sortable-fields > .field_id').each(function(){
                        if($(this).attr('field_id') != undefined){
                            field_order.push($(this).attr('field_id'));
                        }
                    });
                    $.ajax({
                        url : route()+'/field/sort',
                        type : 'get',
                        data : {data : field_order , _token : $('input[name=_token]').val() },
                        success : function(){
                            Materialize.toast('{{__('forms.sorted_successfully')}}',4000);
                        }
                    });
               }
            }
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

            // $('.input1').iconpicker(".input1");

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
       

        $( function() {
            $( "#sortable" ).sortable({
                axis: "y",
                items: "li:not(.unsortable)",
                update : function(){
                    var ids = [];
                    $('#sortable > li').each(function(){
                        if($(this).attr('section-id') != undefined){
                            ids.push($(this).attr('section-id'));
                        }
                    });
                    console.log(ids);
                    $.ajax({
                        url : route()+'/section/sort',
                        type : 'post',
                        data : {id : ids , _token : $('input[name=_token]').val() },
                        success : function(){

                        }
                    })
                }
            });
            $( "#sortable" ).disableSelection();
        });
        $(document).on('click','.move',function(){
            $('input[name=sectionId]').val($(this).attr('section-id'));
        });
        $(document).on('click','.arrow-downward',function(){
            var field_id = $(this).parents('.collection-item').attr('field-id');
            $.ajax({
                url : route()+'/field/sort',
                type : 'post',
                data : {field_id : field_id , _token : $('input[name=_token]').val()},
                success : function(res){

                }
            });
        });
    </script>
@endsection