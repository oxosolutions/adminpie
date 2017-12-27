{{-- @include('common.pageheader',$page_title_data)  --}}

@php
dump($salary);
@endphp
<style type="text/css">
    .mycolor{
        color: blue;
    }
</style>
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@if(Session::has('error'))
   
@else
   <div class="aione-tables">
    <table>
        <thead>
            <tr>
                <th class="bg-light-blue bg-darken-4 white aione-align-center mycolor">EMPLOYER INFORMATION</th>
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
                <td>1X/1X/201X</td>
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
</div>
@endif
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
