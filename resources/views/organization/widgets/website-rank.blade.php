<div class="aione-widget-content">
	<div class="aione-widget-title">{{$widget_title}}</div>
	<div class="aione-widget-content-wrapper">
		<div class="field text field-type-text">
			<input id="widget_website_rank_input" placeholder="example.com" data-validation="required" name="widget_website_rank_url" type="text" autocomplete="off">
			<span class="error-red"></span>
		</div>
		<a href="#" id="widget_website_rank_button">GO</a>
		<div id="widget_website_rank_result"></div>
		<div class="aione-loader" style="display: none;margin-top: 30px"></div>
	</div>
</div>
<script>
	$('body').on('click','#widget_website_rank_button',function(e){
		e.preventDefault();
		$('#widget_website_rank_result').html('');
		$('.aione-loader').show();
		var url = $('#widget_website_rank_input').val();
		$.ajax({
			type:'POST',
			url: '{{url('tools/website-rank')}}',
			data: {'url':url, '_token':'{{csrf_token()}}'},
			success: function(result){
				var rank_data = JSON.parse(result);
				var html = '';
				if(rank_data.status == 'success'){
					html += '<ul>';
					html += '<li>URL = '+rank_data.url.replace(/\/$/, "")+'</li>';
					html += '<li>Rank = '+rank_data.rank+'</li>';
					html += '<li>Past Rank = '+rank_data.past+'</li>';
					html += '<li>Change = '+rank_data.change+'</li>';
					html += '</ul>';
				} else {
					html += '';
				}
				$('#widget_website_rank_result').html(html);
				$('.aione-loader').hide();
			}
		}); 
	});
</script>
<style>
#aione_widget_website-rank{
  background-color: #ffffff;
  background-image: linear-gradient(to right bottom, rgba(0, 150, 136, 0.2) 0%, rgba(255, 87, 34, 0.2) 100%);
}
#aione_widget_website-rank .field{
	margin-bottom: 0;
}
#aione_widget_website-rank #widget_website_rank_input{
	width: 79%;
    width: calc(100% - 52px);
}
#aione_widget_website-rank #widget_website_rank_button{
	position: absolute;
    right: 12px;
    padding: 0;
    margin: -50px 0 0 0;
    width: 40px;
    height: 40px;
    font-size: 18px;
    line-height: 40px;
    text-align: center;
    display: block;
    color: #FFFFFF;
    background: #168dc5;
}
#widget_website_rank_result > ul > li{
	font-weight: 400;
    padding: 3px 0;
    background-color: #ffffff;
}
#widget_website_rank_result > ul > li:nth-child(odd){
    background-color: #f6f6f6;
}

/***************************************
AIONE LOADER
***************************************/
.aione-loader{
   	position: relative;
    width: 60%;
    height: 4px;
    border-radius: 2px;
    margin: 0 auto;
    overflow: hidden;
} 
.aione-loader:before {
    content: "";
    display: block;
    height: 4px;
    margin: 0 auto;
    border-radius: 2px;
    background-color: #cfcfcf;
}
.aione-loader:after{
    content: "";
    display: block;
    height: 100%;
    width: 50%;
    position: absolute;
    top: 0;
    background-color: #3596d8;
    border-radius: 2px;
    -moz-animation: aione-loader-animation 1.5s infinite ease;
    -webkit-animation: aione-loader-animation 1.5s infinite ease;
    animation: aione-loader-animation 1.5s infinite ease;
}

@-webkit-keyframes aione-loader-animation{
    0%,100%{
        -webkit-transform:translate(-50%,0);
    }
    50%{
        -webkit-transform:translate(150%,0);
    }
}
@keyframes aione-loader-animation{
    0%,100%{
        transform:translate(-50%,0);
    }
    50%{
        transform:translate(150%,0);
    }
}

</style>