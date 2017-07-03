$(document).ready(function(){
  
  $(document).on('click','.deleteTask',function(){
    
    $(this).parents('li').hide();

    var id = $(this).parents('li').find('input[name=id]').val();
    var token = $(this).parents('li').find('input[name=_token]').val();
    $.ajax({
      url   : route()+'account/tasks/delete',
      type  : 'POST',
      data  : {id : id,_token : token},
      success : function(){
        count();
      }
    });
  });
  function count(){
        var pendingCount = $('#sortable1').children().length;
        var workingCount = $('#sortable2').children().length;
        var completeCount = $('#sortable3').children().length;

        $('.pending-count').html(pendingCount);
        $('.working-count').html(workingCount);
        $('.complete-count').html(completeCount);
  }
  count();
	$( "ul.droptrue" ).sortable({
     connectWith: "ul",
     stop: function(event, ui) {
        var id = ui.item.find('input[name=id]').val();
        var status = ui.item.parents('ul').attr('status');
        var token = ui.item.find('input[name=_token]').val();
        $.ajax({
        	url : route()+'account/tasks/status/update',
        	type : "POST",
        	data : {id : id,status : status,_token : token},
        	success : function(res){

        	}
        });

        //count tasks
        count();
    }

  	});
 
    $( "ul.dropfalse" ).sortable({
      connectWith: "ul",
      dropOnEmpty: false
    });
 
    $( "#sortable1, #sortable2, #sortable3" ).disableSelection();


//Delete Tasks
	

//update Tasks
  $(document).on('click','.taskUpdate',function(){
    var prepend = $(this).parents('.modal');
        var data = {
                id: prepend.find('input[name=task_id]').val(),
                title : prepend.find('input[name=title]').val(),
                description : prepend.find('textarea[name=description]').val(),
                assign_to : prepend.find('select[name=assign_to]').val(),
                priority : prepend.find('select[name=priority]').val(),
                project_id : prepend.find('select[name=projects_list]').val(),
                _token : $('.token').val()
              }
   $.ajax({
    url : route()+'account/tasks/update',
    type : 'POST',
    data : data,
    success : function(){
      $('.modal').modal('close');
    }
   });
  });

  //filter by priority
  $(document).on('change','.filter_priority',function(e){
    e.preventDefault();
    e.stopPropagation();
        var priorityStatus = $(this).val();
        var token = $('input[name=_token]').val();
        $.ajax({
          url : route()+'account/tasks/priority/filter',
          type : "POST",
          data : {priorityStatus : priorityStatus,_token : token},
          success : function(res){
            $('.main-div').remove();
            $('.append-data').html(res);
            $('select').material_select();
            $( "ul.droptrue" ).sortable({
              connectWith: "ul",
            });
            
          }
        });
    });
});