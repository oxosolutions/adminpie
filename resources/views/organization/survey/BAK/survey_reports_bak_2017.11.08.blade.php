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
	.result-options input{float: left;
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

if(!empty($data) && !isset($data['error'])){
	
// $data = json_decode(json_encode($data->all()),true);
	$keys = array_keys($data[0]);
}
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Survey Report <span>'.get_survey_title(request()->route()->parameters()['id']).'</span>',
    'add_new' => '+ Add Media'
); 
@endphp 
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('organization.survey._tabs')

@if(!empty($error))
	<div class="aione-message warning">
	            {{ __("survey.survey_results_table_missing") }}
	</div>
@else
{!! Form::open(['route'=>['survey.reports',@$id],'method' => 'post' ]) !!}
<div class="ar">
	<div class="ac l50 m100 a100">
		<div class="aione-border">
            <div class="">
                <h5 class="aione-align-center font-weight-400 m-0 pv-10 bg-grey bg-lighten-4 aione-border-bottom">
                    Horizontal Filteration
                </h5>
            </div>
           	<div id="aione_form_section_374" class="aione-form-section non-repeater p-5">
				<div id="field_fields" class="field-wrapper field-wrapper-fields field-wrapper-type-select ">
					<div id="field_label_select_status" class="field-label">
						<label for="input_select_status">
							<h4 class="field-title" id="select_fiellds">Select Fields</h4>
						</label>
					</div>
					<div id="field_fields" class="field field-type-multi_select">
						{!! Form::select('fields[]',@$columns,null,['placeholder'=>'Select field' ,'multiple'=>true, 'class'=>'browser-default select'])  !!}
					</div>

				</div>
			</div> <!-- .aione-form-section -->
        </div>
	</div>
	<div class="ac l50 m100 a100">
		<div class="aione-border">
            <div class="">
                <h5 class="aione-align-center font-weight-400 m-0 pv-10 bg-grey bg-lighten-4 aione-border-bottom">
                    Vertical Filteration
                </h5>
            </div>
           	<div id="aione_form_section_374" class="aione-form-section non-repeater p-5">
				<div class="aione-box">
					<style type="text/css">
					.repeater-wrapper .repeater-row > i{
					z-index: 999999
					}
					</style>
					<div class="repeater-group">
						<div class="repeater-wrapper">
						<div class="repeater-row ar">
						<i class="material-icons dp48 repeater-row-delete">close</i>
						<div id="aione_form_section_527" class="aione-form-section">
						<div class="aione-row">

						<div id="aione_form_section_content" class="aione-form-section-content">
						<div class="aione-row ar">
						<div id="field_2477" data-conditions="0" data-field-type="select" class="field-wrapper ac field-wrapper-column field-wrapper-type-select l33 m33 s100">
						<div id="field_column" class="field field-type-select">

							{!! Form::select('condition_field[]',$columns,null,['placeholder'=>'Select field' , 'class'=>'browser-default select'])  !!}
						</div><!-- field -->
						</div><!-- field wrapper -->	
						<div id="field_2478" data-conditions="0" data-field-type="select" class="field-wrapper ac field-wrapper-operation field-wrapper-type-select l33 m33 s100">


						<div id="field_operation" class="field field-type-select">

						<select class="input_operation browser-default " id="input_operation" name="operator[]">
							<option selected="selected" value=""></option>
							<option value="=">Equal to</option>
							<option value=">">Greater then</option>
							<option value="<">Less then</option>
							<option value=">=">Greater then and equal to</option>
							<option value="<=">Less then and equal to</option>
							<option value="like"> match with </option>
						</select>		

						</div><!-- field -->
						</div><!-- field wrapper -->	
						<div id="field_2479" data-conditions="0" data-field-type="text" class="field-wrapper ac field-wrapper-value field-wrapper-type-text l33 m33 s100">


						<div id="field_value" class="field field-type-text">

						<input class="input-value" id="input_value" placeholder="" data-validation="" name="condition_field_value[]" type="text"> 


						</div><!-- field -->
						</div><!-- field wrapper -->	


						</div> <!-- .aione-row -->
						</div> <!-- .aione-form-content -->

						</div> <!-- .aione-row -->
						</div> <!-- .aione-form-section -->
						</div>
						</div>


					<button type="submit" class="aione-float-right aione-button add-new-repeater">Add New</button>
					<div style="clear: both">

					</div>

					</div>
				</div>
			</div> <!-- .aione-form-section -->
        </div>
	</div>	
