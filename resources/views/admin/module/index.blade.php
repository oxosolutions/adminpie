@extends('admin.layouts.main')
@section('content')
@php
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'no',
  'show_navigation' => 'yes',
  'page_title' => 'Modules',
  'add_new' => '+ Add Module'
); 
@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
    <div class="module-wrapper" >
        @php
        $permission['permission']= [];
        $index = 0;
        if(@$moduleData != null){
            foreach(@$moduleData->subModule as $key => $submodule){
                foreach(@$submodule->moduleRoute as $routeKey => $route){

                    $permission['permission'][$index]['routes'] = $route->route;
                    $permission['permission'][$index]['route_name'] = $route->route_name;
                    $index++;
                }
            }
        }
        @endphp
        @include('admin.module._sidebar')
        <div class="Detail-container">
			<!-- http://admin.adminpie.com/modules/{id} -->
	        @if(@$subModuleData == null)
              
                @if(@$moduleData != null)
                 	{!! Form::model($moduleData,['route' => 'edit.module' , 'method' => 'post'])!!}
                @else
                    {!! Form::open(['route' => 'edit.module' , 'method' => 'post'])!!}
                @endif
                @if(@$moduleData != null)
	                    <div id="" class="aione-tabs-wrapper">
	                        <nav class="aione-nav aione-nav-horizontal">
	                            <ul class="aione-tabs">
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
	                           
	                            </ul>
	                        </nav>
	                        <div class="aione-tabs-content-wrapper">
	                            <div id="aione_modules_settings" class="aione-tab-content active">
	                                <div class="row">
	                               
	                                    {!! Form::hidden('color', @$moduleData->color ,['class' => 'color_picker']) !!}

	                                    {!! Form::hidden('icon', @$moduleData->icon,['class' => 'font-awesome-text']) !!}                     

	                                    <input type="hidden" name="modules_id" value="{{@request()->route()->parameters()['id']}}">              
	                                    {!! FormGenerator::GenerateForm('module_setting_form') !!}
	                                </div>
	                            </div>
	                            <div id="aione_modules_custom_css" class="aione-tab-content">
	                              
	                                {!! FormGenerator::GenerateForm('custom_code') !!}
	                              
	                            </div>
	                           
	                       
	                            <div class="clear"></div>
	                        </div>

	                    </div>
               		{!! Form::close() !!}
                    {!! Form::open(['route' => 'sub.module.save' , 'method' => 'post'])!!}
                        <input type="hidden" name="module_id" value="{{ @request()->route()->parameters()['id'] }}">
                        {!! FormGenerator::GenerateForm('add_submodule_form') !!}
                    {!! Form::close() !!}
                        @endif
                

                <ul class="collection">
                    @if(@$moduleData->subModule != null)
                    @foreach($moduleData->subModule as $key=>$value)
                        <li class="collection-item">
                            <a href="{{ route('list.module',['id'=>@request()->route()->parameters()['id'],'subModule'=>$value->id]) }}">{{$value->name}}</a>
                            <a href="{{ route('subModule.delete',['id'=>$value->id]) }}" class="secondary-content delete-submodule">
                                <i class="arrow-delete material-icons dp48">delete</i>
                            </a>
                           
                            <a href="{{route('sub.module.sort.down',['subModule'=>$value->id,'id'=> @request()->route()->parameters()['id']]) }}" class="secondary-content">
                                <i class="arrow-downward material-icons dp48">arrow_downward</i>
                            </a>
                            <a href="{{route('sub.module.sort.up',['subModule'=>$value->id,'id'=> @request()->route()->parameters()['id']]) }}" class="secondary-content">
                                <i class="arrow-upward material-icons dp48">arrow_upward</i>
                            </a>

                        </li>
                    @endforeach
                    @endif
                </ul>
                    
		        
			@endif
			<!-- http://admin.adminpie.com/modules/{id}/{submodule} -->
            @if(@$subModuleData != null)
               
                <div id="" class="aione-tabs-wrapper">
                    <nav class="aione-nav aione-nav-horizontal">
                        <ul class="aione-tabs">
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
                            <li class="aione-tab ">
                                <a href="#aione_modules_permissions">
                                    <span class="nav-item-text">Permissions</span>
                                </a>
                            </li>
                          
                        </ul>
                    </nav>
                    <div class="aione-tabs-content-wrapper">
                        
                        <div id="aione_modules_settings" class="aione-tab-content active">
                         
                           {!! Form::model($subModuleData,['route' => 'save.style.module' , 'method' => 'post'])!!}
                                <div class="row">
                                 
                                    <input type="hidden" name="sub_modules_id" value="{{@request()->route()->parameters()['subModule']}}">  
                                    {!! FormGenerator::GenerateSection('submodule_settings') !!}
                                  
                                </div>
                           
                             {!! Form::close() !!}    
                          
                        </div>
                        <div id="aione_modules_custom_css" class="aione-tab-content">
	                        {!! Form::model($subModuleData,['route' => 'save.style.module' , 'method' => 'post'])!!}  
                                <input type="hidden" name="sub_modules_id" value="{{@request()->route()->parameters()['subModule']}}">      
							    {!! FormGenerator::GenerateForm('custom_code') !!}
	                        {!! Form::close() !!}       
					    </div>
	                    
                        <div id="aione_modules_permissions" class="aione-tab-content">
                                  
                            <!-- permission div starts -->
                           {{--  <div class="sub-div">
                                <div class="row">
                                    <div class="col l6">
                                        Routes For Permission
                                    </div>
                                    <div class="col l6 right-align">
                                        <a href="" class="btn green add-route-permission">add</a>
                                    </div>
                                </div>
                                {!! Form::open(['route' => 'edit.subModule','method' => 'POST'])!!}
                                @foreach($moduleData->subModule as $key => $submodule)
                                    @if($submodule->id == @request()->route()->parameters()['subModule'])
                                        <div class="repeat_route_permission">
                                            @foreach($submodule->moduleRoute as $routeKey => $route)
                                                <div class="row repeat-sub-row">
                                                    <div class="col s12 m2 l12 aione-field-wrapper" style="border: 1px solid #e8e8e8;padding: 14px; margin-top: 1%;">
                                                        <div class="row valign-wrapper">
                                                            <div class="col l5 pr-7">
                                                                <label>Route name</label>
                                                                <input type="hidden" name="subModule_id" value="{{@request()->route()->parameters()['subModule']}}" placeholder="Enter route name" />
                                                                <input type="text" name="route_name[]" value="{{$route->route_name}}" placeholder="Enter route name" />
                                                            </div>
                                                            <div class="col l6 pl-7 pr-7">
                                                                <label>Route</label>
                                                                {!!Form::select('routes[]',App\Model\Admin\GlobalModule::getRouteListArray(),$route->route, ['class'=>'form-control sel browser-default','placeholder'=>'url ']) !!}
                                                            </div>
                                                            <div class="col l1 pl-7">
                                                                <a href="{{route('delete.subModule.permission',['id' => $submodule->id , 'route_name' => $route->route_name])}}" class="delete-reoute-permission"><i class="fa fa-close"></i></a>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                   
                                                    <hr class="style2">
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                @endforeach
                                <input type="submit" value="save Permission">
                                {!!Form::close()!!}
                            </div> --}}
                            <!-- permission div ends -->
                            
                            <!--new permission div starts -->
                            @if($permission != null)
                                    {{ dump($permission) }}
                                {!! Form::model($permission,['route' => 'edit.subModule','method' => 'POST'])!!}
                            @else
                                {!! Form::open(['route' => 'edit.subModule','method' => 'POST'])!!}
                            @endif
                                    {!! Form::model(@$route,['route' => 'edit.subModule','method' => 'POST'])!!}

                                     <input type="hidden" name="subModule_id" value="{{@request()->route()->parameters()['subModule']}}" placeholder="Enter route name" />
                                        {!! FormGenerator::GenerateSection('permission',[],$permission) !!}
                                                
                                    <input type="submit" value="Save Permission">
                                {!!Form::close()!!}
                            <!--new permission div ends -->
                                  
                        </div>
                    </div>
                           
                </div>
            @endif

			
			<!-- http://admin.adminpie.com/modules -->
            @if(@$subModuleData == null && @$moduleData == null)
                {!! Form::open(['route' => 'module.save' , 'method' => 'post'])!!}
                 
                	{!! FormGenerator::GenerateForm('add_module_form') !!}
                {!! Form::close() !!}
                <ul class="collection">
                    @foreach($listModule as $key => $val)
                        <li class="collection-item" style="position: relative;">

                            <a href="{{route('list.module',['id'=>$val->id])}}">{{$val->name}}</a> 
                             <div style="display: inline-block;float: right;right: 140px;"> 
                                @if($val->status == 0)
                                    <a href="{{route('status.module',['id'=>$val->id])}}">Activate</a>
                                @else
                                    <a href="{{route('status.module',['id'=>$val->id])}}">Deactivate</a>
                                @endif
                                <label class="switch" for="input_">
                                    <span class="handle"></span>
                                </label>
                             </div>
                            <a href="{{ route('module.delete',['id'=>$val->id]) }}" class="secondary-content delete-module">
                                <i class="arrow-delete material-icons dp48">delete</i>
                            </a>
                            <script type="text/javascript">
                                $(document).on('click','.delete-module',function(e){
                                    e.preventDefault();
                                    var href = $(this).attr("href");
                                    swal({   
                                        title: "Are you sure?",   
                                        text: "You will not be able to recover this imaginary file!",   
                                        type: "warning",   
                                        showCancelButton: true,   
                                        confirmButtonColor: "#DD6B55",   
                                        confirmButtonText: "Yes, delete it!",   
                                        closeOnConfirm: false 
                                    }, 
                                    function(){
                                    window.location = href;
                                       swal("Deleted!", "Your Module has been deleted.", "success"); 
                                   });
                                })
                            </script>
                            <a href="{{route('module.sort.down',['id'=>$val->id]) }}" class="secondary-content">
                                <i class="arrow-downward material-icons dp48">arrow_downward</i>
                            </a>
                            <a href="{{ route('module.sort.up',['id'=>$val->id]) }}" class="secondary-content">     <i class="arrow-upward material-icons dp48">arrow_upward</i>
                            </a>
                           
                        </li>
                    @endforeach
                </ul>
			@endif
        </div>
        <div class="clear"></div>
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
        .Detail-container .secondary-content{
            margin-left: 14px;
        }
        .add-module > button {
            float: right;
        }
        .add-module > span{
            float: right;
            width: 200px
        }
        .collection .collection-item .material-icons{
            display: none
        }
         .collection .collection-item:hover .material-icons{
            display: block
        }
        .sp-replacer{
           border:none;
           background-color:transparent;
           padding:0;
           margin:0;
           display: block;
        }
        .sp-preview {
           width: 45px;
           height: 45px;
          
           overflow:hidden;
           border: none;
           margin-right: 0;
        }
        .sp-dd{
           display:none;
        }
    </style>
    <script type="text/javascript">
     $(document).ready(function () {

         $('body').on('click','.add-route-permission', function(e){
            var result = '<div class="row repeat-sub-row"> <div class="col s12 m2 l12 aione-field-wrapper" style="border: 1px solid #e8e8e8;padding: 14px; margin-top: 1%;"> <div class="row valign-wrapper"> <div class="col l5 pr-7"> <label>Route name</label><input type="hidden" name="subModule_id" value="{{@request()->route()->parameters()['subModule']}}" placeholder="Enter route name" /> <input type="text" name="route_name[]" value="" placeholder="Enter route name" /> </div> <div class="col l6 pl-7 pr-7"> <label>Route</label> {!!Form::select('routes[]',App\Model\Admin\GlobalModule::getRouteListArray(),null, ['class'=>'form-control sel browser-default','placeholder'=>'url ']) !!} </div> <div class="col l1 pl-7"> <a href="" class=" delete-reoute-permission"><i class="fa fa-close"></i></a> </div> </div> </div> <hr class="style2"> </div>';
            
            var elem = $(this);
            e.preventDefault();
            // $.ajax({
            //     url: route()+'single/route/permission',
            //     type: 'GET',
            //     data: {routeCount: elem.parents('.sub-div').find('input[name=submoduleNumber]').val()},
            //     success: function(result){
                    elem.parents('.sub-div').find('.repeat_route_permission').append(result);
                    $('select').material_select();
            //     } 
            // });
        });

        // $('.collection').on('click','.arrow-upward',function(e){
        //     var module_id = [];
        //       var sort_id = [];
        //     e.preventDefault();
        //     var current = $(this).parents('.collection-item');
        //     current.prev().before(current);
            
        //     $('.module_id').each(function($v){
        //         module_id.push($(this).val());
        //     });
        //     $('.ui-sortable-handle').each(function($v){
        //         sort_id.push($(this).attr('id'));
        //     });

        //     $.ajax({
        //         url: route()+'/sort/module',
        //         type: 'POST',
        //         data: {module_id : module_id , sort_id : sort_id  , _token : $('.shift_token').val()},
        //         success:function(){
        //           console.log()
        //         }
        //     });
        // });
        // $('.collection').on('click','.arrow-downward',function(e){
        //     var module_id = [];
        //       var sort_id = [];
        //     e.preventDefault();
        //     var current = $(this).parents('.collection-item');
        //     current.next().after(current);

        //     $('.module_id').each(function($v){
        //         module_id.push($(this).val());
        //     });
        //     $('.ui-sortable-handle').each(function($v){
        //         sort_id.push($(this).attr('id'));
        //     });

        //     $.ajax({
        //         url: route()+'/sort/module',
        //         type: 'POST',
        //         data: {module_id : module_id , sort_id : sort_id  , _token : $('.shift_token').val()},
        //         success:function(){
        //           console.log()
        //         }
        //     });
        // });
        
        $('.sortable').sortable({
            axis: 'y',
            items: "li:not(.unsortable)",
            update: function (event, ui) {
              var module_id = [];
              var sort_id = [];
              var data = $(this).sortable('serialize');

              $('.module_id').each(function($v){
                module_id.push($(this).val());
              });
              $('.ui-sortable-handle').each(function($v){
                sort_id.push($(this).attr('id'));
              });

              $.ajax({
                url: route()+'/sort/module',
                type: 'POST',
                data: {module_id : module_id , sort_id : sort_id  , _token : $('.shift_token').val()},
                success:function(){
                  console.log()
                }
            });
          }
        });

    });

        // $("#custom").spectrum({
        //     color: '#000',
        //     showAlpha: true,
        // });
        $("#custom").spectrum({
            color: "#168dc5",
            flat: false,
            showInput: true,
            showInitial: true,
            allowEmpty: true,
            showAlpha: true,
            disabled: false,
            localStorageKey: "save-color",
            showPalette: true,
            showPaletteOnly: false,
            togglePaletteOnly: true,
            showSelectionPalette: true,
            clickoutFiresChange: true,
            cancelText: "Cancel",
            chooseText: "Select",
            togglePaletteMoreText: "More",
            togglePaletteLessText: "Less",
            containerClassName: "Class1",
            replacerClassName: "Class2",
            preferredFormat: "Class3",
            maxSelectionSize: 5,
            palette: [
                ["#168dc5","#cc0000","#cc0000","#cc0000","#168dc5","#cc0000","#168dc5","#cc0000"],
                ["#168dc5","#cc0000","#cc0000","#cc0000","#168dc5","#cc0000","#168dc5","#cc0000"],
                ["#168dc5","#cc0000","#cc0000","#cc0000","#168dc5","#cc0000","#168dc5","#cc0000"],
                ["#168dc5","#cc0000","#cc0000","#cc0000","#168dc5","#cc0000","#168dc5","#cc0000"],
                ["#168dc5","#cc0000","#cc0000","#cc0000","#168dc5","#cc0000","#168dc5","#cc0000"] 
                ],
            selectionPalette: ['#168dc5']
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
       
    </script>
@endsection