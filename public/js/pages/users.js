$(function(){
	$('.save-details').click(function(){
		$('#edit').text('EDIT');
		var formData = $('#save-user-details').serializeArray();
		console.log(formData);
		$.ajax({
			url:route()+'/user/update',
			type:'POST',
			data: formData,
			success: function(result){
				console.log(result);
				$(".edit-info").hide();
				$(".view-info").show();
			}
		});
	});
	$('.edit-info input, .edit-info textarea, .edit-info select').keyup(function(){
		$(this).parent('div').parent('.row').find('.view-info').html($(this).val());
	});

	$(".edit-info").hide();
    $("#edit").click(function(){
       if($(this).text() == 'EDIT'){
       		$(".view-info").hide();
       		$(".edit-info").show();
       		$(this).text('BACK');
    	}else{
    		$(".view-info").show();
       		$(".edit-info").hide();
       		$(this).text('EDIT');
    	}
    });
    $(document).on('click','.arrow_sort',function(e){
		e.preventDefault();

		$(".list .project").sort(function (a, b) {
			
			if($('.arrow_sort').hasClass('fa-sort-alpha-desc')){
				if ( ($(a).attr("data-site").toLowerCase() < $(b).attr("data-site").toLowerCase()) )  { 
			        	return 1;
				    } else if ( ($(a).attr("data-site").toLowerCase() == $(b).attr("data-site").toLowerCase()) ){
				        return 0;
				    } else {
				        return -1;
				    }
				    $('.arrow_sort').addClass('fa-sort-alpha-asc');
				    $('.arrow_sort').removeClass('fa-sort-alpha-desc');
			}else{
				if ( ($(a).attr("data-site").toLowerCase() > $(b).attr("data-site").toLowerCase()) )  { 
			        	return 1;
				    } else if ( ($(a).attr("data-site").toLowerCase() == $(b).attr("data-site").toLowerCase()) ){
				        return 0;
				    } else {
				        return -1;
				    }
				    $('.arrow_sort').removeClass('fa-sort-alpha-asc');
				    $('.arrow_sort').addClass('fa-sort-alpha-desc');
			}
		}).each(function () {
		    var elem = $(this);
		    elem.remove();
		    $(elem).appendTo(".list");
		});
	});

});