$(document).ready(function(){

	function list_todo() {
		$.ajax({
			url			:route()+'/project/todo/list',
			type		:'get',
			datatype	:"html",
			success		: function (res) {
				$('#list_todo').html(res);
			}
		});
	}
	list_todo();

	$(document).on('click','#all',function(){
		list_todo();
		$('input[name=priority]').prop('checked',false);
	});

	$(document).on('click','.add-details',function(){
		$(this).find('.todo-details').slideToggle();

	});
	$(document).on('click','input[name=priority]',function(){
		$('#all').prop('checked',false);
	});
	$(document).on('click','input[name=categories] , input[name=priority]',function(){
		var value = {};
		$('input[name=categories]').each(function(e){
			if($(this).is(':checked')){
				var data = $(this).attr('id');
				// if(data == 'all'){
				// 	$('input[name=priority]').prop('checked', false);
				// }
				value['categories'] = data;
			}
		});
		$('input[name=priority]').each(function(g){
			if($(this).is(':checked')){
			 	var data = $(this).attr('id');
				value['priority'] = data;
			}
		});

		$.ajax({
				url: route()+'/project/todo/filter',
				type: 'POST',
				data : {value : value , _token : $('.shift_token').val() },
				success: function(res){
					$('#list_todo').html(res);
				}
			});	

	});

	//check uncheck box
	$(document).on('click','.todo-check',function(){
		if($(this).is(':checked')){
			$(this).parents('.valign-wrapper').find('.todo-name').css({'text-decoration':'line-through','color':'#d9d9d9'});
			var id = $(this).parents('.todo_list').find('.todo_id').val();
		}else{
			$(this).parents('.valign-wrapper').find('.todo-name').css({'text-decoration':'none','color':'black'});
			var id = $(this).parents('.todo_list').find('.todo_id').val();
		}
			$.ajax({
					url 	: route()+'/project/todo/edit',
					type	:'POST',
					data 	:{
								id 		: id,
								_token	: $('.shift_token').val()
							},
					success	:function(res){
					}
			});
	});

	//hide remove button
	$('.fa-close').hide();

	//show remove button on hover
	$(document).on('mouseover','.todo_list',function(){
		$(this).find('.fa-close').show();
	});
	$('.todo_list').mouseout(function(){
		$('.fa-close').hide();
	});

	//remove todo list item'
	$(document).on('click','.fa-close',function(){
		$(this).parents('.todo_list').remove();
		var id = $(this).parents('.todo_list').find('.todo_id').val();
		$.ajax({
			url : route()+'/project/todo/delete',
			type: 'POST',
			data:{
					id 		: id,
					_token	: $('.shift_token').val()
				},
			success:function(res){
				console.log(res);
			}
		}); 
	});

	// append div of new data
	// $('.priority-error').hide();
	$(document).on('keydown','.todo-names',function(e){
		if(e.keyCode == 13){
			if($('.select-dropdown').val() == 'Select Priority'){
				$('.priority-error').show(function(){
					$('.priority-error').delay(3000).fadeOut();
				});
			}else{
				var array = {
							project_id 	: $('.project_id').val(),
							title 		: $('.todo-names').val(),
							priority	: $('.select-dropdown').val(),
							_token		: $('.shift_token').val(),
						};
				$.ajax({
					url:route()+'/project/todo/create',
					type:'POST',
					data: array,
					success: function (res) {
						// console.log(res);
						$('#list_todo').html(res);
					}
				});
			
				$(this).val('');
			}
			
		}
	});
	//add todo to database
			


});