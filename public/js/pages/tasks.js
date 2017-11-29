$(document).ready(function(){
  
  $(document).on('click','.deleteTask',function(){
    
    $(this).parents('li').hide();

    var id = $(this).parents('li').find('input[name=id]').val();
    var token = $(this).parents('li').find('input[name=_token]').val();
    $.ajax({
      url   : route()+'/account/tasks/delete',
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
        	url : route()+'/account/tasks/status/update',
        	type : "POST",
        	data : {id : id,status : status,_token : token},
        	success : function(res){

        	}
        });

        //count tasksclick
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
  $(document).on('click','.taskUpdate',function(event){
    event.preventDefault();
    event.stopPropagation();
    var prepend = $(this).parents('.edit_task');
    if(prepend.find('select[name=assign_to]').val() != undefined){
      var assign_to = prepend.find('select[name=assign_to]').val();
    }else{
      var assign_to = prepend.find('.assignToText').val();
    }
    var data = {
            id:           prepend.find('input[name=task_id]').val(),
            title :       prepend.find('input[name=title]').val(),
            description : prepend.find('textarea[name=description]').val(),
            assign_to :   assign_to,
            team :        prepend.find('select[name=team]').val(),
            priority :    prepend.find('select[name=priority]').val(),
            project_id :  prepend.find('select[name=projects_list]').val(),
            _token :      $('.token').val()
          }
   $.ajax({
    url : route()+'/account/tasks/update',
    type : 'POST',
    data : data,
      success : function(res){
        if(res = 'true'){
          Materialize.toast('Update Successfully' , 4000);

        }
      }
    });
  });

  //filter by priority
  $(document).on('change','.filter_priority',function(e){
    e.preventDefault();
    e.stopPropagation();

      $('.progress').show();
        var priorityStatus = $(this).val();

        var token = $('input[name=_token]').val();

        if($('input[name=project_id]').val() != undefined){
          var project_id = $('input[name=project_id]').val();
        }else{
          project_id = 'null';
        }
        console.log(project_id);
        $.ajax({
          url : route()+'/account/tasks/priority/filter',
          type : "POST",
          data : {priorityStatus : priorityStatus,project_id : project_id,_token : token},
          success : function(res){
            $('.progress').hide();
            $('.main-div').remove();
            $('.append-data').html(res);
            $('select').material_select();
            $( "ul.droptrue" ).sortable({
              connectWith: "ul",
            });
            count();

          }
        });
    });
  //filter by employee
  $(document).on('change','.Employee_filter',function(e){
    e.preventDefault();
    e.stopPropagation();
      $('.progress').show();
        var Employee_filter = $(this).val();
        var token = $('input[name=_token]').val();
        $.ajax({
          url : route()+'/account/tasks/priority/filter',
          type : "POST",
          data : {Employee_filter : Employee_filter,_token : token},
          success : function(res){
            $('.progress').hide();
            $('.main-div').remove();
            $('.append-data').html(res);
            $('select').material_select();
            $( "ul.droptrue" ).sortable({
              connectWith: "ul",
            });
          }
        });
    });
  //filter by project
  $(document).on('change','.project_filter',function(e){
    e.preventDefault();
    e.stopPropagation();
      $('.progress').show();
        var project_filter = $(this).val();
        var token = $('input[name=_token]').val();
        $.ajax({
          url : route()+'/account/tasks/priority/filter',
          type : "POST",
          data : {project_filter : project_filter,_token : token},
          success : function(res){
            $('.progress').hide();
            $('.main-div').remove();
            $('.append-data').html(res);
            $('select').material_select();
            $( "ul.droptrue" ).sortable({
              connectWith: "ul",
            });
          }
        });
    });

  $('.team').each(function(){
    $(this).children().first().siblings().hide();
  });
  $('.users').each(function(){
    $(this).children().first().siblings().hide();
  });
});