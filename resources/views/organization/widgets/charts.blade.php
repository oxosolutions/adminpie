@php
	$model = new App\Http\Controllers\Organization\visualization\VisualisationController(new \Illuminate\Http\Request);
    $request = new \Illuminate\Http\Request();
    // $request->replace(['id'=>'21']);
@endphp

@include('organization.widgets.includes.widget-start')
    {{-- @include('organization.widgets.includes.widget-front-start') --}}
        {{-- <div class="aione-widget-title" >{{ucfirst($widget_title)}}</div> --}}
		

        {{-- <div class="aione-widget-content-wrapper">
			<select>
				<option>chart1</option>
				<option>chart2</option>
				<option>chart3</option>
			</select>
		</div> --}}

        {{-- {!! $model->embedVisualization($request,false) !!} --}} <!-- Real Code -->


		{{-- <div class="aione-widget-footer"></div> --}}
    {{-- @include('organization.widgets.includes.widget-front-end') --}}
    

@include('organization.widgets.includes.widget-end')-