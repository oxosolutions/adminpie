$(document).ready(function(){
	$('.edit').editable(route()+'/category/update', {
		submitdata : function(value, settings){
			return {'_token':csrf()}
		}
	});
	$('.add-new').click(function(e){
		e.preventDefault();
		$('.add-new-wrapper').toggleClass('active'); 
	});
    var options = {
	  valueNames: [ 'project-name']
	};

	//var userList = new List('find-project', options);
});