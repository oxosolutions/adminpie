@extends('layouts.front')
@section('content')
{{-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> --}}
@php
	$visualization_id = $visualizations['visualization_id'];
	$visualization_name = $visualizations['visualization_name'];

	$meta = $visualizations['visualization_meta'];
	$charts = $visualizations['visualizations'];
	$visualization_theme = 'minimal';
	if(isset($meta['select_theme']) && $meta['select_theme'] != ''){
		$visualization_theme = $meta['select_theme'];
	}
	$sidebar_class="no-sidebar";
	if( isset($meta['filter_position']) && ($meta['filter_position'] == 'left' || $meta['filter_position'] == 'right') ){
		$sidebar_class = $meta['filter_position']."-sidebar";
	}
	$collapsibleStatus = @$meta['collapsible_chart_widgets'];
	$sortableWidgets = @$meta['sortable_chart_widgets'];

@endphp

<div id="theme_{{$visualization_theme}}" class="wrapper p-10 theme-{{$visualization_theme}}">
	<div id="visualization_{{$visualization_id}}" class="main visualization visualization-{{$visualization_id}}">

		@if(isset($meta['show_topbar']) && $meta['show_topbar'] == 1)
			<!--==============================-->
			<div id="aione_topbar_{{$visualization_id}}" class="aione-border mb-10">
				<div class="aione-align-center font-weight-400 m-0 pv-10 bg-grey bg-lighten-4">
					Select Charts to Display
				</div>
				<div class="p-10">
					@foreach($titles as $chart_id => $title)
						<div class="widget-toggle">
					      <input type="checkbox" class=" show-hide-charts" id="{{$chart_id}}_checkbox" data-hide="{{$chart_id}}" checked="checked" value="{{$chart_id}}"/>
					      <label for="{{$chart_id}}_checkbox">{{ucwords($title)}}</label>
					    </div>
				    @endforeach
				</div>
			</div> <!-- aione_topbar -->
		@endif


		
		@if(isset($meta['enable_header']) && $meta['enable_header'] == 1)
			<!--==============================-->
			<div id="aione_header_{{$visualization_id}}" class="mb-10 p-10 aione-align-center font-size-22 font-weight-200 aione-border-bottom">
				{!! $visualization_name !!} 
				@if(isset($meta['visualization_description']) && $meta['visualization_description'] != '')
				<div class="font-size-16 font-weight-400 grey line-height-24">{!! $meta['visualization_description'] !!}</div>
				@endif
			</div> <!-- show_header -->
		@endif

			<!--==============================-->
		<div id="aione_content_{{$visualization_id}}" class=" aione-content-{{$sidebar_class}}">
			

				@if(isset($meta['filter_position']) && $meta['filter_position'] != 'bottom')
					@include('organization.visualization.filters')
				@endif
				<!--==============================-->
				<div id="aione_content_main_{{$visualization_id}}" class="aione-border aione-content-main">		

					<!--==============================-->
					<div id="aione_charts_{{$visualization_id}}" class=" aione-charts">
					

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
									<div id="chart_wrapper_{{$chart_id}}" chart-id="{{$chart['chart_id']}}" class="aione-chart aione-chart-{{$chart_type}} chart-theme-{{@$chart_settings['custom_map_theme']}} chart-width-{{$chart_width}} {{@$meta['collapsible_chart_widgets']=='1'?'aione-accordion':''}}">
										<div class="aione-item active">
										
											@if(isset($meta['enable_chart_title']) && $meta['enable_chart_title'] == 1)
											<div class="aione-section-header  aione-item-header">
												<div class="">
													@if(isset($meta['sortable_chart_widgets']) && $meta['sortable_chart_widgets'] == 1)
													<div class="aione-section-handle"></div>
													@endif
																{{$chart_title}}
												</div>
												<div class="aione-section-header-actions">
													@if(isset($meta['collapsible_chart_widgets']) && $meta['collapsible_chart_widgets'] == 1)
													<span class="aione-section-header-action aione-widget-toggle aione-widget-collapse"></span>
													@endif
													@if(isset($meta['show_topbar']) && $meta['show_topbar'] == 1)
													<span class="aione-section-header-action aione-widget-toggle aione-widget-close"></span>
													@endif
												</div>
												
												
												



													
													<article class="content">
															
													</article>
													



												<div class="clear"></div>
											</div>
											@endif
											
											<div id="" class="aione-chart-content aione-item-content" 
											data-theme="{{@$chart_settings['chart_settings']['custom_map_theme']}}"  
											data-classification-method="{{@$chart_settings['chart_settings']['custom_map_classification_method']}}"
											data-show-tooltip="{{@$chart_settings['chart_settings']['custom_map_show_tooltip']}}"
											data-tooltip-event="{{@$chart_settings['chart_settings']['custom_map_tooltip_event']}}"
											data-show-popup="{{@$chart_settings['chart_settings']['custom_map_show_popup']}}"
											data-popup-event="{{@$chart_settings['chart_settings']['custom_map_popup_event']}}"
											data-click-callback="{{@$chart_settings['chart_settings']['custom_map_click_callback']}}"
											>	<div class="aione-align-right">
													<i class="fa fa-cog chart_settings" data-chart_type="{{$chart['chart_type']}}" data-chartid="{{$chart['chart_id']}}" data-visualizationid="{{request()->route('id')}}" data-target="chart_{{$chart['chart_id']}}_setings" style="font-size: 24px;color: #757575"></i>
												</div>
													
												<div class="model-bg" >
													<div class="model aione-border">
														<div class="header bg-grey bg-lighten-3 aione-border-bottom p-10">
															Chart Settings<i class="fa fa-close aione-float-right"></i>
														</div>
														<div class="content" id="chart_{{$chart['chart_id']}}_setings">
															content
														</div>
														{{-- <div class="actions p-10 aione-border-top">
															<button type="submit">Save</button>
														</div> --}}
													</div>
												</div>

												

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
									</div>
								@endif
							@endif
						@endforeach
						

						
					</div> <!-- aione_charts -->
				</div> <!-- aione_content_main -->
				<div class="clear"></div>
			
				@if(isset($meta['filter_position']) && $meta['filter_position'] == 'bottom')
					@include('organization.visualization.filters')
				@endif

			</div> <!-- wrapper-row -->
		</div> <!-- aione_topbar -->
	</div>
	
		
	<div class="inf">
    </div>

