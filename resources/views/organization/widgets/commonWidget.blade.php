@php
    if(Auth::guard('org')->check()){
        $dashboard_widget = get_organization_meta('dashboard_widget');
        $widget_settings = json_decode(get_organization_meta('widget_settings'),true);
    }else{
        $dashboard_widget = false;
    }
    $size = (@$widget_settings[@$widget_id]['size'] != '')?@$widget_settings[@$widget_id]['size']:'1-1';
@endphp
<style type="text/css">
	.width-layout-1-1{
		width: 23% !important;
		min-height: 160px !important;
	}
	.width-layout-1-2{
		width: 48% !important;
		min-height: 160px !important;
	}
	.width-layout-2-1{
		width: 23% !important;
		min-height: 320px !important;
	}
	.width-layout-2-2{
		width: 48% !important;
		min-height: 320px !important;
	}

</style>
<div class="aione-widget aione-border bg-grey bg-lighten-5 width-layout-{{ $size }}">
	<div class="aione-title">

		<h5 class="aione-align-center font-weight-400 aione-border-bottom m-0 pv-10 bg-grey bg-lighten-4" >

			@if(Auth::guard('org')->check())
				<i class="fa fa-bars aione-widget-handle grey" widget-order="{{@$widget_id}}"></i>
			@endif
			<a href="javascript:;" class="blue-grey darken-4 font-size-18">{{ucfirst(str_replace('_', ' ', $key))}}</a>
				@if(Auth::guard('org')->check())
					<div class="fixed-action-btn horizontal click-to-toggle action-dashboard-buttons" style="position: absolute;">
						<a class="btn-floating aione-actions-handle">
							<i class="aione-icon material-icons ">more_horiz</i>

						</a>
						<ul style="right: 45px"> 
							<li><a class="btn-floating red aione-widget-delete aione-tooltip" href="#" title="Delete Widget" data-widget="{{ @$widget_id }}" data-slug="{{@Request()->route()->parameters()['id']}}"><i class="aione-icon material-icons">close</i></a></li>
                            {!! Form::hidden('_token',csrf_token(),['id'=>'token']) !!}
							<li><a class="btn-floating resizeWidget" href="javascript:;" data-target="size-adjust" data-widget="{{ @$widget_id }}" data-current_size="{{ @$widget_settings[@$widget_id]['size'] }}" ><i  class="aione-icon material-icons">more_horiz</i></a>
							</li>
							<!--
							<li><a class="btn-floating yellow darken-1 aione-widget-collapse  aione-tooltip"  title="Minimize Widget"><i class="aione-icon material-icons">launch</i></a></li>
							<li><a class="btn-floating blue"  title="XYZ Widget"><i class="aione-icon material-icons  aione-tooltip">attach_file</i></a></li>
							-->
						</ul>
					</div>
                    {!! Form::open(['route'=>'widget.resize']) !!}
					   @include('common.modal-onclick',['data'=>['modal_id'=>'size-adjust','heading'=>'Settings','button_title'=>'Save','form'=>'widget-size-form']])
                       {!! Form::hidden('widget_id',null) !!}
                    {!! Form::close() !!}
				@endif
		</h5>
	</div>
	<div class="aione-align-center font-size-64 font-weight-400 blue-grey darken-2 aione-widget-content-section"> 
		@if(@$count)
			<div class="font-size-64 line-height-84">
				{{ @$count }}	
			</div>
			
		@elseif(@$slug)
			@if(View::exists('organization.widgets.'.$slug))
				@include('organization.widgets.'.$slug)
			@else
				<div class="aione-widget-error">
					{{ __('messages.widget_view_misssing') }}
				</div>
			@endif
		@endif


	</div>
		@if(Auth::guard('admin')->check())
			<div class="aione-align-center p-5 aione-border-top bg-grey bg-lighten-4"> 
				<a href="{{route($route)}}" class="display-block white bg-blue-grey bg-darken-4 p-10">All {{ucfirst(str_replace('_', ' ', $key))}}</a>
			</div>
		@endif
</div>
<div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('.aione-widget').mouseenter(function(){
			$(this).find('.aione-widget-handle , .action-dashboard-buttons').css({
				'display' :'block'
			});
		});

        $('.resizeWidget').click(function(){
            var widgetId = $(this).data('widget');
            $('input[name=widget_id]').val(widgetId);
            $('select[name=widget_size]').val($(this).data('current_size'));
        });
		$('.aione-widget').mouseleave(function(){
			$(this).find('.aione-widget-handle , .action-dashboard-buttons').css({
				'display' :'none'
			});
		});

	})
</script>