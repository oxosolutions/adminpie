@php
	$model = "App\Model\Admin\GlobalOrganization";
	$item_count = $model::find(session()->get('organization_id'));
	$activate_key = $item_count->active_code;
	$items = $model::orderBy('id','DESC')->limit(5)->get();
@endphp
@include('organization.widgets.includes.widget-start')
        <div class="aione-widget-title">{{ucfirst($widget_title)}}</div>
		<div class="aione-widget-content-wrapper">
			<span class="aione-hero-text aione-counter" style="font-size: 40px">{{$activate_key}}</span>
		</div>
		<div class="aione-widget-footer"></div>
    
		<div class="aione-widget-footer"></div>
@include('organization.widgets.includes.widget-end')