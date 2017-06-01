@extends('layouts.main')

@section('content')
<div class="card" style="padding: 10px;margin-top: 0px;">
    Permissions For:<strong>{{$role_data[0]['name']}} </strong>
</div>


<div class="card"  style="margin: 0px">
{!! Form::open(['route'=>'save.widget_permission'])!!}

    <ul style="margin: 0px">
        <li>
           <div class="row" style="background-color: #24425C;padding: 15px 10px;color: white;font-weight: bold">
               <div class="col l4">Widgets</div>
               <div class="col l2 center-align">Permisson</div>
           </div> 
        </li>
      @foreach($widget as $widgetKey =>$widgetVal)

        <li>
            <div class="row" style="padding: 15px 10px">
              <div class="col l5">
                {{$widgetVal->title}}
              </div>
              <div class="col l7">
              <input type="hidden" name="widget[{{$widgetVal->id}}][role_id]" value="{{$role_data[0]['id']}}">
              <input type="hidden" name="widget[{{$widgetVal->id}}][widget_id]" value="{{$widgetVal->id}}" >
              @if(!empty($role_widget_data[$widgetVal->id]['permisson']) && $role_widget_data[$widgetVal->id]['permisson']=='on' )
                  <input checked="checked" name='widget[{{$widgetVal->id}}][permisson]' type="checkbox" class="filled-in" id="filled-in-box_{{$loop->iteration}}"  />
                  <label for="filled-in-box_{{$loop->iteration}}"></label>
              @else
                <input name='widget[{{$widgetVal->id}}][permisson]' type="checkbox" class="filled-in" id="filled-in-box_{{$loop->iteration}}"  />
                <label for="filled-in-box_{{$loop->iteration}}"></label>
              @endif
              </div> 
            </div>
        </li>
      @endforeach
  </ul>
    {!! Form::submit('Save Role Permisson', ['class' => 'btn btn-primary']) !!}
 {!!Form::close() !!}

 </div>

