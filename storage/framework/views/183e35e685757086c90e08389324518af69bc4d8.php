<style>

.field-type-code textarea{
    width: 0;
    height: 0;
    display: inline;
    overflow: hidden;
    opacity: 1;
    line-height: 0;
    min-height: 0;
    max-height: 0;
    padding: 0;
    margin: 0;
}

.aione-code-editor {
	min-height:100px;
}
.aione-code-editor.small {
	height:140px;
}
.aione-code-editor.medium {
	height:280px;
}
.aione-code-editor.large {
	height:400px;
}
#aione_account_tabs > .aione-tabs > .aione-tab{
	width: auto;
	display: inline-block
}
</style>
<script type="text/javascript">
	$(document).ready(function() {

		/*****************************************************
		/*  Hide Menu
		/*****************************************************/
		$(document).click(function(e) {
			e.stopPropagation();
			//console.log(e.target);
			if (!$(e.target).is('#aione_header_right *')) {
		        $('#aione_header_right .aione-header-item').removeClass('active');
		    }
		    if (!$(e.target).is('.aione-breadcrumbs *')) {
		        $('.aione-breadcrumbs li').removeClass('active');
		    }
		    
		});

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
			//e.preventDefault();
			var nav_item = $(this).parent();
			nav_item.toggleClass('nav-item-selected').siblings().removeClass('nav-item-selected');
		});
		
		/*****************************************************
		/*  Navigation fixed on complete scroll
		/*****************************************************/
		
		/*if($('#aione_sidebar').height() > $(window).height()){
			$(window).scroll(function(){
				var scrollOffset = $('#aione_sidebar li:last').offset();
				if(scrollOffset.top >= 215){
					$('#aione_sidebar').addClass('fixed-sidebar');
				}else{
					$('#aione_sidebar').removeClass('fixed-sidebar');
				}
			});
		}*/
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
		/*  Aione progress bar on Projects page
		/*****************************************************/
		$('body').on('click','.aione-progress-bar',function(e){
			e.preventDefault();
			$(this).toggleClass('active');
		});

		/*****************************************************
		/*  Aione tabs
		/*****************************************************/

		$('.aione-tabs-wrapper .aione-tabs > .aione-tab > a').click(function(e){
			e.preventDefault();
			$(this).parent().addClass('active').siblings().removeClass('active');
			var selected_tab = $(this).attr('href');
			$(selected_tab).addClass('active').siblings().removeClass('active');
		})

		/*****************************************************
		/*  Aione FORM Section Accordion
		/*****************************************************/

		$('.aione-accordion .aione-form-section-header').click(function(e){
			e.preventDefault();
			$(this).parent().parent().toggleClass('active').siblings().removeClass('active');
		})
		/*****************************************************
		/*  Aione FORM Section Collapsible
		/*****************************************************/

		$('.aione-collapsible .aione-form-section-header').click(function(e){
			e.preventDefault();
			$(this).parent().parent().toggleClass('active'); 
		})
		/*****************************************************
		/*  Aione FORM Section Tabs
		/*****************************************************/

		$('.aione-tabs-horizontal .aione-form-section-header').click(function(e){
			e.preventDefault();
			$(this).parent().parent().toggleClass('active').siblings().removeClass('active'); 
		})
		$('.aione-tabs-vertical .aione-form-section-header').click(function(e){
			e.preventDefault();
			$(this).parent().parent().toggleClass('active').siblings().removeClass('active'); 
		})

		/*****************************************************
		/*  Aione Form Validations
		/*****************************************************/

		$.validate();

		/*****************************************************
		/*  Aione Form Selct 2
		/*****************************************************/
		$('.field-type-multi_select select').select2({
		  theme: "aione"
		});

		/*****************************************************
		/*  Aione Form Selct 2
		/*****************************************************/
		$(document).on('click','.aione-delete-confirmation',function(e){
	        e.preventDefault();
	        var href = $(this).attr("href");
	        swal({   
	            title: "Are you sure?",   
	            text: "Are you sure you want to delete",   
	            type: "warning",   
	            showCancelButton: true,   
	            confirmButtonColor: "#DD6B55",   
	            confirmButtonText: "Delete",   
	            closeOnConfirm: false 
	        }, 
	        function(){
	           window.location = href;
	           swal("Deleted!", "Your widget has been deleted.", "success"); 
	       }); 
	    })

		

		/*****************************************************
		/*  Aione Form Validations
		/*****************************************************/
		/*
		$(".dashboard-widgets .aione-widgets").gridster({
			widget_selector: "div",
			widget_margins: [10, 10],
			widget_base_dimensions: [140, 140],
			extra_rows: 0,
			extra_cols: 0,
			max_cols: null,
			min_cols: 1,
			min_rows: 1,
			autogenerate_stylesheet: true,
			avoid_overlapped_widgets: true

			
			serialize_params: function($w, wgd){},
			draggable.start: function(event, ui){},
			draggable.drag: function(event, ui){},
			draggable.stop: function(event, ui){},
			resize.enabled: false,
			resize.axes: ['both'],
			resize.handle_class: 'gs-resize-handle',
			resize.handle_append_to: '',
			resize.max_size: [Infinity, Infinity],
			resize.start: function(e, ui, $widget) {},
			resize.resize: function(e, ui, $widget) {},
			resize.stop: function(e, ui, $widget) {},
			collision.on_overlap_start: function(collider_data) { },
			collision.on_overlap: function(collider_data) { },
			collision.on_overlap_stop: function(collider_data) { },
			

		});
		*/
		
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

		/*****************************************************
		/*  Code Ediror
		/*****************************************************/

		var editors = new Array();

	    $(".field.field-type-code > textarea").each(function() {
	        editors.push($(this).attr("id"));
	    });

	    $.each(editors, function( index, value ) {
			var editor_wrappper_id = value+'_editor';
			var theme = $('#'+editor_wrappper_id).attr("data-theme");
			var mode = $('#'+editor_wrappper_id).attr("data-mode");

			if(theme == ''){
				theme= "ace/theme/monokai";
			} else {
				theme= "ace/theme/"+theme;
			}

			if(mode == ''){
				mode= "ace/mode/html";
			} else {
				mode= "ace/mode/"+mode;
			}
			//console.log(" theme = "+theme+" mode = "+mode+" index = "+index + " value = " + value );

			var editor = ace.edit(editor_wrappper_id);
			editor.setValue($('#'+value).val()); 
			editor.setTheme(theme);
			editor.getSession().setMode(mode);
			editor.setShowPrintMargin(false);
			editor.getSession().on("change", function () {
				$('#'+value).val(editor.getSession().getValue());
			});
		});
	




	});
</script>

