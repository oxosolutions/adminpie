@if(!empty($filters))
@if(isset($meta['enable_filters']) && $meta['enable_filters'] == 1)

<!--==============================-->
<style type="text/css">
	.aione-visual-filter{
		width: 30%;
		float: right
	}
	.aione-content-main{
		width: 69%
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
							<div class="row">
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
