@php
	$model = "App\\Model\\Organization\\forms";
	$item_count = $model::all()->count();
	$items = $model::orderBy('id','DESC')->where('type','survey')->limit(3)->get();
	$route = "list.survey";
@endphp

@include('organization.widgets.includes.widget-start')
    @include('organization.widgets.includes.widget-front-start')
        {{-- <div class="aione-widget-title" >{{ucfirst($widget_title)}}</div> --}}
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
						<li class="item waves-effect" style="overflow: hidden; text-overflow: ellipsis;">{{$item->form_title}}
							<a class="item-action" href="{{route('survey.perview',$item->id)}}">view</a>
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
	@include('organization.widgets.aioneWidgetButton')
@include('organization.widgets.includes.widget-end')