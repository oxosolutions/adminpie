@extends('layouts.main')
@section('content')
@php
	$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'no',
	'page_title' => __('organization/dashboard.dashboard_page_title_text'),
	'add_new' => ''
	); 
@endphp
<style type="text/css">
	
	.action-dashboard-buttons{
		transform: rotate(0deg);
	    right: 6px;
	    bottom: 80%;
	}
	.action-dashboard-buttons i{
		transform: rotate(90deg);
	}
	.dashboard-actions.fixed-action-btn.horizontal .aione-delete-confirmation{
		    width: 40px;
    height: 40px;

	}
	.aione-title .aione-actions-handle,
	.aione-title .btn-floating{
		background-color: #f5f5f5;
		height: 36px;
		width: 36px;

	}
	.aione-title .aione-actions-handle > i,
	.aione-title .btn-floating > i{
		line-height: 36px
	}
	.aione-actions-handle > .material-icons{
		color: #9e9e9e;
	}
	.btn-floating:hover{
		box-shadow: none
	}
	.btn-floating{
		box-shadow: none	
	}
	.aione-actions-handle > .material-icons , .aione-actions-handle > .material-icons:hover{
		background: #f5f5f5;
    	color: grey;
    	border:none;
	}

	.aione-widget-content-section{
		min-height: 148px;
		padding-bottom: 0px;
		padding-left: 0px;
		padding-right: 0px;
	}
	.action-dashboard-buttons ul{
		right: 45px
	}
	.action-dashboard-buttons ul li{
		margin : 0px !important;
	}
	.action-dashboard-buttons li i{
		background-color: #263238;
	}
	.aione-widget-handle{
		position: absolute;
    	left: 10px;
    	cursor: pointer;
	}
	
	.aione-hero-text{
		color: #263238
	}
	.aione-counter{
	    margin-top:0px !important;
	}
	.aione-widget-content-wrapper .field-type-text{
		padding: 6px
	}

	#widget_website_rank_button{
		padding: 15px;
	    background: #263238;
	    color: white;
	    margin:10px;
	    position: absolute;
	    width: 92%;
	    text-align: center;
	    bottom: 1px;
	}
	.aione-widget-handle , .action-dashboard-buttons{
		display: none;
	}
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
	.aione-widgets:after {
		content:"";
		display: block;
		width: 100%;
		height: 1px;
		clear: both; 
	}
	.aione-widget-handle{
		left: 5px;
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
	    top: 7px;
	    padding: 0;
	    margin: 0;
	    position: absolute;
	}
	.dashboard-actions.fixed-action-btn.horizontal > a,
	.dashboard-actions.fixed-action-btn.horizontal li > a{
		background-color: #273338;
	}
	.dashboard-actions.fixed-action-btn.horizontal ul{
	    right: 44px;
	}
	.dashboard-actions.fixed-action-btn.horizontal ul li {
	    margin: 0 10px 0 0;
	}

	.aione-flip {
		width: 100%;
	    height: 100px;
	    position: relative;
	    margin: 0;
	    -webkit-perspective: 800;
	    -moz-perspective: 800;
	    perspective: 800;
	}
	.aione-widget-content-wrapper{
		font-size: 15px;
		text-align: left
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
	    color: #263238;
	    font-size: 64px;
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
	.add-new-widget{
		width: 100%;
	    background: #263238;
	    color: white;
	    padding: 8px;
	    margin: 0px;
	    width: 92%;
	}
	svg{
		top: 60% !important;
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
    <div class="aione-widgets" id="sortable-widgets">
    	@foreach($widgets as $widget_key => $widget)
    		@php
				$widget_id = $widget['id'];
				$widget_key = $widget['slug'];
				$widget_title = $widget['title'];
				$widget_order = $widget['order'];

				$key = $widget['slug'];
				$value = "hello";
				$slug = $widget['slug'];
				// $value = $value['count'];
				// $route = $value['route'];
			@endphp
				@include('organization.widgets.commonWidget')
    	@endforeach

    	@if(!empty($listWidgets))
    	<div class="aione-widget aione-border bg-grey bg-lighten-5 width-layout-1-1">
			<div class="aione-title">
				<h5 class="aione-align-center font-weight-400 aione-border-bottom m-0 pv-10 bg-grey bg-lighten-4">
					<a href="javascript:;" class="blue-grey darken-4">Add New Widget</a>
				</h5>
			</div>
			<div class="aione-align-center font-size-64 font-weight-600 blue-grey darken-2 aione-widget-content-section"> 
				<div class="aione-widget-content">
					{{Form::open(['method' => 'post' , 'route' => 'update.dashboard.widget' ])}}
						<div class="aione-widget-content-wrapper">
							<div class="field text field-type-text">
					    			{!! csrf_field() !!}
					    			<input type="hidden" name="slug" value="{{@Request()->route()->parameters()['id']}}" class="slug-parameter">
					    			<div class="field select field-type-select">
										{!! Form::select('widget[]',@$listWidgets,null,["class"=>"no-margin-bottom aione-field browser-default" , 'placeholder'=> 'Select Widget','field_placeholder'])!!}
										<span class="error-red"></span>
									</div>
							</div>
						</div>
						<button class="aione-button add-new-widget" type="submit" name="action">Add</button>
					{{Form::close()}}
				</div>
			</div>
		</div>




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
		$( "#sortable" ).sortable();
		$( "#sortable-widgets" ).sortable({ 
			handle: '.aione-widget-handle',
			stop : function(){
						var order_id = [];
						$.each($('.aione-widget-handle') , function(k , v){
							console.log($(this).attr('widget-order'));
							order_id.push($(this).attr('widget-order'));
						});
						$.ajax({
							url : route()+'/widget/sort',
							type : 'POST',
							data : {order_id : order_id ,_token : $('input[name=_token]').val() },
							success : function(res){
								Materialize.toast('Sorted' , 3000);
							}
						});
					}
			});
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