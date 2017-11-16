{{ dump($data) }}
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
  
  @endphp 
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
   <div class="aione-tables">
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
                <td >01/10/2017</td>
            </tr>
            <tr>
                <td  class="light-blue darken-4 aione-align-center">158 Rani Ka Bagh, Amritsar, 143001.</td>
                <td >End Date:</td>
                <td >31/10/2017</td>
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
                <td >Ashish Kumar</td>
            </tr>
            <tr>
                <td  class="light-blue darken-4 aione-align-center">#14/560, Lane no 2, guru nanak avenue 8566820937</td>
                <td >Employee ID</td>
                <td >4095047</td>
            </tr>
            <tr>
                <td class="light-blue darken-4 aione-align-center">majitha road, Amritsar,143001 ashish9436@gmail.com</td>
                <td>Employee Pan</td>
                <td>AQ133344KL</td>
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
                <td >96000</td>
                <td >Total Days</td>
                <td >31</td>
                <td >Employee ID</td>
                <td >4095047</td>
            </tr>
            <tr>
                <td >P / Month</td>
                <td >96000</td>
                <td >Paid Leave</td>
                <td >31</td>
                <td >Income Tax</td>
                <td >4095047</td>
            </tr>
            <tr>
                <td >P / Day</td>
                <td >96000</td>
                <td >Total Days</td>
                <td >31</td>
                <td >Employee ID</td>
                <td >4095047</td>
            </tr>
            
        </tbody>
    </table>
</div>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection