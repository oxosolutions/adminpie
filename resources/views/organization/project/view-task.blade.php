@extends('layouts.main')
@section('content')
@php
    $page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Task :',
    'add_new' => '+ Add Tasks'
);
@endphp
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
    {{-- {{ dump($task) }} --}}
    <div class="ar">
        <div class="ac l65 aione-table">
            <div class="aione-border mb-20">
                <div class="p-10 bg-grey bg-lighten-3 font-size-18">
                     Task Details
                     <button class="aione-button aione-float-right font-size-14 " data-target="edit-task-modal"  style="margin-top: -6px">Edit</button>
                     {!!Form::model(@$task,['route'=>['update.tasks',request()->id],'method'=>'post','files'=>true])!!}
                     @include('common.modal-onclick',['data'=>['modal_id'=>'edit-task-modal','heading'=>'Edit Task','button_title'=>'Save','section'=>'tassec1']])
                     {!! Form::close() !!}
                </div>
                <div class="p-10 ">
                    <div class="font-weight-600 line-height-30 font-size-18">
                        {{ $task->title }}    
                    </div>
                   
                    <div class="line-height-26 mb-15" style="text-align: justify;">
                        {{ $task->description }} 
                    </div>
                 
                    <table>
                        <tbody>
                            <tr>
                                <td>Due Date</td>
                                <td>{{ $task->end_date }}</td>
                            </tr>
                            <tr>
                                <td>Created At</td>
                                <td>{{ $task->created_at }}</td>
                            </tr>
                            <tr>
                                <td>Created By</td>
                                <td>
                                    {{ user_id_to_name($task->created_by) }}
                                </td>
                            </tr>
                            <tr>
                                <td>Priority</td>
                                <td>

                                    <span class="red">
                                        {{ ucWords($task->priority) }}    
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                  
                                    <span class="dropdown">
                                      <button id="status_button">{{ call_model('Tasks','getStatus',$task->status) }}</button>
                                      <label>
                                        <input type="checkbox">
                                        <ul>
                                          <li onclick="updateStatus(0,{{ $task->id }})">Pending</li>
                                          <li onclick="updateStatus(1,{{ $task->id }})">In progress</li>
                                          <li onclick="updateStatus(2,{{ $task->id }})">Completed</li>
                                        </ul>
                                      </label>
                                    </span>

                                    {{-- <span class=" mr-5 bg-light-blue bg-darken-2 white p-2 ph-10 posi" style="border-radius: 4px">
                                        {{ call_model('Tasks','getStatus',$task->status) }}
                                    </span> --}}
                                   
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                    
            </div>

            <div class="aione-border mb-20  ">
                <div class="p-10 bg-grey bg-lighten-3 font-size-18 ">
                     Comments 
                </div>
                <div class="p-10">
                    @if($task['comments'] != null && !$task['comments']->isEmpty())
                        @foreach($task['comments'] as $key => $comment)
                            <div class="aione-border-bottom pt-10">
                                <div class="ar ">
                                    <div class="ac l50 font-weight-700 font-size-16">
                                        {{ user_id_to_name($comment->user_id) }}
                                    </div>
                                    <div class="ac l50 aione-align-right font-size-13">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </div>
                                </div>    
                                <div class="p-10 grey">
                                    {{ $comment->comment }}
                                </div>
                            </div>
                        @endforeach
                    @endif
                    {{-- <div class="aione-align-center pv-20">
                        <a href="">
                            10 more previous comments                        
                        </a>
                    </div> --}}
                    {!! Form::open(['route'=>'post.comment']) !!}
                        <div>
                            {!! Form::textarea('comment',null,['rows'=>'5']) !!}
                            {!! Form::hidden('type','task') !!}
                            {!! Form::hidden('target_id',request()->id) !!}
                            {!! Form::hidden('user_id',get_user()->id) !!}
                            {!! Form::submit('Post Comment',['class'=>'mt-10 aione-float-right']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
                    
            </div>

           
        </div>
        <div class="ac l35">
              
             <div class="aione-border mb-20">
                <div class="p-10 bg-grey bg-lighten-3 font-size-18">
                    Assigned Users
                    <button class="aione-button aione-float-right font-size-14 " data-target="add-user" style="margin-top: -6px">+ Add</button>
                    {!! Form::model(@$model,['route'=>['assign.project.user',request()->id]]) !!}
                    @include('common.modal-onclick',['data'=>['modal_id'=>'add-user','heading'=>'Add User','button_title'=>'Save ','form'=>'assign-user-form']])
                    {!! Form::close() !!}
                </div>
                <div class="aione-table">
                    <table class="">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Ashish
                                </td>
                                <td>
                                    <a href="">Remove</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>  
             <div class="aione-border mb-20">
                <div class="p-10 bg-grey bg-lighten-3 font-size-18">
                    Attachments
                    <button class="aione-button aione-float-right font-size-14 " data-target="add-image"  style="margin-top: -6px">+ Add</button>
                    {!! Form::open(['route'=>['upload.task.attachment',request()->id],'method'=>'post','files'=>true]) !!}
                    @include('common.modal-onclick',['data'=>['modal_id'=>'add-image','heading'=>'Add Image','button_title'=>'Upload ','form'=>'add-task-attachments-form']])
                    {!! Form::close() !!}
                </div>
                
                <div class="p-10 ar">
                        @foreach($task->attachment as $key => $file)
                            @php
                                $exploded = explode('.',$file);
                                $countIndex = count($exploded)-1;
                            @endphp
                            <div class="ac l50 aione-align-center mb-20">
                                <span class="aione-border display-inline-block width-100 image-wrapper" style="width: 100%">
                                    @if(in_array($exploded[$countIndex],['jpg','jpeg','png','gif']))
                                        <img src="{{ url('/').'/'.upload_path('tasks_attachment').'/'.$file }}" class="mr-20" style="height: 100px">
                                    @else
                                        <img src="{{asset('assets/images/file-icon.png')}}" class="mr-20" style="height: 100px">
                                    @endif
                                    <a href="{{ route('remove.task.attachment',['id'=>$task->id,'index'=>$key]) }}" class="delete-sweet-alert">
                                        <i class="fa fa-trash"></i>    
                                    </a>
                                    <a href="{{ url('/').'/'.upload_path('tasks_attachment').'/'.$file }}" target="_blank">
                                        <i class="fa fa-download"></i>    
                                    </a>
                                    {{-- <div class="bg-white p-5 aione-border-top truncate aione-tooltip" title="">
                                        askdaj
                                    </div> --}}
                                </span>
                            </div>
                        @endforeach
                </div>
                    
            </div>  
        </div>
    </div>

@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.confirm-alert')
<style type="text/css">
    .image-wrapper{
        position: relative;

    }
    .image-wrapper .fa-trash,
    .image-wrapper .fa-download{
        position: absolute;
        top: 5px;
        right: 5px;
        display: none;
        cursor: pointer;
    }
    .image-wrapper .fa-download{
        top: 7px;
        right: 30px
    }
    .image-wrapper:hover .fa-trash,
    .image-wrapper:hover .fa-download{
        display: block;
    }

    /****************************************************************/
    /**                     Drop Down Button                      ***/
    /****************************************************************/

    .dropdown {
      position: relative;
      display: inline-block;
      font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
      font-size: 14px;
    }

    .dropdown > a, .dropdown > button {
      font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
      font-size: 14px;
      background-color: white;
      border: 1px solid #ccc;
      padding: 6px 20px 6px 10px;
      border-radius: 4px;
      display: inline-block;
      color: black;
      text-decoration: none;
    }

    .dropdown > a:before, .dropdown > button:before {
      position: absolute;
      right: 7px;
      top: 17px;
      content: ' ';
      border-left: 5px solid transparent;
      border-right: 5px solid transparent;
      border-top: 5px solid black;
    }

    .dropdown input[type=checkbox] {
      position: absolute;
      display: block;
      top: 0px;
      left: 0px;
      width: 100%;
      height: 100%;
      margin: 0px;
      opacity: 0;
    }

    .dropdown input[type=checkbox]:checked {
      position: fixed;
      z-index:+0;
      top: 0px; left: 0px; 
      right: 0px; bottom: 0px;
    }

    .dropdown ul {
      position: absolute;
      top: 18px;
      border: 1px solid #ccc;
      border-radius: 3px;
      left: 0px;
      list-style: none;
      padding: 4px 0px;
      display: none;
      background-color: white;
      box-shadow: 0 3px 6px rgba(0,0,0,.175);
    }

    .dropdown input[type=checkbox]:checked + ul {
      display: block;
    }

    .dropdown ul li {
      display: block;
      padding: 6px 20px;
      white-space: nowrap;
      min-width: 100px;
    }

    .dropdown ul li:hover {
      background-color: #F5F5F5;
      cursor: pointer;
    }

    .dropdown ul li a {
      text-decoration: none;
      display: block;
      color: black
    }

    .dropdown .divider {
      height: 1px;
      margin: 9px 0;
      overflow: hidden;
      background-color: #e5e5e5;
      font-size: 1px;
      padding: 0;

    }


</style>
<script type="text/javascript">
    let status,task_id;
    function updateStatus(status,task_id){
        console.log(status+task_id);
        $.ajax({
           type:'POST',
           url:route()+'/task/status/update',
           data: {_token: '{{ csrf_token() }}',task_id: task_id, status: status},
           success: function(result){
                console.log(result);
                if (status == 0) {
                    $('#status_button').text('Pending');    
                } 
                if (status == 1) {
                    $('#status_button').text('In progress');
                } 
                if (status == 2) {
                    $('#status_button').text('Completed');
                }
                 Materialize.toast('Successfully Updated', 3000)
                
           } 
        });
    }
</script>
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection