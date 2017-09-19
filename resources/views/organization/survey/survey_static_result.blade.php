@extends('layouts.main')
@section('content')
<style type="text/css">
	#aione_form_wrapper_abc{
		border:1px solid #e8e8e8;
		margin-bottom: 10px;
		padding: 10px
	}
	.remove_condition i{
		    font-size: 22px;
    display: inline-block;
    margin-top: 54px;
    margin-right: 30px;
    float: right;
	}
	.search-options,.result-options{
		margin-bottom: 10px
	}
	.search-options input[type=submit],
	.result-options input,
	.result-options a{
		float:right;
	}
	.result-options input{
		    float: left;
    background-color: #168dc5;
    color: white;
   
	
    display: inline-block;
    padding: 0 10px;
   
   
   
    font-size: 16px;
    line-height: 30px;
    font-weight: 400;
    font-family: "Open Sans",Arial,Helvetica,sans-serif;
    text-align: center;
    cursor: pointer;
    -webkit-transition: all 150ms ease-out;
    -moz-transition: all 150ms ease-out;
    -o-transition: all 150ms ease-out;
    transition: all 150ms ease-out;	
	}
	.result-options input:hover{
		background-color: #168dc5
	}

</style>
@php
if(!empty($data)){

	$head = [
  "address" => "Address of the accident site",
  "accident_date" => "Date of accident",
  "accident_time" => "Time of accident",
  "accident_type" => "Type of collision",
  "sub_type_of_road" => "Road features",
  "type_of_injury1" => "Number of fatally injured persons",
  "type_of_injury2" => "Number of grievous injured persons",
  "type_of_injury3" => "Number of minor injured persons" ];
 	// $data = json_decode(json_encode($data->all()),true);  Address of

 	// dump($data[0]);
	//$keys = array_keys($data[0]);
	$keys = array_values($head);

}
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Survey Results',
    'add_new' => '+ Add Media'
); 
@endphp 
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('organization.survey._tabs')
@if(!empty($data))
@php
// dump($condition_data , $errors);
	$th = $option='';
	foreach($keys as $key =>$val){
		 $option[$val] = $val;
		$th .= "<th>$val</th>";
	}

	$dt = Carbon\Carbon::now();
	// dump($dt->toDateString());
	// dump($dt->weekOfMonth);
	 // $operator = ['>', '<','=','>=','<='];
@endphp

<div  class="field-wrapper field-wrapper-SLUG field-wrapper-type-select ">
	
		{!! Form::open(['route'=>['survey.stats.report'],'method' => 'post' ]) !!}

	<div class="aione-row result-options">
				{!! Form::submit('Export records as CSV',['name'=>'export','class'=>'aione-button aione-button-large aione-button-light aione-button-square add-new-button','style'=>'float:right']) !!}
				
			</div>	
				
	{!! Form::close() !!}
</div>
<div class="aione-table">
	<table id="info">
		<thead>
			<tr>
				<th colspan="4">Summary information</th>
			</tr>
		</thead>
			
		<tbody>
			<tr>
				<td>Reporting date</td>
				<td> {{date('d-m-Y')}}</td>
				<td>Reporting week </td>
				<td>{{$dt->weekOfMonth}}</td>
			</tr>
			<tr>
				<td>Reporting unit name</td>
				<td colspan="3">______________________</td>
			</tr>
			<tr>
				<td>Total number of accident durning last two weeks</td>
				<td colspan="3">{{@$last_two_week}}</td>
			</tr>
			<tr>
				<td>Total number of fatally injured person</td>
				<td colspan="3"></td>
			</tr>
			<tr>
				<td>Total number of grieviously injured person</td>
				<td colspan="3"></td>
			</tr>
			<tr>
				<td>Total number with minor injuries</td>
				<td colspan="3"></td>
			</tr>
		</tbody>
	</table>
</div>






	<div id="table-structure" class="aione-table scrollx">
		<table class="compact">
	        <thead>
				<tr>
					@foreach($keys as $key =>$val)
						<th>
							<span class="aione-tooltip truncate" > {{@$val}} </span>
						</th>
					@endforeach
				</tr>
	        </thead>
	        <tbody>
		        @foreach($data as $keys => $vals )
					<tr>
						@foreach($vals as $queKey => $queVal)
						 
						@if($queKey =='sub_type_of_road')
						<td>
							<span class="aione-tooltip truncate" tooltip-data="{{$queVal}}">
							@php
							$val_data = json_decode($queVal,true);
							
							@endphp
								@if(!empty($val_data))
								<span class="aione-tooltip truncate" tooltip-data="{{$queVal}}">
									@foreach($val_data as $keyOpt => $valOpt)
										{{$option_data[$keyOpt]}}, 
									@endforeach
								</span>
								@else 
								nothing select
								@endif
							
								
						</td>
						@else
							<td>
								<span class="aione-tooltip truncate" tooltip-data="{{$queVal}}">
								{{$queVal}}</span>
							</td>
						@endif
	 					@endforeach
					</tr>
				@endforeach
	        </tbody>
	    </table>
	</div>


            
	</div>

	@else
	<div><h2> No Data Exist</h2></div>
@endif
<script>
$('#more_condition').on('click',function(event){
	event.preventDefault();
	childs = $("#child").html();
	$("#append").append(childs);
});

function remove_parent(event){
	$(event).parent('div').remove();
}

$(".close").hide();
</script>

@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection