$(document).ready(function(){

	//Hide Loader
	$(window).load(function() {
		$( '.aione-loader' ).hide(); 
	});

	//Inialize Seclct2 for Multiselect for Filters
	$('.aione-multi-select').select2();

	//Inialize Range Slider for Filters
	$('.aione-range-slider').each(function(){
		var elem = $(this);
		$(this).ionRangeSlider({
		    type: "double",
		    grid: true,
		    min: elem.attr('data-slider-min'),
		    max: elem.attr('data-slider-max'),
		    from: 0,
		    step: 1
		}); 
	});

	// Reset Filters Button

	$('.reset-filters-button').click(function (e) {
        e.preventDefault();
		window.location.reload();
    });


	/***************************************
	AIONE CHARTS
	***************************************/
	$('.show-hide-charts').click(function(){
		if($(this).is(':checked')){
			$('#'+$(this).attr('data-hide')).parents('.chart-row').show();
		}else{
			$('#'+$(this).attr('data-hide')).parents('.chart-row').hide();
		}
	});


    // Tooltip

    // POPUP
    //hidepopup on clicking close icon
	$('.map-data-close').click(function (e) {
        e.preventDefault();
		$('.map-data-wrapper').removeClass('active');
    });

	


	$('.aione-widget-options .aione-options input').change(function(){
		var target_widget_id = $(this).val();
		var is_checked = $(this).prop('checked');
		if(is_checked){
			$("#"+target_widget_id).show();
		} else{
			$("#"+target_widget_id).hide();
		}
	});
	$('.aione-widget-collapse').click(function(){
		$(this).toggleClass('active');
		$(this).parent().parent().parent().find('.aione-chart-content').slideToggle(100);
	});
	$('.aione-widget-close').click(function(){
		var target_option_name = $(this).parent().parent().parent().attr('data-option');
		$(".widget-toggles .widget-toggle [name="+target_option_name+"]").prop('checked', false);
		$(this).parent().parent().parent().hide(); 
	});
	$('.aione-options-handle').click(function(){
		$(this).find('.fa').toggleClass('fa-rotate-180');
		$(this).parent().find('.aione-options').slideToggle(300);
	}); 
 







});