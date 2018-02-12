@extends('layouts.main')
@section('content')

@php
    $page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Project Details',
    'add_new' => ''
); 
@endphp
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')

    @include('organization.project._tabs')
    <div class="ar">
        <div class="ac l65 aione-table">
            <div class="aione-border mb-20">
                <div class="p-10 bg-grey bg-lighten-3 font-size-18">
                     Project Details
                     <button class="aione-button aione-float-right font-size-14 " data-target="edit-project-details"  style="margin-top: -6px">Edit</button>
                     {!!Form::model(@$model,['route'=>['update.project.details',request()->id],'method'=>'post'])!!}
                     @include('common.modal-onclick',['data'=>['modal_id'=>'edit-project-details','heading'=>'Edit Project Details','button_title'=>'Save ','form'=>'edit-project-details-form']])
                     {!! Form::close() !!}
                </div>
                <div class="p-10 ">
                    <div class="font-weight-600 line-height-30 font-size-18">
                        {{$model->name}}    
                    </div>
                    <div class="line-height-30 font-size-13 ">
                        <span class="bg-green white p-2 ph-5">
                          {{App\Model\Organization\ProjectCategory::find($model->category)->name}}      
                        </span>
                    </div>
                    <div class="line-height-26 mb-15" style="text-align: justify;">
                        {{$model->description}}
                    </div>
                    <div class="line-height-30 mb-20 font-size-13 ">
                        <i class="fa fa-tags"></i>
                        @php
                            $tags = explode(',',$model->tags);
                        @endphp
                        @foreach($tags as $tag)
                        <span class=" mr-5 bg-light-blue bg-darken-2 white p-2 ph-10 posi" style="border-radius: 4px">
                            {{$tag}}    
                        </span>
                        
                        @endforeach
                    </div>
                    <table>
                        <tbody>
                            <tr>
                                <td>End Date</td>
                                <td>{{$model->end_date}}</td>
                            </tr>
                            <tr>
                                <td>Created At</td>
                                <td>{{$model->start_date}}</td>
                            </tr>
                            <tr>
                                <td>Created By</td>
                                <td>
                                {{ App\Model\Group\GroupUsers::find($model->created_by)->name}}
                                </td>
                            </tr>
                            <tr>
                                <td>Priority</td>
                                <td>
                                    @if($model->priority == 'high')
                                        <span class="red">
                                            High    
                                        </span>
                                    @endif
                                    @if($model->priority == 'medium')
                                        <span class="blue">
                                            Medium    
                                        </span>
                                    @endif
                                    @if($model->priority == 'low')
                                        <span class="green">
                                            Low         
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>{{ucWords(str_replace('_',' ',$model->status))}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                    
            </div>
            <div class="aione-border">
                <div class="p-10 bg-grey bg-lighten-3 font-size-18">
                    Attachments
                    <button class="aione-button aione-float-right font-size-14 " data-target="add-image"  style="margin-top: -6px">+ Add</button>
                    {!! Form::open(['route'=>['upload.project.attachments',request()->id],'method'=>'post','files'=>true]) !!}
                    @include('common.modal-onclick',['data'=>['modal_id'=>'add-image','heading'=>'Add Image','button_title'=>'Upload ','form'=>'add-attachments-form']])
                    {!! Form::close() !!}
                </div>
                
                <div class="p-10 ar">
                    @if($model->attachments != null)
                        @foreach($model->attachments as $key => $attachment)
                            @php
                                $exploded = explode('.',$attachment->file);
                                $countIndex = count($exploded)-1;
                            @endphp
                            <div class="ac l25 aione-align-center mb-20">
                                <span class="aione-border display-inline-block width-100 image-wrapper" style="width: 100%">
                                    @if(in_array($exploded[$countIndex],['jpg','jpeg','png','gif']))
                                        <img src="{{ url('/').'/'.upload_path('project_attachments').'/'.$attachment->file}}" class="mr-20" style="height: 100px">   
                                    @else
                                        <img src="{{asset('assets/images/file-icon.png')}}" class="mr-20" style="height: 100px">
                                    @endif
                                    <a href="{{route('delete.project.attachment',['attachment_index'=>$key,'id'=>request()->id])}}" class="delete-sweet-alert">
                                        <i class="fa fa-trash"></i>    
                                    </a>
                                    <a href="{{ url('/').'/'.upload_path('project_attachments').'/'.$attachment->file}}" target="_blank">
                                        <i class="fa fa-download"></i>    
                                    </a>
                                    
                                    <div class="bg-white p-5 aione-border-top truncate aione-tooltip" title="{{$attachment->name}}">
                                        {{$attachment->name}}
                                    </div>
                                </span>
                                
                            </div>
                        @endforeach
                    @endif
                </div>
                    
            </div>
        </div>
        <div class="ac l35">
            <div class="aione-border mb-20">
                <div class="p-10 bg-grey bg-lighten-3 font-size-18">
                    Assign Teams
                    <button class="aione-button aione-float-right font-size-14 " data-target="add-team" style="margin-top: -6px">+ Add</button>
                    {!! Form::model(@$model,['route'=>['assign.project.team',request()->id]]) !!}
                    @include('common.modal-onclick',['data'=>['modal_id'=>'add-team','heading'=>'Add Team','button_title'=>'Save ','form'=>'assign-team-form']])
                    {!! Form::close() !!}
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
                            @if($model->assigned_team != null)
                                @foreach($model->assigned_team as $key => $team_id)
                                    @php
                                        $members = 0;
                                        $teamModel = App\Model\Organization\Team::find($team_id);
                                        if($teamModel->member_ids != '' && $teamModel->member_ids != null){
                                            $members = count(json_decode(@$teamModel->member_ids));
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ $teamModel->title }}</td>
                                        <td>{{ $members }}</td>
                                        
                                        <td>
                                            <a href="{{ route('remove.project.team',['project_id'=>request()->id,'index_id'=>$key]) }}" class="delete-sweet-alert">Remove</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>          
            <div class="aione-border mb-20">
                <div class="p-10 bg-grey bg-lighten-3 font-size-18">
                    Assign Users
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
                            @if($model->assigned_user != null)
                                @foreach($model->assigned_user as $key => $user_id)
                                    <tr>
                                        <td>{{ ucwords(user_id_to_name($user_id)) }}</td>
                                        <td>
                                            <a href="{{ route('remove.assigned.user',['user_index'=>$key,'project_id'=>request()->id]) }}"  class="delete-sweet-alert">Remove</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>          
            <div class="aione-border mb-20">
                <div class="p-10 bg-grey bg-lighten-3 font-size-18">
                    Assign Clients
                    <button class="aione-button aione-float-right font-size-14 " data-target="add-client" style="margin-top: -6px">+ Add</button>
                    @include('common.modal-onclick',['data'=>['modal_id'=>'add-client','heading'=>'Add Client','button_title'=>'Save ','form'=>'assign-client-form']])
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
                                <td>John Dao</td>
                                
                                <td>
                                    <a href="">Remove</a>
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
</style>

@include('common.page_content_secondry_end')
@include('common.pagecontentend')


@endsection