
	
		<div class="card">
			@yield('front')
			@yield('back')
		</div>
		<script type="text/javascript">
			$(".card").flip({
				trigger: 'manual'
			});
			$(document).on('click','.flip-btn-1',function(){
				$(this).parents('.card').flip(true);
			});
			$(document).on('click','.btn-unflip-1',function(e){
				e.preventDefault();
				$(this).parents('.card').flip(false);
			});
		</script>
	
