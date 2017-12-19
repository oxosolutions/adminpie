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
                    {!! Form::select('assign_to',App\Model\Organization\Employee::employees(),null,["class"=>"no-margin-bottom aione-field Employee_filter" , 'placeholder'=>'Employee Filter'])!!}
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
                            <h6>Pending <span style="float: right " class="pending-count"></span></h6> 
                        </div>
                        <div class="task-list col l4 center-align " id="inProgress" style="border-bottom: 1px solid #e8e8e8;border-right: 1px solid #e8e8e8">
                            <h6>In Progress <span style="float: right " class="working-count"></span></h6>
                        </div>
                        <div class="task-list col l4 center-align" id="completed" style="border-bottom: 1px solid #e8e8e8;">
                            <h6>Completed <span style="float: right " class="complete-count"></span></h6>
                        </div>
                    </div>
   					 
                    @if(@$model)
                        <div class="row task-font" >
                            <ul id="sortable1" status="pending" class="col l4 droptrue" style="min-height: 400px">
                                @foreach(@$model as @$key => @$tasks)

                                    @if(@$tasks->status == 0) 
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
                                                                         <a href="{{ route('info.user',[$userVal->id]) }}">{{$userVal->name}}</a>
                                                                         
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
                                                        <div class="col l4 right-align">
                                                            <a href="{{ route('edit.tasks',['id'=>$tasks->id]) }}"><i class="fa fa-pencil fa-lg mr-5" aria-hidden="true" ></i></a>
                                                           
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
                                                                         <a href="{{ route('info.user',[$userVal->id]) }}">{{$userVal->name}}</a>
                                                                         
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
                                                        <div class="col l4 right-align">
                                                            <a href="{{ route('edit.tasks',['id'=>$tasks->id]) }}"><i class="fa fa-pencil fa-lg mr-5" aria-hidden="true" ></i></a>
                                                            
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
                                                                         <a href="{{ route('info.user',[$userVal->id]) }}">{{$userVal->name}}</a>
                                                                         
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
                                                        <div class="col l4 right-align">
                                                            <a href="{{ route('edit.tasks',['id'=>$tasks->id]) }}"><i class="fa fa-pencil fa-lg mr-5" aria-hidden="true" ></i></a>
                                                           
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
<script type="text/javascript">
    $(document).ready(function(){
        $('.modal').modal();
    });
</script>
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