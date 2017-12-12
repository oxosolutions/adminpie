@php
	$model = "App\Model\Organization\User";
	$item_count = $model::all()->count();
	$items = $model::orderBy('id','DESC')->limit(5)->get();
	$route = 'list.user';
@endphp
@include('organization.widgets.includes.widget-start')
    @include('organization.widgets.includes.widget-front-start')
        {{-- <div class="aione-widget-title">{{ucfirst($widget_title)}}</div> --}}
		<div class="aione-widget-content-wrapper">
			<span class="aione-hero-text aione-counter">{{$item_count}}</span>
		</div>
		<div class="aione-widget-footer"></div>
    @include('organization.widgets.includes.widget-front-end')
    @include('organization.widgets.includes.widget-back-start')
    	{{-- <div class="aione-widget-title">{{ucfirst($widget_title)}}</div> --}}
    	<div class="aione-widget-content-wrapper">
            <ul class="aione-recent-items">
				@if(!$items->isEmpty())
    				@foreach($items as $item_key => $item)
						<li class="item waves-effect">{{$item->email}}
							<a class="item-action" href="{{route('account.profile',$item->id)}}">view</a>
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
     @include('organization.widgets.includes.widget-back-end')
@include('organization.widgets.includes.widget-end')