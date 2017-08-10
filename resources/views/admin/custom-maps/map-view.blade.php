@if(Auth::guard('admin')->check() == true)
	@php
		$layout = 'admin.layouts.main';
	@endphp
@else
	@php
		$layout = 'layouts.main';
	@endphp
@endif
@extends($layout)
@section('content')
@php
$page_title_data = array(
	'show_page_title' => 'yes',
	'show_add_new_button' => 'no',
	'show_navigation' => 'yes',
	'page_title' => 'Map View',
	'add_new' => '+ Add Custom Map'
);
@endphp
@include('common.pageheader',$page_title_data) 
<style type="text/css">
	.map-view .heading{
		font-weight: 600;padding: 10px;border-bottom: 1px solid #e8e8e8;
	}
	.map-view .box{
		border:1px solid #e8e8e8;margin-bottom: 10px;margin-right: 10px
	}
	.map-view .display-map{
		padding: 15px;
	}
	.map-view .box .sub-head{
		font-weight: 600
	}
	.map-view .box .info{
		padding: 10px
	}
	.map-view .no-border{
		border:none;
	}
</style>
@include('common.pagecontentstart')
@include('common.page_content_primary_start')
	<div class="row map-view">
		<div class="col l9">
			<div class="box display-map">
				{!!$model->map_data!!}
			</div>
			<div class="box">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vel quam vitae massa euismod aliquam a ac arcu. Quisque nec diam cursus turpis commodo iaculis non
			</div>
		</div>
		<div class="col l3">
			<div class="box">
				<div class="heading">
					Information
				</div>
				<div>
					<div class="row info">
						<div class="col l4 sub-head">
							Title:
						</div>
						<div class="col l8">
							{{$model->title}}
						</div>
					</div>
					<div class="row info">
						<div class="col l4 sub-head">
							Table Code:
						</div>
						<div class="col l8 ">
							{{$model->table_code}}
						</div>
					</div>
					<div class="row info">
						<div class="col l5 sub-head">
							Description:
						</div>
						<div class="col l8">
							{{$model->description}}
						</div>
					</div>
				</div>
			</div>

			<div class="box">
				@php
					if($model->map_keys != ''){
						$map_keys = json_decode($model->map_keys, true);
				@endphp
						@foreach($map_keys as $key => $value)
							<div class="row info">
								{{$value['id']}}				
							</div>
						@endforeach
				@php
					}
				@endphp
			</div>
			<div class="box right-align no-border">
				<button class="">SAVE</button>	
			</div>
			
			<div class="box">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vel quam vitae massa euismod aliquam a ac arcu. Quisque nec diam cursus turpis commodo iaculis non
			</div>
		</div>
	</div>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
	
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection