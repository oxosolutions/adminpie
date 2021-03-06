$(document).ready(function(){
	

	function list_todo() {
		$.ajax({
			url			: route()+'/project/todo/list',
			type		: 'get',
			data		: {id : $('.project_id').val()},
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


	$(document).on('click','.project-title',function(event){
		$(this).parents('.add-details').find('.todo-details').slideToggle();
		$('.edit-todo').parents('.todo_list').find('.todo-name').css({'border-bottom':'none'});
		$('.edit-todo').parents('.todo_list').find('.todo-desc').css({'border-bottom':'none'});
		$(this).parents('.add-details').find('.save-todo , .edit-priority').hide();
		$(this).parents('.add-details').find('.priority-badge').show();
	});
	$(document).on('click','input[name=priority]',function(){
		$('#all').prop('checked',false);
	});
	$(document).on('click','input[name=categories] , input[name=priority]',function(){
		var value = {};
		$('input[name=categories]').each(function(e){
			if($(this).is(':checked')){
				var data = $(this).attr('id');
				value['project_id'] = $('.project_id').val();
				value['user_id'] 	= $('input[name=user_id]').val();
				value['categories'] = data;
			}
		});
		$('input[name=priority]').each(function(g){
			if($(this).is(':checked')){
			 	var data = $(this).attr('id');
			 	value['project_id'] = $('.project_id').val();
				value['user_id'] 	= $('input[name=user_id]').val();
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
			$(this).parents('tr').find('.todo-name').css({'text-decoration':'line-through','color':'#d9d9d9'});
			var id = $(this).parents('tr').find('.todo_id').val();
		}else{
			console.log("this line is running");
			$(this).parents('tr').find('.todo-name').css({'text-decoration':'none','color':'black'});
			var id = $(this).parents('tr').find('.todo_id').val();
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
	$(document).on('click','.edit-single',function(){
		$(this).parents('tr').find('.view-mode').hide();
		$(this).parents('tr').find('.edit-mode').show();
		$(this).hide();
	});

	$(document).on('click','.edit-todo',function(){
		$(this).parents('.add-details').find('.todo-details').slideDown();
		$(this).parents('.todo_list').find('.todo-name').css({'border-bottom':'1px solid #9e9e9e'}).attr('contenteditable',true);
		$(this).parents('.todo_list').find('.todo-desc').css({'border-bottom':'1px solid #9e9e9e'}).attr('contenteditable',true);
		$('.save-todo').show();
		$(this).parents('.add-details').find('.save-todo , .edit-priority').show();
		$(this).parents('.add-details').find('.priority-badge').hide();

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
	$(document).on('click','.delete-todo',function(){
		$(this).parents('tr').remove();
		var id = $(this).parents('tr').find('.todo_id').val();
		$.ajax({
			url : route()+'/project/todo/delete',
			type: 'POST',
			data:{
					id 		: id,
					_token	: $('.shift_token').val()
				},
			success:function(res){
				// console.log(res);

				if($('#list_todo > tr').length == 0){
					$('.empty-records').show();
				}else{
					$('.empty-records').hide();
				}
			}
		}); 
	});

	// append div of new data
	$('.priority-error').hide();
/*	$(document).on('keydown','.todo-names',function(e){
		if(e.keyCode == 13){
			if($('.select-dropdown').val() == 'Select Priority'){
				$('.priority-error').show(function(){
					$('.priority-error').delay(3000).fadeOut();
				});
			}else{
				var array = {
							project_id 	: $('.project_id').val(),
							user_id 	: $('input[name=user_id]').val(),
							title 		: $('.todo-names').val(),
							priority	: $('.select-dropdown').val(),
							_token		: $('.shift_token').val(),
						};
				$.ajax({
					url:route()+'/project/todo/create',
					type:'POST',
					data: array,
					success: function (res) {
						$('#list_todo').html(res);
					}
				});
			
				$(this).val('');
			}
			
		}
	});*/
	
	$(document).on('click','.add-new-todo',function(){
		
		if($('.select-dropdown').val() == 'Select Priority'){
			$('.priority-error').show(function(){
				$('.priority-error').delay(3000).fadeOut();
			});
		}else{
			var array = {
						project_id 	: $('.project_id').val(),
						user_id 	: $('input[name=user_id]').val(),
						title 		: $('.todo-names input').val(),
						priority	: $('.priority_select select').val(),
						_token		: $('.shift_token').val(),
					};
			// console.log(array);
			$.ajax({
				url:route()+'/project/todo/create',
				type:'POST',
				data: array,
				success: function (res) {
					$('.todo-names input').val('');
					$('.priority_select select option').prop('selected', function() {
				        return this.defaultSelected;
				    });
					$(this).parent().parent().find('.todo-names').hide();
					Materialize.toast('Success',4000);
					$('#list_todo').html(res);
					if($('#list_todo > tr').length == 0){
						$('.empty-records').show();
					}else{
						$('.empty-records').hide();
					}
				}
			});
		
			$(this).parents('.row').find('.todo-names').val('');
		}
			
		
	});
	//add todo to database
			
	$(document).on('click','.save-todo',function(){
		// $(this).parents('.add-details').find('.todo-details').slideUp();
		// $('.project-title').click();
		// console.log($(this).parents('tr').find('.edit-mode .priority').val());
		var prefix = $(this).parents('tr');
			var data = 	{
						id 			: prefix.find('.todo_id').val(),
						title 		: prefix.find('.edit-mode .todo-name').val(),
						// description	: prefix.find('.todo-desc').html(),
						priority 	: prefix.find('.edit-mode .priority').val(),
						_token		: prefix.find('.shift_token').val()
					};

		$.ajax({
			url 	: route()+'/project/todo/edit',
			type	: 'POST',
			data 	: data,
			success : function(res){
				console.log(res);
				$('.edit-mode').hide();
				$('.view-mode').show();
				$('.edit-single').show();
				var name = prefix.find('.edit-mode .todo-name').val();
				var priority = prefix.find('.edit-mode .priority').val();
				prefix.find('.view-mode.todo-name').html(name);
				prefix.find('.view-mode .priority').html(priority);
				Materialize.toast('Setting successfully save',4000);
			}
		});
	});
});