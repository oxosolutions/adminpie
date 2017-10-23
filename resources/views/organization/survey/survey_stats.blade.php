@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Stats <span>'.get_survey_title(request()->route()->parameters()['id']).'</span>',
    'add_new' => '+ Add Media'
);

@endphp 
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
    @include('organization.survey._tabs')

    @if($data['status'] == 'error')
        {!!aione_message($data['errors'],'error','center')!!}
    @endif

        <div class="ar pb-20">
            <div class="ac s100 m50 l25">
                <div class="aione-widget aione-border bg-grey bg-lighten-5">
                    <div class="aione-title">
                        <h5 class="aione-align-center font-weight-400 aione-border-bottom m-0 pv-10 mb-10 bg-grey bg-lighten-4">Sections</h5>
                    </div>
                    <div class="aione-align-center p-30 font-size-64 font-weight-600 blue-grey darken-2">{{@$data['count']['sections']}}</div>
                </div>
            </div>
            <div class="ac s100 m50 l25">
                <div class="aione-widget aione-border bg-grey bg-lighten-5">
                    <div class="aione-title">
                        <h5 class="aione-align-center font-weight-400 aione-border-bottom m-0 pv-10 mb-10 bg-grey bg-lighten-4">Questions</h5>
                    </div>
                    <div class="aione-align-center p-30 font-size-64 font-weight-600 blue-grey darken-2">{{@$data['count']['fields']}}</div>
                </div>
            </div>
            <div class="ac s100 m50 l25">
                <div class="aione-widget aione-border bg-grey bg-lighten-5">
                    <div class="aione-title">
                        <h5 class="aione-align-center font-weight-400 aione-border-bottom m-0 pv-10 mb-10 bg-grey bg-lighten-4">Completed Responses</h5>
                    </div>
                        <div class="aione-align-center p-30 font-size-64 font-weight-600 blue-grey darken-2">{{@$data['count']['completed']}}</div>
                </div>
            </div>
            <div class="ac s100 m50 l25">
                <div class="aione-widget aione-border bg-grey bg-lighten-5">
                    <div class="aione-title">
                        <h5 class="aione-align-center font-weight-400 aione-border-bottom m-0 pv-10 mb-10 bg-grey bg-lighten-4">Incomplete Responses</h5>
                    </div>
                    <div class="aione-align-center p-30 font-size-64 font-weight-600 blue-grey darken-2">{{@$data['count']['incomplete']}}</div>
                </div>
            </div>
        </div>

        <div class="ar pb-20">
            <div class="ac s100 m100 l50">
                <div class="aione-widget bg-grey bg-lighten-5">
                    <div class="aione-title aione-border-top aione-border-right aione-border-left">
                        <h5 class="aione-align-center font-weight-400 m-0 pv-10 bg-grey bg-lighten-4">
                            User Responses
                        </h5>
                    </div>
                    <div class="aione-table">
                        <table class="compact">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th colspan="3">Responses</th>
                                </tr>
                                <tr>
                                    <th>User</th>
                                    <th>Total</th>
                                    <th>Complate </th>
                                    <th>Incomplete </th>
                                </tr>
                            </thead>
                            <tbody>
                               @if(isset($data['user_by']) && !empty($data['user_by'])) 
                                    @foreach($data['user_by'] as $user_key => $user_val)
                                        <tr>
                                            <td>{{$user_val->user_id}}</td>
                                            <td>{{$user_val->total}}</td>
                                            <td>{{$user_val->completed}}</td>
                                            <td>{{$user_val->uncompleted}}</td>
                                        </tr>
                                    @endforeach
                                    @else
                                    {!!aione_message('No Data Exist','error','center')!!}
                                @endif
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="ac s100 m100 l50">
                <div class="aione-widget bg-grey bg-lighten-5">
                    <div class="aione-title aione-border-top aione-border-right aione-border-left">
                        <h5 class="aione-align-center font-weight-400 m-0 pv-10 bg-grey bg-lighten-4">
                            Daywise Responses
                        </h5>
                    </div>
                    <div class="aione-table">
                        <table class="compact">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th colspan="3">Responses</th>
                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Completed </th>
                                    <th>Incomplete </th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(isset($data['date_by']) && !empty($data['date_by'])) 
                                @foreach($data['date_by'] as $date_key => $date_val)
                                    <tr>
                                        <td>{{$date_val->date}}</td>
                                        <td>{{$date_val->total}}</td>
                                        <td>{{$date_val->completed}}</td>
                                        <td>{{$date_val->uncompleted}}</td>
                                    </tr>
                                @endforeach
                                 @else
                                    {!!aione_message('No Data Exist','error','center')!!}
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="ar pb-20">
            <div class="ac s100 m100 l50">
                <div class="aione-widget bg-grey bg-lighten-5">
                    <div class="aione-title aione-border-top aione-border-right aione-border-left">
                        <h5 class="aione-align-center font-weight-400 m-0 pv-10 bg-grey bg-lighten-4">
                            User Responses
                        </h5>
                    </div>
                    <div class="aione-table">
                        <table class="compact">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th colspan="3">Responses</th>
                                </tr>
                                <tr>
                                    <th>User</th>
                                    <th>Total</th>
                                    <th>Web</th>
                                    <th>Application</th>
                                </tr>
                            </thead>
                            <tbody>
                              @if(isset($data['user_submit_from']) && !empty($data['user_submit_from'])) 
                                @foreach($data['user_submit_from'] as $user_submit_key => $user_submit_val)
                                <tr>
                                    <td>{{$user_submit_val->user_id}}</td>
                                    <td>{{$user_submit_val->total}}</td>
                                    <td>{{$user_submit_val->web}}</td>
                                    <td>{{$user_submit_val->application}}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="ac s100 m100 l50">
                <div class="aione-widget bg-grey bg-lighten-5">
                    <div class="aione-title aione-border-top aione-border-right aione-border-left">
                        <h5 class="aione-align-center font-weight-400 m-0 pv-10 bg-grey bg-lighten-4">
                            Daywise Responses
                        </h5>
                    </div>
                    <div class="aione-table">
                        <table class="compact">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th colspan="3">Responses</th>
                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Web</th>
                                    <th>Application </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($data['date_submit_from']) && !empty($data['date_submit_from'])) 
                                    @foreach($data['date_submit_from'] as $date_submit_key => $date_submit_val)
                                    <tr>
                                        <td>{{$date_submit_val->date}}</td>
                                        <td>{{$date_submit_val->total}}</td>
                                        <td>{{$date_submit_val->web}}</td>
                                        <td>{{$date_submit_val->application}}</td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
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
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection