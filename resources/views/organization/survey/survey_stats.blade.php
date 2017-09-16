@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Stats',
    'add_new' => '+ Add Media'
); 
$id = "";

@endphp 
<style type="text/css">
    .aione-row > .left-75{
        width: 70%;
        float: left;
        padding-right: 10px
    }
    .aione-row > .right-25{
        width: 30%;
        float: right;
    }
    .aione-row.theme-1 > .card-4{
        width: 25%;
        float: left;
        padding: 30px 0px;
        text-align: center;
    }
    .aione-row > .card-4 > h3, .aione-row > .card-4 > p{
        padding:0;
        margin: 0;
    }
    .aione-row > .card-4 > p{
        line-height: 28px;
        font-size: 16px;
        text-transform: uppercase;
        font-weight: 300;
        color: #676767;
    }
    .aione-row > .card-4:nth-child(odd) > h3{
        color:#DF735E 
    }
    .aione-row > .card-4:nth-child(even) > h3{
        color:#79C3A9 
    }
    .aione-border.theme-1{
        border:1px solid #e8e8e8;
        border-radius: 4px
    }
    .aione-border.theme-1 > .card-4{
        border-right: 1px solid #e8e8e8;
    }

     .aione-row.theme-2 > .card-4{
        width: 24%;
        margin-right: 10px;
        float: left;
        padding: 30px 0px;
        text-align: center;
    }
     .aione-row.theme-2 > .card-4:last-child{
        margin-right: 0px
     }
    .aione-border.theme-2 > .card-4{
        border: 1px solid #e8e8e8;
        border-radius: 4px
    }

     .aione-row.theme-3 > .card-4{
        width: 50%;
        float: left;
        padding: 30px 0px;
        text-align: center;
    }
     
    .aione-border.theme-3 > .card-4{
        border: 1px solid #e8e8e8;
     
    }
