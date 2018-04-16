@extends('layouts.main')
@section('content')
<style type="text/css">
    .special-btn{
    color: #039be5 !important;
    background: none !important;
    padding: 0 !important;
    margin: 0 !important;
    font-size: 15px !important;
    }
    .aione-tooltip:before{
        width: auto !important;
        white-space: pre !important;
    }
    .aione-button:hover i{
        color: #454545 !important;
    }
</style>
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Attendance',
	'add_new' => '+ Add Designation'
);
    $month = [1=>'January', 'February' , 'March' ,'April', 'May', 'June' , 'July', 'August', 'September', 'October', 'November','December'];
@endphp 
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
    @include('organization.attendance._tabs')
    <div>
        <div class="aione-border mb-15">
            <div class="aione-border-bottom bg-grey bg-lighten-3 p-10 font-size-18">
                Filters
            </div>
            <div class="p-10">
                
                <div id="field_label_group_id" class="field-label">
                    <label for="input_group_id">
                        <h4 class="field-title" id="Select Group ID">Select year</h4>
                    </label>
                </div><!-- field label-->
                <div id="field_group_id" class="field field-type-select">
                    {!! Form::open(['route'=>'lists.attendance']) !!}
                        <div class="ar">
                            <div class="ac l100">
                                {!! Form::selectRange('year', 2015,2030, @$data['year'], ['id'=>'input_group_id', 'class'=>'browser-default select-year']) !!}        
                            </div>
                            <div class="loading display-none line-height-40 font-weight-800 font-size-18">
                                Loading...
                            </div>
                          {{--   <div class="ac l20">
                                {!! Form::submit('Submit',['style'=>'width:100%']) !!}        
                            </div> --}}
                        </div>
                    {!! Form::close() !!}
                    <script type="text/javascript">
                        $(document).on('change','.select-year',function(){
                            $('.loading').show();
                            this.form.submit();

                        })
                    </script>
                </div>
            
            </div>
        </div>
       

        {{-- <div class=" aione-table">
            <table>
                <thead>
                    <tr>
                        <th>Months</th>
                        
                        <th>Status</th>
                        <th style="width: 400px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i=1; $i<=12; $i++)
                    @if(strlen($i)==1)
                        @php
                        $j = '0'.$i;
                        @endphp
                        @else
                         @php
                        $j = $i;
                        @endphp

                    @endif
                    <tr>
                        <td>{{$month[$i]}}</td>
                       
                        </td>
                        <td>
                            @if(isset($data[$j]))

                                    @if($data[$j]['attendance_status']==0)
                                        @php
                                           $attendance_status ='Partially';
                                        @endphp
                                    @else
                                        @php
                                           $attendance_status ='Complete';
                                        @endphp
                                    @endif
                                    {{$attendance_status}}
                            @else
                            Not Mark
                            @endif
                        </td>
                        
                        <td>
                            <a href="" class="aione-button bg-orange circle aione-shadow aione-tooltip" title="View Attendance">
                                <i class="fa fa-tv white line-height-36"></i>
                            </a>
                            <a href="" class="aione-button bg-red circle aione-shadow aione-tooltip" title="Edit Attendance">
                                <i class="fa fa-pencil white line-height-36"></i>
                            </a>
                            <a href="" class="aione-button bg-green circle aione-shadow aione-tooltip" title="Import Attendance">
                                <i class="fa fa-sign-in white line-height-36"></i>
                            </a>
                            <a href="{{ route('hr.attendance',['year'=>$data['year'],'month'=>$j]) }}" class="aione-button bg-light-blue circle aione-shadow aione-tooltip" title="Mark Attendance">
                                <i class="fa fa-table white line-height-36"></i>
                            </a>
                            <a href="" class="aione-button bg-light-blue circle aione-shadow aione-tooltip" title="Lock Attendance">
                                <i class="fa fa-unlock white line-height-36"></i>
                            </a>
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
           
        </div> --}}
        
    </div>
    <div>
    	<div class="ar mb-100">
    		@for($i=1; $i<=12; $i++)
                @if(strlen($i)==1)
                    @php
                        $j = '0'.$i;
                    @endphp
                @else
                    @php
                        $j = $i;
                    @endphp
                @endif
        		<div class="ac l25 aione-align-center mb-20" style="position: relative;">
        			<div class="bg-grey bg-darken-3 font-size-18  white p-15">
        				<i class="ion-calendar mr-10"></i>{{ $month[$i] }}, {{ $data['year'] }}
        			</div>
        			<div class="aione-border-left aione-border-right aione-border-bottom pv-10  border-grey border-lighten-2 bg-grey bg-lighten-4">
        				<div class="font-size-20 pv-20 line-height-60 font-weight-300 green ar">
    	    				@if(isset($data[$j]))
                                    @if($data[$j]['attendance_status']==0)
                                        @php
                                           $attendance_status ='Partially';
                                        @endphp
                                    @else
                                        @php
                                           $attendance_status ='Complete';
                                        @endphp
                                    @endif
                                <div class="ac l50">
                                    <div class="line-height-10 font-size-15 grey darken-1 font-weight-700">
                                        STATUS
                                    </div>
                                    <div class="">
                                        <span class="display-inline pv-5 ph-10 white bg-orange  font-size-14" style="border-radius: 10px;">
                                            {{$attendance_status}}</span>
                                    </div>
                                                                        
                                </div>
                            @else
                                <div class="ac l50">
                                    <div class="line-height-10 font-size-15 grey darken-1 font-weight-700">
                                        STATUS
                                    </div>
                                    <div class="">
                                        <span class="display-inline pv-5 ph-10 white bg-red bg-lighten-2 font-size-14" style="border-radius: 10px;">
                                            Not Mark
                                        </span>
                                    </div>                                    
                                </div>
                            @endif
                            @if(isset($data[$j]))
                                <div class="ac l50 aione-border-left border-grey border-lighten-2">
                                    <div class="line-height-10 font-size-15 grey darken-1 font-weight-700">
                                        LOCK STATUS
                                    </div>
                                    <div class="">
                                        @if($data[$j]['lock_status']==0)
                                            <span class="display-inline pv-5 ph-10 white bg-green bg-lighten-2 font-size-14" style="border-radius: 10px;">
                                                Locked
                                            </span>
                                        @else
                                            <span class="display-inline pv-5 ph-10 white bg-green bg-lighten-2 font-size-14" style="border-radius: 10px;">
                                                Un-Locked
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="ac l50 aione-border-left border-grey border-lighten-2">
                                    <div class="line-height-10 font-size-15 grey darken-1 font-weight-700">
                                        LOCK STATUS
                                    </div>
                                    <div class="">
                                        <span class="display-inline pv-5 ph-10 white bg-red bg-lighten-2 font-size-14" style="border-radius: 10px;">
                                            Un-Locked
                                        </span>
                                    </div>
                                </div>
                            @endif
        				</div>
        				<div>
        					<a href="" class="aione-button  circle aione-shadow " title="View Attendance">
                                <i class="fa fa-tv grey lighten-1 line-height-36"></i>
                            </a>
                            <a href="" class="aione-button  circle aione-shadow " title="Edit Attendance" >
                                <i class="fa fa-pencil grey lighten-1  line-height-36"></i>
                            </a>
                            <a href="" class="aione-button  circle aione-shadow " title="Import Attendance" >
                                <i class="fa fa-sign-in grey lighten-1  line-height-36"></i>
                            </a>
                            <a href="{{ route('hr.attendance',['year'=>$data['year'],'month'=>$j]) }}" class="aione-button  circle aione-shadow " title="Mark Attendance" >
                                <i class="fa fa-table grey lighten-1 line-height-36"></i>
                            </a>
                            @if(@$data[$j]['lock_status'] == 0 &&  @$data[$j]['lock_status'] == null)
                                <a href="" class="aione-button  circle aione-shadow " title="Lock Attendance">
                                    <i class="fa fa-unlock grey lighten-1 line-height-36"></i>
                                </a>
                            @else
                                <a href="" class="aione-button bg-red circle aione-shadow " title="Lock Attendance">
                                    <i class="fa fa-lock white lighten-1 line-height-36"></i>
                                </a>
                            @endif
        				</div>
        			</div>
        		</div>    
            @endfor
    	</div>
    </div>

@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
<script type="text/javascript">
    function view_attendance(month){
        year = $("#input_group_id").val();
        window.location.replace(route()+'/atendance/'+year+'/'+month);
    }

    function import_attendance(month){
        year = $("#input_group_id").val();
        alert(year, month);
         window.location.replace(route()+'/attendance/import/'+year+'/'+month);//+);
    }
</script>	
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection