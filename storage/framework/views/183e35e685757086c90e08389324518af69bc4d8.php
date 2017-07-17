<script type="text/javascript">
	$(document).ready(function() {
		
		/*****************************************************
		/*  Unknown code from topHeader.blade.php
		/*****************************************************/
		/*****************************************************
		/*  Identified as logout menu show hide
		/*****************************************************/
		$('.dropdown-list').hide();
		$('.dropdown-button1').click(function(){
			$('.dropdown-list').toggle();
		});
		
		
		/*****************************************************
		/*  Navigation Layout Toggle Switch Header
		/*****************************************************/
		$('body').on('click','.nav-toggle',function(e){
			e.preventDefault();
			$('.aione-main').toggleClass('sidebar-small');
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
		/*  Breadcrumbs(Page Header) Show Hide Sub Menu
		/*****************************************************/
		/*****************************************************/
		$('.bread-list').hide();
		/*****************************************************/
		$( ".bread-list" ).menu();
		/*****************************************************/
		$('body').on('click','.popup_drop',function(e){
			e.preventDefault();
			e.stopPropagation();
			$(this).parent().find('.bread-list').show();
			$(this).parent().siblings().find('.bread-list').hide();
		});
		/*****************************************************/
		$('body').click(function(e){
			$('.bread-list').hide();
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