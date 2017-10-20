	{{-- @php
	$jsonDataArray = json_decode('{"width":{"label":"Width","type":"text","options":[],"isArray":"false","chartType":["ColumnChart","BarChart","AreaChart","PieChart","LineChart","BubbleChart","TableChart"]},"height":{"label":"Height","type":"text","options":[],"isArray":"false","chartType":["ColumnChart","BarChart","AreaChart","PieChart","LineChart","BubbleChart","TableChart"]},"title":{"label":"Title","type":"text","options":[],"isArray":"false","chartType":["ColumnChart","BarChart	","AreaChart","PieChart","LineChart","BubbleChart","TableChart"]},"colors":{"label":"Colors","type":"text","options":[],"isArray":"false","chartType":["ColumnChart","BarChart","AreaChart","PieChart","LineChart","BubbleChart","TableChart"]},"is3D":{"label":"3D Chart","type":"select","options":{"true":"True","false":"False"},"isArray":"false","chartType":["PieChart"]},"pieHole":{"label":"Pie Hole","type":"text","options":[],"isArray":"false","chartType":["PieChart"]},"pieStartAngle":{"label":"Pie Start Angle","type":"text","options":[],"isArray":"false","chartType":["PieChart"]},"reverseCategories":{"label":"Reserve Categories","type":"select","options":{"true":"True","false":"False"},"isArray":"false","chartType":["PieChart"]},"fontSize":{"label":"Font Size","type":"text","options":[],"isArray":"false","chartType":["ColumnChart","BarChart","AreaChart","PieChart","LineChart","BubbleChart","TableChart"]},"fontName":{"label":"Font Name","type":"text","options":[],"isArray":"false","chartType":["ColumnChart","BarChart","AreaChart","PieChart","LineChart","BubbleChart","TableChart"]},"forceIFrame":{"label":"Force iFrame","type":"select","options":{"true":"True","false":"False"},"isArray":"false","chartType":["ColumnChart","BarChart","AreaChart","PieChart","LineChart","BubbleChart","TableChart"]},"areaOpacity":{"label":"Area Opacity","type":"text","options":[],"isArray":"false","chartType":["ColumnChart","BarChart","AreaChart","PieChart","LineChart","BubbleChart","TableChart"]},"pieSliceBorderColor":{"label":"Pie Slce Border Color","type":"text","options":[],"isArray":"false","chartType":["PieChart"]},"legend":{"label":"Legend","type":"select","options":{"top":"Top","bottom":"Bottom","left":"Left","right":"Right"},"isArray":"false","chartType":["ColumnChart","BarChart","AreaChart","PieChart","LineChart","BubbleChart","TableChart"]},"curveType":{"label":"Curve Type","type":"select","options":{"none":"None","function":"Smooth"},"isArray":"false","chartType":["LineChart"]},"pointSize":{"label":"Point Size","type":"text","options":[],"isArray":"false","chartType":["LineChart"]},"backgroundColor":{"label":"Background Color","type":"text","options":[],"isArray":"false","chartType":["ColumnChart","BarChart","AreaChart","PieChart","LineChart","BubbleChart","TableChart"]},"isStacked":{"label":"Is Stacked","type":"select","options":{"true":"True","percent":"Percent","relative":"Relative","absolute":"Absolute"},"isArray":"false","chartType":["ColumnChart","BarChart","AreaChart","PieChart","BubbleChart","TableChart"]},"lineWidth":{"label":"Line Width","type":"text","options":[],"isArray":"false","chartType":["LineChart"]},"enableInteractivity":{"label":"Enable Interactivity","type":"select","options":{"true":"True","false":"False"},"isArray":"false","chartType":["ColumnChart","BarChart","AreaChart","PieChart","LineChart","BubbleChart","TableChart"]},"keepAspectRatio":{"label":"keep Aspect Ratio","type":"select","options":{"true":"True","false":"False"},"isArray":"false","chartType":["ColumnChart","BarChart","AreaChart","PieChart","LineChart","BubbleChart","TableChart"]},"colorAxis":{"label":"Color Axis","type":"text","options":[],"isArray":"false","chartType":["ColumnChart","BarChart","AreaChart","PieChart","LineChart","BubbleChart","TableChart"]},"animation":{"statup":{"label":"Statup","type":"select","options":{"true":"True","false":"False"},"isArray":"false"},"duration":{"label":"Duration","type":"text","options":[],"isArray":"false"},"easing":{"label":"Easing","type":"select","options":{"inAndOut":"inAndOut","in":"In","out":"Out"},"isArray":"false"},"isArray":"true","chartType":["ColumnChart","BarChart","AreaChart","PieChart","LineChart","BubbleChart","TableChart"]},"chartArea":{"left":{"label":"Left","type":"text","options":[],"isArray":"false"},"top":{"label":"Top","type":"text","options":[],"isArray":"false"},"bottom":{"label":"Bottom","type":"text","options":[],"isArray":"false"},"height":{"label":"Height","type":"text","options":[],"isArray":"false"},"width":{"label":"Width","type":"text","options":[],"isArray":"false"},"isArray":"true","chartType":["ColumnChart","BarChart","AreaChart","PieChart","LineChart","BubbleChart","TableChart"]},"bar":{"groupWidth":{"label":"Group Width","type":"text","options":[],"isArray":"false"},"isArray":"true","chartType":["BarChart"]},"tooltip":{"isHtml":{"label":"Is HTML","type":"select","options":{"true":"True","false":"False"},"isArray":"false"},"showColorCode":{"label":"Show Color Code","type":"select","options":{"true":"True","false":"False"},"isArray":"false"},"isArray":"true","chartType":["ColumnChart","BarChart","AreaChart","PieChart","LineChart","BubbleChart","TableChart"]},"hAxis":{"textPosition":{"label":"Text Position","type":"select","options":{"horizontal":"Horizontal","vertical":"Vertical"},"isArray":"false"},"gridlines":{"color":{"label":"Grid Line Color","type":"text","options":[],"isArray":"false"},"isArray":"true"},"isArray":"true","chartType":["ColumnChart","BarChart","AreaChart","PieChart","LineChart","BubbleChart","TableChart"]},"bubble":{"opacity":{"label":"Bubble Opacity","type":"text","options":[],"isArray":"false"},"stroke":{"label":"Bubble Stroke color","type":"text","options":[],"isArray":"false"},"isArray":"true","chartType":["BubbleChart"]},"sizeAxis":{"maxSize":{"label":"Size Axis Max Size","type":"text","options":[],"isArray":"false"},"isArray":"true","chartType":["ColumnChart","BarChart","AreaChart","PieChart","LineChart","BubbleChart","TableChart"]},"chartColor":{"colors":{"label":"Select theme color","type":"select","options":["#F8080B","#FE03C7","#0314CF","#189502","#D35200"],"isArray":"false"},"chartType":["CustomMap"],"isArray":"true"},"custom_map_show_tooltip":{"label":"Show Tooltip","type":"select","options":{"yes":"yes","no":"no"},"chartType":["CustomMap"],"isArray":"false"},"custom_map_tooltip_event":{"label":"Tootip Event","type":"select","options":{"hover":"hover","clickk":"click"},"chartType":["CustomMap"],"isArray":"false"},"custom_map_show_popup":{"label":"Show Popup","type":"select","options":{"yes":"yes","no":"no"},"chartType":["CustomMap"],"isArray":"false"},"custom_map_popup_event":{"label":"Popup Event","type":"select","options":{"hover":"hover","click":"click"},"chartType":["CustomMap"],"isArray":"false"},"custom_map_click_callback":{"label":"Click Callback Function","type":"text","options":[],"chartType":["CustomMap"],"isArray":"false"},"custom_map_classification_method":{"label":"Classification Method","type":"select","options":{"equal_interval":"Equal Interval","quantile":"Quantile","jenks":"Jenks"},"chartType":["CustomMap"],"isArray":"false"},"custom_map_theme":{"label":"Select Custom Map Theme","type":"select","options":{"OrRd":"Orange Red","PuBu":"Purple Blue","BuPu":"Blue Purple","Oranges":"Orange","BuGn":"Blue Green","YlOrBr":"Yellow Orange Brown","YlGn":"Yellow Green","Reds":"Red","RdPu":"Red Purple","Greens":"Green","YlGnBu":"Yellow Green Blue","Purples":"Purple","GnBu":"Green Blue","Greys":"Grey","YlOrRd":"Yellow Orange Red","PuRd":"Purple Red","Blues":"Blue","PuBuGn":"Purple Blue Green","Spectral":"Spectral","RdYlGn":"Red Yellow Green","RdBu":"Red Blue","PiYG":"Pink Yellow Green","PRGn":"Purple Red Green","RdYlBu":"Red Yellow Blue","BrBG":"Brown Green","RdGy":"Red Grey","PuOr":"Purple Orange","Accent":"Accent","Set1":"Set1","Set2":" Set2","Set3":"Set3","Dark2":"Dark2","Paired":"Paired","Pastel1":"Pastel1","Pastel2":"Pastel2","theme-light":"Light Color","theme-dark":"Dark Grey","theme-red":"Red","theme-orange":"Orange","theme-brown":"Brown","theme-green":"Green","theme-blue":"Blue","theme-teal":"Teal","theme-custom":"Custom Colors"},"chartType":["CustomMap"],"isArray":"false"},"custom_map_path_stroke_width":{"label":"Stroke Width of Path","type":"text","options":[],"chartType":["CustomMap"],"isArray":"false"},"custom_map_path_stroke_color":{"label":"Stroke Color of Path","type":"text","options":[],"chartType":["CustomMap"],"isArray":"false"},"custom_map_group_stroke_width":{"label":"Stroke Width of Group","type":"text","options":[],"chartType":["CustomMap"],"isArray":"false"},"custom_map_group_stroke_color":{"label":"Stroke Color of Group","type":"text","options":[],"chartType":["CustomMap"],"isArray":"false"},"custom_map_path_fill":{"label":"Path Fill Color","type":"text","options":[],"chartType":["CustomMap"],"isArray":"false"},"custom_map_path_fill_hover":{"label":"Path Fill Color on Hover","type":"text","options":[],"chartType":["CustomMap"],"isArray":"false"},"custom_map_path_fill_select":{"label":"Path Fill Color on Select","type":"text","options":[],"chartType":["CustomMap"],"isArray":"false"},"custom_map_group_fill":{"label":"Group Fill Color","type":"text","options":[],"chartType":["CustomMap"],"isArray":"false"},"custom_map_group_fill_hover":{"label":"Group Fill Color on Hover","type":"text","options":[],"chartType":["CustomMap"],"isArray":"false"},"custom_map_group_fill_select":{"label":"Group Fill Color on Select","type":"text","options":[],"chartType":["CustomMap"],"isArray":"false"}}');

		$chartsArray = ['ColumnChart','BarChart','AreaChart','PieChart','LineChart','BubbleChart','TableChart','CustomMap'];
		$settingsData = [];
		$jsonData = collect($jsonDataArray);
		foreach ($chartsArray as $key => $value) {
			foreach($jsonData as $k => $v){
	    		if(in_array($value,$v->chartType)){
	    			$settingsData[$value][$k] = $v;
	    		}
			}
		}
		dump($settingsData);

	@endphp --}}

