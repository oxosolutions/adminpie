$(document).ready(function(){

    
     $('.add-new-repeater').click(function(e){
        e.preventDefault();
        var html = '<div class="repeater-row"><i class="material-icons dp48">close</i>'+$(this).parents('.repeater-group').find('.repeater-wrapper .repeater-row').html()+'<div>';
        var repeaterLength = $(this).parents('.repeater-group').find('.repeater-row').length;
        console.log(repeaterLength);
        $(this).parents('.repeater-group').find('.repeater-wrapper').append(html);
        $(this).parents('.repeater-group').find('.repeater-row:last').find('input').each(function(index){
            $(this).attr('name',$(this).attr('name').replace(/\[[0-9]+\]/,'['+repeaterLength+']'));
        });
        $(this).parents('.repeater-group').find('.repeater-row:last').find('input,textarea,select').each(function(index){
          $(this).val('');
        });
      });
    
      $('body').on('click','.repeater-row-delete', function(){
        if($(this).parents('.repeater-wrapper').find('.repeater-row-delete').length > 1){
          $(this).parents('.repeater-row').remove();
        }
      });

	
function clock(){

	var today = new Date();

	var hours = today.getHours();
	var minutes = today.getMinutes();
	var seconds = today.getSeconds();

	if (hours >= 12){
	  meridiem = " PM";
	}
	else {
	  meridiem = " AM";
	}

	if (hours>12){
		hours = hours - 12;
	}
	else if (hours===0){
		hours = 12;	
	}

	if (minutes<10){
		minutes = "0" + minutes;
	}
	else {
		minutes = minutes;
	}
	if (seconds<10){
		seconds = "0" + seconds;
	}
	else {
		seconds = seconds;
	}
		document.getElementById("clock").innerHTML = (hours + ":" + minutes + ":" + seconds + meridiem);
}
setInterval(function(){clock();},100);
/*
	$("#my-tabs .management-tabs").click(function(){
        $(this).addClass("active-tab");
      	$(this).siblings().removeClass('active-tab');
    });

	$('.crm-tab').click(function(){
		$('.crm').show();
		$('.hrm').hide();
		$('.pm').hide();
	});

	$('.hrm-tab').click(function(){
		$('.hrm').show();
		$('.crm').hide();
		$('.pm').hide();
	});
	$('.pm-tab').click(function(){
		$('.pm').show();
		$('.crm').hide();
		$('.hrm').hide();
	});*/


	$('.page-content').css({'padding-left':'244px'});
	$('.content-section').css({'padding-left':'244px'});
	// $('.side-nav li a').click(function(){
	// 	$(this).addClass('active');
	// });

    /*$('.side-bar-submenu').click(function(e){
    	$(this).show();
    });*/
    // $('.active-state').find('ul').show();
    $('.views .view').click(function(e){
      e.preventDefault();
      $('.projects').removeClass('list-view');
      $('.projects').removeClass('detail-view');
      $('.projects').removeClass('grid-view');
      $('.projects').addClass($(this).attr('data-view')); 
    });



    var tagsArray = {};
    if(window.tag != undefined){
        // $.each(JSON.parse(window.tag), function(key, value){
        //   tagsArray[value] = '';
        // });
        $(JSON.parse(window.tag)).each(function(key, value){
          tagsArray[value] = '';
         });

        /*$('.chips-autocomplete').material_chip({
          autocompleteOptions: {
            data: tagsArray,
            limit: Infinity,
            minLength: 1
          }
        });*/
    }

    $('.chips').on('chip.add', function(e, chip){
      // you have the added chip here
    });

    $('.chips').on('chip.delete', function(e, chip){
      // you have the deleted chip here
    });
     

    $('.optionMenu').click(function(e){
      e.stopPropagation();
      $('.dropdown-design').css({
          top: e.pageY-48,
          left: e.pageX-100
      }).fadeIn(300);
    });
    $('body').click(function(){
        $('.dropdown-design').fadeOut(300);
    });
    
    $('.view').click(function(){
        var dataView = $(this).attr('data-view');
        $('.list-view, .grid-view, .detail-view').fadeOut(50);
        $('.'+dataView).fadeIn(300);
    });
    //$('.select2').select2();

    $('.add_new_user').click(function(){
        $('.add-user').slideToggle(300);
    });

	$('select').material_select();
	// $('.shift-select').material_select();

   $(document).ready(function() {
    $('select').material_select();
  });
   $('.closeDialog').click(function(){
    $('#modal1').modal('close');
   });


/********************* Dashboard *********************/

$(document).on('click','.aione-widget-delete',function(){
  
  var slug      = $(this).parents('.aione-widget-header').find('input[name=slug]').val();
  var widget_id = $(this).parents('.aione-widget-header').find('input[name=widget_id]').val();
  var _token    = $('#token').val();
    $(this).parents('.aione-widget').remove();

  $.ajax({
    url : route()+'/delete/dashboards/widget',
    type : 'POST',
    data : {  slug        : slug,
              widget_id   : widget_id,
              _token      : _token      
    },
    success: function(res){
        if(res == "true"){
          // $(this).parents('.widget-wrapper').hide();
          Materialize.toast("Success",4000);
        }

    }
  });
});




















});