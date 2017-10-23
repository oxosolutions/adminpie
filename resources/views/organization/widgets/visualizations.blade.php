@php
	$model = "App\Model\Organization\Visualization";
		$model = "App\Model\Organization\Dataset";
	$item_count = $model::all()->count();
	$items = $model::orderBy('id','DESC')->limit(3)->get();
@endphp