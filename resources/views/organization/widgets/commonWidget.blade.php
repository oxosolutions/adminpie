<style type="text/css">
	.action-dashboard-buttons{
		transform: rotate(90deg);
		right: -9px;
		bottom: 84%;
	}
	.aione-actions-handle{
		background-color: transparent;
		box-shadow: none;
	}
	.aione-actions-handle > .material-icons{
		color: #263238;
	}
	.aione-actions-handle > .material-icons:hover{
		background: #263238;
    	color: white;
	}
	.aione-widget-content-section{
		min-height: 130px
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
</style>
<div class="aione-widget aione-border bg-grey bg-lighten-5" >
	<div class="aione-title">

		<h5 class="aione-align-center font-weight-400 aione-border-bottom m-0 pv-10 bg-grey bg-lighten-4" >

			@if(Auth::guard('org')->check())
				<i class="fa fa-arrows aione-widget-handle" widget-order="{{@$widget_id}}"></i>
			@endif
			<a href="javascript:;" class="blue-grey darken-4">{{ucfirst(str_replace('_', ' ', $key))}}</a>
				@if(Auth::guard('org')->check())
					<div class="fixed-action-btn horizontal click-to-toggle action-dashboard-buttons" style="position: absolute;">
						<a class="btn-floating aione-actions-handle">
							<i class="aione-icon material-icons">more_horiz</i>
						</a>
						<ul style="right: 45px"> 
							<li><a class="btn-floating red aione-widget-delete aione-tooltip aione-delete-confirmation" href="#" title="Delete Widget"><i class="aione-icon material-icons">close</i></a></li>
							<!--
							<li><a class="btn-floating yellow darken-1 aione-widget-collapse  aione-tooltip"  title="Minimize Widget"><i class="aione-icon material-icons">launch</i></a></li>
							<li><a class="btn-floating blue"  title="XYZ Widget"><i class="aione-icon material-icons  aione-tooltip">attach_file</i></a></li>
							-->
						</ul>
					</div>
				@endif
		</h5>
	</div>
	<div class="aione-align-center p-15 font-size-64 font-weight-600 blue-grey darken-2 aione-widget-content-section"> 
		@if(@$count)
			{{ @$count }}
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
	<div class="aione-align-center p-5 aione-border-top bg-grey bg-lighten-4"> 
		@if(Auth::guard('admin')->check())
			<a href="{{route($route)}}" class="display-block white bg-blue-grey bg-darken-4 p-10">All {{ucfirst(str_replace('_', ' ', $key))}}</a>
		@else
				{{ @$route }}
			<a href="" class="display-block white bg-blue-grey bg-darken-4 p-10">All {{ucfirst(str_replace('_', ' ', $key))}}</a>
		@endif
	</div>
</div>
