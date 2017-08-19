@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'yes',
	'show_navigation' => 'yes',
	'page_title' => 'Dashboards',
	'add_new' => '+ Add Dashboard'
	); 
@endphp
<style type="text/css">
.aione-widgets{
	position: relative;
	display: block;
}
.aione-widgets .aione-widget{
	float:left;
	width:24%;
	min-height: 160px;
	padding: 0;
	margin:0 1% 1% 0;
	position: relative;


	color: #666666;
	background-color: #ffffff;
	border: 1px solid #e8e8e8;
}
.aione-widgets:after {
	content:"";
	display: block;
	width: 100%;
	height: 1px;
	clear: both; 
}
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
	-webkit-transition: all 300ms ease-in-out;
    -moz-transition: all 300ms ease-in-out;
    -o-transition: all 300ms ease-in-out;
    transition: all 300ms ease-in-out;
}
.aione-widgets .aione-widget:hover .aione-widget-header .aione-widget-handle{
	opacity: 1;
}
.aione-widgets .aione-widget:hover .aione-widget-header .aione-widget-handle .aione-icon{
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
.aione-widgets .aione-widget .aione-widget-header .aione-widget-actions .fixed-action-btn.horizontal ul {
    text-align: right;
    right: 44px;
}
.aione-widgets .aione-widget .aione-widget-header .aione-widget-actions .fixed-action-btn.horizontal ul li {
    margin:0;
}
.aione-widgets .aione-widget .aione-widget-content{
	
}
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
</style>
{{---
@include('common.pageheader',$page_title_data) 
--}}
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
@include('organization.dashboard._tabs')

<div class="aione-dashboard">
    <div class="aione-widgets">
    {{--
    <pre>
    {{print_r($widgets->toArray())}}
    </pre>
    --}}

    	@foreach($widgets as $widget_key => $widget)
    		@php
				$widget_id = $widget->id;
				$widget_key = $widget->slug;
				$widget_title = $widget->title;
			@endphp

	    	<div id="aione_widget_{{$widget_key}}" class="aione-widget aione-widget-{{$widget_key}} aione-widget-id-{{$widget_id}}">
	    		<div class="aione-widget-header">
	    			<div class="aione-widget-handle"><a class="aione-widget-drag aione-tooltip" title="Sort Widget"><i class="aione-icon material-icons">menu</i></a></div>
	    			<div class="aione-widget-title">{{$widget_title}}</div>
	    			<div class="aione-widget-actions">
	    				<div class="fixed-action-btn horizontal click-to-toggle">
							<a class="btn-floating">
								<i class="aione-icon material-icons">more_horiz</i>
							</a>
							<ul>
								<li><a class="btn-floating red aione-widget-delete  aione-tooltip"  title="Delete Widget"><i class="aione-icon material-icons">close</i></a></li>
								<li><a class="btn-floating yellow darken-1 aione-widget-collapse  aione-tooltip"  title="Minimize Widget"><i class="aione-icon material-icons">launch</i></a></li>
								<li><a class="btn-floating blue"  title="XYZ Widget"><i class="aione-icon material-icons  aione-tooltip">attach_file</i></a></li>
							</ul>
						</div>
	    			</div>
	    		</div>
	    		<div class="aione-widget-content">
	    			@if(View::exists('organization.widgets.'.$widget_key))
	    				@include('organization.widgets.'.$widget_key)
	    			@else 
	    				<div class="aione-widget-error">
	    					{{ __('messages.widget_view_misssing') }}
	    				</div>
	    			@endif
	    		</div>
	    		<div class="aione-widget-footer"></div>
	    	</div> <!-- .aione-widget -->

    	@endforeach

    </div> <!-- .aione-widgets -->
</div> <!-- .aione-dashboard -->
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')

@include('common.modal-onclick',['data'=>['modal_id'=>'edit-dashboard','heading'=>'Edit Dashboard','button_title'=>'Save Data','section'=>'dashboard']])

{{Form::open(['method' => 'post' , 'route' => 'update.dashboard.widget' ])}}
	<div class="modal-content" style="padding: 20px;padding-bottom: 60px">
	{!! Form::select('widget[]',@$listWidgets,null,["class"=>"no-margin-bottom aione-field browser-default" , 'placeholder'=> 'Select Widget','field_placeholder','multiple'=>true])!!}
		<input type="hidden" name="slug" value="{{@Request()->route()->parameters()['id']}}" class="slug-parameter">
		{!! csrf_field() !!}

	</div>
	<div class="modal-footer">
		<button class="btn blue " type="submit" name="action">Add</button>
	</div>	
{{Form::close()}}

@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection