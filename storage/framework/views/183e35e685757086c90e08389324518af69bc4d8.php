<script type="text/javascript">
	$(document).ready(function() {
		/*****************************************************
		/*  Header Right Menu Toggles
		/*****************************************************/
		$('body').on('click','#aione_header_right .aione-header-item > a',function(e){
			e.preventDefault();
			$(this).parent().toggleClass('active').siblings().removeClass('active');
		});
		
		/*****************************************************
		/*  Navigation Layout Toggle Switch Header
		/*****************************************************/
		$('body').on('click','.nav-toggle',function(e){
			e.preventDefault();
			$(this).toggleClass('active');
			$('.aione-main').toggleClass('sidebar-small');
			var classStatus = ($(this).hasClass('active'))?1:0;
			$.ajax({
				type:'GET',
				url: '<?php echo e(url('sidebar/status')); ?>/'+classStatus,
				data: {},
				success: function(result){
					console.log(result)
				}
			});
		});
		
		/*****************************************************
		/*  Navigation Item Click Show Hide Child Menu
		/*****************************************************/
		$('body').on('click','.aione-nav > ul > li.has-children > a',function(e){
			e.preventDefault();
			var nav_item = $(this).parent();
			nav_item.toggleClass('nav-item-selected').siblings().removeClass('nav-item-selected');
		});
		
		/*****************************************************
		/*  Navigation fixed on complete scroll
		/*****************************************************/
		
		if($('#aione_sidebar').height() > $(window).height()){
			$(window).scroll(function(){
				var scrollOffset = $('#aione_sidebar li:last').offset();
				if(scrollOffset.top >= 215){
					$('#aione_sidebar').addClass('fixed-sidebar');
				}else{
					$('#aione_sidebar').removeClass('fixed-sidebar');
				}
			});
		}
		/*****************************************************
		/*  Breadcrumbs(Page Header) Show Hide Sub Menu
		/*****************************************************/
		$('body').on('click','.aione-breadcrumbs > li > a',function(e){
			e.preventDefault();
		}); 
		
		$('body').on('click','.aione-breadcrumbs > li',function(e){
			$(this).toggleClass('active').siblings().removeClass('active');
		});
		
		/*****************************************************
		/*  Materialize Date Picker
		/*****************************************************/
		$('.timepicker').pickatime({
			default: 'now', // Set default time
			fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
			twelvehour: false, // Use AM/PM or 24-hour format
			donetext: 'OK', // text for done-button
			cleartext: 'Clear', // text for clear-button
			canceltext: 'Cancel', // Text for cancel-button
			autoclose: false, // automatic close timepicker
			ampmclickable: true, // make AM PM clickable
			aftershow: function(){} //Function for after opening timepicker  
		});
			  

	});
</script>