</div>
{{-- <script src="{{asset('/js/jquery-2.2.3.min.js')}}"></script> --}}
<script src="{{asset('/js/ion.rangeSlider.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/classybrew.js')}}" type="text/javascript"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> --}}
<script src="{{asset('/js/visualization.js')}}" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.chart_settings').click(function(){
			$('.model-bg').show();
		})
		$('.model-bg .fa-close').click(function(){
			$('.model-bg').hide();
		})
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
							elem.find('#'+key).attr('class','map_area');
						}else{
							elem.find('#'+key).css({fill:quantile.getColorInRange(chart_data_array[index])}).attr('class','map_area');
						}
						index++;
					});
				}				
			});
			$('.map-wrapper .map_area path').mouseover(function (e) {
					var area_id = $(this).attr('id');
					var area_title = $(this).attr('title'); 
					var tooltip_data = $(this).parents('.aione-chart-content').find('.tooltip_data').html();
					if(area_title != undefined){
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

			$('.map-wrapper .map_area').click(function (e) {
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
	@if(@$sortableWidgets == 1)
		<script type="text/javascript">  
			$(document).ready(function(){
				$('.aione-charts').sortable({
					stop: function(){
							var data = [];
						$('.aione-chart').each(function(k , v){
							data.push($(this).attr('chart-id'));
						});

						$.ajax({
							url : route()+'/visualization/chart_sort',
							type : 'POST',
							data : {data : data,_token : $('input[name=_token]').val()},
							success : function(res){
								if(res == 'true'){
									Materialize.toast("Sorted Successfully");
								}
							}
						});
					}
				});
				
			});
			@php
			@endphp
		</script>
	@endif
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
<style type="text/css">
	.aione-item .aione-item-header{
		height: 56px
	}
	.model-bg{
		background-color: rgba(0,0,0,0.4);
		position: fixed;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0px;
		z-index: 99999;
		display: none
	}
	.model-bg > .model{
		position: absolute;
		margin-top: 50px;
		right: 25%;
		
		left: 25%;
		background-color: white
	}
	
	.model-bg > .model > .content{
		min-height: 500px;
		max-height: 500px;
		overflow: scroll;

	}

		/*label {
			cursor: pointer;
		}
		.aione-topbar-header .content{
			height: 450px;
    		overflow-x: hidden;
    		overflow-y: scroll;
		}*/
		/*.modal-btn {
		position: relative;
		display: table-cell;
		width: 44px;
		height: 44px;
		background-color: #2c3e50;
		box-shadow: 0 0 40px rgba(0, 0, 0, 0.3);
		border-radius: 50%;	
		font-size: 36px;
		color: white;
		text-align: center;
		line-height: 2.75;
		transition: box-shadow 250ms ease;
		}*/
		/*.modal-btn:hover {
		box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
		}*/

/*		.modal-bg {
			margin: 0;
			position: fixed;
			top: 0;
			left: 0;
			bottom: 0;
			right: 0;
			opacity: 0;
			z-index: 10;
			visibility: hidden;
			transition: background-color 250ms linear;
		}

		.modal-content {
			position: fixed;
			top: 38%;
		    left: 40%;
		    width: 63%;
			height: auto;
			margin-top: -18%;
			margin-left: -25%;
			
			background-color: white;
			border-radius: 4px;
			box-shadow: 0 0 50px rgba(0, 0, 0, 0.5);
			transform: scale(0);
			transition: transform 250ms ease;
			visibility: hidden;
			z-index: 20;
		}
		.modal-content .close {
			position: relative;
			float: right;
			font-size: 18px;*/
			/*transition: transform 500ms ease;
			z-index: 11;
		}
		.modal-content .close:hover {
			color: #3498db;
			transform: rotate(540deg);
		}
		.modal-content header {
			position: relative;
			display: block;
			border-bottom: 1px solid #eee;
		}
		.modal-content header h2 {
			margin: 0 0 10px;
			padding: 0;
			font-size: 28px;
		}
		.modal-content article {
			position: relative;
			display: block;
			margin: 0;
			padding: 0;
			font-size: 16px;
			line-height: 1.75;
		}
		.modal-content footer {
			position: relative;
			display: flex;
			align-items: center;
			justify-content: flex-end;
			width: 100%;
			margin: 0;
			padding: 10px 0 0;
		}
		.modal-content footer .button {
			position: relative;
			padding: 10px 30px;
			border-radius: 3px;
			font-size: 14px;
			font-weight: 400;
			color: white;
			text-transform: uppercase;
			overflow: hidden;
		}
		.modal-content footer .button:before {
			position: absolute;
			content: '';
			top: 0;
			left: 0;
			width: 0;
			height: 100%;
			background-color: rgba(255, 255, 255, 0.2);
			transition: width 250ms ease;
			z-index: 0;
		}
		.modal-content footer .button:hover:before {
			width: 100%;
		}
		.modal-content footer .button.success {
			margin-right: 5px;
			background-color: #2ecc71;
		}
		.modal-content footer .button.danger {
			background-color: #e74c3c;
		}

		#modal {
			display: none;
		}*/
		/* #modal:checked ~ .modal-bg {
			visibility: visible;
			background-color: black;
			opacity: 0.7;
			transition: background-color 250ms linear;
		} */
		/*#modal:checked ~ .modal-content {
			visibility: visible;
			transform: scale(1);
			transition: transform 250ms ease;
			z-index: 111;
		}*/

	</style>
@endsection 