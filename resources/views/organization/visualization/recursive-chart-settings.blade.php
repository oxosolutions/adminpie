<div class="aione-accordion">
	<div class="aione-item">
		<div class="aione-item-header">
			{{$key}}
			{{-- <div class="arrow arrow-down"></div> --}}
		</div>
		<div class="aione-item-content">
			@foreach($jsonData as $key => $value)
				@if($value->isArray == 'true')
					@php
						unset($value->chartType);
						unset($value->isArray);
						$fieldName[] = $key;
					@endphp
					@include('organization.visualization.recursive-chart-settings',['jsonData'=>$value,'key'=>$key,'fieldName'=>$fieldName])
				@else
					<div class="row fields">
						<div class="col-md-12">
							<div class="label">
								<label><strong>{{$value->label}}</strong></label>
							</div>
							@php
								$name = '';
								$index = 0;
								foreach($fieldName as $k => $field){
									if($index == 0){
										$name .= 'chart_settings['.$field.']';
									}else{
										$name .= '['.$field.']';
									}
									$index++;
								}
								$name .= '['.$key.']';
							@endphp
							@if($value->type != 'select')
								{!!Form::{$value->type}($name,null)!!}
							@else
								
								{!!Form::{$value->type}($name,$value->options,null,['placeholder'=>'Select Value'])!!}
							@endif
						</div>
					</div>
					<hr />
				@endif
			@endforeach
		</div>
	</div>
		
</div>