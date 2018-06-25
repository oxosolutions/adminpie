
@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
  'show_page_title' => 'yes',
  'show_add_new_button' => 'yes',
  'show_navigation' => 'yes',
  'page_title' => 'Salary',
); 
    $id = "";
    if(!empty($salary['payscale'])){
        $payscale = json_decode($salary->payscale,true);
    }
@endphp 
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
<style type="text/css">
    .crop{
        width: 100%;
        height: 140px;
        overflow: hidden;
    }
    .crop img {
        width: auto;
        height: 250px;
        margin: -65px 0 -30px -30px;
    }
</style>
@if(Session::has('error'))
   
@else

<div class="aione-border p-20 mv-100">
    
    <div class="ar">
        <div class="ac l60">
            <div class="crop">
                <img src="http://oxoitsolutions.com/wp-content/uploads/sites/30/2017/09/oxo_solutions.png" >                
            </div>
            <div class="font-weight-700  font-size-16 line-height-24">
                OXO IT Solutions Private Limited
            </div>
            <div class="line-height-24">
                #158, Rani Ka Bagh,
                Near Shivaji Park,
                Amritsar, 143001
            </div>
                        
        </div>
        <div class="ac l40">
            <div class="font-weight-700  font-size-16 line-height-24 p-10">
                Employee Detail
            </div>
            <ul class="aione-border">
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 ">Name</span>
                    <span class="aione-float-right">{{$salary->user_detail->name}}</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 ">Designation</span>
                    <span class="aione-float-right">{{@$designation_name}}</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 ">Employee ID</span>
                    <span class="aione-float-right">{{$salary->employee_id}}</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 ">Address</span>
                    
                    <span class="aione-float-right">
                    @if(!empty($salary->user_detail->metas->where('key','permanent_address')->first()))
                    {{@$salary->user_detail->metas->where('key','permanent_address')->first()->value}}
                    @endif
                    </span>
                </li>
                <li class=" p-10">
                    <span class="font-weight-700  ">PAN Number</span>
                    
                    <span class="aione-float-right">AUK3394L</span>
                </li>
            </ul>
        </div>

    </div>
    <div class="mv-20" style="border: 1px dashed #e8e8e8">
        
    </div>
    <div class="ar">
        <div class="ac l50">
            <h5 class="font-weight-700  font-size-16 m-0 p-10 bg-grey bg-lighten-4 ">
                Payment
                <span class="aione-float-right">Amount</span>
            </h5>
            <ul class="aione-border">
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 ">Basic Pay</span>
                    <span class="aione-float-right">{{$payscale['basic_pay']}}</span>
                </li>
            @if(!empty($payscale['ta']))
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 ">TA</span>
                    <span class="aione-float-right">{{$payscale['ta']}}</span>
                </li>
            @endif  
            @if(!empty($payscale['da']))      
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 ">DA</span>
                    <span class="aione-float-right">{{$payscale['da']}}</span>
                </li>
            @endif
            @if(!empty($payscale['hra']))
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700  ">HRA</span>
                    <span class="aione-float-right">{{$payscale['hra']}}</span>
                </li>
            @endif
                <li class=" p-10 aione-border-bottom">
                    <span class="font-weight-700  ">Other Allowences</span>
                    
                    <span class="aione-float-right">{{@number_format($salary['over_time'], 2, '.',',')}}</span>
                </li>
                <li class=" p-10">
                    <span class="font-weight-700 ">Bonus</span>
                    
                    <span class="aione-float-right">0</span>
                </li>
            </ul>
           
        </div>
        <div class="ac l50">
            <h5 class="font-weight-700  font-size-16 m-0 p-10 bg-grey bg-lighten-4 ">
                Deductions
                <span class="aione-float-right">Amount</span>
            </h5>
            <ul class="aione-border">
               {{--  <li class="aione-border-bottom p-10">
                    <span class="font-weight-700  ">PF</span>
                    <span class="aione-float-right">1900</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700  ">PLI</span>
                    <span class="aione-float-right">1200</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700  ">Income Tax & EC</span>
                    <span class="aione-float-right">2300</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700  ">PLI</span>
                    <span class="aione-float-right">1200</span>
                </li> --}}
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700  ">Loss of Pay</span>
                    <span class="aione-float-right">{{number_format($salary['short_hours'], 2,".",",")}}</span>
                </li>
                {{-- <li class=" p-10">
                    <span class="font-weight-700  ">Opening Balance</span>
                    
                    <span class="aione-float-right">0</span>
                </li> --}}
                
            </ul>
            
        </div>
        
    </div>
    <div class="ar">
        <div class="ac l50">
            <div class="aione-border mv-10 p-10">
                <span class="font-weight-700  font-size-18">Gross Salary</span>
                    
                <span class="aione-float-right font-size-18">{{ number_format(($salary['salary'] + $salary['over_time']) , 2 ,"." ,",") }}</span>
            </div>
        </div>
        <div class="ac l50">
            <div class="aione-border mv-10 p-10">
                <span class="font-weight-700  font-size-18">Net Deduction</span>
                    
                <span class="aione-float-right font-size-18">{{number_format($salary['short_hours'],2,'.',',')}}</span>
            </div>    
        </div>
            
    </div>
     <div class="mv-20" style="border: 1px dashed #e8e8e8">
        
    </div>
    <div class="ar">
         <div class="ac l50">
            <div class="font-weight-700  font-size-16 line-height-24 p-10">
                Year to date
            </div>
            <ul class="aione-border">
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700  ">Taxable Gross Pay</span>
                    <span class="aione-float-right">992283</span>
                </li>
                <li class="p-10">
                    <span class="font-weight-700  ">Income tax</span>
                    <span class="aione-float-right">36445</span>
                    
                </li>
                
            </ul>
        </div>
        <div class="ac l50">
            <div class="font-weight-700  font-size-16 line-height-24 p-10">
                This Period
            </div>
            <ul class="aione-border">
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700  ">Gross Salary</span>
                    <span class="aione-float-right">{{ number_format(($salary['salary'] + $salary['over_time']) , 2 ,"." ,",") }}</span>
                </li>
                <li class="p-10">
                    <span class="font-weight-700  ">Net Deduction</span>
                    <span class="aione-float-right">{{number_format($salary['short_hours'],2,'.',',')}}</span>
                </li>
                
            </ul>
        </div>
    </div>
    <div class="ar">
        <div class="ac l50">
          
        </div>
        <div class="ac l50">
            <div class="aione-border mv-10 p-10">
                <span class="font-weight-700  font-size-18">Net Salary</span>
                    
                <span class="aione-float-right font-size-18">{{number_format($salary['salary'],2,'.',',')}}</span>
            </div>    
        </div>
            
    </div>
