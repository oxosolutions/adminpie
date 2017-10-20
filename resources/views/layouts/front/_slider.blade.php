@php
$post_id = 9;
$post_meta = get_post_meta($post_id,true);
if(isset($post_meta['post_slider_slug'])){
	$post_slider_slug = $post_meta['post_slider_slug'];

	$slider = get_slider($post_slider_slug);
	$slides = $slider->slides;
	$slider_meta = $slider->meta;

	$slider_attributes = "";
	foreach ($slider_meta as $key => $value) {
		
	}
}
if(!isset($slides)){
	$slides = [];
}
@endphp
<div id="aione_slider" class="aione-slider">
	<div class="aione-row">

		<div id="aione_slider_{{rand(111111,999999)}}" class="aione-slider-wrapper owl-carousel " {{@slider_attributes}}>
			@foreach(@$slides as $key => $slide)
			<div class="aione-slider-item">
				<div class="aione-slider-image">
					<img alt="{{@$slide->$title}}" src="{{@$slide->$image}}" />
				</div>
				<div class="aione-slider-content">
					<h1 class="aione-slider-heading">{{@$slide->$heading}}</h1>
					<h1 class="aione-slider-subheading">{{@$slide->$subheading}}</h1>
				</div>
			</div>
			@endforeach
		</div>
		
	</div><!-- .aione-row --> 
</div><!-- #aione_header -->