</style>
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
    @include('organization.survey._tabs')
        <div class="aione-row">
            <div class="left-75">
                 @if(!empty($error))
                    <div class="slider-container">
                        <div class="row">
                            <h1> {{$error}}</h1>
                        </div>
                    </div>
                @else

                <div>
                    <div class="row">
                        <div class="aione-table">
                            @if(!empty($section_question_count))
                               {{--  <style>
                                   table  td , th{
                                            border:1px solid grey;
                                    }
                                </style> --}}
                                <table class="wide"> 
                                    <thead>
                                        <tr>
                                            <th>Group Name</th>
                                            <th>Total Question</th>
                                        </tr>
                                    </thead>
                                    @foreach($section_question_count as $groupName => $queCount)
                                    <tbody>
                                        <tr>
                                           <td> {{str_replace('-', ' ',$groupName)}}</td> <td>{{$queCount}}</td> 
                                        </tr>
                                    </tbody>
                                    @endforeach
                                 </table>
                            @endif
                        </div>
                    </div>
                </div>
               
                <div class="aione-row aione-border theme-2" style="margin-bottom: 10px">
                    <div class="card-4">
                        <h3>{{$group_count}}</h3>
                        <p>Groups</p>
                    </div>
                    <div class="card-4">
                        <h3>{{$question_count}}</h3>
                        <p>Questions</p>
                    </div>
                     <div class="card-4">
                        <h3> {{$survey_completed_count}}</h3>
                        <p>Completed Surveys</p>
                    </div>
                     <div class="card-4">
                        <h3>47</h3>
                        <p>Incompleted Surveys</p>
                    </div>
                </div>

                <div class="aione-table row">
                    <div class="col l6">
                        <table>
                            <thead>
                                <tr>
                                    <th colspan="2"><center>Errors</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td ><center>Count</center></td>
                                    <td ><center>0</center></td>

                                </tr>
                               @foreach($errors_warnings as $errorKey => $errorVal)
                                <tr>
                                     <td ><center>Slug : {{$errorKey}} <br> Question: {{$errorVal['question']}} <br> Field:{{$errorVal['field_type']}}</center></td>
                                    <td ><center> {{$errorVal['error']['error']}}</center></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col l6">
                        <table>
                            <thead>
                                <tr>
                                    <th colspan="2"><center>Warnings</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                     <td ><center>Count</center></td>
                                    <td ><center>0</center></td>


                                </tr>
                                <tr>
                                   <td ><center>lorem impsum</center></td>
                                    <td ><center>1</center></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                                
                </div>
             
                <div class="card-style-1">
                    <div class="title">Total Errors</div>
                    <div class="count">{{count($ques_slug_error)}}
                            {{-- {{$ques_slug_error->keys()->implode(',')}} --}}
                    </div>
                    <div></div>
                </div>
                 <div class="card-style-1">
                    <div class="title">Total Warnings</div>
                    <div class="count">158</div>
                    <div></div>
                </div>
            </div>
            <div class="right-25 aione-table" >
                <table>
                    <thead>
                        <tr>
                            <th colspan="2">Settings</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($setting_questions as $settingKey => $settingVal)
                            @if($settingKey=='_token')
                                @continue;
                            @endif
                            @if(!empty($settings[$settingKey]))
                                <tr>
                                    <td>{{$loop->iteration}}.{{$settingVal}}</td>
                                    <td>{{$settings[$settingKey]}}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>

              {{--   <div class="center-align">
                    <span class="card-title-bar">Settings</span>
                </div>
                <div class="divider"></div>
                <div class="aione-survey-settings">
                    <div class="aione-survey-setting">
                    @foreach($setting_questions as $settingKey => $settingVal)
                        @if($settingKey=='_token')
                                @continue;
                        @endif
                                    @if(!empty($settings[$settingKey]))
                                <div class="aione-survey-subsetting">
                                        <span class="aione-survey-subsetting-key">{{$loop->iteration}}.
                                            {{$settingVal}}
                                        </span>
                                        <span class="aione-survey-subsetting-value">{{$settings[$settingKey]}}</span>
                                </div>
                                    @endif
                    @endforeach
                          
                    </div>
                </div> --}}
                    
            </div>
        </div>
   

    

    <script type="text/javascript">


        $(document).ready(function(){

        $('.collapsible').collapsible({

        accordion: false, // A setting that changes the collapsible behavior to expandable instead of the default accordion style
        onOpen: function(el) { 
        // alert('Open'); 
        }, // Callback for Collapsible open
        onClose: function(el) {
         // alert('Closed'); } // Callback for Collapsible close
        });


      });

    </script>
   
   
@if(!empty($section))
    @foreach ($sections as $key => $value) 
        
        <div>Section Name{{$value['section_name']}}</div>
        @foreach($value['fields'] as $fieldKey => $fieldVal)
            <div>  Question {{$fieldVal['field_title']}} ({{$fieldVal['field_type']}})</div>
            @php 
            $collection = collect($fieldVal['field_meta'])->mapWithKeys(function($item){
                return [$item['key']=>$item['value']];
            });

           $meta = $collection->toArray();
            @endphp
            @foreach($meta as $metaKey=> $metaVal)
                {{$metaKey}} - {{$metaVal}} <br>
            @endforeach
        @endforeach

    @endforeach
@endif


@endif
        <style type="text/css">
            .card-style-1{
                padding: 20px;
                border: 1px solid #e8e8e8;
                width: 20%

            }
            .card-style-1 .title{
                text-align: center;
                font-size: 20px;
                font-weight: 500;
                color: #757575;
                padding-bottom: 20px;
                border-bottom: 1px solid #e8e8e8
            }
            .card-style-1 .count{
                text-align: center;
                font-size: 48px;
                font-weight: 200;
                color: #454545;
                padding-top: 20px

            }
        </style>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
   <style type="text/css">
         }
        .slider-container{
            margin-top: 20px;
        }
        .card{
            margin: 0px !important; 
        }
        .header-top{
            border-bottom: 1px solid #ddd;
            box-shadow:0 1px 4px rgba(0, 0, 0, 0.3), 0 0 40px rgba(0, 0, 0, 0.1) inset;
            padding:5px;
            background-color: #fff;
        }
        .header-top h5{
            padding-left: 10px;


        }
        .card-section{
            min-height: 90px;
            background: #fff;
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
            border-radius: 2px;
            
        }
        .card-content{
            background-color: #fff;
            text-align: center;
            float: left;
            width: 70%;
            
        }
        .card-inner{
            display: inline;
            float: right;
            width: 30%;
            min-height: 90px;
            text-align: center;
            font-size: 1.6em;
            color: #fff;
            padding-top: 28px;
        }
        .card-part1{
            font-size: 15px;
            padding-top: 17px;
            display: block;
        }
        .card-part2{
            font-size: 20px;
            padding-top: 5px;
            display: block;
        }
        .text_style{
            background-color: #606CA8!important;
        }
        .radio_style {
            background-color: #26a69a!important;
        }
        .dropdown_style{
            background-color: #214469!important;
        }
        .text_only_style{
            background-color: #9E9E9E!important;
        }
        .clear{
            clear: both;
        }
        .aione-survey-settings .aione-survey-setting {
            padding:10px;
            border-bottom: 1px solid #e8e8e8;
        }
        .aione-survey-settings .aione-survey-setting:last-child{
            border-bottom: none;
        }
        .aione-survey-settings .aione-survey-setting .aione-survey-setting-value {
            float: right;
        }
        .aione-survey-settings .aione-survey-setting .aione-survey-subsetting{
            padding:5px 0px;
            border-bottom: 1px solid #e8e8e8;
        }
        .aione-survey-settings .aione-survey-setting .aione-survey-subsetting:last-child{
            border-bottom: none;
        }
        .aione-survey-settings .aione-survey-setting .aione-survey-subsetting .aione-survey-subsetting-key{
            display:block;
            
        }
        .aione-survey-settings .aione-survey-setting .aione-survey-subsetting .aione-survey-subsetting-value{
            display:block;
            text-align: right;
            color: #777;
            font-size: 14px;
        } 
        .aione-survey-subsetting-value-enable{
            display:block;
            text-align: right;
            color: #777;
            font-size: 14px;
            padding-top: 10px;
        }
        .card-title-bar{
            font-size: 24px;
            padding: 5px 10px;
            display: block;
        }
        .thead{
            border: 1px solid #eee;
            padding: 5px;
            font-size: 12px;
            text-align: center;
            color: #777;
        }
        .tbody{
            border: 1px solid #eee;
            padding: 5px;
            font-size: 13px;
        }
        .z-depth-1, nav, .card-panel, .card, .toast, .btn, .btn-large, .btn-floating, .dropdown-content, .collapsible, .side-nav{
            box-shadow: none;
        }
        .collapsible-body{
            padding: 0px;
        }
        .collapsible{
            border-left: 0px;
            border-right: 0px;
            margin:0px;
        }


   </style>
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection