@extends('admin.layouts.main')
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'no',
	'page_title' => 'Dashboard',
	'add_new' => ''
); 
@endphp
<style type="text/css">
	.aione-widget{
		float: left;
	    width: 23%;
	    min-height: 160px;
	    padding: 0;
	    margin: 0 2% 2% 0;
	    position: relative;
	    color: #666666;
	}
	.test .aione-widget{
		min-width: 123px;
	}
	.test .aione-widget-content-section{
		padding-top: 10%;
		min-height: 121px;
		font-size: 80px
	}
	.test .aione-widget-content-section{
		padding-top: 0px;
		min-height: 0px;
	}
</style>
@include('common.pageheader',$page_title_data)
@include('common.pagecontentstart')
	@include('common.page_content_primary_start')
	<div class="aione-dashboard">
		<!-- Dashboard Widgets -->
		<div class="ar">

			<div class="aione-widgets " id="sortable-widgets">
				@foreach($model as $key => $value)
				@php
					$count = $value['count'];
					$route = $value['route'];
					// $list = $value['list'];
				@endphp
					<!-- Dashboard Widget -->
					<span class="sortable-divs" widget-order="{{$key}}"></span>
						<div class="test">
							@include('organization.widgets.commonWidget')
						</div>
					<!-- Dashboard Widget -->
				@endforeach
			</div>
		</div>
	</div>
	@include('common.page_content_primary_end')
	@include('common.page_content_secondry_start')

	@include('common.page_content_secondry_end')
@include('common.pagecontentend')
{{-- <script type="text/javascript">
	$(document).ready(function(){
		$( "#sortable-widgets" ).sortable({ 
			handle: '.aione-widget-handle',
			stop : function(){
					var order_id = [];
					$.each($('.aione-widget-handle') , function(k , v){
						order_id.push($(this).attr('widget-title'));
					});
					console.log($(this).attr('widget-title'));
					$.ajax({
						url : route()+'/widget/sort/admin',
						type : 'get',
						data : {order_id : order_id ,_token : $('input[name=_token]').val() },
						success : function(res){
							Materialize.toast('Sorted' , 3000);
						}
					});
				}
		});
	});
</script> --}}
@endsection