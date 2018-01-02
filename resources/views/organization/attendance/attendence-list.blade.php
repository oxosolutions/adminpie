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

                    {{-- {!! Form::selectRange('year', 2016, 2030,['id'=>'input_group_id', 'class'=>'input_group_id browser-default']) !!} --}}
                    <select class="input_group_id browser-default " id="input_group_id" name="group_id">
                        <option value="2011">2011</option>
                        <option value="">2012</option>
                        <option value="">2013</option>
                        <option value="">2014</option>
                        <option value="">2015</option>
                        <option value="">2016</option>
                        <option value="2017">2017</option>
                        <option value="">2018</option>
                        <option value="">2019</option>
                        <option value="">2020</option>
                        <option value="">2021</option>
                        <option value="">2022</option>
                        <option value="">2023</option>
                        
                    </select>
                </div><!-- field -->
            </div>
        </div>
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
                <li class="aione-border p-10 mb-10 ar">
                    <div class="ac l15">
                        <strong>January</strong>    
                    </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-lock ph-5"></i>Locked    
                        </a>
                        
                    </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-television ph-5"></i> <a href="#" onclick="attendance_filter(null, null, 1, 2017)"> View </a>
                        </a>
                    </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-pencil ph-5"></i> Edit
                        </a>
                    </div>

                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-sign-in ph-5"></i>Import    
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
                <li class="aione-border p-10 mb-10 ar">
                    <div class="ac l15">
                        February
                    </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-lock ph-5"></i>Locked    
                        </a>
                        
                    </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-television ph-5"></i> View
                        </a>
                    </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-pencil ph-5"></i> Edit
                        </a>
                    </div>

                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-sign-in ph-5"></i>Import    
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
                <li class="aione-border p-10 mb-10 ar">
                    <div class="ac l15">
                    March
                    </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-lock ph-5"></i>Locked    
                        </a>
                        
                    </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-television ph-5"></i> View
                        </a>
                    </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-pencil ph-5"></i> Edit
                        </a>
                    </div>

                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-sign-in ph-5"></i>Import    
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
                <li class="aione-border p-10 mb-10 ar">
                    <div class="ac l15">
                    April
                      </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-lock ph-5"></i>Locked    
                        </a>
                        
                    </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-television ph-5"></i> View
                        </a>
                    </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-pencil ph-5"></i> Edit
                        </a>
                    </div>

                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-sign-in ph-5"></i>Import    
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
                <li class="aione-border p-10 mb-10 ar">
                    <div class="ac l15">
                    May
                      </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-lock ph-5"></i>Locked    
                        </a>
                        
                    </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-television ph-5"></i> View
                        </a>
                    </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-pencil ph-5"></i> Edit
                        </a>
                    </div>

                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-sign-in ph-5"></i>Import    
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
                <li class="aione-border p-10 mb-10 ar">
                    <div class="ac l15">
                    June
                      </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-lock ph-5"></i>Locked    
                        </a>
                        
                    </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-television ph-5"></i> View
                        </a>
                    </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-pencil ph-5"></i> Edit
                        </a>
                    </div>

                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-sign-in ph-5"></i>Import    
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
                <li class="aione-border p-10 mb-10 ar">
                    <div class="ac l15">
                    July
                      </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-lock ph-5"></i>Locked    
                        </a>
                        
                    </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-television ph-5"></i> View
                        </a>
                    </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-pencil ph-5"></i> Edit
                        </a>
                    </div>

                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-sign-in ph-5"></i>Import    
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
                <li class="aione-border p-10 mb-10 ar">
                    <div class="ac l15">
                    August
                      </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-lock ph-5"></i>Locked    
                        </a>
                        
                    </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-television ph-5"></i> View
                        </a>
                    </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-pencil ph-5"></i> Edit
                        </a>
                    </div>

                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-sign-in ph-5"></i>Import    
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
                <li class="aione-border p-10 mb-10 ar">
                    <div class="ac l15">
                    September
                      </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-lock ph-5"></i>Locked    
                        </a>
                        
                    </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-television ph-5"></i> View
                        </a>
                    </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-pencil ph-5"></i> Edit
                        </a>
                    </div>

                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-sign-in ph-5"></i>Import    
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
                <li class="aione-border p-10 mb-10 ar">
                    <div class="ac l15">
                    October
                      </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-lock ph-5"></i>Locked    
                        </a>
                        
                    </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-television ph-5"></i> View
                        </a>
                    </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-pencil ph-5"></i> Edit
                        </a>
                    </div>

                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-sign-in ph-5"></i>Import    
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
                <li class="aione-border p-10 mb-10 ar">
                    <div class="ac l15">
                    November
                      </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-lock ph-5"></i>Locked    
                        </a>
                        
                    </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-television ph-5"></i> View
                        </a>
                    </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-pencil ph-5"></i> Edit
                        </a>
                    </div>

                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-sign-in ph-5"></i>Import    
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
                <li class="aione-border p-10 mb-10 ar">
                    <div class="ac l15">
                    December
                      </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-lock ph-5"></i>Locked    
                        </a>
                        
                    </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-television ph-5"></i> View
                        </a>
                    </div>
                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-pencil ph-5"></i> Edit
                        </a>
                    </div>

                    <div class="ac l15">
                        <a href="">
                            <i class="fa fa-sign-in ph-5"></i>Import    
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
                
            </ul>
        </div>
        <div id="main">

        </div>
    </div>
<script type="text/javascript">

    function attendance_filter(date, week, mo, yr){
        yr = $("#input_group_id").val();
       
        date =  week =null;
        console.log(date, week, mo, yr);
        var postData = {};
        postData['date'] = date;
        postData['week'] = week;
        postData['month'] = mo;
        postData['years'] = yr;
        postData['_token'] = $("#token").val();
        $.ajax({
                url:route()+'/attendance/list/ajax',
                type:'POST',
                data:postData,
                success: function(res){

                    $("#main").html(res);
                    $("#month , #week ,#days").hide();

                    if(date)
                    {
                        $("#days").show();
                        console.log('day');
                        $(".daily").addClass("aione-active");

                    }else if(week){
                        $("#week").show();
                        console.log('week');
                        $(".weekly").addClass("aione-active");
                    }else{
                        $("#month").show();
                        console.log('month');
                        $(".monthly").addClass("aione-active");
                    }
                    $('select').material_select();
                
                    console.log('data sent successfull ');
                }
            });
        }
    


        
    
</script>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
	
@include('common.page_content_secondry_end')
@include('common.pagecontentend')


@endsection