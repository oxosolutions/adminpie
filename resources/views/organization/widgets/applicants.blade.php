@php
	$model = "App\Model\Organization\Applicant";
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
							{{-- {{dump($items)}} --}}
		    				@foreach($items as $item_key => $item)
								<li class="item waves-effect">{{$item->email}}
									<a class="item-action" href="{{route('account.profile',$item->id)}}">view</a>
								</li>
							@endforeach
		    			@else 
		    				<div class="aione-widget-error">
		    					{{ __('messages.widget_empty_list', ['entity' => 'Applicant']) }}
		    				</div>
		    			@endif
					</ul>
				</div>
				<div class="aione-widget-footer"></div>
	        </div> 
	    </div> 
	</div>
</div>