</div>
{{-- <div class="aione-border p-20 grey mb-100">
    <h4 class="aione-align-center font-weight-300 grey">PAYSLIP FOR THE MONTH OF SEPTEMBER 2017</h4>
    <div class="ar">
        <div class="ac l60">
            <div>
                <img src="http://oxoitsolutions.com/wp-content/uploads/sites/30/2017/09/oxo_solutions.png" style="height: 120px">                
            </div>
            <div class="font-weight-700 grey font-size-16 line-height-24">
                OXO IT Solutions Private Limited
            </div>
            <div class="line-height-24">
                #!58, Rani Ka Bagh,<br>
                Near Shivaji Park,<br>
                Amritsar, 143001
            </div>
                        
        </div>
        <div class="ac l40">
            <div class="font-weight-700 grey font-size-16 line-height-24 p-10">
                Employee Detail
            </div>
            <ul class="aione-border">
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">Name</span>
                    <span class="aione-float-right">Ashish Kumar</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">Designation</span>
                    <span class="aione-float-right">Web Developer</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">Employee ID</span>
                    <span class="aione-float-right">40015001</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">Address</span>
                    
                    <span class="aione-float-right">#20, Rani ka bagh, Amritsar, 143001</span>
                </li>
                <li class=" p-10">
                    <span class="font-weight-700 grey ">PAN Number</span>
                    
                    <span class="aione-float-right">AUK3394L</span>
                </li>
            </ul>
        </div>

    </div>
    <div class="mv-20" style="border: 1px dashed #e8e8e8">
        
    </div>
    <div class="ar">
        <div class="ac l50">
            <h5 class="font-weight-700 grey font-size-16 m-0 p-10 bg-grey bg-lighten-4 ">
                Payment
                <span class="aione-float-right">Amount</span>
            </h5>
            <ul class="aione-border">
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">Basic Pay</span>
                    <span class="aione-float-right">12000</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">TA</span>
                    <span class="aione-float-right">1200</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">DA</span>
                    <span class="aione-float-right">2300</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">HRA</span>
                    
                    <span class="aione-float-right">1200</span>
                </li>
                <li class=" p-10 aione-border-bottom">
                    <span class="font-weight-700 grey ">Other Allowences</span>
                    
                    <span class="aione-float-right">0</span>
                </li>
                <li class=" p-10">
                    <span class="font-weight-700 grey ">Bonus</span>
                    
                    <span class="aione-float-right">0</span>
                </li>
            </ul>
           
        </div>
        <div class="ac l50">
            <h5 class="font-weight-700 grey font-size-16 m-0 p-10 bg-grey bg-lighten-4 ">
                Deductions
                <span class="aione-float-right">Amount</span>
            </h5>
            <ul class="aione-border">
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">PF</span>
                    <span class="aione-float-right">1900</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">PLI</span>
                    <span class="aione-float-right">1200</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">Income Tax & EC</span>
                    <span class="aione-float-right">2300</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">PLI</span>
                    
                    <span class="aione-float-right">1200</span>
                </li>
                <li class=" p-10">
                    <span class="font-weight-700 grey ">Opening Balance</span>
                    
                    <span class="aione-float-right">0</span>
                </li>
                
            </ul>
            
        </div>
        
    </div>
    <div class="ar">
        <div class="ac l50">
            <div class="aione-border mv-10 p-10">
                <span class="font-weight-700 grey font-size-18">Gross Salary</span>
                    
                <span class="aione-float-right font-size-18">21000</span>
            </div>
        </div>
        <div class="ac l50">
            <div class="aione-border mv-10 p-10">
                <span class="font-weight-700 grey font-size-18">Net Salary</span>
                    
                <span class="aione-float-right font-size-18">21000</span>
            </div>    
        </div>
            
    </div>
     <div class="mv-20" style="border: 1px dashed #e8e8e8">
        
    </div>
    <div class="ar">
         <div class="ac l50">
            <div class="font-weight-700 grey font-size-16 line-height-24 p-10">
                Year to date
            </div>
            <ul class="aione-border">
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">Taxable Gross Pay</span>
                    <span class="aione-float-right">992283</span>
                </li>
                <li class="p-10">
                    <span class="font-weight-700 grey ">Income tax</span>
                    <span class="aione-float-right">36445</span>
                </li>
                
            </ul>
        </div>
        <div class="ac l50">
            <div class="font-weight-700 grey font-size-16 line-height-24 p-10">
                This Period
            </div>
            <ul class="aione-border">
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">Total Payment</span>
                    <span class="aione-float-right">9922833</span>
                </li>
                <li class="p-10">
                    <span class="font-weight-700 grey ">Total Deduction</span>
                    <span class="aione-float-right">36445</span>
                </li>
                
            </ul>
        </div>
    </div>
</div> --}}
{{-- ===================================================================================================================================== --}}
{{-- <div class="aione-border p-20 grey mv-100 ">
    
    <div class="ar">
        <div class="ac l60">
            <div class="">
                <img src="http://oxoitsolutions.com/wp-content/uploads/sites/30/2017/09/oxo_solutions.png" style="height: 200px">                
            </div>
            <div class="font-weight-700 grey font-size-16 line-height-24">
                OXO IT Solutions Private Limited
            </div>
            <div class="line-height-24">
                #158, Rani Ka Bagh,
                Near Shivaji Park,
                Amritsar, 143001
            </div>
                        
        </div>
        <div class="ac l40">
            <div class="font-weight-700 grey font-size-16 line-height-24 p-10">
                Employee Detail
            </div>
            <ul class="aione-border">
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">Name</span>
                    <span class="aione-float-right">Ashish Kumar</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">Designation</span>
                    <span class="aione-float-right">Web Developer</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">Employee ID</span>
                    <span class="aione-float-right">40015001</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">Address</span>
                    
                    <span class="aione-float-right">#20, Rani ka bagh, Amritsar, 143001</span>
                </li>
                <li class=" p-10">
                    <span class="font-weight-700 grey ">PAN Number</span>
                    
                    <span class="aione-float-right">AUK3394L</span>
                </li>
            </ul>
        </div>

    </div>
    <div class="mv-20" style="border: 1px dashed #e8e8e8">
        
    </div>
    <div class="ar">
        <div class="ac l50">
            <h5 class="font-weight-700 grey font-size-16 m-0 p-10 bg-grey bg-lighten-4 ">
                Payment
                <span class="aione-float-right">Amount</span>
            </h5>
            <ul class="aione-border">
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">Basic Pay</span>
                    <span class="aione-float-right">12000</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">TA</span>
                    <span class="aione-float-right">1200</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">DA</span>
                    <span class="aione-float-right">2300</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">HRA</span>
                    
                    <span class="aione-float-right">1200</span>
                </li>
                <li class=" p-10 aione-border-bottom">
                    <span class="font-weight-700 grey ">Other Allowences</span>
                    
                    <span class="aione-float-right">0</span>
                </li>
                <li class=" p-10">
                    <span class="font-weight-700 grey ">Bonus</span>
                    
                    <span class="aione-float-right">0</span>
                </li>
            </ul>
           
        </div>
        <div class="ac l50">
            <h5 class="font-weight-700 grey font-size-16 m-0 p-10 bg-grey bg-lighten-4 ">
                Deductions
                <span class="aione-float-right">Amount</span>
            </h5>
            <ul class="aione-border">
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">PF</span>
                    <span class="aione-float-right">1900</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">PLI</span>
                    <span class="aione-float-right">1200</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">Income Tax & EC</span>
                    <span class="aione-float-right">2300</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">PLI</span>
                    
                    <span class="aione-float-right">1200</span>
                </li>
                <li class=" p-10">
                    <span class="font-weight-700 grey ">Opening Balance</span>
                    
                    <span class="aione-float-right">0</span>
                </li>
                
            </ul>
            
        </div>
        
    </div>
    <div class="ar">
        <div class="ac l50">
            <div class="aione-border mv-10 p-10">
                <span class="font-weight-700 grey font-size-18">Gross Salary</span>
                    
                <span class="aione-float-right font-size-18">21000</span>
            </div>
        </div>
        <div class="ac l50">
            <div class="aione-border mv-10 p-10">
                <span class="font-weight-700 grey font-size-18">Net Salary</span>
                    
                <span class="aione-float-right font-size-18">21000</span>
            </div>    
        </div>
            
    </div>
     <div class="mv-20" style="border: 1px dashed #e8e8e8">
        
    </div>
    <div class="ar">
         <div class="ac l50">
            <div class="font-weight-700 grey font-size-16 line-height-24 p-10">
                Year to date
            </div>
            <ul class="aione-border">
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">Taxable Gross Pay</span>
                    <span class="aione-float-right">992283</span>
                </li>
                <li class="p-10">
                    <span class="font-weight-700 grey ">Income tax</span>
                    <span class="aione-float-right">36445</span>
                </li>
                
            </ul>
        </div>
        <div class="ac l50">
            <div class="font-weight-700 grey font-size-16 line-height-24 p-10">
                This Period
            </div>
            <ul class="aione-border">
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">Total Payment</span>
                    <span class="aione-float-right">9922833</span>
                </li>
                <li class="p-10">
                    <span class="font-weight-700 grey ">Total Deduction</span>
                    <span class="aione-float-right">36445</span>
                </li>
                
            </ul>
        </div>
    </div>
</div> --}}
{{-- =====================================================================================================================================
<div class="aione-border p-20 grey mv-100">
    
    <div class="ar">
        <div class="ac l60">
            <div class="crop">
                <img src="http://oxoitsolutions.com/wp-content/uploads/sites/30/2017/09/oxo_solutions.png" >                
            </div>
            <div class="font-weight-700 grey font-size-16 line-height-24">
                OXO IT Solutions Private Limited
            </div>
            <div class="line-height-24">
                #158, Rani Ka Bagh,
                Near Shivaji Park,
                Amritsar, 143001
            </div>
                        
        </div>
        <div class="ac l40">
            <div class="font-weight-700 grey font-size-16 line-height-24 p-10">
                Employee Detail
            </div>
            <ul class="aione-border">
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">Name</span>
                    <span class="aione-float-right">Ashish Kumar</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">Designation</span>
                    <span class="aione-float-right">Web Developer</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">Employee ID</span>
                    <span class="aione-float-right">40015001</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">Address</span>
                    
                    <span class="aione-float-right">#20, Rani ka bagh, Amritsar, 143001</span>
                </li>
                <li class=" p-10">
                    <span class="font-weight-700 grey ">PAN Number</span>
                    
                    <span class="aione-float-right">AUK3394L</span>
                </li>
            </ul>
        </div>

    </div>
    <div class="mv-20" style="border: 1px dashed #e8e8e8">
        
    </div>
    <div class="ar">
        <div class="ac l50">
            <h5 class="font-weight-700 grey font-size-16 m-0 p-10 bg-grey bg-lighten-4 ">
                Payment
                <span class="aione-float-right">Amount</span>
            </h5>
            <ul class="aione-border">
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">Basic Pay</span>
                    <span class="aione-float-right">12000</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">TA</span>
                    <span class="aione-float-right">1200</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">DA</span>
                    <span class="aione-float-right">2300</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">HRA</span>
                    
                    <span class="aione-float-right">1200</span>
                </li>
                <li class=" p-10 aione-border-bottom">
                    <span class="font-weight-700 grey ">Other Allowences</span>
                    
                    <span class="aione-float-right">0</span>
                </li>
                <li class=" p-10">
                    <span class="font-weight-700 grey ">Bonus</span>
                    
                    <span class="aione-float-right">0</span>
                </li>
            </ul>
           
        </div>
        <div class="ac l50">
            <h5 class="font-weight-700 grey font-size-16 m-0 p-10 bg-grey bg-lighten-4 ">
                Deductions
                <span class="aione-float-right">Amount</span>
            </h5>
            <ul class="aione-border">
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">PF</span>
                    <span class="aione-float-right">1900</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">PLI</span>
                    <span class="aione-float-right">1200</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">Income Tax & EC</span>
                    <span class="aione-float-right">2300</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">PLI</span>
                    
                    <span class="aione-float-right">1200</span>
                </li>
                <li class=" p-10">
                    <span class="font-weight-700 grey ">Opening Balance</span>
                    
                    <span class="aione-float-right">0</span>
                </li>
                
            </ul>
            
        </div>
        
    </div>
    <div class="ar">
        <div class="ac l50">
            <div class="aione-border mv-10 p-10">
                <span class="font-weight-700 grey font-size-18">Gross Salary</span>
                    
                <span class="aione-float-right font-size-18">21000</span>
            </div>
        </div>
        <div class="ac l50">
            <div class="aione-border mv-10 p-10">
                <span class="font-weight-700 grey font-size-18">Net Salary</span>
                    
                <span class="aione-float-right font-size-18">21000</span>
            </div>    
        </div>
            
    </div>
     <div class="mv-20" style="border: 1px dashed #e8e8e8">
        
    </div>
    <div class="ar">
         <div class="ac l50">
            <div class="font-weight-700 grey font-size-16 line-height-24 p-10">
                Year to date
            </div>
            <ul class="aione-border">
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">Taxable Gross Pay</span>
                    <span class="aione-float-right">992283</span>
                </li>
                <li class="p-10">
                    <span class="font-weight-700 grey ">Income tax</span>
                    <span class="aione-float-right">36445</span>
                </li>
                
            </ul>
        </div>
        <div class="ac l50">
            <div class="font-weight-700 grey font-size-16 line-height-24 p-10">
                This Period
            </div>
            <ul class="aione-border">
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">Total Payment</span>
                    <span class="aione-float-right">9922833</span>
                </li>
                <li class="p-10">
                    <span class="font-weight-700 grey ">Total Deduction</span>
                    <span class="aione-float-right">36445</span>
                </li>
                
            </ul>
        </div>
    </div>
</div>
=====================================================================================================================================
<div class="aione-border p-20 grey mv-100">
    
    <div class="ar">
        <div class="ac l60">
            <div class="crop">
                <img src="http://oxoitsolutions.com/wp-content/uploads/sites/30/2017/09/oxo_solutions.png" >                
            </div>
            <div class="font-weight-700 grey font-size-16 line-height-24">
                OXO IT Solutions Private Limited
            </div>
            <div class="line-height-24">
                #158, Rani Ka Bagh,
                Near Shivaji Park,
                Amritsar, 143001
            </div>
                        
        </div>
        <div class="ac l40">
            <div class="font-weight-700  font-size-16 line-height-24 p-10 light-blue darken-2">
                Employee Detail
            </div>
            <ul class="aione-border">
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">Name</span>
                    <span class="aione-float-right">Ashish Kumar</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">Designation</span>
                    <span class="aione-float-right">Web Developer</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">Employee ID</span>
                    <span class="aione-float-right">40015001</span>
                </li>
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">Address</span>
                    
                    <span class="aione-float-right">#20, Rani ka bagh, Amritsar, 143001</span>
                </li>
                <li class=" p-10">
                    <span class="font-weight-700 grey ">PAN Number</span>
                    
                    <span class="aione-float-right">AUK3394L</span>
                </li>
            </ul>
        </div>

    </div>
    <div class="mv-20" style="border: 1px dashed #e8e8e8">
        
    </div>
    <div class="ar">
        <div class="ac l50">
            <h5 class="font-weight-700 grey font-size-16 m-0 p-10 bg-light-blue bg-darken-2 white ">
                Payment
                <span class="aione-float-right white">Amount</span>
            </h5>
            <ul class="aione-border bg-light-blue bg-lighten-5 border-white">
                <li class="aione-border-bottom p-10 border-white">
                    <span class="font-weight-700 grey ">Basic Pay</span>
                    <span class="aione-float-right">12000</span>
                </li>
                <li class="aione-border-bottom p-10 border-white">
                    <span class="font-weight-700 grey ">TA</span>
                    <span class="aione-float-right">1200</span>
                </li>
                <li class="aione-border-bottom p-10 border-white">
                    <span class="font-weight-700 grey ">DA</span>
                    <span class="aione-float-right">2300</span>
                </li>
                <li class="aione-border-bottom p-10 border-white">
                    <span class="font-weight-700 grey ">HRA</span>
                    
                    <span class="aione-float-right">1200</span>
                </li>
                <li class=" p-10 aione-border-bottom border-white">
                    <span class="font-weight-700 grey ">Other Allowences</span>
                    
                    <span class="aione-float-right">0</span>
                </li>
                <li class=" p-10">
                    <span class="font-weight-700 grey ">Bonus</span>
                    
                    <span class="aione-float-right">0</span>
                </li>
            </ul>
           
        </div>
        <div class="ac l50">
            <h5 class="font-weight-700 grey font-size-16 m-0 p-10 bg-light-blue bg-darken-2 white">
                Deductions
                <span class="aione-float-right white">Amount</span>
            </h5>
            <ul class="aione-border bg-light-blue bg-lighten-5 border-white">
                <li class="aione-border-bottom p-10 border-white">
                    <span class="font-weight-700 grey ">PF</span>
                    <span class="aione-float-right">1900</span>
                </li>
                <li class="aione-border-bottom p-10 border-white">
                    <span class="font-weight-700 grey ">PLI</span>
                    <span class="aione-float-right">1200</span>
                </li>
                <li class="aione-border-bottom p-10 border-white">
                    <span class="font-weight-700 grey ">Income Tax & EC</span>
                    <span class="aione-float-right">2300</span>
                </li>
                <li class="aione-border-bottom p-10 border-white">
                    <span class="font-weight-700 grey ">PLI</span>
                    
                    <span class="aione-float-right">1200</span>
                </li>
                <li class=" p-10">
                    <span class="font-weight-700 grey ">Opening Balance</span>
                    
                    <span class="aione-float-right">0</span>
                </li>
                
            </ul>
            
        </div>
        
    </div>
    <div class="ar">
        <div class="ac l50">
            <div class="aione-border mv-10 p-10 border-light-blue border-darken-2">
                <span class="font-weight-700 grey font-size-18">Gross Salary</span>
                    
                <span class="aione-float-right font-size-18">21000</span>
            </div>
        </div>
        <div class="ac l50">
            <div class="aione-border mv-10 p-10 border-light-blue border-darken-2">
                <span class="font-weight-700 grey font-size-18">Net Salary</span>
                    
                <span class="aione-float-right font-size-18">21000</span>
            </div>    
        </div>
            
    </div>
     <div class="mv-20" style="border: 1px dashed #e8e8e8">
        
    </div>
    <div class="ar">
         <div class="ac l50">
            <div class="font-weight-700 light-blue darken-2 font-size-16 line-height-24 p-10">
                Year to date
            </div>
            <ul class="aione-border">
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">Taxable Gross Pay</span>
                    <span class="aione-float-right">992283</span>
                </li>
                <li class="p-10">
                    <span class="font-weight-700 grey ">Income tax</span>
                    <span class="aione-float-right">36445</span>
                </li>
                
            </ul>
        </div>
        <div class="ac l50">
            <div class="font-weight-700 light-blue darken-2 font-size-16 line-height-24 p-10">
                This Period
            </div>
            <ul class="aione-border">
                <li class="aione-border-bottom p-10">
                    <span class="font-weight-700 grey ">Total Payment</span>
                    <span class="aione-float-right">9922833</span>
                </li>
                <li class="p-10">
                    <span class="font-weight-700 grey ">Total Deduction</span>
                    <span class="aione-float-right">36445</span>
                </li>
                
            </ul>
        </div>
    </div>
</div>
===================================================================================================================================== --}}

