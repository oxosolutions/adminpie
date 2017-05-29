$(document).ready(function () {
	$('.save-note').click(function(){
		var data = {
						title 	: $('input[name=title]').val(),
						description : $('.materialize-textarea').val(),
						_token	: $('input[name=_token]').val()
					};
		$.ajax({
			url  : route()+'/project/notes/save',
			type : 'POST',
			data : data,
			success : function(res){
				console.log(res);
				$('#notes').html(res);	
			}
		});	
	});

	function listNotes() {
		$.ajax({
			url  : route()+'/project/notes/list',
			type : 'GET',
			success : function(res){
				// console.log(res);
				$('#notes').html(res);	
			}
		});
	}
	listNotes();
	$(document).on('click','.notes_title , .notes_desc',function(){
		$(this).attr('contenteditable',true);
	});

	$(document).on('keyup','.notes_title , .notes_desc',function(e){
		if (e.keyCode == 13){
			var title 		= $(this).parents('a').find('.notes_title').html();
			var description = $(this).parents('a').find('.notes_desc').html();
			var id = $(this).parents('a').find('input[name=id]').val();
				var data = {
						id			: id,
						title 		: title,
						description : description,
						_token		: $('input[name=_token]').val()
				};

				$.ajax({
					url		: route()+'/project/notes/edit',
					type	: 'POST',
					data	: data,
					success	: function(res){
						Materialize.toast('Note Updated successfully',4000);
						$('.notes_title , .notes_desc').attr('contenteditable',false);
					}
				});
		}
	});

	// $('#notes > ul > li').mouseover(function(){
	// 	alert("hello");
	// });

	// $(document).on('click','delete_note',function(){
	// 	var id = $(this).parents('a').find('input[name=id]').val();
	// 		$.ajax({
	// 			url		: route()+'/project/notes/edit',
	// 			type	: 'POST',
	// 			data	: id,
	// 			success	: function(res){
	// 				console.log("hello");
	// 			}
	// 		});
	// });

});