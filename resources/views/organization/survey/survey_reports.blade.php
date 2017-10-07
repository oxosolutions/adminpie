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
		background-color: none;
	}
</style>
@php
if(!empty($data)){
// $data = json_decode(json_encode($data->all()),true);
$keys = array_keys($data[0]);
}
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Survey Report',
    'add_new' => '+ Add Media'
); 
@endphp 
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('organization.survey._tabs')




<div  class="field-wrapper field-wrapper-SLUG field-wrapper-type-select ">
	<p>Filters</p>
		{!! Form::open(['route'=>['survey.reports',$id],'method' => 'post' ]) !!}
			<div id='parent'>
				<div id="field_fields" class="field-wrapper field-wrapper-fields field-wrapper-type-select ">
					<div id="field_label_select_status" class="field-label">
						<label for="input_select_status">
							<h4 class="field-title" id="select_fiellds">Select Fields</h4>
						</label>
					</div>
					<div id="field_fields" class="field field-type-multi_select">
						{!! Form::select('fields[]',$columns,null,['placeholder'=>'Select field' ,'multiple'=>true, 'class'=>'browser-default select'])  !!}
					</div>
				</div>

				{{-- <div id="field_fields" class="field-wrapper field-wrapper-fields field-wrapper-type-select ">
					<div id="field_label_select_status" class="field-label">
						<label for="input_select_status">
							<h4 class="field-title" id="select_fiellds">Concat Fields</h4>
						</label>
					</div>
					<div id="field_fields" class="field field-type-multi_select">
						{!! Form::select('concat_fields[]',$columns,null,['placeholder'=>'Select field' ,'multiple'=>true, 'class'=>'browser-default select'])  !!}
						

					</div>
				</div>

				<div id="field_fields" class="field-wrapper field-wrapper-fields field-wrapper-type-select ">
					<div id="field_label_select_status" class="field-label">
						<label for="input_select_status">
							<h4 class="field-title" id="select_fiellds">Name to Concat Fields</h4>
						</label>
					</div>
					<div id="field_fields" class="field field-type-multi_select">
						{!! Form::text('concat_name[]')  !!}
					</div>
				</div> --}}
				{{-- <div > 
					<div  class="field select field-type-select">
						<label for=""> Codition</label>
						{!! Form::select('condition_field[]',$columns,null,['placeholder'=>'select field conditon','class'=>'browser-default select'])  !!}
						<select name="operator[]" id="" class='browser-default'> 
							<option value=">"> > </option>
							<option value="<"> < </option>
							<option value=">="> >= </option>
							<option value="<="> <= </option>
							<option value="="> = </option>
							<option value="like"> like </option>
						</select>
						
					
						<label for="">Values</label>
						<input name="condition_field_value[]" type="text">
						 
						 
					</div>
				</div> --}}
				<div id='child'>
					<div id="aione_form_wrapper_abc" class="aione-form-wrapper aione-form-theme- aione-form-label-position- aione-form-style-   ">
						<div class="aione-row">
							<div id="field_condition_field" class="field-wrapper field-wrapper-condition_field field-wrapper-type-select l4">
								<div id="field_label_condition_field" class="field-label">

									<label for="input_condition_field">
										<h4 class="field-title" id="Codition">Concat Fields</h4>
									</label>

								</div><!-- field label-->
											

								<div id="field_condition_field" class="field field-type-multi_select">
									{!! Form::select('concat_fields[]',@$columns,null,['multiple'=>true ,'placeholder'=>'select field conditon','class'=>'browser-default select'])  !!}
									
								</div>
							</div>
							<div id="field_operator" class="field-wrapper field-wrapper-operator field-wrapper-type-select l3">
								<div id="field_label_operator" class="field-label">
									<label for="input_operator">
										<h4 class="field-title" id="Operator">Name to Concat Fields</h4>
									</label>

								</div><!-- field label-->
											

								<div id="field_operator" class="field field-type-select">
								<input type="text" name="concat_name[]" value="name">
								
									{{-- {!! Form::text('concat_name[]',)  !!} --}}
								</div>

							</div>
							
							<a  class="remove_condition" onclick="remove_parent(this)"> <i class="fa fa-trash-o"></i></a>
						</div>
						
					</div>
				</div>
				<div id='append'>
					
				</div>
			</div>
			<div class="aione-row search-options">
				<button id="more_condition" class="aione-button aione-button-large aione-button-light aione-button-square add-new-button"> + Add Concat</button>
				{!! Form::submit('Search') !!} 
			</div>
			<div class="aione-row result-options">
				{!! Form::submit('Export records as CSV',['name'=>'export','class'=>'aione-button aione-button-large aione-button-light aione-button-square add-new-button']) !!}
				{{-- <a href="{{route('delete.table',['table'=>$table])}}" > <button class="aione-button aione-button-large aione-button-light aione-button-square add-new-button white-text " style="background-color: #F44336;">Delete all records</button></a> --}}
			</div>	
				
	{!! Form::close() !!}
</div>

@if(!empty($data))
	@if($errors->any())
		 <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li style="color: red;">{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif
@php
// dump($condition_data , $errors);
	$th = $option='';
	foreach($keys as $key =>$val){
		$option[$val] = $val;
		$th .= "<th>$val</th>";
	}
	 // $operator = ['>', '<','=','>=','<='];
@endphp

	<div id="table-structure" class="aione-table scrollx">
		<table class="compact">
	        <thead>
				<tr>
					@foreach($keys as $key =>$val)
						<th>
							<span class="aione-tooltip truncate" tooltip-data="{{@$formQuestion[$val]}}"> {{@$val}} </span>
						</th>
					@endforeach
				</tr>
	        </thead>
	        <tbody>
		        @foreach($data as $keys => $vals )
					<tr>
						@foreach($vals as $queKey => $queVal)
							<td>
								<span class="aione-tooltip truncate" tooltip-data="{{$queVal}}">
								{{$queVal}}</span>
							</td>
	 					@endforeach
					</tr>
				@endforeach
	        </tbody>
	    </table>
	</div>


            
	</div>

	@else
	<div><h2> No Data Exist 1 </h2></div>
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