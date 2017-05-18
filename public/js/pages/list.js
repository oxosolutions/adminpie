$(function(){
	var orderSort = 'desc';
	var tags = $('.projects-chips').material_chip('data');
	$.ajax({
		type:'GET',
		url: 'projects/projects/list',
		data: {tags: tags},
		success: function(result){
			$('.list').html(result);
		}
	});
	$(document).on('click','.pagination a', function(e){
		e.preventDefault();
		var tags = $('.projects-chips').material_chip('data');
		var link = $(this).attr('href');
		var page = link.split('?');
		$.ajax({
			type:'GET',
			url: 'projects/projects/list?'+page[1],
			data: {tags: tags},
			success: function(result){
				$('.list').html(result);
			}
		});
	});
	$('.search-project').keyup(function(){
		var tags = $('.projects-chips').material_chip('data');
		$.ajax({
			type:'GET',
			url: 'projects/projects/list?q='+$(this).val(),
			data: {tags: tags},
			success: function(result){
				$('.list').html(result);
			}
		});
	});
	$('.arrow_sort').click(function(e){
		var tags = $('.projects-chips').material_chip('data');
		if($(this).hasClass('fa-sort-alpha-asc')){
			orderSort = 'desc';
			$(this).removeClass('fa-sort-alpha-asc');
			$(this).addClass('fa-sort-alpha-desc');
			$.ajax({
				type:'GET',
				url: 'projects/projects/list?q='+$('.search').val()+'&order=desc',
				data: {tags:tags},
				success: function(result){
					$('.list').html(result);
				}
			});
		}else{
			$(this).removeClass('fa-sort-alpha-desc');
			$(this).addClass('fa-sort-alpha-asc');
			orderSort = 'asc';
			$.ajax({
				type:'GET',
				url: 'projects/projects/list?q='+$('.search').val()+'&order=asc',
				data: {tags: tags},
				success: function(result){
					$('.list').html(result);
				}
			});
		}
	});

	$('.projects-chips').on('chip.add',function(e, chip){
		var tags = $('.projects-chips').material_chip('data');
		$.ajax({
			type:'GET',
			url: 'projects/projects/list?q='+$('.search').val()+'&order='+orderSort,
			data: {tags: tags},
			success: function(result){
				$('.list').html(result);
			}
		});
	});

	$('.chips').on('chip.delete', function(e, chip){
	    var tags = $('.projects-chips').material_chip('data');
		$.ajax({
			type:'GET',
			url: 'projects/projects/list?q='+$('.search').val()+'&order='+orderSort,
			data: {tags: tags},
			success: function(result){
				$('.list').html(result);
			}
		});
	});

});