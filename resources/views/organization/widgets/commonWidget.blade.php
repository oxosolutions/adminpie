<div class="aione-widget aione-border bg-grey bg-lighten-5" >
	<div class="aione-title">

		<h5 class="aione-align-center font-weight-400 aione-border-bottom m-0 pv-10 bg-grey bg-lighten-4">

			@if(Auth::guard('org')->check())
				<i class="fa fa-arrows aione-widget-handle" widget-order="{{@$widget_id}}"></i>
			@endif
			<a href="javascript:;" class="blue-grey darken-4">{{ucfirst(str_replace('_', ' ', $key))}}</a>
		</h5>
	</div>
	<div class="aione-align-center p-15 font-size-64 font-weight-600 blue-grey darken-2"> 
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
			<a href="" class="display-block white bg-blue-grey bg-darken-4 p-10">All {{ucfirst(str_replace('_', ' ', $key))}}</a>
		@endif
	</div>
</div>