@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'no',
	'page_title' => 'Dashboard',
	'add_new' => '+ Add Dashboard'
	); 
@endphp
<style type="text/css">
	.aione-widgets{
		position: relative;
		display: block;
	}
	.aione-widgets .aione-widget{
		float: left;
	    width: 23%;
	    min-height: 160px;
	    padding: 0;
	    margin: 0 2% 2% 0;
	    position: relative;
	    color: #666666;
	}
	/*
	.aione-widgets .aione-widget:before{
		content: "";
		display: block;
		padding-top: 100%; 	
	}
	*/
	.aione-widgets:after {
		content:"";
		display: block;
		width: 100%;
		height: 1px;
		clear: both; 
	}
	.aione-widgets .aione-widget .aione-widget-background{
		position: absolute;
		top:0;
		right: 0;
		bottom: 0;
		left: 0;
	}
	.aione-widgets .aione-widget .aione-overlay:before{
		content:"";
		position: absolute;
		top:0;
		right: 0;
		bottom: 0;
		left: 0;
		
	}
	.aione-overlay.light-1:before{ background-color: rgba(255,255,255,0.1); }
	.aione-overlay.light-2:before{ background-color: rgba(255,255,255,0.2); }
	.aione-overlay.light-3:before{ background-color: rgba(255,255,255,0.3); }
	.aione-overlay.light-4:before{ background-color: rgba(255,255,255,0.4); }
	.aione-overlay.light-5:before{ background-color: rgba(255,255,255,0.5); }
	.aione-overlay.light-6:before{ background-color: rgba(255,255,255,0.6); }
	.aione-overlay.light-7:before{ background-color: rgba(255,255,255,0.7); }
	.aione-overlay.light-8:before{ background-color: rgba(255,255,255,0.8); }
	.aione-overlay.light-9:before{ background-color: rgba(255,255,255,0.9); }
	.aione-overlay.light-10:before{ background-color: rgba(255,255,255,1); }

	.aione-overlay.dark-1:before{ background-color: rgba(0,0,0,0.1); }
	.aione-overlay.dark-2:before{ background-color: rgba(0,0,0,0.2); }
	.aione-overlay.dark-3:before{ background-color: rgba(0,0,0,0.3); }
	.aione-overlay.dark-4:before{ background-color: rgba(0,0,0,0.4); }
	.aione-overlay.dark-5:before{ background-color: rgba(0,0,0,0.5); }
	.aione-overlay.dark-6:before{ background-color: rgba(0,0,0,0.6); }
	.aione-overlay.dark-7:before{ background-color: rgba(0,0,0,0.7); }
	.aione-overlay.dark-8:before{ background-color: rgba(0,0,0,0.8); }
	.aione-overlay.dark-9:before{ background-color: rgba(0,0,0,0.9); }
	.aione-overlay.dark-10:before{ background-color: rgba(0,0,0,1); }

	.aione-widgets .aione-widget .aione-widget-header{
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
	}
	.aione-widgets .aione-widget .aione-widget-header .aione-widget-handle{
		float: left;
		opacity: 0;
		width: 30px;
	    height: 30px;
	    line-height: 30px;
	    z-index: 9;
	    position: relative;
		-webkit-transition: all 300ms ease-in-out;
	    -moz-transition: all 300ms ease-in-out;
	    -o-transition: all 300ms ease-in-out;
	    transition: all 300ms ease-in-out;
	}
	.aione-widgets .aione-widget:hover .aione-widget-header .aione-widget-handle{
		opacity: 1;
	}
	.aione-widgets .aione-widget .aione-widget-header .aione-widget-handle .aione-icon{
	    cursor: move;
	    line-height: 30px;
	}
	.aione-widgets .aione-widget .aione-widget-header .aione-widget-title{
		float: left;
		display:none;
	}
	.aione-widgets .aione-widget.hide-title .aione-widget-header .aione-widget-title{
		display:none;
	}
	.aione-widgets .aione-widget .aione-widget-header .aione-widget-actions{
		float: right;
		opacity: 0;
		-webkit-transition: all 300ms ease-in-out;
	    -moz-transition: all 300ms ease-in-out;
	    -o-transition: all 300ms ease-in-out;
	    transition: all 300ms ease-in-out;
	}
	.aione-widgets .aione-widget:hover .aione-widget-header .aione-widget-actions{
		opacity: 1;
	}
	.aione-widgets .aione-widget .aione-widget-header .aione-widget-actions .fixed-action-btn{
		position: relative;
	    right: auto;
	    bottom: auto;
	    padding: 0;
	    margin: 0;

	}
	.aione-widgets .aione-widget .aione-widget-header .aione-widget-actions .fixed-action-btn .btn-floating {
	    width: 30px;
	    height: 30px;
	    line-height: 30px;
	    background-color: transparent;
	    box-shadow: none;
	}
	.aione-widgets .aione-widget .aione-widget-header .aione-widget-actions .fixed-action-btn.active .btn-floating {
		background-color: #F44336;
	    box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 1px 5px 0 rgba(0,0,0,.12), 0 3px 1px -2px rgba(0,0,0,.2);
	}
	.aione-widgets .aione-widget .aione-widget-header .aione-widget-actions .fixed-action-btn .aione-actions-handle .aione-icon{
	    color: #F44336;
	    font-size: 30px;
	    line-height: 30px;
	}
	.aione-widgets .aione-widget .aione-widget-header .aione-widget-actions .fixed-action-btn.active .aione-actions-handle .aione-icon{
		color:#ffffff;
	}
	.aione-widgets .aione-widget .aione-widget-header .aione-widget-actions .fixed-action-btn .btn-floating .aione-icon{
		font-size: 24px;
		line-height: 30px;
	}

	.aione-widgets .aione-widget .aione-widget-header .aione-widget-actions .fixed-action-btn.horizontal ul {
	    text-align: right;
	    right: 34px;
	}
	.aione-widgets .aione-widget .aione-widget-header .aione-widget-actions .fixed-action-btn.horizontal ul li {
	    margin:0;
	}
	/*
	.aione-widgets .aione-widget .aione-widget-content {
	    position: absolute;
	    top: 0;
	    right: 0;
	    bottom: 0;
	    left: 0;
	}
	*/
	.aione-widgets .aione-widget .aione-widget-footer{
		display:none;
	}
	.aione-widgets .aione-widget .aione-widget-content .aione-widget-error{
	    color: #F44336;
	    text-align: center;
	    height: 100%;
	    font-size: 16px;
	    line-height: 1.3;
	    padding: 20px 10px;
	}
	.aione-widgets .aione-widget .aione-widget-title{
		color: #F44336;
	    text-align: center;
	    height: 30px;
	    font-size: 17px;
	    line-height: 30px;
	    padding: 0 30px;
	    margin: 0;
	    text-overflow: ellipsis;
	    white-space: nowrap;
	    overflow: hidden;
	    border-bottom: 1px solid #e8e8e8;
	}
	.aione-widget-content-wrapper{
		padding: 12px;
	}
	#aione_widget_add_new .field{
		margin-bottom: 0;
	}
	#aione_widget_add_new .aione-button{
		margin: 0;
		padding: 0 20px;
	}
	.dashboard-actions.fixed-action-btn.horizontal{
	    right: 10px;
	    bottom: auto;
	    top: 47px;
	    padding: 0;
	    margin: 0;
	}
	.dashboard-actions.fixed-action-btn.horizontal ul{
	    right: 44px;
	}
	.dashboard-actions.fixed-action-btn.horizontal ul li {
	    margin: 0 10px 0 0;
	}

	.aione-flip {
		width: 100%;
	    height: 160px;
	    position: relative;
	    margin: 0;
	    -webkit-perspective: 800;
	    -moz-perspective: 800;
	    perspective: 800;
	}
	.aione-flip.flipped .aione-card {
	    -webkit-transform: rotatey(-180deg);
	       -moz-transform: rotatey(-180deg);
	            transform: rotatey(-180deg);
	}
	.aione-flip .aione-card{
	    width: 100%;
	    height: 100%;
	    -webkit-transform-style: preserve-3d;
	       -moz-transform-style: preserve-3d;
	            transform-style: preserve-3d;
	    -webkit-transition: 0.5s;
	       -moz-transition: 0.5s;
	            transition: 0.5s;
	}
	.aione-flip .aione-card .aione-card-face {
	    width: 100%;
	    height: 100%;
	    position: absolute;
	    z-index: 2;
	    cursor: pointer;
	    -webkit-backface-visibility: hidden ;
	       -moz-backface-visibility: hidden ;
	            backface-visibility: hidden ;
	}
	.aione-flip .aione-card .aione-card-face.front {
	    z-index: 1;
	}
	.aione-flip .aione-card .aione-card-face.back {
	    -webkit-transform: rotatey(-180deg);
	       -moz-transform: rotatey(-180deg);
	            transform: rotatey(-180deg);
	}

	.aione-hero-text {
	    display: block;
	    text-align: center;
	    font-size: 80px;
	    font-weight: 400;
	    line-height: 1.3;
	    color: #168dc5;
	}

	.aione-recent-items{
		margin: 0 10px;
	}
	.aione-recent-items li{
		padding: 4px 10px;
	    display: block;
	}
	.aione-recent-items li:nth-child(even){
		background-color: #f2f2f2; 
	}
	.aione-recent-items li:last-child{
		border-bottom: none;
	}
	.aione-recent-items li .item-action{
		display: block;
		float: right;
	}
	.aione-shadow{
		box-shadow: 1px 1px 8px rgba(0,0,0,0.15);
	}
