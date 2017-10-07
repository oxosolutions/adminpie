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
	<div class="ar map-view">
		<div class="ac l75 m75 s100">
			<div class="box display-map">
				{!! $model->map_data !!}
			</div>
			<div class="box">
				
			</div>
		</div>
		<div class="ac l25 m25 s100 aione-table">
			
			<table class="compact">
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

			
				{{-- @if($model->map_keys != '')
					<div class="box">
						@php
								$map_keys = json_decode($model->map_keys, true);
						@endphp
						@if(@$map_keys != '')
							@foreach(@$map_keys as $key => $value)
								<div class="row info">
									{{@$value['id']}}				
								</div>
							@endforeach
						@endif
					</div>
				@endif --}}
			<div class="box right-align no-border">
				
			</div>

			<h5 class="selected-part"></h5>
			<div class="box get_value">
			</div>

			<div>
				<textarea name="link" rows="10"> </textarea>
			</div>
		</div>
	</div>
@include('common.page_content_primary_end')
@include('common.page_content_secondry_start')
	<script type="text/javascript">
	$(document).ready(function(){
		url = 'http://manage.adminpie.com/public/custom-maps/GM-460161798027/green/';
		$(document).on('click','.display-map .land',function(){
			var selected_title = $(this).attr('title');
			$('.selected-part').html(selected_title);
			$(this).attr("class", "land active");
			$(this).siblings().attr("class", "land");	
			var ID = $(this).attr('id');
			$('.get_value').empty();
			$('.get_value').append('<input placeholder="Value" type="text" name="'+ID+'">')
		});
	
		$(document).on('focusout','.get_value input',function(){
			var selected_title = $(this).attr('name');
			var selected_value = $(this).val();
			url = url + selected_title + '=' + selected_value + '+';
			$('textarea[name=link]').val(url);

			// if($('textarea[name=link]').val() != ''){
			// 	var dataArray = $('textarea[name=link]').val().split('/');
			// 	$.each(dataArray,function($k ,$v){
			// 		if($v!=''){
			// 			var new_array = $v.split('=');
			// 			if(new_array.constructor === Array){
			// 				if(new_array.length > 1){
			// 					$.each(new)
			// 				}
			// 			}else{
			// 				console.log("false");
			// 			}
			// 		}
			// 	});
			// }

		});

		$(document).on('focusin','textarea[name=link]',function(){
			var f_url = $('textarea[name=link]').val();
			f_url = f_url.substring(0, f_url.length - 1);
			$('textarea[name=link]').val(f_url);
		});
	})
		

	</script>
@include('common.page_content_secondry_end')
@include('common.pagecontentend')
@endsection