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
	.display-map .land.active{
		fill: #6db77c
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
				
			</div>
		</div>
		<div class="col l3 aione-table">
			
			<table class="wide">
				<thead >
					<tr><th colspan="2">Information</th></tr>
				</thead>
				<tbody>
					<tr >
						<td >
							Title:
						</td>
						<td >
							{{$model->title}}
						</td>
					</tr>
					<tr >
						<td >
							Table Code:
						</td>
						<td >
							{{$model->table_code}}
						</td>
					</tr>
					<tr >
						<td >
							Description:
						</td>
						<td >
							{{$model->description}}
						</td>
					</tr>
				</tbody>
			</table>

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
				
			</div>
			
			<div class="box get_value">
						
			</div>

			<div>
				<input type="text" name="link">
			</div>
		</div>
	</div>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
	<script type="text/javascript">
	$(document).ready(function(){
		url = 'http://manage.adminpie.com/public/custom-maps/GM-460161798027/green/';
		$(document).on('click','.display-map .land',function(){
			$(this).attr("class", "land active");
			$(this).siblings().attr("class", "land");	
			var ID = $(this).attr('id');
			$('.get_value').empty();
			$('.get_value').append('<input type="text" name="'+ID+'">')
		});
	
		$(document).on('focusout','.get_value input',function(){
			 url = url + $(this).attr('name') + '=' + $(this).val() + '+';
			 $('input[name=link]').val(url);
		});
		$(document).on('focusin','input[name=link]',function(){
			var f_url = $('input[name=link]').val();
			f_url = f_url.substring(0, f_url.length - 1);
			$('input[name=link]').val(f_url);
		});
	})
		

	</script>
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection