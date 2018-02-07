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
                     {{-- {!!Form::model(@$model,['route'=>['',request()->id],'method'=>'post'])!!} --}}
                     @include('common.modal-onclick',['data'=>['modal_id'=>'edit-task-modal','heading'=>'Edit Task','button_title'=>'Save','section'=>'tassec1']])
                     {{-- {!! Form::close() !!} --}}
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
                                    <span class=" mr-5 bg-light-blue bg-darken-2 white p-2 ph-10 posi" style="border-radius: 4px">
                                    {{ call_model('Tasks','getStatus',$task->status) }}

                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                    
            </div>
            <div class="aione-border">
                <div class="p-10 bg-grey bg-lighten-3 font-size-18">
                    Attachments
                    <button class="aione-button aione-float-right font-size-14 " data-target="add-image"  style="margin-top: -6px">+ Add</button>
                    {{-- {!! Form::open(['route'=>['upload.project.attachments',request()->id],'method'=>'post','files'=>true]) !!}
                    @include('common.modal-onclick',['data'=>['modal_id'=>'add-image','heading'=>'Add Image','button_title'=>'Upload ','form'=>'add-attachments-form']])
                    {!! Form::close() !!} --}}
                </div>
                
                <div class="p-10 ar">
                 
                        <div class="ac l25 aione-align-center mb-20">
                            <span class="aione-border display-inline-block width-100 image-wrapper" style="width: 100%">
                                <img src="https://images.anandtech.com/doci/6993/DSC_0343.jpg" class="mr-20" style="height: 100px">
                                <a href="" class="delete-sweet-alert">
                                    <i class="fa fa-trash"></i>    
                                </a>
                                <a href="" target="_blank">
                                    <i class="fa fa-download"></i>    
                                </a>
                                
                                <div class="bg-white p-5 aione-border-top truncate aione-tooltip" title="">
                                    askdaj
                                </div>
                            </span>
                            
                        </div>
                 
                </div>
                    
            </div>
        </div>
        <div class="ac l35">
            <div class="aione-border mb-20">
                <div class="p-10 bg-grey bg-lighten-3 font-size-18">
                    Assign To
                    <button class="aione-button aione-float-right font-size-14 " data-target="add-team" style="margin-top: -6px">+ Add</button>
                    {{-- {!! Form::model(@$model,['route'=>['assign.project.team',request()->id]]) !!}
                    @include('common.modal-onclick',['data'=>['modal_id'=>'add-team','heading'=>'Add Team','button_title'=>'Save ','form'=>'assign-team-form']])
                    {!! Form::close() !!} --}}
                </div>
                <div class=" aione-table">
                    <table class="">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Members</th>
                                
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                                    <tr>
                                        <td>akdajsdhasd</td>
                                        <td>akjsdjadasd</td>
                                        
                                        <td>
                                            <a href="" class="delete-sweet-alert">Remove</a>
                                        </td>
                                    </tr>
                              
                        </tbody>
                    </table>
                </div>
            </div>          
               
        </div>
    </div>

@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
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
</style>
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection