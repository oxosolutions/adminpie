@extends('layouts.main')
@section('content')
@php

if(!empty($filled_data)){
  if(isset($filled_data['module'])){
    $moduleFilled = $filled_data['module']->keyBy('permisson_id')->toArray();
    $submoduleFilled = $filled_data['submodule']->keyBy('permisson_id')->toArray();
    $routeFilled = $filled_data['route']->keyBy('permisson_id')->toArray();
  }
  if(isset($filled_data['widget'])){
    $widgetFilled = $filled_data['widget']->keyBy('permisson_id')->toArray();
  }
}

$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'no',
  'show_navigation' => 'yes',
  'page_title' => 'Role Permissions <span>'.$role_data[0]['name'].'</span>',
  'add_new' => ''
); 

@endphp
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
  @include('common.page_content_primary_start')

  {{-- <div id="page_role_permissions" class="page-role-permissions">
    {!! Form::open(['route'=>'save.role_permisson'])!!}
    <input type="hidden" name="role_id" value="{{$role_data[0]['id']}}">
    
    <div class="ar">
        <div class="ac s100 m100 l100 pb-15">
          <div class="aione-widget aione-border bg-grey bg-lighten-5">
            <div class="aione-title">
              <h5 class="font-weight-400 aione-border-bottom m-0 p-10 white bg-blue-grey bg-darken-4">
                Widget Permissions<span class="aione-float-right">Status</span>
              </h5>
            </div>
            @foreach($widget as $widgetKey =>$widgetVal)
              <input type="hidden" name="widget[{{$widgetVal->id}}][permisson_type]" value="widget">
              <input type="hidden" name="widget[{{$widgetVal->id}}][permisson_id]" value="{{$widgetVal->id}}" >
              <div class="aione-border-bottom blue-grey darken-2">
                <label class="display-inline-block pv-15 ph-10" for="filled-in-box_{{$loop->iteration}}">{{$widgetVal->title}}</label>
                <span class="aione-float-right display-inline-block p-10">
                  @if(!empty($widgetFilled[$widgetVal->id]['permisson']) && $widgetFilled[$widgetVal->id]['permisson']=='on' )
                  <input checked="checked" name='widget[{{$widgetVal->id}}][permisson]' type="checkbox" class="filled-in" id="filled-in-box_{{$loop->iteration}}"  />
                  @else
                  <input name='widget[{{$widgetVal->id}}][permisson]' type="checkbox" class="filled-in" id="filled-in-box_{{$loop->iteration}}"  />
                  @endif
                </span>
              </div>
            @endforeach
            <div class="aione-border-top bg-grey bg-lighten-4">
            {!! Form::submit('Save Widget Permissions', ['class' => 'aione-button ']) !!}
            </div>
          </div>
        </div>
    </div>
    {!!Form::close() !!}
  </div>

 --}}


  {{-- <div class="row">



    <div class="card section-1"  style="margin: 0px;margin-bottom: 14px">
      {!! Form::open(['route'=>'save.role_permisson'])!!}
        <input type="hidden" name="role_id" value="{{$role_data[0]['id']}}">

        <ul style="margin: 0px">
            <li>
               <div class="row" style="background-color: #24425C;padding: 15px 10px;color: white;font-weight: bold">
                   <div class="col l10">Widgets</div>
                   <div class="col l2 center-align">Permisson</div>
               </div> 
            </li>
          @foreach($widget as $widgetKey =>$widgetVal)

            <li>
                <div class="row" style="padding: 15px 10px">
                  <div class="col l10 " style="text-transform: capitalize;">
                    {{$widgetVal->title}}
                  </div>
                  <div class="col l2 center-align">
                  <input type="hidden" name="widget[{{$widgetVal->id}}][permisson_type]" value="widget">
                  <input type="hidden" name="widget[{{$widgetVal->id}}][permisson_id]" value="{{$widgetVal->id}}" >
                  @if(!empty($widgetFilled[$widgetVal->id]['permisson']) && $widgetFilled[$widgetVal->id]['permisson']=='on' )
                      <input checked="checked" name='widget[{{$widgetVal->id}}][permisson]' type="checkbox" class="filled-in" id="filled-in-box_{{$loop->iteration}}"  />
                      <label for="filled-in-box_{{$loop->iteration}}"></label>
                  @else
                    <input name='widget[{{$widgetVal->id}}][permisson]' type="checkbox" class="filled-in" id="filled-in-box_{{$loop->iteration}}"  />
                    <label for="filled-in-box_{{$loop->iteration}}"></label>
                  @endif
                  </div> 
                </div>
            </li>
            <div class="divider"></div>
          @endforeach
        </ul>
        {!! Form::submit('Save Widget Permisson', ['class' => 'btn btn-primary blue','style' => 'margin:14px;float:right']) !!}
        <div style="clear: both">
            
        </div>
      {!!Form::close() !!}

    </div>

    <div class="card" id="assign_role" style="margin: 0px;margin-bottom: 14px">
      {!! Form::open(['route'=>'save.role_permisson'])!!}
        <input type="hidden" name="role_id" value="{{$role_data[0]['id']}}">
        <ul style="margin: 0px" class="collapsible" data-collapsible="accordion">
            <li>
               <div class="row" style="background-color: #24425C;padding: 15px 10px;color: white;font-weight: bold">
                   <div class="col l3">Modules</div>
                   <div class="col l3">Sub-Module</div>
                   <div class="col l3">Route</div>
                   <div class="col l2">Permission</div>
              </div> 
            </li>
     
       @foreach($module_data as $moduleKey => $moduleVal)
        <li>
        
            <div class="col l12 collapsible-header" style="padding: 3px 0px">
                 {{$moduleVal->name}}
                <input type="hidden" name="moduleRoute[{{$moduleVal->id}}][permisson_type]" value="module">
                <input type="hidden" name="moduleRoute[{{$moduleVal->id}}][permisson_id]" value="{{$moduleVal->id}}">
               
                @if(!empty($moduleFilled[$moduleVal->id]['permisson']))
                
                    <input checked="checked" name='moduleRoute[{{$moduleVal->id}}][permisson]' type="checkbox" class="filled-in checkAll" id="filled-in-box-module{{$loop->iteration}}" />
                @else
                    <input  name='moduleRoute[{{$moduleVal->id}}][permisson]' type="checkbox" class="filled-in checkAll" id="filled-in-box-module{{$loop->iteration}}"  />
                @endif
                <label for="filled-in-box-module{{$loop->iteration}}" style="margin-left: 20px;float: left"></label>
                <i class="material-icons" style="float: right;margin-right: 6px">expand_less</i>     
                <div style="clear: both"></div>
            </div>
            <div class="collapsible-body">
              @foreach($moduleVal['subModule'] as $subModuleKey =>$subModuleVal)
                <div class="col l9 offset-l3"  style="padding: 10px"> {{$subModuleVal->name}} 
                @if(!empty($subModuleVal->sub_module_route))
                    <input type="hidden" name="subModuleRoute[{{$subModuleVal->id}}][permisson_type]" value="submodule">
                    <input type="hidden" name="subModuleRoute[{{$subModuleVal->id}}][permisson_id]" value="{{$subModuleVal->id}}">
                   @if(!empty($submoduleFilled[$subModuleVal->id]['permisson']))
                      <input checked="checked" name='subModuleRoute[{{$subModuleVal->id}}][permisson]' type="checkbox" class="filled-in" id="filled-in-box-sub-module{{$subModuleVal->id}}"  />
                    @else
                     <input  name='subModuleRoute[{{$subModuleVal->id}}][permisson]' type="checkbox" class="filled-in" id="filled-in-box-sub-module{{$subModuleVal->id}}"  />
                    @endif
                    <label for="filled-in-box-sub-module{{$subModuleVal->id}}" style="float: right"></label>
                  @endif
              </div>
                    

              @foreach($subModuleVal['moduleRoute'] as $routeKey => $routeVal)
                
                  <div class="col l6 offset-l6"  style="padding:10px" > {{$routeVal->route_name}} 
                    @if(!empty($subModuleVal->sub_module_route))
                        <input type="hidden" name="subModuleMultiRoute[{{$routeVal->id}}][permisson_type]" value="route">
                        <input type="hidden" name="subModuleMultiRoute[{{$routeVal->id}}][permisson_id]" value="{{$routeVal->id}}">
                       @if(!empty($routeFilled[$routeVal->id]['permisson']))
                        <input checked="checked" name='subModuleMultiRoute[{{$routeVal->id}}][permisson]' type="checkbox" class="filled-in" id="filled-in-box-sub-module-multi-{{str_slug($routeVal->route_name)}}-{{$loop->iteration}}"  />
                        @else
                            <input  name='subModuleMultiRoute[{{$routeVal->id}}][permisson]' type="checkbox" class="filled-in" id="filled-in-box-sub-module-multi-{{str_slug($routeVal->route_name)}}-{{$loop->iteration}}"  />
                        @endif
                        <label for="filled-in-box-sub-module-multi-{{str_slug($routeVal->route_name)}}-{{$loop->iteration}}" style="float: right"></label>
                    @endif
                  </div>
              @endforeach
              
                
              @endforeach 
              <div style="clear: both"></div>
            </div>
              
          </li>
          <div style="clear: both"></div>
        @endforeach
      </ul>
                      {!! Form::submit('Save Role Permisson', ['class' => 'btn btn-primary blue','style' => 'margin:14px;float:right']) !!}
                      <div style="clear: both"></div>
        {!! Form::close() !!}

    </div>
  </div>

 --}}

    <div class="ar">
        <div class="ac l70">

            <div class="aione-border p-10">
                {!! Form::open(['route'=>'save.role_permisson'])!!}
                <input type="hidden" name="role_id" value="{{$role_data[0]['id']}}">
                <h5 class="aione-border-bottom mb-10 pb-10">Role Permissions</h5>
                <div class="aione-collapsible">
                    @foreach($module_data as $moduleKey => $moduleVal)  
                    <input type="hidden" name="moduleRoute[{{$moduleVal->id}}][permisson_type]" value="module">
                    <input type="hidden" name="moduleRoute[{{$moduleVal->id}}][permisson_id]" value="{{$moduleVal->id}}">
                    <div class="aione-item">
                        <div class="aione-item-header">
                            {{@$moduleVal->name}}
                        </div>
                        <div class="aione-item-content p-10">
                          <div class="aione-border p-15 mb-10 bg-grey bg-lighten-4 module-permissions">
                            <label class="light-blue darken-2" For="filled-in-box-module{{$loop->iteration}}">{{@$moduleVal->name}}</label>
                            @if(!empty($moduleFilled[$moduleVal->id]['permisson']))
                                <input checked="checked" name='moduleRoute[{{$moduleVal->id}}][permisson]' type="checkbox" class="filled-in checkAll aione-float-right" id="filled-in-box-module{{$loop->iteration}}" />
                            @else
                                <input  name='moduleRoute[{{$moduleVal->id}}][permisson]' type="checkbox" class="filled-in checkAll aione-float-right" id="filled-in-box-module{{$loop->iteration}}"  />
                            @endif
                          </div>

                            <ul>
                                @foreach($moduleVal['subModule'] as $subModuleKey =>$subModuleVal)
                                <li class="aione-border mb-10">
                                    <div class="aione-border-bottom p-10 ">
                                        <div class="ar">
                                            <div class="ac l90">
                                                 <label for="filled-in-box-sub-module{{$subModuleVal->id}}">{{$subModuleVal->name}}</label>      
                                            </div>
                                            <div class="ac l10">
                                                @if(!empty($subModuleVal->sub_module_route))
                                                    <input type="hidden" name="subModuleRoute[{{$subModuleVal->id}}][permisson_type]" value="submodule">
                                                    <input type="hidden" name="subModuleRoute[{{$subModuleVal->id}}][permisson_id]" value="{{$subModuleVal->id}}">
                                                    @if(!empty($submoduleFilled[$subModuleVal->id]['permisson']))
                                                        <input checked="checked" name='subModuleRoute[{{$subModuleVal->id}}][permisson]' type="checkbox" class="filled-in aione-float-right" id="filled-in-box-sub-module{{$subModuleVal->id}}"  />
                                                    @else
                                                        <input  name='subModuleRoute[{{$subModuleVal->id}}][permisson]' type="checkbox" class="filled-in aione-float-right" id="filled-in-box-sub-module{{$subModuleVal->id}}"  />
                                                    @endif
                                                    <label for="filled-in-box-sub-module{{$subModuleVal->id}}" style="float: right"></label>
                                                @endif        
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="">
                                        @foreach($subModuleVal['moduleRoute'] as $routeKey => $routeVal)
                                         <div class="aione-border p-10 m-10 mb-5 widget-checkbox-label">
                                            <div class="ar">
                                                <div class="ac l90">
                                                     <label for="filled-in-box-sub-module-multi-{{str_slug($routeVal->route_name)}}-{{$loop->iteration}}"> {{$routeVal->route_name}}</label>      
                                                </div>
                                                <div class="ac l10">
                                                    @if(!empty($subModuleVal->sub_module_route))
                                                        <input type="hidden" name="subModuleMultiRoute[{{$routeVal->id}}][permisson_type]" value="route">
                                                        <input type="hidden" name="subModuleMultiRoute[{{$routeVal->id}}][permisson_id]" value="{{$routeVal->id}}">
                                                        @if(!empty($routeFilled[$routeVal->id]['permisson']))
                                                            <input checked="checked" name='subModuleMultiRoute[{{$routeVal->id}}][permisson]' type="checkbox" class="filled-in aione-float-right" id="filled-in-box-sub-module-multi-{{str_slug($routeVal->route_name)}}-{{$loop->iteration}}"  />
                                                        @else
                                                            <input  name='subModuleMultiRoute[{{$routeVal->id}}][permisson]' type="checkbox" class="filled-in aione-float-right" id="filled-in-box-sub-module-multi-{{str_slug($routeVal->route_name)}}-{{$loop->iteration}}"  />
                                                        @endif
                                                        <label for="filled-in-box-sub-module-multi-{{str_slug($routeVal->route_name)}}-{{$loop->iteration}}" style="float: right"></label>
                                                    @endif  
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                        @endforeach 
                                    </div>  
                                        
                                </li>
                               
                                @endforeach 
                            </ul>
                        </div>
                    </div>
                    @endforeach 
                </div>   
                {!! Form::submit('Save Role Permisson') !!}
                {!! Form::close() !!}
            </div>
        </div>
        <div class="ac l30">
            <div class="aione-border p-10 mb-10">
                {!! Form::open(['route'=>'save.role_permisson'])!!}
                    <input type="hidden" name="role_id" value="{{$role_data[0]['id']}}">
                    <h5 class="aione-border-bottom mb-10 pb-10">Widget Permissions</h5>
                    <ul>
                        @foreach($widget as $widgetKey =>$widgetVal)
                            <input type="hidden" name="widget[{{$widgetVal->id}}][permisson_type]" value="widget">
                            <input type="hidden" name="widget[{{$widgetVal->id}}][permisson_id]" value="{{$widgetVal->id}}" >
                            <li class="aione-border-bottom p-10 mb-10 widget-checkbox-label">
                                
                                <div class="ar">
                                    <div class="ac l90">
                                         <label For="check_{{$loop->iteration}}">{{$widgetVal->title}}</label>      
                                    </div>
                                    <div class="ac l10">
                                        @if(!empty($widgetFilled[$widgetVal->id]['permisson']) && $widgetFilled[$widgetVal->id]['permisson']=='on' )
                                            <input checked="checked" id="check_{{$loop->iteration}}" name='widget[{{$widgetVal->id}}][permisson]' type="checkbox" name="" class="aione-float-right ">    
                                        @else
                                            <input id="check_{{$loop->iteration}}" type="checkbox" name='widget[{{$widgetVal->id}}][permisson]' class="aione-float-right "> 
                                        @endif    
                                    </div>
                                    
                                </div>
                            </li>
                        @endforeach
                            
                    </ul>
                     {!! Form::submit('Save Widget Permissions', ['class' => 'aione-button ']) !!}
                {!!Form::close() !!}
            </div>
        </div>
    </div>
    
   
  
  @include('common.page_content_primary_end')
  @include('common.page_content_secondry_start')

<script type="text/javascript">
$('.module-permissions .checkAll').on('click',function(){
    if($(this).is(':checked')){
      $(this).parent().parent().find('input[type="checkbox"]').prop('checked','checked');
    }else{        
      $(this).parent().parent().find('input[type="checkbox"]').prop('checked','');
    }
});
</script>








  @include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection