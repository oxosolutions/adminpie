$('.side-bar-submenu').hide();
$(document).ready(function(){
	
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
	$('.root').click(function(){
		$(this).siblings().find('ul').slideUp();
	});
	$(document).on('click','.menu',function(){
    if($('.side-nav').hasClass('mini')){
    	$('.side-nav').removeClass('mini');
    	$('.side-bar-text , .arrow').show();
    	$(this).find('li > ul').removeClass('side-bar-submenu');
  		$(this).find('li > ul').addClass('open-close-side-nav');
  		$('.content-section').css({'padding-left':'244px'});
  		$('.page-content').css({'padding-left':'244px'});
  		$('.side-nav').find('ul').addClass('side-bar-submenu').removeClass('mini-side-bar');
  		$('.side-nav').css({'overflow':'scroll'});
  		$('ul > li > ul').removeClass('ml-60');
  		$('.submenu-teir2').removeClass('ml-260');
      $('.footer').show();
		}else{
			$('.side-nav').addClass('mini');
			$('.side-bar-text , .arrow').hide();
			$('.content-section').css({'padding-left':'64px'});
			$('.page-content').css({'padding-left':'64px'});
			$('.side-nav').find('ul').removeClass('side-bar-submenu').addClass('mini-side-bar');
			$('.mini-side-bar .side-bar-text').css({'display':'block','padding-left':'40px'});
			$('.mini-side-bar .side-bar-icon i').css({'float':'left','margin-top':'9px'});
			$('.mini-side-bar li').addClass('root');
			$('.side-nav').css({'overflow':'visible'});
			$('ul > li > ul').addClass('ml-60');
  		$('.submenu-teir2').addClass('ml-260');
      $('.footer').hide();
		}
  });
    $('.side-nav > li a').click(function(){
    	$(this).find('.arrow').toggleClass('icon-rotate');
    	$(this).parent('li').find('ul:first').slideToggle();
    });
    $('.side-bar-submenu').hide();
    $('.submenu-teir2').hide();
    /*$('.side-bar-submenu').click(function(e){
    	$(this).show();
    });*/
    $('.active-state').find('ul').show();
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
	$('.shift-select').material_select();

   $(document).ready(function() {
    $('select').material_select();
  });
   $('.closeDialog').click(function(){
    $('#modal1').modal('close');
   });

});