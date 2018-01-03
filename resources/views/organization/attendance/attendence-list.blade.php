@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Attendance List',
	'add_new' => '+ Add Designation'
);
    $month = [1=>'jan', 'feb' , 'March' ,'April', 'May', 'June' , 'july', 'Aug', 'Sep', 'oct', 'nov','dec'];
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

                    {!! Form::selectRange('year', 2015,2030, @$data['year'], ['id'=>'input_group_id', 'class'=>'browser-default']) !!}
                   {{--  <select class="input_group_id browser-default " id="input_group_id" name="year">
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                    </select> --}}
                    {!! Form::submit() !!}
                </div><!-- field -->
            </div>
        </div>


       {{--  {{dump($data['lock_status'])}} --}}
        {{-- {{dd($data['lock_status']['01'])}} --}}
      
    
        <div class="mt-20">
            <ul>
                <li class="p-10 ar">
                    <div class="ac l15 font-weight-600">
                        Months
                    </div>
                    <div class="ac l15 font-weight-600">
                        Status
                    </div>
                    <div class="ac l15">
                        
                    </div>
                    <div class="ac l15">
                        
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
                    <div class="ac l15">
                        <strong>{{$month[$i]}}</strong>    
                    </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-lock ph-5"></i>
                            @if(!empty($data['lock_status'][$j]))
                                    @if($data['lock_status'][$j]==0)
                                        Locked
                                    @else 
                                        unlock
                                    @endif
                                @else
                                    not have Attendance data
                            @endif   
                        </a>
                        
                    </div>
                    <div class="ac l15">
                        <a href=""> 
                            {{-- {{url('hrm/atendance/2017/1')}} --}}
                            <i class="fa fa-television ph-5"></i> <a href="#" onclick="view_attendance(1)"> View </a>
                        </a>
                    </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-pencil ph-5"></i> Edit
                        </a>
                    </div>

                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-sign-in ph-5"></i><a href="#" onclick="import_attendance(1)"> Import </a>    
                        </a>
                        
                    </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-pencil-square-o ph-5"></i>Mark Attendance    
                        </a>
                        
                    </div>
                    <div class="ac l15">
                        
                    </div>
                </li>
        @endfor
              </ul>
        </div>
        <div id="main">

        </div>
    </div>
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
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
	
@include('common.page_content_secondry_end')
@include('common.pagecontentend')


@endsection