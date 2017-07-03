$(function(){
	
	function elemEditable(){
		$('.edit').editable(route()+'/employee/update/name', {
				tooltip   : 'Click to edit...',
				submitdata : function(value, settings){
					return {'_token':csrf()}
				}
			});
			$('.edit_designation').editable(route()+'/update/designation', {
				type: 'select',
				loadurl: route()+'/designations/list/ajax',
				submitdata : function(value, settings){
					return {'_token':csrf(),'html':value}
				},
				onblur: 'submit',
				tooltip   : 'Click to edit...',
				cssclass: 'designationSelect'
			});
			$('.edit_designation').click(function(){
				setTimeout(function(){
					$('select').css('display','block');
				},1);
			});
			$(document).on('change','.designationSelect > select', function(){
				$(this).submit();
			});
	}

	$('.add-new').off().click(function(e){
		e.preventDefault();

		$('.add-new-wrapper').toggleClass('active'); 
		$('.fade-background').fadeToggle(300);
	});
	$('.fade-background').click(function(){
			$('.fade-background').fadeToggle(300);
			$('.add-new-wrapper').toggleClass('active');
		});
		
	$(document).on('change', '.switch > label > input',function(e){

		var postedData = {};
		postedData['id'] 				= $(this).parents('.hover-me').find('.id').html();
		postedData['status'] 			= $(this).prop('checked');
		postedData['_token'] 			= $('input[name=_token]').val();

		$.ajax({
			url:route()+'/employee/update',
			type:'POST',
			data:postedData,
			success: function(res){
				console.log('data sent successfull');
			}
		});
		$('.editable h5 ,.editable p').removeClass('edit-fields');
	});

	$.ajax({
		type:'GET',
		url: 'employee/list/ajax',
		data: {},
		success: function(result){
			$('.list').html(result);
			elemEditable();
		}
	});

	$('.search-employee').keyup(function(){
		// var tags = $('.projects-chips').material_chip('data');
		$.ajax({
			type:'GET',
			url: 'employee/list/ajax?q='+$(this).val(),
			data: {},
			success: function(result){
				$('.list').html(result);
				elemEditable();
			}
		});
	});

	$('.arrow_sort').click(function(e){
		//var tags = $('.projects-chips').material_chip('data');
		if($(this).hasClass('fa-sort-alpha-asc')){
			orderSort = 'desc';
			$(this).removeClass('fa-sort-alpha-asc');
			$(this).addClass('fa-sort-alpha-desc');
			$.ajax({
				type:'GET',
				url: 'employee/list/ajax?q='+$('.search').val()+'&order=desc',
				data: {},
				success: function(result){
					$('.list').html(result);
					elemEditable();
				}
			});
		}else{
			$(this).removeClass('fa-sort-alpha-desc');
			$(this).addClass('fa-sort-alpha-asc');
			orderSort = 'asc';
			$.ajax({
				type:'GET',
				url: 'employee/list/ajax?q='+$('.search').val()+'&order=asc',
				data: {},
				success: function(result){
					$('.list').html(result);
					elemEditable();
				}
			});
		}
	});

});