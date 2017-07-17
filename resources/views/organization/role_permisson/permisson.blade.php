@extends('layouts.main')

@section('content')
 @php
      if(!empty($filled_data))
          {
              if(isset($filled_data['module'])){
                $moduleFilled = $filled_data['module']->keyBy('permisson_id')->toArray();
                $submoduleFilled = $filled_data['submodule']->keyBy('permisson_id')->toArray();
                $routeFilled = $filled_data['route']->keyBy('permisson_id')->toArray();
              }
               if(isset($filled_data['widget'])){
                $widgetFilled = $filled_data['widget']->keyBy('permisson_id')->toArray();

               }
          }
    @endphp

<div class="row">

    <div class="card" style="padding: 10px;margin-top: 0px;margin-bottom: 14px">
        <h5>Permissions for:<strong>{{$role_data[0]['name']}} </strong></h5>
    </div>


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
                {{-- <input type="hidden" name="moduleRoute[{{$moduleVal->id}}][permisson]" value="Null"> --}}
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
<style type="text/css">
    #assign_role >  ul > li:first-child{
        background-color: #24425C;
        color: white;       
        font-weight: bold;
    }
    #assign_role >  ul > li{
         padding: 15px 10px;
    }
    .collapsible [type="checkbox"].filled-in:not(:checked)+label:after{
        top:50% !important;
    }
    .collapsible [type="checkbox"].filled-in:checked+label:before{
        top:50% !important;
    }
    .collapsible [type="checkbox"].filled-in:checked+label:after{
        top:50% !important;
    }
     .collapsible li.active i {
      
      transform: rotate(180deg);
    }
    .page-content{
            padding-top: 118px;
    }
    .section-1 [type="checkbox"]+label{
        height: 15px !important;
    }
    .collapsible{
        border: none;
        box-shadow: none;
    }
</style>
<script type="text/javascript">
$('.checkAll').on('click',function(){
    if($(this).is(':checked')){
        $(this).parents('.collapsible-header').siblings().find('input[type="checkbox"]').prop('checked','checked');
        }else{        
             $(this).parents('.collapsible-header').siblings().find('input[type="checkbox"]').prop('checked','');
    }
});
</script>
@endsection