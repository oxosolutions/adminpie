
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
    // $details = $salary->user_detail->metas->pluck('value','key');
     // $details['pay_scale']
     // App\\Model\\Organization
     
@endphp 
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@if(Session::has('error'))
   
@else
{{-- <div class="aione-tables">
    <table>
        <thead>
            <tr>
                <th class="bg-light-blue bg-darken-4 white aione-align-center">EMPLOYER INFORMATION</th>
                <th colspan="2" class="bg-light-blue bg-darken-4 white aione-align-center">PAY PERIOD</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="light-blue darken-4 aione-align-center">OXO IT SOLUTIONS PVT. LTD.</td>
                <td >Begin Date:</td>
                <td >01/{{ $salary['month'] }}/{{ $salary['year'] }}</td>
            </tr>
            <tr>
                <td  class="light-blue darken-4 aione-align-center">158 Rani Ka Bagh, Amritsar, 143001.</td>
                <td >End Date:</td>
                <td >31/{{ $salary['month'] }}/{{ $salary['year'] }}</td>
            </tr>
            <tr>
                <td class="light-blue darken-4 aione-align-center">01832401000, 9501010103, 9914149090</td>
                <td>Pay Date:</td>
                <td>13/11/2017</td>
            </tr>
        </tbody>
     </table>
    <table>
        <thead>
            <tr>
                <th class="bg-light-blue bg-darken-4 white aione-align-center">EMPLOYEE ADDRESS</th>
                <th colspan="2" class="bg-light-blue bg-darken-4 white aione-align-center">EMPLOYEE INFORMATION</th>
            </tr>
        </thead>
         <tbody>
            <tr>
                <td class="light-blue darken-4 aione-align-center">Ashish Kumar</td>
                <td >Employee Name</td>
                <td >{{ $salary['user_detail']['belong_group']['name']}}</td>
            </tr>
            <tr>
                <td  class="light-blue darken-4 aione-align-center">#14/560, Lane no 2, guru nanak avenue 8566820937</td>
                <td >Employee ID</td>
                <td >{{ $salary['employee_id'] }} </td>
            </tr>
            <tr>
                <td class="light-blue darken-4 aione-align-center">majitha road, Amritsar,143001 {{  $salary['user_detail']['belong_group']['email'] }}</td>
                <td>Employee Pan</td>
                <td>Axxx33344KL</td>
            </tr>
        </tbody>

        
    </table>
    <table>
         <thead>
            <tr>
                <th colspan="6" class="bg-light-blue bg-darken-4 white aione-align-center">ACCOUNT</th>
                
            </tr>
        </thead>
         <tbody>
            <tr>
                <td colspan="2" class="light-blue darken-4 aione-align-center">SALARY</td>
                <td colspan="2" class="light-blue darken-4 aione-align-center">DAYS</td>
                <td colspan="2" class="light-blue darken-4 aione-align-center">TOTAL EARNED</td>
            </tr>
            <tr>
                <td >P / Year</td>
                <td >{{ $salary['salary'] }}</td>
                <td >Total Days</td>
                <td >{{ $salary['total_days'] }}</td>
                <td >Employee ID</td>
                <td >4095047</td>
            </tr>
            <tr>
                <td >P / Month</td>
                <td >{{ $salary['salary'] }}</td>
                <td >Paid Leave</td>
                <td >31</td>
                <td >Income Tax</td>
                <td >4095047</td>
            </tr>
            <tr>
                <td >P / Day</td>
                <td >{{ $salary['per_day_amount'] }}</td>
                <td >Total Days</td>
                <td >31</td>
                <td >Employee ID</td>
                <td >4095047</td>
            </tr>
            
        </tbody>
    </table>
</div> --}}
<div class="ar mb-20">
    <div class="ac l20">
        <div class="aione-border">
            <div class="">
                <h5 class="aione-align-center font-weight-400 m-0 pv-10 bg-grey bg-lighten-4 aione-border-bottom">
                    Employee No
                </h5>
            </div>
            <div class="p-15">
                    {{-- "employee_id" => "40085012"
                    "designation" => "2"
                    "department" => "3"
                    "user_shift" => "1"
                    "pay_scale" => "1"
                    "date_of_joining" --}}
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
            {{-- "title" => "Fresher"
  "description" => null
  "currency" => "rupeees"
  "pay_cycle" => null
  "pay_scale" => "0.00"
  "basic_pay" => "85000.00"
  "grade_pay" => "0.00"
  "ta" => "10000.00"
  "da" => "200.00"
  "sa" => null
  "hra" => null
  "epf_addiction" => null
  "epf_deducation" => null
  "sa_details" => null
  "total_salary" => "100000.00"
  "gross_salary" => "100000.00" --}}
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
</div>

@endif
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection