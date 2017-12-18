@if(!empty($filters))
@if(isset($meta['enable_filters']) && $meta['enable_filters'] == 1)

<!--==============================-->
<style type="text/css">
	.aione-visual-filter{
		width: 30%;
		
	}
	.aione-content-main{
		width: 69%;
		float: left
	}
	.aione-section-title{
		background: #efefef;
	    padding: 6px;
	    font-size: 20px;
	    text-align: center
	}
	.aione-section-title ul{
		display: inline-block;
		width: 100%
	}
	.aione-section-title ul li{
		float: left;
		width: 33%;
	}
	.modal-content ul{
		display: inline-block;
		width: 100%;
		padding:10px;
	}
	.modal-content ul li{
		float: left;
		width: 33%
	}
	.modal-content header{
		text-align: center;
	}
	.modal-content footer{
		text-align: right;
	}
	.aione-theme-arcane .aione-topbar{
		padding:0px;
	}
	.aione-topbar-item{
		top:2px;
	}
	.aione-filter-label{
		float: left
	}
	.multiple-select-dropdown{
		width: 323px;
	}
	.aione-topbar-header{
		height: 108px;
	}
	.aione-sidebar-position-left{
		float: left;
	}
	.aione-sidebar-position-right{
		float: right;
	}
</style>
<div id="aione_sidebar_{{$visualization_id}}" class="mb-10 aione-sidebar-position-{{$meta['filter_position']}} aione-visual-filter" >


		<div class="chart-filters aione-border" >
			
			<div class="font-size-20 bg-grey bg-lighten-4 p-10 " >
				Filters
			</div>
			
			<div class=" p-10 survey-chart-filters hideDiv">
				<form method="POST" action="">
					{!! Form::token() !!}
					@php
						$multidrop = 0;
						$singledrop = 0;
						$range = 0;
					@endphp
					@foreach($filters as $key => $value)
						@if($value['column_type'] == 'mdropdown')
							{{-- <div class="row">
								<div class="">
									<label class="aione-filter-label">{{ucfirst($value['column_name'])}}</label>
									<select name='mdropdown[{{$multidrop}}][{{$key}}][]' multiple style="width: 90%" >
										@foreach($value['column_data'] as $option)
											<option value="{{$option}}"
											@if(isset($value['selected_value']) && in_array($option, $value['selected_value']))
												selected="selected"
											@endif
											>{{$option}}</option>
										@endforeach
									</select>
								</div>
							</div> --}}
							<div id="aione_form_wrapper_296" class="aione-form-wrapper aione-form-theme- aione-form-label-position- aione-form-style-   ">
							    <div class="aione-row">
							        <div id="aione_form_content" class="aione-form-content">
							            <div class="aione-row aione-">
							                <div id="aione_form_section_617" class="aione-form-section non-repeater">
							                    <div class="aione-row">
							                        <div id="aione_form_section_content" class="aione-form-section-content">
							                            <div class="aione-row ar">
							                                <div id="field_3132" data-conditions="0" data-field-type="multi_select" class="field-wrapper ac field-wrapper-ajksdasjdhajksd field-wrapper-type-multi_select ">
							                                    <div id="field_label_ajksdasjdhajksd" class="field-label">
							                                        <label for="input_ajksdasjdhajksd">
							                                            <h4 class="field-title" id="{{ucfirst($value['column_name'])}}">
							                                                {{ucfirst($value['column_name'])}}
							                                            </h4>
							                                        </label>
							                                    </div>
							                                    <!-- field label-->
							                                    <div id="field_ajksdasjdhajksd" class="field field-type-multi_select">
							                                        <input type="hidden" name="ajksdasjdhajksd">
							                                        <select class="ajksdasjdhajksd browser-default  select2-hidden-accessible" id="input_ajksdasjdhajksd" multiple="" name='mdropdown[{{$multidrop}}][{{$key}}][]' tabindex="-1" aria-hidden="true">
							                                        	@foreach($value['column_data'] as $option)
																			<option value="{{$option}}"
																			@if(isset($value['selected_value']) && in_array($option, $value['selected_value']))
																				selected="selected"
																			@endif
																			>{{$option}}</option>
																		@endforeach
							                                        </select>
							                                        <div class="field-actions">
							                                            <a hraf="#" class="aione-form-multiselect-all aione-action-link">Select All</a>
							                                            / 
							                                            <a href="#" class="aione-form-multiselect-none aione-action-link">Select None</a>
							                                        </div>
							                                    </div>
							                                    <!-- field -->
							                                </div>
							                                <!-- field wrapper -->
							                            </div>
							                            <!-- .aione-row -->
							                        </div>
							                        <!-- .aione-form-content -->
							                    </div>
							                    <!-- .aione-row -->
							                </div>
							                <!-- .aione-form-section -->
							            </div>
							            <!-- .aione-row -->
							        </div>
							        <!-- .aione-form-content -->
							        <textarea class="form_conditions" id="form_296" style="display: none;">{"3132":{"field_slug":"ajksdasjdhajksd","field_id":3132,"field_title":"askdhjasjkd","field_conditions":[]}}</textarea>
							    </div>
							    <!-- .aione-row -->
							</div>

							
							@php
								$multidrop++;
							@endphp
						@endif
						@if($value['column_type'] == 'dropdown')
							<div class="row">
								<div class="">
									<label>{{ucfirst($value['column_name'])}}</label>
									<select name='dropdown[{{$singledrop}}][{{$key}}][]'>
										<option value="">All</option>
										@foreach($value['column_data'] as $option)
											<option value="{{$option}}" 
											@if(isset($value['selected_value']) && in_array($option, $value['selected_value']))
												selected="selected"
											@endif
											>{{$option}}</option>
										@endforeach 
									</select>
								</div>
							</div>
							<div class="divider"></div>
							@php
								$singledrop++;
							@endphp
						@endif
						@if($value['column_type'] == 'range')
							<div class="row"">
								<div class="">
									<label style="width: 100%">{{ucfirst($value['column_name'])}}</label>
									<input type="range[]"  name="range[{{$range}}][{{$key}}]" data-slider-min="{{$value['column_min']}}" data-slider-max="{{$value['column_max']}}" data-slider-step="1" data-slider-value="[{{$value['column_min']}},{{$value['column_max']}}]" class="aione-range-slider" />
								</div>
							</div>
							@php
								$range++;
							@endphp
						@endif
					@endforeach
					<div class="chats-filter-button">
						<button name="downloadData" type="submit" value="downloadData" class="aione-button" style="">Download Data</button>
						{{-- <input type="submit" name="applyFilter" style="float: right" class="aione-button" value="Apply Filters" /> --}}
						<button type="submit" name="applyFilter" class="aione-button aione-float-right" value="Apply Filters">Apply Filters</button>
						<div class="clear">
							
						</div>
					</div>
					
				</form>
			</div>
		</div>



</div> <!-- aione_sidebar -->
@endif
@endif
