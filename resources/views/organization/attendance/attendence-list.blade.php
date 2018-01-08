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
</style>
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Attendance List',
	'add_new' => '+ Add Designation'
);
    $month = [1=>'January', 'February' , 'March' ,'April', 'May', 'June' , 'July', 'August', 'September', 'October', 'November','December'];
@endphp 
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
    <div>
       <div class="aione-form-wrapper aione-form-theme-light aione-form-label-position- aione-form-style- aione-form-border aione-form-field-border aione-form-section-border">
            <div  data-conditions="0" data-field-type="select" class="field-wrapper ac field-wrapper-group_id field-wrapper-type-select ">
                <div id="field_label_group_id" class="field-label">
                    <label for="input_group_id">
                        <h4 class="field-title" id="Select Group ID">Select year</h4>
                    </label>
                </div><!-- field label-->
                <div id="field_group_id" class="field field-type-select">
                    {!! Form::open(['route'=>'lists.attendance']) !!}
                        <div class="ar">
                            <div class="ac l80">
                                {!! Form::selectRange('year', 2015,2030, @$data['year'], ['id'=>'input_group_id', 'class'=>'browser-default']) !!}        
                            </div>
                            <div class="ac l20">
                                {!! Form::submit('Submit',['style'=>'width:100%']) !!}        
                            </div>
                        </div>
                        
                        
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="mt-20">
            <ul>
                <li class="p-10 ar">
                    <div class="ac l14 font-weight-600">
                        Months
                    </div>
                    <div class="ac l14 font-weight-600">
                        lock/Unlock
                    </div> 
                    <div class="ac l14 font-weight-600">
                        Status
                    </div>
                    <div class="ac l14">
                        
                    </div>
                    <div class="ac l14">
                        
                    </div>
                    
                </li>
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
            
             <li class="aione-border p-10 mb-10 ar">
                    <div class="ac l14">
                        <strong>{{$month[$i]}}</strong>    
                    </div>
                    <div class="ac l14">
                            @if(isset($data[$j]))
                             {!! Form::open(['route'=>'ajax.lock.attendance']) !!}
                             	<input type="hidden" name="year" value="{{$data['year']}}">
                    			<input type="hidden" name="month" value="{{$j}}">
                                    @if($data[$j]['lock_status']==0)
                                    	
                                        {!! Form::submit('Unlock',['name'=>'unlock','class'=>'special-btn','style'=>'color:orange !important']) !!}

                                    @else 
                                        {!! Form::submit('Locked',['name'=>'lock','class'=>'special-btn','style'=>'color:green !important']) !!}
                                    @endif
                                    
                              {!! Form::close() !!}
                                @else
                                    <span class="red">-</span>
                            @endif
                    </div>
                    <div class="ac l14">
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

                    </div>
                    <div class="ac l14">
                        {{-- <a href=""> 
                            <i class="fa fa-television ph-5"></i> <a href="#" onclick="view_attendance(1)"> View </a>
                        </a> --}}
                        {!! Form::open(['route'=>'list.attendance']) !!}
                    		<input type="hidden" name="year" value="{{$data['year']}}">
                    		<input type="hidden" name="month" value="{{$j}}">
                            {!! Form::submit('view',['class'=>'special-btn']) !!}
                        {!! Form::close() !!}
                    </div>
                    <div class="ac l14">
                    	 @if(isset($data[$j]))
                        <a href="">
                             
                            {!! Form::open(['route'=>'hr.attendance']) !!}
                    		<input type="hidden" name="year" value="{{$data['year']}}">
                    		<input type="hidden" name="month" value="{{$j}}">
                    		<input type="hidden" name="date" value="1">
                            {!! Form::submit('edit',['class'=>'special-btn']) !!}
                        {!! Form::close() !!}
                        </a>
                        @else
                        	-
                        @endif
                    </div>

                    <div class="ac l14">
                        <a href="{{route('import.form.attendance',['year'=>$data['year'],'month'=>$j])}}">import</a>
                    </div>
                    <div class="ac l14">
                        
                        {!! Form::open(['route'=>'hr.attendance']) !!}
                    		<input type="hidden" name="year" value="{{$data['year']}}">
                    		<input type="hidden" name="month" value="{{$j}}">
                    		<input type="hidden" name="date" value="1">
                            {!! Form::submit('Mark attendace',['class'=>'special-btn']) !!}
                        {!! Form::close() !!}
                        
                    </div>
                    <div class="ac l14">
                        
                    </div>
                </li>
        @endfor
              </ul>
        </div>
        <div id="main">

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