@extends('layouts.main')
@section('content')
<style type="text/css">
    .project-details > div{
        padding-right: 14px !important;
    }
    .project-details .card{
        padding: 10px;

    }
    .project-details .card .project-logo{
        width: 50px;
        margin: 10px auto;
        line-height: 50px;
        border-radius: 50%;
        color: white
    }
    .project-details .card >div {
        margin-bottom: 10px;
    }
    .project-details .card > .headline{
       border-bottom: 1px solid #e8e8e8;
       padding-bottom: 10px;
    }
    .project-details .card > .headline > h6{
        display: inline-block;
    }
    .project-details .card > .headline > .edit{
      float: right
    }
    .project-details .card > .list >div{
        margin-bottom: 10px
    }
    .project-details .members-list img{
        float: left;
        height: 30px;
        width: 30px;
        border-radius: 50%;
    }
    .project-details .members-list span{
        float: left;
        line-height: 30px;
        padding-left: 10px;
    }
</style>
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
    <div class="row project-details">
        <div class="col l2 center-align "  >

            <div class="card ">
                
                <div class="blue project-logo"  >
                   {{@ucwords(substr($model->name,0,2))}} 
                </div>
                <div class="p-15">
                    {{@ucfirst($model->name)}} {{@ucfirst($model->name)}} {{@ucfirst($model->name)}}
                </div>
            </div>
            <div class="card row" >
                <div class="col s12 m12 l12 headline" >
                    <h6 >Tasks</h6>
                </div>
                <div class="col l12 list">
                    <div class="col s12 m12 l12 pv-5 "><strong>276</strong><span class="grey-text pl-7">Total tasks</span></div>
                    <div class="col s12 m12 l12 pv-5"><strong>178</strong><span class="grey-text pl-7">Tasks left</span></div>
                    <div class="col s12 m12 l12 pv-5"> <strong>98</strong><span class="grey-text pl-7">Tasks completed</span></div>
                    <div class="col s12 m12 l12 pv-5"><a href="">Create a new task</a></div>
                    <strong>OR</strong>
                    <div class="col s12 m12 l12 pv-5"><a >Track task</a></div>
                </div>
            </div>
        </div>
        <div class="col l8 " >
            <div class="card">  
                <div class="col s12 m12 l12 headline" >
                    <h6 >Project Details</h6>
                    <a href="#modal3" class="edit">Edit</a>
                    {!!Form::model($model,['route'=>['update.project',$model->id],'method'=>'POST'])!!}
                   
                    @include('common.modal-onclick',['data'=>['modal_id'=>'modal3','heading'=>'Project detail','button_title'=>'Save','section'=>'prosec3']])
                     {!!Form::close()!!}
                </div>
                <div class="list row">
                    <div class="col s12 m12  l12" >
                        <div class=" col l3">
                            Project Name
                        </div>
                        <div class=" col l9">
                            {{$model->name}}
                        </div>
                    </div>
                    <div class="col s12 m12  l12"  >
                        <div class=" col l3">
                            Description
                        </div>
                        <div class=" col l9">
                            {{@$model->description}}
                        </div>
                    </div>
                    <div class="col s12 m12  l12"  >
                        <div class=" col l3">
                            Location
                        </div>
                        <div class=" col l9">
                            {{@$model->location}}
                        </div>
                    </div>
                    <div class="col s12 m12 l12 "  >
                        <div class=" col l3">
                            Start Date
                        </div>
                        <div class=" col l9">
                            {{@$model->start_date}}
                        </div>
                    </div>
                    <div class="col s12 m12 l12"  >
                        <div class=" col l3">
                            End Date
                        </div>
                        <div class=" col l9">
                            {{@$model->end_date}}
                        </div>
                    </div>
                    <div class="col s12 m12 l12"  >
                        <div class=" col l3">
                            Added By
                        </div>
                        <div class=" col l9">
                            <div class="col l6">
                                {{@$model->added_by}}
                            </div>
                            <div class="col l6 right-align grey-text">
                                2 hours ago 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col l2 " >
            <div class="card row" >
                 <div class="col s12 m12 l12 headline" >
                    <h6 >Teams</h6>
                </div>
                <div class="col l12 members-list">
                    @if($model->teams != null)
                        @foreach(@$model->teams as $key => $value)
                            @php
                               $team =  App\Model\Organization\Team::find($value);
                            @endphp
                            <div class="col s10 m10 l10 p-10 grey-text fs-13">{{$team ->title}}</span></div>
                            <div class="col s2 m2 l2 p-10"> <strong>{{count(json_decode($team->member_ids))}}</strong></div>
                        @endforeach
                    @endif
                    <div class="col s12 m12 l12 pv-5">
                        <?php
                            if($model->teams != null){
                                $model->teams = array_map('intval', $model->teams);
                            }
                        ?>
                    </div>
                    <div class=" waves-effect" style="width: 100%;padding:5px">
                        <img src="{{asset('assets/images/sgs_sandhu.jpg')}}" alt="Contact Person">
                        <span>Sgs Sandhu</span>
                    </div>
                    <div class=" waves-effect" style="width: 100%;padding:5px">
                        <img src="{{asset('assets/images/sgs_sandhu.jpg')}}" alt="Contact Person">
                        <span>Sgs Sandhu</span>
                    </div>
                    <div class=" waves-effect" style="width: 100%;padding:5px">
                        <img src="{{asset('assets/images/sgs_sandhu.jpg')}}" alt="Contact Person">
                        <span>Sgs Sandhu</span>
                    </div>
                  
                </div>
            </div>
            <div class="card row" >
                <div class="col s12 m12 l12 headline" >
                    <h6 >Users</h6>
                </div>
                <div class="col l12">
                    @if($model->users != null)
                        @foreach(@$model->users as $key => $value)
                            @php
                               $users =  App\Model\Organization\User::find($value);
                            @endphp
                            <div class="col s12 m12 l12 pv-5 ">{{$users ->name}}</span></div>
                           
                        @endforeach
                    @endif
                    <div class="col s12 m12 l12 pv-5">
                      
                    </div>
                     
                   
                    <div class="col s12 m12 l12 pv-5">
                        <?php
                            if($model->teams != null){
                                $model->teams = array_map('intval', $model->teams);
                            }
                        ?>
                        <a href="#modal2" >Assign another team</a>
                        {!!Form::model($model,['route'=>['update.team',$model->id]])!!}
                            @include('common.modal-onclick',['data'=>['modal_id'=>'modal2','heading'=>'This is Heading','button_title'=>'Save Data','section'=>'prosec4']])
                        {!!Form::close()!!}
                    </div>
                </div>
                
            </div>
            <div class="card row" >
                <div class="col s12 m12 l12 headline" >
                    <h6 >Clients</h6>
                </div>
                <div class="col s12 m12 l12">
                    <div class="col l12 pv-5 ">
                        <div class="chip">
                            <img src="{{asset('assets/images/sgs_sandhu.jpg')}}" alt="Contact Person">
                            Ashish Joshi
                        </div>
                    </div>
                    
                </div>
                
            </div>
            <div class="card row">
                <div class="col s12 m12 l12 headline" >
                    <h6 >More</h6>
                </div>
                <div class="col s12 m12 l12 list" >
                     <div class="col s12 m12 l12 pv-5 "><strong>9</strong><a href="{{ route('documentation.project',$model->id) }}"><span class="grey-text pl-7">Documentations</span></a></div>
                     <div class="col s12 m12 l12 pv-5"><strong>7</strong><a href="{{ route('notes.project',$model->id) }}"><span class="grey-text pl-7">Notes</span></a></div>
                     <div class="col s12 m12 l12 pv-5"> <strong>98</strong><a href="{{ route('credentials.project',$model->id) }}"><span class="grey-text pl-7">Credenatials</span></a></div>
                     <div class="col s12 m12 l12 pv-5"> <strong>8</strong><a href="{{ route('attachment.project',$model->id) }}"><span class="grey-text pl-7">Attachments</span></a></div>
                </div>
                
            </div>
        </div>
    </div>
        

@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

@include('common.page_content_secondry_end')
@include('common.pagecontentend')

<script type="text/javascript">
    $(document).ready(function(){
      $('#modal1').modal();
      $('#modal2').modal(); 
      $('#modal3').modal();
       });
</script>
@endsection