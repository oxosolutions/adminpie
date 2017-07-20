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
<div class="row">
    @include('organization.project._tabs')
    <div class="col l2  pr-7 center-align " style="margin-top: 14px" >

        <div class="card col m6 l12" style="padding: 20px;">
            
            <div class="blue project-logo" style="text-transform: uppercase;" >
               {{@ucwords(substr($model->name,0,2))}} 
            </div>
            <div class="p-15">
                {{@ucfirst($model->name)}}
            </div>
        </div>
        <div class="card col m6 l12" style="padding: 20px 10px;margin-top: 14px !important">
            <div class="col s12 m12 l12" style="border-bottom: 1px solid #e8e8e8;">
                <h6 style="margin-top: 0px;">Tasks</h6>
            </div>
            <div class="col l12">
                <div class="col s12 m12 l12 pv-5 "><strong>276</strong><span class="grey-text pl-7">Total tasks</span></div>
                <div class="col s12 m12 l12 pv-5"><strong>178</strong><span class="grey-text pl-7">Tasks left</span></div>
                <div class="col s12 m12 l12 pv-5"> <strong>98</strong><span class="grey-text pl-7">Tasks completed</span></div>
                <div class="col s12 m12 l12 pv-5"><a href="">Create a new task</a></div>
                <strong>OR</strong>
                <div class="col s12 m12 l12 pv-5"><a >Track task</a></div>
            </div>
            <div style="clear: both">
                

            </div>
        </div>
      

    </div>



    <div class="col l8 pl-7 pr-7" style="margin-top: 14px">
        <div class="card">
           
            <div>
                <div class="row">
                   
                    <div id="test1" class="col s12 p-15">
                       
                        <div class="row">
                            <div class="col s12 m12  l12" style="border-bottom: 1px solid #e8e8e8;">
                                <div class="col l6">
                                    <h5 style="margin-top: 0px;">Project Details</h5>
                                </div>
                                <div class="col l6 right-align" >
                                    <a href="#modal3" class="btn">Edit</a>
                                    {!!Form::model($model,['route'=>['update.project',$model->id],'method'=>'POST'])!!}
                                   
                                    @include('common.modal-onclick',['data'=>['modal_id'=>'modal3','heading'=>'Project detail','button_title'=>'Save','section'=>'prosec3']])
                                     {!!Form::close()!!}
                                </div>
                                    
                            </div>

                            <div class="col s12 m12  l12" style="margin-top: 10px">
                                <div class=" col l3">
                                    Project Name
                                </div>
                                <div class=" col l9">
                                    {{$model->name}}
                                </div>
                            </div>
                            <div class="col s12 m12  l12"  style="margin-top: 10px">
                                <div class=" col l3">
                                    Description
                                </div>
                                <div class=" col l9">
                                    {{@$model->description}}
                                </div>
                            </div>
                            <div class="col s12 m12  l12"  style="margin-top: 10px">
                                <div class=" col l3">
                                    Location
                                </div>
                                <div class=" col l9">
                                    {{@$model->location}}
                                </div>
                            </div>
                            <div class="col s12 m12 l12 "  style="margin-top: 10px">
                                <div class=" col l3">
                                    Start Date
                                </div>
                                <div class=" col l9">
                                    {{@$model->start_date}}
                                </div>
                            </div>
                            <div class="col s12 m12 l12"  style="margin-top: 10px">
                                <div class=" col l3">
                                    End Date
                                </div>
                                <div class=" col l9">
                                    {{@$model->end_date}}
                                </div>
                            </div>
                            <div class="col s12 m12 l12"  style="margin-top: 10px">
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
            </div>
        </div>
    </div>
    <div class="col l2  pl-7  center-align " style="margin-top: 14px">
        
        <div class="card p-15" style="margin-bottom: 10px !important;">
            <div class="col s12 m12 l12" style="border-bottom: 1px solid #e8e8e8;">
                <h6 style="margin-top: 0px;">Team assigned</h6>
            </div>
            <div class="col l12">
                @if($model->teams != null)
                    @foreach(@$model->teams as $key => $value)
                        @php
                           $team =  App\Model\Organization\Team::find($value);
                        @endphp
                        <div class="col s12 m12 l12 pv-5 ">{{$team ->title}}</span></div>
                        <div class="col s12 m12 l12 pv-5"> <strong>{{count(json_decode($team->member_ids))}}</strong><span class="grey-text pl-7">Members</span></div>
                    @endforeach
                @endif
                <div class="col s12 m12 l12 pv-5">
                  
                </div>
                 
                {{-- <strong>OR</strong> --}}
                <div class="col s12 m12 l12 pv-5">
                    <?php
                        if($model->teams != null){
                            $model->teams = array_map('intval', $model->teams);
                        }
                    ?>
                    <a href="#modal2" style="font-size: 10px">Assign another team</a>
                    {!!Form::model($model,['route'=>['update.team',$model->id]])!!}
                        @include('common.modal-onclick',['data'=>['modal_id'=>'modal2','heading'=>'This is Heading','button_title'=>'Save Data','section'=>'prosec4']])
                    {!!Form::close()!!}
                </div>
                
                
               

                
            </div>
            <div style="clear: both">
                
            </div>
        </div>
        <div class="card p-15"  style="margin-bottom: 10px !important;">
            <div class="col s12 m12 l12" style="border-bottom: 1px solid #e8e8e8;">
                <h6 style="margin-top: 0px;">Client</h6>
            </div>
            <div class="col s12 m12 l12">
                <div class="col l12 pv-5 ">
                    <div class="chip">
                        <img src="{{asset('assets/images/sgs_sandhu.jpg')}}" alt="Contact Person">
                        Ashish Joshi
                    </div>
                </div>
                
            </div>
            <div style="clear: both">
                
            </div>
        </div>
        <div class="card p-15"  style="margin-bottom: 10px !important;">
            <div class="col s12 m12 l12" style="border-bottom: 1px solid #e8e8e8;">
                <h6 style="margin-top: 0px;">More</h6>
            </div>
            <div class="col s12 m12 l12">
                <div class="col s12 m12 l12 pv-5 ">
                     <div class="col s12 m12 l12 pv-5 "><strong>9</strong><span class="grey-text pl-7">Documentations</span></div>
                     <div class="col s12 m12 l12 pv-5"><strong>7</strong><span class="grey-text pl-7">Notes</span></div>
                     <div class="col s12 m12 l12 pv-5"> <strong>98</strong><span class="grey-text pl-7">Credenatials</span></div>
                     <div class="col s12 m12 l12 pv-5"> <strong>8</strong><span class="grey-text pl-7">Attachments</span></div>
                </div>
                
            </div>
            <div style="clear: both">
                
            </div>
        </div>
    </div>
