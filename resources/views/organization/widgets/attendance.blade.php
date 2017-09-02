@php
	$model = "App\Model\Organization\Attendance";
	$item_count = $model::all()->count();
	$items = $model::orderBy('id','DESC')->limit(5)->get();
@endphp
@include('organization.widgets.includes.widget-start')

@include('organization.widgets.includes.widget-end')