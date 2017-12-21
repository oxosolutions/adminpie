
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
  // dump($salary);
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
                007
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
                    Mr James Bond                   
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
                   31-Jan-2012
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
                   AX55248K0
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
                   Basic pay<span class="aione-float-right">6600</span><br>
                   TA<span class="aione-float-right">1600</span><br>
                   DA(16%)<span class="aione-float-right">2500</span><br>
                   HRA(18%)<span class="aione-float-right">4000</span><br>
                   Other allowence<span class="aione-float-right">3000</span><br>
                   Bonus<span class="aione-float-right">0</span><br>
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
                   Income Tax & EC<span class="aione-float-right">600</span><br>
                   National Insurence<span class="aione-float-right">160</span><br>
                   PLI<span class="aione-float-right">250</span><br>
                   Provident Fund<span class="aione-float-right">400</span><br>
                   
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
               James Bond<br>
               Gali no 10<br>
               Rani ka bagh<br>
               Amritsar
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
                Total Payments<span class="aione-float-right">6000</span><br>
                Total Deductions<span class="aione-float-right">160</span><br>
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
                Taxable Gross Pay<span class="aione-float-right">600000000</span><br>
                Income Tax<span class="aione-float-right">1600000</span><br>
                Employee NIC<span class="aione-float-right">1600000</span><br>
                Employer NIC<span class="aione-float-right">1600000</span><br>
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