</style>

@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('organization.dashboard._tabs')

<div class="aione-dashboard">
	
	<div class="aione-dashboard-welcome-message">
		
		@php
			$admin_dashboard_welcome_message = App\Model\Organization\OrganizationSetting::getSettings('admin_dashboard_welcome_message');
		@endphp

		{!!$admin_dashboard_welcome_message!!}
		
	</div>
    <div class="aione-widgets">
    	@foreach($widgets as $widget_key => $widget)

    		@php
				$widget_id = $widget['id'];
				$widget_key = $widget['slug'];
				$widget_title = $widget['title'];
			@endphp

	    	<div id="aione_widget_{{$widget_key}}" class="aione-widget aione-widget-{{$widget_key}} aione-widget-id-{{$widget_id}}">
	    		<div class="aione-widget-header">
	    			<div class="aione-widget-handle"><a class="aione-widget-drag aione-tooltip" title="Sort Widget"><i class="aione-icon material-icons">menu</i></a></div>
	    			<div class="aione-widget-title">{{$widget_title}}</div>
	    			<div class="aione-widget-actions">
	    			<input type="hidden" name="slug" value="{{ request()->route()->parameters()['id'] }}">
	    			<input type="hidden" name="widget_id" value="{{ $widget_id	 }}">
	    			<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
	    				<div class="fixed-action-btn horizontal click-to-toggle">
							<a class="btn-floating aione-actions-handle">
								<i class="aione-icon material-icons">more_horiz</i>
							</a>
							<ul> 
								<li><a class="btn-floating red aione-widget-delete aione-tooltip aione-delete-confirmation" href="#" title="Delete Widget"><i class="aione-icon material-icons">close</i></a></li>
								<!--
								<li><a class="btn-floating yellow darken-1 aione-widget-collapse  aione-tooltip"  title="Minimize Widget"><i class="aione-icon material-icons">launch</i></a></li>
								<li><a class="btn-floating blue"  title="XYZ Widget"><i class="aione-icon material-icons  aione-tooltip">attach_file</i></a></li>
								-->
							</ul>
						</div>
	    			</div>
	    		</div>
	    		@if(View::exists('organization.widgets.'.$widget_key))
    				@include('organization.widgets.'.$widget_key)
    			@else 
    				<div class="aione-widget-error">
    					{{ __('messages.widget_view_misssing') }}
    				</div>
    			@endif
	    	</div> <!-- .aione-widget -->

    	@endforeach

    	@if(!empty($listWidgets))
    	<div id="aione_widget_add_new" class="aione-widget aione-widget-add-new">
    		<div class="aione-widget-content aione-shadow">
				<div class="aione-widget-title">Add New Widget</div>
	    		<div class="aione-widget-content-wrapper">
	    		{{Form::open(['method' => 'post' , 'route' => 'update.dashboard.widget' ])}}
	    			{!! csrf_field() !!}
	    			<input type="hidden" name="slug" value="{{@Request()->route()->parameters()['id']}}" class="slug-parameter">
	    			<div class="field select field-type-select">
						{!! Form::select('widget[]',@$listWidgets,null,["class"=>"no-margin-bottom aione-field browser-default" , 'placeholder'=> 'Select Widget','field_placeholder'])!!}
						<span class="error-red"></span>
					</div>
					<button class="aione-button" type="submit" name="action">Add</button>
				{{Form::close()}}
				</div>
			</div>
    	</div> <!-- .aione-widget -->
    	@endif

    </div> <!-- .aione-widgets -->
