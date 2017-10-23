@php
	$model = "App\Model\Organization\Dataset";
	$item_count = $model::all()->count();
	$items = $model::orderBy('id','DESC')->limit(3)->get();
@endphp
@include('organization.widgets.includes.widget-start')
    @include('organization.widgets.includes.widget-front-start')
        <div class="aione-widget-title" >{{ucfirst($widget_title)}}</div>
		<div class="aione-widget-content-wrapper">
			<span class="aione-hero-text aione-counter">{{$item_count}}</span>
		</div>
		<div class="aione-widget-footer"></div>
    @include('organization.widgets.includes.widget-front-end')
    @include('organization.widgets.includes.widget-back-start')
    	<div class="aione-widget-title">{{ucfirst($widget_title)}}</div>
    	<div class="aione-widget-content-wrapper">
            <ul class="aione-recent-items">
				@if(!$items->isEmpty())
    				@foreach($items as $item_key => $item)
						<li class="item waves-effect" style="overflow: hidden; text-overflow: ellipsis;">{{$item->dataset_name}}
							<a class="item-action" href="{{route('view.dataset',$item->id)}}">view</a>
						</li>
					@endforeach
    			@else 
    				<div class="aione-widget-error">
    					{{ __('messages.widget_empty_list', ['entity' => 'dataset']) }}
    				</div>
    			@endif
			</ul>
		</div>
		<div class="aione-widget-footer"></div>
     @include('organization.widgets.includes.widget-back-end')
@include('organization.widgets.includes.widget-end')