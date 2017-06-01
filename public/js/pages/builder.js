$(function(){
	// $.ajax({
	// 	url:route()+'/field/lists',
	// 	type:"GET",
	// 	success:function(res){
	// 		console.log(res);
	// 		$('.form-rows').html(res);
	// 	}
	// });

	$('.add-row').click(function(){
		$.ajax({
			type:'GET',
			url: route()+'/form/row',
			data: {},
			success: function(result){
				$('.form-rows').append(result);
				$('.row-count:last').html($('.row-count').length);
			}
		});
	});
	$('body').on('click','.delete-row', function(){
		var elem = $(this).parents('.form-row');
		$(this).parents('.form-row').animate({
			'margin-left':'40%',
			'opacity':'0.5'
		},200, function(){
			elem.remove();
		});
	});

	$('body').on('click','.edit-fields',function(){
		$(this).parents('.form-row').next('.fields-list').slideToggle(300);
	});
	$('body').on('click', '.add_field_option', function(){
		console.log('working');
		$.ajax({
			type:'GET',
			url: route()+'/form/field',
			data: {},
			success: function(result){
				$('.field_choices').append(result);
			}

		});
		//field_choices 
	});

	$('body').on('click', '.remove_key', function(){
		$(this).parents('.field_key').fadeOut(300);
	});

	$('body').on('change','.field_type', function(){
		console.log('Working')
		var fieldType = $(this).val();
		if(fieldType.trim() != ''){
			if($.inArray(fieldType,['select', 'multi_select', 'checkbox', 'radio']) != -1){
				$('.choices').fadeIn(300);
			}else{
				$('.choices').fadeOut(300);
			}
		}
	});
	$('.form-rows').sortable({ handle: '.handle' });
	$('body').on('keyup','.field-label-input', function(){
		// console.log($(this).val());
		$(this).parents('.fields-list').prev('.form-row').find('.field-label').html($(this).val().substring(0, 15)+'...');
	});
});

/*function selectOption(values)
{
	$("#type").val(values);
}*/