</div>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

@include('common.page_content_secondry_end')
@include('common.pagecontentend')

<style type="text/css">
    .card{
        margin: 0px !important;
    }
    .projects-logo{
        
        background-color: #000;margin: 10%;

    }
    .tabs{
        height: 32px !important;
    }
    .tabs .tab{
        line-height: 32px !important;
        
    }
    .tabs .tab a{
        font-size: 10px !important;color: rgb(33, 150, 243) !important;
    }
    .active{
        background-color: #fff !important;
    }
    .p-15{
        padding: 15px !important;
    }
    .pv-5{
        padding: 5px 0px !important; 
    }
    .project-logo{
        color: white;width: 70px;margin: 0 auto; line-height: 70px;font-size: 24px;border-radius: 50%
    }
    .tabs .tab a{
        padding:0 12px;
    }
    .percent{
        display: none;
    }
   .progress-bar-wrapper{
        width: 80%;background-color: #e8e8e8;margin-top: 10px;overflow: hidden;border-radius:8px ;position: absolute;
   }
   .progress-bar-wrapper > .accomplished{
        background-color: #2196F3;line-height: 5px;font-size:10px;width: 10%;color: white;text-align: right;padding-right: 10px
   }

   .progress-bar-wrapper:hover .percent{
        display: flex;
        padding: 8px 0px 2px 0px;
   }
 
</style>
<script type="text/javascript">
    $(document).ready(function(){
      $('#modal1').modal();
      $('#modal2').modal(); 
      $('#modal3').modal();
       });
</script>
@endsection