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
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('organization.survey._tabs')
<div class="slider-container">
    <div class="row">
            <div class="col m2">     
                <div class="card-section">

                    <div class="card-content">

                        <span class="card-part1" >
                            Total
                        </span>

                        <span class="card-part2" >
                            Groups
                        </span>

                    </div>

                    <div class="card-inner" style="background-color: #da542e;">
                        <span>
                          {{$group_count}}
                        </span>
                    </div>

                    <div class="clear"></div>
                  
                </div>
            </div> 

            <div class="col m2">     
                <div class="card-section">

                    <div class="card-content">

                        <span class="card-part1" >
                            Total
                        </span>

                        <span class="card-part2" >
                            Questions
                        </span>
                    
                    </div>

                    <div class="card-inner" style="background-color: #08c;">
                        <span>
                          {{$question_count}}
                        </span>
                    </div>

                    <div class="clear"></div>
                  
                </div>
            </div> 

            <div class="col m2">     
                <div class="card-section">

                    <div class="card-content">

                        <span class="card-part1" >
                            Complete
                        </span>

                        <span class="card-part2" >
                            Survey
                        </span>
                        
                    </div>

                    <div class="card-inner" style="background-color: #00a65a;">
                        <span>
                          {{$survey_completed_count}}
                        </span>
                    </div>

                    <div class="clear"></div>
                  
                </div>
            </div> 

            <div class="col m2">     
                <div class="card-section">

                    <div class="card-content">

                        <span class="card-part1" >
                            Incomplete
                        </span>

                        <span class="card-part2" >
                            Survey
                        </span>
                    
                    </div>

                    <div class="card-inner" style="background-color: #dd4b39;">
                        <span>
                            ??       
                        </span>
                    </div>

                    <div class="clear"></div>
                  
                </div>
            </div> 

            <div class="col m2">     
                <div class="card-section">

                    <div class="card-content">

                        <span class="card-part1" >
                            Total
                        </span>

                        <span class="card-part2" >
                            Errors
                        </span>

                    </div>

                    <div class="card-inner" style="background-color: #f74d4d;">
                        <span>
                          ??
                        </span>
                    </div>

                    <div class="clear"></div>
                  
                </div>
            </div> 

            <div class="col m2">     
                <div class="card-section">

                    <div class="card-content">

                        <span class="card-part1" >
                            Total
                        </span>

                        <span class="card-part2" >
                            Warnings
                        </span>
                    
                    </div>

                    <div class="card-inner" style="background-color: #ffb848;">
                        <span>
                          ?
                        </span>
                    </div>

                    <div class="clear"></div>
                  
                </div>
            </div>

    </div>

    <div class="row">
       
    </div>

</div>

</div>

<div>
    <div class="row">
        <div>
            @if(!empty($section_question_count))
                <style>
                   table  td , th{
                            border:1px solid grey;
                    }
                </style>
            <table>
                <tr>
                    <th>Group Name</th>
                    <th>Total Question</th>
                </tr>
                @foreach($section_question_count as $groupName => $queCount)
                <tr>
                   <td> {{str_replace('-', ' ',$groupName)}}</td> <td>{{$queCount}}</td> 
                </tr>

            @endforeach
             </table>
            @endif
        </div>
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

        <div class="col m3">
            <div class="card">
                <div class="center-align">
                    <span class="card-title-bar">Settings</span>
                   
                </div>
                <div class="divider"></div>
				<div class="aione-survey-settings">
					<div class="aione-survey-setting">
                    @foreach($settings as $settingKey => $settingVal)
                        @if($settingKey=='_token')
                                @continue;
                        @endif
								<div class="aione-survey-subsetting">
									<span class="aione-survey-subsetting-key">{{$loop->index}}. {{ucfirst( str_replace('_', ' ', $settingKey))}}</span>
									<span class="aione-survey-subsetting-value">{{$settingVal}}</span>
								</div>
                    @endforeach
							<span class="aione-survey-setting-key">hjagsdhashd</span>
							<span class="aione-survey-setting-value">
                           
                                <span class="aione-switch-enabled">
                                    <i class="material-icons dp48" style="color: green;font-size: 17px;">info</i>
                                </span>
                            </span>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>

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
<div class="card-style-1">
    <div class="title">Total Survey</div>
    <div class="count">158</div>
    <div></div>
</div>
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