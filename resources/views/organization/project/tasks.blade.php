@extends('layouts.main')
@section('content')
@php
    $page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'yes',
    'show_navigation' => 'yes',
    'page_title' => 'Tasks',
    'add_new' => '+ Add Tasks'
); 
    $Tasks = 'App\Model\Organization\Tasks';
@endphp
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
    @if($errors->any())
        <script type="text/javascript">
          window.onload = function(){
            $('#add_new_model').modal('open');
          }
        </script>
      @endif
	   @if(request()->project_id != null)
        
        @include('organization.project._tabs')
       

       @endif
        <div class="ph-15 mb-10">
            <div class="aione-border  pt-10">
                {!! FormGenerator::GenerateForm('project-task-filter-form') !!}           
            </div>
        </div>
        <div class="ar" id="task_container">
            <div class="ac l33 ">
                <div class="aione-border" >
                    <h5 class="font-weight-700  font-size-16 m-0 p-10 bg-grey bg-lighten-4 ">
                        Pending          
                        <span class="aione-float-right count"></span>   

                    </h5>
                    <div class="p-10 task-list" id="pending" style="min-height: 400px;max-height: 400px;overflow: auto;">
                        @foreach($tasks->where('status',0) as $key => $task)
                            <div class="aione-shadow task  mb-15 p-10 priority-{{ $task->priority }}" data-target="edit_task" taskid="{{ $task->id }}">
                                <div class="truncate font-size-16 font-weight-700 line-height-22">
                                    <a class="grey darken-1" href="{{ route('view.tasks',$task->id) }}"> {{ $task->title }} </a>
                                </div>
                                <div class="line-height-22 grey truncate">
                                    Assign To : {{ call_model('Tasks','generateUsersList',$task) }}
                                </div>
                                <div class="line-height-22 grey truncate">
                                    Due : {{ call_model('Tasks','generateDaysLeft',$task) }} left | By : {{ user_id_to_name($task->created_by) }} | 28 comments
                                </div>
                            </div>
                        @endforeach
                    </div>    
                </div>
            </div>
            <div class="ac l33 ">
                <div class="aione-border" >
                    <h5 class="font-weight-700  font-size-16 m-0 p-10 bg-grey bg-lighten-4 ">
                        In progress           
                        <span class="aione-float-right count"></span>   

                    </h5>  
                    <div class="p-10 task-list" style="min-height: 400px;max-height: 400px;overflow: auto" id="in_progress">
                          
                        @foreach($tasks->where('status',1) as $key => $task)
                            <div class="aione-shadow task  mb-15 p-10 priority-{{ $task->priority }}" data-target="edit_task" taskid="{{ $task->id }}">
                                <div class="truncate font-size-16 font-weight-700 line-height-22">
                                    <a href="{{ route('view.tasks',$task->id) }}">{{ $task->title }}</a>
                                </div>
                                <div class="line-height-22 grey truncate">
                                    Assign To : {{ call_model('Tasks','generateUsersList',$task) }}
                                </div>
                                <div class="line-height-22 grey truncate">
                                    Due : {{ call_model('Tasks','generateDaysLeft',$task) }} left | By : {{ user_id_to_name($task->created_by) }} | 28 comments
                                </div>
                            </div>
                        @endforeach
                    </div>     
                </div>
            </div>
            <div class="ac l33 ">
                <div class="aione-border" id="task_container">
                    <h5 class="font-weight-700  font-size-16 m-0 p-10 bg-grey bg-lighten-4 ">
                        Completed   
                        <span class="aione-float-right count"></span>   
                    </h5> 
                    <div class="p-10 task-list" id="completed" style="min-height: 400px;max-height: 400px;overflow: auto">
                       @foreach($tasks->where('status',2) as $key => $task)
                            <div class="aione-shadow task  mb-15 p-10 priority-{{ $task->priority }}" data-target="edit_task" taskid="{{ $task->id }}">
                                <div class="truncate font-size-16 font-weight-700 line-height-22">
                                    <a href="{{ route('view.tasks',$task->id) }}">{{ $task->title }}</a>
                                </div>
                                <div class="line-height-22 grey truncate">
                                    Assign To : {{ call_model('Tasks','generateUsersList',$task) }}
                                </div>
                                <div class="line-height-22 grey truncate">
                                    Due : {{ call_model('Tasks','generateDaysLeft',$task) }} left | By : {{ user_id_to_name($task->created_by) }} | 28 comments
                                </div>
                            </div>
                        @endforeach
                    </div>      
                </div>
            </div>
        </div>
	
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
    
    {!! Form::model(@$project,['route'=>'create.tasks','files'=>true]) !!}
        @include('common.modal-onclick',['data'=>['modal_id'=>'add_new_model','heading'=>'Add Task','button_title'=>'Save','section'=>'tassec1']])
    {!! Form::close() !!}
    <style type="text/css">
        .priority-high,
        .priority-medium,
        .priority-low{
            position: relative;
            cursor: move;
            background: white
            
        }
        .priority-high:before,
        .priority-medium:before,
        .priority-low:before{
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            border-top: 12px solid;
            border-right: 12px solid transparent
        }
        .priority-high:before{
            border-top-color: red;
        }
        .priority-medium:before{
            border-top-color: green;
        }
        .priority-low:before{
            border-top-color: yellow;
        }
    </style>
    <script type="text/javascript" src="{{ asset('assets/js/Sortable.js') }}"></script>
    <script type="text/javascript">
        count();
        [].forEach.call(document.getElementById('task_container').getElementsByClassName('task-list'), function (el){
            Sortable.create(el, {
                group: 'tasks',
                animation: 150,
                draggable: ".task",
                onAdd: function (evt/**Event*/){
                    count();
                    console.log(evt);
                    var dropedIn = evt.to.attributes.id.nodeValue;
                    var taskID = evt.clone.attributes.taskid.nodeValue;
                    console.log(dropedIn,taskID);
                    switch(dropedIn){
                        case'in_progress':
                            updateStatus(taskID,1);
                        break;
                        case'completed':
                            updateStatus(taskID,2);
                        break;
                        case'pending':
                            updateStatus(taskID,0);
                        break;
                    }
                    var item = evt.item; 
                }
            });
        });
        function updateStatus(task_id, status){
            $.ajax({
               type:'POST',
               url:route()+'/task/status/update',
               data: {_token: '{{ csrf_token() }}',task_id: task_id, status: status},
               success: function(result){
                    console.log(result);
               } 
            });
        }
        function count(){
            $('.task-list').each(
              function() {
                $(this).parents('.aione-border').find('.count').text($('.task', $(this)).length);
              }
            );    
        }
    </script>
@include('common.page_content_secondry_end')
@include('common.pagecontentend')    

@endsection