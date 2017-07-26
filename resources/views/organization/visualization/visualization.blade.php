@extends('layouts.visualization')
@section('content')
<?php

$visualization_id = $visualizations['visualization_id'];
$visualization_name = $visualizations['visualization_name'];

$meta = $visualizations['visualization_meta'];
$charts = $visualizations['visualizations'];
$visualization_theme = 'minimal';

if(isset($meta['select_theme']) && $meta['select_theme'] != ''){
	$visualization_theme = $meta['select_theme'];
}
$sidebar_class="no-sidebar";
if(
	isset($meta['filter_position']) 
	&& ($meta['filter_position'] == 'left' || $meta['filter_position'] == 'right') 
){
	$sidebar_class = $meta['filter_position']."-sidebar";
}


/*
echo "<pre>";
//print_r($javascript['chart_0']['chart_settings']);
print_r($visualizations);
echo "</pre>";
*/

?>

<div id="theme_{{$visualization_theme}}" class="wrapper theme-{{$visualization_theme}}">
	<div id="visualization_{{$visualization_id}}" class="main visualization visualization-{{$visualization_id}}">

		@if(isset($meta['show_topbar']) && $meta['show_topbar'] == 1)
			<!--==============================-->
			<div id="aione_topbar_{{$visualization_id}}" class="aione-box aione-topbar aione-options">
				<div class="wrapper-row">
					<div class="aione-section-header aione-topbar-header">
						<div class="aione-section-header-title">
							<div class="aione-section-title">
								Select Charts to Display
							</div>
						</div>
						<div class="clear"></div>
					</div>
					<div class="aione-section-content aione-topbar-content">
						<div class="widget-toggles">
							@foreach($titles as $chart_id => $title)
								<div class="widget-toggle">
							      <input type="checkbox" class="filled-in show-hide-charts" id="{{$chart_id}}_checkbox" data-hide="{{$chart_id}}" checked="checked" value="{{$chart_id}}"/>
							      <label for="{{$chart_id}}_checkbox">{{ucwords($title)}}</label>
							    </div>
						    @endforeach
					    </div>
					</div>
				</div> <!-- wrapper-row -->
			</div> <!-- aione_topbar -->
		@endif

		@if(isset($meta['enable_header']) && $meta['enable_header'] == 1)
			<!--==============================-->
			<div id="aione_header_{{$visualization_id}}" class="aione-box aione-header">
				<div class="wrapper-row ">
					<h1 class="aione-header-title">{!! $visualization_name !!} </h1>
					@if(isset($meta['visualization_description']) && $meta['visualization_description'] != '')
					<h3 class="aione-header-description">{!! $meta['visualization_description'] !!}</h3>
					@endif
				</div> <!-- wrapper-row -->
			</div> <!-- show_header -->
		@endif

		<!--==============================-->
		<div id="aione_content_{{$visualization_id}}" class="aione-box aione-content aione-content-{{$sidebar_class}}">
			<div class="wrapper-row padding-0">

				@if(isset($meta['filter_position']) && $meta['filter_position'] != 'bottom')
					@include('organization.visualization.filters')
				@endif
				<!--==============================-->
				<div id="aione_content_main_{{$visualization_id}}" class="aione-box aione-content-main">
					<div class="wrapper-row padding-0">
						
						<!--==============================-->
						<div id="aione_selected_filters_{{$visualization_id}}" class="aione-box aione-selected-filters">
							<div class="wrapper-row padding-0">


							</div> <!-- wrapper-row -->
						</div> <!-- aione_selected_filters -->

						<!--==============================-->
						<div id="aione_charts_{{$visualization_id}}" class="aione-box aione-charts">
							<div class="wrapper-row  padding-0">

							<!--==============================-->
							<!--==============================-->

							@foreach($charts as $chart_key => $chart)
								
								@if(isset($chart['error']))
									@include('organization.visualization.errors',['errors'=>[$chart['error']]])
								@else
									<?php
										$chart_id = $chart_key;
										$chart_type = $chart['chart_type'];
										$chart_title = $chart['title'];
										$chart_enabled = 1;//$chart['enableDisable'];
										$chart_width = @$chart['chart_width'];
										$chart_settings = json_decode(@$chart['chart_settings'], true);
										
										if(empty($chart_settings['custom_map_theme'])){
											$chart_settings['custom_map_theme'] = "PuBu";
										}
										if(empty($chart_settings['custom_map_classification_method'])){
											$chart_settings['custom_map_classification_method'] = "quantile";
										}
										
										//$chart_settings  = json_decode($chart_settings);
										
										// echo "<pre>";
										// print_r($chart_settings);
										// echo "</pre>"; 

										
									?>

									@if($chart_enabled == 1)
										<div id="chart_wrapper_{{$chart_id}}" class="aione-chart aione-chart-{{$chart_type}} chart-theme-{{@$chart_settings['custom_map_theme']}} chart-width-{{$chart_width}}">
											@if(isset($meta['enable_chart_title']) && $meta['enable_chart_title'] == 1)
											<div class="aione-section-header aione-topbar-header">
												<div class="aione-section-header-title">
													@if(isset($meta['sortable_chart_widgets']) && $meta['sortable_chart_widgets'] == 1)
													<div class="aione-section-handle"></div>
													@endif

													<div class="aione-section-title">{{$chart_title}}</div>
												</div>
												<div class="aione-section-header-actions">
													@if(isset($meta['collapsible_chart_widgets']) && $meta['collapsible_chart_widgets'] == 1)
													<span class="aione-section-header-action aione-widget-toggle aione-widget-collapse"></span>
													@endif
													@if(isset($meta['show_topbar']) && $meta['show_topbar'] == 1)
													<span class="aione-section-header-action aione-widget-toggle aione-widget-close"></span>
													@endif
												</div>
												<div class="clear"></div>
											</div>
											@endif
											
											<div id="" class="aione-chart-content" 
											data-theme="{{@$chart_settings['custom_map_theme']}}"  
											data-classification-method="{{@$chart_settings['custom_map_classification_method']}}"
											data-show-tooltip="{{@$chart_settings['custom_map_show_tooltip']}}"
											data-tooltip-event="{{@$chart_settings['custom_map_tooltip_event']}}"
											data-show-popup="{{@$chart_settings['custom_map_show_popup']}}"
											data-popup-event="{{@$chart_settings['custom_map_popup_event']}}"
											data-click-callback="{{@$chart_settings['custom_map_click_callback']}}"
											
											>	

												@if($chart_type == 'CustomMap')
												
													<div class="chart_loader">
														<div class="loading-animation"><div class="loading-bar"><div class="blue-bar"></div></div></div>
													</div> 

													<div id="{{$chart_id}}" class="map-wrapper">
													{!! $charts[$chart_key]['map'] !!}
													</div>
													<div id="map_legend_{{$chart_id}}" class="map-legend-wrapper">				
													</div>
													<div id="map_data_{{$chart_id}}" class="map-data-wrapper">
														<div id="map_data_header_{{$chart_id}}" class="map-data-header">
															<span class="map-data-title"></span>
															<span class="map-data-close">+</span>
														</div>
														<div id="map_data_content_{{$chart_id}}" class="map-data-content">
														</div>
													</div>
													<div class="view_data" style="display: none;">
														{{json_encode($javascript[$chart_key]['arranged_data']['view_data'])}}
													</div> 
													<div class="tooltip_data" style="display: none;">
														{{json_encode($javascript[$chart_key]['arranged_data']['tooltip_data'])}}
													</div>
													<div class="popup_data" style="display: none;">
														{{json_encode($javascript[$chart_key]['arranged_data']['popup_data'])}}
													</div>
													
												@elseif($chart_type == 'ListChart')
													<div id="{{$chart_id}}" >
														{{-- @foreach($chart['list'] as $key => $values)
															@foreach($values as $k => $val)
																<b>{{ucwords(str_replace('_',' ',$k))}}</b> : {{$val}} <br/>
															@endforeach
															<hr/>
														@endforeach --}}
														@php
															$index=0;
														@endphp
														@foreach($chart['list'] as $key => $values)
															<div class="data-row data-row-{{$index}}">
																@php
																	$indexField=0;
																@endphp
															@foreach($values as $k => $val)
																<div class="aione-field field-{{$indexField}}"><span class="label">{{ucwords(str_replace('_',' ',$k))}}</span> : <span class="value">{{$val}}</span> </div>
																@php
																	$indexField++;
																@endphp
															@endforeach
															</div>
															@php
																$index++;
															@endphp
															
														@endforeach
													</div>
												@else
													<div id="{{$chart_id}}" class="chart-wrapperr"></div>
													{!! lava::render($chart_type,$chart_key,$chart_id) !!}
												@endif
											</div>
										</div>
									@endif
								@endif
							@endforeach


							</div> <!-- wrapper-row -->
						</div> <!-- aione_charts -->

					</div> <!-- wrapper-row -->
				</div> <!-- aione_content_main -->
				<div class="clear"></div>
					
				@if(isset($meta['filter_position']) && $meta['filter_position'] == 'bottom')
					@include('organization.visualization.filters')
				@endif

			</div> <!-- wrapper-row -->
		</div> <!-- aione_topbar -->


		@if(isset($meta['show_footer']) && $meta['show_footer'] == 1)
			@if(isset($meta['footer_content']) && $meta['footer_content'] != '')
				<!--==============================-->
				<div id="aione_footer_{{$visualization_id}}" class="aione-box aione-footer">
					<div class="wrapper-row ">
						{!!  $meta['footer_content'] !!} 
					</div> <!-- wrapper-row -->
				</div> <!-- aione_footer -->
			@endif
		@endif

		@if(isset($meta['enable_copyright']) && $meta['enable_copyright'] == 1)
			<!--==============================-->
			<div id="aione_copyright_{{$visualization_id}}" class="aione-box aione-copyright">
				<div class="wrapper-row ">
					©2017 <a href="http://smaartframework.com/" target="_blank">SMAART™ Framework</a>
				</div> <!-- wrapper-row -->
			</div> <!-- aione_copyright -->
		@endif

		@if(isset($meta['show_loading_animation']) && $meta['show_loading_animation'] == 1)
			<!--==============================-->
			<div id="aione_loader_{{$visualization_id}}" class="aione-loader">
				<div class="loading-animation">
					<div class="loading-bar">
						<div class="blue-bar"></div> 
					</div>
				</div>
			</div> <!-- aione_loader -->
		@endif

	</div>
	
		
	<div class="inf">
    </div>

