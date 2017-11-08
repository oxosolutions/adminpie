@if($model != null || $model != "" || !empty($model))
    @php
        $team = [];
        $usersName = [];
        $index= 0;
    @endphp
    @if(@$model)
        @foreach($model as $key => $value)
        
        @php
            $assign = json_decode($value->assign_to);
            $teamData = App\Model\Organization\Team::getTeamById($assign->team);
            $prioritySelect = $value->priority;
            @endphp
        @endforeach
    @endif

    <style type="text/css">
        .display-none{
            display: none;
        }
    </style>
    <div class="progress">
      <div class="indeterminate"></div>
    </div>
    <div style="background-color: rgba(0, 0, 0, 0.5);height: 100vh;width: 100%;position: fixed;top: 0;left: 0;z-index: 99999;display: none;">
        <div class="preloader-wrapper active" style="position: relative;top: 50%;left: 50%">
            <div class="spinner-layer spinner-red-only">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>  
    </div> 
    <div class="col l12 main-div">
        <div class="card">
           <div class="input-field col s4">
                <select class="filter_priority">
                  <option value="" disabled selected>Priority Filter</option>
                  <option value="low">Low</option>
                  <option  value="medium">Medium</option>
                  <option  value="high">High</option>
                </select>
                <label>Priority Filter</label>
            </div>
                @if(array_key_exists('id',request()->route()->parameters()))
                    <div class="input-field col s4 ">
                        {!! Form::select('assign_to',App\Model\Organization\User::getEmployeesId(),null,["class"=>"no-margin-bottom aione-field Employee_filter" , 'placeholder'=>'Employee Filter'])!!}
                        <label>Employee Filter</label>
                      </div>
                @else

                @endif
              
                @if(array_key_exists('id',request()->route()->parameters()))

                @else
                    <div class="input-field col s4 ">
                    {!! Form::select('projects_list',App\Model\Organization\Project::projectList(),null,["class"=>"no-margin-bottom aione-field project_filter","placeholder"=>"Select Project"])!!}
                  </div>
                @endif
            <div>
                <div class="row">
                   
                    <div id="test1" class="col s12 p-15">
                        <div class="row">
                            <div class="task-list col l4 center-align" id="pending" style="border-bottom: 1px solid #e8e8e8;border-right: 1px solid #e8e8e8">
                                <h6>Pending <span style="float: right;padding: 5px 8px;background: red;border-radius: 100%;color: white;" class="pending-count"></span></h6> 
                            </div>
                            <div class="task-list col l4 center-align " id="inProgress" style="border-bottom: 1px solid #e8e8e8;border-right: 1px solid #e8e8e8">
                                <h6>In Progress <span style="float: right;padding: 5px 8px;background: blue;border-radius: 100%;color: white;" class="working-count"></span></h6>
                            </div>
                            <div class="task-list col l4 center-align" id="completed" style="border-bottom: 1px solid #e8e8e8;">
                                <h6>Completed <span style="float: right;padding: 5px 8px;background: green;border-radius: 100%;color: white;" class="complete-count"></span></h6>
                            </div>
                        </div>
                         
                        @if(@$model)
                            <div class="row task-font" >
                                <ul id="sortable1" status="pending" class="col l4 droptrue" style="min-height: 400px">
                                    @foreach(@$model as $key => $tasks)
                                        @if(@$tasks->status == 0) 
                                            <li class="ui-state-default col l12">
                                               <div class=" col l12 pr-7 pending" id="pending">    
                                                    <div class="card p-10" >
                                                        <div class="col l12 pl-5" >
                                                            <div class="row">
                                                                <div class="col l7">
                                                                    <h6 class="">{{$tasks->title}}</h6>
                                                                </div>
                                                                <div class="col l5" class="tooltipped" data-position="top" data-tooltip="I am tooltip">
                                                                    <div class="team "> 
                                                                    @php
                                                                        $count_team = count(json_decode($tasks->assign_to)->team);
                                                                    @endphp
                                                                        @foreach(@json_decode($tasks->assign_to)->team as $key => $value)
                                                                            @php
                                                                                $teamData = App\Model\Organization\Team::getTeamById($value);
                                                                            @endphp
                                                                                @foreach(@$teamData as $k => $teamVal) 
                                                                                    <div style="float: right;border: 1px solid #ededed;background-color: #ededed;border-radius: 100%;overflow: hidden;margin-right: 20px">
                                                                                        
                                                                                        <a style="display:block;padding: 8px 14px" href="{{ route('info.team',['id'=>$teamVal->id]) }}" class="tooltipped" data-position="top" data-tooltip="I am tooltip">
                                                                                             {{$teamVal->title[0]}}
                                                                                        </a>
                                                                                    </div>
                                                                                @endforeach
                                                                        @endforeach
                                            
                                                                        
                                                                    </div>
                                                                    <div class="{{($count_team == 1)?'display-none':''}}" style="position: absolute;right:8px;top: 18px">
                                                                        @php
                                                                           echo '+ '.($count_team - 1);
                                                                        @endphp
                                                                    </div>
                                                                </div>
                                                            </div>
                                                           
                                                        </div>
                                                        <div class="col l12 mt-10">
                                                            <div class=" col l3">
                                                                @if($tasks->priority == 'low')
                                                                    <i class="fa fa-circle-o blue-text" aria-hidden="true"></i>
                                                                @elseif($tasks->priority == "medium")
                                                                    <i class="fa fa-circle-o yellow-text" aria-hidden="true"></i>
                                                                @elseif($tasks->priority == "high")
                                                                    <i class="fa fa-circle-o red-text" aria-hidden="true"></i>
                                                                @endif
                                                                    {{ucfirst($tasks->priority)}}
                                                            </div>
                                                            <div class=" col l5 users">
                                                               
                                                            @php
                                                                $count_user = count(json_decode($tasks->assign_to)->user);
                                                            @endphp
                                                                @foreach(@json_decode($tasks->assign_to)->user as $key => $value)
                                                                    @php
                                                                        $userData = App\Model\Organization\User::getTeamById(@$value);
                                                                    @endphp
                                                                    @foreach(@$userData as $k => $userVal) 
                                                                        <div class="users_list">
                                                                             <i class="fa fa-circle-o blue-text" aria-hidden="true"></i>
                                                                             {{-- {{dd($userVal)}} --}}
                                                                             <a href="{{ route('user.details',[$userVal->id]) }}">{{$userVal->name}}</a>
                                                                             
                                                                        </div>
                                                                    @endforeach
                                                                @endforeach
                                                                
                                                                <input type="hidden" name="id" class="task_id" value="{{$tasks->id}}">
                                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                            </div>
                                                            <div class="{{($count_user == 1)?'display-none':''}}">
                                                                @php
                                                                    echo '+ '.($count_user - 1);
                                                                @endphp
                                                            </div>
                                                            <div class="col l4 right-align" style="float:right">
                                                            @php
                                                                $selectedArray = null;
                                                                if(array_key_exists('id',request()->route()->parameters)){
                                                                    $selectedArray[] = request()->route()->parameters['id'];
                                                                }
                                                            @endphp
                                                                @if($selectedArray == null)
                                                                    <a href="{{ route('edit.task',['id'=>$tasks->id]) }}"><i class="fa fa-pencil fa-lg mr-5" aria-hidden="true" ></i></a>
                                                                @else
                                                                    <a href="{{ route('edit.tasks',['id'=>$tasks->id]) }}"><i class="fa fa-pencil fa-lg mr-5" aria-hidden="true" ></i></a>

                                                                @endif
                                                                <div id="modal1" class="modal modal-fixed-footer">
                                                                    <div class="modal-header white-text  blue darken-1" ">
                                                                    <div class="row" style="padding:15px 10px">
                                                                        <div class="col l7 left-align">
                                                                            <h5 style="margin:0px">Edit Task</h5>   
                                                                        </div>
                                                                        <div class="col l5 right-align">
                                                                            <a href="javascript:;" class="closeDialog white-text" ><i class="fa fa-close"></i></a>
                                                                        </div>
                                                                            
                                                                    </div>
                                                                        
                                                                    </div>
                                                                    {{-- {!!Form::open(['route'=>'create.tasks','method'=>'POST','files'=>true])!!} --}}
                                                                        <div class="modal-content" style="padding: 30px;padding-bottom: 100px">
                                                                            <input type="hidden" name="_token" class="token" value="{{csrf_token()}}">
                                                                            <input type="hidden" name="task_id" value="{{$tasks->id}}">
                                                                           <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                 {!!Form::text('title',$tasks->title,['class'=>'no-margin-bottom aione-field','placeholder'=>'Enter Title'])!!}
                                                                            </div>
                                                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                    {!!Form::textarea('description',$tasks->description,['placeholder'=>'Enter Description','rows'=>'8','style'=>'height: 100px'])!!}
                                                                            </div>
                                                                                @if($usersName != null)
                                                                                    <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                        {!! Form::text('assign_to',array_map('intval',json_decode($tasks->assign_to)->user),["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Employee to assign this task','readonly'=>'readonly'])!!}
                                                                                        <input type="hidden" value="{{array_map('intval',json_decode($tasks->assign_to)->user)}}" name="assign_to" />
                                                                                    </div>
                                                                                @else
                                                                                    <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                        {!! Form::select('assign_to',App\Model\Organization\User::getEmployeesId(),array_map('intval',json_decode($tasks->assign_to)->user),["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Employee to assign this task' , 'multiple'])!!}
                                                                                    </div>
                                                                                @endif
                                                                               
                                                                                <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                    {!! Form::select('team',App\Model\Organization\Team::teamsList(),array_map('intval',json_decode($tasks->assign_to)->team),["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Team to assign this task','multiple'])!!}
                                                                                </div>
                                                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                {!! Form::select('priority', ['low'=>'Low','medium'=>'Medium','high'=>'High'],$tasks->priority,["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'priority'])!!}
                                                                            </div>
                                                                           
                                                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                {!! Form::select('projects_list',App\Model\Organization\Project::projectList(),$tasks->project_id,["class"=>"no-margin-bottom aione-field","placeholder"=>"Select Project"])!!}
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                              <div class="preloader-wrapper small active" style="margin-right: 20px;margin-top: 5px">
                                                                                <div class="spinner-layer spinner-blue-only">
                                                                                  <div class="circle-clipper left">
                                                                                    <div class="circle"></div>
                                                                                  </div><div class="gap-patch">
                                                                                    <div class="circle"></div>
                                                                                  </div><div class="circle-clipper right">
                                                                                    <div class="circle"></div>
                                                                                  </div>
                                                                                </div>
                                                                              </div>
                

                                                                            <a href="javascript:;" class="btn blue taskUpdate" name="action">update
                                                                            </a>
                                                                        </div> 
                                                                    {{-- {!!Form::close()!!}  --}}
                                                                </div>
                                                                <i class="fa fa-comment fa-lg mr-5" style="position: relative;" aria-hidden="true"></i>
                                                                
                                                                <a href="javascript:;" class="deleteTask"><i class="fa fa-trash red-text fa-lg" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                        <div style="clear: both">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="clear: both">
                                                    
                                                </div>
                                            </li>
                                        @endif
                                            
                                    @endforeach
                                </ul>
                                <ul id="sortable2" status="in-progress" class="col l4 droptrue"  style="min-height: 400px">
                                    @foreach(@$model as $key => $tasks)

                                        @if($tasks->status == 2) 
                                            <li class="ui-state-default col l12">
                                               <div class=" col l12 pr-7 pending" id="pending">    
                                                    <div class="card p-10" >
                                                        <div class="col l12 pl-5" >
                                                            <h6 class="col l8">{{$tasks->title}}</h6>
                                                            <div class="team"> 
                                                            @php
                                                                $count_team = count(json_decode($tasks->assign_to)->team);
                                                            @endphp
                                                                @foreach(@json_decode($tasks->assign_to)->team as $key => $value)
                                                                    @php
                                                                        $teamData = App\Model\Organization\Team::getTeamById($value);
                                                                    @endphp
                                                                        @foreach(@$teamData as $k => $teamVal) 
                                                                            <div style="float: right;border: 1px solid #ededed;background-color: #ededed;border-radius: 100%;overflow: hidden;">
                                                                                
                                                                                <a style="display:block;padding: 8px 14px" href="{{ route('info.team',['id'=>$teamVal->id]) }}">
                                                                                     {{$teamVal->title[0]}}
                                                                                </a>
                                                                            </div>
                                                                        @endforeach
                                                                @endforeach
                                                               
                                                            </div>
                                                             <div class="{{($count_team == 1)?'display-none':''}}">
                                                                    @php
                                                                        echo '+ '.($count_team - 1);
                                                                    @endphp
                                                                </div>
                                                        </div>
                                                        <div class="col l12 mt-10">
                                                            <div class=" col l3">
                                                                @if($tasks->priority == 'low')
                                                                    <i class="fa fa-circle-o blue-text" aria-hidden="true"></i>
                                                                @elseif($tasks->priority == "medium")
                                                                    <i class="fa fa-circle-o yellow-text" aria-hidden="true"></i>
                                                                @elseif($tasks->priority == "high")
                                                                    <i class="fa fa-circle-o red-text" aria-hidden="true"></i>
                                                                @endif
                                                                    {{ucfirst($tasks->priority)}}
                                                            </div>
                                                            <div class=" col l5 users">
                                                               
                                                            @php
                                                                $count_user = count(json_decode($tasks->assign_to)->user);
                                                            @endphp
                                                                @foreach(@json_decode($tasks->assign_to)->user as $key => $value)
                                                                    @php
                                                                        $userData = App\Model\Organization\User::getTeamById(@$value);
                                                                    @endphp
                                                                    @foreach(@$userData as $k => $userVal) 
                                                                        <div class="users_list">
                                                                             <i class="fa fa-circle-o blue-text" aria-hidden="true"></i>
                                                                             {{-- {{dd($userVal)}} --}}
                                                                             <a href="{{ route('user.details',[$userVal->id]) }}">{{$userVal->name}}</a>
                                                                             
                                                                        </div>
                                                                    @endforeach
                                                                @endforeach
                                                                
                                                                <input type="hidden" name="id" class="task_id" value="{{$tasks->id}}">
                                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                            </div>
                                                            <div class="{{($count_user == 1)?'display-none':''}}">
                                                                    @php
                                                                        echo '+ '.($count_user - 1);
                                                                    @endphp
                                                                </div>
                                                            <div class="col l4 right-align" style="float:right">
                                                                <a href="{{ route('edit.tasks',['id'=>$tasks->id]) }}"><i class="fa fa-pencil fa-lg mr-5" aria-hidden="true" ></i></a>
                                                                <div id="modal1" class="modal modal-fixed-footer">
                                                                    <div class="modal-header white-text  blue darken-1" ">
                                                                    <div class="row" style="padding:15px 10px">
                                                                        <div class="col l7 left-align">
                                                                            <h5 style="margin:0px">Edit Task</h5>   
                                                                        </div>
                                                                        <div class="col l5 right-align">
                                                                            <a href="javascript:;" class="closeDialog white-text" ><i class="fa fa-close"></i></a>
                                                                        </div>
                                                                            
                                                                    </div>
                                                                        
                                                                    </div>
                                                                    {{-- {!!Form::open(['route'=>'create.tasks','method'=>'POST','files'=>true])!!} --}}
                                                                        <div class="modal-content" style="padding: 30px;padding-bottom: 100px">
                                                                            <input type="hidden" name="_token" class="token" value="{{csrf_token()}}">
                                                                            <input type="hidden" name="task_id" value="{{$tasks->id}}">
                                                                           <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                 {!!Form::text('title',$tasks->title,['class'=>'no-margin-bottom aione-field','placeholder'=>'Enter Title'])!!}
                                                                            </div>
                                                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                    {!!Form::textarea('description',$tasks->description,['placeholder'=>'Enter Description','rows'=>'8','style'=>'height: 100px'])!!}
                                                                            </div>
                                                                                @if($usersName != null)
                                                                                    <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                        {!! Form::text('assign_to',array_map('intval',json_decode($tasks->assign_to)->user),["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Employee to assign this task','readonly'=>'readonly'])!!}
                                                                                        <input type="hidden" value="{{array_map('intval',json_decode($tasks->assign_to)->user)}}" name="assign_to" />
                                                                                    </div>
                                                                                @else
                                                                                    <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                        {!! Form::select('assign_to',App\Model\Organization\User::getEmployeesId(),array_map('intval',json_decode($tasks->assign_to)->user),["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Employee to assign this task' , 'multiple'])!!}
                                                                                    </div>
                                                                                @endif
                                                                               
                                                                                <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                    {!! Form::select('team',App\Model\Organization\Team::teamsList(),array_map('intval',json_decode($tasks->assign_to)->team),["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Team to assign this task','multiple'])!!}
                                                                                </div>
                                                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                {!! Form::select('priority', ['low'=>'Low','medium'=>'Medium','high'=>'High'],$tasks->priority,["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'priority'])!!}
                                                                            </div>
                                                                           
                                                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                {!! Form::select('projects_list',App\Model\Organization\Project::projectList(),$tasks->project_id,["class"=>"no-margin-bottom aione-field","placeholder"=>"Select Project"])!!}
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                              <div class="preloader-wrapper small active" style="margin-right: 20px;margin-top: 5px">
                                                                                <div class="spinner-layer spinner-blue-only">
                                                                                  <div class="circle-clipper left">
                                                                                    <div class="circle"></div>
                                                                                  </div><div class="gap-patch">
                                                                                    <div class="circle"></div>
                                                                                  </div><div class="circle-clipper right">
                                                                                    <div class="circle"></div>
                                                                                  </div>
                                                                                </div>
                                                                              </div>
                

                                                                            <a href="javascript:;" class="btn blue taskUpdate" name="action">update
                                                                            </a>
                                                                        </div> 
                                                                    {{-- {!!Form::close()!!}  --}}
                                                                </div>
                                                                <i class="fa fa-comment fa-lg mr-5" style="position: relative;" aria-hidden="true"></i>
                                                                
                                                                <a href="javascript:;" class="deleteTask"><i class="fa fa-trash red-text fa-lg" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                        <div style="clear: both">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="clear: both">
                                                    
                                                </div>
                                            </li>
                                        @endif
                                            
                                    @endforeach
                                </ul>
                                <ul id="sortable3" status="complete" class="col l4 droptrue"  style="min-height: 400px">
                                   @foreach(@$model as $key => $tasks)

                                        @if($tasks->status == 1) 
                                            <li class="ui-state-default col l12">
                                               <div class=" col l12 pr-7 pending" id="pending">    
                                                    <div class="card p-10" >
                                                        <div class="col l12 pl-5" >
                                                            <h6 class="col l8">{{$tasks->title}}</h6>
                                                            <div class="team"> 
                                                            @php
                                                                $count_team = count(json_decode($tasks->assign_to)->team);
                                                            @endphp
                                                                @foreach(@json_decode($tasks->assign_to)->team as $key => $value)
                                                                    @php
                                                                        $teamData = App\Model\Organization\Team::getTeamById($value);
                                                                    @endphp
                                                                        @foreach(@$teamData as $k => $teamVal) 
                                                                            <div style="float: right;border: 1px solid #ededed;background-color: #ededed;border-radius: 100%;overflow: hidden;">
                                                                                
                                                                                <a style="display:block;padding: 8px 14px" href="{{ route('info.team',['id'=>$teamVal->id]) }}">
                                                                                     {{$teamVal->title[0]}}
                                                                                </a>
                                                                            </div>
                                                                        @endforeach
                                                                @endforeach
                                                               
                                                            </div>
                                                             <div class="{{($count_team == 1)?'display-none':''}}">
                                                                    @php
                                                                        echo '+ '.($count_team - 1);
                                                                    @endphp
                                                                </div>
                                                        </div>
                                                        <div class="col l12 mt-10">
                                                            <div class=" col l3">
                                                                @if($tasks->priority == 'low')
                                                                    <i class="fa fa-circle-o blue-text" aria-hidden="true"></i>
                                                                @elseif($tasks->priority == "medium")
                                                                    <i class="fa fa-circle-o yellow-text" aria-hidden="true"></i>
                                                                @elseif($tasks->priority == "high")
                                                                    <i class="fa fa-circle-o red-text" aria-hidden="true"></i>
                                                                @endif
                                                                    {{ucfirst($tasks->priority)}}
                                                            </div>
                                                            <div class=" col l5 users">
                                                               
                                                            @php
                                                                $count_user = count(json_decode($tasks->assign_to)->user);
                                                            @endphp
                                                                @foreach(@json_decode($tasks->assign_to)->user as $key => $value)
                                                                    @php
                                                                        $userData = App\Model\Organization\User::getTeamById(@$value);
                                                                    @endphp
                                                                    @foreach(@$userData as $k => $userVal) 
                                                                        <div class="users_list">
                                                                             <i class="fa fa-circle-o blue-text" aria-hidden="true"></i>
                                                                             {{-- {{dd($userVal)}} --}}
                                                                             <a href="{{ route('user.details',[$userVal->id]) }}">{{$userVal->name}}</a>
                                                                             
                                                                        </div>
                                                                    @endforeach
                                                                @endforeach
                                                                
                                                                <input type="hidden" name="id" class="task_id" value="{{$tasks->id}}">
                                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                            </div>
                                                            <div class="{{($count_user == 1)?'display-none':''}}">
                                                                    @php
                                                                        echo '+ '.($count_user - 1);
                                                                    @endphp
                                                                </div>
                                                            <div class="col l4 right-align" style="float:right">
                                                                <a href="{{ route('edit.tasks',['id'=>$tasks->id]) }}"><i class="fa fa-pencil fa-lg mr-5" aria-hidden="true" ></i></a>
                                                                <div id="modal1" class="modal modal-fixed-footer">
                                                                    <div class="modal-header white-text  blue darken-1" ">
                                                                    <div class="row" style="padding:15px 10px">
                                                                        <div class="col l7 left-align">
                                                                            <h5 style="margin:0px">Edit Task</h5>   
                                                                        </div>
                                                                        <div class="col l5 right-align">
                                                                            <a href="javascript:;" class="closeDialog white-text" ><i class="fa fa-close"></i></a>
                                                                        </div>
                                                                            
                                                                    </div>
                                                                        
                                                                    </div>
                                                                    {{-- {!!Form::open(['route'=>'create.tasks','method'=>'POST','files'=>true])!!} --}}
                                                                        <div class="modal-content" style="padding: 30px;padding-bottom: 100px">
                                                                            <input type="hidden" name="_token" class="token" value="{{csrf_token()}}">
                                                                            <input type="hidden" name="task_id" value="{{$tasks->id}}">
                                                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                 {!!Form::text('title',$tasks->title,['class'=>'no-margin-bottom aione-field','placeholder'=>'Enter Title'])!!}
                                                                            </div>
                                                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                    {!!Form::textarea('description',$tasks->description,['placeholder'=>'Enter Description','rows'=>'8','style'=>'height: 100px'])!!}
                                                                            </div>
                                                                                @if($usersName != null)
                                                                                    <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                        {!! Form::text('assign_to',array_map('intval',json_decode($tasks->assign_to)->user),["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Employee to assign this task','readonly'=>'readonly'])!!}
                                                                                        <input type="hidden" value="{{array_map('intval',json_decode($tasks->assign_to)->user)}}" name="assign_to" />
                                                                                    </div>
                                                                                @else
                                                                                    <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                        {!! Form::select('assign_to',App\Model\Organization\User::getEmployeesId(),array_map('intval',json_decode($tasks->assign_to)->user),["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Employee to assign this task' , 'multiple'])!!}
                                                                                    </div>
                                                                                @endif
                                                                               
                                                                                <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                    {!! Form::select('team',App\Model\Organization\Team::teamsList(),array_map('intval',json_decode($tasks->assign_to)->team),["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Team to assign this task','multiple'])!!}
                                                                                </div>
                                                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                {!! Form::select('priority', ['low'=>'Low','medium'=>'Medium','high'=>'High'],$tasks->priority,["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'priority'])!!}
                                                                            </div>
                                                                           
                                                                            <div class="col s12 m2 l12 aione-field-wrapper">
                                                                                {!! Form::select('projects_list',App\Model\Organization\Project::projectList(),$tasks->project_id,["class"=>"no-margin-bottom aione-field","placeholder"=>"Select Project"])!!}
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                              <div class="preloader-wrapper small active" style="margin-right: 20px;margin-top: 5px">
                                                                                <div class="spinner-layer spinner-blue-only">
                                                                                  <div class="circle-clipper left">
                                                                                    <div class="circle"></div>
                                                                                  </div><div class="gap-patch">
                                                                                    <div class="circle"></div>
                                                                                  </div><div class="circle-clipper right">
                                                                                    <div class="circle"></div>
                                                                                  </div>
                                                                                </div>
                                                                              </div>
                

                                                                            <a href="javascript:;" class="btn blue taskUpdate" name="action">update
                                                                            </a>
                                                                        </div> 
                                                                    {{-- {!!Form::close()!!}  --}}
                                                                </div>
                                                                <i class="fa fa-comment fa-lg mr-5" style="position: relative;" aria-hidden="true"></i>
                                                                
                                                                <a href="javascript:;" class="deleteTask"><i class="fa fa-trash red-text fa-lg" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                        <div style="clear: both">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="clear: both">
                                                    
                                                </div>
                                            </li>
                                        @endif
                                            
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <div class="empty-row">No Data Found</div>
                        @endif
                   
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style type="text/css">
        .empty-row{
            width: 100%;
            padding: 44px;
            border: 4px dashed #ededed;
            margin-top: 16px;
            color: #ededed;
            font-size: 45px;
            text-align: center;
        }
        .fa-comment:after{
            content: '12';
            background-color: red;
            color: white;
            font-size: 10px;
            font-weight: 900;
            padding: 2px;
            border-radius: 6px;
            position: absolute;
            right: -5px;
            bottom: 5px;
        }
    </style>
   {{--   @if($usersName != null)
        <div class="col s12 m2 l12 aione-field-wrapper">
            {!! Form::text('assign_to',array_map('intval',json_decode($tasks->assign_to)->user),["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Employee to assign this task','readonly'=>'readonly'])!!}
            <input type="hidden" value="{{array_map('intval',json_decode($tasks->assign_to)->user)}}" name="assign_to" />
        </div>
    @else
        <div class="col s12 m2 l12 aione-field-wrapper">
            {!! Form::select('assign_to',App\Model\Organization\User::getEmployeesId(),array_map('intval',json_decode($tasks->assign_to)->user),["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Employee to assign this task' , 'multiple'])!!}
        </div>
    @endif --}}
@else
    <div>
        <h2>There is no Task available for this</h2>
    </div>
@endif