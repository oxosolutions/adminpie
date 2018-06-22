@extends('layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Add Pay Scale',
	'add_new' => 'List pay scale',
	'route' => 'list.payscale'
); 
@endphp	
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	{!! Form::model(@$data,['route'=>['edit.payscale' , $data->id] , 'class'=> 'form-horizontal','method' => 'post']) !!}
		{!! FormGenerator::GenerateForm('organization_hrm_payscale_form') !!}
	
	<div class="ar">
		<div class="ac l50">
			{!! FormGenerator::GenerateForm('organization_hrm_payscale_earnings_form',[],$data->toArray()) !!}
			
		</div>
		<div class="ac l50">
			{!! FormGenerator::GenerateForm('organization_hrm_payscale_deductions_form',[],$data->toArray()) !!}
		</div>

	</div>
	<div class="ar">
		<div class="ac l50">
			<div class="aione-table allowances">
				<table>
					<thead>
						<tr>
							<th>Allowances</th>
							<th>Amount</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><b>Total</b></td>
							<td class="allow_total">Nill</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="ac l50">
			<div class="aione-table deductions">
				<table>
					<thead>
						<tr>
							<th>Deductions</th>
							<th>Amount</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><b>Total</b></td>
							<td class="deduct_total">Nill</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="ar">
		<div class="ac l50 mt-15">
			<div class="aione-border ar">
				<div class="ac l50 p-15">
					Gross Salary
				</div>
				<div class="ac l50 p-15 aione-align-right gross_salary">
					Null
				</div>
			</div>
		</div>
	</div>
	<div class="ar mt-15 aione-border ph-12">
		<div class="ac l50 p-15">
			Net Salary
		</div>
		<div class="ac l50 p-15 aione-align-right net_salary">
			Nill
		</div>
	</div>
    <input type="hidden" value="" name="net_salary">
	<button type="submit" class="m-10">Submit</button>
	{!!Form::close()!!}
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
<script type="text/javascript">
    $(function(){
        calculateSalary();
        $('body').on('change','input,select', function(){
             calculateSalary();
        });
        $('.allowances .repeater-row, .deductions .repeater-row').find('.input-value').keyup(function(){
            var amount = $(this).val();
            if(getValue(amount).isMatch == false){
                $(this).val(amount.match( /\d+/g )[0]);
            }
        });
        function calculateSalary(){
            var basic_pay = $('input[name=basic_pay]').val();
            //Calculate Allowances
            var totalAmount = parseInt(basic_pay);
            var allownceCount = 0;
            $('.allowances .repeater-row').each(function(){
                var amount = $(this).find('.input-value').val();
                var isPercentage = getValue(amount);
                if(isPercentage.isPercent == true){
                    var percentageAmount = (basic_pay*isPercentage.value)/100;
                    totalAmount = parseInt(totalAmount) + parseInt(percentageAmount);
                    allownceCount = allownceCount + parseInt(percentageAmount);
                }else{
                    totalAmount = parseInt(totalAmount) + parseInt(isPercentage.value);
                    allownceCount = allownceCount + parseInt(isPercentage.value);
                }
            });
            $('.allow_total').html(allownceCount);
            $('.gross_salary').html(totalAmount);

             //Calculate Deduction
            
            var deductCount = 0;
            $('.deductions .repeater-row').each(function(){
                var amount = $(this).find('.input-value').val();
                var isPercentage = getValue(amount);
                if(isPercentage.isPercent == true){
                    var percentageAmount = (basic_pay*isPercentage.value)/100;
                    deductCount = deductCount + parseInt(percentageAmount);
                }else{
                    deductCount = deductCount + parseInt(isPercentage.value);
                }
            });
            $('.deduct_total').html(deductCount);
            $('.net_salary').html(totalAmount - deductCount);
            $('input[name=net_salary]').val(totalAmount - deductCount);
        }

        function getValue(num) {
           var matches=num.match(/(^\s*\d+\.?\d*)(%)?\s*$/);
           var m = false, p = false, v = 0;
           if (matches) {
              m = true;
              p = (matches[2]=="%");
              v = matches[1];
           }
           return {isMatch: m, isPercent: p, value: v};
        }

    });
</script>
@endsection