{{-- <div class="ar mb-20">
    <div class="ac l20">
        <div class="aione-border">
            <div class="">
                <h5 class="aione-align-center font-weight-400 m-0 pv-10 bg-grey bg-lighten-4 aione-border-bottom">
                    Employee No
                </h5>
            </div>
            <div class="p-15">
                   
                 {{$salary['employee_id']}} 
            </div>
        </div>
    </div>
    <div class="ac l40">
        <div class="aione-border">
            <div class="">
                <h5 class="aione-align-center font-weight-400 m-0 pv-10 bg-grey bg-lighten-4 aione-border-bottom">
                    Employee Name
                </h5>
            </div>
            <div class="p-15">
                   {{$salary['user_detail']['name']}} 

            </div>
        </div>
    </div>
    <div class="ac l20">
        <div class="aione-border">
            <div class="">
                <h5 class="aione-align-center font-weight-400 m-0 pv-10 bg-grey bg-lighten-4 aione-border-bottom">
                    Process date
                </h5>
            </div>
            <div class="p-15">
              {{date('d-M-Y', strtotime($salary->created_at))}}
            </div>
        </div>
    </div>
    <div class="ac l20">
        <div class="aione-border">
            <div class="">
                <h5 class="aione-align-center font-weight-400 m-0 pv-10 bg-grey bg-lighten-4 aione-border-bottom">
                   PAN Number
                </h5>
            </div>
            <div class="p-15">
                   XXXXXXXXXXXX
            </div>
        </div>
    </div>

    
</div>
<div class="ar mb-20">
    <div class="ac l60">
        <div class="aione-border">
            <div class="">
                <h5 class="aione-align-left font-weight-400 m-0 p-10 bg-grey bg-lighten-4 aione-border-bottom">
                    Payment<span class="aione-float-right">Amount</span>
                </h5>
            </div>

            <div class="p-15 line-height-30">
                   Basic pay<span class="aione-float-right">{{$payscale['basic_pay']}}</span><br>
                   TA<span class="aione-float-right">{{$payscale['ta']}}</span><br>
                   DA(16%)<span class="aione-float-right">{{$payscale['da']}}</span><br>
                   HRA(18%)<span class="aione-float-right">{{$payscale['hra']}}</span><br>
                   Other allowence<span class="aione-float-right">-</span><br>
                   Bonus<span class="aione-float-right">-</span><br>
            </div>
        </div>
    </div>
    <div class="ac l40">
        <div class="aione-border">
            <div class="">
                <h5 class="aione-align-left font-weight-400 m-0 p-10 bg-grey bg-lighten-4 aione-border-bottom">
                    Deductions<span class="aione-float-right">Amount</span>
                </h5>
            </div>
            <div class="p-15 line-height-30">
                   Income Tax & EC<span class="aione-float-right">-</span><br>
                   National Insurence<span class="aione-float-right">-</span><br>
                   PLI<span class="aione-float-right">-</span><br>
                   Provident Fund<span class="aione-float-right">-</span><br>
                   
            </div>
        </div>
    </div>
</div>
<div class="ar mb-20">
    <div class="ac l33">
        <div class="aione-border">
            <div class="">
                <h5 class="aione-align-left font-weight-400 m-0 p-10 bg-grey bg-lighten-4 aione-border-bottom">
                    Employee Details
                </h5>
            </div>
            <div class="p-15 line-height-30">
                {{$salary['user_detail']['name']}} <br>
               Gali no XX<br>
               XXXXX<br>
             city:  XX
            </div>
        </div>
    </div>
    <div class="ac l33">
        <div class="aione-border">
            <div class="">
                <h5 class="aione-align-center font-weight-400 m-0 p-10 bg-grey bg-lighten-4 aione-border-bottom">
                    This Peroid
                </h5>
            </div>
            <div class="p-15 line-height-30">
                Total Payments<span class="aione-float-right">{{$salary['salary']}}</span><br>
                Total Deductions<span class="aione-float-right">--</span><br>
            </div>
        </div>
    </div>
    <div class="ac l33">
        <div class="aione-border">
            <div class="">
                <h5 class="aione-align-center font-weight-400 m-0 p-10 bg-grey bg-lighten-4 aione-border-bottom">
                    Year to date
                </h5>
            </div>
            <div class="p-15 line-height-30">
                Taxable Gross Pay<span class="aione-float-right">--</span><br>
                Income Tax<span class="aione-float-right">--</span><br>
                Employee NIC<span class="aione-float-right">--</span><br>
                Employer NIC<span class="aione-float-right">--</span><br>
            </div>
        </div>
    </div>
</div> --}}

@endif
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection