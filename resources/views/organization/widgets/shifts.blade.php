@php
	$model = "App\Model\Organization\Shift";
	$item_count = $model::all()->count();
	$items = $model::orderBy('id','DESC')->limit(5)->get();
@endphp
<div class="aione-widget-content">
	<div class="aione-widget-background aione-shadow"></div>
	<div class="aione-flip">
	    <div class="aione-card"> 
	        <div class="aione-card-face front">  
	            <div class="aione-widget-title">{{$widget_title}}</div>
				<div class="aione-widget-content-wrapper">
					<span class="aione-hero-text aione-counter">{{$item_count}}</span>
				</div>
				<div class="aione-widget-footer"></div>
	        </div> 
	        <div class="aione-card-face back"> 
	        	<div class="aione-widget-title">{{$widget_title}}</div>
	        	<div class="aione-widget-content-wrapper">
		            <ul class="aione-recent-items">
						@if(!$items->isEmpty())
		    				@foreach($items as $item_key => $item)
								<li class="item waves-effect aione-tooltip" data-tooltip="{{$item->name}} - {{$item->working_days}}">
								<span class="align-left" >{{$item->name}}</span>
								<span class="align-right">{{$item->from}} - {{$item->to}}</span>
								</li>
							@endforeach
		    			@else 
		    				<div class="aione-widget-error">
		    					{{ __('messages.widget_empty_list', ['entity' => 'user']) }}
		    				</div>
		    			@endif
					</ul>
				</div>
				<div class="aione-widget-footer"></div>
	        </div> 
	    </div> 
	</div>
</div>