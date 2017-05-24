$(function(){
	dragula([document.getElementById('media-list-target-left'), document.getElementById('media-list-target-right')], {
	      mirrorContainer: document.querySelector('.media-list-container'),
	      moves: function (el, container, handle) {
	          
	          return handle.classList.contains('dragula-handle');
	      }
	  }).on('drop', function(el, to, from){
	  	// console.log(from.id);
	  	setTimeout(function(){
	  		// console.log($('#media-list-target-left').html());
	  		if($('#media-list-target-left').find('.media').length == '1'){
	  			console.log("empty");
	  			 $('#media-list-target-left').parents('.shadow').find('.drag-message').show();
	  		}else{
	  			console.log('not empty');
	  			 $('#media-list-target-left').parents('.shadow').find('.drag-message').hide();
	  		}
	  		console.log($('#media-list-target-right').find('.media').length);
	  		if($('#media-list-target-right').find('.media').length == '1'){
	  			console.log("empty");
	  			 $('#media-list-target-right').parents('.shadow').find('.drag-message').show();
	  		}else{
	  			console.log('not empty');
	  			 $('#media-list-target-right').parents('.shadow').find('.drag-message').hide();
	  		}
	  		var formData = $('#team-list-form').serializeArray();
		  	$.blockUI({ 
	            message: '<i class="icon-spinner4 spinner"></i>',
	            overlayCSS: {
	                backgroundColor: '#1b2024',
	                opacity: 0.8,
	                zIndex: 1200,
	                cursor: 'wait'
	            },
	            css: {
	                border: 0,
	                color: '#fff',
	                padding: 0,
	                zIndex: 1201,
	                backgroundColor: 'transparent'
	            }
	        });
		  	$.ajax({
		  		type:'POST',
		  		url: route()+'/team_info/save',
		  		data: formData,
		  		success: function(result){
		  			$.unblockUI();
		  		}
		  	});
	  	},300);
	});
});