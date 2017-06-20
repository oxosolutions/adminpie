$(function(){
		// var section_id = $('input[name=section_id]').val();
		// var form_id = $('input[name=form_id]').val();
		// $.ajax({
		// 	type:'GET',
		// 	url: route()+'/field/lists',
		// 	data: {section_id 	: section_id,
		// 			form_id		: form_id },
		// 	success: function(result){
		// 		$('.form-rows').html(result);
		// 	}
		// });

	// dropdown-content
	$('.add-row').click(function(){
		var rowCount = $(this).parents('.section-header').find('.main-row').length;
		$.ajax({
			type:'GET',
			url: route()+'/form/row',
			data: {rowCount : rowCount },
			success: function(result){
				$('.form-rows').append(result);
				$('.row-count:last').html($('.row-count').length);
			}
		});
		
	});
	$('body').on('click','.delete-row', function(){
		var elem = $(this).parents('.form-row');
		$(this).parents('.main-row').remove();

		var id = $(this).parents('.options').find('input[name=field_id]').val();
		$.ajax({
			url		: route()+'/delete/field',
			type 	: 'GET',
			data	: {id : id}, 
			success : function (result) {
				if(result == "true"){
					Materialize.toast('Field Deleted..!',4000);
				}
			}
		});
	});

	$('body').on('click','.edit-fields',function(){
		$(this).parents('.main-row').find('.fields-list').slideToggle(300);
		if($(this).parents('.main-row').find('.appended_error').length == 1){
			$(this).parents('.main-row').find('.delete_message').hide();
		}
		if($(this).parents('.main-row').find('.appended_vallidation').length == 1){
			$(this).parents('.main-row').find('.delete_validation').hide();
		}
		var value = $(this).parents('.main-row').find('.field_type .select-dropdown').val();
		if(value == 'Multi Select' || value == 'Checkbox' || value == 'Select' || value == 'Radio Button'){
			$(this).parents('.main-row').find('.field_row').show();
		}
		// var field_id = $(this).parents('.main-row').find('input[name=field_id]').val();
		// $.ajax({
		// 	url : route()+'/field/meta',
		// 	type: 'get',
		// 	data : {id : field_id},
		// 	success : function(meta){
		// 		console.log(meta);
		// 	}
		// });
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
	$('.bordered').sortable({ handle: '.handle' });
	$('body').on('keyup','.field-label-input', function(){
		// console.log($(this).val());
		$(this).parents('.fields-list').prev('.form-row').find('.field-label').html($(this).val().substring(0, 15)+'...');
	});


	//update field
		/*var objectArray = [];
		$('body').on('click','.UpdateField',function(e){
			$('input, select, textarea').each(function(el){
				var tempArray = {};
				tempArray['name'] = $(this).attr('name');
				tempArray['value'] = $(this).val(); 
				objectArray.push(tempArray);
			});
			$.ajax({
				url 	: route()+'/update/field',
				type 	: 'POST',
				data	: objectArray,
				success	: function(result){
					console.log(result);
				}
			});

		});*/

		
});



/*function selectOption(values)
{
	$("#type").val(values);
}*/