</div>
<div  class="field-wrapper field-wrapper-SLUG field-wrapper-type-select ">
	
		<div id='parent'>
			{{-- <div id="field_fields" class="field-wrapper field-wrapper-fields field-wrapper-type-select ">
				<div id="field_label_select_status" class="field-label">
					<label for="input_select_status">
						<h4 class="field-title" id="select_fiellds">Select Fields</h4>
					</label>
				</div>
				<div id="field_fields" class="field field-type-multi_select">
					{!! Form::select('fields[]',@$columns,null,['placeholder'=>'Select field' ,'multiple'=>true, 'class'=>'browser-default select'])  !!}
				</div>

			</div>
 --}}
			{{-- <div class="ac l50 ">
					<div class="aione-box">
						<style type="text/css">
						.repeater-wrapper .repeater-row > i{
						z-index: 999999
						}
						</style>
						<div class="repeater-group">
							<div class="repeater-wrapper">
							<div class="repeater-row ar">
							<i class="material-icons dp48 repeater-row-delete">close</i>
							<div id="aione_form_section_527" class="aione-form-section">
							<div class="aione-row">

							<div id="aione_form_section_content" class="aione-form-section-content">
							<div class="aione-row ar">
							<div id="field_2477" data-conditions="0" data-field-type="select" class="field-wrapper ac field-wrapper-column field-wrapper-type-select l33 m33 s100">
							<div id="field_column" class="field field-type-select">

								{!! Form::select('condition_field[]',$columns,null,['placeholder'=>'Select field' , 'class'=>'browser-default select'])  !!}
							</div><!-- field -->
							</div><!-- field wrapper -->	
							<div id="field_2478" data-conditions="0" data-field-type="select" class="field-wrapper ac field-wrapper-operation field-wrapper-type-select l33 m33 s100">


							<div id="field_operation" class="field field-type-select">

							<select class="input_operation browser-default " id="input_operation" name="operator[]">
								<option selected="selected" value=""></option>
								<option value="=">Equal to</option>
								<option value=">">Greater then</option>
								<option value="<">Less then</option>
								<option value=">=">Greater then and equal to</option>
								<option value="<=">Less then and equal to</option>
								<option value="like"> match with </option>
							</select>		

							</div><!-- field -->
							</div><!-- field wrapper -->	
							<div id="field_2479" data-conditions="0" data-field-type="text" class="field-wrapper ac field-wrapper-value field-wrapper-type-text l33 m33 s100">


							<div id="field_value" class="field field-type-text">

							<input class="input-value" id="input_value" placeholder="" data-validation="" name="condition_field_value[]" type="text"> 


							</div><!-- field -->
							</div><!-- field wrapper -->	


							</div> <!-- .aione-row -->
							</div> <!-- .aione-form-content -->

							</div> <!-- .aione-row -->
							</div> <!-- .aione-form-section -->
							</div>
							</div>


						<button type="submit" class="aione-float-right aione-button add-new-repeater">Add New</button>
						<div style="clear: both">

						</div>

						</div>
					</div>
							
			</div> --}}

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
			{{-- <div id='child'>
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
							
								{{-- {!! Form::text('concat_name[]',)  !!}
							</div>

						</div>
						
						<a  class="remove_condition disappear" onclick="remove_parent(this)"> <i class="fa fa-trash-o"></i></a>
					</div>
					
				</div>
			</div>
			<div id='append'>
				
			</div> --}}
		</div>
		<div class="aione-row search-options aione-align-right mv-10">
			
			{{-- {!! Form::submit('Search') !!}  --}}
			
			{{-- {!! Form::submit('Export CSV',['name'=>'export']) !!}  --}}
			<button type="submit" class="aione-button" name="export"><i class="fa fa-sign-out mr-5"></i>Export Records</button>
			<button type="submit" class="aione-button" name="Search"><i class="fa fa-search mr-5"></i>Search</button>

		</div>
		{{-- <div class="aione-row result-options">
			{!! Form::submit('Export records as CSV',['name'=>'export','class'=>'aione-button aione-button-large aione-button-light aione-button-square add-new-button']) !!}
			<a href="{{route('delete.table',['table'=>$table])}}" > <button class="aione-button aione-button-large aione-button-light aione-button-square add-new-button white-text " style="background-color: #F44336;">Delete all records</button></a>
		</div> --}}	
			
	{!! Form::close() !!}
</div>


@if(empty($data))
		<div class="aione-message warning">
            {{ __('survey.survey_results_table_missing') }}
        </div>
@elseif(!empty($data['error']))
		<div class="aione-message warning">
           {{$data['error']}}
        </div>


@else

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
	$th = $option='';
	foreach($keys as $key =>$val){
		$option[$val] = $val;
		$th .= "<th>$val</th>";
	}
@endphp
	<div id="table-structure" class="aione-table scrollx">
		<table class="compact">
	        <thead>
				<tr>
					@foreach($keys as $key =>$val)
						@if(!empty($options_val[$val]))
							@foreach($options_val[$val] as $optKey => $optVal)
								<th>
									<span class="aione-tooltip truncate" tooltip-data="{{@$formQuestion[$val]}}">
										{{$val}}_{{$optKey}}
									</span>
								</th>
							@endforeach
						@elseif(!empty($repeater_data) &&  isset($repeater_data[$val] ))
							@foreach($repeater_data as $repeatKey  => $repeatVal)
								

								 @foreach($repeatVal['field_slug'] as $repeaterkey => $repeaterVal)
									<th>
										<span class="aione-tooltip truncate" tooltip-data="">
											{{@$val}}_{{ $repeaterVal }}
										</span>
									</th>
								@endforeach
							@endforeach
							@else

							<th>
								<span class="aione-tooltip truncate" tooltip-data="">
								{{ @$val }}
								</span>
							</th>
						@endif
					@endforeach
				</tr>
	        </thead>
	        <tbody>
	      
		        @foreach($data as $keys => $vals )
					<tr>
						@foreach($vals as $queKey => $queVal)
						 @if(!empty($options_val[$queKey]))
						 	@php
						 		$array_val = json_decode($queVal,true);
						 	@endphp
							@foreach($options_val[$queKey] as $optKey => $optVal)
								<td>
									<span class="aione-tooltip truncate" tooltip-data="{{$queVal}}">
										{{-- {{$optKey}} {{$optVal}} {{dump($array_val)}} --}}
										@if(is_array($array_val))
								 				@if(in_array($optKey, $array_val))
								 					yes
								 					@else
								 					no
								 				@endif
							 			@endif

										

									</span>	
								</td>
							@endforeach

						@elseif(!empty($repeater_check[$queKey]) && $repeater_check[$queKey] =='repeater')
								
								@php
									$repeater_value = json_decode($queVal, true);
								@endphp
								@foreach($repeater_data[$queKey]['field_slug'] as $dataKey =>$dataVal)
											<td> {{ implode(', ',array_column($repeater_value, $dataVal)) }}</td>							

								@endforeach
									
									
									{{-- <td>{{ dump($repeater_data[$queKey]['field_slug']) }}
										{{ $queKey }}
										{{ dump(json_decode($queVal, true)) }}</td> --}}
									{{-- @foreach(json_decode($queVal, true) as $repeterKey => $repeaterVal)
										
											@foreach($repeaterVal as $nextKey => $nextVal)
	 											<td>{{ $nextVal }} </td>
											@endforeach
										
									@endforeach 
 --}}
							
								{{-- <table>
									<thead>
										<tr>
											@foreach(array_keys(json_decode($queVal, true)[0]) as $hkey => $hval)
												<th>{{ $hval }}</th>
											@endforeach 
										</tr>
									</thead>

									
									@foreach(json_decode($queVal, true) as $repeterKey => $repeaterVal)
										<tr>
											@foreach($repeaterVal as $nextKey => $nextVal)
	 											<td>{{ $nextVal }} </td>
											@endforeach
										</tr>
									@endforeach 
								</table>--}}
							@else
								<span class="aione-tooltip truncate" tooltip-data="{{$queVal}}">
									<td>{{$queVal}} </td>
								</span>	 
							@endif
						
						
							
							{{-- <td>
								<span class="aione-tooltip truncate" tooltip-data="{{$queVal}}">
								 @php 
									 if(!empty($options_val[$queKey])){
									 	$flip = array_flip($options_val[$queKey]);
									 	$array_val = json_decode($queVal,true);
										if(is_array($array_val)){
										   	$intersect = array_intersect($flip, $array_val);
											echo  implode(', ', array_keys($intersect));
										}
									}else{
										echo $queVal;
									}

								 @endphp
								</span>
							</td> --}}

	 					@endforeach
					</tr>
				@endforeach
	        </tbody>
	    </table>
	</div>          
	</div>
@endif
@endif


<style>
	.disappear{
		display:none;
	}
	.appear{
		display:block;
	}
</style>

<script>
$('#more_condition').on('click',function(event){
	$("#child").html();
	event.preventDefault();
	childs = $("#child").html();
	$("#append").append(childs);
	$("#append").find('a.remove_condition').addClass('appear');
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