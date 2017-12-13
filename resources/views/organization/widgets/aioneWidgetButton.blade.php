<div class="aione-align-center p-5 aione-border-top bg-grey bg-lighten-4"> 
	<div class="aione-align-center aione-border-top bg-grey bg-lighten-4"> 
		@if(Auth::guard('admin')->check())
			<a href="{{route($route)}}" class="display-block white bg-blue-grey bg-darken-4 p-10">All {{ucfirst(str_replace('_', ' ', $key))}}</a>
		@else
			<a href="{{ route($route) }} " class="display-block white bg-blue-grey bg-darken-4 p-10" style="font-size: 16px">All {{ucfirst(str_replace('_', ' ', $key))}}</a>
		@endif
	</div>
</div>