</div>
<script src="{{asset('/js/jquery-2.2.3.min.js')}}"></script>
<script src="{{asset('/js/ion.rangeSlider.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/classybrew.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{asset('/js/visualization.js')}}" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function(){
		/*var chartsLength = $('.aione-chart-CustomMap').length;
		var countIndex = 0;
		function loadChart(countIndex){
			$(custom_chart_svg).load(function(){
				if(countIndex <= chartsLength){
					var custom_map_wrapper = $('.aione-chart-CustomMap:nth-child('+countIndex+')').find('svg');
					custom_map_wrapper.find('.chart_loader:last').hide();
					loadChart(countIndex+1);
				}
			    	    
			});
		}
		$('.aione-chart-CustomMap').each(function(e){
			var custom_map_wrapper = $(this);
			//console.log("ID = "+custom_map_wrapper.attr('id'));
			var custom_chart_svg = $(this).find('svg');
		});*/
		/*var indexMap = 1;
		function loadMap(indexMap){
			debugger;
			var custom_map_wrapper = $('.aione-chart-CustomMap:nth-child('+indexMap+')');
			var custom_chart_svg = custom_map_wrapper.find('svg');
			$(custom_chart_svg).load(function(){
			    custom_map_wrapper.find('.chart_loader').hide();
			    console.log(indexMap);
			    indexMap++;
			    loadMap(indexMap);
			});
		}
		loadMap(indexMap);*/
		
		$('.aione-chart-CustomMap').each(function(e){
			var custom_map_wrapper = $(this);
			//console.log("ID = "+custom_map_wrapper.attr('id'));
			var custom_chart_svg = $(this).find('svg');
			//$(custom_chart_svg).load(function(){
				//console.log("== Loaded"+custom_map_wrapper.attr('id'));
			    custom_map_wrapper.find('.chart_loader').hide();	    
			//});
		});

		

			var cb = new classyBrew();
			var quantile = new classyBrew();
			$('.aione-chart-content').each(function(e){
				
				var elem = $(this);
				var theme = elem.attr("data-theme");
				var themeSubString = theme.substr(0,5);

				var data_classification_method = elem.attr("data-classification-method");
				//console.log("=="+theme);
				//console.log("=="+data_classification_method);
				var chart_view_data = $(this).find('.view_data').html();
				if(chart_view_data != undefined){
					var chart_data_array = $.map(JSON.parse(chart_view_data), function(value, index) {
					    return [value];
					});
					if(themeSubString != 'select_theme'){
						var colors = cb.getColorCodes();
						quantile.setSeries(chart_data_array);
						quantile.setColorCode(theme);
						quantile.classify(data_classification_method,6);
					}
					if(themeSubString != 'select_theme'){
						var legend = '<div class="aione-lagend">';
						$.each(quantile.getColors(), function(k, v){
							legend += '<div style="background-color:'+v+'"></div>';
						});
						legend += '</div>';
						$(this).find('.map-legend-wrapper').append(legend);
					}
					var index = 0;
					//quantile.setColorCode(colors[3])
					$.each(JSON.parse(chart_view_data), function(key, value){
						if(themeSubString == 'select_theme'){
							elem.find('#'+key).attr('class','mapArea');
						}else{
							elem.find('#'+key).css({fill:quantile.getColorInRange(chart_data_array[index])}).attr('class','mapArea');
						}
						index++;
					});
				}				
			});
			$('.map-wrapper .mapArea').mouseover(function (e) {
					var area_id = $(this).attr('id');
					var area_title = $(this).attr('title'); 
					var tooltip_data = $(this).parents('.aione-chart-content').find('.tooltip_data').html();
					if(tooltip_data != undefined){
						tooltip_data = JSON.parse(tooltip_data);
						var html = '<span class="title">'+area_title+'</span>';
						$.each(tooltip_data[area_id], function(key, value){
							$.each(value, function(k,v){
								html += '<span class="data">'+k+':'+v+'</span>';
							});
							html += '<hr/>';
						});
						$('.inf').html(html);
						
					}
			}).mousemove(function(e){
				if($(this).parents('.aione-chart-content').attr('data-show-tooltip') == 'yes'){
					var mouseX = e.pageX, //X coordinates of mouse
	                    mouseY = e.pageY; //Y coordinates of mouse

	                $('.inf').css({
	                    'top': mouseY-($('.inf').height()+30),
	                    'left': mouseX,
	                    'display': 'block'
	                });
	            }
			}).mouseleave(function(){
				$('.inf').css({
					'display':'none'
				});
			});

			$('.map-wrapper .mapArea').click(function (e) {
				if($(this).parents('.aione-chart-content').attr('data-show-popup') == 'yes'){
					var area_id = $(this).attr('id');
					try{
						var funcName = $(this).parents('.aione-chart-content').attr('data-click-callback');
						window[funcName](area_id);
					}catch(e){
						
					}
					var popup_data = JSON.parse($(this).parents('.aione-chart-content').find('.popup_data').html());
					var clicked_id_data = popup_data[area_id];
	                e.preventDefault();
					$('.map-data-wrapper').addClass('active'); 
					var position = $(this).position();
					$('.map-data-wrapper').css({
	                    'top': position.top,
	                    'left':  position.left
	                });
					var title = $(this).attr('title');
					$('.map-data-title').html(title);
					
					var html = '<div class="map-data-rows">';
					$.each(clicked_id_data, function(key, val){
						var row_status = 0;
						var row_html = '';
						html += '<div class="map-data-row">'; 
						$.each(val, function(k, v){
							html += '<span class="map-data-col '+k.replace(/([~!@#$%^&*()_+=`{}\[\]\|\\:;'<>,.\/? ])+/g, "_")+'">';
							html += k+' : '+v;
							html += '</span>';
						});

						html += '</div>';
	                });
					html += '</div>';
					$(".map-data-content").html(html);
				}
				
            });
			
			 
	});
</script>


@if(isset($meta['custom_js_code']) && $meta['custom_js_code'] != '')
	<script type="text/javascript">  
		<?php echo @$meta['custom_js_code']; ?>
	</script>
@endif

@if(isset($meta['custom_css_code']) && $meta['custom_css_code'] != '')
	<style type="text/css"> 
		<?php echo @$meta['custom_css_code']; ?>


	.aione-chart-ListChart{
		padding:0 15px;
	}
	.aione-chart-ListChart .aione-chart-content {
	    border: 1px solid #e8e8e8;
	}
	.aione-chart-ListChart .data-row{
		padding:3px 8px;
	}
	.aione-chart-ListChart .data-row:nth-child(odd){
		background-color: #f2f2f2;
	}
	.aione-chart-ListChart .data-row .aione-field {
	    border-bottom: 1px solid #f2f2f2;
	}
	.aione-chart-ListChart .data-row:nth-child(odd) .aione-field {
	    border-bottom: 1px solid #e8e8e8;
	}
	.aione-chart-ListChart .data-row .aione-field:last-child {
	    border-bottom: none;
	}

	.aione-chart-ListChart .aione-section-header {
	    color: #FFFFFF;
	    background: #0277BD;
	    font-size: 22px;
	    line-height: 40px;
	    font-weight: 400;
	    font-family: "Open Sans", Arial, Helvetica, sans-serif;
	}
	.aione-chart-ListChart .aione-section-header .aione-section-title{
		color: #FFFFFF;
	}

::-webkit-scrollbar {
    width: 8px;
}
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 3px rgba(0,0,0,0.3); 
}
::-webkit-scrollbar-thumb {
    background: #454545; 
    -webkit-box-shadow: inset 0 0 3px rgba(0,0,0,0.5); 
}
::-webkit-scrollbar-thumb:window-inactive {
	background: #888888; 
}
	</style>
@endif
@endsection 