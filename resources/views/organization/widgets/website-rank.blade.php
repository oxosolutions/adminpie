@php
	$model = "App\Model\Organization\Client";
@endphp
@extends('layouts.widget')

@section('front')

	<div class="front" >
		<div class="card shadow mt-0 fix-height" >
			<div class="row center-align aione-widget-header mb-10" ><h5 class="m-0"><a href="#">{{$data['widgets']->title}}</a></h5></div>
			<div class="row mb-10" >
			<input id="widget_website_rank_input" class="browser-default" value=""/><a href="#" id="widget_website_rank_input">Submit</a>
				<div id="widget_website_rank_result">
				
				</div>
			<script>
		$('body').on('click','#widget_website_rank_input',function(e){
			e.preventDefault();
			var url = $('#widget_website_rank_input').val();
			$.ajax({
				type:'POST',
				url: '{{url('tools/website-rank')}}',
				data: {'url':url, '_token':'{{csrf_token()}}'},
				success: function(result){
					var rank_data = JSON.parse(result);
					var html = '';
					if(rank_data.status == 'success'){
						html += '<br>URL = '+rank_data.url;
						html += '<br>Rank = '+rank_data.rank;
						html += '<br>Past Rank = '+rank_data.past;
						html += '<br>Change = '+rank_data.change;
					} else {
						html += '<br>failed';
					}
					
					$('#widget_website_rank_result').html(html);
					//console.log(rank_data)
				}
			});
			 
		});
			</script>	
			<style>
			</style>
			
			</div>
			
		</div>
	</div>
@overwrite