<div class="card" id="assign_role" style="margin: 0px">
{!! Form::open(['route'=>'save.role_permisson'])!!}
  
    <ul style="margin: 0px">
        <li>
           <div class="row" style="background-color: #24425C;padding: 15px 10px;color: white;font-weight: bold">
               <div class="col l4">Modules</div>
               <div class="col l2 center-align">Read</div>
               <div class="col l2 center-align">Write</div>
               <div class="col l2 center-align">Delete</div>

               <div class="col l2 center-align">Others</div>
               
           </div> 
        </li>

 @foreach($module_data as $moduleKey => $moduleVal)
    <li>
        <div class="row" style="padding: 15px 10px;">
            <div class="col l4">{{$moduleVal->name}}</div>
            @foreach($moduleVal['route'] as $routeKey =>$routeVal)
              <input type="hidden" name="module[{{$moduleKey}}][module_id]" value="{{$moduleVal->id}}">
              <input type="hidden" name="module[{{$moduleKey}}][role_id]" value="{{$role_data[0]['id']}}">
                 @if($routeVal['route_for']=='read') 
                  <div class="col l2 center-align">
                  @if(!empty($role_data_keys_module_id[$moduleVal->id]['read']) && $role_data_keys_module_id[$moduleVal->id]['read']=='on')
                    <input checked="checked" name='module[{{$moduleKey}}][read]' type="checkbox" class="filled-in" id="filled-in-box_{{$loop->parent->iteration}}_{{$loop->iteration}}"  />
                    <label for="filled-in-box_{{$loop->parent->iteration}}_{{$loop->iteration}}"></label>
                  @else
                     <input name='module[{{$moduleKey}}][read]' type="checkbox" class="filled-in" id="filled-in-box_{{$loop->parent->iteration}}_{{$loop->iteration}}"  />
                      <label for="filled-in-box_{{$loop->parent->iteration}}_{{$loop->iteration}}"></label>
                    @endif
                  </div>
                @endif
               @if($routeVal['route_for']=='write') 
                <div class="col l2 center-align">
                  @if(!empty($role_data_keys_module_id[$moduleVal->id]['write']) && $role_data_keys_module_id[$moduleVal->id]['write']=='on')
                     <input checked="checked" name='module[{{$moduleKey}}][write]' type="checkbox" class="filled-in" id="filled-in-box_{{$loop->parent->iteration}}_{{$loop->iteration}}"  />
                      <label for="filled-in-box_{{$loop->parent->iteration}}_{{$loop->iteration}}"></label>
                  @else
                     <input name='module[{{$moduleKey}}][write]' type="checkbox" class="filled-in" id="filled-in-box_{{$loop->parent->iteration}}_{{$loop->iteration}}"  />
                      <label for="filled-in-box_{{$loop->parent->iteration}}_{{$loop->iteration}}"></label>

                  @endif
                  </div>
                @endif
               @if($routeVal['route_for']=='delete') 
                      <div class="col l2 center-align">
                      @if(!empty($role_data_keys_module_id[$moduleVal->id]['delete']) && $role_data_keys_module_id[$moduleVal->id]['delete']=='on')
                        <input checked='checked' name="module[{{$moduleKey}}][delete]" type="checkbox" class="filled-in" id="filled-in-box_{{$loop->parent->iteration}}_{{$loop->iteration}}"  />
                        <label for="filled-in-box_{{$loop->parent->iteration}}_{{$loop->iteration}}"></label>
                      @else
                        <input name="module[{{$moduleKey}}][delete]" type="checkbox" class="filled-in" id="filled-in-box_{{$loop->parent->iteration}}_{{$loop->iteration}}"  />
                        <label for="filled-in-box_{{$loop->parent->iteration}}_{{$loop->iteration}}"></label>
                      @endif
                  </div>
                @endif
                @if($routeVal['route_for']=='other') 
                    <div class="col l2 center-align">
                    o<input type="checkbox" class="filled-in" id="filled-in-box_{{$loop->parent->iteration}}_{{$loop->iteration}}" checked="checked" />
                    <label for="filled-in-box_{{$loop->parent->iteration}}_{{$loop->iteration}}"></label>
                    </div>
                @endif
            @endforeach 
        </div>
    </li>
  @endforeach






       {{--  <li>
            <div class="row">
               <div class="col l6">Modules2</div>
               <div class="col l2 center-align">
                    <input type="checkbox" class="filled-in" id="filled-in-box3" checked="checked" />
                    <label for="filled-in-box3"></label>
               </div>
               <div class="col l2 center-align">
                    <input type="checkbox" class="filled-in" id="filled-in-box4" checked="checked" />
                    <label for="filled-in-box4"></label>
               </div>
                <div class="col l2 center-align">
                    <input type="checkbox" class="filled-in" id="filled-in-box5" checked="checked" />
                    <label for="filled-in-box5"></label>
               </div>
               
               
           </div>
        </li>
        <li>
            <div class="row">
               <div class="col l6">Modules3</div>
                <div class="col l2 center-align">
                    <input type="checkbox" class="filled-in" id="filled-in-box6" checked="checked" />
                    <label for="filled-in-box6"></label>
               </div>
               <div class="col l2 center-align">
                    <input type="checkbox" class="filled-in" id="filled-in-box7" checked="checked" />
                    <label for="filled-in-box7"></label>
               </div>
                <div class="col l2 center-align">
                    <input type="checkbox" class="filled-in" id="filled-in-box8" checked="checked" />
                    <label for="filled-in-box8"></label>
               </div>
               
           </div>
        </li>
        <li>
            <div class="row">
               <div class="col l6">Modules4</div>
                <div class="col l2 center-align">
                    <input type="checkbox" class="filled-in" id="filled-in-box9" checked="checked" />
                    <label for="filled-in-box9"></label>
               </div>
               <div class="col l2 center-align">
                    <input type="checkbox" class="filled-in" id="filled-in-box10" checked="checked" />
                    <label for="filled-in-box10"></label>
               </div>
                <div class="col l2 center-align">
                    <input type="checkbox" class="filled-in" id="filled-in-box11" checked="checked" />
                    <label for="filled-in-box11"></label>
               </div>
               
           </div>
        </li> --}}
    </ul>
                  {!! Form::submit('Save Role Permisson', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}

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
</style>
@endsection