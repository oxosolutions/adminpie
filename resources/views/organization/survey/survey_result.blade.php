@extends('layouts.main')
@section('content')
@php
if(!empty($data)){
    $keys = collect($data->first())->keys();
 // $data = json_decode(json_encode($data->all()),true);
// $keys = array_keys($data[0]);
}
$page_title_data = array(
    'show_page_title' => 'yes',
    'show_add_new_button' => 'no',
    'show_navigation' => 'yes',
    'page_title' => 'Survey Data <span>' .get_survey_title(request()->route()->parameters()['id']). '</span>',
    'add_new' => '+ Add Media'
); 
@endphp 
@include('common.pageheader',$page_title_data) 
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('organization.survey._tabs')
@if(!empty($data))

@php

$operators= [
""=>"Select Operater", 
'='=>'Equal to',
'>'=>'Greater than',
'<'=>'Less than',
'>='=>'Greater than and equal to',
'<='=>'Less than and equal to',
'like'=>'match with',
 ];
@endphp
@if($errors->any())
	 <div class="aione-message warning aione-align-center">
        <ul class="aione-messages">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{!! Form::open(['route'=>['results.survey',$id],'method' => 'post' ]) !!}
	<div  class="field-wrapper field-wrapper-SLUG field-wrapper-type-select ">
		<div class="ar">
			<div class="ac l50">
				<div class="aione-border">
		            <div class="">
		                <h5 class="aione-align-center font-weight-400 m-0 pv-10 bg-grey bg-lighten-4 aione-border-bottom">
		                    Horizontal Filteration11
		                </h5>
		            </div>
		           	<div id="aione_form_section_374" class="aione-form-section non-repeater p-5">
						<div class="aione-row">
							
							<div id="aione_form_section_content" class="aione-form-section-content">
								<div class="aione-row ar">
									<div id="field_1590" data-conditions="0" data-field-type="multi_select" class="field-wrapper ac field-wrapper-select_column field-wrapper-type-multi_select ">
										<div id="field_label_select_column" class="field-label">
											<label for="input_select_column">
												<h4 class="field-title" id="Select Column">Select Column</h4>
											</label>
										</div><!-- field label-->
										<div id="field_select_column" class="field field-type-multi_select">
											{!! Form::select('fields[]',$columns,array_slice($columns,0,6),['placeholder'=>'Select field' ,'multiple'=>true, 'class'=>'browser-default select no-margin-bottom aione-field select2-hidden-accessible'])  !!}
			 									<div class="field-actions">
													<a hraf="#" class="aione-form-multiselect-all aione-action-link">Select All</a> / 
													<a href="#" class="aione-form-multiselect-none aione-action-link">Select None</a> 
												</div>
										</div><!-- field -->
									</div><!-- field wrapper -->

								</div> <!-- .aione-row -->
							</div> <!-- .aione-form-content -->
						</div> <!-- .aione-row -->
					</div> <!-- .aione-form-section -->
		        </div>
				
			</div>	
			
			<div class="ac l50 ">
				<div class="aione-border">
		            <div class="">
		                <h5 class="aione-align-center font-weight-400 m-0 pv-10 bg-grey bg-lighten-4 aione-border-bottom">
		                    Vertical Filteration
		                </h5>
		            </div>
		           	<div class="aione-box ph-10 pb-10">
						<style type="text/css">
						.repeater-wrapper .repeater-row > i{
						z-index: 999999
						}
						</style>
						<div class="repeater-group">
							<div class="repeater-wrapper">
							
							@if(!empty(@$filter_field))
								@foreach($filter_field['condition_field'] as $filter_key => $filter_val)
									<div class="repeater-row ar">
										<i class="material-icons dp48 repeater-row-delete">close</i>
										<div id="aione_form_section_527" class="aione-form-section">
										<div class="aione-row">

										<div id="aione_form_section_content" class="aione-form-section-content">
											<div class="aione-row ar">
											<div id="field_2477" data-conditions="0" data-field-type="select" class="field-wrapper ac field-wrapper-column field-wrapper-type-select l33 m33 s100">
											<div id="field_column" class="field field-type-select">
												{!! Form::select("condition_field[$filter_key]",$columns,$filter_val,['placeholder'=>'Select field' , 'class'=>'browser-default '])  !!}
											</div><!-- field -->
											</div><!-- field wrapper -->	
											<div id="field_2478" data-conditions="0" data-field-type="select" class="field-wrapper ac field-wrapper-operation field-wrapper-type-select l33 m33 s100">

											<div id="field_operation" class="field field-type-select">
											{!! Form::select("operator[$filter_key]",$operators ,$filter_field['operator'][$filter_key], ['placeholder'=>'Select operators', 'class'=>'browser-default select'] ) !!}
											@php 

											

											@endphp

											{{-- <select class="input_operation browser-default " id="input_operation" name="operator[]">

												<option selected="selected" value=""></option>
												<option value="=">Equal to</option>
												<option value=">">Greater then</option>
												<option value="<">Less then</option>
												<option value=">=">Greater then and equal to</option>
												<option value="<=">Less then and equal to</option>
												<option value="like"> match with </option>
											</select>		
 --}}
											</div><!-- field -->
											</div><!-- field wrapper -->	
											<div id="field_2479" data-conditions="0" data-field-type="text" class="field-wrapper ac field-wrapper-value field-wrapper-type-text l33 m33 s100">


											<div id="field_value" class="field field-type-text">

											<input class="input-value" id="input_value" placeholder="" data-validation="" name="condition_field_value[]" type="text" value="{{$filter_field['condition_field_value'][$filter_key]}}"> 


											</div><!-- field -->
											</div><!-- field wrapper -->	


											</div> <!-- .aione-row -->
										</div> <!-- .aione-form-content -->

										</div> <!-- .aione-row -->
										</div> <!-- .aione-form-section -->
									</div>
								@endforeach
							@else
									<div class="repeater-row ar">
										<i class="material-icons dp48 repeater-row-delete">close</i>
										<div id="aione_form_section_527" class="aione-form-section">
										<div class="aione-row">

										<div id="aione_form_section_content" class="aione-form-section-content">
											<div class="aione-row ar">
											<div id="field_2477" data-conditions="0" data-field-type="select" class="field-wrapper ac field-wrapper-column field-wrapper-type-select l33 m33 s100">
											<div id="field_column" class="field field-type-select">

												{!! Form::select('condition_field[]',$columns,Null,['placeholder'=>'Select field' , 'class'=>'browser-default select'])  !!}
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
							@endif
							</div>


						<button type="submit" class="aione-float-right aione-button add-new-repeater">Add New</button>
						<div style="clear: both">

						</div>

						</div>
					</div>
		        </div>
				
						
			</div>	
			
		</div>
			
		<div id='append'>
			
		</div>
	</div>
	<div class="ar pv-10">
		<div class="ac l50">
			{{-- {!! Form::submit('Export records as CSV',['name'=>'export','class'=>'aione-button aione-button-large aione-button-light aione-button-square add-new-button']) !!} --}}
			
		</div>	
		<div class="ac s100 m100 l100 aione-align-right">
			<a href="{{route('delete.table',['table'=>$table])}}" onclick="confirm('Are you sure you want to delete all records?');" class="display-inline-block bg-red white p-10	float-right"><i class="fa fa-trash mr-5"></i> Delete Records</a>
			<button type="submit" class="aione-button" name="export" value="Export Records" ><i class="fa fa-sign-out mr-5"></i>Export Records</button>
			<button type="submit" class="aione-button" name="Submit"><i class="fa fa-sign-out mr-5"></i>Filter Records</button>
			
		</div>
	</div>
				
{!! Form::close() !!}

</div>



	<div id="table-structure" class="aione-table scrollx">
<div class="ac l80" style="line-height: 48px">Showing {{$data->firstItem()}} to {{$data->lastItem()}} of {{$data->total()}} records</div>
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
	    {{ $data->links() }}
	</div>


            
	</div>

	@else
	<div class="aione-message warning">
		{{ __('survey.survey_results_table_missing') }}
	</div>
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