</div> <!-- .aione-dashboard -->

@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
	@if($current_dashboard != null)
		@php
		$model_data = [];
		$current_data = $dashboards[$current_dashboard];
		$model_data['title'] = $current_data['title'];
		$model_data['description'] = $current_data['description'];
		@endphp
		{!! Form::model($model_data ,['route' => 'update.edit.dashboard' ,'method' => 'POST']) !!}
			<input type="hidden" name="old_slug" value="{{ $current_data['slug'] }}">
			@include('common.modal-onclick',['data'=>['modal_id'=>'edit-dashboard','heading'=>'Edit Dashboard','button_title'=>'Save Data','section'=>'edit_dashboard']])
		{!! Form::close() !!}
	@endif
<script type="text/javascript">

	$(document).ready(function() {

		/*****************************************************
		/*  Header Right Menu Toggles
		/*****************************************************/
		$( ".aione-flip" ).click(function() {
		  $(this).toggleClass('flipped')
		});	

	});

	$(document).on('click','.edit-dashboard',function(){
	 	
	 	var tabSlug = $('.slug-parameter').val();
	 	$.ajax({
	      		url : route()+'edit/dashboards',
	      		type : "POST",
	      		data : {
	      			slug : tabSlug,
	      			_token : $("#token").val()
	      		},
	      		success : function (res) {
	      			if(res == 'true'){
	      			}
	      			 $('#edit-dashboard').modal('open');
	      			 $('#edit-dashboard').find('input[name=title]').val(res.title);
	      			 $('#edit-dashboard').find('textarea[name=description]').val(res.description);
	      			 $('#edit-dashboard').find('input[name=slug]').val(res.slug);
	      			console.log(res);
	      		}
	      	});
	 });
	  $(document).on('click','#edit-dashboard button[type=submit]',function(){

	 	var updated_data = {title : $('#edit-dashboard input[name=title]').val(),
							 	description : $('#edit-dashboard textarea[name=description]').val(),
							 	slug : $('#edit-dashboard input[name=slug]').val(),
							 	old_slug : $('.slug-parameter').val()
							 }
	 	
	 	$.ajax({
	      		url : route()+'update/dashboards',
	      		type : "POST",
	      		data : {
	      			data : updated_data,
	      			_token : $("#token").val()
	      		},
	      		success : function (res) {
	    			// window.location.href=route()+"dashboard";
	      			
	      		}
	      	});
	 });
</script> 

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection