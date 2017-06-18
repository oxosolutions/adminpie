$(document).ready(function(){

	function list_users() {
		$.ajax({
			url : route()+'/list',
			type : 'GET',
			success :function(res){
				$('#list').html(res);
			}
		});
	}
	list_users();
	
	//del user
	$(document).on('mouseenter','.card-panel',function(){
		$(this).find('.delete , .edit').show();
	});
	$(document).on('mouseleave','.card-panel',function(){
		$(this).find('.delete , .edit').hide();
	});

	//save user
	$(document).on('click','.save_user',function() {
		var name = $(this).parents('.row').find('#user_name').val();
		var email = $(this).parents('.row').find('#emailId').val();
		var roleId = $(this).parents('.row').find('#roleId').val();
		var password = $(this).parents('.row').find('#Password').val();
		var token = $(this).parents('.row').find('.shift_token').val();

		var data ={
						name:	name,
						email: 	email,
						role_id : roleId,
						password: password,
						_token	: token
					} 
					console.log(data);
		$.ajax({
			url : route()+'/create/user',
			type : 'POST',
			data : data,
			success :function(res){
				$('#list').html(res);
				 $('.add-new-wrapper').removeClass('active');
				 $('.fade-background').fadeOut();
				 Materialize.toast('User created successfully ..!',4000);
			}
		});
	});
	$(document).on('click','.delete',function() {
		var id = $(this).parents('.card-panel').find('.id').val();
		var $this = $(this).parents('.card-panel');
		$.ajax({
			url : route()+'/delete/user',
			type : 'GET',
			data : {id:id},
			success :function(res){
				$this.hide();	
			}
		});

	});
});