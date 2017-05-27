@extends('layouts.main')

@section('content')
<div class="card" style="padding: 10px;margin-top: 0px;">
    Permissions For:<strong>{{$role_data[0]['name']}}</strong>
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
                  {{dump(12)}}
                    <input type="hidden" name="module[{{$moduleKey}}][module_id]" value="{{$moduleVal->id}}">
                    <input type="hidden" name="module[{{$moduleKey}}][role_id]" value="{{$role_data[0]['id']}}">
                       @if($routeVal['route_for']=='read') 
                        <div class="col l2 center-align">
                           <input name='module[{{$moduleKey}}][read]' type="checkbox" class="filled-in" id="filled-in-box_{{$routeKey}}"  />
                            <label for="filled-in-box"></label>
                        </div>
                      @endif
                   @if($routeVal['route_for']=='write') 
                    <div class="col l2 center-align">
                           <input name='module[{{$moduleKey}}][write]' type="checkbox" class="filled-in" id="filled-in-box"  />
                          <label for="filled-in-box1"></label>
                      </div>
                       @else
                         <input name='module[{{$moduleKey}}][write]' type="hidden" class="filled-in" id="filled-in-box1" value="null" />

                    @endif
                   @if($routeVal['route_for']=='delete') 
                          <div class="col l2 center-align">
                          <input name="" type="checkbox" class="filled-in" id="filled-in-box2"  />
                          <label for="filled-in-box2"></label>
                      </div>
                      @else
                    @endif
                     @if($routeVal['route_for']=='other') 
                          <div class="col l2 center-align">
                          <input type="checkbox" class="filled-in" id="filled-in-box3" checked="checked" />
                          <label for="filled-in-box3"></label>
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