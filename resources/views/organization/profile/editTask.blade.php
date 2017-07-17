@extends('layouts.main')
@section('content')
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
	<div class="edit_task">
    	@foreach($model as $key => $tasks)
            <div class="modal-content" style="padding: 30px;padding-bottom: 100px">
                <input type="hidden" name="_token" class="token" value="{{csrf_token()}}">
                <input type="hidden" name="task_id" value="{{$tasks->id}}">
               	<div class="col s12 m2 l12 aione-field-wrapper">
                    {!!Form::text('title',$tasks->title,['class'=>'no-margin-bottom aione-field','placeholder'=>'Enter Title'])!!}
                </div>
                <div class="col s12 m2 l12 aione-field-wrapper">
                    {!!Form::textarea('description',$tasks->description,['placeholder'=>'Enter Description','rows'=>'8','style'=>'height: 100px'])!!}
                </div>
                @php
                    $uri = Route::getCurrentRoute()->uri; 
                    $route_check = explode('/',$uri)[0];
                @endphp
                    @if($route_check == 'account')
                        <div class="col s12 m2 l12 aione-field-wrapper">
                            {!! Form::text('assign_to[]',@App\Model\Organization\Employee::employees()[Auth::guard('org')->user()->id],["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Employee to assign this task','readonly'=>'readonly'])!!}
                            <input type="hidden" value="{{Auth::guard('org')->user()->id}}" class="assignToText" name="assign_to[]" />
                        </div>
                    @else
                        <div class="col s12 m2 l12 aione-field-wrapper">
                            {!! Form::select('assign_to',App\Model\Organization\Employee::employees(),array_map('intval',json_decode($tasks->assign_to)->user),["class"=>"no-margin-bottom aione-field" , 'placeholder'=>'Select Employee to assign this task' , 'multiple'])!!}
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

                <a href="javascript:;" class="btn blue taskUpdate">update
                </a>
            </div>  
        @endforeach
    </div>  
        
@endsection